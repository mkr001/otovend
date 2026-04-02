<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('items.product')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if(empty($cart)) return redirect()->route('cart.index')->with('error', 'Cart is empty');
        
        $total = array_reduce($cart, function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
        
        return view('orders.checkout', compact('cart', 'total'));
    }

    public function place(Request $request)
    {
        $cart = session()->get('cart', []);
        if(empty($cart)) return redirect()->route('cart.index');

        // Security Patch: Never trust session prices for final checkout.
        // Always query the live database for actual product prices.
        $productIds = array_keys($cart);
        $liveProducts = \App\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');
        
        $total = 0;
        $orderItems = [];

        foreach ($cart as $id => $details) {
            if (!$liveProducts->has($id)) continue; // Skip if product no longer exists
            
            $livePrice = $liveProducts[$id]->price;
            $quantity = $details['quantity'];
            
            $total += ($livePrice * $quantity);
            
            $orderItems[] = [
                'product_id' => $id,
                'quantity' => $quantity,
                'price' => $livePrice // Record the actual price bought at
            ];
        }

        if ($total == 0 || empty($orderItems)) {
            session()->forget('cart');
            return redirect()->route('home')->with('error', 'Koszyk był pusty lub produkty są już niedostępne.');
        }

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'status' => 'pending'
            ]);

            foreach ($orderItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'] // Record the actual price bought at
                ]);
            }

            \Illuminate\Support\Facades\DB::commit();
            session()->forget('cart');
            
            return redirect()->route('orders.index')->with('success', 'Zamówienie zostało złożone pomyślnie!');
            
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return back()->with('error', 'Wystąpił błąd podczas składania zamówienia: ' . $e->getMessage());
        }
    }
}
