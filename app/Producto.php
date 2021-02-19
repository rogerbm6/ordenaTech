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
      'nombre', 'part_number', 'cantidad_minima', 'incidencia', 'marca', 'modelo', 'ubicacion', 'notas',
  ];

  public function cliente()
  {
    return $this->belongsTo('App\Cliente');
  }
  public function almacene()
  {
    return $this->belongsTo('App\Almacene');
  }

  public function unids()
  {
      return $this->hasMany('App\Unid');
  }
}
