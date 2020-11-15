@extends('layouts.app')

@section('content')
     <style type="text/css">
        .card {
            border: 1px solid #f6f6f7!important;
            border-color: #43d39e !important;
        }
        .palabraVerPlanesPago2, .palabraVerEstaciona2,.PalabraEditarPago2, .tituloTabla2
        {
            display: none;
        }
        @media only screen and (max-width: 800px)  {

            .PalabraEditarPago, .PalabraRealizarPago, .PalabraPagoConfirmar{
                display: none;
            }
            .palabraVerPlanesPago{
                display: none;
            }
            .palabraVerPlanesPago2{
                display: block;
            }
            .palabraVerEstaciona{
                display: none;
            }
            .palabraVerEstaciona2{
                display: block;
            }
            .PalabraEditarPago2{
                display: block;
            }
            .iconosMetaforas{
                display: none;    
            }
            .card-table{
                width: 100%
            }

        }
        @media only screen and (max-width: 200px)  {
            .botonesEditEli{
                width: 15px;
                height: 15px;
            }
            .iconosMetaforas2{
                width: 5px;
                height: 5px;    
            }
        }
        @media screen and (max-width: 480px) {
            .tituloTabla{
                display: none;
            }
            .tituloTabla2{
                display: block;
            }
            .iconosMetaforas2{
                width: 15px;
                height: 15px;    
            }
            .botonesEditEli{
                width: 30px;
                height: 30px;
                margin-top: 5px;
                    
            }
        }

    </style>
    <input type="hidden" id="colorView" value="#43d39e !important">
    <div class="container">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active pageTitle" aria-current="page">Planes de pago</li>
                        <li class="breadcrumb-item active pageTitle2" aria-current="page" style="display: none">Promociones</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0 pageTitle">Planes de pago</h4>
                <h4 class="mb-1 mt-0 pageTitle2" style="display: none">Promociones</h4>
            </div>
        </div>
        @include('flash::message')
        @if(count($errors))
            <div class="alert-list m-4">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>
                            {{$error}}
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        @endif
    </div>
    <center>
    	<div class="row justify-content-center mb-3">
	    	<div class="col-md-6" align="center">
	    		<button onclick="CambioVista(1);" class="btn btn-success text-white shadow mb-1" style="color: gray; font: 18px Arial, sans-serif;width: 80% !important;" data-toggle="tooltip" data-placement="top" title="Seleccione para ver las lista de los planes de pagos">Vista de Planes de Pagos</button>
	    	</div>
	    	<div class="col-md-6" align="center text-white"  style="">
	    		<button onclick="CambioVista(2);" class="btn text-white shadow mb-1" style="border: 1px solid #f6f6f7!important; border-color: #ff7043 !important; background-color: #ff7043 !important;color: gray; font: 18px Arial, sans-serif;width: 80% !important;" data-toggle="tooltip" data-placement="top" title="Seleccione para la lista de promociones">Vista de Promociones</button>
	    	</div>
    	</div>
    </center>
    <div class="vistaPlanesP">
	    <div class="card rounded card-tabla shadow p-3 mb-5 bg-white rounded">
	    	<div class="row justify-content-center">
			    <div class="col-md-12">
			    	<div style="height: 100%;">
				    	@include('planes_pago.layouts_planesPago.create')
				    	@include('planes_pago.layouts_planesPago.edit')
				    	@include('planes_pago.layouts_planesPago.delete')
				    </div>
			    </div>
			</div>
	        <div class="row justify-content-center">
			    <div class="col-md-12">
			    	<div class="listarPlanPago" id="listarPlanPago">
				        <div class="row justify-content-center">
				            <div class="col-md-12">
				                <div class="row">
				                    <div class="col-md-12 offset-md-12">
				                        <a data-toggle="collapse" href="#nuevoPlanPago" id="btnRegistrar_plan" role="button" aria-expanded="false" aria-controls="nuevoPlanPago" class="btn btn-success boton-tabla shadow" onclick="nuevoPlanPago()" style="
				                            border-radius: 10px;
				                            color: white;
				                            height: 35px;
				                            margin-bottom: 5px;
				                            margin-top: 5px;
				                            float: right;
				                            border: 1px solid #f6f6f7!important;
				                            border-color: #43d39e !important;
				                            background-color: #43d39e !important">
				                            <span class="PalabraEditarPago text-white">Nuevo Plan de pago</span>
				                            <center>
				                                <span class="PalabraEditarPago2 text-white">
				                                    <i data-feather="plus" class="iconosMetaforas2"></i>
				                                </span>
				                            </center>
				                        </a>
				                    </div>
				                </div>
				            </div>
				            <div class="row">
				            	<div class="col-md-12" style="position: relative !important;">
						            <div id="example1_wrapper">
							            <table class="table dataTable data-table-basic table-curved table-striped tabla-estilo" style="width: 100%;">
							                <thead>
							                    <tr class="table-default text-white">
							                        <td colspan="5" align="center">
						                                <div class="card border border-info" role="alert">
						                                    <span class="text-dark p-1 mb-1"><strong>Aviso: </strong><br>-Seleccione un plan de pago para ver mas opciones.</span>
						                                </div>
						                            </td>
							                    </tr>
							                    <tr class="text-white" id="th1" style="background-color: #43d39e;">
							                        <th>
							                            <span class="PalabraEditarPago">Nombre</span>
							                            <span class="PalabraEditarPago2">N</span>
							                        </th>
							                        <th>
							                            <span class="PalabraEditarPago">Monto</span>
							                            <span class="PalabraEditarPago2">
							                            	<i data-feather="dollar-sign" class="iconosMetaforas2"></i>
							                            </span>
							                        </th>
							                        <th>
							                            <span class="PalabraEditarPago">Dias</span>
							                            <span class="PalabraEditarPago2">
							                            	<i data-feather="calendar" class="iconosMetaforas2"></i>
							                            </span>
							                        </th>
							                        <!-- <th>Estacionamientos</th> -->
							                        <th></th>
							                        <th>
							                            <span class="PalabraEditarPago">Status</span>
							                            <span class="PalabraEditarPago2">
							                                <i data-feather="sliders" class="iconosMetaforas2"></i>
							                            </span>
							                        </th>
							                        <!-- <th>Mensualidades</th> -->
							                    </tr>
							                    <tr class="bg-primary text-white" id="th2" style="display: none">
							                        <th width="10"></th>
							                        <th>
							                            <span class="PalabraEditarPago">Nombre</span>
							                            <span class="PalabraEditarPago2">N</span>
							                        </th>
							                        <th>
							                            <center>
							                                <span class="PalabraEditarPago">Opciones</span>
							                                <span class="PalabraEditarPago2">
							                                    <i data-feather="settings" class="iconosMetaforas2"></i>
							                                </span>
							                            </center>
							                        </th>
							                        <th></th>
							                        <th>
							                            <span class="PalabraEditarPago">Status</span>
							                            <span class="PalabraEditarPago2">
							                                <i data-feather="sliders" class="iconosMetaforas2"></i>
							                            </span>
							                        </th>
							                    </tr>
							                </thead>
							                <tbody>
							                    @php $num=0 @endphp
							                    @foreach($planes_pago as $key)
							                    	<tr class="vista1-{{$key->id}}" onclick="opcionesTabla(1,'{{$key->id}}')" data-toggle="tooltip" data-placement="top" title="Seleccione para ver mas opciones">
							                    		<td align="center">{{$key->nombre}}</td>
					                                    <td align="center">{{$key->monto}} $</td>
					                                    <td align="center">{{$key->dias}}</td>
							                    		<td align="center">
							                    			<img class="imagenAnun" src="{{ asset($key->url_img) }}" class="avatar" style="width:50%;max-width:640px;">
							                    		</td>
					                                    @if($key->status == 'Activo')
					                                        <td style="position: all;">
				                                                <span class="tituloTabla text-success"><strong>Activo</strong></span>
				                                                <span class="tituloTabla2 text-success"><strong>A</strong></span>
					                                        </td>
					                                    @else
					                                        <td style="position: all;">
				                                                <span class="tituloTabla text-danger"><strong>Inactivo</strong></span>
				                                                <span class="tituloTabla2 text-danger"><strong>I</strong></span>
					                                        </td>
					                                    @endif
							                    	</tr>
							                    	<tr class="vista2-{{$key->id}}" class="table-success" style="display: none;">
				                                    <td>
				                                        <button class="btn btn-success btn-sm boton-tabla shadow botonesEditEli" onclick="opcionesTabla(2,'{{$key->id}}')" data-toggle="tooltip" data-placement="top" title="Seleccione para regresar">
				                                            <span class="PalabraEditarPago ">Regresar</span>
				                                            <center>
				                                                <span class="PalabraEditarPago2 ">
				                                                    <i data-feather="arrow-left" class="iconosMetaforas2"></i>
				                                                </span>
				                                            </center>
				                                        </button>
				                                    </td>
				                                    <td>
				                                        	
				                                        <span>{{$key->nombre}}</span>
				                                    </td>
				                                    <td>
				                                        <span>{{$key->monto}}</span>
				                                    </td>
				                                    <td colspan="2" align="center">

				                                       <a data-toggle="collapse" href="#editarPlanPago" id="btnRegistrar_plan" role="button" aria-expanded="false" aria-controls="editarPlanPago" class="btn btn-warning btn-sm" onclick="editarPlanP(
				                                       '{{$key->id}}',
				                                       '{{$key->nombre}}',
				                                       '{{$key->monto}}',
				                                       '{{$key->dias}}',
				                                       '{{$key->color}}',
				                                       '{{$key->tipo}}',
				                                       '{{$key->status}}',
				                                       '{{$key->url_img}}')" data-toggle="tooltip" data-placement="top" title="Seleccione para editar datos">
				                                            <span class="PalabraEditarPago ">Editar</span>
				                                            <center>
				                                                <span class="PalabraEditarPago2 ">
				                                                    <i data-feather="edit" class="iconosMetaforas2"></i>
				                                                </span>
				                                            </center>
				                                        </a>
				                                    <a data-toggle="collapse" href="#EliminarPlanPago" id="btnRegistrar_plan" role="button" aria-expanded="false" aria-controls="EliminarPlanPago" class="btn btn-danger btn-sm" onclick="eliminarPlanP('{{$key->id}}')" data-toggle="tooltip" data-placement="top" title="Seleccione para eliminar plan de pago">
				                                            <span class="PalabraEditarPago ">Eliminar</span>
				                                            <center>
				                                                <span class="PalabraEditarPago2 ">
				                                                    <i data-feather="trash" class="iconosMetaforas2"></i>
				                                                </span>
				                                            </center>
				                                        </a>
				                                    </td>
				                                    <td style="display: none"></td>
				                                    

				                                </tr>
							                        <tr style="display: none;">
							                            <td></td>
							                            <td></td>
							                            <td></td>
							                            <td></td>
							                            <td></td>
							                        </tr>
							                    @endforeach()
							                </tbody>
							            </table>
							        </div>
				            	</div>
				            </div>
				        </div>
				    </div>
			    </div>
		    </div>
	    </div>
    </div>
    <div class="vistaPromociones" style="display: none;">
    	<div class="card rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;border: 1px solid #f6f6f7!important;border-color: #ff7043 !important;">
    		<div class="row justify-content-center">
			    <div class="col-md-12">
			    	<div style="width: 100%;">
				    	@include('planes_pago.layouts_promociones.create')
				    	@include('planes_pago.layouts_promociones.edit')
				    	@include('planes_pago.layouts_promociones.delete')
			    	</div>
			    </div>
			</div>
	        <div class="row justify-content-center">
			    <div class="col-md-12">
			    	<div class="listarPromociones" id="listarPromociones">
				        <div class="row justify-content-center">
				            <div class="col-md-12">
				                <div class="row">
				                    <div class="col-md-12 offset-md-12">
				                        <a data-toggle="collapse" href="#nuevaPromocion" id="btnRegistrar_pro" role="button" aria-expanded="false" aria-controls="nuevaPromocion" class="btn btn-success boton-tabla shadow" onclick="nuevaPromocion()" style="
				                            border-radius: 10px;
				                            color: white;
				                            height: 35px;
				                            margin-bottom: 5px;
				                            margin-top: 5px;
				                            float: right;
				                            border: 1px solid #f6f6f7!important;
				                            border-color: #ff7043 !important;
				                            background-color: #ff7043 !important;
				                            ">
				                            <span class="PalabraEditarPago text-white">Nueva Promoción</span>
				                            <center>
				                                <span class="PalabraEditarPago2 text-white">
				                                    <i data-feather="plus" class="iconosMetaforas2"></i>
				                                </span>
				                            </center>
				                        </a>
				                    </div>
				                </div>
				            </div>
				            <div id="example2_wrapper">
					            <table class="table dataTable data-table-basic table-curved table-striped tabla-estilo" style="width: 100%;">
					                <thead>
					                    <tr class="text-white">
					                        <td colspan="4" align="center">
				                                <div class="card border border-info" style="border-color: #ff7043 !important;" role="alert">
				                                    <span class="text-dark p-1 mb-1"><strong>Aviso: </strong><br>-Seleccione una promoción para ver mas opciones.</span>
				                                </div>
				                            </td>
					                    </tr>
					                    <tr class="text-white" id="th1-2" style="background-color: #ff7043 !important;">
					                        <th>
					                            <span class="PalabraEditarPago">Plan de pago</span>
					                            <span class="PalabraEditarPago2">Plan P</span>
					                        </th>
					                        <th>
					                            <span class="PalabraEditarPago">Porcentaje</span>
					                            <span class="PalabraEditarPago2">
					                            	<i data-feather="percent" class="iconosMetaforas2"></i>
					                            </span>
					                        </th>
					                        <th>
					                            <span class="PalabraEditarPago">Duracion</span>
					                            <span class="PalabraEditarPago2">
					                            	<i data-feather="calendar" class="iconosMetaforas2"></i>
					                            </span>
					                        </th>
					                        <th>
					                            <span class="PalabraEditarPago">Status</span>
					                            <span class="PalabraEditarPago2">
					                                <i data-feather="sliders" class="iconosMetaforas2"></i>
					                            </span>
					                        </th>
					                        <!-- <th>Mensualidades</th> -->
					                    </tr>
					                    <tr class="bg-primary text-white" id="th2-2" style="display: none">
					                        <th width="10"></th>
					                        <th>
					                            <span class="PalabraEditarPago">Plan de pago</span>
					                            <span class="PalabraEditarPago2">Plan P</span>
					                        </th>
					                        <th>
					                            <center>
					                                <span class="PalabraEditarPago">Opciones</span>
					                                <span class="PalabraEditarPago2">
					                                    <i data-feather="settings" class="iconosMetaforas2"></i>
					                                </span>
					                            </center>
					                        </th>
					                        <th>
					                            <span class="PalabraEditarPago">Status</span>
					                            <span class="PalabraEditarPago2">
					                                <i data-feather="sliders" class="iconosMetaforas2"></i>
					                            </span>
					                        </th>
					                    </tr>
					                </thead>
					                <tbody>
					                    @php $num=0 @endphp
					                    @foreach($promociones as $key)
					                    	<tr class="vista1-{{$key->id}}" onclick="opcionesTabla(1,'{{$key->id}}')" data-toggle="tooltip" data-placement="top" title="Seleccione para ver mas opciones">
					                    		<td align="center">{{$key->planP->nombre}}</td>
			                                    <td align="center">{{$key->porcentaje}} %</td>
			                                    <td align="center">{{$key->duracion}} días</td>
			                                    @if($key->status == 'Activo')
			                                        <td style="position: all;">
		                                                <span class="tituloTabla text-success"><strong>Activo</strong></span>
		                                                <span class="tituloTabla2 text-success"><strong>A</strong></span>
			                                        </td>
			                                    @else
			                                        <td style="position: all;">
		                                                <span class="tituloTabla text-danger"><strong>Inactivo</strong></span>
		                                                <span class="tituloTabla2 text-danger"><strong>I</strong></span>
			                                        </td>
			                                    @endif
					                    	</tr>
					                    	<tr class="vista2-{{$key->id}}" class="table-success" style="display: none;">
		                                    <td>
		                                        <button class="btn btn-success btn-sm boton-tabla shadow botonesEditEli" onclick="opcionesTabla(2,'{{$key->id}}')">
		                                            <span class="PalabraEditarPago ">Regresar</span>
		                                            <center>
		                                                <span class="PalabraEditarPago2 ">
		                                                    <i data-feather="arrow-left" class="iconosMetaforas2"></i>
		                                                </span>
		                                            </center>
		                                        </button>
		                                    </td>
		                                    <td>{{$key->planP->nombre}}</td>
		                                    <td align="center">

		                                       <a data-toggle="collapse" href="#editarPromocion" role="button" aria-expanded="false" aria-controls="editarPromocion" class="btn btn-warning btn-sm" onclick="editarPromocion(
		                                       '{{$key->id}}',
		                                       '{{$key->planP->id}}',
		                                       '{{$key->porcentaje}}',
		                                       '{{$key->duracion}}',
		                                       '{{$key->status}}')" data-toggle="tooltip" data-placement="top" title="Seleccione para editar datos">
		                                            <span class="PalabraEditarPago ">Editar</span>
		                                            <center>
		                                                <span class="PalabraEditarPago2 ">
		                                                    <i data-feather="edit" class="iconosMetaforas2"></i>
		                                                </span>
		                                            </center>
		                                        </a>
		                                    <a data-toggle="collapse" href="#EliminarPromocion" role="button" aria-expanded="false" aria-controls="EliminarPromocion" class="btn btn-danger btn-sm" onclick="eliminarPromocion('{{$key->id}}')" data-toggle="tooltip" data-placement="top" title="Seleccione para eliminar promoción">
		                                            <span class="PalabraEditarPago ">Eliminar</span>
		                                            <center>
		                                                <span class="PalabraEditarPago2 ">
		                                                    <i data-feather="trash" class="iconosMetaforas2"></i>
		                                                </span>
		                                            </center>
		                                        </a>
		                                    </td>
		                                    @if($key->status == 'Activo')
			                                        <td style="position: all;">
		                                                <span class="tituloTabla text-success"><strong>Activo</strong></span>
		                                                <span class="tituloTabla2 text-success"><strong>A</strong></span>
			                                        </td>
			                                    @else
			                                        <td style="position: all;">
		                                                <span class="tituloTabla text-danger"><strong>Inactivo</strong></span>
		                                                <span class="tituloTabla2 text-danger"><strong>I</strong></span>
			                                        </td>
			                                    @endif

		                                    

		                                </tr>
					                        <tr style="display: none;">
					                            <td></td>
					                            <td></td>
					                            <td></td>
					                            <td></td>
					                        </tr>
					                    @endforeach()
					                </tbody>
					            </table>
					        </div>
				        </div>
				    </div>
			    </div>
		    </div>
	    </div>
    </div>

