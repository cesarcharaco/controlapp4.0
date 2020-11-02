<?php

namespace App\Http\Controllers;

use App\Estacionamientos;
use Illuminate\Http\Request;
use App\MensualidadE;
use App\Meses;
use App\Inmuebles;
use App\PagosComunes;
use App\PagosE;
class EstacionamientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_admin=id_admin(\Auth::user()->email);
        $estacionamientos=Estacionamientos::where('id_admin',$id_admin)->orderBy('idem','ASC')->get();
        $meses=Meses::all();

        return view('estacionamientos.index',compact('estacionamientos','meses'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anio=date('Y');
        $meses=Meses::all();

        return view('estacionamientos.meses',compact('anio','meses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $id_admin=id_admin(\Auth::user()->email);
        $buscar=Estacionamientos::where('idem',$request->idem)->where('id_admin',$id_admin)->get();
        $meses=Meses::all();
        if (count($buscar)>0) {
            toastr()->warning('intente otra vez!!', 'El idem ya se encuentra registrado');
            return redirect()->back();
        } else {
            $anio=date('Y');
            $mensualidad=PagosComunes::where('anio',$anio)->where('tipo','Estacionamiento')->where('id_admin',$id_admin)->get();
            if (count($mensualidad)==0) {
                toastr()->warning('Deben registrarse los pagos comunes!!', 'No se encuentran Pagos Comunes registrados para estacionamiento este año');
                return redirect()->back();
            } else {
                $estacionamiento=new Estacionamientos();
                $estacionamiento->idem=$request->idem;
                $estacionamiento->status=$request->status;
                $estacionamiento->id_admin=$id_admin;
                $estacionamiento->save();
                //$m=date('m');
                foreach ($mensualidad as $key) {
                    $reg=new MensualidadE();
                    $reg->id_estacionamiento=$estacionamiento->id;
                    $reg->mes=$key->mes;
                    $reg->anio=$key->anio;
                    $reg->monto=$key->monto;
                    $reg->save();
                }

                //buscando pagos en años siguientes al actual
                $anio_sig=$anio+1;
                $mens_sig=PagosComunes::where('anio',$anio_sig)->where('tipo','Estacionamiento')->where('id_admin',$id_admin)->get();
                $encontrado=count($mens_sig);
                while ($encontrado > 0) {
                    foreach ($mens_sig as $key) {
                        $reg=new MensualidadE();
                        $reg->id_estacionamiento=$estacionamiento->id;
                        $reg->mes= $key->mes;
                        $reg->anio= $key->anio;
                        $reg->monto= $key->monto;
                        $reg->save();
                    }
                    $anio_sig++;
                    $mens_sig=PagosComunes::where('anio',$anio_sig)->where('tipo','Estacionamiento')->where('id_admin',$id_admin)->get();
                    $encontrado=count($mens_sig);

                }
                //-----------fin de buscar pagos en años siguientes
            }
            

            /*if ($request->opcion==1) {
                # mensual
                if ($this->nulidad($request->monto)) {
                    flash('Debe agregar todos los montos en los meses indicados, intente otra vez!')->warning()->important();
                    return redirect()->back();    
                } else {
                    
                $i=0;
                foreach ($meses as $key) {
                    if($key->id>=$m){
                    $mensualidad=new MensualidadE();
                    $mensualidad->id_estacionamiento=$estacionamiento->id;
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
                        $mensualidad=new MensualidadE();
                        $mensualidad->id_estacionamiento=$estacionamiento->id;
                        $mensualidad->anio=$request->anio;
                        $mensualidad->mes=$key->id;
                        $mensualidad->monto=$request->montoAnio;
                        $mensualidad->save();
                    }
                }
                
            }*/
        
            toastr()->success('con éxito!!', 'Estacionamiento registrado');
            return redirect()->to('estacionamientos');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estacionamientos  $estacionamientos
     * @return \Illuminate\Http\Response
     */
    public function show(Estacionamientos $estacionamientos)
    {
        dd('asasas');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estacionamientos  $estacionamientos
     * @return \Illuminate\Http\Response
     */
    public function edit($id_estacionamiento)
    {
        $estacionamiento=Estacionamientos::find($id_estacionamiento);

        return view('estacionamientos.edit',compact('estacionamiento'));
    }

    public function buscar_mensualidad($id, $anio)
    {
        return MensualidadE::where('id_estacionamiento', $id)->where('anio',$anio)->get();
    }

    public function buscar_anios($id)
    {
        //return MensualidadE::where('id_estacionamiento', $id)->groupBy('id_estacionamiento')->get();
        return \DB::table('residentes')
        ->join('residentes_has_est','residentes_has_est.id_residente','=','residentes.id')
        ->join('estacionamientos','estacionamientos.id','=','residentes_has_est.id_estacionamiento')
        ->join('mens_estac','mens_estac.id_estacionamiento','=','estacionamientos.id')
        ->join('pagos_estac','pagos_estac.id_mens_estac','=','mens_estac.id')
        ->where('residentes.id', $id)
        ->where('residentes_has_est.status','En Uso')
        ->select('mens_estac.anio')
        ->groupBy('mens_estac.anio')
        ->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estacionamientos  $estacionamientos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_estacionamiento)
    {

        //dd($request->all());
        $id_admin=id_admin(\Auth::user()->email);
        $buscar=Estacionamientos::where('idem',$request->idem)->where('id_admin',$id_admin)->where('id','<>',$request->id)->get();
        //$meses=Meses::all();
        if (count($buscar)>0) {
            toastr()->warning('intente otra vez!!', 'El idem ya se encuentra registrado');
            return redirect()->back();
        } else {
            $estacionamiento= Estacionamientos::find($request->id);
            $estacionamiento->idem=$request->idem;
            $estacionamiento->status=$request->status;
            $estacionamiento->save();
            
            toastr()->success('con éxito!!', 'Estacionamiento actualizado');
            return redirect()->to('estacionamientos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estacionamientos  $estacionamientos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //dd($request->all());
        $meses=Meses::all();
        $estacionamiento=Estacionamientos::find($request->id);

        foreach($meses as $key){
                $mensualidad= MensualidadE::where('id_estacionamiento',$request->id)->where('mes',$key->id)->first();
                if ($mensualidad!=null) {
                    $pagos=PagosE::where('id_mens_estac',$mensualidad->id)->get();
                    foreach ($pagos as $key) {
                        $key->delete();
                    }
                    $mensualidad->delete();
                }
            }
        $estacionamiento->delete();
        toastr()->success('con éxito!!', 'Estacionamiento eliminado');
            return redirect()->to('estacionamientos');
    }

    public function registrar_mensualidad(Request $request)
    {
        //dd('Registrar mensualidad',$request->all());
        $m=date('m');
        $a=date('Y');
        $meses=Meses::all();
        $estacionamiento=Estacionamientos::find($request->id_estacionamiento);
        if ($request->accion==1) {
                # mensual
            if ($this->nulidad($request->monto)) {
                toastr()->warning('intente otra vez!!', 'Debe agregar todos los montos en los meses indicados');
                    return redirect()->back();    
                } else {
                    $i=0;
                    foreach ($meses as $key) {
                        if($key->id>=$m && $a==$request->anio){
                            $mensualidad=new MensualidadE();
                            $mensualidad->id_estacionamiento=$request->id_estacionamiento;
                            $mensualidad->anio=$request->anio;
                            $mensualidad->mes=$key->id;
                            $mensualidad->monto=$request->monto[$i];
                            $mensualidad->save();
                            $i++;
                        }else{

                            $mensualidad=new MensualidadE();
                            $mensualidad->id_estacionamiento=$request->id_estacionamiento;
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
                        $mensualidad=new MensualidadE();
                        $mensualidad->id_estacionamiento=$request->id_estacionamiento;
                        $mensualidad->anio=$request->anio;
                        $mensualidad->mes=$key->id;
                        $mensualidad->monto=$request->montoaAnio;
                        $mensualidad->save();
                    }else{
                        $mensualidad=new MensualidadE();
                        $mensualidad->id_estacionamiento=$request->id_estacionamiento;
                        $mensualidad->anio=$request->anio;
                        $mensualidad->mes=$key->id;
                        $mensualidad->monto=$request->montoaAnio;
                        $mensualidad->save();
                    }
                }
                
            }
            toastr()->success('con éxito!!', 'Mensualidad registrada para el año: '.$request->anio.'en el estacionamiento: '.$estacionamiento->idem.'');
            return redirect()->to('estacionamientos');
    }
    public function editar_mensualidad(Request $request)
    {
        //dd('Editar mensualidad',$request->all());

        if ($this->nulidad($request->monto)==true && $request->accion==1) {
            toastr()->warning('intente otra vez!!', 'Debe agregar todos los montos en los meses indicados');
            return redirect()->back();    
                } else {

                $meses=Meses::all();
                $estacionamiento=Estacionamientos::find($request->id_estacionamiento);
                //eliminando mensualidades

            for($i=0;$i<count($request->mes);$i++){
                    $mensualidad= MensualidadE::where('id_estacionamiento',$request->id_estacionamiento)->where('anio',$request->anio)->where('mes',$request->mes[$i])->first();
                    //dd($mensualidad);
                    if ($mensualidad!=null) {
                        
                        $mensualidad->delete();
                    }
                }
            //----------------------
        if ($request->accion==1) {
                # mensual
                
                for($i=0;$i<count($request->mes);$i++) {
                    
                        $mensualidad=new MensualidadE();
                        $mensualidad->id_estacionamiento=$request->id_estacionamiento;
                        $mensualidad->anio=$request->anio;
                        $mensualidad->mes=$request->mes[$i];
                        $mensualidad->monto=$request->monto[$i];
                        $mensualidad->save();
                        
                    
                }
            } else {
                # anual
                for($i=0;$i<count($request->mes);$i++){
                   
                        $mensualidad=new MensualidadE();
                        $mensualidad->id_estacionamiento=$request->id_estacionamiento;
                        $mensualidad->anio=$request->anio;
                        $mensualidad->mes=$request->mes[$i];
                        $mensualidad->monto=$request->montoaAnio;
                        $mensualidad->save();
                    
                }
                
            }
            toastr()->success('con éxito!!', 'Mensualidad actualizada para el año: '.$request->anio.'en el estacionamiento: '.$estacionamiento->idem.'');
            return redirect()->to('estacionamientos');
        }
    }
    public function eliminar_mensualidad(Request $request)
    {
        //dd('Eliminar mensualidad',$request->all());
        //eliminando mensualidades
        $estacionamiento=Estacionamientos::find($request->id_estacionamiento);
        $meses=Meses::all();

            foreach ($meses as $key) {
                    
                    $mensualidad= MensualidadE::where('id_estacionamiento',$request->id_estacionamiento)->where('anio',$request->anio)->where('mes',$key->id)->first();
                    //dd($mensualidad);
                    if ($mensualidad!=null) {
                        
                        $mensualidad->delete();
                    }
                    
                    
                }
            //----------------------
                toastr()->success('con éxito!!', 'Mensualidad eliminada para el año: '.$request->anio.' en el estacionamiento:'.$estacionamiento->idem.'');
                return redirect()->to('estacionamientos');
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

    public function estacionamientos_disponibles($id)
    {
        $id_admin=id_admin(\Auth::user()->email);
        return $estacionamientos=Estacionamientos::where('status','<>','Ocupado')->where('id_admin',$id_admin)->get();
    }
}
