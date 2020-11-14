<?php





function apellido()
{
	$apellido="";
	if (\Auth::user()->tipo_usuario == 'Residente') {
		$apellido_resi=\DB::table('residentes')
		->where('id_usuario',\Auth::user()->id)
		->select('residentes.apellidos')
		->first();

		$apellido=$apellido_resi->apellidos;

		return $apellido;
	}else{
		return 0;
	}
}
function id_admin($email)
{
	$id=0;
	$admin=\App\UsersAdmin::where('email',$email)->first();
	if (!is_null($admin)) {
		$id=$admin->id;
	}
	
	return $id;
}
function alquilados_i_t()
{
	$id_admin=id_admin(\Auth::user()->email);
	$buscar=\DB::table('residentes_has_inmuebles')
	->join('residentes','residentes.id','=','residentes_has_inmuebles.id_residente')
	->where('residentes.id_admin',$id_admin)
	->where('status','En Uso')->select('*')->get();

	return count($buscar);
	
}
function alquilados_i_p()
{
	$id_admin=id_admin(\Auth::user()->email);

	$buscar=\DB::table('residentes_has_inmuebles')
	->join('residentes','residentes.id','=','residentes_has_inmuebles.id_residente')
	->where('residentes.id_admin',$id_admin)
	->where('status','En Uso')
	->select('*')->get();

	if (existencia_i()>0) {
		$porcentaje=(count($buscar)*100)/existencia_i();
	} else {
		$porcentaje=0;
	}
	
	return $porcentaje=number_format($porcentaje, 2, '.', '');
}

function existencia_i()
{
	$id_admin=id_admin(\Auth::user()->email);

	$buscar=\DB::table('inmuebles')
	->where('id_admin',$id_admin)
	->select('*')->get();

	return count($buscar);
}

function alquilados_e_t()
{
	$id_admin=id_admin(\Auth::user()->email);

	$buscar=\DB::table('estacionamientos')
	->where('id_admin',$id_admin)
	->where('status','Ocupado')
	->select('*')->get();

	return count($buscar);
}

function alquilados_e_p()
{
	$id_admin=id_admin(\Auth::user()->email);

	$buscar=\DB::table('estacionamientos')
	->where('id_admin',$id_admin)
	->where('status','Ocupado')
	->select('*')->get();

	if (existencia_e()>0) {
		$porcentaje=(count($buscar)*100)/existencia_e();
	} else {
		$porcentaje=0;
	}
	
	return $porcentaje=number_format($porcentaje, 2, '.', '');
}

function existencia_e()
{
	$id_admin=id_admin(\Auth::user()->email);
	$buscar=\DB::table('estacionamientos')->where('id_admin',$id_admin)->select('*')->get();

	return count($buscar);
}

function residentes()
{
	$id_admin=id_admin(\Auth::user()->email);
	$buscar=\App\Residentes::where('id_admin',$id_admin)->get();

	return count($buscar);
}

function residentes_alquilados_i()
{
	$cont=0;
	$id_admin=id_admin(\Auth::user()->email);
	$buscar=\App\Residentes::where('id_admin',$id_admin)->get();
	foreach ($buscar as $key) {
		$c=0;
		foreach ($key->inmuebles as $key2) {
			if ($key2->pivot->status=="En Uso") {
				$c++;
			}
			
		}

		if($c>0){
			$cont++;
		}
	}
	return $cont;
}

function residentes_alquilados_e()
{
	$cont=0;
	$id_admin=id_admin(\Auth::user()->email);
	$buscar=\App\Residentes::where('id_admin',$id_admin)->get();
	foreach ($buscar as $key) {
		$c=0;
		foreach ($key->estacionamientos as $key2) {
			if ($key2->pivot->status=="En Uso") {
				$c++;
			}
		}

		if($c>0){
			$cont++;
		}
	}

	return $cont;
}

function residentes_alquilados_p()
{
	$cont=0;
	$id_admin=id_admin(\Auth::user()->email);
	$buscar=\App\Residentes::where('id_admin',$id_admin)->get();

	foreach ($buscar as $key) {
		$c1=0;
		foreach ($key->inmuebles as $key2) {
			if ($key2->pivot->status=="En Uso") {
				$c1++;
			}
		}


		$c2=0;
		foreach ($key->estacionamientos as $key2) {
			if ($key2->pivot->status=="En Uso") {
				$c2++;
			}
		}

		if($c1>0 || $c2>0){
			$cont++;
		}
	}
	if (count($buscar)>0) {
		$porcentaje=($cont*100)/count($buscar);
	} else {
		$porcentaje=0;
	}

	return $porcentaje=number_format($porcentaje, 2, '.', '');
}

 function buscar_notificacion($id_residente,$id_notificacion)
{
	$buscar=\DB::table('resi_has_notif')
	->where('id_residente',$id_residente)
	->where('id_notificacion',$id_notificacion)
	->select('*')->get();

	return count($buscar);
}

