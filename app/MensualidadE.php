<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MensualidadE extends Model
{
    protected $table='mens_estac';

    protected $fillable=['id_estacionamiento','mes','anio','monto'];

    public function estacionamientos()
    {
    	return $this->belongsTo('App\Estacionamientos','id_estacionamiento');
    }

    public function pago()
	{
		return $this->hasMany('App\PagosE','id_mens_estac','id');
	}
}
