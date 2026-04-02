<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('cart.index');

        // Verify products in DB
        $productIds = array_keys($cart);
        $liveProducts = \App\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');

        $lineItems = [];
        $total = 0;
        $orderItemsData = [];

        foreach ($cart as $id => $details) {
            if (!$liveProducts->has($id)) continue;
            
            $product = $liveProducts[$id];
            $quantity = $details['quantity'];
            $total += ($product->price * $quantity);

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'pln',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price * 100, // Stripe uses cents
                ],
                'quantity' => $quantity,
            ];

            $orderItemsData[] = [
                'product_id' => $id,
                'quantity' => $quantity,
                'price' => $product->price
            ];
        }

        if (empty($lineItems)) return redirect()->route('cart.index');

        // Create Pending Order first
        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'shipping_method' => $request->get('shipping_method', 'standard'),
                'inpost_locker_id' => $request->get('inpost_locker_id'),
            ]);

            foreach ($orderItemsData as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            DB::commit();

            // Set Stripe Key
            Stripe::setApiKey(config('services.stripe.secret'));

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [$lineItems],
                'mode' => 'payment',
                'success_url' => route('stripe.success', ['order' => $order->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel', ['order' => $order->id]),
                'metadata' => [
                    'order_id' => $order->id
                ]
            ]);

            $order->update(['payment_id' => $session->id]);

            return redirect($session->url);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Stripe Error: ' . $e->getMessage());
        }
    }

    public function success(Request $request, Order $order)
    {
        // In a real app, use Webhooks. For demo, we verify session.
        $sessionId = $request->get('session_id');
        
        if ($sessionId && $order->payment_id === $sessionId) {
            $order->update(['payment_status' => 'paid']);
            session()->forget('cart');
            return redirect()->route('orders.index')->with('success', __('messages.success') . ' ✓');
        }

        return redirect()->route('orders.index')->with('error', __('messages.unpaid'));
    }

    public function cancel(Order $order)
    {
        return redirect()->route('cart.index')->with('error', __('messages.unpaid'));
    }
}
