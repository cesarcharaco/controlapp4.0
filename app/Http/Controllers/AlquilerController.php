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
        // dd($request->all());
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

    public function registrar_alquiler(Request $request)
    {
        // dd($request->all());
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

    public function editar_alquiler(Request $request)
    {
        //dd($request->all());
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
        //dd($request->all());
        $instalacion = Instalaciones::find($request->id);
        $instalacion->nombre=$request->nombre;
        $instalacion->hora_desde=$request->hora_desde;
        $instalacion->hora_hasta=$request->hora_hasta;
        $instalacion->max_personas=$request->max_personas;
        $instalacion->save();

        if (count($request->id_dia)>0) {
            for($i=0; $i<count($request->id_dia); $i++){
                \DB::table('instalaciones_has_dias')->where('id_instalacion',$request->id)
                ->update([
                    'id_dia' => $request->id_dia[$i]
                ]);
            }
        }
        toastr()->success('con éxito!', 'Instalación actualizada');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alquiler  $alquiler
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Alquiler $alquiler)
    {
        dd($request->all());
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
}
