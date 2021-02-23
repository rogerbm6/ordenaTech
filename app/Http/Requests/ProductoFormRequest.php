<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoFormRequest extends FormRequest
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
        'marca'             => 'required|max:12|min:4',
        'modelo'            => 'required|max:35|min:4',
        'ubicacion'         => 'required|max:70|min:7',
        'notas'             => 'required|max:1000',
        'almacen'           => 'required|int',
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
          'cantidad.min'    => 'El campo :attribute tiene como minimo :min',
          'int'             => 'El campo :attribute debe ser entero',
      ];
  }
}
