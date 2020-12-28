<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagosAlquiler extends Model
{
    protected $table='pagos_has_alquiler';

	protected $fillable=['id','referencia','monto','id_alquiler','id_planesPago','status'];

	public function alquiler()
	{
	  	return $this->belongsTo('App\Alquiler','id_alquiler','id');
	}
	public function planes_pago()
	{
	  	return $this->belongsTo('App\PlanesPago','id_planesPago','id');
	}
}
