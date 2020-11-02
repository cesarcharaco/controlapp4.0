<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    protected $table='noticias';

	protected $fillable=['titulo','contenido','id_admin'];

	public function admin()
    {
    	return $this->belongsTo('App\UsersAdmin','id_admin');
    }
}