function pc_i()
{
	$anio=date('Y');
	$id_admin=id_admin(\Auth::user()->email);
	$buscar=App\PagosComunes::where('anio',$anio)->where('id_admin',$id_admin)->where('tipo','Inmueble')->get();

	return count($buscar);
}

function pc_e()
{
	$anio=date('Y');
	$id_admin=id_admin(\Auth::user()->email);
	$buscar=App\PagosComunes::where('anio',$anio)->where('id_admin',$id_admin)->where('tipo','Estacionamiento')->get();

	return count($buscar);
}

function meses($num_mes)
{
	switch ($num_mes) {
		case 1:
			return "Enero";
			break;
		case 2:
			return "Febrero";
			break;
		case 3:
			return "Marzo";
			break;
		case 4:
			return "Abril";
			break;
		case 5:
			return "Mayo";
			break;
		case 6:
			return "Junio";
			break;
		case 7:
			return "Julio";
			break;
		case 8:
			return "Agosto";
			break;
		case 9:
			return "Septiembre";
			break;
		case 10:
			return "Octubre";
			break;
		case 11:
			return "Noviembre";
			break;
		case 12:
			return "Diciembre";
			break;
	}
}

function inmuebles_asig($id_residente)
{
	$mostrar="";

	$residente=App\Residentes::find($id_residente);
	if (!is_null($residente)) {
		foreach ($residente->inmuebles as $key) {
			if($key->pivot->status=="En Uso"){
				$mostrar.=$key->idem."\n";
			}
		}
	}
	

	return $mostrar;
}
function estacionamientos_asig($id_residente)
{
	$mostrar="";

	$residente=App\Residentes::find($id_residente);
	if (!is_null($residente)) {
		foreach ($residente->estacionamientos as $key) {
			if($key->pivot->status=="En Uso"){
				$mostrar.=$key->idem."\n";
			}
		}
	}
	

	return $mostrar;
}
function gasto_comun_mes($mes,$id_residente,$anio)
{
	
	$cont=0;
	$cont2=0;
	$residente=App\Residentes::find($id_residente);
	if (!is_null($residente)) {
		foreach ($residente->inmuebles as $key) {
			if($key->pivot->status=="En Uso"){
				$cont++;
			}
		}

		foreach ($residente->estacionamientos as $key) {
			if($key->pivot->status=="Ocupado"){
				$cont2++;
			}
		}
	}
	
	$total=0;
	$id_admin=id_admin(\Auth::user()->email);
	$monto_i=App\PagosComunes::where('anio',$anio)->where('mes',$mes)->where('tipo','Inmueble')->where('id_admin',$id_admin)->first();
	if(!is_null($monto_i)){
		$total+=($cont*$monto_i->monto);
	}
	$monto_e=App\PagosComunes::where('anio',$anio)->where('mes',$mes)->where('id_admin',$id_admin)->where('tipo','Estacionamiento')->first();
	if(!is_null($monto_e)){
	$total+=($cont2*$monto_i->monto);
	}
	return $total;


}

function status_gastos_i($mes,$id_residente,$anio)
{
	$inmueble="";
	$residente=App\Residentes::find($id_residente);
	if (!is_null($residente)) {
		foreach ($residente->inmuebles as $key) {
	        if ($key->pivot->status=="En Uso") {
	        	$inmueble.=$key->idem.": ";
	        	foreach ($key->mensualidades as $key2) {
		            if($key2->mes==$mes && $key2->anio==$anio){
		                $pago=\App\Pagos::where('id_mensualidad',$key2->id)->orderby('id','DESC')->first();
		                    $inmueble.=$pago->status." \n ";
		                
		            }
		        }	
	        }
	        
	        
	    }
	}
	
	return $inmueble;
}

function status_gastos_e($mes,$id_residente,$anio)
{
	$estacionamiento="";
	$residente=App\Residentes::find($id_residente);
	
	if (!is_null($residente)) {
	    foreach ($residente->estacionamientos as $key) {
	    	if ($key->pivot->status=="En Uso") {
		        $estacionamiento.=$key->idem.": ";
		        foreach ($key->mensualidad as $key2) {
		            if($key2->mes==$mes && $key2->anio==$anio){
		            	$pago=\App\PagosE::where('id_mens_estac',$key2->id)->orderby('id','DESC')->first();
		                
		                    $estacionamiento.=$pago->status." \n ";
		                
		            }
		        }
	    	}
	    }
	}

    return $estacionamiento;
}

function montos_mr($mes,$id_residente,$anio)
{
	$total=0;
	$residente=App\Residentes::find($id_residente);
	if (!is_null($residente)) {
		foreach ($residente->mr as $key) {
			if($key->pivot->mes==$mes && $key->anio==$anio){
				$total+=$key->monto;
			}
		}
	}
	
	return $total;
}
function status_montos_mr($mes,$id_residente,$anio)
{
$enviada=0;
$pagada=0;
$por_confirmar=0;
$resumen="";
	$residente=App\Residentes::find($id_residente);
	if (!is_null($residente)) {
		foreach ($residente->mr as $key) {
			if($key->pivot->mes==$mes && $key->anio==$anio){
				switch ($key->pivot->status) {
				case 'Enviada':
					$enviada++;
					break;
				case 'Pagada':
					$pagada++;
					break;
				case 'Por Confirmar':
					$por_confirmar++;
					break;
				
				default:
					# code...
					break;
			}			
			}
		}
	}
	
	$resumen='Enviada: '.$enviada.' | Pagada: '.$pagada.' | Por Confirmar: '.$por_confirmar;
	return $resumen;
}

