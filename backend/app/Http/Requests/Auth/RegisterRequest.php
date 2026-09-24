<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'username'       => 'required|string|max:50|unique:users,username',
            'email'          => 'required|email|max:100|unique:users,email',
            'password'       => 'required|string|min:6|confirmed',
            'contact_number' => 'nullable|string|max:20',
            'address'        => 'nullable|string',
            'role'           => 'required|in:customer,farmer',
            // farmer-specific
            'stall_name'     => 'required_if:role,farmer|string|max:100',
            'contact_person' => 'required_if:role,farmer|string|max:100',
        ];
    }
}