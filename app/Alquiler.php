<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    protected $table='alquiler';

    protected $fillable=['id_residente','id_instalacion','tipo_alquiler','fecha','hora','num_personas','num_horas','status'];

    public function residente()
    {
    	return $this->belongsTo('App\Residentes','id_residente');
    }

    public function instalacion()
    {
    	return $this->belongsTo('App\Instalaciones','id_instalacion');
    }

    public function pagos_has_alquiler()
    {
        return $this->hasMany('App\PagosAlquiler','id_alquiler','id');
    }
}
