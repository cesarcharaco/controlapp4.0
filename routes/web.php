<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::group(['middleware' => ['web','auth']], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('residentes','ResidentesController');

	Route::get('arriendos','ResidentesController@arriendos')->name('arriendos');
	Route::get('arriendos/{id_residente}/buscar_residente','ResidentesController@buscar_residente');
	Route::get('residentes/{num}/buscar_residente2','ResidentesController@buscar_residente2');
	Route::get('arriendos/{id_residente}/buscar_inmuebles','ResidentesController@buscar_inmuebles');
	Route::get('arriendos/{id_residente}/buscar_inmuebles2','ResidentesController@buscar_inmuebles2');
	Route::get('arriendos/{id_inmueble}/buscar_inmuebles3','ResidentesController@buscar_inmuebles3');
	Route::get('arriendos/{id_residente}/buscar_estacionamientos','ResidentesController@buscar_estacionamientos');
	Route::get('arriendos/{id_residente}/buscar_estacionamientos2','ResidentesController@buscar_estacionamientos2');
	Route::get('arriendos/{id_estacionamiento}/buscar_estacionamientos3','ResidentesController@buscar_estacionamientos3');
	Route::get('arriendos/{id_residente}/buscar_mr','ResidentesController@buscar_mr');
	Route::post('arriendos/asignando','ArriendosController@asignando')->name('arriendos.asignando');




	Route::resource('mensualidades','MensualidadesController');
	Route::get('mensualidadInmueble/{id}/buscar', 'MensualidadesController@buscarMesInmueble');
	Route::get('mensualidadEstacionamiento/{id}/buscar', 'MensualidadesController@buscarMesEstacionamiento');





	Route::resource('inmuebles','InmueblesController');
	Route::get('inmuebles/{id}/{anio}/buscar_mensualidad','InmueblesController@buscar_mensualidad');
	Route::get('inmuebles/{id}/buscar_anios', 'InmueblesController@buscar_anios');
	Route::post('inmuebles/registrar_mensualidad','InmueblesController@registrar_mensualidad')->name('inmuebles.registrar_mensualidad');
	Route::post('inmuebles/editar_mensualidad','InmueblesController@editar_mensualidad')->name('inmuebles.editar_mensualidad');
	Route::post('inmuebles/eliminar_mensualidad','InmueblesController@eliminar_mensualidad')->name('inmuebles.eliminar_mensualidad');



	Route::resource('estacionamientos','EstacionamientosController');
	Route::get('estacionamientos/{id}/{anio}/buscar_mensualidad','EstacionamientosController@buscar_mensualidad');
	Route::get('estacionamientos/{id}/buscar_anios', 'EstacionamientosController@buscar_anios');
	Route::post('estacionamientos/registrar_mensualidad','EstacionamientosController@registrar_mensualidad')->name('estacionamientos.registrar_mensualidad');
	Route::post('estacionamientos/editar_mensualidad','EstacionamientosController@editar_mensualidad')->name('estacionamientos.editar_mensualidad');
	Route::post('estacionamientos/eliminar_mensualidad','EstacionamientosController@eliminar_mensualidad')->name('estacionamientos.eliminar_mensualidad');
	

	Route::resource('noticias', 'NoticiasController');
	Route::get('eliminarNoticia/{id}','NoticiasController@destroy')->name('eliminarNoticia');
	Route::resource('notificaciones','NotificacionesController');
	Route::get('eliminarNotificacion/{id}','NotificacionesController@destroy')->name('eliminarNotificacion');

	Route::post('notificaciones/asignar','NotificacionesController@asignar_notif')->name('notificaciones.asignar_notif');
	Route::post('notificaciones/cambiar_status','NotificacionesController@status_notif')->name('notificaciones.status_notif');
	Route::post('notificaciones/eliminar','NotificacionesController@eliminar_notif')->name('notificaciones.eliminar_notif');

	Route::resource('multas_recargas','MultasRecargasController');
	Route::get('multas_recargas/{id}/buscar','MultasRecargasController@buscar_multa');
	Route::post('multas_recargas/asignar','MultasRecargasController@asignar_mr')->name('asignar_mr');
	Route::post('sanciones/cambiar_status','MultasRecargasController@status_mr')->name('sanciones.cambiar_status');
	Route::post('sanciones/eliminar','MensualidadesController@eliminar_mr')->name('sanciones.eliminar_mr');
	Route::get('multas_recargas/{num}/buscar_mr_all','MultasRecargasController@buscar_mr_all');
	Route::post('multas_recargas/confirmar','PagosController@confirmar_multa')->name('multas_recargas.confirmar');
	Route::post('multas_recargas/editar_referencia','PagosController@editar_referencia')->name('editar_referencia');
	Route::post('multas_recargas/eliminar_mr','PagosController@eliminar_mr')->name('eliminar_mr');
	
	// ------------------------Buscar multas del residente
	Route::get('multas_residentes/{id_residente}/buscar','MultasRecargasController@multas_residentes');
	Route::get('residentes_confirmar/{id_multa}/buscar','MultasRecargasController@residentes_confirmar');



	Route::resource('pagos','PagosController');
	Route::get('pagos/{id_residente}/consultas','PagosController@consultas')->name('pagos.consultas');
	Route::post('pagos/editar_referencia','PagosController@editar_referencia2')->name('pagos.editar_referencia');
	Route::get('pagos_multas','PagosController@pagos_multas')->name('pagos_multas');
	Route::post('pagos/mr','PagosController@pagarmultas')->name('pagar.mr');

	Route::post('arriendos/retirar','ArriendosController@retirando')->name('arriendos.retirar');
	
	Route::get('inmuebles/{id_residente}/buscar_anios','ArriendosController@buscar_anios_i');	
	Route::get('estacionamientos/{id_residente}/buscar_anios','ArriendosController@buscar_anios_e');
	Route::get('inmuebles/{id_residente}/{anio}/buscar_inmuebles','ArriendosController@buscar_inmuebles');
	Route::get('mostrar/{id_inmueble}/meses_inmuebles','ArriendosController@meses_inmuebles');
	Route::get('estacionamientos/{id_residente}/{anio}/buscar_estacionamientos','ArriendosController@buscar_estacionamientos');
	Route::get('mostrar/{id_estacionamiento}/meses_estacionamientos','ArriendosController@meses_estacionamientos');
	Route::get('mr/{id_residente}/buscar_anios','ArriendosController@buscar_anios_mr');	
	Route::get('mr/{id_residente}/{anio}/buscar_mr','ArriendosController@buscar_mr');
	Route::get('mr/{id_residente}/{anio}/buscar_mr_confirmar','ArriendosController@buscar_mr_confirmar');
	//-----------------Buscar inmuebles y estacionamientos disponibles
	Route::get('inmuebles_disponibles/{id}/buscar','InmueblesController@inmuebles_disponibles');
	Route::get('estacionamientos_disponibles/{id}/buscar','EstacionamientosController@estacionamientos_disponibles');

	Route::get('instalaciones/{id_instalacion}/buscar_dias','ArriendosController@buscar_dias');

	Route::resource('reportes','ReportesController');
	Route::post('reportes/general','ReportesController@general')->name('reportes.general');



	Route::resource('pagoscomunes','PagosComunesController')->except(['index','create','edit','show','destroy']);
	Route::get('pagoscomunes/{tipo}/{anio}/buscarPagoC','PagosComunesController@buscarPagoAnio');

	Route::resource('anuncios','AnunciosController');
	route::get('desactivar_orden','AnunciosController@desactivar_orden')->name('desactivar_orden');
	route::get('editarOrdenAnuncio','AnunciosController@editar_orden_anuncio')->name('editar_orden_anuncio');
	route::get('renovarOrdenAnuncio','AnunciosController@renovar_orden_anuncio')->name('renovar_orden_anuncio');
	route::get('renovar_anuncio','AnunciosController@renovar_anuncio')->name('renovar_anuncio');
	Route::get('anuncios/{id_anuncio}/admin_asignados','AdminController@admin_asignados');
	Route::get('pasarelas/{id_admin}/buscar','AdminController@pasarelas_admin');

	
	Route::resource('administradores','AdminController');


	Route::post('desocupacion','ArriendosController@desocupar')->name('desocupacion');
	Route::get('mr/{id_mr}/asignados','MultasRecargasController@mostrar_asignados');
	Route::get('mr/{id_residente}/asignados2','MultasRecargasController@mostrar_asignados2');

	Route::get('consultas','ResidentesController@consultas');
	Route::get('consulta/{anio}/buscar','ResidentesController@consulta_anual');
	


	Route::resource('contabilidad', 'ContabilidadController');
	Route::post('reportes_mensual_pdf','ContabilidadController@reportes_mensual_pdf')->name('reportes_mensual_pdf');

	Route::resource('alquiler', 'AlquilerController');
	Route::post('registrar_alquiler', 'AlquilerController@registrar_alquiler')->name('registrar_alquiler');
	Route::post('editar_alquiler', 'AlquilerController@editar_alquiler')->name('editar_alquiler');
	Route::post('eliminar_alquiler', 'AlquilerController@eliminar_alquiler')->name('eliminar_alquiler');
	Route::post('editar_instalacion', 'AlquilerController@editar_instalacion')->name('editar_instalacion');
	Route::post('statusinstalacion', 'AlquilerController@statusinstalacion')->name('statusinstalacion');
	Route::post('eliminarInstalacion', 'AlquilerController@eliminarInstalacion')->name('eliminarInstalacion');

	route::resource('empresas','EmpresasController');


	Route::post('editar_perfil','UserController@profileEdit')->name('Editar_perfil');

	Route::resource('planes_pago','PlanesPagoController');

	Route::resource('promociones','PromocionesController');
	Route::post('registrar_incidencia','MultasRecargasController@registrar_incidencia')->name('registrar_incidencia');
	Route::resource('membresias','MembresiasController');
	// Route::get('membresias/{id}/buscar','MembresiasController');
	//-----------flow----------------
		Route::group(['prefix' => 'payment/flow'], function(){
	    Route::get('index', 'FlowController@index');
	    Route::post('orden', 'FlowController@orden');
	    Route::get('confirm', 'FlowController@confirm');
	    Route::match(['get', 'post'], 'success', 'FlowController@success');
	    Route::match(['get', 'post'], 'failure', 'FlowController@failure');
	    Route::post('index', 'FlowController@orden');
		});
	//-------------------------------
});
