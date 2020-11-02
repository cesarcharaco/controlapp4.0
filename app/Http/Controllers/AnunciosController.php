<?php

namespace App\Http\Controllers;

use App\Anuncios;
use Illuminate\Http\Request;
use App\Http\Requests\AnunciosRequest;
use App\Http\Requests\AnunciosUpdateRequest;
use App\AdminsAnuncios;
use App\UsersAdmin;
use App\Empresas;
use App\EmpresasAnuncios;
use App\PlanesPago;
use App\Promociones;
use App\PagosAnuncios;
use App\PlanesAnuncios;
use DB;

class AnunciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fecha1 =   Date('Y-m-d');
        $anio=Date('Y');
        $anunciosStatus=EmpresasAnuncios::where('status','Activo')->get();
        if (!is_null($anunciosStatus)) {
            for ($i=0; $i < count($anunciosStatus); $i++) { 
                $fecha2 =   Date($anunciosStatus[$i]->fecha_termino);

                if($fecha1 > $fecha2){
                    $anunciosStatus[$i]->status = 'Inactivo';
                    $anunciosStatus[$i]->save();
                }
            }
        }
        if(\Auth::user()->tipo_usuario == 'root'){
            $promociones=Promociones::all();
            $empresas = Empresas::all();
            $users_admin = UsersAdmin::all();
            $anuncios=Anuncios::all();

            $anunActivos=PlanesAnuncios::where('status','Activo')->count();
            $anunInactivos=PlanesAnuncios::where('status','Inactivo')->count();
            $anunAnio=PlanesAnuncios::all();
            $pagosAnunciosMontos=PagosAnuncios::all();

            $anunAnioActual=0;
            $anunAnioAnterior=0;
            $anunAnioAntePasado=0;

            $anunAnioActualMonto=0;
            $anunAnioAnteriorMonto=0;
            $anunAnioAntePasadoMonto=0;

            for ($i=0; $i < count($anunAnio); $i++) { 
                for ($j=0; $j < count($pagosAnunciosMontos); $j++) { 
                    if ($anunAnio[$i]->created_at->year == $anio) {
                        $anunAnioActual++;
                        if ($pagosAnunciosMontos[$j]->id_planesA == $anunAnio[$i]->id) {
                            $anunAnioActualMonto=$anunAnioActualMonto+$pagosAnunciosMontos[$j]->monto;
                        }
                        // $anunAnioActualMonto=$anunAnioActualMonto+$anunAnio[$i]->created_at
                    }else if($anunAnio[$i]->created_at->year == $anio-1){
                        $anunAnioAnterior++;
                        if ($pagosAnunciosMontos[$j]->id_planesA == $anunAnio[$i]->id) {
                            $anunAnioAnteriorMonto=$anunAnioAnteriorMonto+$pagosAnunciosMontos[$j]->monto;
                        }
                        // $anunAnioAnteriorMonto=$anunAnioAnteriorMonto+$anunAnio[$i]->created_at
                    }
                    else if($anunAnio[$i]->created_at->year == $anio-2){
                        $anunAnioAntePasado++;
                        if ($pagosAnunciosMontos[$j]->id_planesA == $anunAnio[$i]->id) {
                            $anunAnioAntePasadoMonto=$anunAnioAntePasadoMonto+$pagosAnunciosMontos[$j]->monto;
                        }
                        // $anunAnioAntePasadoMonto=$anunAnioAntePasadoMonto+$anunAnio[$id]->created_at
                    }else{

                    }
                }
            }


            // dd($anunAnioActualMonto, $anunAnioAnteriorMonto,$anunAnioAntePasadoMonto);
            // $anunAnioAnterior=



            $EmpresasAnuncios=EmpresasAnuncios::all();
            $EmpresasAnuncios2=EmpresasAnuncios::where('id', '<>', 0)->groupBy('id_anuncios')->get();
            $planesPago=PlanesPago::where('tipo','Anuncio')->where('status','Activo')->get();
            $pagosAnuncios=PagosAnuncios::where('id','<>',0)->orderby('id','DESC')->get();

            return view('anuncios.index',compact('anuncios','users_admin','empresas','EmpresasAnuncios','planesPago','promociones','EmpresasAnuncios2','pagosAnuncios','anunActivos','anunInactivos','anunAnioActual','anunAnioAnterior','anunAnioAntePasado','anunAnioActualMonto','anunAnioAnteriorMonto','anunAnioAntePasadoMonto'));
        }else{
            toastr()->warning('no puede acceder!!', 'ACCESO DENEGADO');
            return redirect()->back();
        }
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
    public function store(AnunciosRequest $request)
    {
            // $monto=0;
         
        $validacion=$this->validar_imagen($request->file('imagen'));
        
        if(!$validacion['valida']){
            toastr()->warning('intente otra vez!!', $validacion['mensaje'].'');
            return redirect()->back();
        }
        $codigo=$this->generarCodigo();
        //$codigo="nnn";
        
            $validatedData = $request->validate([
                'imagen' => 'mimes:jpeg,png'
            ]);
            $file=$request->file('imagen');

            $name=$codigo."_".$file->getClientOriginalName();
            $file->move(public_path().'/images_anuncios/', $name);  
            $url ='images_anuncios/'.$name;            
            
        
            $anuncio=new Anuncios();
            $anuncio->titulo=$request->titulo;
            $anuncio->link=$request->link;
            $anuncio->descripcion=$request->descripcion;
            $anuncio->nombre_img=$name;
            $anuncio->url_img=$url;
            $anuncio->id_empresa=$request->id_empresa;
            $anuncio->save();
            
            $datos = $request['admins'];
            //dd($datos);
            if ($request->admins_todos!="1") {
                //dd('hola mundo');                
                foreach($datos as $selected){
                    //dd($selected);
                    $admins_anuncios = new AdminsAnuncios();
                    $admins_anuncios->id_users_admin=$selected;
                    $admins_anuncios->id_anuncios=$anuncio->id;
                    $admins_anuncios->save();
                }

            } else {
                $users_admin = UsersAdmin::where('status','activo')->get();
                $count=count($users_admin);
                //dd(($count));
                //$admins_anuncios = array();
                for($i=1;$i<=$count;$i++){
                    \DB::table('admins_has_anuncios')->insert([
                        'id_users_admin' => $i,
                        'id_anuncios' => $anuncio->id
                    ]);
                }

                /*foreach ($users_admin as $key) {
                    dd($key);
                    $admins_anuncios = new AdminsAnuncios();
                    $admins_anuncios->id_users_admin=$value;
                    $admins_anuncios->id_anuncios=$anuncio->id;
                    $admins_anuncios->save();
                }*/
            
            }

            $planPago=PlanesPago::find($request->planP);
            $promociones=Promociones::where('id_planP',$planPago->id)->first();

            if(!is_null($promociones)) {
                $monto=$planPago->monto*$promociones->porcentaje/100;
            }else{
                $monto=$planPago->monto;
            }
        
            // dd($monto);
            $fecha_actual=date('Y-m-d');
            $fecha_termino= date("Y-m-d",strtotime($fecha_actual."+ ".$planPago->dias." days"));

            $adminAnuncios=new EmpresasAnuncios();
            $adminAnuncios->id_anuncios     =$anuncio->id;
            $adminAnuncios->id_planP        =$request->planP;
            $adminAnuncios->fecha_orden     =$fecha_actual;
            $adminAnuncios->fecha_termino   =$fecha_termino;
            $adminAnuncios->save();

            $PagosAnuncios=new PagosAnuncios();
            $PagosAnuncios->referencia  = $request->referencia;
            $PagosAnuncios->monto       = $monto;
            $PagosAnuncios->id_planesA  = $adminAnuncios->id;
            $PagosAnuncios->save();

            // $PagosAnuncios=\DB::table('pagos_anuncios')->insert([
            //     'referencia'    => $request->referencia,
            //     'monto'         => $monto,
            //     'id_planesA'    => $adminAnuncios->id
            // ]);


            
       
        toastr()->success('con éxito!!','Anuncio registrado');
        return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anuncios  $anuncios
     * @return \Illuminate\Http\Response
     */
    public function show(Anuncios $anuncios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anuncios  $anuncios
     * @return \Illuminate\Http\Response
     */
    public function edit(Anuncios $anuncios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anuncios  $anuncios
     * @return \Illuminate\Http\Response
     */
    public function update(AnunciosUpdateRequest $request, $id_anuncio)
    {
        // dd($request->all());

        $codigo=$this->generarCodigo();
        //$codigo="nnn";
        $cambio=0;
        
        $anuncio=Anuncios::find($request->id_anuncio);
        if($request->imagen!==null){
            $validacion=$this->validar_imagen($request->file('imagen'));

            if(!$validacion['valida']){
                toastr()->warning('intente otra vez!!', $validacion['mensaje'].'');
                return redirect()->back();
            }else{
            $nombre=$anuncio->nombre_img;
            unlink(public_path().'/images_anuncios/'.$nombre);
            $file=$request->file('imagen');

            $name=$codigo."_".$file->getClientOriginalName();
            $file->move(public_path().'/images_anuncios/', $name);  
            $name = $name;
            $url ='images_anuncios/'.$name;
            $cambio=1;
            }
        }
            
        //dd('asasa');
            $anuncio->id_empresa=$request->id_empresa;
            $anuncio->titulo=$request->titulo;
            $anuncio->link=$request->link;
            $anuncio->descripcion=$request->descripcion;
            if($cambio==1){
                $anuncio->nombre_img=$name;
                $anuncio->url_img=$url;
            }
            $anuncio->save();




            // $planPago=PlanesPago::find($request->planP);
            // $fecha_actual=date('Y-m-d');
            // $fecha_termino= date("Y-m-d",strtotime($fecha_actual."+ ".$planPago->dias." days"));

            // $planesAnuncios = EmpresasAnuncios::where('id_anuncios',$anuncio->id)->first();
            // $PagosAnuncios=PagosAnuncios::where('id_planesA',$planesAnuncios->id)->where('referencia',$planesAnuncios->referencia)->first();

            // $planesAnuncios->id_planP = $request->planP;
            // $planesAnuncios->fecha_orden = $fecha_actual;
            // $planesAnuncios->fecha_termino = $fecha_termino;
            // $planesAnuncios->referencia = $request->referencia;
            // $planesAnuncios->save();
            

            // $promociones=Promociones::where('id_planP',$planPago->id)->first();

            // if(!is_null($promociones)) {
            //     $monto=$planPago->monto*$promociones->porcentaje/100;
            // }else{
            //     $monto=$planPago->monto;
            // }

            // $PagosAnuncios->referencia=$request->referencia;
            // $PagosAnuncios->save();

            toastr()->success('con éxito!!', 'Anuncio actualizado');
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anuncios  $anuncios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //dd($request->all());
        $anuncio=Anuncios::find($request->id);
        $nombre=$anuncio->nombre_img;
        if ($anuncio->delete()) {
            unlink(public_path().'/images_anuncios/'.$nombre);
            toastr()->success('con éxito!!', 'Anuncio eliminado');
            return redirect()->back();
        } else {
            toastr()->error('intente otra vez!!', 'El Anuncio no pudo ser eliminado');
            return redirect()->back();
        }
        

    }

    protected function generarCodigo() {
     $key = '';
     $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $max = strlen($pattern)-1;
     for($i=0;$i < 4;$i++){
        $key .= $pattern=mt_rand(0,$max);
    }
     return $key;
    }

    protected function validar_imagen($imagen)
    {
        //dd($imagen);
        $mensaje="";
        $valida=true;
        $img=getimagesize($imagen);
        $size=$imagen->getClientSize();
        $width=$img[0];
        $higth=$img[1];

        //dd($size."-".$width."-".$higth);

        if ($size>819200) {
            $mensaje="La imagen excede el límite de tamaño de 800 KB ";
            $valida=false;
        }

        if ($width>1024) {
            $mensaje.=" | La imagen excede el límite de ancho de 1024 KB ";
            $valida=false;
        }

        if ($higth>800) {
            $mensaje.=" | La imagen excede el límite de altura de 800 KB ";
            $valida=false;
        }

        $respuesta=['mensaje' => $mensaje,'valida' => $valida];

        return $respuesta;
    }

    public function desactivar_orden(Request $request)
    {
        dd($request->all());
        toastr()->success('¡Anuncio Desactivado!', 'El Anuncio a sido desactivado');
        return redirect()->back();
    }

    public function editar_orden_anuncio(Request $request)
    {
        // dd($request->all());
        $empresasA=EmpresasAnuncios::find($request->id);
        $planPago=PlanesPago::find($request->planP);

        $fecha_actual=$empresasA->fecha_orden;
        $fecha_termino= date("Y-m-d",strtotime($fecha_actual."+ ".$planPago->dias." days"));

        $empresasA->id_planP = $request->planP;
        $empresasA->fecha_termino = $fecha_termino;

        $PagosAnuncios=PagosAnuncios::find($request->id_pagos_anucios);
        $PagosAnuncios->referencia =$request->referencia_e;
        $PagosAnuncios->save();


        if ($empresasA->save()) {
            toastr()->success('¡Anuncio Editado!', 'El Anuncio a sido actualizado');
        }else{
            toastr()->error('¡Ocurrió un problema!', 'Inténte de nuevo editar el pago del anuncio');
        }

        return redirect()->back();
    }

    public function renovar_orden_anuncio(Request $request)
    {
        // dd($request->all());
        $anuncio=Anuncios::find($request->id_anuncio);

        $planPago=PlanesPago::find($request->planP);

        $fecha_actual=date('Y-m-d');
        $fecha_termino= date("Y-m-d",strtotime($fecha_actual."+ ".$planPago->dias." days"));

        $planesAnuncios = EmpresasAnuncios::where('id_anuncios',$anuncio->id)->first();
        $PagosAnuncios  =PagosAnuncios::where('id_planesA',$planesAnuncios->id)->first();

        $planesAnuncios->id_planP = $request->planP;
        $planesAnuncios->fecha_orden = $fecha_actual;
        $planesAnuncios->fecha_termino = $fecha_termino;
        $planesAnuncios->status = 'Activo';
        $planesAnuncios->save();
        

        $promociones=Promociones::where('id_planP',$planPago->id)->first();

        if(!is_null($promociones)) {
            $monto=$planPago->monto*$promociones->porcentaje/100;
        }else{
            $monto=$planPago->monto;
        }

       $PagosAnuncios=\DB::table('pagos_anuncios')->insert([
            'referencia'    => $request->referencia,
            'monto'         => $monto,
            'id_planesA'    => $planesAnuncios->id
        ]);


        toastr()->success('con éxito!!','Anuncio renovado');
        return redirect()->back();
    }

    public function renovar_anuncio(Request $request)
    {
        dd($request->all());
        toastr()->success('¡Anuncio Renovado!', 'El Anuncio ha sido renovado');
        return redirect()->back();
    }
}
