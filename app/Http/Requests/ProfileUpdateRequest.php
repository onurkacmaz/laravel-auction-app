<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\TcIdentifyRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'birth_date' => ['required', 'date', 'before:today']
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Ad Soyad',
            'email' => 'E-posta',
            'birth_date' => 'Doğum Tarihi'
        ];
    }
}
