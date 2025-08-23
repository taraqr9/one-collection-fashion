<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'stock_id' => ['required', 'exists:stocks,id'],
            'quantity' => ['numeric:', 'string', 'max:200'],
        ];
    }
}
