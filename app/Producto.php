<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable =
  [
      'nombre', 'numero_serie', 'marca', 'modelo', 'ubicacion', 'estado', 'cantidad', 'notas',
  ];

  public function cliente()
  {
    return $this->belongsTo('App\Cliente');
  }
  public function almacene()
  {
    return $this->belongsTo('App\Almacene');
  }
}
