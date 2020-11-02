<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncios extends Model
{
    protected $table='anuncios';

    protected $fillable=['titulo','link','descripcion','nombre_img','url_img','id_empresa'];

    public function admins() {
    	return $this->belongsToMany('App\UsersAdmin','admins_has_anuncios','id_users_admin','id_anuncios');
    }

    public function admin()
    {
    	return $this->belongsTo('App\Empresas','id_empresa','id');
    }

    public function planP() {
    	return $this->belongsToMany('App\PlanesPago','planes_has_anuncios','id_planP','id_anuncios')->withPivot('referencia','status');
    }

}
