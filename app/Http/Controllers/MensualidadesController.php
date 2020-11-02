<?php

namespace App\Http\Controllers;

use App\Mensualidades;
use Illuminate\Http\Request;
use App\Inmuebles;
class MensualidadesController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$mensualidades=Mensualidades::all();
		$inmuebles=Inmuebles::all();

		return view('mensualidades.index',compact('mensualidades','inmuebles'));
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{

	}

	/**
	* Store a newly created resource in storage.

	*
	* @param \Illuminate\Http\Request $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		// dd($request->all());
		$buscar=Mensualidades::where('id_inmueble',$request->id_inmueble)->get();

		if (count($buscar)>0) {
			toastr()->warning('intente otra vez!!', 'Ya existen mensualidades registradas para este inmueble en el año seleccionado');
			return redirect()->back();

		} else {
			for($i=0;$i<count($request->mes);$i++){
				$mensualidad=new Mensualidades();
				$mensualidad->id_inmueble=$request->id_inmueble;
				$mensualidad->mes=$request->mes[$i];
				$mensualidad->anio=$request->anio;
				// $mensualidad->monto=$request->monto[$i];
				$mensualidad->monto=$request->monto;
				$mensualidad->save();
			}
			toastr()->success('con éxito!!', 'Mensualidades registradas');
		return redirect()->to('mensualidades');
	}

	}

	/**
	* Display the specified resource.
	*
	* @param \App\Mensualidades $mensualidades
	* @return \Illuminate\Http\Response
	*/
	public function show(Mensualidades $mensualidades)

	{
	//
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param \App\Mensualidades $mensualidades
	* @return \Illuminate\Http\Response
	*/
	public function edit($id_inmueble,$anio)
	{

	}


	public function buscarMesInmueble($id_inmueble){

		return \DB::table('inmuebles')
		->join('mensualidades','mensualidades.id_inmueble','=','inmuebles.id')
		->where('mensualidades.id',$id_inmueble)
		->select('inmuebles.idem','mensualidades.*')
		->get();

	}
	public function buscarMesEstacionamiento($id_estacionamiento){
		
		return \DB::table('estacionamientos')
		->join('mens_estac','mens_estac.id_estacionamiento','=','estacionamientos.id')
		->where('mens_estac.id',$id_estacionamiento)
		->select('estacionamientos.idem','mens_estac.*')
		->get();

	}

	/**
	* Update the specified resource in storage.
	*
	* @param \Illuminate\Http\Request $request
	* @param \App\Mensualidades $mensualidades
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $id_inmueble)
	{
		$buscar=Mensualidades::where('id_inmueble',$id_inmueble)->where('anio',$request->anio)->get();
		if (count($buscar)>0) {
		foreach ($buscar as $key) {
		$mensualidad=Mensualidades::find($key->id);
		$mensualidad->delete();
		}
		}
		for($i=0;$i<count($request->mes);$i++){
		$mensualidad=new Mensualidades();

		$mensualidad->id_inmueble=$request->id_inmueble;
		$mensualidad->mes=$request->mes[$i];
		$mensualidad->anio=$request->anio;
		$mensualidad->monto=$request->monto[$i];
		$mensualidad->save();
		}
		toastr()->success('con éxito!', 'Mensualidades actualizadas');
		return redirect()->to('mensualidades');

	}

	/**
	* Remove the specified resource from storage.
	*
	* @param \App\Mensualidades $mensualidades
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Request $request)
	{
		// $me=Mensualidades::where('id_inmueble',$request->id_inmueble)->where('anio',$request->anio)->get();
		$mensualidad=Mensualidades::find($request->id);
		$mensualidad->delete();
		toastr()->success('con éxito!', 'Mensualidades eliminadas');
		return redirect()->to('mensualidades');
	}
}