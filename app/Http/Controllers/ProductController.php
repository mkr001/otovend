<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['vendor', 'images']);

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
        
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12);
        
        if ($request->ajax()) {
            return view('partials.product_grid', compact('products'))->render();
        }

        return view('home', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
