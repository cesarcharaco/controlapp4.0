<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresas;

class EmpresasController extends Controller
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
        $empresas = new Empresas();
        $empresas->nombre = $request->nombre;
        $empresas->rut_empresa=$request->rut.'-'.$request->verificador;
        $empresas->descripcion=$request->descripcion;
        $empresas->status=$request->status;
        $empresas->save();

        toastr()->success('con éxito!!','Empresa registrada');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $empresas = Empresas::find($request->id);
        $empresas->nombre = $request->nombre;
        $empresas->rut_empresa=$request->rut.'.-'.$request->verificador;
        $empresas->descripcion=$request->descripcion;
        $empresas->status=$request->status;
        $empresas->save();

        toastr()->success('con éxito!!','Datos de empresa actualizado');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $empresa=Empresas::find($request->id);
        $empresa->delete();

        toastr()->success('¡Éxito!','¡Empresa eliminada con éxito!');
        return redirect()->back();
    }
}