@endsection

<script type="text/javascript">

	function cerrar(opcion) {
      $('#example1_wrapper').fadeIn('fast');
      $('#btnRegistrar_plan').show();
      $('#example2_wrapper').fadeIn('fast');
      $('#btnRegistrar_pro').show();
    }

    function nuevoPlanPago() {
    	$('#btnRegistrar_plan').fadeOut('fast');
      	$('#example1_wrapper').fadeOut('fast');
      	$('.mostrarImagenEditar').empty();
    }
    function editarPlanP(id,nombre,monto,dias,color,tipo,status,nombre_img){
		$('.id_PlanP').val(id);
		$('#nombre_PlanP').val(nombre);
		$('#monto_PlanP').val(monto);
		$('#dias_PlanP').val(dias);
		$('#color_PlanP').val(color);
		$('#tipo_PlanP').val(tipo);
		$('#status_PlanP').val(status);
		$('.mostrarImagenEditar').empty();
		$('.mostrarImagenEditar').append('<img class="imagenAnun text-dark" src="'+nombre_img+'" style="width:50%;max-width:200px;">');
    	$('#btnRegistrar_plan').fadeOut('fast');
      	$('#example1_wrapper').fadeOut('fast');
    }
	function eliminarPlanP(id){
		$('.id_PlanP').val(id);
		$('#btnRegistrar_plan').fadeOut('fast');
      	$('#example1_wrapper').fadeOut('fast');
	}










	function CambioVista(opcion){
		cerrar(1);
		if(opcion == 1){
			$(".vistaPromociones").fadeOut("slow",
            function() {
                $(this).hide();
				nuevaPromocion();
                $(".vistaPlanesP")
                    .css('opacity', 0)
                    .slideDown('slow')
                    .animate(
                        { opacity: 1 },
                        { queue: false, duration: 'slow' }
                    );
            });
            $('#example1_wrapper').fadeIn('fast');
      		$('#btnRegistrar_plan').show();
		}else{
			$(".vistaPlanesP").fadeOut("slow",
            function() {
                $(this).hide();
				nuevoPlanPago();
                $(".vistaPromociones")
                    .css('opacity', 0)
                    .slideDown('slow')
                    .animate(
                        { opacity: 1 },
                        { queue: false, duration: 'slow' }
                    );
            });
		}
	}




	function nuevaPromocion() {
    	$('#btnRegistrar_pro').fadeOut('fast');
		$('#example2_wrapper').fadeOut('fast');
    }
    

	function editarPromocion(id, id_planP, porcentaje, duracion, status) {
        $('#id_promocionE').val(id);
		$('#id_PlanP_promo_e').val(id_planP);
		$('#duracion_promo_e').val(duracion);
		$('#porcentaje_promo_e').val(porcentaje);
		$('#status_promo_e').val(status);
		$('#btnRegistrar_pro').fadeOut('fast');
		$('#example2_wrapper').fadeOut('fast');
    }
    function eliminarPromocion(id) {
    	$('#id_promocion').val(id);
    	$('#btnRegistrar_pro').fadeOut('fast');
		$('#example2_wrapper').fadeOut('fast');
    }
</script>