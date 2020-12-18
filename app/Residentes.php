<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residentes extends Model
{
	protected $table='residentes';

	protected $fillable=['id','nombres','apellidos','rut','telefono','id_usuario','id_admin'];

	public function usuario()
	{
		return $this->belongsTo('App\User','id_usuario');
	}

	public function inmuebles()
	{
		return $this->belongsToMany('App\Inmuebles','residentes_has_inmuebles','id_residente','id_inmueble')->withPivot('status');
	}

	public function estacionamientos()
	{
		return $this->belongsToMany('App\Estacionamientos','residentes_has_est','id_residente','id_estacionamiento')->withPivot('status');
	}

	public function mr()
    {
    	return $this->belongsToMany('App\MultasRecargas','resi_has_mr','id_residente','id_mr')->withPivot('referencia','status','mes','tipo_pago');
    }

    public function notificaciones()
    {
    	return $this->belongsToMany('App\Notificaciones','resi_has_notif','id_residente','id_notificacion')->withPivot('status');
    }

    public function reportes()
    {
    	return $this->hasMany('App\Reportes','id_residente','id');
    }

    public function admin()
    {
    	return $this->belongsTo('App\UsersAdmin','id_admin');
    }

    public function alquiler()
    {
    	return $this->hasMany('App\Alquiler','id_residente','id');
    }
}