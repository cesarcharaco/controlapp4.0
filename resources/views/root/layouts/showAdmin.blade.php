<div class="collapse multi-collapse" id="verAdmin" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
	<div class="card" style="width: 100%;">
		<div class="card-header">
	      <a data-toggle="collapse" data-target="#verAdmin" aria-expanded="false" aria-controls="verAdmin" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)" data-toggle="tooltip" data-placement="top" title="Seleccione para cerrar cuadro">
	        <strong>Cerrar</strong>
	      </a>
	    </div>
        <div class="card-body">
            <center>
        	<h4>Ver administrador</h4>
        		<div class="card">
        			<div class="card-body">
		                <div class="row">
		                    <div class="col-md-4">
		                        
		                        <div class="form-group">
		                            <label>Nombre del Admin</label>
		                            <h3>
		                            	<span id="name_v"></span>
		                            </h3>
		                        </div>
		                    </div>
		                    <div class="col-md-4">
		                        <div class="form-group">
		                            <label>RUT</label>
		                            <h3>
		                            	<span id="rut_v"></span>
		                            </h3>
		                        </div>
		                    </div>
		                    <div class="col-md-4">
		                        <div class="form-group">
		                            <label for="email_v">Email</label>
		                            <h3>
		                            	<span id="email_v"></span>
		                            </h3>
		                        </div>
		                    </div>
		                </div>
        			</div>
        		</div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status_v">Status</label>
	                        <span id="status_v"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="membresia_vd">Membresia actual</label>
                            <div id="membresia_v">
                            </div>
                        </div>
                    </div>
                </div>
            </center>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" id="id_admin_v">
            <button type="submit" class="btn btn-success" >Editar</button>
        </div>
	</div>
</div>