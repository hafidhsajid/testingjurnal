<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
        'nim'=>'required|max:10',
        'nama'=>'required',
        'tempat_lahir'=>'required',
        'tanggal_lahir'=>'required',
        'alamat'=>'required',
        'alamat_solo'=>'required',
        'prodis_id'=>'required|exists:prodis,id',
        'fakultas_id'=>'required|exists:fakultas,id',
        'angkatan'=>'required',
        'deskripsi'=>'required',
        'headline'=>'required'
        ];
    }
}
