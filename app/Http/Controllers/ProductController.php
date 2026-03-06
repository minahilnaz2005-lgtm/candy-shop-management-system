<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::latest();
        
        // Handle filter for low stock
        if ($request->has('filter') && $request->filter === 'low_stock') {
            $query->where('stock', '<', 10);
        }
        
        $products = $query->get();
        
        // Statistics for Stock Management
        $lowStockCount = Product::where('stock', '<', 10)->count();
        $outOfStockCount = Product::where('stock', '=', 0)->count();
        $totalProducts = Product::count();

        // New Sales Report Statistics (Admin Only)
        $totalRevenue = Order::sum('total_amount');
        $totalOrders = Order::count();
        $recentSales = Order::latest()->take(5)->get();
        
        return view('products.index', compact(
            'products', 
            'lowStockCount', 
            'outOfStockCount', 
            'totalProducts',
            'totalRevenue',
            'totalOrders',
            'recentSales'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $input['image'] = $path;
        }

        Product::create($input);

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $input['image'] = $path;
        }

        $product->update($input);

        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
