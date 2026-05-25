<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return response()->json($products, 200);
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

    public function show(Product $product)
    {
        return response()->json($product, 200);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product
        ], 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ], 200);
    }

    public function trashed()
{
    $products = Product::onlyTrashed()->get();

    return response()->json($products);
}

    public function restore(Product $product)
    {
        $product->restore();

        return response()->json([
            'message' => 'Product restored successfully',
            'data' => $product
        ], 200);
    }

    public function forceDelete(Product $product)
    {
        $product->forceDelete();

        return response()->json([
            'message' => 'Product permanently deleted'
        ], 200);
    }
    public function ExpensiveProduct(Product $products){

    $products = Product::Expensive()->get();
    return response()->json($products);
    }
    public function CheapProduct(Product $products){
        $products = Product::Cheap()->get();
        return response()->json($products);
    }
}
