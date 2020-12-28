<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Residentes;
use App\UsersAdmin;

class UserController extends Controller
{
    public function profileEdit(Request $request)
    {

        // dd($request->all());
        $residente=Residentes::where('id_usuario',$request->id_user)->count();
        $admin=UsersAdmin::where('email',\Auth::user()->email)->count();

        $a=0;
        $b=0;

        if($residente > 0){

            $residente=Residentes::where('id_usuario',$request->id_user)->first();

            $residente->nombres=$request->nombres;
            $residente->apellidos=$request->apellidos;
            $residente->rut=$request->rut.'-'.$request->verificador;
            if(!is_null($request->telefono)){
                $residente->telefono=$request->telefono;
            }
            $residente->save();

        }
        if ($admin>0) {
            $admin=UsersAdmin::where('email',\Auth::user()->email)->first();

            $admin->name=$request->nombres;
            $admin->rut=$request->rut.'-'.$request->verificador;
            $admin->email=$request->email;
            $admin->save();
        }

        $user=User::find($request->id_user);

        $user->name=$request->nombres;
        $user->rut=$request->rut.'-'.$request->verificador;
        $user->email=$request->email;
        $user->password=\Hash::make($request->rut.'-'.$request->verificador);
        $user->save();


        toastr()->success('con éxito!!', 'Perfil actualizado!');
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
        //
    }
}
