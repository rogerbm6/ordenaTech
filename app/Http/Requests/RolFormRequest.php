<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolFormRequest extends FormRequest
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
        'name'              => 'required|max:32|min:4',
        'slug'              => 'required|max:32|min:4',
        'description'       => 'required|max:1000',
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
