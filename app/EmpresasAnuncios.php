<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresasAnuncios extends Model
{
    protected $table='planes_has_anuncios';

    protected $fillable=['id_anuncio','id_planP','fecha_orden','fecha_termino','status'];

	public function anuncios()
	{
	  	return $this->belongsTo('App\Anuncios','id_anuncios','id');
	}

	public function planP()
	{
		return $this->belongsTo('App\PlanesPago','id_planP','id');
	}

	public function pagos_anuncios()
	{
		return $this->hasMany('App\PagosAnuncios','id_planesA','id');
	}
}
