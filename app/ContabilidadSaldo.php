<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContabilidadSaldo extends Model
{
    protected $table='contabilidad_saldo';

    protected $fillable=['id_admin','saldo'];

    public function admin()
    {
    	return $this->belongsTo('App\UsersAdmin','id_admin');
    }
}
