<?php
/*******************************************************************************
* config                                                                        *
* Página de configuración del comercio                                          *
* Version: 1.4                                                                  *
* Date:    2016-08-17                                                           *
* Author:  flow.cl                                                              *
********************************************************************************/

return [

    /**
    * Ingrese aquí la URL de su página de éxito
    * Ejemplo: http://www.comercio.cl/kpf/exito.php
    * 
    * @var string
    */
    'url_exito' => env('APP_URL').'/payment/flow/success',

    /**
    * Ingrese aquí la URL de su página de fracaso
    * Ejemplo: http://www.comercio.cl/kpf/fracaso.php
    * 
    * @var string
    */
    'url_fracaso' => env('APP_URL').'/payment/flow/failure',

    /**
    * Ingrese aquí la URL de su página de confirmación
    * Ejemplo: http://www.comercio.cl/kpf/confirmacion.php
    * 
    * @var string
    */
    'url_confirmacion' => env('APP_URL').'/payment/flow/confirm',

    /**
    * Ingrese aquí la URL de su página de retorno
    * Ejemplo: http://www.comercio.cl
    * 
    * @var string
    */
    'url_retorno' => env('APP_URL').'/home',

    /**
    * Ingrese aquí la página de pago de Flow
    * Ejemplo:
    * Sitio de pruebas = http://flow.tuxpan.com/app/kpf/pago.php
    * Sitio de produccion = https://www.flow.cl/app/kpf/pago.php
    * 
    * @var string
    */
    'url_pago' => 'https://www.flow.cl/app/kpf/pago.php',

    # Commerce specific config

    /**
    * Ingrese aquí la ruta (path) en su sitio donde están las llaves
    * 
    * @var string
    */
    'keys' =>  public_path('flow/keys'),

    /**
    * Ingrese aquí la ruta (path) en su sitio donde estarán los archivos de logs
    * 
    * @var string
    */
    'logPath' =>  public_path('flow/logs'),

    /**
    * Ingrese aquí el email con el que está registrado en Flow
    * 
    * @var string
    */
    'comercio' => 'p.arrocet@eiche.cl',

    /**
    * Ingrese aquí el medio de pago
    * Valores posibles:
    * Solo Webpay = 1
    * Solo Servipag = 2
    * Solo Multicaja = 3
    * Todos los medios de pago = 9
    * 
    * @var string
    */
    'medioPago' => '1',

    /**
    * Ingrese aquí el modo de acceso
    * Valores posibles:
    * Mostrar pasarela Flow = f 
    * Ingresar directamente al medio de pago = d
    * 
    * @var string
    */
    'tipo_integracion' => 'd',
];
