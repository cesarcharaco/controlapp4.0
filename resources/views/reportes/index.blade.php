@extends('layouts.app')

@section('content')
<div class="">
    <div class="row">
        <div class="col-md-12">
            <h4>Reportes - Gasto Común</h4>
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
		        					<option value="{{$key->id}}" @if($key->id==date('m')) selected="" @endif>{{$key->mes}}</option>
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
					    <div class="col-md-6">
				        	<div class="card border border-primary rounded shadow">
				        		<div class="card-body">
					        		<div class="form-group">
					        			<label class="text-primary">Inmuebles</label>
					        			<select multiple name="id_inmuebles[]" id="selectTodosInmuebles">
					        				@foreach($inmuebles as $key)
					        					<option value="{{$key->id}}">{{$key->idem}}</option>
					        				@endforeach
					        			</select>
					        			<div style="display: none">
						        			<select multiple id="selectTodosInmuebles2" style="display: none;">
						        				@foreach($inmuebles as $key)
						        					<option value="{{$key->id}}">{{$key->idem}}</option>
						        				@endforeach
						        			</select>
					        				
					        			</div>
					        		</div>
					        		<div class="form-group">
					        			<label>¿Todos los inmuebles?</label>
					        			<input type="checkbox" value="Si" name="InmueblesTodos" id="InmueblesTodos" onchange="TodosInmuebles()">
					        		</div>
		        					<div class="row justify-content-center">
			        					<div class="col-md-6">
							        		<div class="form-group">
							        			<select class="form-control select2 border border-default" multiple name="meses_inmuebles[]" id="selectMesesInmuebles">
							        				@foreach($meses as $key)
							        					<option value="{{$key->id}}">{{$key->mes}}</option>
							        				@endforeach
							        			</select>
							        			<div style="display: none">
								        			<select class="form-control select2 border border-default" multiple name="meses_inmuebles[]" id="selectMesesInmuebles2" style="display: none;">
								        				@foreach($meses as $key)
								        					<option value="{{$key->id}}">{{$key->mes}}</option>
								        				@endforeach
								        			</select>
								        		</div>
							        		</div>
							        		<div class="form-group">
							        			<label>¿Todos los meses del año?</label>
							        			<input type="checkbox" value="MesesTodosInmuebles" name="MesesTodosInmuebles" id="MesesTodosInmuebles" onchange="TodosMesesInmuebles()">
							        		</div>
							        	</div>
							        	<div class="col-md-6">
							        		<div class="form-group">
							        			<select class="form-control select2 border border-default" multiple name="anios_inmueble[]" id="selectTodosAniosInmuebles">
							        				@for($i=0; $i< count($anio); $i++)
							        					<option value="{{$anio[$i]}}">{{$anio[$i]}}</option>
							        				@endfor
							        			</select>
							        			<div style="display: none">
								        			<select class="form-control select2 border border-default" multiple name="anios_inmueble[]" id="selectTodosAniosInmuebles2" style="display: none">
								        				@for($i=0; $i< count($anio); $i++)
								        					<option value="{{$anio[$i]}}">{{$anio[$i]}}</option>
								        				@endfor
								        			</select>
								        		</div>
							        		</div>
							        		<div class="form-group">
							        			<label>¿Todos los años?</label>
							        			<input type="checkbox" value="AniosTodosInmuebles" name="AniosTodosInmuebles" id="AniosTodosInmuebles" onchange="TodosAniosInmuebles()">
							        		</div>
							        	</div>
							        </div>
				        		</div>
				        	</div>
					    </div>
			        	<div class="col-md-6">
			        		<div class="card border border-success rounded shadow">
		        				<div class="card-body">
					        		<div class="form-group">
					        			<label class="text-success">Residentes</label>
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
			        	</div>
					    {{--<div class="col-md-6">
					       	<div class="card border border-warning rounded shadow">
				        		<div class="card-body">
					        		<div class="form-group">
					        			<label class="text-warning">Estacionamientos</label>
					        			<select class="form-control select2 border border-warning" multiple name="id_estacionamientos[]" id="selectTodosEstacionamientos">
					        				@foreach($estacionamientos as $key)
					        					<option value="{{$key->id}}">{{$key->idem}}</option>
					        				@endforeach
					        			</select>
					        			<div style="display: none">
					        				<select class="form-control select2 border border-warning" multiple name="id_estacionamientos[]" id="selectTodosEstacionamientos2">
						        				@foreach($estacionamientos as $key)
						        					<option value="{{$key->id}}">{{$key->idem}}</option>
						        				@endforeach
					        				</select>
					        			</div>
					        		</div>
					        		<div class="form-group">
					        			<label>¿Todos los estacionamientos?</label>
					        			<input type="checkbox" value="Si" name="EstacionamientosTodos" id="EstacionamientosTodos" onchange="TodosEstacionamientos()">
					        		</div>
							        <div class="row justify-content-center">
			        					<div class="col-md-6">
							        		<div class="form-group">
							        			<select class="form-control select2 border border-default" multiple name="meses_estaciona[]" id="selectMesesEstaciona">
							        				@foreach($meses as $key)
							        					<option value="{{$key->id}}">{{$key->mes}}</option>
							        				@endforeach
							        			</select>
							        			<div style="display: none">
								        			<select class="form-control select2 border border-default" multiple name="meses_estaciona[]" id="selectMesesEstaciona2" style="display: none;">
								        				@foreach($meses as $key)
								        					<option value="{{$key->id}}">{{$key->mes}}</option>
								        				@endforeach
								        			</select>
								        		</div>
							        		</div>
							        		<div class="form-group">
							        			<label>¿Todos los meses del año?</label>
							        			<input type="checkbox" value="MesesTodosEstaciona" name="MesesTodosEstaciona" id="MesesTodosEstaciona" onchange="TodosMesesEstaciona()">
							        		</div>
							        	</div>
							        	<div class="col-md-6">
							        		<div class="form-group">
							        			<select class="form-control select2 border border-default" multiple name="anios_estaciona[]" id="selectAniosEstaciona">
							        				@for($i=0; $i< count($anio); $i++)
							        					<option value="{{$anio[$i]}}">{{$anio[$i]}}</option>
							        				@endfor
							        			</select>
							        			<div style="display: none">
								        			<select class="form-control select2 border border-default" multiple name="anios_estaciona[]" id="selectAniosEstaciona2" style="display: none;">
								        				@for($i=0; $i< count($anio); $i++)
								        					<option value="{{$anio[$i]}}">{{$anio[$i]}}</option>
								        				@endfor
								        			</select>
								        		</div>
							        		</div>
							        		<div class="form-group">
							        			<label>¿Todos los años?</label>
							        			<input type="checkbox" value="AniosTodosEstaciona" name="AniosTodosEstaciona" id="AniosTodosEstaciona" onchange="TodosAniosEstaciona()">
							        		</div>
							        	</div>
									</div>
							    </div>
							</div>
						</div>--}}
					</div>
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