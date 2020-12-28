<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PagosComunes;
use App\Meses;
use App\Inmuebles;
use App\Estacionamientos;
use App\Mensualidades;
use App\MensualidadE;

class PagosComunesController extends Controller
{
    public function store(Request $request)
    {
    	//dd($request->all());
        $id_admin=id_admin(\Auth::user()->email);
        //dd($id_admin);
        /*"anioI" => "2021"
          "montoaAnio" => null
          "mes" => array:12 [▶]
          "monto" => array:12 [▶]
          "tipo" => "Inmueble"
          "accion" => "1"*/
        //dd(is_null($request->montoaAnio));
    	$m=date('m');
        $a=date('Y');
        $meses=Meses::all();
        if(!is_null($request->anioI)){
        	$anio=$request->anioI;
        }
        if(!is_null($request->anioE)){
        	$anio=$request->anioE;
        }
        //dd(is_null($request->montoaAnio));

        

        if (is_null($request->montoaAnio)==true && $request->accion==2) {
            toastr()->warning('intente otra vez!!', 'Debe agregar el monto');
                    return redirect()->back();
            }else{
                # mensual
            if ($this->nulidad($request->monto)==true && $request->accion==2) {
                toastr()->warning('intente otra vez!!', 'Debe agregar todos los montos en los meses indicados');
                    return redirect()->back();    
                } else {
                    $buscar=PagosComunes::where('tipo',$request->tipo)->where('anio',$request->anioI)->where('id_admin',$id_admin)->get();
                    if (count($buscar)>0) {

                        $meses=Meses::all();
                        foreach($meses as $key){
                            $pagocomun= PagosComunes::where('tipo',$request->tipo)->where('anio',$request->anioI)->where('mes',$key->id)->where('id_admin',$id_admin)->first();
                            //dd($pagocomun);
                            if ($pagocomun!=null) {
                                
                                $pagocomun->delete();
                            }
                        }

                        if ($request->accion==1) {
                            $i=0;
                            foreach($meses as $key){
                                $pagocomun=new PagosComunes();
                                $pagocomun->tipo=$request->tipo;
                                $pagocomun->anio=$request->anioI;
                                $pagocomun->mes=$key->id;
                                $pagocomun->monto=$request->monto[$i];
                                $pagocomun->id_admin=$id_admin;
                                $pagocomun->save();

                                //cambiando montos de inmuebles
                                $inmuebles=Inmuebles::where('id_admin',$id_admin)->get();
                                foreach ($inmuebles as $key2) {
                                    foreach ($key2->mensualidades as $key3) {
                                        if($key3->mes==$key->id){
                                            $key3->monto=$pagocomun->monto;
                                            $key3->save();
                                        }
                                    }
                                }
                                $i++;
                            }
                        } else {
                            // dd($request->all());
                           
                            foreach($meses as $key){
                                $pagocomun=new PagosComunes();
                                $pagocomun->tipo=$request->tipo;
                                $pagocomun->anio=$request->anioI;
                                $pagocomun->mes=$key->id;
                                $pagocomun->monto=$request->montoaAnio;
                                $pagocomun->id_admin=$id_admin;
                                $pagocomun->save();

                                //cambiando montos de inmuebles
                                $inmuebles=Inmuebles::where('id_admin',$id_admin)->get();
                                foreach ($inmuebles as $key2) {
                                    foreach ($key2->mensualidades as $key3) {
                                        if($key3->mes==$key->id){
                                            $key3->monto=$pagocomun->monto;
                                            $key3->save();
                                        }
                                    }
                                }
                            }
                        }
                        toastr()->success('con éxito!!', 'Pago Común actualizado para el año:'.$request->anioI.' para los '.$request->tipo.'s');
                        return redirect()->back();    
                    } else {
                        # code...
                        if (is_null($request->montoaAnio)) {
                            $i=0;
                        foreach ($meses as $key) {
                            if($key->id>=$m && $a==$anio){
                                $pagocomun=new PagosComunes();
                                $pagocomun->tipo=$request->tipo;
                                $pagocomun->anio=$anio;
                                $pagocomun->mes=$key->id;
                                $pagocomun->monto=$request->monto[$i];
                                $pagocomun->id_admin=$id_admin;
                                $pagocomun->save();
                                $i++;
                            }else{

                                $pagocomun=new PagosComunes();
                                $pagocomun->tipo=$request->tipo;
                                $pagocomun->anio=$anio;
                                $pagocomun->mes=$key->id;
                                $pagocomun->monto=$request->monto[$i];
                                $pagocomun->id_admin=$id_admin;
                                $pagocomun->save();
                                $i++;
                            }
                        }
                        $this->nuevas_mensualidades($anio,$request->tipo);
                        } else {
                            
                                foreach ($meses as $key) {
                                if($key->id>=$m && $a==$anio){
                                    $pagocomun=new PagosComunes();
                                    $pagocomun->tipo=$request->tipo;
                                    $pagocomun->anio=$anio;
                                    $pagocomun->mes=$key->id;
                                    $pagocomun->monto=$request->montoaAnio;
                                    $pagocomun->id_admin=$id_admin;
                                    $pagocomun->save();
                                    
                                }else{

                                    $pagocomun=new PagosComunes();
                                    $pagocomun->tipo=$request->tipo;
                                    $pagocomun->anio=$anio;
                                    $pagocomun->mes=$key->id;
                                    $pagocomun->monto=$request->montoaAnio;
                                    $pagocomun->id_admin=$id_admin;
                                    $pagocomun->save();
                                    
                                }
                                }

                            $this->nuevas_mensualidades($anio,$request->tipo);
                        
                        }
                        
                        
                    }
                    
                }//nulidad
            /*} else {
                # anual
                foreach ($meses as $key) {
                    if($key->id>=$m && $a==$request->anio){
                        $pagocomun=new PagosComunes();
                        $pagocomun->tipo=$request->tipo;
                        $pagocomun->anio=$request->anio;
                        $pagocomun->mes=$key->id;
                        $pagocomun->monto=$request->montoaAnio;
                        $pagocomun->id_admin=$id_admin;
                        $pagocomun->save();
                    }else{
                        $pagocomun=new PagosComunes();
                        $pagocomun->tipo=$request->tipo;
                        $pagocomun->anio=$request->anio;
                        $pagocomun->mes=$key->id;
                        $pagocomun->monto=$request->montoaAnio;
                        $pagocomun->id_admin=$id_admin;
                        $pagocomun->save();
                    }
                }
                
            }*/
            toastr()->success('con éxito!', 'Pago Común registrado para el año:'.$anio.' para :'.$request->tipo.'');
            return redirect()->to('home');
        }
    }

