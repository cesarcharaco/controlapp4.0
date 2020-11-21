<?php

namespace App\Http\Controllers;

use App\Inmuebles;
use App\Estacionamientos;
use Illuminate\Http\Request;
use App\Mensualidades;
use App\MensualidadE;
use App\Pagos;
use App\PagosE;
use App\Residentes;
use App\Instalaciones;
class ArriendosController extends Controller
{

    public function asignando(Request $request)
    {
        //dd($request->all());
        $anio=date('Y');
        $mes=date('m');
        //dd($mes);
        if($request->opcion=="inmueble"){
            for ($i=0; $i < count($request->id_inmueble); $i++) { 
                \DB::table('residentes_has_inmuebles')->insert([
                    'id_residente' => $request->id_residente,
                    'id_inmueble' => $request->id_inmueble[$i]
                ]);
                $inmueble=Inmuebles::find($request->id_inmueble[$i]);
                $inmueble->status="No Disponible";
                $inmueble->save();

                //asignando estatus de pago del inmueble
                $mensualidades=Mensualidades::where('id_inmueble',$request->id_inmueble[$i])->where('anio',$anio)->get();
                foreach ($mensualidades as $key) {
                    //echo "".$key->mes."-".$mes."<br>";
                    if ($key->mes>=intval($mes)) {
                        $pago=new Pagos();
                        $pago->id_mensualidad=$key->id;
                        $pago->status="Pendiente";
                        $pago->save();
                       
                    } else {
                        $pago=new Pagos();
                        $pago->id_mensualidad=$key->id;
                        $pago->status="No Aplica";
                        $pago->save();
                        
                    }
                    
                }

            }
            //dd("---------");
        }elseif($request->opcion=="estacionamiento"){
            for ($i=0; $i < count($request->id_estacionamiento); $i++) { 
                \DB::table('residentes_has_est')->insert([
                    'id_residente' => $request->id_residente,
                    'id_estacionamiento' => $request->id_estacionamiento[$i]
                ]);
                //dd(".....");
                $estacionamiento=Estacionamientos::find($request->id_estacionamiento[$i]);
                $estacionamiento->status="Ocupado";
                $estacionamiento->save();

                //asignando estatus de pago del inmueble
                $mensualidades=MensualidadE::where('id_estacionamiento',$request->id_estacionamiento[$i])->where('anio',$anio)->get();
                foreach ($mensualidades as $key) {
                    if ($key->mes>=intval($mes)) {
                        $pago=new PagosE();
                        $pago->id_mens_estac=$key->id;
                        $pago->status="Pendiente";
                        $pago->save();
                    } else {
                        $pago=new PagosE();
                        $pago->id_mens_estac=$key->id;
                        $pago->status="No Aplica";
                        $pago->save();
                    }
                    
                }
            }
        }
        toastr()->success('con éxito!!', $request->opcion.' asignado');
        return redirect()->to('arriendos');

    }

    public function retirando(Request $request)
    {
        //dd($request->all());
        if ($request->id_inmueble>0) {
            $inmueble=Inmuebles::find($request->id_inmueble);

            $inmueble->status="Disponible";
            $inmueble->save();

            foreach ($inmueble->residentes as $key) {
                if ($key->pivot->id_residente==$request->id_residente && $key->pivot->status=="En Uso") {
                    $key->pivot->status="Retirado";
                    $key->pivot->save();
                }
                
            }
            $residente=Residentes::find($request->id_residente);
            foreach ($residente->inmuebles as $key) {
                foreach ($key->mensualidades as $key2) {
                    $buscar=Pagos::where('id_mensualidad',$key2->id);
                    $buscar->delete();
                }
            }
            toastr()->success('con éxito!!', 'Eliminación del inmueble del Residente realizada');
            
        } elseif($request->id_estacionamiento>0) {
            $estacionamiento=Estacionamientos::find($request->id_estacionamiento);

            $estacionamiento->status="Libre";
            $estacionamiento->save();

            foreach ($estacionamiento->residentes as $key) {
                if ($key->pivot->id_residente==$request->id_residente && $key->pivot->status=="En Uso") {
                    $key->pivot->status="Retirado";
                    $key->pivot->save();
                }
                
            }
            $residente=Residentes::find($request->id_residente);
            foreach ($residente->estacionamientos as $key) {
                foreach ($key->mensualidad as $key2) {
                    $buscar=PagosE::where('id_mens_estac',$key2->id);
                    $buscar->delete();
                }
            }
            toastr()->success('con éxito!!', 'Eliminación del estacionamiento del Residente realizada');
        }

        
        return redirect()->to('arriendos');
    }

