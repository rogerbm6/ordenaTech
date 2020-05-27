<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteFormRequest extends FormRequest
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
        return
        [
          'nombre'            => 'required|max:45|min:4',
          'telefono'          => 'required|max:12|min:9',
          'direccion'         => 'required|max:60|min:9',
          'tipo'              => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return
        [
            'required'        => 'Es necesario rellenar el campo :attribute',
            'max'             => 'El campo :attribute tiene como maximo :max caracteres',
            'min'             => 'El campo :attribute tiene como minimo :min caracteres',
        ];
    }
}
