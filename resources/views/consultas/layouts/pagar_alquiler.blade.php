<div class="modal fade" id="pagarAlquilerResidente" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
            	<h3>Pagar Alquiler</h3>
            	<div id="cargandoPagoAlquileres">
			        <div class="spinner-border text-success m-2" role="status" id="cargando_E">
			            <span class="sr-only">Cargando alquiler</span>
			        </div>
			    </div>
            	<button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
			    {!! Form::open(['route' => ['pagar_alquiler_resi'], 'method' => 'POST']) !!}
			        @csrf
			        <center>
			        	<div id="example3_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                    		
			        	</div>
			        	<div id="MensajeBsucarArriendo"></div>
			        </center>
			        	<div id="referenciaBuscarArriendo" style="display: none;">
					        <a class="btn btn-info text-white shadow btn-sm" onclick="volverTablaPagarC2()">
			                	<i data-feather="arrow-left-circle"></i>
			                    Regresar
			                </a>
			                <center>

			                	<center id="mostrarFlow" class="mb-2 mt-2">
                                    <b>Pagar con Flow</b> 
                                    <input type='checkbox' onclick='FlowCheck()' name='flow' value='1' id='checkFlow'>
                                </center>
                                <div class="card border rounded" id="datosPagarAlquiler" style="display: none;">
                                	<div class="card-body">
		                                <div class="row">
		                                	<div class="col-md-4">
		                                		<div class="form-group">
			                                		<label>Alquiler</label>
						        					<h4 id="nombreA"></h4>
		                                		</div>
		                                	</div>
		                                	<div class="col-md-4">
		                                		<div class="form-group">
			                                		<label>Tipo de Alquiler</label>
			                                		<h4 id="tipoAlquilerA"></h4>
		                                		</div>
		                                	</div>
		                                	<div class="col-md-4">
		                                		<div class="form-group">
			                                		<label>Plan de Pagos</label>
			                                		<h4 id="PlanPagoA"></h4>
		                                		</div>
		                                	</div>
		                                </div>
                                	</div>
                                </div>
				        		<div class="form-group">
				        			<label>Referencia</label>
				        			<input type="text" name="referencia" placeholder="Nro. de referencia" id="referencia_p_arriendos" maxlength="20" max="20" class="form-control border border-primary" required="required">
				        		</div>
				        		<input type="hidden" name="id_alquiler" id="id_alquier_arriendo">
				        		<button type="submit" class="btn btn-danger">Pagar</button>
			                </center>
			        	</div>

			    {!! Form::close() !!}
    		</div>
  		</div>
  	</div>
</div>