<?php

namespace App\Http\Controllers;

use App\Notificaciones;
use Illuminate\Http\Request;
use App\Residentes;
class NotificacionesController extends Controller
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
        // dd(count($request->id_residente[0]));

        //dd(!is_null($request->todos));
        $id_admin=id_admin(\Auth::user()->email);
        if ($request->titulo=="" || $request->motivo=="") {
            toastr()->warning('intente otra vez!!', 'Los campos no deben de estar vacíos');
            return redirect()->back();
        } else {
            if (!is_null($request->todos)) {
               $notif=new Notificaciones();
               $notif->titulo=$request->titulo;
               $notif->motivo=$request->motivo;
               $notif->id_admin=$id_admin;
               $notif->save();
            //registrado a usuarios residententes
            $residentes=Residentes::where('id_admin',$id_admin)->get();
                foreach ($residentes as $key) {
                    \DB::table('resi_has_notif')->insert([
                        'id_residente' => $key->id,
                        'id_notificacion' => $notif->id
                     ]);
                }
                toastr()->success('con éxito!!', 'Notificación registrada');
                    return redirect()->back();    
            }else{
                if (is_null($request->id_residente)) {
                    toastr()->warning('intente otra vez!!', 'No ha seleccionado ningún residente');
                    return redirect()->back();    
                } else {
                    
                   $notif=new Notificaciones();
                   $notif->titulo=$request->titulo;
                   $notif->motivo=$request->motivo;
                   $notif->publicar="Individual";
                   $notif->id_admin=$id_admin;
                   $notif->save();


                    for ($i=0; $i < count($request->id_residente) ; $i++) { 
                        \DB::table('resi_has_notif')->insert([
                            'id_residente' => $request->id_residente[$i],
                            'id_notificacion' => $notif->id
                        ]);
                    } 

                    toastr()->success('con éxito!!', 'Notificación registrada y enviada');
                    return redirect()->back();    
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
        $notificacion= Notificaciones::find($request->id);

        $notificacion->titulo=$request->titulo;
        $notificacion->motivo=$request->motivo;
        $notificacion->save();
        toastr()->success('con éxito!!', 'Notificación actualizada');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notificacion=Notificaciones::find($id);
        $notificacion->delete();

        toastr()->success('con éxito!!', 'Notificación eliminada');
        return redirect('home');
    }

    public function asignar_notif(Request $request)
    {
        //dd($request->all());

        for ($i=0; $i < count($request->id_mr); $i++) { 
            \DB::table('resi_has_notif')->insert([
                'id_residente' => $request->id_residente,
                'id_notificacion' => $request->id_mr[$i]
            ]);
        }

        toastr()->success('con éxito!!', 'Notificación enviada');
            return redirect()->to('notificaciones');
    }

    public function status_notif(Request $request)
    {
        $residente=Residentes::find($request->id_residente);

        foreach ($residente->notificaciones as $key) {
            if ($key->id_notificacion==$request->id_notificacion) {
                $key->pivot->status=$request->status;
                $key->save();
            }
        }
        toastr()->success('con éxito!!', 'Status de Notificación actualizado a ('.$request->status.')');
            return redirect()->to('notificaciones');
    }

    public function eliminar_notif(Request $request)
    {
        $residente=Residentes::find($request->id_residente);

        foreach ($residente->notificaciones as $key) {
            if ($key->id_notificacion==$request->id_notificacion) {
                $key->pivot->status=$request->status;
                $key->delete();
            }
        }
        toastr()->success('con éxito!!', 'Notificación eliminada');
            return redirect()->to('notificaciones');
    }
}
