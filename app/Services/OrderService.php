<?php

namespace App\Services;

use App\Models\Product;

class OrderService
{
    public function prepareProducts($items)
    {
        $products = [];

        $total = 0;

        foreach ($items as $item) {

            $product = Product::find(
                $item['product_id']
            );

            if (!$product) {
                continue;
            }

            $products[$product->id] = [
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ];

            $total +=  $product->price * $item['quantity'];
        }

        return [
            'products' => $products,
            'total' => $total,
        ];
    }
}
