<?php

namespace App\Http\Requests\Admin;

use App\Enums\ProductStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'numeric'],
            'offer_price' => ['nullable', 'numeric'],
            'size' => ['nullable', 'string', 'max:50'],
            'stock' => ['required', 'numeric'],
            'color' => ['nullable', 'array'],
            'color.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'image' => ['nullable', 'array'],
            'image.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5242'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'status' => ['required', Rule::in(array_column(ProductStatusEnum::cases(), 'value'))],
        ];
    }
}
