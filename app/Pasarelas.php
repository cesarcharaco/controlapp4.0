<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasarelas extends Model
{
    protected $table='pasarelas';

    protected $fillable=['pasarela','link_pasarela'];

    public function admins()
    {
    	return $this->belongsToMany('App\UsersAdmin','admins_has_pasarelas','id_pasarela','id_admin');
    }
}
