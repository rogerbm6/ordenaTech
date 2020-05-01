<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable =
  [
      'nombre', 'telefono', 'tipo',
  ];


  public function productos()
  {
    return $this->hasMany('App\Producto');
  }
}
