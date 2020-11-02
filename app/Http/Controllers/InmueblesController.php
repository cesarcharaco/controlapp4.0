<?php

namespace App\Http\Controllers;

use App\Inmuebles;
use Illuminate\Http\Request;
use App\Meses;
use App\Mensualidades;
use App\Estacionamientos;
use App\PagosComunes;
use App\Pagos;
use App\UsersAdmin;
class InmueblesController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
        $id_admin=id_admin(\Auth::user()->email);
		$inmuebles=Inmuebles::where('id_admin',$id_admin)->orderBy('idem','ASC')->get();;
		$meses=Meses::all();
		$estacionamientos=estacionamientos::where('status','Libre')->where('id_admin',$id_admin)->orderBy('idem','ASC')->get();;

		return view('inmuebles.index',compact('inmuebles','meses','estacionamientos'));
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
	
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param \Illuminate\Http\Request $request

	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		// dd($request->all());
        $id_admin=id_admin(\Auth::user()->email);
        
		$buscar=Inmuebles::where('idem',$request->idem)->where('id_admin',$id_admin)->get();
		//dd(count($buscar));
        $meses=Meses::all();
		if (count($buscar)>0) {
            toastr()->warning('intente otra vez!!', 'El Idem ya se encuentra registrado');
			return redirect()->back();
		} else {
			
            $anio=date('Y');
            $mensualidad=PagosComunes::where('anio',$anio)->where('tipo','Inmueble')->where('id_admin',$id_admin)->get();
            //dd(count($mensualidad));
            if (count($mensualidad)==0) {
                toastr()->warning('intente otra vez!!', 'No existen Pagos Comunes registrados para el presente año');
                return redirect()->back();
            } else {
                $cant_inmuebles = Inmuebles::where('id_admin',\Auth::User()->id)->count();
                $membresia_activa = UsersAdmin::where('email',\Auth::user()->email)->first();
                $count_membresia = $membresia_activa->membresia->cant_inmuebles;
                //dd($count_membresia);
                if ($cant_inmuebles >= $count_membresia) {
                    toastr()->warning('Error!!', 'Excede el límite de cantidad de inmuebles registrado que poseé su membresía');
                    return redirect()->back();
                } else {
                    $inmueble=new Inmuebles();
                    $inmueble->idem=$request->idem;
                    $inmueble->tipo=$request->tipo;
                    $inmueble->status='Disponible';
                    $inmueble->estacionamiento=$request->estacionamiento;
                    if ($request->estacionamiento=="Si") {
                        $inmueble->cuantos=$request->cuantos;
                    }
                    $inmueble->id_admin=$id_admin;
                    $inmueble->save();

                    foreach ($mensualidad as $key) {
                        $reg=new Mensualidades();
                        $reg->id_inmueble=$inmueble->id;
                        $reg->mes= $key->mes;
                        $reg->anio= $key->anio;
                        $reg->monto= $key->monto;
                        $reg->save();
                    }
                    //buscando pagos en años siguientes al actual
                    $anio_sig=$anio+1;
                    $mens_sig=PagosComunes::where('anio',$anio_sig)->where('tipo','Inmueble')->where('id_admin',$id_admin)->get();
                    $encontrado=count($mens_sig);
                    while ($encontrado > 0) {
                        foreach ($mens_sig as $key) {
                            $reg=new Mensualidades();
                            $reg->id_inmueble=$inmueble->id;
                            $reg->mes= $key->mes;
                            $reg->anio= $key->anio;
                            $reg->monto= $key->monto;
                            $reg->save();
                        }
                        $anio_sig++;
                        $mens_sig=PagosComunes::where('anio',$anio_sig)->where('tipo','Inmueble')->where('id_admin',$id_admin)->get();
                        $encontrado=count($mens_sig);

                    }
                    //-----------fin de buscar pagos en años siguientes
                    # code...
                }
                
            }
            

            /*
			$m=date('m');*/
			/*if ($request->opcion==1) {
                # mensual
                if ($this->nulidad($request->monto)) {
                    flash('Debe agregar todos los montos en los meses indicados, intente otra vez!')->warning()->important();
                    return redirect()->back();    
                } else {
                    
                    $i=0;
                    foreach ($meses as $key) {
                        if($key->id>=$m){
                        $mensualidad=new Mensualidades();
                        $mensualidad->id_inmueble=$inmueble->id;
                        $mensualidad->anio=$request->anio;
                        $mensualidad->mes=$key->id;
                        $mensualidad->monto=$request->monto[$i];
                        $mensualidad->save();
                        $i++;
                        }
                    }
                }//nulidad
            } else {
                # anual
                foreach ($meses as $key) {
                    if($key->id>=$m){
                        $mensualidad=new Mensualidades();
                        $mensualidad->id_inmueble=$inmueble->id;
                        $mensualidad->anio=$request->anio;
                        $mensualidad->mes=$key->id;
                        $mensualidad->monto=$request->montoAnio;
                        $mensualidad->save();
                    }
                }
                
            }*/
            toastr()->success('con éxito!!', 'Inmueble registrado');
			return redirect()->to('inmuebles');
		}

	}

	/**
	* Display the specified resource.
	*
	* @param \App\Inmuebles $inmuebles
	* @return \Illuminate\Http\Response
	*/
	public function show(Inmuebles $inmuebles)
	{
	
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param \App\Inmuebles $inmuebles
	* @return \Illuminate\Http\Response

	*/
	public function edit($id_inmueble)
	{
	
	}

	public function buscar_mensualidad($id, $anio)
    {
        return Mensualidades::where('id_inmueble', $id)->where('anio',$anio)->get();
    }

    public function buscar_anios($id)
    {
        //return Mensualidades::where('id_inmueble', $id)->groupBy('anio')->get();
        return 
        \DB::table('residentes')
        ->join('residentes_has_inmuebles','residentes_has_inmuebles.id_residente','=','residentes.id')
        ->join('inmuebles','inmuebles.id','=','residentes_has_inmuebles.id_inmueble')
        ->join('mensualidades','mensualidades.id_inmueble','=','inmuebles.id')
        ->join('pagos','pagos.id_mensualidad','=','mensualidades.id')
        ->where('residentes.id', $id)
        ->where('residentes_has_inmuebles.status','En Uso')
        ->select('mensualidades.anio')
        ->groupBy('mensualidades.anio')
        ->get();
    }

	/**
	* Update the specified resource in storage.
	*
	* @param \Illuminate\Http\Request $request
	* @param \App\Inmuebles $inmuebles
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $id_inmueble)
	{
		//dd($request->all());
        $id_admin=id_admin(\Auth::user()->email);
        
		$buscar=Inmuebles::where('idem',$request->idem)->where('id','<>',$request->id)->where('id_admin',$id_admin)->get();
		if (count($buscar)>0) {
            toastr()->warning('intente otra vez!!', 'Ya hay un inmueble registrado con ese idem');
			return redirect()->back();
		} else {
			$inmueble=Inmuebles::find($request->id);
			$inmueble->idem=$request->idem;
			$inmueble->tipo=$request->tipo;
			$inmueble->status=$request->status;
			$inmueble->estacionamiento=$request->estacionamiento;
             if ($request->estacionamiento=="Si") {
                $inmueble->cuantos=$request->cuantos;
            }
            
			$inmueble->save();

			toastr()->success('con éxito!!', 'Inmueble actualizado');
			return redirect()->to('inmuebles');
		}
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param \App\Inmuebles $inmuebles

	* @return \Illuminate\Http\Response
	*/
	public function destroy(Request $request)
	{
		//dd($request->all());
		$meses=Meses::all();
		$inmueble=Inmuebles::find($request->id);

		foreach($meses as $key){
                $mensualidad= Mensualidades::where('id_inmueble',$request->id)->where('mes',$key->id)->first();
                //dd($mensualidad);
                if ($mensualidad!=null) {
                    $pagos=Pagos::where('id_mensualidad',$mensualidad->id)->get();
                    foreach ($pagos as $key2) {
                        $key2->delete();
                    }
                    $mensualidad->delete();
                }
            }
        //dd('-----------------');
		$inmueble->delete();
        toastr()->success('con éxito!!', 'Inmueble eliminado');
		return redirect()->to('inmuebles');

	}

	public function registrar_mensualidad(Request $request)
    {
        //dd('Registrar mensualidad',$request->all());
        $m=date('m');
        $a=date('Y');
        $meses=Meses::all();
        $inmueble=Inmuebles::find($request->id_inmueble);
        if ($request->accion==1) {
                # mensual
            if ($this->nulidad($request->monto)) {
                toastr()->warning('intente otra vez!!', 'Debe agregar todos los montos en los meses indicados');
                    return redirect()->back();    
                } else {
                    $i=0;
                    foreach ($meses as $key) {
                        if($key->id>=$m && $a==$request->anio){
                            $mensualidad=new Mensualidades();
                            $mensualidad->id_inmueble=$request->id_inmueble;
                            $mensualidad->anio=$request->anio;
                            $mensualidad->mes=$key->id;
                            $mensualidad->monto=$request->monto[$i];
                            $mensualidad->save();
                            $i++;
                        }else{

                            $mensualidad=new Mensualidades();
                            $mensualidad->id_inmueble=$request->id_inmueble;
                            $mensualidad->anio=$request->anio;
                            $mensualidad->mes=$key->id;
                            $mensualidad->monto=$request->monto[$i];
                            $mensualidad->save();
                            $i++;
                        }
                    }
                }//nulidad
            } else {
                # anual
                foreach ($meses as $key) {
                    if($key->id>=$m && $a==$request->anio){
                        $mensualidad=new Mensualidades();
                        $mensualidad->id_inmueble=$request->id_inmueble;
                        $mensualidad->anio=$request->anio;
                        $mensualidad->mes=$key->id;
                        $mensualidad->monto=$request->montoaAnio;
                        $mensualidad->save();
                    }else{
                        $mensualidad=new Mensualidades();
                        $mensualidad->id_inmueble=$request->id_inmueble;
                        $mensualidad->anio=$request->anio;
                        $mensualidad->mes=$key->id;
                        $mensualidad->monto=$request->montoaAnio;
                        $mensualidad->save();
                    }
                }
                
            }
            toastr()->success('con éxito!!', 'Mensualidad registrada para el año: '.$request->anio.' en el inmueble: '.$inmueble->idem.'');
            return redirect()->to('inmuebles');
    }
    public function editar_mensualidad(Request $request)
    {
        //dd('Editar mensualidad',$request->all());

        if ($this->nulidad($request->monto)==true && $request->accion==1) {
            toastr()->warning('intente otra vez!!', 'Debe agregar todos los montos en los meses indicados');
                    return redirect()->back();    
                } else {

                $meses=Meses::all();
                $inmueble=Inmuebles::find($request->id_inmueble);
                //eliminando mensualidades

            for($i=0;$i<count($request->mes);$i++){
                    $mensualidad= Mensualidades::where('id_inmueble',$request->id_inmueble)->where('anio',$request->anio)->where('mes',$request->mes[$i])->first();
                    //dd($mensualidad);
                    if ($mensualidad!=null) {
                        
                        $mensualidad->delete();
                    }
                }
            //----------------------
        if ($request->accion==1) {
                # mensual
                
                for($i=0;$i<count($request->mes);$i++) {
                    
                        $mensualidad=new Mensualidades();
                        $mensualidad->id_inmueble=$request->id_inmueble;
                        $mensualidad->anio=$request->anio;
                        $mensualidad->mes=$request->mes[$i];
                        $mensualidad->monto=$request->monto[$i];
                        $mensualidad->save();
                        
                    
                }
            } else {
                # anual
                for($i=0;$i<count($request->mes);$i++){
                   
                        $mensualidad=new Mensualidades();
                        $mensualidad->id_inmueble=$request->id_inmueble;
                        $mensualidad->anio=$request->anio;
                        $mensualidad->mes=$request->mes[$i];
                        $mensualidad->monto=$request->montoaAnio;
                        $mensualidad->save();
                    
                }
                
            }
            toastr()->success('con éxito!!', 'Mensualidad actualizada para el año:'.$request->anio.' en el inmueble:'.$inmueble->idem.'');
            return redirect()->to('inmuebles');
        }
    }
    public function eliminar_mensualidad(Request $request)
    {
        //dd('Eliminar mensualidad',$request->all());
        //eliminando mensualidades
        $inmueble=Inmuebles::find($request->id_inmueble);
        $meses=Meses::all();

            foreach ($meses as $key) {
                    
                    $mensualidad= Mensualidades::where('id_inmueble',$request->id_inmueble)->where('anio',$request->anio)->where('mes',$key->id)->first();
                    //dd($mensualidad);
                    if ($mensualidad!=null) {
                        
                        $mensualidad->delete();
                    }
                    
                    
                }
            //----------------------
                toastr()->success('con éxito!!', 'Mensualidad eliminada para el año:'.$request->anio.' en el inmueble:'.$inmueble->idem.'');
                return redirect()->to('inmuebles');
    }

	protected function nulidad($request)
    {
        $cont=0;
        for ($i=0; $i <count($request) ; $i++) { 
            if ($request[$i]==NULL) {
                $cont++;
            }
        }
        if ($cont>0) {
            return true;
        } else {
            return false;
        }
        
    }

    public function inmuebles_disponibles($id)
    {
        $id_admin=id_admin(\Auth::user()->email);
        return $inmuebles=Inmuebles::where('status','Disponible')->where('id_admin',$id_admin)->get();
    }

    
        
}