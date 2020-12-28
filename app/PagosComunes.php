<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagosComunes extends Model
{
    protected $table='pagos_comunes';

    protected $fillable=['tipo','mes','anio','monto','id_admin'];

    public function admin()
    {
    	return $this->belongsTo('App\UsersAdmin','id_admin');
    }
}
