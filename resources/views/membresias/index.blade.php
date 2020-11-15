@extends('layouts.app')

@section('content')
     <style type="text/css">
        .card {
            border: 1px solid #f6f6f7!important;
            border-color: #CB8C4D !important;
        }
        .palabraVerMembresía2, .palabraVerEstaciona2,.PalabraEditarPago2, .tituloTabla2
        {
            display: none;
        }
        @media only screen and (max-width: 800px)  {

            .PalabraEditarPago, .PalabraRealizarPago, .PalabraPagoConfirmar{
                display: none;
            }
            .palabraVerMembresía{
                display: none;
            }
            .palabraVerMembresía2{
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
    <!-- <input type="hidden" id="colorView" value="#43d39e !important"> -->
    <div class="container">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Membresías</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Membresías</h4>
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
    <div class="card rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="height: 100%;">
                    @include('membresias.layouts.create')
                    @include('membresias.layouts.show')
                    @include('membresias.layouts.edit')
                    @include('membresias.layouts.delete')
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 offset-md-12">
                        <a data-toggle="collapse" href="#nuevaMembresia" id="btnRegistrar_membresia" role="button" aria-expanded="false" aria-controls="nuevaMembresia" class="btn btn-success boton-tabla shadow" onclick="nuevaMembresia()" style="
                            border-radius: 10px;
                            color: white;
                            height: 35px;
                            margin-bottom: 5px;
                            margin-top: 5px;
                            float: right;
                            border: 1px solid #f6f6f7!important;
                            border-color: #43d39e !important;
                            background-color: #43d39e !important">
                            <span class="PalabraEditarPago text-white">Nueva Membresía</span>
                            <center>
                                <span class="PalabraEditarPago2 text-white">
                                    <i data-feather="plus" class="iconosMetaforas2"></i>
                                </span>
                            </center>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
		    <div class="col-md-12">
                <div id="example1_wrapper">
    	            <table class="table dataTable data-table-basic table-curved table-striped tabla-estilo" style="width: 100% !important;">
    	                <thead>
    	                    <tr class="table-default text-white">
    	                        <td colspan="4" align="center">
                                    <div class="card border" style="border-color: #43d39e !important;" role="alert">
                                        <span class="text-dark p-1 mb-1"><strong>Aviso: </strong><br>-Seleccione una membresía para ver mas opciones.</span>
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
    	                            <span class="PalabraEditarPago">Cant. Inmuebles</span>
    	                            <span class="PalabraEditarPago2">
    	                            	<i data-feather="users" class="iconosMetaforas2"></i>
    	                            </span>
    	                        </th>
    	                        <!-- <th>Estacionamientos</th> -->
    	                        <th>
    	                        	<span class="PalabraEditarPago">Imagen</span>
    	                        </th>
    	                        <!-- <th>Mensualidades</th> -->
    	                    </tr>
    	                    <tr class="bg-primary text-white" id="th2" style="display: none">
    	                        <th width="10"></th>
    	                        <th>
    	                            <span class="PalabraEditarPago">Nombre</span>
    	                            <span class="PalabraEditarPago2">N</span>
    	                        </th>
    	                        <th colspan="2">
    	                            <center>
    	                                <span class="PalabraEditarPago">Opciones</span>
    	                                <span class="PalabraEditarPago2">
    	                                    <i data-feather="settings" class="iconosMetaforas2"></i>
    	                                </span>
    	                            </center>
    	                        </th>
    	                    </tr>
    	                </thead>
    	                <tbody>
    	                    @php $num=0 @endphp
    	                    @foreach($membresias as $key)
    	                    	<tr class="vista1-{{$key->id}}" onclick="opcionesTabla(1,'{{$key->id}}')" data-toggle="tooltip" data-placement="top" title="Seleccione para ver mas opciones" value="1">
    	                    		<td align="center">{{$key->nombre}}</td>
                                    <td align="center">{{$key->monto}} $</td>
                                    <td align="center">{{$key->cant_inmuebles}}</td>
    	                    		<td>
    	                    			<img class="imagenAnun border" src="{{ asset($key->url_imagen) }}" class="avatar" style="width:100%;max-width:640px; border-radius: 50% !important;">
    	                    		</td>
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
                                <td>
                                    <span>{{$key->nombre}}</span>
                                </td>
                                <td style="display: none;">
                                </td>
                                <td colspan="2" align="center">

                                   <a data-toggle="collapse" href="#editarMembresia" role="button" aria-expanded="false" aria-controls="editarMembresia"  class="btn btn-warning btn-sm" onclick="editarMembresia(
                                   '{{$key->id}}',
                                   '{{$key->nombre}}',
                                   '{{$key->monto}}',
                                   '{{$key->cant_inmuebles}}',
                                   '{{$key->url_imagen}}')">
                                        <span class="PalabraEditarPago ">Editar</span>
                                        <center>
                                            <span class="PalabraEditarPago2 ">
                                                <i data-feather="edit" class="iconosMetaforas2"></i>
                                            </span>
                                        </center>
                                    </a>
                                <a data-toggle="collapse" href="#EliminarMembresia" role="button" aria-expanded="false" aria-controls="EliminarMembresia" class="btn btn-danger btn-sm" onclick="eliminarMembresia('{{$key->id}}')">
                                        <span class="PalabraEditarPago ">Eliminar</span>
                                        <center>
                                            <span class="PalabraEditarPago2 ">
                                                <i data-feather="trash" class="iconosMetaforas2"></i>
                                            </span>
                                        </center>
                                    </a>
                                </td>
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

@endsection

<script type="text/javascript">

    function cerrar(opcion) {
      $('#example1_wrapper').fadeIn('fast');
      $('#btnRegistrar_membresia').show();
      $('.mostrarImagenEditar').empty();
    }

	function mostrarEditarImagen(opcion) {
		if(opcion == 1){
			$('#mostrarEditarImagenCheck').removeAttr('onchange');
			$('#mostrarEditarImagenCheck').attr('onchange','mostrarEditarImagen(2)');
            $('.label-form2').show();
			$('#mostrarEditarImagen2').removeAttr('disabled',false);
			$('#mostrarEditarImagen2').attr('required',true);
		}else{
			$('#mostrarEditarImagenCheck').removeAttr('onchange');
			$('#mostrarEditarImagenCheck').attr('onchange','mostrarEditarImagen(1)');
            $('.label-form2').hide();
			$('#mostrarEditarImagen2').attr('disabled',true);
			$('#mostrarEditarImagen2').removeAttr('required',false);
			$('#mostrarEditarImagen2').val(null);
		}
	}
	function nuevaMembresia() {
		$('#btnRegistrar_membresia').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');
	}

	function editarMembresia(id,nombre,monto,cant_inmuebles,url_imagen) {
		$('.id_edit_membresia').val(id);
		$('#nombre_Membresia').val(nombre);
		$('#cant_inmuebles_membresia').val(cant_inmuebles);
		$('#monto_Membresia_e').val(monto);
		$('#imagenMembresia').val();
		$('.mostrarImagenEditar').empty();
		$('.mostrarImagenEditar').append('<img class="imagenAnun border" src="'+url_imagen+'" class="avatar" style="width:100%;max-width:640px; border-radius: 50% !important;">');

        $('#btnRegistrar_membresia').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');
	}

	function eliminarMembresia(id) {
		$('#id_membresia').val(id);
		$('#btnRegistrar_membresia').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');
	}
</script>