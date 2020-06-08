<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlmaceneFormRequest extends FormRequest
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
        'nombre'            => 'required|max:32|min:4',
        'direccion'         => 'required|max:45|min:4',
        'cp'                => 'required|max:12|min:1|int',
        'isla'              => 'required|max:25|min:4',
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
          'cp.min'          => 'El campo :attribute tiene como minimo :min',
          'cp.max'          => 'El campo :attribute tiene como maximo :max',
          'int'             => 'El campo :attribute debe ser entero',
      ];
  }
}
