<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estacionamientos;
use App\Inmuebles;
use App\Mensualidades;
use App\MensualidadE;
use App\Meses;
use App\MultasRecargas;
use App\Notificaciones;
use App\Pagos;
use App\PagosE;
use App\Residentes;
use PDF;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $meses=Meses::all();
        $id_admin=id_admin(\Auth::user()->email);
        if(\Auth::user()->tipo_usuario == 'Admin'){
            $inmuebles=Inmuebles::where('id_admin',$id_admin)->get();
            $estacionamientos=Estacionamientos::where('id_admin',$id_admin)->get();
            $residentes=Residentes::where('id_admin',$id_admin)->get();

        }else{
            $inmuebles = \DB::table('residentes')
                ->join('residentes_has_inmuebles','residentes_has_inmuebles.id_residente','=','residentes.id')
                ->join('inmuebles','inmuebles.id','=','residentes_has_inmuebles.id_inmueble')
                ->where('residentes.id_usuario',\Auth::user()->id)
                ->select('inmuebles.*')
                ->get();

            $estacionamientos = \DB::table('residentes')
                ->join('residentes_has_est','residentes_has_est.id_residente','=','residentes.id')
                ->join('estacionamientos','estacionamientos.id','=','residentes_has_est.id_estacionamiento')
                ->where('residentes.id_usuario',\Auth::user()->id)
                ->select('estacionamientos.*')
                ->get();
            $residentes=0;
        }
        
        $anio= array();
        $a=anios_registros();
        
        for ($i=0; $i < count(anios_registros()); $i++) { 
            $anio[$i]=$a[$i]['anio'];
        }
        
        $multas=MultasRecargas::where('id_admin',$id_admin)->get();

        return View('reportes.index', compact('meses','inmuebles','estacionamientos','residentes','anio','multas'));
    }

    
    public function store(Request $request)
    {
        
        // dd($request->all());
        /*"id_meses" => array:2 [▶]
          "MesesTodos" => "MesesTodos"
          "id_estacionamientos" => array:1 [▶]
          "EstacionamientosTodos" => "Si"
          "id_inmuebles" => array:1 [▶]
          "InmueblesTodos" => "Si"
          "id_residentes" => array:1 [▶]
          "ResidentesTodos" => "Si"
          "MultasRecargas" => "Si"*/
        
        $id_admin=id_admin(\Auth::user()->email);
        //preparando variable para anios de inmuebles
        if ((is_null($request->id_inmuebles) && is_null($request->InmueblesTodos)) && (is_null($request->id_estacionamientos) && is_null($request->EstacionamientosTodos)) && (is_null($request->id_multa) && is_null($request->MultasRecargas)) && (is_null($request->id_residentes) && is_null($request->ResidentesTodos))) {
            toastr()->warning('intente otra vez!!', 'No ha seleccionado ningún dato para realizar un reporte');;
                    return redirect()->back();
        }
        if (!is_null($request->id_inmuebles) || !is_null($request->InmueblesTodos)) {
            if (!is_null($request->meses_inmuebles) || !is_null($request->MesesTodosInmuebles)) {
                if(!is_null($request->anios_inmueble) || !is_null($request->AniosTodosInmuebles)){
                     $sql_i="SELECT * FROM inmuebles WHERE id_admin=".$id_admin." ";
                     if (is_null($request->InmueblesTodos)) {
                        //dd("----------------");
                        $sql_i.=" AND ";// agrego un AND para comenzar a agregar condicionales
                        $limit=count($request->id_inmuebles) -1;// variable que me permite saber cual es la última vuelta del for
                        for ($x=0; $x < count($request->id_inmuebles); $x++) { 
                           $sql_i.=" inmuebles.id=".$request->id_inmuebles[$x];
                           if ($x!=$limit) {
                               $sql_i.=" OR ";
                           }
                           
                        }
                     }
                }else{
                //en caso de no seleccionar años
                    toastr()->warning('intente otra vez!!', 'No ha seleccionado Años para reporte de Inmuebles');;
                    return redirect()->back();
                }
            }else{
                //en caso de no seleccionar meses
                toastr()->warning('intente otra vez!!', 'No ha seleccionado Meses para reporte de Inmuebles');;
                return redirect()->back();
            }
        } else {
            $sql_i="";
        }
        //dd($sql_i);
        //preparando variable para anios de estacionamientos
        if (!is_null($request->id_estacionamientos) || !is_null($request->EstacionamientosTodos)) {
            if (!is_null($request->meses_estaciona) || !is_null($request->MesesTodosEstaciona)) {
                if(!is_null($request->anios_estaciona) || !is_null($request->AniosTodosEstaciona)){
                    $sql_e="SELECT * FROM estacionamientos  WHERE id_admin=".$id_admin." ";

                    if(is_null($request->EstacionamientosTodos)){
                        $sql_e.= ' AND ';
                        $limit=count($request->id_estacionamientos) -1;

                        for ($y=0; $y < count($request->id_estacionamientos); $y++) { 
                            $sql_e.=" estacionamientos.id=".$request->id_estacionamientos[$y];
                            if ($y!=$limit) {
                                $sql_e.= " OR ";
                            }
                        }
                    }
                }else{
                //en caso de no seleccionar años
                    toastr()->warning('intente otra vez!!', 'No ha seleccionado Años para reporte de Estacionamientos');;
                    return redirect()->back();
                }
            }else{
                //en caso de no seleccionar meses
                toastr()->warning('intente otra vez!!', 'No ha seleccionado Meses para reporte de Estacionamientos');;
                return redirect()->back();
            }
        } else {
           $sql_e="";
        }
        //dd($sql_e);
        //preparando la variable de anios multas/recargas
        if (!is_null($request->id_multa) || !is_null($request->MultasRecargas)) {
            if (!is_null($request->meses_multas) || !is_null($request->MesesTodosMultas)) {
                if(!is_null($request->anios_multas) || !is_null($request->AniosTodosMultas)){
                    $sql_mr="SELECT * FROM multas_recargas WHERE id_admin=".$id_admin." ";
                        if (!is_null($request->id_multa)) {
                            $sql_mr.= ' AND ';
                            $limit = count($request->id_multa) -1;

                            for ($z=0; $z < count($request->id_multa); $z++) { 
                                $sql_mr.= " multas_recargas.id=".$request->id_multa[$z];
                                if ($z != $limit) {
                                    $sql_mr.= " OR ";
                                }
                            }
                        }
                }else{
                //en caso de no seleccionar años
                    toastr()->warning('intente otra vez!!', 'No ha seleccionado Años para reporte de Multas');;
                    return redirect()->back();
                }
            }else{
                //en caso de no seleccionar meses
                toastr()->warning('intente otra vez!!', 'No ha seleccionado Meses para reporte de Multas');;
                return redirect()->back();
            }
        } else {
            $sql_mr="";
        }

        
        //agregando los residentes
        //condicion para que seleccione cualquiera de los otros campos
        if (!is_null($request->id_residentes) || !is_null($request->ResidentesTodos)) {
            if (!is_null($request->meses_residentes) || !is_null($request->MesesTodosResidentes)) {
                if(!is_null($request->anios_residentes) || !is_null($request->AniosTodosResidentes)){
                    $sql_r="SELECT residentes.*,users.email FROM residentes,users WHERE residentes.id_admin=".$id_admin." AND residentes.id_usuario=users.id ";
                        if (!is_null($request->id_residentes)) {
                            $sql_r.=" AND ";// agrego un AND para comenzar a agregar condicionales
                            $limit=count($request->id_residentes) -1;// variable que me permite saber cual es la última vuelta del for
                          for ($i=0; $i < count($request->id_residentes); $i++) { 
                              $sql_r.=" residentes.id=".$request->id_residentes[$i]." ";// anexo la condición para cada id_residente que está en el array
                              if ($i!=$limit) {
                                $sql_r.=" OR ";// agrego OR para que me los traiga todos
                              }elseif($i==$limit){
                                $sql_r.=" GROUP BY residentes.id "; // cuando sea la ultima vuelta le agrego el group by
                              }
                              

                          }
                        }
                }else{
                //en caso de no seleccionar años
                    toastr()->warning('intente otra vez!!', 'No ha seleccionado Años para reporte de Residentes');;
                    return redirect()->back();
                }
            }else{
                //en caso de no seleccionar meses
                toastr()->warning('intente otra vez!!', 'No ha seleccionado Meses para reporte de Residentes');;
                return redirect()->back();
            }
        }else{
            $sql_r="";
        }
        //dd($sql_r);
        
        //haciendo arrays de meses y años de inmuebles

            $a=anios_registros();
            $mesesInmuebles[]=array();
            $aniosInmuebles[]=array();

            //Meses de los inmuebles
            if(is_null($request->MesesTodosInmuebles) && !is_null($request->meses_inmuebles)){
                // para agregar los meses

                for ($i=0; $i < count($request->meses_inmuebles) ; $i++) { 
                    
                    $mesesInmuebles[$i]=$request->meses_inmuebles[$i];
                }
            }else{
                for ($i=0; $i < 12; $i++) { 
                    $mesesInmuebles[$i]=$i+1;
                }
            }

            //Anios de los inmuebles
            if(is_null($request->AniosTodosInmuebles) && !is_null($request->anios_inmueble)){
                // para agregar los meses

                for ($i=0; $i < count($request->anios_inmueble) ; $i++) { 
                    
                    $aniosInmuebles[$i]=$request->anios_inmueble[$i];
                }
            }else{
        
                for ($i=0; $i < count(anios_registros()); $i++) { 
                    $aniosInmuebles[$i]=$a[$i]['anio'];
                }
            }
            
        //---------------------------------------------

        //haciendo arrays de meses y años de estacionamientos

            $mesesEstaciona[]=array();
            $aniosEstaciona[]=array();
            if(is_null($request->MesesTodosEstaciona) && !is_null($request->meses_estaciona)){
                // para agregar los meses

                for ($i=0; $i < count($request->meses_estaciona) ; $i++) { 
                    
                    $mesesEstaciona[$i]=$request->meses_estaciona[$i];
                }
            }else{
                for ($i=0; $i < 12; $i++) { 
                    $mesesEstaciona[$i]=$i+1;
                }
            }

            //Anios de los estacionamientos
            if(is_null($request->AniosTodosEstaciona) && !is_null($request->anios_estaciona)){
                // para agregar los meses

                for ($i=0; $i < count($request->anios_estaciona) ; $i++) { 
                    
                    $aniosEstaciona[$i]=$request->anios_estaciona[$i];
                }
            }else{
        
                for ($i=0; $i < count(anios_registros()); $i++) { 
                    $aniosEstaciona[$i]=$a[$i]['anio'];
                }
            }

        //---------------------------------------------

        //haciendo arrays de meses y años de residentes
            $mesesResidentes[]=array();
            $aniosResidentes[]=array();
            if(is_null($request->MesesTodosResidentes) && !is_null($request->meses_residentes)){
                // para agregar los meses

                for ($i=0; $i < count($request->meses_residentes) ; $i++) { 
                    
                    $mesesResidentes[$i]=$request->meses_residentes[$i];
                }
            }else{
                for ($i=0; $i < 12; $i++) { 
                    $mesesResidentes[$i]=$i+1;
                }
            }

            //Anios de los residentes
            if(is_null($request->AniosTodosResidentes) && !is_null($request->anios_residentes)){
                // para agregar los meses

                for ($i=0; $i < count($request->anios_residentes) ; $i++) { 
                    
                    $aniosResidentes[$i]=$request->anios_residentes[$i];
                }
            }else{
        
                for ($i=0; $i < count(anios_registros()); $i++) { 
                    $aniosResidentes[$i]=$a[$i]['anio'];
                }
            }

        //---------------------------------------------
        //haciendo arrays de meses y años de multas_recargas
            $mesesMultas[]=array();
            $aniosMultas[]=array();
            if(is_null($request->MesesTodosMultas) && !is_null($request->meses_multas)){
                // para agregar los meses

                for ($i=0; $i < count($request->meses_multas) ; $i++) { 
                    
                    $mesesMultas[$i]=$request->meses_multas[$i];
                }
            }else{
                for ($i=0; $i < 12; $i++) { 
                    $mesesMultas[$i]=$i+1;
                }
            }

            //Anios de los multas
            if(is_null($request->AniosTodosMultas) && !is_null($request->anios_multas)){
                // para agregar los meses

                for ($i=0; $i < count($request->anios_multas) ; $i++) { 
                    
                    $aniosMultas[$i]=$request->anios_multas[$i];
                }
            }else{
        
                for ($i=0; $i < count(anios_registros()); $i++) { 
                    $aniosMultas[$i]=$a[$i]['anio'];
                }
            }


        //---------------------------------------------

/*



        $meses[]=array();
        if(is_null($request->MesesTodos)){
            // para agregar los meses

            for ($i=0; $i < count($request->id_meses) ; $i++) { 
                
                $meses[$i]=$request->id_meses[$i];
            }
        }else{
            for ($i=0; $i < 12; $i++) { 
                $meses[$i]=$i+1;
            }
        }
        
*/        
        
        //dd($sql_r);
        //dd($meses);
        if($sql_r!==""){
        $residentes=\DB::select($sql_r);
        }else{
            $residentes=null;
        }
        if($sql_i!==""){
        $inmuebles=\DB::select($sql_i);
        }else{
            $inmuebles=null;
        }
        if($sql_e!==""){
        $estacionamientos=\DB::select($sql_e);
        }else{
        $estacionamientos=null;
        }
        if($sql_mr!==""){
        $mr=\DB::select($sql_mr);
        }else{
            $mr=null;
        }
        //$anio=$request->anio;
        //dd($estacionamientos);
        $pdf = PDF::loadView('reportes/PDF/ReporteEspecifico', array(
            'inmuebles'=>$inmuebles,
            'estacionamientos'=>$estacionamientos,
            'mr'=>$mr,
            'residentes' => $residentes,
            'mesesResidentes' => $mesesResidentes,
            'mesesInmuebles' => $mesesInmuebles,
            'mesesEstaciona' => $mesesEstaciona,
            'mesesMultas' => $mesesMultas,
            'aniosResidentes' => $aniosResidentes,
            'aniosInmuebles' => $aniosInmuebles,
            'aniosEstaciona' => $aniosEstaciona,
            'aniosMultas' => $aniosMultas
        ));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('reportes/ReporteEspecifico.pdf');
        
    }

   
    public function general(Request $request)
    {
        //dd($request->all());
        $id_admin=id_admin(\Auth::user()->email);
        $anio=$request->anio;
        $meses[]=array();
        //dd($request->all());
        if (is_null($request->id_mes)) {
            toastr()->warning('intente otra vez!!', 'No ha seleccionado ningún mes');
            return redirect()->back();
        } else {
            for ($i=0; $i < count($request->id_mes); $i++) { 
                $meses[$i]=$request->id_mes[$i];
            }

            if (\Auth::user()->tipo_usuario=="Residente") {
                $residentes=Residentes::where('id_usuario',\Auth::user()->id)->get();
            } else {
                $residentes=Residentes::where('id_admin',$id_admin)->get();
            }
            
        }
        if (count($residentes)==0) {
            toastr()->warning('intente otra vez!!', 'No existen datos para mostrar');
            return redirect()->back();
        } else {
            
            $pdf = PDF::loadView('reportes/PDF/ReporteGeneral', array(
                'residentes'=>$residentes,
                'meses'=>$meses,
                'anio' => $anio
            ));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream('reportes/ReporteGeneral.pdf');
        }
        
        
    }

    
}
