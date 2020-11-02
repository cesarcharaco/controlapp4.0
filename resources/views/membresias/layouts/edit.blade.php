<div class="collapse multi-collapse" id="editarMembresia" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
	<div class="card">
		<div class="card-header">
	      <a data-toggle="collapse" data-target="#editarMembresia" aria-expanded="false" aria-controls="editarMembresia" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
	        <strong>Cerrar</strong>
	      </a>
	    </div>
		<div class="card-body">
			{!! Form::open(['route' => ['membresias.update',1033], 'enctype' => 'multipart/form-data', 'method' => 'PUT', 'name' => 'editar_membresia', 'id' => 'editar_membresia', 'data-parsley-validate']) !!}
				@csrf
				<h3 align="center" style="
					color: gray;
					font: 18px Arial, sans-serif;">
					Editar Membresía <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small>
				</h3>
				<div class="form-group">
					<label>Nombre <b class="text-danger">*</b></label>
					<input type="text" id="nombre_Membresia" name="nombre" class="form-control" required placeholder="Membresía X" required>
				</div>
				<div class="form-group">
					<label>Cantidad de Inmuebles <b class="text-danger">*</b></label>
					<input type="number" id="cant_inmuebles_membresia" name="cant_inmuebles" class="form-control" required placeholder="Cantidad de Inmuebles" min="1" required>
				</div>
				<div class="form-group">
					<label>Monto <b class="text-danger">*</b></label>
					<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
						<span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
							<span class="input-group-text" style="width:39px; height:39px;">
								<i data-feather="dollar-sign"></i>
							</span>
						</span>
						<input name="monto" id="monto_Membresia_e" data-toggle="touchspin" type="number" data-bts-prefix="$" class="form-control" placeholder="3000" min="1" required>
	    			</div>
				</div>
				<br>
	            <label>Imagen </label>
	            <div class="mostrarImagenEditar" align="center"></div>
				<div class="form-group">
					<input type="checkbox" name="cambiar_imagen" onchange="mostrarEditarImagen(1)" id="mostrarEditarImagenCheck"  data-toggle="tooltip" data-placement="top" title="Seleccione si desea editar la imagen de membresia" value="1">
		            <label for="admins_todos">¿Cambiar imagen?</label>
				</div>
				<div class="form-group">
	                <label for="file-upload2" class="label-form2 custom-file-upload btn btn-primary border" style="
	                cursor: pointer; display: none;">
	                    <strong>Seleccionar imagen</strong>
	                </label>
	                <input name="url_imagen" id="mostrarEditarImagen2" type="file" style="display: none;" onchange="input_file(this.value)" disabled />
	            </div>
	            <center>
	                <input type="hidden" name="id" class="id_edit_membresia">
	                <button type="submit" class="btn btn-success">Actualizar</button>
	            </center>
			{!! Form::close() !!}
		</div>
	</div>
</div>