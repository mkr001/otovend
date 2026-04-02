<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Vendor $vendor, Product $product = null)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Security check: Only allow users who have bought a product from this vendor to leave a review
        $hasBought = Auth::user()->orders()->whereHas('items.product', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->id);
        })->exists();

        if (!$hasBought) {
            return back()->with('error', 'Musisz dokonać zakupu, aby wystawić opinię.');
        }

        // Check if user already reviewed this product/vendor
        $existing = Review::where('user_id', Auth::id())
            ->where('vendor_id', $vendor->id)
            ->when($product, function ($q) use ($product) {
                return $q->where('product_id', $product->id);
            })
            ->first();

        if ($existing) {
            return back()->with('error', 'Już wystawiłeś opinię za tę transakcję.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'vendor_id' => $vendor->id,
            'product_id' => $product ? $product->id : null,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Dziękujemy za Twoją opinię! Została dodana.');
    }
}
