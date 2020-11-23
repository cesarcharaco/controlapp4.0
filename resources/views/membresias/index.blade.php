@extends('layouts.app')

@section('content')

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
    <div class="card rounded card-tabla shadow p-3 mb-5 bg-white rounded">
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
                        <a data-toggle="tooltip" data-placement="top" title="Seleccione para registrar nueva membresía" id="btnRegistrar_membresia" role="button" aria-expanded="false" aria-controls="nuevaMembresia" class="btn btn-success boton-tabla shadow" onclick="nuevaMembresia()" style="
                            border-radius: 10px;
                            color: white;
                            height: 35px;
                            margin-bottom: 5px;
                            margin-top: 5px;
                            float: right;
                            border: 1px solid #f6f6f7!important;
                            border-color: #43d39e !important;
                            background-color: #43d39e !important">
                            <span class=" text-white">
                                <i data-feather="plus"></i>
                                Nueva Membresía
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
		    <div class="col-md-12">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                    <table class="table table-bordered table-hover table-striped dataTable" style="width: 100% !important;">
    	                <thead>
    	                    <tr class="text-white" style="background-color: #43d39e;">
                                <th>#</th>
    	                        <th>Nombre</th>
    	                        <th>Monto</th>
    	                        <th>Cant. Inmuebles</th>
    	                        <th>Imagen</th>
                                <th>Opciones</th>
    	                    </tr>
    	                </thead>
    	                <tbody>
    	                    @php $num=0 @endphp
    	                    @foreach($membresias as $key)
    	                    	<tr>
                                    <td>{{$num=$num+1}}</td>
    	                    		<td>{{$key->nombre}}</td>
                                    <td>{{$key->monto}} $</td>
                                    <td>{{$key->cant_inmuebles}}</td>
    	                    		<td>
    	                    			<img class="imagenAnun border" src="{{ asset($key->url_imagen) }}" class="avatar" style="width:100%;max-width:640px; border-radius: 50% !important;">
    	                    		</td>
                                    <td>

                                       <a href="#editarMembresia" role="button" aria-expanded="false" aria-controls="editarMembresia"  class="btn btn-warning btn-sm" onclick="editarMembresia(
                                       '{{$key->id}}',
                                       '{{$key->nombre}}',
                                       '{{$key->monto}}',
                                       '{{$key->cant_inmuebles}}',
                                       '{{$key->url_imagen}}')"
                                       data-toggle="tooltip" data-placement="top" title="Seleccione para editar los datos de la membresía">
                                            <span><i data-feather="edit"></i>Editar</span>
                                        </a>
                                        <a href="#EliminarMembresia" role="button" aria-expanded="false" aria-controls="EliminarMembresia" class="btn btn-danger btn-sm" onclick="eliminarMembresia('{{$key->id}}')"data-toggle="tooltip" data-placement="top" title="Seleccione para eliminar la membresía del sistema">
                                            <span> <i data-feather="trash"></i>Eliminar</span>
                                        </a>
                                    </td>
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
      // $('.multi-collapse').collapse('hide');
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
        $('#nuevaMembresia').collapse('show');
		$('#btnRegistrar_membresia').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');
	}

	function editarMembresia(id,nombre,monto,cant_inmuebles,url_imagen) {
        $('#editarMembresia').collapse('show');
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
        $('#EliminarMembresia').collapse('show');
		$('#id_membresia').val(id);
		$('#btnRegistrar_membresia').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');
	}
</script>