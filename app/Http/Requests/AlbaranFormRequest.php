<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbaranFormRequest extends FormRequest
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
            'referencia'            => 'required|max:45',
            'ruta'                  => 'mimes:jpeg,png,jpg,gif,pdf|max:2048|required'
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
            'required'      => 'Es necesario rellenar el campo :attribute',
            'ruta.mimes'    => 'El campo :attribute solo puede ser de tipos jpeg,png,jpg,gif',
            'ruta.max'      => 'El campo :attribute solo puede ser una imagen de :max',
        ];
    }
}
