<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminsPasarelas extends Model
{
    protected $table='admins_has_pasarelas';

    protected $fillable=['id_pasarela','id_admin','link_pasarela'];

   public function users_admin()
	{
		return $this->belongsTo('App\UsersAdmin','id_admin','id');
	}

	public function pasarelas()
	{
		return $this->belongsTo('App\Pasarelas','id_pasarela','id');
	}
}
