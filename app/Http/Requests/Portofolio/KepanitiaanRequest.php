<?php

namespace App\Http\Requests\Portofolio;

use Illuminate\Foundation\Http\FormRequest;

class KepanitiaanRequest extends FormRequest
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
        'users_id'=>'required|exists:users,id',
        'penyelenggara'=>'required',
        'nama_jabatan'=>'required',
        'divisi'=>'required',
        'waktu_mulai'=>'required|date',
        'waktu_selesai'=>'date',
        'lokasi'=>'required',
        'deskripsi'=>'required'
        ];
    }
}
