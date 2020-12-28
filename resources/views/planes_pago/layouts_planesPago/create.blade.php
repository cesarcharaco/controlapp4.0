<div class="collapse multi-collapse" id="nuevoPlanPago" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
	<div class="card">
		<div class="card-header">
	      <a data-toggle="collapse" data-target="#nuevoPlanPago" aria-expanded="false" aria-controls="nuevoPlanPago" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
	        <strong>Cerrar</strong>
	      </a>
	    </div>
		<div class="border card-body">
			<h4 class="header-title mb-2">Registro de planes de pago <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
			<center>
				{!! Form::open(['route' => ['planes_pago.store'], 'enctype' => 'multipart/form-data', 'method' => 'POST', 'name' => 'nuevp_planP', 'id' => 'nuevp_planP', 'data-parsley-validate']) !!}
					@csrf
					<h3 align="center" style="
						color: gray;
						font: 18px Arial, sans-serif;">
						Nuevo Plan de Pago
					</h3>
					<div class="form-group">
						<label>Nombre <b style="color: red;">*</b></label>
						<input type="text" name="nombre" class="form-control" required placeholder="Plan Nro. 1" required>
					</div>
					<div class="form-group">
						<label>Monto <b style="color: red;">*</b></label>
						<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
							<span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
								<span class="input-group-text" style="width:39px; height:39px;">
									<i data-feather="dollar-sign"></i>
								</span>
							</span>
							<input name="monto" data-toggle="touchspin" type="text" data-bts-prefix="$" class="form-control" placeholder="3000" required>
		    			</div>
					</div>
					<div class="form-group">
						<label>Dias <b style="color: red;">*</b></label>
						<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
							<span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
								<span class="input-group-text" style="width:39px; height:39px;">
									<i data-feather="calendar"></i>
								</span>
							</span>
							<input name="dias" min="1" minlength="1" max="365" data-toggle="touchspin" type="number" data-bts-prefix="$" class="form-control" placeholder="7" required>
		    			</div>
					</div>
					<div class="form-group">
						<label>Color <b style="color: red;">*</b></label>
						<div id="component-colorpicker" class="input-group colorpicker-element" title="Using format option" data-colorpicker-id="3">
							<span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
								<span class="input-group-text" style="width:39px; height:39px;">
									<i data-feather="pen-tool"></i>
								</span>
							</span>
		                    <input name="color" type="color" class="form-control input-lg" value="#564ab1" required>
		                </div>
					</div>
					<input type="hidden" name="tipo" value="Anuncio">
					<br>
					<div class="form-group">
		                <label>Imagen <b style="color: red;">*</b></label>
		                <div class="mostrarImagenEditar" align="center"></div>

		                <label for="file-upload" class="label-form custom-file-upload btn btn-primary border" style="
					    /*padding: 6px 12px;*/
					    cursor: pointer;">
						    <strong>Seleccionar imagen</strong>
						</label>
						<input name="imagen" id="file-upload" type="file" style="display: none;" onchange="input_file(this.value)" required />
		            </div>
		            <button type="submit" class="btn btn-success">Agregar</button>
				{!! Form::close() !!}
			</center>
		</div>
	</div>
</div>