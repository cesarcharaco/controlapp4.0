<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportes extends Model
{
    protected $table='reportes_pagos';

    protected $fillable=['referencia','reporte','id_residente'];

    public function residentes()
    {
    	return $this->belongsTo('App\Residentes','id_residente');
    }
}
