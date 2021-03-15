<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unid extends Model
{
    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable =
    [
        'numero_serie', 'estado', 'notas',
    ];

    public function producto()
    {
        return $this->belongsTo('App\Producto');
    }

    public function albaran()
    {
        return $this->belongsTo('App\Albaran'); 
    }
}
