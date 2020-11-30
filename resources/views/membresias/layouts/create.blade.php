<div class="collapse multi-collapse" id="nuevaMembresia" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
	<div class="card">
		<div class="card-header">
	      <a data-toggle="collapse" data-target="#nuevaMembresia" aria-expanded="false" aria-controls="nuevaMembresia" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
	        <strong>Cerrar</strong>
	      </a>
	    </div>
		<div class="card-body">
			<center>
				{!! Form::open(['route' => ['membresias.store'], 'enctype' => 'multipart/form-data', 'method' => 'POST', 'name' => 'nueva_membresia', 'id' => 'nueva_membresia', 'data-parsley-validate']) !!}
					@csrf
					<h3 align="center" style="
						color: gray;
						font: 18px Arial, sans-serif;">
						Nueva Membresía <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small>
					</h3>
					<div class="form-group">
						<label>Nombre <b class="text-danger">*</b></label>
						<input type="text" name="nombre" class="form-control" required placeholder="Membresía X" required>
					</div>
					<div class="form-group">
						<label>Cantidad de Inmuebles <b class="text-danger">*</b></label>
						<input type="number" name="cant_inmuebles" class="form-control" required placeholder="Cantidad de Inmuebles" min="1" required>
					</div>
					<div class="form-group">
						<label>Monto <b class="text-danger">*</b></label>
						<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
							<span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
								<span class="input-group-text" style="width:39px; height:39px;">
									<i data-feather="dollar-sign"></i>
								</span>
							</span>
							<input name="monto" data-toggle="touchspin" type="number" data-bts-prefix="$" class="form-control" placeholder="15" required min="1">
		    			</div>
					</div>
					<div class="form-group">
		                <label>Imagen <b class="text-danger">*</b></label>
		                <div class="mostrarImagenEditar" align="center"></div>

		                <label for="file-upload2" class="label-form2 custom-file-upload btn btn-primary border" style="
		                /*padding: 6px 12px;*/
		                cursor: pointer;">
		                    <strong>Seleccionar imagen</strong>
		                </label>
		                <input name="url_imagen" id="file-upload2" type="file" style="display: none;" onchange="input_file(this.value)" required/>
		            </div>
		            <button type="submit" class="btn btn-success">Agregar</button>
				{!! Form::close() !!}
			</center>
		</div>
	</div>
</div>