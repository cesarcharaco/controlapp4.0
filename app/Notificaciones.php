<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    protected $table='notificaciones';
	protected $fillable=['titulo','motivo','publicar','id_admin'];

	public function residentes()
    {
    	return $this->belongsToMany('App\Residentes','resi_has_notif','id_notificacion','id_residente')->withPivot('status');
    }

    public function admin()
    {
    	return $this->belongsTo('App\UsersAdmin','id_admin');
    }
}
