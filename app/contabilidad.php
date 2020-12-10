<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contabilidad extends Model
{
    protected $table='contabilidad';

    protected $fillable=['id_admin','id_mes','referencia','descripcion','ingreso','egreso','created_at'];

    public function admin()
    {
    	return $this->belongsTo('App\UsersAdmin','id_admin');
    }
}
