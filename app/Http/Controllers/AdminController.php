<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UsersAdmin;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdminURequest;
use App\Meses;
use App\Inmuebles;
use App\Pagos;
use App\Mensualidades;
use App\Estacionamientos;
use App\PagosE;
use App\MensualidadE;
use App\MultasRecargas;
use App\Notificaciones;
use App\Noticias;
use App\Residentes;
use App\Membresias;
use App\Pasarelas;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin=UsersAdmin::all();
        $membresias = Membresias::all();
        //$pasarelas = Pasarelas::all();

        return view('root.index',compact('admin','membresias'));
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
        
        //dd('----------------');
        //dd($request->all());


        //validando campos unicos
        //corre
        $buscar1=UsersAdmin::where('email',$request->email)->count();
        $buscar2=UsersAdmin::where('rut',$request->rut.'-'.$request->verificador)->count();
        if($buscar1>0){
            toastr()->success('Verique otra vez!!', 'El correo electrónico ya se encuentra registrado');
        
            return redirect()->back();    
        }else{
            if($buscar2>0){
            toastr()->success('Verique otra vez!!', 'El RUT ya se encuentra registrado');
        
            return redirect()->back();    
            }else{
                $user=new UsersAdmin();

                $user->name=$request->name;
                $user->rut=$request->rut.'-'.$request->verificador;
                $user->email=$request->email;
                $user->id_membresia=$request->id_membresia;
                $user->save();
                
                    /*for ($i=0; $i < count($request->id_pasarela); $i++) {
                        \DB::table('admins_has_pasarelas')->insert([
                            'id_pasarela' => $request->id_pasarela[$i],
                            'id_admin' => $user->id,
                            'link_pasarela' => $request->link_pasarela[$i]
                        ]);
                    }*/
                

                $user2=new User();
                $user2->name=$request->name;
                $user2->rut=$request->rut.'-'.$request->verificador;
                $user2->email=$request->email;
                $user2->tipo_usuario='Admin';
                $user2->password=\Hash::make($request->password);
                $user2->save();
                toastr()->success('con éxito!', 'Usuario Admin registrado');
                
                    return redirect()->back();
            
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
    public function update(Request $request, $id_user)
    {

        //dd($request->all());
        $buscar=UsersAdmin::where('email',$request->email_e)->where('id','<>',$request->id)->count();
        if ($buscar>0) {
            toastr()->warning('intente otra vez!!', 'El correo electrónico ya se encuentra registrado');
                return redirect()->back();
        } else {
            $buscar2=UsersAdmin::where('rut',$request->rut_e)->where('id','<>',$request->id)->count();
            if ($buscar2) {
                toastr()->warning('intente otra vez!!', 'El RUT ya se encuentra registrado');
                return redirect()->back();
            } else {
                if (is_null($request->cambiar)) {
                    # en caso de no querer cambiar la contraseña
                    $user= UsersAdmin::find($request->id);
                    $email=$user->email;
                    $user->name=$request->name_e;
                    $user->rut=$request->rut_e.'-'.$request->verificador_e;
                    $user->email=$request->email_e;
                    $user->status=$request->status;
                    if ($request->cambiar_pagos=="si") {
                        $user->link_flow=$request->link_flow;
                        $user->link_tb=$request->link_tb;
                    }
                    $user->save();

                    $user2=User::where('email',$email)->first();
                    $user2->name=$request->name_e;
                    $user2->rut=$request->rut_e;
                    $user2->email=$request->email_e;
                    $user2->save();
                    toastr()->success('con éxito!!', 'Admin Actualizado');
                        return redirect()->back();
                } else {
                    # en caso de querer cambiar la contraseña
                    if ($request->password==$request->password_confirmation) {
                        $user= UsersAdmin::find($request->id);
                        $email=$user->email;
                        $user->name=$request->name_e;
                        $user->rut=$request->rut_e.'-'.$request->verificador_e;
                        $user->email=$request->email_e;
                        $user->status=$request->status;
                        if ($request->cambiar_pagos=="si") {
                            $user->link_flow=$request->link_flow;
                            $user->link_tb=$request->link_tb;
                        }
                        $user->save();

                        $user2=User::where('email',$email)->first();
                        $user2->name=$request->name_e;
                        $user2->rut=$request->rut_e;
                        $user2->email=$request->email_e;
                        $user2->password=\Hash::make($request->password);
                        $user2->save();    

                        toastr()->success('con éxito!!', 'Admin Actualizado');
                        return redirect()->back();
                    } else {
                        toastr()->error('intente otra vez!!', 'Las contraseñas no coinciden');
                        return redirect()->back();
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
        //dd($request->all());
        $meses=Meses::all();
       //para eliminar el admin se deben eliminar el resto de los registros 
    //comenzamos con los inmuebles registrados

        $inmuebles=Inmuebles::where('id_admin',$request->id)->get();
        if (count($inmuebles)>0) {
            foreach ($inmuebles as $key) {
                foreach($meses as $key2){
                    $mensualidad= Mensualidades::where('id_inmueble',$key->id)->where('mes',$key2->id)->first();
                    //dd($mensualidad);
                    if ($mensualidad!=null) {
                        $pagos=Pagos::where('id_mensualidad',$mensualidad->id)->get();
                        foreach ($pagos as $key3) {
                            $key3->delete();
                        }
                        $mensualidad->delete();
                    }
                }
            //dd('-----------------');
            $key->delete();
            }
        }
        
        //ahora con estacionamientos
        $estacionamientos=Estacionamientos::where('id_admin',$request->id)->get();
        if(count($estacionamientos)>0){
            foreach ($estacionamientos as $key) {
                foreach($meses as $key2){
                    $mensualidad= MensualidadE::where('id_estacionamiento',$key->id)->where('mes',$key2->id)->first();
                    if ($mensualidad!=null) {
                        $pagos=PagosE::where('id_mens_estac',$mensualidad->id)->get();
                        foreach ($pagos as $key3) {
                            $key3->delete();
                        }
                        $mensualidad->delete();
                    }
                }
            $key->delete();
            }
        }
        //multas y recargas
        $mr=MultasRecargas::where('id_admin',$request->id)->get();
        if (count($mr)>0) {
            foreach ($mr as $key) {
                $key->delete();
            }
        }
        //notificaciones
        $notif=Notificaciones::where('id_admin',$request->id)->get();
        if(count($notif)>0){
            foreach ($notif as $key) {
                $key->delete();
            }
        }

        //noticias
        $noti=Noticias::where('id_admin',$request->id)->get();
        if(count($noti)>0){
            foreach ($noti as $key) {
                $key->delete();
            }
        }

        //residentes
        $residentes=Residentes::where('id_admin',$request->id)->get();
        if(count($residentes)>0){      

            foreach ($residentes as $key) {
                /*dd($key->usuario->delete());
                $key->usuario->delete();
                dd($key->reportes);*/
                foreach ($key->reportes as $key2) {
                   $key2->delete();
                }
                $user=User::find($key->id_usuario);
                $key->delete();
                $user->delete();
            }
        }

        //anuncios asignados
        $user_admin=UsersAdmin::find($request->id);
        foreach ($user_admin->anuncios as $key) {
            $key->delete();
        }
        $user=User::where('email',$user_admin->email)->first();
        $user->delete();
        
        $user_admin->delete();

        toastr()->success('con éxito!!', 'Usuario Admin eliminado');
            return redirect()->back();
    }

    public function admin_asignados($id_anuncio)
    {
        return $asignados=\DB::table('anuncios')
            ->join('admins_has_anuncios','admins_has_anuncios.id_anuncios','anuncios.id')
            ->join('users_admin','users_admin.id','=','admins_has_anuncios.id_users_admin')
            ->where('anuncios.id',$id_anuncio)
            ->select('users_admin.*')
            ->get();
    }

    public function pasarelas_admin($id_admin)
    {
        return $pasarelas=\DB::table('admins_has_pasarelas')
            ->join('pasarelas','pasarelas.id','=','admins_has_pasarelas.id_pasarela')
            ->where('admins_has_pasarelas.id_admin',$id_admin)
            ->select('pasarelas.*','admins_has_pasarelas.link_pasarela')
            ->get();
    }
}