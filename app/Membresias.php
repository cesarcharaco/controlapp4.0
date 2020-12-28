<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membresias extends Model
{
    protected $table='membresias';

    protected $fillable=['url_imagen','nombre','cant_inmuebles','monto'];

    public function admins()
    {
    	return $this->hasOne('App\UsersAdmin','id_membresia','id');
    }
}
