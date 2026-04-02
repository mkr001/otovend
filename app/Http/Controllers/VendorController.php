<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function index()
    {
        $vendor = Auth::user()->vendor;
        
        // If the user accessed this without a vendor profile (e.g. an Admin viewing the page)
        if (!$vendor) {
            return redirect()->route('vendor.join')->with('error', 'Musisz najpierw aktywować konto sprzedawcy.');
        }

        $productIds = $vendor->products->pluck('id');
        
        $totalSales = OrderItem::whereIn('product_id', $productIds)->sum(\DB::raw('quantity * price'));

        // Prepare chart data (Last 30 Days)
        $chartData = OrderItem::whereIn('product_id', $productIds)
            ->where('created_at', '>=', now()->subDays(29)->startOfDay())
            ->selectRaw('DATE(created_at) as date, SUM(quantity * price) as daily_revenue')
            ->groupBy('date')
            ->pluck('daily_revenue', 'date')
            ->all();

        $dates = [];
        $revenues = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dates[] = now()->subDays($i)->format('d M');
            $revenues[] = $chartData[$date] ?? 0;
        }

        return view('vendor.dashboard', compact('vendor', 'totalSales', 'dates', 'revenues'));
    }

    public function products()
    {
        $vendor = Auth::user()->vendor;
        if (!$vendor) return redirect()->route('vendor.join');

        $products = $vendor->products;
        return view('vendor.products', compact('products'));
    }

    public function create()
    {
        $vendor = Auth::user()->vendor;
        if (!$vendor) return redirect()->route('vendor.join');
        
        return view('vendor.create_product');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'year' => 'nullable|integer',
            'location' => 'nullable',
            'condition' => 'required|in:new,used',
            'description' => 'nullable',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048' // Security constraint: max 2MB
        ]);

        $productData = \Illuminate\Support\Arr::except($data, ['images']);

        if ($request->hasFile('images') && count($request->file('images')) > 0) {
            $primaryPath = $request->file('images')[0]->store('products', 'public');
            $productData['image'] = '/storage/' . $primaryPath;
        }

        $vendor = Auth::user()->vendor;
        if (!$vendor) return redirect()->route('vendor.join');

        $product = $vendor->products()->create($productData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                // To avoid duplicate storage for primary, we can just use the path if index=0
                // For simplicity, we just store all as product_images
                if ($index === 0 && isset($primaryPath)) {
                    $dbPath = '/storage/' . $primaryPath;
                } else {
                    $path = $file->store('products', 'public');
                    $dbPath = '/storage/' . $path;
                }
                
                $product->images()->create([
                    'image_path' => $dbPath,
                    'is_primary' => $index === 0
                ]);
            }
        }

        return redirect()->route('home')->with('success', 'Ogłoszenie dodane pomyślnie! Twoja oferta jest już widoczna.');
    }

    public function sales()
    {
        $vendor = Auth::user()->vendor;
        if (!$vendor) return redirect()->route('vendor.join');

        $sales = OrderItem::whereIn('product_id', $vendor->products->pluck('id'))->with('product', 'order.user')->latest()->get();
        return view('vendor.sales', compact('sales'));
    }

    public function join()
    {
        return view('vendor.join');
    }

    public function upgrade(Request $request)
    {
        $user = Auth::user();

        // Always ensure a Vendor profile is created, no matter the role
        if (!$user->vendor) {
            $user->ownedShop()->create([
                'shop_name' => $user->name . "'s Shop",
            ]);
        }

        // Only upgrade customers (not admins who retain their superuser status)
        if ($user->role == 'customer') {
            $user->update(['role' => 'vendor']);

            // Assign spatie 'vendor' role so hasPermissionTo() works for policies
            if (!$user->hasRole('vendor')) {
                $user->assignRole('vendor');
            }
        }
        
        return redirect()->route('vendor.dashboard')->with('success', __('messages.vendor_join.activate'));
    }

    public function edit(Product $product)
    {
        // Policy check replaces manual logic
        \Illuminate\Support\Facades\Gate::authorize('update', $product);
        return view('vendor.edit_product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Policy check replaces manual logic
        \Illuminate\Support\Facades\Gate::authorize('update', $product);

        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'year' => 'nullable|integer',
            'location' => 'nullable',
            'condition' => 'required|in:new,used',
            'description' => 'nullable',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048' // Security constraint: max 2MB
        ]);

        $productData = \Illuminate\Support\Arr::except($data, ['images']);

        if ($request->hasFile('images') && count($request->file('images')) > 0) {
            // Delete old product_images to replace cleanly
            $product->images()->delete();

            $primaryPath = $request->file('images')[0]->store('products', 'public');
            $productData['image'] = '/storage/' . $primaryPath;
        }

        $product->update($productData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                if ($index === 0 && isset($primaryPath)) {
                    $dbPath = '/storage/' . $primaryPath;
                } else {
                    $path = $file->store('products', 'public');
                    $dbPath = '/storage/' . $path;
                }
                
                $product->images()->create([
                    'image_path' => $dbPath,
                    'is_primary' => $index === 0
                ]);
            }
        }

        return redirect()->route('vendor.my-products')->with('success', 'Ogłoszenie zaktualizowane.');
    }

    public function destroy(Product $product)
    {
        // Policy check replaces manual logic
        \Illuminate\Support\Facades\Gate::authorize('delete', $product);

        $product->delete();
        return back()->with('success', __('messages.vendor_dashboard_keys.delete') . ' ✓');
    }

    public function updateShipping(Request $request, \App\Models\Order $order)
    {
        // Security: Ensure the vendor actually sold something in this order
        $vendorItems = $order->items()->whereHas('product', function($q) {
            $q->where('vendor_id', Auth::user()->vendor->id);
        })->exists();

        if (!$vendorItems) {
            abort(403, 'Brak autoryzacji.');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,shipped,delivered',
            'tracking_number' => 'nullable|string|max:255',
        ]);

        $order->update($validated);

        return back()->with('success', 'Status wysyłki zaktualizowany.');
    }
}
