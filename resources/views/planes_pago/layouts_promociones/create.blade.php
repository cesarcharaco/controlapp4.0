<div class="collapse multi-collapse" id="nuevaPromocion" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
    <div class="card">
        <div class="card-header">
          <a data-toggle="collapse" data-target="#nuevaPromocion" aria-expanded="false" aria-controls="nuevaPromocion" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
            <strong>Cerrar</strong>
          </a>
        </div>
    	<div class="card-body">
    		{!! Form::open(['route' => ['promociones.store'], 'enctype' => 'multipart/form-data', 'method' => 'POST', 'name' => 'nuevp_planP', 'id' => 'nuevp_planP', 'data-parsley-validate']) !!}
    			@csrf
    			<h3 align="center" style="
    				color: gray;
    				font: 18px Arial, sans-serif;">
    				Nueva Promoción
    			</h3>
    			<center>
        			<div class="form-group">
        				<label>Plan de pago</label>
        				<select name="id_planP" class="form-control select2" required>
        					@foreach($planes_pago as $key)
        						@if($key->tipo == 'Anuncio')
        							<option value="{{$key->id}}">{{$key->nombre}} - <strong>Monto: </strong>{{$key->monto}}$</option>
        						@endif
        					@endforeach
        				</select>
        			</div>
        			<div class="form-group">
        				<label>Porcentaje (Descuento)</label>
        				<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
        					<span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
        						<span class="input-group-text" style="width:39px; height:39px;">
        							<i data-feather="percent"></i>
        						</span>
        					</span>
        					<input name="porcentaje" data-toggle="touchspin" type="text" data-bts-prefix="$" class="form-control" placeholder="30" required>
            			</div>
        			</div>
        			<div class="form-group">
        				<label>Duración (Dias)</label>
        				<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
        					<span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
        						<span class="input-group-text" style="width:39px; height:39px;">
        							<i data-feather="calendar"></i>
        						</span>
        					</span>
        					<input name="duracion" min="1" minlength="1" max="365" data-toggle="touchspin" type="number" data-bts-prefix="$" class="form-control" placeholder="7" required>
            			</div>
        			</div>
        			
                    <button type="submit" class="btn btn-success">Agregar</button>
                </center>
    		{!! Form::close() !!}
        </div>
    </div>
</div>