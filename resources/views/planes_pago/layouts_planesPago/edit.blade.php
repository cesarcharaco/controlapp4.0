<div class="collapse multi-collapse" id="editarPlanPago" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
	<div class="card">
		<div class="card-header">
	      <a data-toggle="collapse" data-target="#editarPlanPago" aria-expanded="false" aria-controls="editarPlanPago" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(3)" data-toggle="tooltip" data-placement="top" title="Cerrar cuadro de editar plan de pago">
	        <strong>Cerrar</strong>
	      </a>
	    </div>
		<div class="border card-body">
			{!! Form::open(['route' => ['planes_pago.update',1033], 'enctype' => 'multipart/form-data', 'method' => 'PUT', 'name' => 'editar_planP', 'id' => 'editar_planP', 'data-parsley-validate']) !!}
				@csrf
				<h3 align="center" style="
					color: gray;
					font: 18px Arial, sans-serif;">
					Editar Plan de Pago
				</h3>
				<div class="form-group">
					<label>Nombre</label>
					<input type="text" id="nombre_PlanP" name="nombre" class="form-control" required placeholder="Plan Nro. 1" required>
				</div>
				<div class="form-group">
					<label>Monto</label>
					<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
						<span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
							<span class="input-group-text" style="width:39px; height:39px;">
								<i data-feather="dollar-sign"></i>
							</span>
						</span>
						<input name="monto" id="monto_PlanP" data-toggle="touchspin" type="text" data-bts-prefix="$" class="form-control" placeholder="3000" required>
	    			</div>
				</div>
				<div class="form-group">
					<label>Dias</label>
					<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
						<span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
							<span class="input-group-text" style="width:39px; height:39px;">
								<i data-feather="calendar"></i>
							</span>
						</span>
						<input name="dias" id="dias_PlanP" min="1" minlength="1" max="365" data-toggle="touchspin" type="number" data-bts-prefix="$" class="form-control" placeholder="7" required>
	    			</div>
				</div>
				<div class="form-group">
					<label>Color</label>
					<div id="component-colorpicker" class="input-group colorpicker-element" title="Using format option" data-colorpicker-id="3">
						<span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
							<span class="input-group-text" style="width:39px; height:39px;">
								<i data-feather="pen-tool"></i>
							</span>
						</span>
	                    <input name="color" id="color_PlanP" type="color" class="form-control input-lg" value="#564ab1" required>
	                </div>
				</div>
				<input type="hidden" name="tipo" value="Anuncio">
				<br>
				<div class="form-group">
	                <label>Imagen</label>
	                <div class="mostrarImagenEditar" align="center"></div>

	                <label for="file-upload_e" class="label-form2 custom-file-upload btn btn-primary border" style="cursor: pointer;"><strong>Seleccionar imagen</strong></label>
					<input name="imagen" id="file-upload_e" type="file" style="display: none;" onchange="input_file(this.value)" required />
	            </div>
	            <div class="form-group">
	                <label>Status</label>
	                <select name="status" class="form-control select2" id="status_PlanP">
	                	<option value="Activo">Activo</option>
	                	<option value="Inactivo">Inactivo</option>
	                </select>
	            </div>
	            <center>
	                <input type="hidden" name="id" class="id_PlanP">
	                <button type="submit" class="btn btn-warning">Actualizar</button>
	            </center>
			{!! Form::close() !!}
		</div>
	</div>
</div>