    public function buscar_anios_i($id_residente)
    {
        return \DB::table('residentes')
        ->join('residentes_has_inmuebles','residentes_has_inmuebles.id_residente','=','residentes.id')
        ->join('inmuebles','inmuebles.id','=','residentes_has_inmuebles.id_inmueble')
        ->join('mensualidades','mensualidades.id_inmueble','=','inmuebles.id')
        ->join('pagos','pagos.id_mensualidad','=','mensualidades.id')
        ->where('residentes.id',$id_residente)
        ->where('residentes_has_inmuebles.status','En Uso')
        ->select('mensualidades.anio')
        ->groupBy('mensualidades.anio')
        ->get();
    }    

    public function buscar_anios_e($id_residente)
    {
        return \DB::table('residentes')
        ->join('residentes_has_est','residentes_has_est.id_residente','=','residentes.id')
        ->join('estacionamientos','estacionamientos.id','=','residentes_has_est.id_estacionamiento')
        ->join('mens_estac','mens_estac.id_estacionamiento','=','estacionamientos.id')
        ->join('pagos_estac','pagos_estac.id_mens_estac','=','mens_estac.id')
        ->where('residentes.id',$id_residente)
        ->where('residentes_has_est.status','En Uso')
        ->select('mens_estac.anio')
        ->groupBy('mens_estac.anio')
        ->get();
    }

    public function buscar_inmuebles($id_residente,$anio)
    {
        return \DB::table('residentes')
        ->join('residentes_has_inmuebles','residentes_has_inmuebles.id_residente','=','residentes.id')
        ->join('inmuebles','inmuebles.id','=','residentes_has_inmuebles.id_inmueble')
        ->join('mensualidades','mensualidades.id_inmueble','=','inmuebles.id')
        ->join('pagos','pagos.id_mensualidad','=','mensualidades.id')
        ->where('residentes.id',$id_residente)
        ->where('mensualidades.anio',$anio)
        ->where('residentes_has_inmuebles.status','En Uso')
        ->select('inmuebles.id','inmuebles.idem','residentes_has_inmuebles.status AS alquiler_status')
        ->groupBy('inmuebles.idem')
        ->get();

        
    }

    public function meses_inmuebles($id_inmueble)
    {
        
        return \DB::table('residentes')
        ->join('residentes_has_inmuebles','residentes_has_inmuebles.id_residente','=','residentes.id')
        ->join('inmuebles','inmuebles.id','=','residentes_has_inmuebles.id_inmueble')
        ->join('mensualidades','mensualidades.id_inmueble','=','inmuebles.id')
        ->join('pagos','pagos.id_mensualidad','=','mensualidades.id')
        ->where('inmuebles.id',$id_inmueble)
        ->where('pagos.status','Cancelado')
        ->where('residentes_has_inmuebles.status','En Uso')
        ->select('mensualidades.mes','mensualidades.id','pagos.status','residentes_has_inmuebles.status AS alquiler_status')
        ->get();

        //return 0;

    }

