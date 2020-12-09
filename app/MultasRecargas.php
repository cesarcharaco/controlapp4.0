<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultasRecargas extends Model
{
    protected $table='multas_recargas';

    protected $fillable=['motivo','observacion','monto','tipo','anio','id_admin'];

    public function residentes()
    {
    	return $this->belongsToMany('App\Residentes','resi_has_mr','id_mr','id_residente')->withPivot('referencia','status','tipo_pago');
    }

    public function admin()
    {
    	return $this->belongsTo('App\UsersAdmin','id_admin');
    }
}
