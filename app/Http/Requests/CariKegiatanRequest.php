<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CariKegiatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id_jenis' => 'nullable|exists:jenis,id',
            'durasi' => 'nullable|numeric|min:1',
            'from' => 'nullable|date',
            'to' => 'nullable|date'
        ];
    }
}