    public function buscar_estacionamientos($id_residente,$anio)
    {
        return \DB::table('residentes')
        ->join('residentes_has_est','residentes_has_est.id_residente','=','residentes.id')
        ->join('estacionamientos','estacionamientos.id','=','residentes_has_est.id_estacionamiento')
        ->join('mens_estac','mens_estac.id_estacionamiento','=','estacionamientos.id')
        ->join('pagos_estac','pagos_estac.id_mens_estac','=','mens_estac.id')
        ->where('residentes.id',$id_residente)
        ->where('mens_estac.anio',$anio)
        ->where('residentes_has_est.status','En Uso')
        ->select('estacionamientos.id','estacionamientos.idem','residentes_has_est.status AS alquiler_status')
        ->groupBy('estacionamientos.idem')
        ->get();

        
    }

    public function meses_estacionamientos($id_estacionamiento)
    {
        
        return \DB::table('residentes')
        ->join('residentes_has_est','residentes_has_est.id_residente','=','residentes.id')
        ->join('estacionamientos','estacionamientos.id','=','residentes_has_est.id_estacionamiento')
        ->join('mens_estac','mens_estac.id_estacionamiento','=','estacionamientos.id')
        ->join('pagos_estac','pagos_estac.id_mens_estac','=','mens_estac.id')
        ->where('estacionamientos.id',$id_estacionamiento)
        ->where('pagos_estac.status','Cancelado')
        ->where('residentes_has_est.status','En Uso')
        ->select('mens_estac.mes','mens_estac.id','pagos_estac.status','residentes_has_est.status AS alquiler_status')
        ->get();

        //return 0;

    }
    public function buscar_anios_mr($id_residente)
    {
        return \DB::table('multas_recargas')
        ->join('resi_has_mr','resi_has_mr.id_mr','=','multas_recargas.id')
        ->join('residentes','residentes.id','=','resi_has_mr.id_residente')
        ->where('residentes.id',$id_residente)
        ->where('resi_has_mr.status','Pagada')
        ->select('multas_recargas.anio')
        ->groupBy('multas_recargas.anio')
        ->get();
        //return 0;
    }

    public function buscar_mr($id_residente,$anio)
    {
        return \DB::table('multas_recargas')
        ->join('resi_has_mr','resi_has_mr.id_mr','=','multas_recargas.id')
        ->join('residentes','residentes.id','=','resi_has_mr.id_residente')
        ->where('residentes.id',$id_residente)
        ->where('resi_has_mr.status','Pagada')
        ->where('multas_recargas.anio',$anio)
        ->select('multas_recargas.*','resi_has_mr.id AS id_resi_mr')
        ->get();
    }

    public function buscar_mr_confirmar($id_residente,$anio)
    {
        return \DB::table('multas_recargas')
        ->join('resi_has_mr','resi_has_mr.id_mr','=','multas_recargas.id')
        ->join('residentes','residentes.id','=','resi_has_mr.id_residente')
        ->where('residentes.id',$id_residente)
        ->where('resi_has_mr.status','Por Confirmar')
        ->where('multas_recargas.anio',$anio)
        ->select('multas_recargas.*','resi_has_mr.id AS id_resi_mr','resi_has_mr.status','resi_has_mr.referencia','resi_has_mr.mes')
        ->get();
    }


    public function buscar_dias($id)
    {
        return \DB::table('instalaciones_has_dias')
        ->join('dias','dias.id','=','instalaciones_has_dias.id_dia')
        ->where('instalaciones_has_dias.id_instalacion',$id)
        ->select('dias.*')
        ->get();
    }

    public function desocupar(Request $request)
    {
        //dd($request->all());
        if ($request->opcion_des==1) {
            $residente=Residentes::find($request->id_residente);
            //dd($residente->inmuebles);
            foreach ($residente->inmuebles as $key) {
                if($key->pivot->id_inmueble==$request->id_inmueble){
                    $key->pivot->status='Retirado';
                    $key->pivot->save();
                    $inmueble=Inmuebles::find($request->id_inmueble);
                    $inmueble->status="Disponible";
                    $inmueble->save();
                }

            }
            toastr()->success('con éxito!!', 'Desocupación del Inmueble realizada');
        } else {
            $residente=Residentes::find($request->id_residente);
            foreach ($residente->estacionamientos as $key) {
                if($key->pivot->id_estacionamiento==$request->id_estacionamiento){
                    $key->pivot->status='Retirado';
                    $key->pivot->save();
                    $estacionamiento=Estacionamientos::find($request->id_estacionamiento);
                    $estacionamiento->status="Libre";
                    $estacionamiento->save();
                }

            }
            toastr()->success('con éxito!!', 'Desocupación del Estacionamiento realizada');
        }
        return redirect()->back();
    }


