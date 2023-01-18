<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'start_price' => 'required|numeric|lt:end_price',
            'end_price' => 'required|numeric|gt:start_price',
            'min_bid_amount' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'start_price' => 'Başlangıç Fiyatı',
            'end_price' => 'Bitiş Fiyatı',
            'min_bid_amount' => 'Minimum Teklif Miktarı',
        ];
    }
}
