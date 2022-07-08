<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * UNTUK MEMBUAT VALIDASI CONTROLLER TANPA MEMBUAT VALIDASI DI TIAP FUNCTIONNYA
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
            'name' => 'required|string',
            'status' => '',
            'alt' => 'string',
            'photo' => 'required|image',
        ];
    }
}
