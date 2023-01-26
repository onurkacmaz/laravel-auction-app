<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->id,
            'password' => [
                Rule::when($this->password !== null, [Rules\Password::defaults(), 'confirmed']),
            ],
            'is_admin' => 'required|boolean',
            'role_id' => 'required|integer|exists:roles,id'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Ad Soyad',
            'email' => 'E-posta',
            'password' => 'Şifre',
            'password_confirmation' => 'Şifre Tekrarı',
            'role_id' => 'Rol',
            'is_admin' => 'Yönetici'
        ];
    }
}
