<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dias extends Model
{
    protected $table='dias';

	protected $fillable=['dia'];

	public function instalaciones()
    {
    	return $this->belongsToMany('App\Instalaciones','instalaciones_has_dias','id_dia','id_instalacion');
    }
}
