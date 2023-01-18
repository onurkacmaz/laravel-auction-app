<?php

namespace App\Http\Requests;

use App\Rules\MinimumBidRule;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class BiddingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'bid_amount' => [
                'required',
                'numeric',
                new MinimumBidRule($this->route('id'))
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'bid_amount' => 'Pey Değeri'
        ];
    }

    public function messages(): array
    {
        return [
            'bid_amount.required' => ':attribute girmelisiniz.',
            'bid_amount.numeric' => ':attribute geçerli bir değer değil.'
        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException("Pey verebilmek için öncelikle giriş yapmalısınız.");
    }
}