    public function update(Request $request)
    {
    	//dd($request->all());
        $id_admin=id_admin(\Auth::user()->email);
    	if(!is_null($request->anioI)){
        	$anio=$request->anioI;
        }
        if(!is_null($request->anioE)){
        	$anio=$request->anioE;
        }

    	if (is_null($request->montoaAnio)==true && $request->accion==2) {
            toastr()->warning('intente otra vez!!', 'Debe agregar el monto');
                    return redirect()->back();
        }else{
            # mensual
        if ($this->nulidad($request->monto)==true && $request->accion==2) {
            toastr()->warning('intente otra vez!!', 'Debe agregar todos los montos en los meses indicados');
                return redirect()->back();    
            } else {
                $meses=Meses::all();
                foreach($meses as $key){
                    $pagocomun= PagosComunes::where('tipo',$request->tipo)->where('anio',$anio)->where('mes',$key->id)->where('id_admin',$id_admin)->first();
                    //dd($pagocomun);
                    if ($pagocomun!=null) {
                        
                        $pagocomun->delete();
                    }
                }

        //----------------------
    
                if ($request->tipo=="Inmueble") {
                    //dd($request->all());
                        # mensual
                    $meses=Meses::all();
                    //dd($meses);
                    //si es por mes
                    if ($request->accion==1) {
                        $i=0;
                        foreach($meses as $key){
                            $pagocomun=new PagosComunes();
                            $pagocomun->tipo=$request->tipo;
                            $pagocomun->anio=$anio;
                            $pagocomun->mes=$key->id;
                            $pagocomun->monto=$request->monto[$i];
                            $pagocomun->id_admin=$id_admin;
                            $pagocomun->save();

                            //cambiando montos de inmuebles
                            $inmuebles=Inmuebles::where('id_admin',$id_admin)->get();
                            foreach ($inmuebles as $key2) {
                                foreach ($key2->mensualidades as $key3) {
                                    if($key3->mes==$key->id){
                                        $key3->monto=$pagocomun->monto;
                                        $key3->save();
                                    }
                                }
                            }
                            $i++;
                        }
                    } else {
                       
                        foreach($meses as $key){
                            $pagocomun=new PagosComunes();
                            $pagocomun->tipo=$request->tipo;
                            $pagocomun->anio=$anio;
                            $pagocomun->mes=$key->id;
                            $pagocomun->monto=$request->montoaAnio;
                            $pagocomun->id_admin=$id_admin;
                            $pagocomun->save();

                            //cambiando montos de inmuebles
                            $inmuebles=Inmuebles::where('id_admin',$id_admin)->get();
                            foreach ($inmuebles as $key2) {
                                foreach ($key2->mensualidades as $key3) {
                                    if($key3->mes==$key->id){
                                        $key3->monto=$pagocomun->monto;
                                        $key3->save();
                                    }
                                }
                            }
                        }
                    }
                } elseif($request->tipo=="Estacionamiento") {
                    //dd($request->all());
                    $meses=Meses::all();
                //dd($meses);
                    if ($request->accion==1) {
                        $i=0;
                        foreach($meses as $key){
                            
                                $pagocomun=new PagosComunes();
                                $pagocomun->tipo=$request->tipo;
                                $pagocomun->anio=$anio;
                                $pagocomun->mes=$key->id;
                                $pagocomun->monto=$request->monto[$i];
                                $pagocomun->id_admin=$id_admin;
                                $pagocomun->save();

                                
                                //-----------------------------
                                //cambiando montos de estacionamientos
                                $estacionamiento=Estacionamientos::where('id_admin',$id_admin)->get();
                                foreach ($estacionamiento as $key2) {
                                    foreach ($key2->mensualidad as $key3) {
                                        if($key3->mes==$key->id){
                                            $key3->monto=$pagocomun->monto;
                                            $key3->save();
                                        }
                                    }
                                }
                                //-----------------------------
                                
                        }
                    } else {
                        
                        foreach($meses as $key){
                            
                                $pagocomun=new PagosComunes();
                                $pagocomun->tipo=$request->tipo;
                                $pagocomun->anio=$anio;
                                $pagocomun->mes=$key->id;
                                $pagocomun->monto=$request->montoaAnio;
                                $pagocomun->id_admin=$id_admin;
                                $pagocomun->save();

                                
                                //-----------------------------
                                //cambiando montos de estacionamientos
                                $estacionamiento=Estacionamientos::where('id_admin',$id_admin)->get();
                                foreach ($estacionamiento as $key2) {
                                    foreach ($key2->mensualidad as $key3) {
                                        if($key3->mes==$key->id){
                                            $key3->monto=$pagocomun->monto;
                                            $key3->save();
                                        }
                                    }
                                }
                                //-----------------------------
                                
                        }
                    }
                }

            toastr()->success('con éxito!!', 'Pago Común actualizado para el año:'.$request->anio.' para el'.$request->tipo.'');
            return redirect()->to('home');
            }
        }
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

    public function buscarPagoAnio($tipo, $anio)
    {
        $id_admin=id_admin(\Auth::user()->email);
        if ($tipo==1) {
            return $pagoComun=PagosComunes::where('tipo','Inmueble')->where('anio',$anio)->where('id_admin',$id_admin)->get();
        }else{
            return $pagoComun=PagosComunes::where('tipo','Estacionamiento')->where('anio',$anio)->where('id_admin',$id_admin)->get();
        }
    }

    protected function nuevas_mensualidades($anio,$tipo)
    {
        $id_admin=id_admin(\Auth::user()->email);
        if ($tipo=="Inmueble") {
            $inmuebles=Inmuebles::where('id_admin',$id_admin)->get();
            foreach ($inmuebles as $key) {
                $pago=PagosComunes::where('anio',$anio)->where('tipo',$tipo)->get();
                foreach ($pago as $key2) {
                    $mensualidad=new Mensualidades();
                    $mensualidad->id_inmueble=$key->id;
                    $mensualidad->mes=$key2->mes;
                    $mensualidad->anio=$key2->anio;
                    $mensualidad->monto=$key2->monto;
                    $mensualidad->save();
                }
            }
        } else {
            $estacionamiento=Estacionamientos::where('id_admin',$id_admin)->get();
            foreach ($estacionamiento as $key) {
                $pago=PagosComunes::where('anio',$anio)->where('tipo',$tipo)->get();
                foreach ($pago as $key2) {
                    $mensualidad=new MensualidadE();
                    $mensualidad->id_estacionamiento=$key->id;
                    $mensualidad->mes=$key2->mes;
                    $mensualidad->anio=$key2->anio;
                    $mensualidad->monto=$key2->monto;
                    $mensualidad->save();
                }
            }
        }
        
    }


    public function buscarPagoMes($mes)
    {
        $id_admin=id_admin(\Auth::user()->email);

        // return 1;

        return \DB::table('residentes')
            ->join('residentes_has_inmuebles','residentes_has_inmuebles.id_residente','=','residentes.id')
            ->join('inmuebles','inmuebles.id','=','residentes_has_inmuebles.id_inmueble')
            ->join('mensualidades','mensualidades.id_inmueble','=','inmuebles.id')
            ->join('pagos','pagos.id_mensualidad','=','mensualidades.id')
            ->join('meses','meses.id','=','mensualidades.mes')
            ->where('residentes.id_admin',$id_admin)
            ->where('mensualidades.mes',$mes)
            ->select('residentes.*','inmuebles.idem','mensualidades.monto','pagos.status','meses.mes AS mes')
            ->get();
    }
}
