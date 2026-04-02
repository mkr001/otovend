<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'totalOrders', 'totalRevenue', 'recentOrders'));
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    public function products()
    {
        $products = Product::with('vendor')->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function categories()
    {
        $categories = \App\Models\Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|unique:categories',
            'name_pl' => 'required',
            'name_en' => 'required',
        ]);

        \App\Models\Category::create($validated);

        return back()->with('success', 'Category added successfully!');
    }

    public function destroyCategory(\App\Models\Category $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted.');
    }

    public function roles()
    {
        $roles = \Spatie\Permission\Models\Role::with('permissions')->get();
        return view('admin.roles', compact('roles'));
    }
}
