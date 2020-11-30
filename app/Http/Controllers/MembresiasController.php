<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Membresias;
use App\UsersAdmin;

class MembresiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $membresias=Membresias::all();
        $num=0;

        return view('membresias.index', compact('membresias','num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('membresias.create');
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
        $validacion=$this->validar_imagen($request->file('url_imagen'));
        
        if(!$validacion['valida']){
            toastr()->warning('intente otra vez!!', $validacion['mensaje'].'');
            return redirect()->back();
        }else{
        
            if (is_null($request->nombre)) {
                toastr()->warning('intente otra vez!!', 'Debe ingresar el nombre de la membresía');
                return redirect()->back();
            } else {
                if (is_null($request->cant_inmuebles)) {
                    toastr()->warning('intente otra vez!!', 'Debe ingresar la cantidad de inmuebles disponibles para la membresía');
                    return redirect()->back();
                } else {    
                    if (is_null($request->monto)) {
                        toastr()->warning('intente otra vez!!', 'Debe ingresar el monto a pagar por la membresía');
                        return redirect()->back();
                    } else {    

                        $buscar=Membresias::where('nombre',$request->nombre)->count();
                        if ($buscar>0) {
                            toastr()->warning('intente otra vez!!', 'Nombre ya registrado');
                            return redirect()->back();
                        } else {
        // dd($request->all());
                            $validatedData = $request->validate([
                                'url_imagen' => 'mimes:jpeg,png'
                            ]);
                            $file=$request->file('url_imagen');
                            $codigo=$this->generarCodigo();
                            $name=$codigo."_".$file->getClientOriginalName();
                            $file->move(public_path().'/assets/images/', $name);  
                            $url ='/assets/images/'.$name;

                            $membresia= new Membresias();
                            $membresia->url_imagen=$url;
                            $membresia->monto=$request->monto;
                            $membresia->nombre=$request->nombre;
                            $membresia->cant_inmuebles=$request->cant_inmuebles;
                            $membresia->save();
                            toastr()->success('Éxito!!', 'Membresía registrada');
                            return redirect()->to('membresias');
                        }
                    }
                }           
            }
        }
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
    public function edit($id_membresia)
    {
        $membresia=Membresias::find($id_membresia);

        return view('membresias.edit',compact('membresia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_membresia)
    {
        // dd($request->all());
        $validacion=array();
        //dd(is_null($request->cambiar_imagen));
        if (is_null($request->cambiar_imagen)) {
            $pasar=1;
            $validacion['valida']=false;
        } else {
            $validacion['valida']=$this->validar_imagen($request->file('url_imagen'));
            $pasar=0;
        }
        
        
        if(!$validacion['valida'] && $pasar==0){
            toastr()->warning('intente otra vez!!', $validacion['mensaje'].'');
            return redirect()->back();
        }else{
        
            if (is_null($request->nombre)) {
                toastr()->warning('intente otra vez!!', 'Debe ingresar el nombre de la membresía');
                return redirect()->back();
            } else {
                if (is_null($request->cant_inmuebles)) {
                    toastr()->warning('intente otra vez!!', 'Debe ingresar la cantidad de inmuebles disponibles para la membresía');
                    return redirect()->back();
                } else {    
                    if (is_null($request->monto)) {
                        toastr()->warning('intente otra vez!!', 'Debe ingresar el monto a pagar por la membresía');
                        return redirect()->back();
                    } else {    

                        $buscar=Membresias::where('nombre',$request->nombre)->where('id','<>',$request->id)->count();
                        if ($buscar>0) {
                            toastr()->warning('intente otra vez!!', 'Nombre ya registrado');
                            return redirect()->back();
                        } else {
                            $membresia=  Membresias::find($request->id);
                            if($pasar==0){
                                //eliminando imagen anterior
                                $url_imagen=$membresia->url_imagen;
                                //dd(public_path().''.$url_imagen);
                                unlink(public_path().'/'.$url_imagen);
                                //--------------------------
                                $file=$request->file('url_imagen');
                                $validatedData = $request->validate([
                                    'url_imagen' => 'mimes:jpeg,png'
                                ]);
                                $file=$request->file('url_imagen');
                                $codigo=$this->generarCodigo();
                                $name=$codigo."_".$file->getClientOriginalName();
                                $file->move(public_path().'/assets/images/', $name);  
                                $url ='/assets/images/'.$name;
                                $membresia->url_imagen=$url;
                            }
                            // dd($request->all());
                            $membresia->nombre=$request->nombre;
                            $membresia->cant_inmuebles=$request->cant_inmuebles;
                            $membresia->monto=$request->monto;
                            $membresia->save();
                            toastr()->success('Éxito!!', 'Membresía Actualizada');
                            return redirect()->to('membresias');
                        }
                    }
                }           
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $membresia=Membresias::find($request->id_membresia);
        $admins=UsersAdmin::where('id_membresia',$request->id_membresia)->count();
        if ($admins>0) {
            toastr()->warning('Alerta!!', 'No es posible eliminar la membresía debido a que ha sido asignada a usuarios');
            return redirect()->back();
        } else {
            $url_imagen=$membresia->url_imagen;
            unlink(public_path().'/'.$url_imagen);
            if ($membresia->delete()) {
                toastr()->success('Éxito!!', 'La Membresía ha sido eliminada');
                return redirect()->back();
            } else {
                toastr()->warning('Alerta!!', 'No es posible eliminar la membresía');
                return redirect()->back();
            }
            
        }
        
    }

    protected function validar_imagen($imagen)
    {
        dd($imagen);
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

    protected function generarCodigo()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;   
    }
    
}