function alquiler_i($mes,$id_inmueble,$anio)
{
	$estado="";
	$buscar=App\Inmuebles::find($id_inmueble);
	if($buscar->status=="No Disponible"){
		foreach ($buscar->mensualidades as $key) {
			if ($key->mes==$mes && $key->anio==$anio) {
				foreach ($key->pago as $key2) {
					$estado=$key2->status;
				}
			}
			
		}
	}

	return $estado;
}

function alquiler_e($mes,$id_estacionamiento,$anio)
{
	$estado="";
	$buscar=App\Estacionamientos::find($id_estacionamiento);
	if($buscar->status=="Ocupado"){
		foreach ($buscar->mensualidad as $key) {
			if ($key->mes==$mes && $key->anio==$anio) {
				/*foreach ($key->pago as $key2) {
					$estado=$key2->status;
				}*/
				$pago=\App\PagosE::where('id_mens_estac',$key->id)->orderby('id','DESC')->first();
				$estado=$pago->status;
			}
			
		}
	}

	return $estado;
}

function mostrar_resi_has_notif($id_notificacion)
{
	$id_admin=id_admin(\Auth::user()->email);
	$notificacion=\App\Notificaciones::find($id_notificacion);
	$texto="";
	$cont=0;
	$residentes=\App\Residentes::where('id_admin',$id_admin)->get();
	$tr=count($residentes);

	foreach ($notificacion->residentes as $key) {
		
		// $texto=  $key->apellidos.", ".$key->nombres." | RUT: ".$key->rut;
		$cont++;
	}

	if($cont==$tr){
		$texto="Todos los Residentes";
	}else{
		echo("<li>" .$key->apellidos.", ".$key->nombres." | RUT: ".$key->rut."</li>");
	}

	return $texto;
}

function mi_admin($id_usuario)
{
	$buscar=\App\Residentes::where('id_usuario',$id_usuario)->first();

	return $buscar->id_admin;
}

function anios_registros()
{

	$anio=date('Y');
	$buscar=App\PagosComunes::select('anio',\DB::raw('anio'))->where('anio','<=',$anio)->groupBy('anio')->orderBy('id','DESC')->get();


	return $buscar;

}

function buscar_pasarelas()
{
	if(\Auth::User()->tipo_usuario=="Residente") {
		$buscar_pasarelas ="";
		$id_admin = \App\Residentes::join('users','users.id','=','residentes.id_usuario')
	        ->where('users.id',\Auth::User()->id)->get();
	        foreach ($id_admin as $key) {
	            $id_admin = $key->id_admin;
	        }
	    //dd($id_admin);
	    $buscar_pasarelas=\App\AdminsPasarelas::join('users_admin','users_admin.id','=','admins_has_pasarelas.id_admin')
	    ->join('residentes','residentes.id_admin','=','users_admin.id')
	    ->where('residentes.id_admin',$id_admin)
	    ->select('admins_has_pasarelas.*')
	    ->get();
	    $contar = count($buscar_pasarelas);

	    $num=0;
	    if ($contar==0) {
	    	$buscar_pasarelas = "Admin no posee pasarelas de pago registradas";
	    	return $buscar_pasarelas;
	    } else {
		    foreach ($buscar_pasarelas as $key) {
		    	if ($key->pasarelas->pasarela == 'Flow' && $num == 0) {
		    		echo ("<center><b>Pagar con " .$key->pasarelas->pasarela."</b> <input type='checkbox' onclick='FlowCheck()' name='flow' value='".$key->pasarelas->id."' id='checkFlow'></center><br>");
		    		$num++;
		    	}
		    }
	    }
			
	}
}

function contar_buscar_pasarelas()
{
	if(\Auth::User()->tipo_usuario=="Residente") {

		$id_admin = \App\Residentes::join('users','users.id','=','residentes.id_usuario')
	        ->where('users.id',\Auth::User()->id)->get();
	        foreach ($id_admin as $key) {
	            $id_admin = $key->id_admin;
	        }
	    //dd($id_admin);
	    $contar_buscar_pasarelas=\App\AdminsPasarelas::join('users_admin','users_admin.id','=','admins_has_pasarelas.id_admin')
	    ->join('residentes','residentes.id_admin','=','users_admin.id')
	    ->where('residentes.id_admin',$id_admin)
	    ->select('admins_has_pasarelas.*')
	    ->count();
		
		return $contar_buscar_pasarelas;
	}
}