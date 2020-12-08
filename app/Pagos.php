<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $table='pagos';

	protected $fillable=['id','id_mensualidad','status','referencia','tipo_pago'];

	public function mensualidad()
	{
		return $this->belongsTo('App\Mensualidades','id_mensualidad');
	}

	public function referencias()
	{
		return $this->hasMany('App\Referencias','id_pago','id');
	}
}
