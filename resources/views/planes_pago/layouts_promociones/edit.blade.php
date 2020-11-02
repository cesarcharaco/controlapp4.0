<div class="collapse multi-collapse" id="editarPromocion" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
    <div class="card">
        <div class="card-header">
          <a data-toggle="collapse" data-target="#editarPromocion" aria-expanded="false" aria-controls="editarPromocion" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(3)">
            <strong>Cerrar</strong>
          </a>
        </div>
    	<div class="card-body">
    		{!! Form::open(['route' => ['promociones.update',1033], 'enctype' => 'multipart/form-data', 'method' => 'PUT', 'name' => 'editar_promocion', 'id' => 'editar_promocion', 'data-parsley-validate']) !!}
    			@csrf
    			<h3 align="center" style="
    				color: gray;
    				font: 18px Arial, sans-serif;">
    				Editar Promoción
    			</h3>
    			<center>
        			<div class="form-group">
        				<label>Plan de pago</label>
        				<select name="id_planP" id="id_PlanP_promo_e" class="form-control select2" required>
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
        					<input name="porcentaje" id="porcentaje_promo_e" data-toggle="touchspin" type="text" data-bts-prefix="$" class="form-control" placeholder="30" required>
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
        					<input name="duracion" id="duracion_promo_e" min="1" minlength="1" max="365" data-toggle="touchspin" type="number" data-bts-prefix="$" class="form-control" placeholder="7" required>
            			</div>
        			</div>
        			<div class="form-group">
        				<label>Status</label>
        				<select name="status" id="status_promo_e" class="form-control select2" required>
        					<option value="Activo">Activo</option>
                    		<option value="Inactivo">Inactivo</option>
        				</select>
        			</div>
        			<input type="hidden" name="id" id="id_promocionE" id="">
                    <button type="submit" class="btn btn-warning">Editar</button>
                </center>
    		{!! Form::close() !!}
    	</div>
    </div>
</div>