<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(
            Order::with(['user', 'products'])->get()
        );
    }

    public function store( StoreOrderRequest $request,OrderService $service ) {

        $order = Order::create([
            'user_id' => $request->user_id,
            'total_price' => 0,
        ]);

        $data = $service->prepareProducts(
            $request->products
        );

        $order->products()->attach(
            $data['products']
        );

        $order->update([
            'total_price' => $data['total']
        ]);

        return response()->json([
            'message' => 'created',
            'data' => $order->load([
                'user',
                'products'
            ])
        ], 201);
    }

    public function show(Order $order)
    {
        return response()->json($order);
    }

    public function update(UpdateOrderRequest $request,Order $order, OrderService $service) {

        $data = $service->prepareProducts($request->products);

        $order->update([ 'user_id' => $request->user_id,'total_price' => $data['total']]);

        $order->products()->sync(
            $data['products']
        );

        return response()->json([
            'message' => 'updated'
        ]);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'message' => 'deleted succsefully'
        ]);
    }
    public function trashed(){
        $orders =Order::onlyTrashed()->get();
        return response()->json($orders);
    }
    public function restore(Order $orders){
        $orders->restore();
        return response()->json(['message' => 'Product restored successfully','data'=>$orders],200);
    }
    public function forceDelete(Order $orders){
        $orders->forceDelete();
        return response()->json(['message' =>'order deleted permanently'],200);
    }
}
