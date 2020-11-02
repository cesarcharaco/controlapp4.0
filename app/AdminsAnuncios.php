<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminsAnuncios extends Model
{
    protected $table='admins_has_anuncios';

    protected $fillable=['id_users_admin','id_anuncios'];

   public function users_admin()
	{
		return $this->belongsTo('App\UsersAdmin','id_users_admin','id');
	}

	public function anuncios()
	{
		return $this->belongsTo('App\Anuncios','id_anuncios','id');
	}
}