    public function buscarResidentesArriendos($id)
    {
        // return 1;
        return \DB::table('alquiler')
        ->join('residentes','residentes.id','=','alquiler.id_residente')
        ->join('instalaciones','instalaciones.id','=','alquiler.id_instalacion')
        ->join('pagos_has_alquiler','pagos_has_alquiler.id_alquiler','=','alquiler.id')
        ->where('alquiler.id',$id)
        ->select('residentes.*','instalaciones.nombre as instalacion','pagos_has_alquiler.referencia as refer','pagos_has_alquiler.monto')
        ->get();
    }
    
    public function buscar_pagar_arriendo($id)
    {
        // return 1;
        return \DB::table('alquiler')
        ->join('residentes','residentes.id','=','alquiler.id_residente')
        ->join('instalaciones','instalaciones.id','=','alquiler.id_instalacion')
        ->join('pagos_has_alquiler','pagos_has_alquiler.id_alquiler','=','alquiler.id')
        ->where('alquiler.id',$id)
        ->select('residentes.*','instalaciones.nombre as instalacion','instalaciones.id as id_instalacion','pagos_has_alquiler.referencia as refer','pagos_has_alquiler.monto','pagos_has_alquiler.status','alquiler.tipo_alquiler as tipo')
        ->get();
    }

    public function buscarArriendosResidentes($id)
    {

        $residente=Residentes::where('id_usuario',\Auth::user()->id)->first();
        return \DB::table('alquiler')
        // ->join('residentes','residentes.id','=','alquiler.id_residente')
        ->join('instalaciones','instalaciones.id','=','alquiler.id_instalacion')
        // ->join('pagos_has_alquiler','pagos_has_alquiler.id_alquiler','=','alquiler.id')
        ->where('alquiler.id_residente',$residente->id)
        ->select('instalaciones.*')
        ->get();
    }

    public function buscarArriendosResidentes2($id)
    {
        return \DB::table('alquiler')
        ->join('residentes','residentes.id','=','alquiler.id_residente')
        ->join('instalaciones','instalaciones.id','=','alquiler.id_instalacion')
        ->join('pagos_has_alquiler','pagos_has_alquiler.id_alquiler','=','alquiler.id')
        ->where('instalaciones.id',$id)
        ->select('instalaciones.*','pagos_has_alquiler.referencia as refer','alquiler.id as id_alquiler','pagos_has_alquiler.status as status')
        ->get();
    }

    public function buscarAlquileresResidentes($id_residente)
    {
        $residente=Residentes::where('id_usuario',\Auth::user()->id)->first();

        return \DB::table('alquiler')
        ->join('residentes','residentes.id','=','alquiler.id_residente')
        ->join('instalaciones','instalaciones.id','=','alquiler.id_instalacion')
        ->join('pagos_has_alquiler','pagos_has_alquiler.id_alquiler','=','alquiler.id')
        ->where('residentes.id',$residente->id)
        ->select('alquiler.*','pagos_has_alquiler.*','instalaciones.nombre','pagos_has_alquiler.status as status','pagos_has_alquiler.referencia as refer','instalaciones.id as id_instalacion','pagos_has_alquiler.monto as monto_alquiler')
        ->get();
    }

    public function buscar_instalacion($id_instalacion)
    {
        // return 1;
        return $instalaciones=Instalaciones::where('id',$id_instalacion)->get();
    }
}
