<?php

namespace App\Http\Controllers;

use App\PlanesPago;
use Illuminate\Http\Request;
use App\Http\Requests\PlanesPagosRequest;
use App\Http\Requests\PlanesPagosUpdateRequest;
use App\Promociones;

class PlanesPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planes_pago=PlanesPago::all();
        $promociones=Promociones::all();

        return View('planes_pago.index', compact('planes_pago','promociones'));
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
    public function store(PlanesPagosRequest $request)
    {
        
        // dd($request->all());
         
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
            $file->move(public_path().'/images_planes_p/', $name);  
            $url ='images_planes_p/'.$name;            
            
        
        $plan_pago=new PlanesPago();
        $plan_pago->nombre      =$request->nombre;
        $plan_pago->monto       =$request->monto;
        $plan_pago->dias        =$request->dias;
        $plan_pago->nombre_img  =$name;
        $plan_pago->url_img     =$url;
        $plan_pago->color       =$request->color;
        $plan_pago->tipo        =$request->tipo;
        $plan_pago->status      ='Activo';
        $plan_pago->save();            
       
        toastr()->success('con éxito!!','Plan de Pagos registrado');
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
    public function update(PlanesPagosUpdateRequest $request, $id)
    {
        // dd($request->all());
        $codigo=$this->generarCodigo();
        //$codigo="nnn";
        $cambio=0;
        
        $plan_pago=PlanesPago::find($request->id);
        if($request->imagen!==null){
            $validacion=$this->validar_imagen($request->file('imagen'));

            if(!$validacion['valida']){
                toastr()->warning('intente otra vez!!', $validacion['mensaje'].'');
                return redirect()->back();
            }else{
                $nombre=$plan_pago->nombre_img;
                unlink(public_path().'/images_planes_p/'.$nombre);
                $file=$request->file('imagen');

                $name=$codigo."_".$file->getClientOriginalName();
                $file->move(public_path().'/images_planes_p/', $name);  
                $name = $name;
                $url ='images_planes_p/'.$name;
                $cambio=1;
            }
        }
            
        //dd('asasa');
            $plan_pago->nombre      =$request->nombre;
            $plan_pago->monto       =$request->monto;
            $plan_pago->dias        =$request->dias;
            if($cambio==1){
                $plan_pago->nombre_img=$name;
                $plan_pago->url_img=$url;
            }
            $plan_pago->color       =$request->color;
            $plan_pago->tipo        =$request->tipo;
            $plan_pago->status      =$request->status;
            $plan_pago->save();

            // $plan_pago->titulo=$request->titulo;
            // $plan_pago->link=$request->link;
            // $plan_pago->descripcion=$request->descripcion;
            // if($cambio==1){
            //     $plan_pago->nombre_img=$name;
            //     $plan_pago->url_img=$url;
            // }
            // $plan_pago->save();

            toastr()->success('con éxito!!', 'Plan de Pagos actualizado');
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $planes_pago=PlanesPago::find($request->id);
        $nombre=$planes_pago->nombre_img;
        if ($planes_pago->delete()) {
            unlink(public_path().'/images_planes_p/'.$nombre);
            toastr()->success('con éxito!!', 'Plan de pago eliminado');
            return redirect()->back();
        } else {
            toastr()->error('intente otra vez!!', 'El plan de pago no pudo ser eliminado');
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
}
