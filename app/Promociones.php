<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promociones extends Model
{
    protected $table='promociones';

    protected $fillable=['duracion','porcentaje','id_planP','status'];

	public function planP()
	  	{
	  		return $this->belongsTo('App\PlanesPago','id_planP','id');
	  	}
	}
