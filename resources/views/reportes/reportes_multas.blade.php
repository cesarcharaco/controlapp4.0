@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Reportes - Multas</h1>
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
        <div class="card border border-danger rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
        	<h3 align="center">Reporte General</h3>
        	<div class="card-body">



        		<form action="{{ route('reportes.general') }}" target="_blank" method="POST" accept-charset="utf-8">
			   	@csrf

	        		<div class="row">
	        			<div class="col-md-5">
			        		<div class="form-group">
			        			<label class="text-primary">Meses</label>
			        			<select class="form-control select2 border border-default" multiple name="id_mes[]">
			        				@foreach($meses as $key)
			        					<option value="{{$key->id}}">{{$key->mes}}</option>
			        				@endforeach
			        			</select>
			        		</div>
	        			</div>

	        			<div class="col-md-5">
			        		<div class="form-group">
			        			<label class="text-primary">Año</label>
			        			<select class="form-control select2 border border-default" name="anio" style="height: 100% !important;">
			        				@for($j=0;$j< count($anio);$j++)
			        					<option value="{{ $anio[$j] }}">{{ $anio[$j] }}</option>
			        				@endfor
			        			</select>
			        		</div>
	        			</div>

	        			<div class="col-md-2"><br>
	        				<h3><button type="submit" class="btn btn-danger btn-rounded">Generar PDF</button></h3>
	        			</div>
	        		</div>

	        	</form>
        	</div>
        </div>

				        
        @if(\Auth::user()->tipo_usuario == 'Admin')
	        <div class="card border border-danger rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
	    			<h3 align="center">Reporte</h3>
	            <div class="card-body">
	                <div class="row justify-content-center">
			            <!-- <div class="col-md-12">
			                <div class="row">
			                    <div class="col-md-12 offset-md-9">
			                        <a class="btn btn-success" data-toggle="modal" data-target="#crearMensualidad" style="border-radius: 30px; color: white;">
			                            <span> Reportes </span>
			                        </a>
			                    </div>
			                </div>
			            </div> -->                    

			        </div>

				    	

				    <form action="{{ route('reportes.store') }}" target="_blank" method="POST" accept-charset="utf-8">
				   	@csrf

				    	{{--<div class="row justify-content-center">
				    		<div class="col-md-12">
				    			<label  data-toggle="tooltip" data-placement="top" title="Seleccione el año para el reporte">Seleccione el año</label>
			        			<select class="form-control select2 border border-default" name="anio">
			        				@php 
			        					echo $fecha=date('Y');
			        					$fecha=$fecha-1;
			        				@endphp
			        				@for($i=$fecha; $i<($fecha+4); $i++)
			        					@if($i != '2019')
			        						<option value="{{ $i }}">{{ $i }}</option>
			        					@endif
			        				@endfor
			        			</select>
				    		</div>
				    	</div>--}}

					         <div class="row justify-content-center">
					        	<div class="col-md-12">
					        		<div class="card">
				        				<div class="card-body">
				        					<h3 class="text-success">Residentes</h3>
				        					<div class="row justify-content-center">
				        						<div class="col-md-6">
									        		<div class="form-group">
									        			<select class="form-control select2 border border-success" multiple name="id_residentes[]" id="selectTodosResidentes">
									        				@foreach($residentes as $key)
									        					<option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}} - {{$key->rut}}</option>
									        				@endforeach
									        			</select>
									        			<div style="display: none">
									        				<select class="form-control select2 border border-success" multiple name="id_residentes[]" id="selectTodosResidentes2">
									        				@foreach($residentes as $key)
									        					<option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}} - {{$key->rut}}</option>
									        				@endforeach
									        			</select>
									        			</div>
									        		</div>
									        		<div class="form-group">
									        			<label>¿Todos los residentes?</label>
									        			<input type="checkbox" value="Si" name="ResidentesTodos" id="ResidentesTodos" onchange="TodosResidentes()">
									        		</div>
				        						</div>
				        						<div class="col-md-6">
											        <div class="row justify-content-center">
							        					<div class="col-md-6">
											        		<div class="form-group">
											        			<select class="form-control select2 border border-default" multiple name="meses_residentes[]" id="selectMesesResidentes">
											        				@foreach($meses as $key)
											        					<option value="{{$key->id}}">{{$key->mes}}</option>
											        				@endforeach
											        			</select>
											        			<div style="display: none">
												        			<select class="form-control select2 border border-default" multiple name="meses_residentes[]" id="selectMesesResidentes2" style="display: none">
												        				@foreach($meses as $key)
												        					<option value="{{$key->id}}">{{$key->mes}}</option>
												        				@endforeach
												        			</select>
												        		</div>
											        		</div>
											        		<div class="form-group">
											        			<label>¿Todos los meses del año?</label>
											        			<input type="checkbox" value="MesesTodosResidentes" name="MesesTodosResidentes" id="MesesTodosResidentes" onchange="TodosMesesResidentes()">
											        		</div>
											        	</div>
											        	<div class="col-md-6">
											        		<div class="form-group">
											        			<select class="form-control select2 border border-default" multiple name="anios_residentes[]" id="selectAniosResidentes">
											        				@for($i=0; $i< count($anio); $i++)
											        					<option value="{{$anio[$i]}}">{{$anio[$i]}}</option>
											        				@endfor
											        			</select>
											        			<div style="display: none">
												        			<select class="form-control select2 border border-default" multiple name="anios_residentes[]" id="selectAniosResidentes2" style="display: none">
												        				@for($i=0; $i< count($anio); $i++)
												        					<option value="{{$anio[$i]}}">{{$anio[$i]}}</option>
												        				@endfor
												        			</select>
												        		</div>
											        		</div>
											        		<div class="form-group">
											        			<label>¿Todos los años?</label>
											        			<input type="checkbox" value="AniosTodosResidentes" name="AniosTodosResidentes" id="AniosTodosResidentes" onchange="TodosAniosResidentes()">
											        		</div>
											        	</div>
											        </div>
				        						</div>
				        					</div>

				        					<hr>
						        			<h3 class="text-danger">Multas/Recargas</h3>
						        			<div class="row justify-content-center">
						        				<div class="col-md-6">
									        		<div class="form-group">
									        			<select class="form-control select2 border border-success" multiple name="id_multa[]" id="selectTodosMultas">
									        				@foreach($multas as $key)
									        					<option value="{{$key->id}}">{{$key->motivo}} {{$key->tipo}} - {{$key->monto}}</option>
									        				@endforeach
									        			</select>
									        			<div style="display: none">
									        				<select class="form-control select2 border border-success" multiple name="id_multa[]" id="selectTodosMultas2">
									        				@foreach($multas as $key)
									        					<option value="{{$key->id}}">{{$key->motivo}} {{$key->tipo}} - {{$key->monto}}</option>
									        				@endforeach
									        			</select>
									        			</div>
									        		</div>
									        		<div class="form-group">
											        	<label>¿Todas las Multas y recargas? </label>
											        	<input type="checkbox" value="Si" name="MultasRecargas" id="MultasTodas" onclick="TodosMultas()">
											        </div>
						        				</div>
						        				<div class="col-md-6">
											        <div class="row justify-content-center">
							        					<div class="col-md-6">
											        		<div class="form-group">
											        			<select class="form-control select2 border border-default" multiple name="meses_multas[]" id="selectMesesMultas">
											        				@foreach($meses as $key)
											        					<option value="{{$key->id}}">{{$key->mes}}</option>
											        				@endforeach
											        			</select>
											        			<div style="display: none">
												        			<select class="form-control select2 border border-default" multiple name="meses_multas[]" id="selectMesesMultas2" style="display: none">
												        				@foreach($meses as $key)
												        					<option value="{{$key->id}}">{{$key->mes}}</option>
												        				@endforeach
												        			</select>
												        		</div>
											        		</div>
											        		<div class="form-group">
											        			<label>¿Todos los meses del año?</label>
											        			<input type="checkbox" value="MesesTodosMultas" name="MesesTodosMultas" id="MesesTodosMultas" onchange="TodosMesesMultas()">
											        		</div>
											        	</div>
											        	<div class="col-md-6">
											        		<div class="form-group">
											        			<select class="form-control select2 border border-default" multiple name="anios_multas[]" id="selectAniosMultas">
											        				@for($i=0; $i< count($anio); $i++)
											        					<option value="{{$anio[$i]}}">{{$anio[$i]}}</option>
											        				@endfor
											        			</select>
											        			<div style="display: none">
												        			<select class="form-control select2 border border-default" multiple name="anios_multas[]" id="selectAniosMultas2" style="display: none">
												        				@for($i=0; $i< count($anio); $i++)
												        					<option value="{{$anio[$i]}}">{{$anio[$i]}}</option>
												        				@endfor
												        			</select>
												        		</div>
											        		</div>
											        		<div class="form-group">
											        			<label>¿Todos los años?</label>
											        			<input type="checkbox" value="AniosTodosMultas" name="AniosTodosMultas" id="AniosTodosMultas" onchange="TodosAniosMultas()">
											        		</div>
											        	</div>
											        </div>
						        				</div>
						        			</div>
							        	</div>
							        </div>
					        	</div>
					        </div>


			        	<!-- <div class="card border border-warning rounded"> -->
				        	<!-- <div class="card-body"> -->
						        
						    <!-- </div> -->
						<!-- </div> -->


					        <!-- <div class="float-right">
					        	<h3><button type="button" class="btn btn-danger btn-rounded">Generar PDF</button></h3>
					        </div> -->

				        
					        <div class="float-right">
					        	<h3><button type="submit" class="btn btn-danger btn-rounded">Generar PDF</button></h3>
					        </div>

				    </form>

			    </div>
			</div>
		@endif()

    

