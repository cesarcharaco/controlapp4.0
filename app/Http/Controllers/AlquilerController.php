<?php

namespace App\Http\Controllers;

use App\Alquiler;
use Illuminate\Http\Request;
use App\PlanesPago;
use App\Residentes;
use App\Dias;
use App\Instalaciones;
// use App\Instalaciones;

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
        $alquiler = Alquiler::all();
        $instalaciones = Instalaciones::all();
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
                            $instalacion = new Instalaciones();
                            $instalacion->nombre=$request->nombre;
                            $instalacion->hora_desde=$request->hora_desde;
                            $instalacion->hora_hasta=$request->hora_hasta;
                            $instalacion->max_personas=$request->max_personas;
                            $instalacion->status=$request->status;
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

    public function registrar_alquiler(Request $request)
    {
        //dd($request->all());
                    
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
                    
                        if($this->horasEntre2($buscar->hora_desde,$buscar->hora_hasta,$request->hora,$request->num_horas)>0){
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



                    $alquiler = new Alquiler();
                    $alquiler->id_residente=$request->id_residente;
                    $alquiler->id_instalacion=$request->id_instalacion;
                    $alquiler->tipo_alquiler=$request->tipo_alquiler;
                    if($request->tipo_alquiler=="Temporal") {
                        $alquiler->fecha=$request->fecha;
                        $alquiler->hora=$request->hora;            
                    }
                    $alquiler->num_horas=$request->num_horas;
                    $alquiler->status=$request->status;
                    $alquiler->save();

                    $pagos=PlanesPago::find($request->planP);

                    \DB::table('pagos_has_alquiler')->insert([
                        'referencia'=> $request->referencia,
                        'monto'     => $pagos->monto,
                        'id_alquiler' => $alquiler->id,
                        'id_planesPago' => $request->planP,
                        'status'=>'En Proceso'
                    ]);

                    $instalacion=Instalaciones::find($alquiler->id_instalacion);
                    $instalacion->status="Inactivo";
                    $instalacion->save();

                    toastr()->success('con éxito!', 'Alquiler registrada');
                    return redirect()->to('alquiler');
                }
            }
        }
    }

    public function editar_alquiler(Request $request)
    {
        //dd($request->all());
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
                    
                        if($this->horasEntre2($buscar->hora_desde,$buscar->hora_hasta,$request->hora,$request->num_horas)>0){
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
                    $alquiler->status=$request->status;
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
                            'status'=> "En Proceso"
                        ]);
                    }
                    
                    toastr()->success('con éxito!', 'Alquiler actualizado');
                    return redirect()->to('alquiler');
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

                    //dd($request->all());
                    $instalacion = Instalaciones::find($request->id);
                    $instalacion->nombre=$request->nombre;
                    $instalacion->hora_desde=$request->hora_desde;
                    $instalacion->hora_hasta=$request->hora_hasta;
                    $instalacion->max_personas=$request->max_personas;
                    $instalacion->status=$request->status;
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
        $instalacion = Instalaciones::find($id);
        $instalacion->status='Inactivo';
        $instalacion->save();

        toastr()->success('con éxito!', 'instalación deshabilitada');
        return redirect()->back();
    }

    public function desactivar_instalacion(Request $request)
    {
        //dd($request->all());
        $instalacion = Instalaciones::find($request->id);
        $instalacion->status='Inactivo';
        $instalacion->save();

        toastr()->success('con éxito!', 'instalación deshabilitada');
        return redirect()->back();
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
            $dateHora->modify('+1 hours');
            echo $dateHora->format('H:i')."| ";
            if(!($dateDesde <= $dateHora && $dateHora <= $dateHasta) || ($dateDesde <= $dateHora->modify('+1 day') && $dateHora <= $dateHasta)){
                $cont++;
            }
        }
        //dd($cont);
        return $cont;
    }
}
