<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanesAnuncios extends Model
{
    protected $table='planes_has_anuncios';

	protected $fillable=['id','id_anuncios','id_planP','fecha_orden','fecha_termino','status'];

	public function pagos_anuncios()
	{
		return $this->hasMany('App\PagosAnuncios','id_planesA','id');
	}
}
