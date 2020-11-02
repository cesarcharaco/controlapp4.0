<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contabilidad extends Model
{
    protected $table='contabilidad';

    protected $fillable=['id_mensualidad','id_mes','descripcion','ingreso','egreso','saldo','created_at'];
}
