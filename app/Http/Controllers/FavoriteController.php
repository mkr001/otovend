<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favorites()->with('product.vendor')->latest()->get();
        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Product $product)
    {
        $user = Auth::user();
        $existing = Favorite::where('user_id', $user->id)->where('product_id', $product->id)->first();

        if ($existing) {
            $existing->delete();
            $isFavorited = false;
            $message = 'Usunięto z ulubionych.';
        } else {
            Favorite::create(['user_id' => $user->id, 'product_id' => $product->id]);
            $isFavorited = true;
            $message = 'Dodano do ulubionych! ❤️';
        }

        // Support both AJAX and regular form posts
        if (request()->wantsJson()) {
            return response()->json(['favorited' => $isFavorited, 'message' => $message]);
        }

        return back()->with('success', $message);
    }
}