@endsection

<script type="text/javascript">

</script>
<script type="text/javascript">

    function Eliminar(id) {
        $('#id').val(id);
    }


    // -----------------------------INMUEBLES --------------------------------------
    function TodosInmuebles() {
    	if($('#InmueblesTodos').prop('checked')){
    		$('#selectTodosInmuebles').attr('disabled',true);
    		var options = $("#selectTodosInmuebles2 > option").clone();
    		$("#selectTodosInmuebles > option").remove();
    		$("#selectTodosInmuebles").append(options);

    		// $("#selectTodosInmuebles").multiselect("clearSelection");
			// $("#selectTodosInmuebles").multiselect( 'refresh' );
    	}else{
    		$('#selectTodosInmuebles').removeAttr('disabled',false);
    	}
    }

    function TodosMesesInmuebles() {
    	if($('#MesesTodosInmuebles').prop('checked')){
    		$('#selectMesesInmuebles').attr('disabled',true);
    		var options = $("#selectMesesInmuebles2 > option").clone();
    		$("#selectMesesInmuebles > option").remove();
    		$("#selectMesesInmuebles").append(options);
    	}else{
    		$('#selectMesesInmuebles').removeAttr('disabled',false);
    	}
    }

    function TodosAniosInmuebles() {
    	if($('#AniosTodosInmuebles').prop('checked')){
    		$('#selectTodosAniosInmuebles').attr('disabled',true);
    		var options = $("#selectTodosAniosInmuebles2 > option").clone();
    		$("#selectTodosAniosInmuebles > option").remove();
    		$("#selectTodosAniosInmuebles").append(options);
    	}else{
    		$('#selectTodosAniosInmuebles').removeAttr('disabled',false);
    	}
    }

    //-------------------------------ESTACIONAMIENTOS-------------------------------

    function TodosEstacionamientos() {
    	if($('#EstacionamientosTodos').prop('checked')){
    		$('#selectTodosEstacionamientos').attr('disabled',true);
    		var options = $("#selectTodosEstacionamientos2 > option").clone();
    		$("#selectTodosEstacionamientos > option").remove();
    		$("#selectTodosEstacionamientos").append(options);
    	}else{
    		$('#selectTodosEstacionamientos').removeAttr('disabled',false);
    	}
    }
    function TodosMesesEstaciona() {
    	if($('#MesesTodosEstaciona').prop('checked')){
    		$('#selectMesesEstaciona').attr('disabled',true);
    		var options = $("#selectMesesEstaciona2 > option").clone();
    		$("#selectMesesEstaciona > option").remove();
    		$("#selectMesesEstaciona").append(options);
    	}else{
    		$('#selectMesesEstaciona').removeAttr('disabled',false);
    	}
    }

    function TodosAniosEstaciona() {
    	if($('#AniosTodosEstaciona').prop('checked')){
    		$('#selectAniosEstaciona').attr('disabled',true);
    		var options = $("#selectAniosEstaciona2 > option").clone();
    		$("#selectAniosEstaciona > option").remove();
    		$("#selectAniosEstaciona").append(options);
    	}else{
    		$('#selectAniosEstaciona').removeAttr('disabled',false);
    	}
    }

    //-------------------------------------residentes------------------------------
    function TodosResidentes() {
    	if($('#ResidentesTodos').prop('checked')){
    		$('#selectTodosResidentes').attr('disabled',true);
    		var options = $("#selectTodosResidentes2 > option").clone();
    		$("#selectTodosResidentes > option").remove();
    		$("#selectTodosResidentes").append(options);
    	}else{
    		$('#selectTodosResidentes').removeAttr('disabled',false);
    	}
    }

    function TodosMesesResidentes() {
    	if($('#MesesTodosResidentes').prop('checked')){
    		$('#selectMesesResidentes').attr('disabled',true);
    		var options = $("#selectMesesResidentes2 > option").clone();
    		$("#selectMesesResidentes > option").remove();
    		$("#selectMesesResidentes").append(options);
    	}else{
    		$('#selectMesesResidentes').removeAttr('disabled',false);
    	}
    }

    function TodosAniosResidentes() {
    	if($('#AniosTodosResidentes').prop('checked')){
    		$('#selectAniosResidentes').attr('disabled',true);
    		var options = $("#selectAniosResidentes2 > option").clone();
    		$("#selectAniosResidentes > option").remove();
    		$("#selectAniosResidentes").append(options);
    	}else{
    		$('#selectAniosResidentes').removeAttr('disabled',false);
    	}
    }

    //-------------------------------------MULTAS------------------------------
    function TodosMultas() {
    	if($('#MultasTodas').prop('checked')){
    		$('#selectTodosMultas').attr('disabled',true);
    		var options = $("#selectTodosMultas2 > option").clone();
    		$("#selectTodosMultas > option").remove();
    		$("#selectTodosMultas").append(options);
    	}else{
    		$('#selectTodosMultas').removeAttr('disabled',false);
    	}
    }

    function TodosMesesMultas() {
    	if($('#MesesTodosMultas').prop('checked')){
    		$('#selectMesesMultas').attr('disabled',true);
    		var options = $("#selectMesesMultas2 > option").clone();
    		$("#selectMesesMultas > option").remove();
    		$("#selectMesesMultas").append(options);
    	}else{
    		$('#selectMesesMultas').removeAttr('disabled',false);
    	}
    }

    function TodosAniosMultas() {
    	if($('#AniosTodosMultas').prop('checked')){
    		$('#selectAniosMultas').attr('disabled',true);
    		var options = $("#selectAniosMultas2 > option").clone();
    		$("#selectAniosMultas > option").remove();
    		$("#selectAniosMultas").append(options);
    	}else{
    		$('#selectAniosMultas').removeAttr('disabled',false);
    	}
    }

    
</script>