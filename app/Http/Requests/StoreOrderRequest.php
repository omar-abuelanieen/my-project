<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'user_id' => 'required|exists:users,id',

            'products' => 'required|array|min:1',

            'products.*.product_id' =>
                'required|exists:products,id',

            'products.*.quantity' =>
                'required|integer|min:1',

        ];
    }
}
