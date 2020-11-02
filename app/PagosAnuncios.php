<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagosAnuncios extends Model
{
    protected $table='pagos_anuncios';

	protected $fillable=['referencia','monto','id_planesA'];

	public function planes_anuncio()
	{
		return $this->belongsTo('App\PlanesAnuncios','id_planesA','id');
	}
}