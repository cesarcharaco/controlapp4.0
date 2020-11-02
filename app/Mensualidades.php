<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensualidades extends Model
{
	protected $table='mensualidades';

	protected $fillable=['id_inmueble','mes','anio','monto'];

	public function inmuebles()
	{
		return $this->belongsTo('App\Inmuebles','id_inmueble');
	}

	public function pago()
	{
		return $this->HasMany('App\Pagos','id_mensualidad','id');
	}
}