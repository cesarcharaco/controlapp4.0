<?php

namespace App\Http\Controllers;

use App\Alquiler;
use Illuminate\Http\Request;
use App\PlanesPago;
use App\Residentes;
use App\Dias;
use App\Instalaciones;
use App\Http\Controllers\FlowAController;
use App\Http\FlowBuilder1;
use App\Contabilidad;
use App\ContabilidadSaldo;

class AlquilerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dias= Dias::all();
        if (\Auth::user()->tipo_usuario=="Residente") {
            $residente=Residentes::where('id_usuario',\Auth::user()->id)->first();
            $alquiler = Alquiler::where('id_residente',$residente->id)->get();

            /*$instalaciones = Instalaciones::leftJoin('alquiler','alquiler.id_instalacion','=','instalaciones.id')
            	->leftJoin('pagos_has_alquiler','pagos_has_alquiler.id_alquiler','=','alquiler.id')
            	->where('instalaciones.status','Activo')->get();*/

            $instalaciones = Instalaciones::where('status','Activo')->get();
            //dd($instalaciones);
        } else {
            $alquiler = Alquiler::all();
            $instalaciones = Instalaciones::all();
        }
        
        $id_admin=id_admin(\Auth::user()->email);
        $residentes=Residentes::where('id_admin',$id_admin)->get();
        $planesPago=PlanesPago::where('tipo','Alquiler')->where('status','Activo')->get();

        // $fechas_alquiler=\DB::table('instalaciones')
        //     ->join('alquiler','alquiler.id_instalacion','=','instalaciones.id')
        //     ->select('alquiler')


         $dias2=\DB::table('dias')
        ->join('instalaciones_has_dias','instalaciones_has_dias.id_dia','=','dias.id')
        ->join('instalaciones','instalaciones.id','=','instalaciones_has_dias.id_instalacion')
        ->where('dias.id','<>',0)
        ->select('dias.id')->groupBy('dias.id')->get();
        // dd($dias);


        return View('alquiler.index', compact('planesPago','residentes','dias','instalaciones','alquiler','dias2'));
    }

    public function index2()
    {
        $dias= Dias::all();
        if (\Auth::user()->tipo_usuario=="Residente") {
            $residente=Residentes::where('id_usuario',\Auth::user()->id)->first();
            $alquiler = Alquiler::where('id_residente',$residente->id)->get();

            /*$instalaciones = Instalaciones::leftJoin('alquiler','alquiler.id_instalacion','=','instalaciones.id')
                ->leftJoin('pagos_has_alquiler','pagos_has_alquiler.id_alquiler','=','alquiler.id')
                ->where('instalaciones.status','Activo')->get();*/

            $instalaciones = Instalaciones::where('status','Activo')->get();
            //dd($instalaciones);
        } else {
            $alquiler = Alquiler::all();
            $instalaciones = Instalaciones::all();
        }
        
        $id_admin=id_admin(\Auth::user()->email);
        $residentes=Residentes::where('id_admin',$id_admin)->get();
        $planesPago=PlanesPago::where('tipo','Alquiler')->where('status','Activo')->get();

        // $fechas_alquiler=\DB::table('instalaciones')
        //     ->join('alquiler','alquiler.id_instalacion','=','instalaciones.id')
        //     ->select('alquiler')


         $dias2=\DB::table('dias')
        ->join('instalaciones_has_dias','instalaciones_has_dias.id_dia','=','dias.id')
        ->join('instalaciones','instalaciones.id','=','instalaciones_has_dias.id_instalacion')
        ->where('dias.id','<>',0)
        ->select('dias.id')->groupBy('dias.id')->get();
        // dd($dias);


        return View('alquiler.index2', compact('planesPago','residentes','dias','instalaciones','alquiler','dias2'));
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
        if(is_null($request->id_dia)){
            toastr()->warning('Alerta!!', 'Debe seleccionar al menos un día de disponibilidad');
            return redirect()->back();            
        }else{
            if(empty($request->nombre)){
                toastr()->warning('Alerta!!', 'El nombre es obligatorio');
                return redirect()->back();            
            }else{
                if(empty($request->hora_desde) || empty($request->hora_hasta)){
                    toastr()->warning('Alerta!!', 'Debe indicar las horas de disponibilidad');
                    return redirect()->back();            
                }else{
                    if(empty($request->max_personas)){
                        toastr()->warning('Alerta!!', 'Debe indicar el máximo de personas');
                        return redirect()->back();            
                    }else{
                        if(strtotime($request->hora_desde) > strtotime($request->hora_hasta)){
                        toastr()->warning('Alerta!!', 'La Hora Desde no puede ser mayor a la Hora hasta');
                        return redirect()->back();
                        } else {
                            if (empty($request->costo_permanente) || empty($request->costo_temporal)) {
                                toastr()->warning('Alerta!!', 'Debe la cantidad de los monto de alquiler');
                                return redirect()->back();
                            }

                            $instalacion = new Instalaciones();
                            $instalacion->nombre=$request->nombre;
                            $instalacion->hora_desde=$request->hora_desde;
                            $instalacion->hora_hasta=$request->hora_hasta;
                            $instalacion->max_personas=$request->max_personas;
                            $instalacion->costo_permanente=$request->costo_permanente;
                            $instalacion->costo_temporal=$request->costo_temporal;
                            $instalacion->status="Activo";
                            $instalacion->save();

                            if (count($request->id_dia)>0) {
                                for($i=0; $i<count($request->id_dia); $i++){
                                    \DB::table('instalaciones_has_dias')->insert([
                                        'id_instalacion' => $instalacion->id,
                                        'id_dia' => $request->id_dia[$i]
                                    ]);
                                }
                            }

                            toastr()->success('con éxito!', 'Instalación registrada');
                            return redirect()->back();                            
                        }
                    }
                }
            }
        }
    }

    public function registrar_alquiler(Request $request)
    {
        //dd($request->all());
        if(is_null($request->id_instalacion)){
            toastr()->warning('Alerta!', 'No ha seleccionado la instalación');
            return redirect()->back();
        }else{
            if($request->tipo_alquiler=="Temporal" && (empty($request->fecha) || empty($request->hora))){
                toastr()->warning('Alerta!', 'Si selecciona Temporal debe indicar fecha y hora');
                return redirect()->back();
            }else{
                if($request->tipo_alquiler=="Temporal" && empty($request->num_horas)){
                    toastr()->warning('Alerta!', 'Debe indicar la cantidad de horas');
                    return redirect()->back();
                }else{
                    if(empty($request->referencia) && $request->pago_realizado==1){
                        toastr()->warning('Alerta!', 'Debe indicar la referencia de transacción');
                        return redirect()->back();
                    }else{
                        $buscar=Instalaciones::find($request->id_instalacion);
                        $dia=date('N',strtotime($request->fecha));
                        if($request->tipo_alquiler=="Temporal"){
                            $cont=0;
                            foreach($buscar->dias as $key){
                                if($key->id==$dia){
                                    $cont++;
                                }
                            }
                            if($cont==0){
                                toastr()->warning('Alerta!', 'Para la fecha seleccionada no está disponible la instalación');
                                return redirect()->back();  
                            }

                            
                            if(!$this->horasEntre($buscar->hora_desde,$buscar->hora_hasta,$request->hora)){
                                toastr()->warning('Alerta!', 'Para la hora seleccionada no está disponible la instalación');
                                return redirect()->back();  
                            }
                        
                            if($this->horasEntre2($buscar->hora_desde,$buscar->hora_hasta,$request->hora,$request->num_horas)!=$request->num_horas){
                                toastr()->warning('Alerta!', 'El número horas ingresadas supera la disponibilidad de la instalación');
                                return redirect()->back();  
                            }


                            //buscando alquileres en status Activos para buscar fechas comunes
                            $buscar_alquiler=Alquiler::where('id_instalacion',$request->id_instalacion)->where('status','Activo')->get();
                            $cont=0;
                            $fecha=\DateTime::createFromFormat('!Y-m-d',$request->fecha);
                            foreach($buscar_alquiler as $key){
                                $fechas_alquiler = \DateTime::createFromFormat('!Y-m-d',$key->fecha);
                                if($fecha==$fechas_alquiler){
                                    $hora_desde=\DateTime::createFromFormat('!H:i',$key->hora);
                                    $hora_hasta=\DateTime::createFromFormat('!H:i',$key->hora);
                                    for($i=0;$i<$request->num_horas;$i++){
                                        //sumando horas para obtener la hora_hasta
                                        $hora_hasta->modify('+1 hours');
                                    }

                                    if(!$this->horasEntre($hora_desde,$hora_hasta,$request->hora)){
                                        $cont++;
                                    }
                                
                                    if($this->horasEntre2($hora_desde,$hora_hasta,$request->hora,$request->num_horas)!=$request->num_horas){
                                        $cont++;
                                    }
                                }
                            }
                            if($cont>0){
                                toastr()->warning('Alerta!', 'No se encuentra disponible la instalación para dicha Fecha y/u Hora');
                                return redirect()->back();  
                            }


                        }else{
                            
                            $horas_disponibles = gmdate("H", strtotime($buscar->hora_hasta) - strtotime($buscar->hora_desde)); // feed seconds
                            if($request->num_horas > $horas_disponibles){
                                toastr()->warning('Alerta!', 'El número horas ingresadas supera la disponibilidad de la instalación');
                                return redirect()->back();
                            }
                        }                        

                        $alquiler = new Alquiler();
                        $alquiler->id_residente=$request->id_residente;
                        $alquiler->id_instalacion=$request->id_instalacion;
                        $alquiler->tipo_alquiler=$request->tipo_alquiler;
                        if($request->tipo_alquiler=="Temporal") {
                            $alquiler->fecha=$request->fecha;
                            $alquiler->hora=$request->hora;            
                        }
                        $alquiler->num_horas=$request->num_horas;
                        if(\Auth::user()->tipo_usuario=="Admin" && $request->referencia=="" && $request->pago_realizado!=1){
                            $alquiler->status='Inactivo';
                        } else {
                            $alquiler->status='Activo';
                        }
                        $alquiler->save();
                        if ($request->tipo_alquiler=="Permanente") {
                            if(\Auth::user()->tipo_usuario=="Admin" && $request->referencia!="" && $request->pago_realizado==1){
                                \DB::table('pagos_has_alquiler')->insert([
                                    'referencia'=> $request->referencia,
                                    'monto'     => $request->costo_permanente,
                                    'id_alquiler' => $alquiler->id,
                                    'status'=>'Pagado'
                                ]);

                                $id_admin=id_admin(\Auth::user()->email);

                                $consulta_saldo = ContabilidadSaldo::where('id_admin',$id_admin)->first();
                                if ($consulta_saldo==NULL) {
                                    $saldo=0;
                                } else {
                                    $saldo = $consulta_saldo->saldo;
                                }

                                $contabilidad=new Contabilidad();
                                $contabilidad->id_admin=$id_admin;
                                $contabilidad->id_mes=date('n');
                                $contabilidad->descripcion="Pago de arriendo de ".$alquiler->instalacion->nombre."";
                                $contabilidad->ingreso=$request->costo_permanente;
                                $contabilidad->egreso=0;
                                $contabilidad->save();
                                if ($consulta_saldo==NULL) {
                                    \DB::table('contabilidad_saldo')->insert([
                                        'id_admin' => $id_admin,
                                        'saldo' => $request->costo_permanente
                                    ]);
                                } else {
                                    \DB::table('contabilidad_saldo')->where('id_admin',$id_admin)
                                        ->update([
                                        'saldo' => $request->costo_permanente+$saldo
                                    ]);
                                }

                            } else {
                                \DB::table('pagos_has_alquiler')->insert([
                                    'referencia'=> $request->referencia,
                                    'monto'     => $request->costo_permanente,
                                    'id_alquiler' => $alquiler->id,
                                    'status'=>'No Pagado'
                                ]);
                            }
                        } else {
                            if(\Auth::user()->tipo_usuario=="Admin" && $request->referencia!="" && $request->pago_realizado==1){
                                \DB::table('pagos_has_alquiler')->insert([
                                    'referencia'=> $request->referencia,
                                    'monto'     => $request->monto,
                                    'id_alquiler' => $alquiler->id,
                                    'status'=>'Pagado'
                                ]);

                                $id_admin=id_admin(\Auth::user()->email);

                                $consulta_saldo = ContabilidadSaldo::where('id_admin',$id_admin)->first();
                                if ($consulta_saldo==NULL) {
                                    $saldo=0;
                                } else {
                                    $saldo = $consulta_saldo->saldo;
                                }

                                $contabilidad=new Contabilidad();
                                $contabilidad->id_admin=$id_admin;
                                $contabilidad->id_mes=date('n');
                                $contabilidad->descripcion="Pago de arriendo de ".$alquiler->instalacion->nombre."";
                                $contabilidad->ingreso=$request->monto;
                                $contabilidad->egreso=0;
                                $contabilidad->save();
                                if ($consulta_saldo==NULL) {
                                    \DB::table('contabilidad_saldo')->insert([
                                        'id_admin' => $id_admin,
                                        'saldo' => $request->monto
                                    ]);
                                } else {
                                    \DB::table('contabilidad_saldo')->where('id_admin',$id_admin)
                                        ->update([
                                        'saldo' => $request->monto+$saldo
                                    ]);
                                }

                            } else {
                                \DB::table('pagos_has_alquiler')->insert([
                                    'referencia'=> $request->referencia,
                                    'monto'     => $request->monto,
                                    'id_alquiler' => $alquiler->id,
                                    'status'=>'No Pagado'
                                ]);
                            }
                        }
                        

                        if ($request->pago_realizado==1 && $request->tipo_alquiler=="Permanente") {
                            //solo cambia a inactivo cuando es permanente y se ha confirmado el pago
                            $instalacion=Instalaciones::find($alquiler->id_instalacion);
                            $instalacion->status="Inactivo";
                            $instalacion->save();
                        }                        

                        toastr()->success('con éxito!', 'Alquiler registrada');
                        return redirect()->to('alquiler');
                    }
                }
            }

        }
    }

    public function editar_alquiler(Request $request)
    {
        //dd($request->all());
        if(is_null($request->id_instalacion)){
            toastr()->warning('Alerta!', 'No ha seleccionado la instalación');
            return redirect()->back();
        }else{
            if($request->tipo_alquiler=="Temporal" && (empty($request->fecha) || empty($request->hora))){
                toastr()->warning('Alerta!', 'Si selecciona Temporal debe indicar fecha y hora');
                return redirect()->back();
            }else{
                if(empty($request->num_horas)){
                    toastr()->warning('Alerta!', 'Debe indicar la cantidad de horas');
                    return redirect()->back();
                }else{
                    if(empty($request->referencia) && $request->pago_realizado==1){
                        toastr()->warning('Alerta!', 'Debe indicar la referencia de transacción');
                        return redirect()->back();
                    }else{
                        if($request->tipo_alquiler=="Temporal"){
                            $buscar=Instalaciones::find($request->id_instalacion);
                            $cont=0;
                            $dia=date('N',strtotime($request->fecha));
                            foreach($buscar->dias as $key){
                                if($key->id==$dia){
                                    $cont++;
                                }
                            }
                            if($cont==0){
                                toastr()->warning('Alerta!', 'Para la fecha seleccionada no está disponible la instalación');
                                return redirect()->back();  
                            }
                            
                            if(!$this->horasEntre($buscar->hora_desde,$buscar->hora_hasta,$request->hora)){
                                toastr()->warning('Alerta!', 'Para la hora seleccionada no está disponible la instalación');
                                return redirect()->back();  
                            }
                        
                            if($this->horasEntre2($buscar->hora_desde,$buscar->hora_hasta,$request->hora,$request->num_horas)!=$request->num_horas){
                                toastr()->warning('Alerta!', 'El número horas ingresadas supera la disponibilidad de la instalación');
                                return redirect()->back();  
                            }
                        }else{
                            $buscar=Instalaciones::find($request->id_instalacion);
                            $horas_disponibles = gmdate("H", strtotime($buscar->hora_hasta) - strtotime($buscar->hora_desde)); // feed seconds
                            if($request->num_horas > $horas_disponibles){
                                toastr()->warning('Alerta!', 'El número horas ingresadas supera la disponibilidad de la instalación');
                                return redirect()->back();
                            }
                        }

                        $alquiler =  Alquiler::find($request->id);
                        $alquiler->id_residente=$request->id_residente;
                        $alquiler->id_instalacion=$request->id_instalacion;
                        $alquiler->tipo_alquiler=$request->tipo_alquiler;
                        if($request->tipo_alquiler=="Temporal") {
                            $alquiler->fecha=$request->fecha;
                            $alquiler->hora=$request->hora;            
                        }
                        $alquiler->num_horas=$request->num_horas;
                        if(\Auth::user()->tipo_usuario=="Admin" && $request->referencia!=""){
                            $alquiler->status='Activo';
                        }
                        $alquiler->save();

                        $pagos=PlanesPago::find($request->planP);
                        if($request->admins_todos=="En Proceso"){
                            \DB::table('pagos_has_alquiler')->where('id_alquiler', $request->id)
                            ->update([
                                'referencia'=> $request->referencia,
                                'monto'     => $pagos->monto,
                                'id_planesPago' => $request->planP,
                                'status'=> "Pagado"
                            ]);
                        } else {
                            \DB::table('pagos_has_alquiler')->where('id_alquiler', $request->id)
                            ->update([
                                'referencia'=> $request->referencia,
                                'monto'     => $pagos->monto,
                                'id_planesPago' => $request->planP,
                                'status'=> "No Pagado"
                            ]);
                        }
                        
                        toastr()->success('con éxito!', 'Alquiler actualizado');
                        return redirect()->to('alquiler');
                    }
                }
            }
        }
    }

    public function edit_ref_alquiler(Request $request)
    {
        if(empty($request->ReferenciaNueva)){
            toastr()->warning('Alerta!', 'Debe indicar la referencia de la transacción');
            return redirect()->back();
        } else {
            \DB::table('pagos_has_alquiler')->where('id_alquiler', $request->id)
            ->update([
                'referencia'=> $request->ReferenciaNueva,
            ]);

            toastr()->success('con éxito!', 'Referencia de transacción actualizado satisfactoriamente');
            return redirect()->back();
        }
    }

    public function pagar_alquiler_resi(Request $request)
    {
        if ($request->flow==1) {
            //dd('flow');
            $request->referencia=$this->generarOrden();
            $orden_compra=$request->referencia;
            $buscar_alquiler = \DB::table('alquiler')
            ->join('instalaciones','instalaciones.id','=','alquiler.id_instalacion')
            ->join('pagos_has_alquiler','pagos_has_alquiler.id_alquiler','=','alquiler.id')
            ->where('alquiler.id',$request->id_alquiler)
            ->select('instalaciones.nombre as instalacion','alquiler.tipo_alquiler as tipo')
            ->first();
            //dd($buscar_alquiler);
            $nombre_instalacion = strtoupper($buscar_alquiler->instalacion);
            $tipo_alquiler = strtoupper($buscar_alquiler->tipo);
            $tipo_alq = $buscar_alquiler->tipo;
            if ($request->monto_alquiler >= 350) {
                //dd($request->all());
                $total = $request->monto_alquiler;
                $flowbuilder=new FlowBuilder1();
                $flowbuilder->setMontoA($request->monto_alquiler);
                $email_pagador = \Auth::User()->email;
                $concepto= "Pagar arriendo  de ".$nombre_instalacion.", tipo de alquiler ".$tipo_alquiler.".";
                $flowcontroller=new FlowAController();
                //Con este return nos vamos al controlador de FLOW
                return  $flowcontroller->orden_alquiler($request,$total,$concepto,$email_pagador,$orden_compra,$tipo_alq);
            } else {
                toastr()->error('ERROR!!', 'El monto a pagar debe ser mayor a 350 pesos chilenos');
                return redirect()->back();
            }
        } else {
            if (\Auth::user()->tipo_usuario=="Admin") {
                //dd($request->all());
                if ($request->status_arriendo=="En Proceso") {

                    if ($request->tipo_alq=="Permanente") {
                        $instalacion=Instalaciones::find($request->id_instalacion);
                        $instalacion->status="Inactivo";
                        $instalacion->save();
                    }
                    \DB::table('pagos_has_alquiler')->where('id_alquiler', $request->id_alquiler)
                        ->update([
                            'status'=> "Pagado"
                    ]);
                    
                    $id_admin=id_admin(\Auth::user()->email);

                    $consulta_saldo = ContabilidadSaldo::where('id_admin',$id_admin)->first();
                    if ($consulta_saldo==NULL) {
                        $saldo=0;
                    } else {
                        $saldo = $consulta_saldo->saldo;
                    }

                    $contabilidad=new Contabilidad();
                    $contabilidad->id_admin=$id_admin;
                    $contabilidad->id_mes=date('n');
                    $contabilidad->descripcion="Pago de arriendo de ".$request->instalacion."";
                    $contabilidad->ingreso=$request->monto;
                    $contabilidad->egreso=0;
                    $contabilidad->save();
                    if ($consulta_saldo==NULL) {
                        \DB::table('contabilidad_saldo')->insert([
                            'id_admin' => $id_admin,
                            'saldo' => $request->monto
                        ]);
                    } else {
                        \DB::table('contabilidad_saldo')->where('id_admin',$id_admin)
                            ->update([
                            'saldo' => $request->monto+$saldo
                        ]);
                    }

                    $instalacion=Alquiler::find($request->id_alquiler);
                    $instalacion->status="Activo";
                    $instalacion->save();

                    toastr()->success('con éxito!', 'Pago de arriendo realizado satisfactoriamente.');
                    return redirect()->back();
                } else {
                    if(empty($request->referencia)){
                        toastr()->warning('Alerta!', 'Debe indicar la referencia de la transacción');
                        return redirect()->back();
                    } else {
                        if ($request->tipo_alq=="Permanente") {
                            $instalacion=Instalaciones::find($request->id_instalacion);
                            $instalacion->status="Inactivo";
                            $instalacion->save();
                        }
                        \DB::table('pagos_has_alquiler')->where('id_alquiler', $request->id_alquiler)
                        ->update([
                            'referencia'=> $request->referencia,
                            'status'=> "Pagado"
                        ]);

                        $id_admin=id_admin(\Auth::user()->email);

                        $consulta_saldo = ContabilidadSaldo::where('id_admin',$id_admin)->first();
                        if ($consulta_saldo==NULL) {
                            $saldo=0;
                        } else {
                            $saldo = $consulta_saldo->saldo;
                        }

                        $contabilidad=new Contabilidad();
                        $contabilidad->id_admin=$id_admin;
                        $contabilidad->id_mes=date('n');
                        $contabilidad->descripcion="Pago de arriendo de ".$request->instalacion."";
                        $contabilidad->ingreso=$request->monto;
                        $contabilidad->egreso=0;
                        $contabilidad->save();
                        if ($consulta_saldo==NULL) {
                            \DB::table('contabilidad_saldo')->insert([
                                'id_admin' => $id_admin,
                                'saldo' => $request->monto
                            ]);
                        } else {
                            \DB::table('contabilidad_saldo')->where('id_admin',$id_admin)
                                ->update([
                                'saldo' => $request->monto+$saldo
                            ]);
                        }

                        $instalacion=Alquiler::find($request->id_alquiler);
                        $instalacion->status="Activo";
                        $instalacion->save();

                        toastr()->success('con éxito!', 'Pago de arriendo realizado satisfactoriamente.');
                        return redirect()->back();
                    }
                }
                
            } else {
                if(empty($request->referencia)){
                    toastr()->warning('Alerta!', 'Debe indicar la referencia de la transacción');
                    return redirect()->back();
                } else {
                    \DB::table('pagos_has_alquiler')->where('id_alquiler', $request->id_alquiler)
                    ->update([
                        'referencia'=> $request->referencia,
                        'status'=> "En Proceso"
                    ]);

                    toastr()->success('con éxito!', 'Pago de arriendo realizado satisfactoriamente, espere a que el admin lo confirme.');
                    return redirect()->back();
                }
            }
        }
        
        
    }

    public function eliminar_alquiler(Request $request)
    {
        //dd($request->all());
        $alquiler=Alquiler::find($request->id);
        $alquiler->delete();

        \DB::table('pagos_has_alquiler')->where('id_alquiler', $request->id)
        ->delete();

        $instalacion=Instalaciones::find($request->id_instalacion);
        $instalacion->status="Activo";
        $instalacion->save();

        toastr()->success('con éxito!', 'Alquiler Eliminado');
        return redirect()->to('alquiler');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alquiler  $alquiler
     * @return \Illuminate\Http\Response
     */
    public function show(Alquiler $alquiler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alquiler  $alquiler
     * @return \Illuminate\Http\Response
     */
    public function edit(Alquiler $alquiler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alquiler  $alquiler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alquiler $alquiler)
    {
        //
    }

    public function editar_instalacion(Request $request)
    {
        
        if(empty($request->nombre)){
            toastr()->warning('Alerta!!', 'El nombre es obligatorio');
            return redirect()->back();            
        }else{
            if(empty($request->hora_desde) || empty($request->hora_hasta)){
                toastr()->warning('Alerta!!', 'Debe indicar las horas de disponibilidad');
                return redirect()->back();            
            }else{
                if(empty($request->max_personas)){
                    toastr()->warning('Alerta!!', 'Debe indicar el máximo de personas');
                    return redirect()->back();            
                }else{

                    if(strtotime($request->hora_desde) > strtotime($request->hora_hasta)){
                        toastr()->warning('Alerta!!', 'La Hora Desde no puede ser mayor a la Hora hasta');
                        return redirect()->back();               
                    }

                    //dd($request->all());
                    $instalacion = Instalaciones::find($request->id);
                    $instalacion->nombre=$request->nombre;
                    $instalacion->hora_desde=$request->hora_desde;
                    $instalacion->hora_hasta=$request->hora_hasta;
                    $instalacion->max_personas=$request->max_personas;
                    $instalacion->costo_permanente=$request->costo_permanente;
                    $instalacion->costo_temporal=$request->costo_temporal;
                    $instalacion->save();

                    if(!is_null($request->dia)){
                        if (count($request->id_dia)>0) {
                            for($i=0; $i<count($request->id_dia); $i++){
                                \DB::table('instalaciones_has_dias')->where('id_instalacion',$request->id)
                                ->update([
                                    'id_dia' => $request->id_dia[$i]
                                ]);
                            }
                        }
                    }   
                    toastr()->success('con éxito!', 'Instalación actualizada');
                    return redirect()->back();
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alquiler  $alquiler
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Alquiler $alquiler)
    {
        //dd($request->all());
        /*$instalacion = Instalaciones::find($id);
        $instalacion->status='Inactivo';
        $instalacion->save();*/

        toastr()->warning('Alerta!', 'Imposible eliminar la instalación comuníquese con su proveedor de servicio');
        return redirect()->back();
    }

    public function statusinstalacion(Request $request)
    {
        $buscar_alquiler = Alquiler::where('id_instalacion',$request->id)->where('status','Activo')->count();
        //dd($buscar_alquiler);

        if ($request->status=="Activo") {
            $instalacion = Instalaciones::find($request->id);
            $instalacion->status='Inactivo';
            $instalacion->save();
        } else {
            if($buscar_alquiler==1) {
                toastr()->warning('Alerta!', 'Esta instalación posee un arriendo activo');
                return redirect()->back();
            } else {
                $instalacion = Instalaciones::find($request->id);
                $instalacion->status='Activo';
                $instalacion->save();                
            }
        }
        toastr()->success('con éxito!', 'Status cambiado satisfactoriamente');
        return redirect()->back();
    }

    public function eliminarInstalacion(Request $request)
    {
        

        $instalacion = Instalaciones::find($request->id);

        if($instalacion->status=="Inactiva"){
            //esta alquilada
            $alquiler=Alquiler::where('id_instalacion',$request->id)->get();
            $buscar_alquiler=Alquiler::where('id_instalacion',$request->id)->where('status','Inactivo')->count();
            if($buscar_alquiler>0){
                toastr()->warning('Alerta!', 'La Instalación no puede ser eliminada, tiene un Alquiler <b>Activo</b>');
                    return redirect()->back();    
            }else{
                foreach($alquiler as $key){

                    //buscando pagos realizados
                    $buscar = Alquiler::join('pagos_has_alquiler','pagos_has_alquiler.id_alquiler','=','alquiler.id')
                    ->select('alquiler.status AS status_alquiler','pagos_has_alquiler.id_alquiler AS id_alquiler')
                    ->where('alquiler.id_instalacion',$request->id)->count();
                    if($buscar>0){
                        //hay pagos realizados
                        \DB::table('pagos_has_alquiler')->where('id_alquiler', $buscar_alquiler->id_alquiler)->delete();
                    }    
                    $key->delete();
                }

                $instalacion->delete();
            }

            

        }else{
            //no esta alquilada
            $alquiler=Alquiler::where('id_instalacion',$request->id)->get();
            foreach($alquiler as $key){
                //buscando pagos realizados
                $buscar = Alquiler::join('pagos_has_alquiler','pagos_has_alquiler.id_alquiler','=','alquiler.id')
                ->select('alquiler.status AS status_alquiler','pagos_has_alquiler.id_alquiler AS id_alquiler')
                ->where('alquiler.id_instalacion',$request->id)->count();
                if($buscar>0){
                    //hay pagos realizados
                    \DB::table('pagos_has_alquiler')->where('id_alquiler', $buscar_alquiler->id_alquiler)->delete();
                }    
                $key->delete();
            }
            $instalacion->delete();
            toastr()->success('con éxito!', 'Instalación eliminada satisfactoriamente');
            return redirect()->back();
        }

            

    }

    protected function horasEntre($desde,$hasta,$hora){
        $dateDesde = \DateTime::createFromFormat('!H:i',$desde);
        $dateHasta = \DateTime::createFromFormat('!H:i',$hasta);
        $dateHora = \DateTime::createFromFormat('!H:i',$hora);

        if($dateDesde > $dateHasta) $dateHasta->modify('+1 day');

        return ($dateDesde <= $dateHora && $dateHora <= $dateHasta) || ($dateDesde <= $dateHora->modify('+1 day') && $dateHora <= $dateHasta);
    }
    protected function horasEntre2($desde,$hasta,$hora,$num_horas){
        $cont=0;
        //dd($num_horas);
        $dateDesde = \DateTime::createFromFormat('!H:i',$desde);
        $dateHasta = \DateTime::createFromFormat('!H:i',$hasta);
        $dateHora = \DateTime::createFromFormat('!H:i',$hora);

        if($dateDesde > $dateHasta){ $dateHasta->modify('+1 day'); }

        for($i=1 ; $i <= $num_horas; $i++){
            if(($dateDesde <= $dateHora && $dateHora <= $dateHasta) || ($dateDesde <= $dateHora->modify('+1 day') && $dateHora <= $dateHasta)){
                $cont++;
            }
            $dateHora->modify('+1 hours');
            /*echo $dateHora->format('H:i')."| ";*/
        }
        //dd($cont);
        return $cont;
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
