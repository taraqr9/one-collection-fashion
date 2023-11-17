<?php

namespace App\Http\Requests\Admin;

use App\Enums\AdminTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'phone' => ['required', 'unique:admins,phone', 'string'],
            'email' => ['required', 'unique:admins,email', 'min:5', 'max:100', 'regex:/^[a-zA-Z0-9-@._]+$/'],
            'password' => ['required', 'confirmed', 'min:6', 'max:255'],
            'designation' => ['required', 'min:3', 'max:200'],
            'admin_type' => ['required', Rule::in(array_column(AdminTypeEnum::cases(), 'value'))],
            'avatar' => ['nullable', 'mimes:jpeg,jpg,png,gif|max:5000']
        ];
    }
}
