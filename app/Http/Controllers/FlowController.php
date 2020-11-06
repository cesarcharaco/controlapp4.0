<?php

namespace App\Http\Controllers;

use Flow;
use App\Http\FlowBuilder;
use Illuminate\Http\Request;
//llamando a los facades
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FlowController extends Controller
{
    public function index(){
    $flow=new FlowBuilder();
        //$var=0;
        return view('flow.index');
    }

    public function orden2(Request $request,$monto,$concepto,$email_pagador,$orden_compra){
        //echo "concepto: ".$concepto;
        //dd($request->all());
        //dd($monto);
        $flow=new FlowBuilder();
        $orden = [
            'orden_compra' => $orden_compra,
            'monto'           => $monto,
            // 'concepto'        => $factura,
            'concepto'        => $concepto,
            'email_pagador'   => $email_pagador,
            //'medio_pago'     => $request->medio_pago,
        ];

        
        #Aqui debemos verificar la entrada...
        /*if (!is_numeric($orden['orden_compra'])) {
            dd("Error #1: Orden debe ser number");
        }*/

        //dd($orden);
        // Genera una nueva Orden de Pago, Flow la firma y retorna un paquete de datos firmados
        $orden['flow_pack'] = $flow->new_order($orden['orden_compra'], $orden['monto'], $orden['concepto'], $orden['email_pagador']);

        // Si desea enviar el medio de pago usar la siguiente línea
        //$orden['flow_pack'] = $flow->new_order($orden['orden_compra'], $orden['monto'], $orden['concepto'], $orden['email_pagador'], $orden['medio_pago']);
        return view('flow.orden', compact('orden'));
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
        return view('flow.orden', compact('orden'));
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
        $flow=new FlowBuilder();
        try {
            // Lee los datos enviados por Flow
            $flow->read_result();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return view('flow.error_500');
        }

        //Recupera los datos enviados por Flow
        $data = [
            'ordenCompra' => $flow->getOrderNumber(),
            'monto'       => $flow->getAmount(),
            'concepto'    => $flow->getConcept(),
            'pagador'     => $flow->getPayer(),
            'flowOrden'   => $flow->getFlowNumber(),
        ];

        return view('flow.success', compact('data'));
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
            return view('flow.error_500');
        }

        //Recupera los datos enviados por Flow
        $data = [
            'ordenCompra' => $flow->getOrderNumber(),
            'monto'       => $flow->getAmount(),
            'concepto'    => $flow->getConcept(),
            'pagador'     => $flow->getPayer(),
            'flowOrden'   => $flow->getFlowNumber(),
        ];

        return view('flow.failure', compact('data'));

    }
}