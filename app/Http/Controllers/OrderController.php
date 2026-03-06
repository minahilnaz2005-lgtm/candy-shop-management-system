<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if(empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty');
        }

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('orders.checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if(empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty');
        }

        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'shipping_address' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $total = 0;
            foreach($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'status' => 'completed',
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'shipping_address' => $request->shipping_address,
            ]);

            foreach($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);

                // Update stock
                $product = Product::find($id);
                $product->stock = $product->stock - $details['quantity'];
                $product->save();
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        // Ensure user can only see their own orders unless they are admin
        if (auth()->id() !== $order->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        return view('orders.index', compact('orders'));
    }
}
