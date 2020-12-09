<?php

namespace App\Http\Controllers;

use Flow;
use App\Http\FlowBuilder1;
use Illuminate\Http\Request;
//llamando a los facades
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Alquiler;
use App\Instalaciones;
class FlowAController extends Controller
{
    public function index(){
    $flow=new FlowBuilder();
        //$var=0;
        return view('flow.index');
    }

    public function orden_alquiler(Request $request,$monto,$concepto,$email_pagador,$orden_compra,$tipo_alq,$modulo_pago){
        $flow=new FlowBuilder1();
        $orden = [
            'orden_compra' => $orden_compra,
            'monto'           => $monto,
            // 'concepto'        => $factura,
            'concepto'        => $concepto,
            'email_pagador'   => $email_pagador,
            'tipo_alq'   => $tipo_alq,
            'modulo_pago'   => $modulo_pago,
            //'medio_pago'     => $request->medio_pago,
        ];

        
        #Aqui debemos verificar la entrada...
        /*if (!is_numeric($orden['orden_compra'])) {
            dd("Error #1: Orden debe ser number");
        }*/

        //dd($orden);
        // Genera una nueva Orden de Pago, Flow la firma y retorna un paquete de datos firmados
        $orden['flow_pack'] = $flow->new_order($orden['orden_compra'], $orden['monto'], $orden['concepto'], $orden['email_pagador'],$orden['tipo_alq'],$orden['modulo_pago']);

        // Si desea enviar el medio de pago usar la siguiente línea
        //$orden['flow_pack'] = $flow->new_order($orden['orden_compra'], $orden['monto'], $orden['concepto'], $orden['email_pagador'], $orden['medio_pago']);
        return view('flow.pagar_arriendo.orden', compact('orden'));
    }
    public function orden_mr(Request $request,$monto,$concepto,$email_pagador,$orden_compra,$modulo_pago){
        $flow=new FlowBuilder1();
        $orden = [
            'orden_compra' => $orden_compra,
            'monto'           => $monto,
            // 'concepto'        => $factura,
            'concepto'        => $concepto,
            'email_pagador'   => $email_pagador,
            'modulo_pago'   => $modulo_pago,
            //'medio_pago'     => $request->medio_pago,
        ];

        
        #Aqui debemos verificar la entrada...
        /*if (!is_numeric($orden['orden_compra'])) {
            dd("Error #1: Orden debe ser number");
        }*/

        //dd($orden);
        // Genera una nueva Orden de Pago, Flow la firma y retorna un paquete de datos firmados
        $orden['flow_pack'] = $flow->new_order($orden['orden_compra'], $orden['monto'], $orden['concepto'], $orden['email_pagador'],$orden['modulo_pago']);

        // Si desea enviar el medio de pago usar la siguiente línea
        //$orden['flow_pack'] = $flow->new_order($orden['orden_compra'], $orden['monto'], $orden['concepto'], $orden['email_pagador'], $orden['medio_pago']);
        return view('flow.pagar_arriendo.orden', compact('orden'));
    }
    public function orden(Request $request){
        $orden = [
            'orden_compra' => $request->orden,
            'monto'           => $request->monto,
            'concepto'        => $request->concepto,
            'email_pagador'   => $request->pagador,
            //'medio_pago'     => $request->medio_pago,
        ];
        
    #Aqui debemos verificar la entrada...
        if (!is_numeric($orden['orden_compra'])) {
            //dd("Error #1: Orden debe ser number");
        }

        // Genera una nueva Orden de Pago, Flow la firma y retorna un paquete de datos firmados
        $orden['flow_pack'] = Flow::new_order($orden['orden_compra'], $orden['monto'], $orden['concepto'], $orden['email_pagador']);

        // Si desea enviar el medio de pago usar la siguiente línea
        //$orden['flow_pack'] = Flow::new_order($orden['orden_compra'], $orden['monto'], $orden['concepto'], $orden['email_pagador'], $orden['medio_pago']);
        return view('flow.pagar_arriendo.orden', compact('orden'));
    }

/**
 * Página de confirmación del Comercio
 */
    public function confirm(){
        $flow=new FlowBuilder();

        try {
            // Lee los datos enviados por Flow
            $data = $flow->read_confirm();
            
        } catch (\Exception $e) {
            // Si hay un error responde false
            $flow->build_response(false);
            return;
        }

        //Recupera Los valores de la Orden
        $FLOW_STATUS  = $data->getStatus();  //El resultado de la transacción (EXITO o FRACASO)
        $ORDEN_NUMERO = $data->getOrderNumber(); // N° Orden del Comercio
        $MONTO        = $data->getAmount(); // Monto de la transacción
        $ORDEN_FLOW   = $data->getFlowNumber(); // Si $FLOW_STATUS = "EXITO" el N° de Orden de Flow
        $PAGADOR      = $data->getPayer(); // El email del pagador

        if($FLOW_STATUS == "EXITO") {
            // La transacción fue aceptada por Flow
            // Aquí puede actualizar su información con los datos recibidos por Flow
            echo $data->build_response(true); // Comercio envía recepción de la confirmación
        } else {
            // La transacción fue rechazada por Flow
            // Aquí puede actualizar su información con los datos recibidos por Flow
            echo $data->build_response(true); // Comercio envía recepción de la confirmación
        }

    }

/**
 * Página de éxito del Comercio
 * Esta página será invocada por Flow cuando la transacción resulte exitosa
 * y el usuario presione el botón para retornar al comercio desde Flow
 */
    public function success(){
        $flow=new FlowBuilder1();
        try {
            // Lee los datos enviados por Flow
            $flow->read_result();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return view('flow.error_500');
        }
        if ($modulo_pago=="MR") {
            if(is_null($request->id_mensMulta)==false){
                for ($i=0; $i < count($request->id_mensMulta) ; $i++) { 
                    $mr=MultasRecargas::find($request->id_mensMulta[$i]);
                    //dd($mr->residentes);
                    foreach ($mr->residentes as $key) {
                        if($key->pivot->id_residente==$residente->id){
                            $statusP='Pagada';
                            $referencia = date('YmdHim');
                            $key->pivot->status=$statusP;
                            $key->pivot->referencia=$referencia;
                            $key->pivot->tipo_pago=$request->tipo_pago;
                            $key->pivot->save();
                            $factura.="Multa o Recarga: ".$mr->motivo.", Monto: ".$mr->monto." status:Pagada<br>";
                            $total+=$mr->monto;
                        }
                    }
                }
            }else{
                $mr=MultasRecargas::find($request->id_multa);
                foreach ($mr->residentes as $key) {
                    if($key->pivot->id_residente==$residente->id){
                        $statusP='Pagada';
                        $referencia = date('YmdHim');
                        $key->pivot->status=$statusP;
                        $key->pivot->referencia=$referencia;
                        $key->pivot->tipo_pago=$request->tipo_pago;
                        $key->pivot->save();
                        $factura.="Multa o Recarga: ".$mr->motivo.", Monto: ".$mr->monto." status:Pagada<br>";
                        $total+=$mr->monto;
                    }
                }
            }
        } else if ($modulo_pago=="PagoArriendo") {
            //actualizando status de pagos de alquiler
            if ($request->tipo_alq=="Permanente") {
                $instalacion=Instalaciones::find($request->id_instalacion);
                $instalacion->status="Inactivo";
                $instalacion->save();
            }
            \DB::table('pagos_has_alquiler')->where('id_alquiler', $request->id_alquiler)
            ->update([
                'referencia'=> $request->referencia,
                'status'=> "Pagado",
                'tipo_pago' => 'Flow'
            ]);
            $instalacion=Alquiler::find($request->id_alquiler);
            $instalacion->status="Activo";
            $instalacion->save();
        }
        //----------------------------------------------------------------
        //Recupera los datos enviados por Flow
        $data = [
            'ordenCompra' => $flow->getOrderNumber(),
            'monto'       => $flow->getAmount(),
            'concepto'    => $flow->getConcept(),
            'pagador'     => $flow->getPayer(),
            'flowOrden'   => $flow->getFlowNumber(),
        ];

        return view('flow.pagar_arriendo.success', compact('data'));
    }

/**
 * Página de fracaso del Comercio
 * Esta página será invocada por Flow cuando la transacción no se logre pagar
 * y el usuario presione el botón para retornar al comercio desde Flow
 */
    public function failure(){
        $flow=new FlowBuilder();
        try {
            // Lee los datos enviados por Flow
            $flow->read_result();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return view('flow.pagar_arriendo.error_500');
        }

        //Recupera los datos enviados por Flow
        $data = [
            'ordenCompra' => $flow->getOrderNumber(),
            'monto'       => $flow->getAmount(),
            'concepto'    => $flow->getConcept(),
            'pagador'     => $flow->getPayer(),
            'flowOrden'   => $flow->getFlowNumber(),
        ];

        return view('flow.pagar_arriendo.failure', compact('data'));

    }
}