<?php

namespace App\Http\Requests;

use App\Rules\Base64ImageRule;
use Illuminate\Foundation\Http\FormRequest;

class ArtWorkSaveRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_price' => 'required|numeric|gt:0',
            'estimated_market_price' => 'required|numeric|gt:0',
            'artist_id' => 'required|exists:artists,id|integer',
            'status' => 'required|in:1,0',
            'images.*' => [
                'sometimes',
                new Base64ImageRule($this->all())
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Eser Adı',
            'description' => 'Açıklama',
            'start_price' => 'Başlangıç Fiyatı',
            'status' => 'Durum',
            'artist_id' => 'Sanatçı',
            'estimated_market_price' => 'Tahmini Piyasa Değeri',
        ];
    }
}
