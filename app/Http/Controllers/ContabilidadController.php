<?php

namespace App\Http\Controllers;

use App\Contabilidad;
use App\ContabilidadSaldo;
use App\Residentes;
use Illuminate\Http\Request;
Use \Carbon\Carbon;
use PDF;

class ContabilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_admin=id_admin(\Auth::user()->email);
        $consulta_saldo = ContabilidadSaldo::where('id_admin',$id_admin)->first();

        //dd($consulta_saldo);

        if($consulta_saldo==null){
            $saldo = 0;
        } else {
            $saldo = $consulta_saldo->saldo;
        }

        $contabilidad = Contabilidad::where('id_mes',date('n'))
        ->where('id_admin',$id_admin)
        ->orderBy('id','desc')->get();

        return View('contabilidad.index', compact('contabilidad','saldo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //CONSULTA DE SALDO
        $id_admin=id_admin(\Auth::user()->email);
        $consulta_saldo = ContabilidadSaldo::where('id_admin',$id_admin)->first();

        //dd($consulta_saldo);

        if($consulta_saldo==null){
            $saldo = 0;
        } else {
            $saldo = $consulta_saldo->saldo;
        }

        //CONSULTA DE MOVIMIENTOS DE LA FECHA DE HOY
        $contabilidad = Contabilidad::where('id_admin',$id_admin)
        ->whereDate('created_at', date('Y-m-d'))
        ->orderBy('id','desc')->get();

        //$contabilidad = Contabilidad::whereDate('created_at', date('Y-m-d'))->orderBy('id','desc')->get();
        $pdf=0;
        // FILTRO DE BUSQUEDA
        if ($request->filtro=="7dias") {
            $pdf="7dias";
            $contabilidad  = Contabilidad::whereBetween('created_at',[now()->subDays(7)->format('Y-m-d'),now()->addDays(1)->format('Y-m-d')])->orderBy('id','desc')->get();
        } else if($request->filtro=="30dias") {
            $pdf="30dias";
            $contabilidad  = Contabilidad::whereBetween('created_at',[now()->subDays(30)->format('Y-m-d'),now()->addDays(1)->format('Y-m-d')])->orderBy('id','desc')->get();
        } else if($request->filtro=="rango_fecha") {
            //dd($request->all());
            $pdf="rango_fecha";
            if($request->fecha_desde > $request->fecha_hasta) {
                toastr()->error('La fecha de inicio no puede ser mayor a fecha final !!', 'Vuelva a ingresar los datos');
                return redirect()->back();
            }
            $contabilidad  = Contabilidad::whereBetween('created_at',[$request->fecha_desde,$request->fecha_hasta])->get();
            $contabilidad1  = Contabilidad::whereBetween('created_at',[$request->fecha_desde,$request->fecha_hasta])->count();
            //dd($contabilidad);
            if($contabilidad1==0) {
                toastr()->error('No se encontraron datos en las fechas seleccionadas !!', 'No hay datos');
                return redirect()->back();
            }
        } elseif($request->filtro=="meses") {
            
        }
         
        return view('contabilidad.create', compact('saldo','contabilidad','pdf'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_admin=id_admin(\Auth::user()->email);
        $saldo = ContabilidadSaldo::where('id_admin',$id_admin)->first();
        if ($saldo) {
            if ($request->egreso > $saldo->saldo) {
                toastr()->error('El monto de egreso es mayor al saldo disponible !!', 'Saldo Insuficiente');
                return redirect()->back();
            } else {
                $consulta_saldo = ContabilidadSaldo::where('id_admin',$id_admin)->first();
                $saldo = $consulta_saldo->saldo;
                //dd($saldo);
                $egreso = new Contabilidad();
                $egreso->id_admin=$id_admin;
                $egreso->id_mes=date('n');
                $egreso->descripcion=$request->descripcion;
                $egreso->ingreso=0;
                $egreso->egreso=$request->egreso;
                $egreso->save();

                \DB::table('contabilidad_saldo')->where('id_admin',$id_admin)
                    ->update([
                    'saldo' => $saldo-$request->egreso
                ]);

                toastr()->success('Egreso registrado con éxito !!', 'Éxito');
                return redirect()->back();
            }
        }else{
            toastr()->error('No hay saldo disponible para un nuevo egreso!!', 'Saldo Insuficiente');
            return redirect()->back();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contabilidad  $contabilidad
     * @return \Illuminate\Http\Response
     */
    public function show(contabilidad $contabilidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\contabilidad  $contabilidad
     * @return \Illuminate\Http\Response
     */
    public function edit(contabilidad $contabilidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contabilidad  $contabilidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, contabilidad $contabilidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contabilidad  $contabilidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(contabilidad $contabilidad)
    {
        //
    }

    public function reportes_mensual_pdf(Request $request) {
        if($request->pdf==0){
            $contabilidad = Contabilidad::whereDate('created_at', date('Y-m-d'))->orderBy('id','desc')->get();
        } elseif ($request->pdf=="7dias"){
            $contabilidad  = Contabilidad::whereBetween('created_at',[now()->subDays(7)->format('Y-m-d'),now()->addDays(1)->format('Y-m-d')])->orderBy('id','desc')->get();
        } elseif ($request->pdf=="30dias"){
            $contabilidad  = Contabilidad::whereBetween('created_at',[now()->subDays(30)->format('Y-m-d'),now()->addDays(1)->format('Y-m-d')])->orderBy('id','desc')->get();
        } elseif ($request->pdf=="rango_fecha"){
            $contabilidad  = Contabilidad::whereBetween('created_at',[$request->fecha_desde,$request->fecha_hasta])->get();
        }
        $pdf = PDF::loadView('contabilidad/pdf/reportes_mensual_pdf', array('contabilidad'=>$contabilidad));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('reportes_mensual_pdf.pdf');
    }
}
