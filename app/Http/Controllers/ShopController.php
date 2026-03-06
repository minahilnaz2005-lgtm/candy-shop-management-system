<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->latest()->get();
        return view('shop.index', compact('products'));
    }
    
    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }
}
