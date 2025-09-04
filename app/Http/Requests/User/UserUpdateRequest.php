<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $userId = $this->route('user');

        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:45',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'phone' => [
                'required',
                'digits:11',
                Rule::unique('users', 'phone')->ignore($userId),
            ],
            'password' => ['nullable', 'string', 'min:6'], // optional
        ];
    }
}
