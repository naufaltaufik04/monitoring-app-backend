<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TambahKegiatanRequest extends FormRequest
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
            'id_jenis' => 'required|exists:jenis,id',
            'keterangan' => 'string',
            'durasi' => 'required|numeric|min:1',
            'berat_badan' => 'required|numeric|min:1',
            'tanggal' => 'required'
        ];
    }
}
