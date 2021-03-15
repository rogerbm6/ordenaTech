<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albaran extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
    [
        'ruta', 'referencia',
    ];

    public function unids()
    {
        return $this->hasMany('App\Unid');
    }
}
