<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacene extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable =
  [
      'nombre', 'direccion', 'cp', 'isla', 'email',
  ];

  public function productos()
  {
    return $this->hasMany('App\Producto');
  }
}
