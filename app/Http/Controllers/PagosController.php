<?php

namespace App\Http\Controllers;

use App\Pagos;
use App\Residentes;
use App\Inmuebles;
use App\Meses;
use App\Estacionamientos;
use App\MultasRecargas;
use App\PagosE;
use App\MensualidadE;
use App\Mensualidades;
use App\Reportes;
use App\Referencias;
use App\Contabilidad;
use App\ContabilidadSaldo;
use App\Http\Controllers\FlowController;
use Illuminate\Http\Request;
use App\Http\FlowBuilder;
use App\Http\FlowBuilder1;
use PDF;

try {
  //Do your stuff here
} catch (Exception $e){
  echo $e->message() ;
}
class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id_admin=id_admin(\Auth::user()->email);
        // $residentes=Residentes::where('id_admin',$id_admin)->get();
        if(\Auth::user()->tipo_usuario=="Admin"){
            $residentes=Residentes::where('id_admin',\Auth::user()->id)->get();
        }elseif(\Auth::user()->tipo_usuario=="Residente"){
            $residentes=Residentes::where('id_usuario',\Auth::user()->id)->get();
        }
        $meses=Meses::all();
        $pagos=Pagos::all();
        $inmuebles=Inmuebles::where('id_admin',$id_admin)->get();
        $estacionamientos=Estacionamientos::where('id_admin',$id_admin)->get();

        $asignaIn= \DB::table('residentes_has_inmuebles')->where('status','En Uso')->groupBy('id_residente')->get();
        $asignaEs= \DB::table('residentes_has_est')->where('status','En Uso')->groupBy('id_residente')->get();

        $meses2=Meses::where('id','<=',date("m"))->get();

        $anio2=Mensualidades::where('id','<>',0)->groupBy('anio')->select('anio')->get();


        $anio=date('Y');

        return View('pagos.index', compact('residentes','pagos','inmuebles','estacionamientos','meses','meses2','anio','anio2','asignaEs','asignaIn'));
    }

    public function pagos_multas(){
        // dd('asdasdasd');
        $id_admin=id_admin(\Auth::user()->email);
        $residentes=Residentes::where('id_admin',$id_admin)->get();
        $meses=Meses::all();
        $pagos=Pagos::all();
        $inmuebles=Inmuebles::where('id_admin',$id_admin)->get();
        $estacionamientos=Estacionamientos::where('id_admin',$id_admin)->get();

        $asignaIn= \DB::table('residentes_has_inmuebles')->where('status','En Uso')->groupBy('id_residente')->get();
        $asignaEs= \DB::table('residentes_has_est')->where('status','En Uso')->groupBy('id_residente')->get();

        $meses2=Meses::where('id','<=',date("m"))->get();

        return View('pagos.index2', compact('residentes','pagos','inmuebles','estacionamientos','meses','meses2','asignaEs','asignaIn'));
    }

    public function estados_pagos()
    {
        $meses=Meses::all();
        if(\Auth::user()->tipo_usuario=="Admin"){
            $residentes=Residentes::where('id_admin',\Auth::user()->id)->get();
        }elseif(\Auth::user()->tipo_usuario=="Residente"){
            $residentes=Residentes::where('id_usuario',\Auth::user()->id)->get();
        }
        $anio=date('Y');
        
        return View('pagos.estados_pagos',compact('residentes','meses','anio'));
    }

    public function estados_pagos_filtro($anio,$mes)
    {
        return 1;
        // $meses=Meses::where('id',$mes)->get();
        // if(\Auth::user()->tipo_usuario=="Admin"){
        //     $residentes=Residentes::where('id_admin',\Auth::user()->id)->get();
        // }elseif(\Auth::user()->tipo_usuario=="Residente"){
        //     $residentes=Residentes::where('id_usuario',\Auth::user()->id)->get();
        // }
        // $anio=date('Y');
        
        // return View('pagos.estados_pagos',compact('residentes','meses','anio'));
    }

    public function estados_pagos_pdf()
    {

        $meses=Meses::all();
        if(\Auth::user()->tipo_usuario=="Admin"){
            $residentes=Residentes::where('id_admin',\Auth::user()->id)->get();
        }elseif(\Auth::user()->tipo_usuario=="Residente"){
            $residentes=Residentes::where('id_usuario',\Auth::user()->id)->get();
        }
        $anio=date('Y');

        $pdf = PDF::loadView('reportes/PDF/EstadosPago', array(
            'residentes' => $residentes,
            'meses' => $meses,
            'anio' => $anio
        ));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('reportes/EstadosPago.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //dd(count($request->mes));
        if($request->flow==1){
            $request->referencia=$this->generarOrden();
            $orden_compra=$request->referencia;
        }
        //dd($request->referencia);
        $factura="";
        $concepto="";
        $total=0;
        //-------------para el caso de pagar con flow-----------------
        //arreglo para id e Pagos para cambia status
        $pago_i=array();
        $pi=0;//variable para iterar el array
        //arreglo para id e PagosE para cambia status
        $pago_e=array();
        $pe=0;//variable para iterar el array
        //---------------------------------------------------------------
        if ($request->opcion==1) {
            //---------------------------------- para pagar como residente o admin-----------------------------------------------
            if (is_null($request->mes)==true) {
                toastr()->warning('intente otra vez!!', 'No ha seleccionado algo a pagar');
                return redirect()->back();
            } else {
                if (is_null($request->mes)==false) {
                    //dd('prueba 1');
                    for ($i=0; $i < count($request->mes); $i++) {
                        if($request->mes[$i]!==null){
                            $residente=Residentes::find($request->id_user);
                            foreach ($residente->inmuebles as $key) {
                                if ($key->pivot->status=="En Uso") {
                                    foreach ($key->mensualidades as $key2) {
                                        if ($key2->mes==$request->mes[$i]) {
                                            //echo $key2->id."<br>";
                                            $pagos=Pagos::where('id_mensualidad',$key2->id)->orderby('id','DESC')->first();
                                            if(!is_null($pagos)){
                                                if ($request->tipo_pago=="Flow") {
                                                    $pago_i[$pi]=$pagos->id;
                                                    $pi++;
                                                } else {
                                                    if (\Auth::user()->tipo_usuario=="Residente") {
                                                        $pagos->status="Por Confirmar";
                                                    } else {
                                                        $pagos->status="Cancelado";
                                                    }
                                                    if ($request->tipo_pago=="Transferencia") {
                                                        $referencia = $request->referencia;
                                                    } else {
                                                        $referencia = date('YmdHim');
                                                    }
                                                    $pagos->tipo_pago=$request->tipo_pago;
                                                    $pagos->referencia=$referencia;
                                                    $pagos->save();

                                                    $total+=$key2->monto;
                                                    $factura.="Inmueble: ".$key->idem." Mes: ".$this->mostrar_mes($request->mes[$i])." Monto: ".$key2->monto."<br>";
                                                    $concepto.="Inmueble: ".$key->idem." - Mes: ".$this->mostrar_mes($request->mes[$i])." - Monto: ".$key2->monto." | ";
                                                    $descripcion="Inmueble: ".$key->idem." - Mes: ".$this->mostrar_mes($request->mes[$i])." - Monto: ".$key2->monto."";                                                    
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if (\Auth::user()->tipo_usuario=="Admin" && $request->tipo_pago!="Flow") {
                        $id_admin=id_admin(\Auth::user()->email);

                        $consulta_saldo = ContabilidadSaldo::where('id_admin',$id_admin)->first();
                        if ($consulta_saldo==NULL) {
                            $saldo=0;
                        } else {
                            $saldo = $consulta_saldo->saldo;
                        }
                        if ($request->tipo_pago=="Transferencia") {
                            $referencia = $request->referencia;
                        } else {
                            $referencia = date('YmdHim');
                        }

                        $contabilidad=new Contabilidad();
                        $contabilidad->id_admin=$id_admin;
                        $contabilidad->id_mes=date('n');
                        $contabilidad->referencia=$referencia;
                        $contabilidad->descripcion=$descripcion;
                        $contabilidad->ingreso=$total;
                        $contabilidad->egreso=0;
                        $contabilidad->save();
                        if ($consulta_saldo==NULL) {
                            \DB::table('contabilidad_saldo')->insert([
                                'id_admin' => $id_admin,
                                'saldo' => $total
                            ]);
                        } else {
                            \DB::table('contabilidad_saldo')->where('id_admin',$id_admin)
                                ->update([
                                'saldo' => $total+$saldo
                            ]);
                        }
                    }
                }
            
                if(is_null($request->mes)==false){
                    //dd('prueba 2');
                    for ($i=0; $i < count($request->mes); $i++) { 
                        if($request->mes[$i]!==null){
                            $residente=Residentes::find($request->id_user);
                            foreach ($residente->estacionamientos as $key) {
                                if ($key->pivot->status=="En Uso") {
                                    foreach ($key->mensualidad as $key2) {
                                        if ($key2->mes==$request->mes[$i]) {
                                            //echo $key2->id."<br>";
                                            $pagos=PagosE::where('id_mens_estac',$key2->id)->orderby('id','DESC')->first();
                                            if(!is_null($pagos)){
                                                if ($request->tipo_pago=="Flow") {
                                                    $pago_e[$pe]=$pagos->id;
                                                    $pe++;
                                                } else {
                                                    if (\Auth::user()->tipo_usuario=="Residente") {
                                                        $pagos->status="Por Confirmar";
                                                    } else {
                                                        $pagos->status="Cancelado";
                                                    }
                                                    $pagos->save();
                                                    $total+=$key2->monto;
                                                    //dd($total);
                                                    $factura.="Estacionamiento: ".$key->idem." Mes: ".$this->mostrar_mes($request->mes[$i])." Monto: ".$key2->monto."<br>";
                                                    $concepto.="Estacionamiento: ".$key->idem." Mes: ".$this->mostrar_mes($request->mes[$i])." Monto: ".$key2->monto."<br>";
                                                    $descripcion="Estacionamiento: ".$key->idem." Mes: ".$this->mostrar_mes($request->mes[$i])." Monto: ".$key2->monto."<br>";
                                                }
                                            }
                                        }
                                    }
                                    for ($i=0; $i <=1; $i++) {
                                        if (\Auth::user()->tipo_usuario=="Admin" && $request->tipo_pago!="Flow") {
                                            $id_admin=id_admin(\Auth::user()->email);

                                            $consulta_saldo = ContabilidadSaldo::where('id_admin',$id_admin)->first();
                                            if ($consulta_saldo==NULL) {
                                                $saldo=0;
                                            } else {
                                                $saldo = $consulta_saldo->saldo;
                                            }
                                            if ($request->tipo_pago=="Transferencia") {
                                                $referencia = $request->referencia;
                                            } else {
                                                $referencia = date('YmdHim');
                                            }
                                            $contabilidad=new Contabilidad();
                                            $contabilidad->id_admin=$id_admin;
                                            $contabilidad->id_mes=date('n');
                                            $contabilidad->referencia=$referencia;
                                            $contabilidad->descripcion=$descripcion;
                                            $contabilidad->ingreso=$total;
                                            $contabilidad->egreso=0;
                                            $contabilidad->save();
                                            if ($consulta_saldo==NULL) {
                                                \DB::table('contabilidad_saldo')->insert([
                                                    'id_admin' => $id_admin,
                                                    'saldo' => $total
                                                ]);
                                            } else {
                                                \DB::table('contabilidad_saldo')->where('id_admin',$id_admin)
                                                    ->update([
                                                    'saldo' => $total+$saldo
                                                ]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if($request->tipo_pago=="Flow"){
                    if ($total >= 350) {
                        //dd($pago_i);
                        $flowbuilder=new FlowBuilder();
                        $flowbuilder->setPagosI($pago_i);
                        $flowbuilder->setPagosE($pago_e);
                        $flowbuilder->setFactura($factura);
                        $email_pagador = \Auth::User()->email;
                        $concepto.= "Total Cancelado: ".$total."";
                        $flowcontroller=new FlowController();
                        //Con este return nos vamos al controlador de FLOW
                        return  $flowcontroller->orden2($request,$total,$concepto,$email_pagador,$orden_compra);
                    } else {
                        toastr()->error('ERROR!!', 'El monto debe ser mayor a 350 pesos chilenos');
                        return redirect()->back();
                    }
                }else{
                    $factura.="<br></br>Total Cancelado: ".$total.", con la referencia: ".$request->referencia."<br>";
                    if ($request->tipo_pago=="Transferencia") {
                        $referencia = $request->referencia;
                    } else {
                        $referencia = date('YmdHim');
                    }
                    $reporte=\DB::table('reportes_pagos')->insert([
                        'referencia' => $referencia,
                        'reporte' => $factura,
                        'id_residente' => $request->id_user
                    ]);
                    //dd("---------");
                    toastr()->success('con éxito!!', 'Pago realizado');
                    return redirect()->back();
                }
                //---------------------------------- fin para pagar como residente o admin-----------------------------------------------
            }

        } else {
            # cambiando status de por confirmar a cancelado
            if (is_null($request->mes)==true) {
                toastr()->warning('intente otra vez!!', 'No ha seleccionado algo a pagar');
                return redirect()->back();
            } else {
                if (is_null($request->mes)==false) {
                    //dd('prueba 3');
                    for ($i=0; $i < count($request->mes); $i++) {
                        if($request->mes[$i]!==null){
                            $residente=Residentes::find($request->id_residente);
                            foreach ($residente->inmuebles as $key) {
                                if ($key->pivot->status=="En Uso") {
                                    foreach ($key->mensualidades as $key2) {
                                        if ($key2->mes==$request->mes[$i]) {
                                            //echo $key2->id."<br>";
                                            $pagos=Pagos::where('id_mensualidad',$key2->id)->orderby('id','DESC')->first();
                                            $pagos->status="Cancelado";
                                            if ($request->tipo_pago=="Transferencia") {
                                                $referencia = $request->referencia;
                                            } else {
                                                $referencia = date('YmdHim');
                                            }
                                            $pagos->tipo_pago=$request->tipo_pago;
                                            $pagos->referencia=$referencia;
                                            $pagos->save();
                                            $total+=$key2->monto;
                                            $factura.="Inmueble: ".$key->idem." Mes: ".$this->mostrar_mes($request->mes[$i])." Monto: ".$key2->monto."<br>";
                                            $concepto.="Inmueble: ".$key->idem." Mes: ".$this->mostrar_mes($request->mes[$i])." Monto: ".$key2->monto."";
                                            $descripcion="Inmueble: ".$key->idem." Mes: ".$this->mostrar_mes($request->mes[$i])." Monto: ".$key2->monto."";
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if (\Auth::user()->tipo_usuario=="Admin" && $request->tipo_pago!="Flow") {
                        $id_admin=id_admin(\Auth::user()->email);

                        $consulta_saldo = ContabilidadSaldo::where('id_admin',$id_admin)->first();
                        if ($consulta_saldo==NULL) {
                            $saldo=0;
                        } else {
                            $saldo = $consulta_saldo->saldo;
                        }
                        if ($request->tipo_pago=="Transferencia") {
                            $referencia = $request->referencia;
                        } else {
                            $referencia = date('YmdHim');
                        }
                        $contabilidad=new Contabilidad();
                        $contabilidad->id_admin=$id_admin;
                        $contabilidad->id_mes=date('n');
                        $contabilidad->referencia=$referencia;
                        $contabilidad->descripcion=$descripcion;
                        $contabilidad->ingreso=$total;
                        $contabilidad->egreso=0;
                        $contabilidad->save();
                        if ($consulta_saldo==NULL) {
                            \DB::table('contabilidad_saldo')->insert([
                                'id_admin' => $id_admin,
                                'saldo' => $total
                            ]);
                        } else {
                            \DB::table('contabilidad_saldo')->where('id_admin',$id_admin)
                                ->update([
                                'saldo' => $total+$saldo
                            ]);
                        }
                    }
                }
            
                if(is_null($request->mes)==false){
                    //dd('prueba 4');
                    for ($i=0; $i < count($request->mes); $i++) { 
                        if($request->mes[$i]!==null){
                            $residente=Residentes::find($request->id_residente);
                            foreach ($residente->estacionamientos as $key) {
                                if ($key->pivot->status=="En Uso") {
                                    foreach ($key->mensualidad as $key2) {
                                        if ($key2->mes==$request->mes[$i]) {
                                            //echo $key2->id."<br>";
                                            $pagos=PagosE::where('id_mens_estac',$key2->id)->orderby('id','DESC')->first();
                                            $pagos->status="Cancelado";
                                            
                                            $pagos->save();
                                            $total+=$key2->monto;
                                            $factura.="Estacionamiento: ".$key->idem." Mes: ".$this->mostrar_mes($request->mes[$i])." Monto: ".$key2->monto."<br>";
                                            $descripcion="Estacionamiento: ".$key->idem." Mes: ".$this->mostrar_mes($request->mes[$i])." Monto: ".$key2->monto."";
                                        }
                                    }
                                    for ($i=0; $i <=1; $i++) { 
                                        if (\Auth::user()->tipo_usuario=="Admin" && $request->tipo_pago!="Flow") {
                                            $id_admin=id_admin(\Auth::user()->email);

                                            $consulta_saldo = ContabilidadSaldo::where('id_admin',$id_admin)->first();
                                            if ($consulta_saldo==NULL) {
                                                $saldo=0;
                                            } else {
                                                $saldo = $consulta_saldo->saldo;
                                            }

                                            if ($request->tipo_pago=="Transferencia") {
                                                $referencia = $request->referencia;
                                            } else {
                                                $referencia = date('YmdHim');
                                            }
                                            $contabilidad=new Contabilidad();
                                            $contabilidad->id_admin=$id_admin;
                                            $contabilidad->id_mes=date('n');
                                            $contabilidad->referencia=$referencia;
                                            $contabilidad->descripcion=$descripcion;
                                            $contabilidad->ingreso=$total;
                                            $contabilidad->egreso=0;
                                            $contabilidad->save();
                                            if ($consulta_saldo==NULL) {
                                                \DB::table('contabilidad_saldo')->insert([
                                                    'id_admin' => $id_admin,
                                                    'saldo' => $total
                                                ]);
                                            } else {
                                                \DB::table('contabilidad_saldo')->where('id_admin',$id_admin)
                                                    ->update([
                                                    'saldo' => $total+$saldo
                                                ]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                $factura.="<br></br>Total Cancelado: ".$total."";
                $reporte=\DB::table('reportes_pagos')->insert([
                    'referencia' => 0,
                    'reporte' => $factura,
                    'id_residente' => $request->id_residente
                ]);
                //dd("---------");
                toastr()->success('con éxito!!', 'Pago confirmado');
                return redirect()->back();
            //---------------------------------- fin para pagar como residente o admin-----------------------------------------------
            }
        }
        
    }
    public function pagarmultas(Request $request)
    {
        //dd($request->all());
        $total=0;
        $factura="";
        $statusP="";
        
        $residente=Residentes::find($request->id_residente);
        
            
        if ($request->tipo_pago=="Flow") {
            //dd($request->all());
            $request->referencia=$this->generarOrden();
            $orden_compra=$request->referencia;
            
            if ($request->total >= 350) {
                //dd($request->all());
                $modulo_pago = "MR";
                $total = $request->total;
                $flowbuilder=new FlowBuilder1();
                $flowbuilder->setMontoA($request->total);
                $email_pagador = \Auth::User()->email;
                $concepto= "Pago de multas y recargar.";
                $flowcontroller=new FlowAController();
                //Con este return nos vamos al controlador de FLOW
                return  $flowcontroller->orden_mr($request,$total,$concepto,$email_pagador,$orden_compra,$modulo_pago);
            } else {
                toastr()->error('ERROR!!', 'El monto a pagar debe ser mayor a 350 pesos chilenos');
                return redirect()->back();
            }
        } else {
            if(is_null($request->id_mensMulta)==false){
                for ($i=0; $i < count($request->id_mensMulta) ; $i++) { 
                    $mr=MultasRecargas::find($request->id_mensMulta[$i]);
                    //dd($mr->residentes);
                    foreach ($mr->residentes as $key) {
                        if($key->pivot->id_residente==$residente->id){
                            if(\Auth::user()->tipo_usuario == 'Admin'){
                                $statusP='Pagada';
                            }else{
                                $statusP='Por Confirmar';
                            }
                            if ($request->tipo_pago=="Transferencia") {
                                $referencia = $request->referencia;
                            } else {
                                $referencia = date('YmdHim');
                            }
                            $key->pivot->status=$statusP;
                            $key->pivot->referencia=$referencia;
                            $key->pivot->tipo_pago=$request->tipo_pago;
                            $key->pivot->save();
                            $factura.="Multa o Recarga: ".$mr->motivo.", Monto: ".$mr->monto." status:Pagada<br>";
                            $total+=$mr->monto;
                        }
                    }
                }
            }else{
                $mr=MultasRecargas::find($request->id_multa);
                foreach ($mr->residentes as $key) {
                    if($key->pivot->id_residente==$residente->id){
                        if(\Auth::user()->tipo_usuario == 'Admin'){
                            $statusP='Pagada';
                        }else{
                            $statusP='Por Confirmar';
                        }
                        if ($request->tipo_pago=="Transferencia") {
                            $referencia = $request->referencia;
                        } else {
                            $referencia = date('YmdHim');
                        }
                        $key->pivot->status=$statusP;
                        $key->pivot->referencia=$referencia;
                        $key->pivot->tipo_pago=$request->tipo_pago;
                        $key->pivot->save();
                        $factura.="Multa o Recarga: ".$mr->motivo.", Monto: ".$mr->monto." status:Pagada<br>";
                        $total+=$mr->monto;
                    }
                }
            }
            $factura.="<br></br>Total Cancelado: ".$total.", con la referencia: ".$request->referencia."<br>";
            if ($request->tipo_pago=="Transferencia") {
                $referencia = $request->referencia;
            } else {
                $referencia = date('YmdHim');
            }
            $reporte=\DB::table('reportes_pagos')->insert([
                'referencia' => $referencia,
                'reporte' => $factura,
                'id_residente' => $residente->id
            ]);
            toastr()->success('con éxito!!', 'Multas/Recargas Pagadas');
            return redirect()->back();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Pagos  $pagos
     * @return \Illuminate\Http\Response
     */
    public function show(Pagos $pagos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pagos  $pagos
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagos $pagos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pagos  $pagos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_pago)
    {
    //dd($request->all());
    //id_inmueble trae el numero del mes....
    //id_residente_edit 
    //anio
    //referencia_edit
        switch ($request->opcion) {
            case 1:
            
                $id_mensualidad=$request->id_inmueble;
                $id_mensualidad_i=array();
                $id_mensualidad_e=array();
                $j=0;
                $i=0;
                $reporte="";
                $ref_encontrada=0;
                $residente=Residentes::find($request->id_residente_edit);
                foreach ($residente->inmuebles as $key) {
                    if($key->pivot->status=="En Uso"){
                        foreach ($key->mensualidades as $key2) {
                            if($key2->id==$id_mensualidad){
                                    $id_mensualidad_i[$i]=$key2->id;
                                    $i++;
                            }
                        }
                    }    
                }
                foreach ($residente->estacionamientos as $key) {
                    if($key->pivot->status=="En Uso"){
                        foreach ($key->mensualidad as $key2) {
                            if($key2->id==$id_mensualidad){
                                    $id_mensualidad_e[$j]=$key2->id;
                                    $j++;
                            }
                        }
                    }    
                }
                //dd(count($id_mensualidad_i));
                for ($k=0; $k < count($id_mensualidad_i); $k++) { 
                    
                    $pago=Pagos::where('id_mensualidad',$id_mensualidad_i[$k])->orderby('id','DESC')->first();
                    $mes=$this->mostrar_mes($pago->mensualidad->mes);
                    $inmueble=$pago->mensualidad->inmuebles->idem;
                    $sql="SELECT * FROM `reportes_pagos` where referencia='".$request->referencia_edit."' AND tipo='Cancelado' AND reporte LIKE '%".$mes."%' ORDER BY id DESC LIMIT 0,1";
                    $sql2="SELECT * FROM `reportes_pagos` where referencia='".$request->referencia_edit."' AND tipo='Cancelado' AND reporte LIKE '%".$inmueble."%' ORDER BY id DESC LIMIT 0,1";
                    //dd($sql2);
                    $buscar1=\DB::select($sql);
                    $buscar2=\DB::select($sql2);
                    //echo $sql;
                    //echo count($buscar1);
                    if (count($buscar1)>0 AND count($buscar2)>0) {
                        $ref_encontrada++;
                        
                   }
                }//fin del for recorrido de id_mensualidad_i
                //si encontró la referencia por inmueble
                if ($ref_encontrada==count($id_mensualidad_i)) {
                    for ($k=0; $k < count($id_mensualidad_i); $k++) { 
                        $pago=Pagos::where('id_mensualidad',$id_mensualidad_i[$k])->orderby('id','DESC')->first();
                        $reporte.="Se ha colocado como Pendiente al mes de ".$mes." del Inmueble: ".$inmueble;
                        $pago->status="Pendiente";
                        $pago->save();

                    }
                    //---------- ahora voy con estacionamientos-----------------
                        for ($m=0; $m < count($id_mensualidad_e); $m++) { 
                            $pagoe=PagosE::where('id_mens_estac',$id_mensualidad_e[$m])->orderby('id','DESC')->first();
                            //dd($this->mostrar_mes($pago->mensualidad->mes));
                            $mes=$this->mostrar_mes($pagoe->mensualidad->mes);
                            $estacionamiento=$pagoe->mensualidad->estacionamientos->idem;
                            $sql="SELECT * FROM `reportes_pagos` where referencia='".$request->referencia_edit."' AND tipo='Cancelado' AND reporte LIKE '%".$mes."%' ORDER BY id DESC LIMIT 0,1";
                            $sql2="SELECT * FROM `reportes_pagos` where referencia='".$request->referencia_edit."' AND tipo='Cancelado' AND reporte LIKE '%".$estacionamiento."%' ORDER BY id DESC LIMIT 0,1";
                            //dd($sql2);
                            $buscar1e=\DB::select($sql);
                            $buscar2e=\DB::select($sql2);
                            if (count($buscar1e)>0 AND count($buscar2e)>0) {
                                $reporte.="Se ha colocado como Pendiente al mes de ".$mes." del Estacionamiento: ".$estacionamiento;
                                $pagoe->status="Pendiente";
                                $pagoe->save();     
                                
                           }
                        }
                        //dd($ref_encontrada."-".count($id_mensualidad_i)."-".count($id_mensualidad_e));
                    if($ref_encontrada > 0 && (count($id_mensualidad_i) > 0 || count($id_mensualidad_e) > 0)){
                        //dd('entro');
                        $reporte_new=new Reportes();
                        $reporte_new->referencia=$request->referencia_edit;
                        $reporte_new->reporte=$reporte;
                        $reporte_new->tipo="Pendiente";
                        $reporte_new->id_residente=$request->id_residente_edit;
                        $reporte_new->save();

                        toastr()->success('con éxito!!', 'Se ha colocado como Pendiente el Pago Común del mes '.$mes.'');
                    }else{
                        toastr()->warning('Alerta!!', 'Verifique si ha suministrado los datos correctamente');
                    }
                        return redirect()->back();
                    //-------------fin con estacionamientos---------------------
                } else {
                    
                    toastr()->warning('Verifique el código de transacción!!', 'La información no pudo ser encontrada');
                        return redirect()->back();
                }
                

                //dd('-----------');
                //dd($this->mostrar_mes($pago->mensualidad->mes));
                /*$mes=$this->mostrar_mes($pago->mensualidad->mes);
                $inmueble=$pago->mensualidad->inmuebles->idem;
                $sql="SELECT * FROM `reportes_pagos` where referencia='".$request->referencia_edit."' AND tipo='Cancelado' AND reporte LIKE '%".$mes."%' ORDER BY id DESC LIMIT 0,1";
                $sql2="SELECT * FROM `reportes_pagos` where referencia='".$request->referencia_edit."' AND tipo='Cancelado' AND reporte LIKE '%".$inmueble."%' ORDER BY id DESC LIMIT 0,1";
                //dd($sql2);
                $buscar1=\DB::select($sql);
                $buscar2=\DB::select($sql2);
                
               if (count($buscar1)>0 AND count($buscar2)>0) {
                    $reporte_new=new Reportes();
                    $reporte_new->referencia=$request->referencia_edit;
                    $reporte_new->reporte="Se ha colocado como Pendiente al mes de ".$mes." del Inmueble: ".$inmueble;
                    $reporte_new->tipo="Pendiente";
                    $reporte_new->id_residente=$request->id_residente_edit;
                    $reporte_new->save();
                    
                    $pago->status="Pendiente";
                    $pago->save();     
                    flash('Se ha colocado como Pendiente al mes de '.$mes.' del Inmueble: '.$inmueble.', con éxito!')->success();
                    return redirect()->back();
               } else {
                   flash('La información no pudo ser encontrada, verifique la referencia!')->warning();
                    return redirect()->back();
               }
               */

                break;
            case 2:

                if ($request->status=="Pendiente") {
                    
                    $pago=PagosE::where('id_mens_estac',$request->id_estacionamiento)->orderby('id','DESC')->first();
                    //dd($this->mostrar_mes($pago->mensualidad->mes));
                    $mes=$this->mostrar_mes($pago->mensualidad->mes);
                    $estacionamiento=$pago->mensualidad->estacionamientos->idem;
                    $sql="SELECT * FROM `reportes_pagos` where referencia='".$request->referencia_edit."' AND tipo='Cancelado' AND reporte LIKE '%".$mes."%' ORDER BY id DESC LIMIT 0,1";
                    $sql2="SELECT * FROM `reportes_pagos` where referencia='".$request->referencia_edit."' AND tipo='Cancelado' AND reporte LIKE '%".$estacionamiento."%' ORDER BY id DESC LIMIT 0,1";
                    //dd($sql2);
                    $buscar1=\DB::select($sql);
                    $buscar2=\DB::select($sql2);
                    
                   if (count($buscar1)>0 AND count($buscar2)>0) {
                        $reporte_new=new Reportes();
                        $reporte_new->referencia=$request->referencia_edit;
                        $reporte_new->reporte="Se ha colocado como Pendiente al mes de ".$mes." del Estacionamiento: ".$estacionamiento;
                        $reporte_new->tipo="Pendiente";
                        $reporte_new->id_residente=$request->id_residente_edit;
                        $reporte_new->save();
                        
                        $pago->status="Pendiente";
                        $pago->save();     
                        toastr()->success('con éxito!!', 'Se ha colocado como Pendiente al mes de '.$mes.' del Estacionamiento: '.$estacionamiento.'');
                        return redirect()->back();
                   } else {
                       toastr()->warning('verifique el código de transacción!!', 'La información no pudo ser encontrada');
                        return redirect()->back();
                   }
                } else {
                    # en caso de colocarlo como cancelado
                    $pagos=PagosE::where('id_mens_estac',$request->id_estacionamiento)->first();
                    //dd($pagos->mensualidad->estacionamientos->residentes[0]->pivot->id_residente);
                    $id_user=$pagos->mensualidad->estacionamientos->residentes[0]->pivot->id_residente;
                    $pagos->status="Cancelado";
                    $pagos->save();
                    
                    $factura="Estacionamiento: ".$pagos->mensualidad->estacionamientos->idem." Mes: ".$this->mostrar_mes($pagos->mensualidad->mes)." Monto: ".$pagos->mensualidad->monto."<br>";

                    $factura.="<br></br>Total Cancelado: ".$pagos->mensualidad->monto.", con la referencia: ".$request->referencia_edit."<br>";
                    $reporte=\DB::table('reportes_pagos')->insert([
                        'referencia' => $request->referencia_edit,
                        'reporte' => $factura,
                        'id_residente' => $id_user
                    ]);
                    toastr()->success('con éxito!!', 'Se ha colocado como Cancelado al mes de '.$this->mostrar_mes($pagos->mensualidad->mes).' del Estacionamiento: '.$pagos->mensualidad->estacionamientos->idem.'');
                        return redirect()->back();
                }
                
               
                break;
            case 3:
            //multas y Recargas
            if(!is_null($request->id_multa)){
                $pago=MultasRecargas::find($request->id_multa);

                $sql="SELECT * FROM `reportes_pagos` where referencia='".$request->referencia_edit."' AND tipo='Cancelado' AND reporte LIKE '%".$pago->motivo."%' ORDER BY id DESC LIMIT 0,1";
                //dd($sql2);
                $buscar=\DB::select($sql);
                
               if (count($buscar)>0) {
                    $reporte_new=new Reportes();
                    $reporte_new->referencia=$request->referencia_edit;
                    $reporte_new->reporte="Se ha colocado como Pendiente la ".$pago->tipo.": ".$pago->motivo;
                    $reporte_new->tipo="Pendiente";
                    $reporte_new->id_residente=$request->id_residente_edit;
                    $reporte_new->save();
                    
                    foreach ($pago->residentes as $key) {
                        if ($key->pivot->id_residente==$request->id_residente_edit) {
                            $key->pivot->status="Recibida";
                            $key->pivot->save();
                        }
                        
                    }
                   toastr()->success('con éxito!!', 'Se ha colocado como Pendiente la '.$pago->tipo.': '.$pago->motivo.'');
                    return redirect()->back();
               } else {
                   toastr()->warning('Verifique el código de transacción!!', 'La información no pudo ser encontrada');
                    return redirect()->back();
               }
               }else{
                    toastr()->warning('Alerta!!', 'Verifique si ha suministrado los datos correctamente');
                    return redirect()->back();
               }
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pagos  $pagos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagos $pagos)
    {
        //
    }

    protected function mostrar_mes($num) {
        switch ($num) {
            case 1:
                return 'Enero';
                break;
            case 2:
                return 'Febrero';
                break;
            
            case 3:
                return 'Marzo';
                break;
            
            case 4:
                return 'Abril';
                break;
            
            case 5:
                return 'Mayo';
                break;
            
            case 6:
                return 'Junio';
                break;
            
            case 7:
                return 'Julio';
                break;
            
            case 8:
                return 'Agosto';
                break;
            
            case 9:
                return 'Septiembre';
                break;
            
            case 10:
                return 'Octubre';
                break;
            
            case 11:
                return 'Noviembre';
                break;
            
            case 12:
                return 'Diciembre';
                break;
            
            
        }
    }
    public function confirmar_multa(Request $request)
    {
        //dd($request->all());

        if (is_null($request->id_mr)) {
            toastr()->warning('intente otra vez!!', 'No se ha seleccionado ningún pago a confirmar');
            return redirect()->back();
        } else {
            $cont=0;
            $ref_ne[]=array();
            $j=0;
            for ($i=0; $i < count($request->id_mr); $i++) { 
                $residente=Residentes::find($request->id_residente);
                foreach ($residente->mr as $key) {
                    if($key->pivot->referencia==$request->referencia[$i] && $key->pivot->id_mr==$request->id_mr[$i] && $key->pivot->status=="Por Confirmar"){
                        $key->pivot->status="Pagada";
                        $key->pivot->save();
                    }else{
                        $ref_ne[$j]=$request->referencia[$i];
                    }
                }
            }

            //referencias no encontradas
                if(count($ref_ne)>0 && count($ref_ne)<count($request->id_mr)){
                    $mensaje="No fueron encontradas las siguientes referencias: ";
                    for ($i=0; $i < count($ref_ne); $i++) { 
                        $mensaje.=$ref_ne[$i];
                        if($i<count($ref_ne)){
                            $mensaje.",";
                        }
                    }
                    toastr()->success('con éxito!!', 'Fueron confirmadas las Multas/Recargar, sin embargo: '.$mensaje);
                }elseif(count($ref_ne)>0 && count($ref_ne)==count($request->id_mr)){
                    toastr()->warning('intente otra vez!!', 'No fue encontrada ningún código de transacción como registrado');
                }else{
                    toastr()->success('con éxito!!', 'Multas/Recargas confirmadas con éxito');
                }
                return redirect()->back();
        }
        
    }

    public function editar_referencia(Request $request)
    {
        // dd($request->all());

        //consultando datos de residente y multa
        $buscar=\DB::table('residentes')
        ->join('resi_has_mr','resi_has_mr.id_residente','=','residentes.id')
        ->join('multas_recargas','multas_recargas.id','=','resi_has_mr.id_mr')
        ->where('resi_has_mr.id',$request->id_pivot)
        ->select('multas_recargas.motivo','multas_recargas.tipo','residentes.nombres','residentes.apellidos','residentes.rut','resi_has_mr.referencia','residentes.id AS id_residente')->get();
        foreach ($buscar as $key) {
            $factura="La ".$key->tipo.": que fue asignada al residente: ".$key->apellidos.", ".$key->nombres." RUT: ".$key->rut.", cuyo Códido de Transacción era: ".$key->referencia." ha sido cambiado a :".$request->ReferenciaNueva;
            $id_user=$key->id_residente;
        }
        //dd($factura);
        \DB::table('resi_has_mr')
        ->where('id',$request->id_pivot)
        ->update([
            'referencia' => $request->ReferenciaNueva,
        ]);

        $reporte=\DB::table('reportes_pagos')->insert([
                        'referencia' => $request->ReferenciaNueva,
                        'reporte' => $factura,
                        'id_residente' => $id_user
                    ]);

        toastr()->success('con éxito!!', 'Referencia modificada');
        return redirect()->back();


    }

    public function eliminar_mr(Request $request)
    {
        //dd($request->all());
        \DB::table('resi_has_mr')->where('id',$request->id_pivot)->delete([
            'id' => $request->id_pivot,
        ]);

        toastr()->success('con éxito!!', 'Multa y/o Recarga eliminada satisfactoriamente');
        return redirect()->back();
    }

    public function editar_referencia2(Request $request)
    {
        //dd($request->all());
        $pago=Pagos::find($request->id_pago);
        //dd($pago->mensualidad->inmuebles->residentes[0]->apellidos);
        $factura="El Pago de Condominio correspondiente al mes: ".meses($pago->mensualidad->mes)." del Residente: ".$pago->mensualidad->inmuebles->residentes[0]->apellidos.", ".$pago->mensualidad->inmuebles->residentes[0]->nombres." RUT: ".$pago->mensualidad->inmuebles->residentes[0]->rut.", cuyo Códido de Transacción era:  ".$pago->referencia.", ha sido cambiado a: ".$request->ReferenciaNueva;
        
        $id_user=$pago->mensualidad->inmuebles->residentes[0]->id;

        $pago->referencia=$request->ReferenciaNueva;
        $pago->save();


        $reporte=\DB::table('reportes_pagos')->insert([
                        'referencia' => $request->ReferenciaNueva,
                        'reporte' => $factura,
                        'id_residente' => $id_user
                    ]);

        toastr()->success('con éxito!!', 'Referencia modificada');
        return redirect()->back();        
    }

    public function consultas($id_residente)
    {
        $anio=date('Y');
        $status_pago=array();
        $inmuebles=array();
        $i=0;
        $buscar=Residentes::find($id_residente);
        foreach ($buscar->inmuebles as $key) {
            if($key->pivot->status=="En Uso"){
                foreach ($key->mensualidades as $key2) {
                    if($key2->anio==$anio && $i <= 11){
                        $pago=\App\Pagos::where('id_mensualidad',$key2->id)->orderby('id','DESC')->first();
                            $inmuebles[$i]=$key->idem;
                            $status_pago[$i][0]=meses($key2->mes);
                            $status_pago[$i][1]=$pago->status;
                            if(!is_null($pago->referencia)){
                            $status_pago[$i][2]=$pago->referencia;
                            }else{
                                $status_pago[$i][2]="";
                            }
                            $status_pago[$i][3]=$pago->id;
                    }
                    $i++;
                }
            }
        }
        $anio= array();
        $a=anios_registros();
        
        for ($i=0; $i < count(anios_registros()); $i++) { 
            $anio[$i]=$a[$i]['anio'];
        }
        //dd($status_pago);
        return view('consultas.index',compact('status_pago','buscar','anio','inmuebles'));
    }

    protected function generarOrden()
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;   
    }
}
