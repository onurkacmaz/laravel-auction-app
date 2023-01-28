<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtWorkGroupSaveRequest extends FormRequest
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
            'begin' => 'required|numeric|lt:end',
            'end' => 'required|numeric|gt:begin',
            'title' => 'required',
            'order' => 'required|numeric',
        ];
    }

    public function attributes(): array
    {
        return [
            'begin' => 'Başlangıç Fiyatı',
            'end' => 'Bitiş Fiyatı',
            'title' => 'Başlık',
            'order' => 'Sıra',
        ];
    }
}
