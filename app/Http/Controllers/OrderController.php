<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'total_price' => 'required|numeric',
        ]);

        $order = Order::create([
            'product_id' => $request->product_id,
            'total_price' => $request->total_price,
        ]);

        return response()->json([
            'message' => 'Order created successfully',
            'data' => $order
        ], 201);
    }

    public function show(Order $order)
    {
        return response()->json($order, 200);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'total_price' => 'required|numeric',
        ]);

        $order->update([
            'product_id' => $request->product_id,
            'total_price' => $request->total_price,
        ]);

        return response()->json([
            'message' => 'Order updated successfully',
            'data' => $order
        ], 200);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully'
        ], 200);
    }
}
