<?php

namespace App\Http\Controllers;

use App\Promociones;
use App\PlanesPago;
use Illuminate\Http\Request;

class PromocionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


        if ($request->porcentaje=="") {
            toastr()->warning('intente otra vez!!', 'Debe ingresar un porcentaje');
            return redirect()->back();
        } elseif($request->duracion=="") {
            toastr()->warning('intente otra vez!!', 'Debe ingresar una duración');
            return redirect()->back();
        }else{


            $planesPago=PlanesPago::find($request->id_planP);

            $promocion=new Promociones();
            $promocion->duracion=$request->duracion;
            $promocion->porcentaje=$request->porcentaje;
            $promocion->id_planP=$planesPago->id;
            
            $promocion->save();


            toastr()->success('con éxito!', 'La promoción ha sido registrada');
            return redirect()->to('planes_pago');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promociones  $promociones
     * @return \Illuminate\Http\Response
     */
    public function show(Promociones $promociones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promociones  $promociones
     * @return \Illuminate\Http\Response
     */
    public function edit(Promociones $promociones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promociones  $promociones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promociones $promociones)
    {
        // dd($request->all());
        $promocion=Promociones::find($request->id);
        $promocion->id_planP    =$request->id_planP;
        $promocion->porcentaje  =$request->porcentaje;
        $promocion->duracion    =$request->duracion;
        $promocion->status      =$request->status;

        if ($promocion->save()) {
            toastr()->success('con éxito!!', 'La Promoción ha sido editada');
            return redirect()->to('planes_pago');
        } else {
            toastr()->warning('Fallo!!', 'La Promoción no pudo ser editada');
            return redirect()->to('planes_pago');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promociones  $promociones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $promociones)
    {
        // dd($request->all());
        $promocion=Promociones::find($request->id);
        
        if ($promocion->delete()) {
            toastr()->success('con éxito!!', 'La Promoción ha sido eliminada');
            return redirect()->to('planes_pago');
        } else {
            toastr()->warning('Fallo!!', 'La Promoción no pudo ser eliminada');
            return redirect()->to('planes_pago');
        }
    }
}
