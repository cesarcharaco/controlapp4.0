<?php

namespace App\Http\Controllers;

use App\Contabilidad;
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
        $consulta_saldo = Contabilidad::all()->count();
        //dd($consulta_saldo);
        if($consulta_saldo==0){
            $saldo = 0;
        } else {
            $consulta_saldo = Contabilidad::all()->last();
            $saldo = $consulta_saldo->saldo;
            //dd($consulta_saldo);
        }
        //dd($saldo);
        $contabilidad = Contabilidad::where('id_mes',date('n'))->orderBy('id','desc')->get();
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
        $consulta_saldo = Contabilidad::all()->count();
        if($consulta_saldo==0){
            $saldo = 0;
        } else {
            $consulta_saldo = Contabilidad::all()->last();
            $saldo = $consulta_saldo->saldo;
        }
        //CONSULTA DE MOVIMIENTOS DE LA FECHA DE HOY
        $contabilidad = Contabilidad::whereDate('created_at', date('Y-m-d'))->orderBy('id','desc')->get();
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
        $saldo = Contabilidad::latest('saldo')->first();
        if ($saldo) {
            if ($request->egreso > $saldo->saldo) {
                toastr()->error('El monto de egreso es mayor al saldo disponible !!', 'Saldo Insuficiente');
                return redirect()->back();
            } else {
                $consulta_saldo = Contabilidad::latest('saldo')->first();
                $saldo = $consulta_saldo->saldo;
                //dd($saldo);
                $egreso = new Contabilidad();
                $egreso->id_mensualidad=null;
                $egreso->id_mes=date('n');
                $egreso->descripcion=$request->descripcion;
                $egreso->ingreso=0;
                $egreso->egreso=$request->egreso;
                $egreso->saldo=$saldo-$request->egreso;
                $egreso->save();

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
