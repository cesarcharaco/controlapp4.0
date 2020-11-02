<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instalaciones extends Model
{
    protected $table='instalaciones';

    protected $fillable=['nombre','hora_desde','hora_hasta','max_personas','status'];

    public function dias()
    {
    	return $this->belongsToMany('App\Dias','instalaciones_has_dias','id_instalacion','id_dia');
    }
    public function alquiler()
    {
    	return $this->hasMany('App\Alquiler','id_instalacion','id');
    }
}
