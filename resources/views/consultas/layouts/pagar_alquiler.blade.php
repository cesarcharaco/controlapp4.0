<div class="modal fade" id="pagarAlquilerResidente" role="dialog">
    <div class="modal-dialog modal-lg">
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

			        	<div id="referenciaBuscarArriendo" style="display: none;">
			        		<h1 id="nombreA"></h1>
			        		<div class="form-group">
			        			<label>Referencia</label>
			        			<input type="text" name="referencia" placeholder="Nro. de referencia" id="referencia_p_arriendos" maxlength="20" max="20" class="form-control border border-primary" required="required">
			        		</div>
			        		<input type="text" name="id_alquiler" id="id_alquier_arriendo">
			        		<button type="submit" class="btn btn-danger">Pagar</button>
			        	</div>
			        </center>

			    {!! Form::close() !!}
    		</div>
  		</div>
  	</div>
</div>