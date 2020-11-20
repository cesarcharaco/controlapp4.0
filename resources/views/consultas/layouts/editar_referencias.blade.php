<div class="modal fade" id="editar_referencia_residente" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
            	<h3>Editar referencias de Arriendos</h3>
            	<div id="cargandoRefeArriendos">
			        <div class="spinner-border text-warning m-2" role="status" id="cargando_E">
			            <span class="sr-only">Cargando referencia</span>
			        </div>
			    </div>
            	<button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
			    {!! Form::open(['route' => ['edit_ref_alquiler'], 'method' => 'POST']) !!}
			        @csrf
			        <center>
			        	<div id="selectInstalacionesArr" class="form-group" data-toggle="tooltip" data-placement="top" title="Seleccione instalación para editar referencia">
			        		<label>Instalaciones <b class="text-danger">*</b></label>
			        		<select name="id_instalacion" class="form-control select2" required id="id_instalacion_arriendos" onchange="buscarReferenciasInsta(this.value)">
			        			
			        		</select>
			        	</div>
			        	<div id="codigoActualRefArr2"></div>
						<div id="vistaRefeArriendosE">
				        	<div class="card border border-warning rounded card-tabla shadow p-3 mb-5 bg-white rounded">
				            	<div class="card-body">
					                <div id="codigoActualRefArr"></div>
					                <center>
					                   <div class="row">
					                       <div class="col-md-12">
					                           <div class="form-group">
					                               <label for="">Código de Refer. Nueva <b class="text-danger">*</b></label>
					                               <input id="ReferenciaNueva" type="text" name="ReferenciaNueva" class="form-control" required placeholder="Nro. de referencia">
					                           </div>
					                       </div>
					                   </div>
					                </center>
							        <div align="center">
							            <input type="hidden" name="id" id="id_arriendoEditReferencia">
							            <button type="submit" class="btn btn-warning">Editar</button>
							        </div>
							    </div>
				            </div>
				        </div>
			        </center>

			    {!! Form::close() !!}
    		</div>
  		</div>
  	</div>
</div>