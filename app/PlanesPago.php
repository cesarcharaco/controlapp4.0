<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanesPago extends Model
{
    protected $table='planes_pago';

	protected $fillable=['nombre','monto','dias','nombre_img','url_img','color','tipo','status'];

	public function promocion()
  	{
  		return $this->hasMany('App\Promociones','id_planP','id');
  	}

  	public function anuncios() {
    	return $this->belongsToMany('App\Anuncios','empresas_has_anuncios','id_planP','id_anuncios')->withPivot('referencia','status');
    }

    public function pagos_has_alquiler()
    {
        return $this->hasMany('App\PagosAlquiler','id_planesPago','id');
    }
}
