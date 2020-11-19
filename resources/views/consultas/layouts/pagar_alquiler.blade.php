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
			    {!! Form::open(['route' => ['statusinstalacion'], 'method' => 'POST']) !!}
			        @csrf
			        <center>
			        	<div id="example3_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                    		<table id="tablaArriendosR" class="table table-bordered table-hover table-striped dataTable display nowrap" style="width: 100% !important;">
			        			<thead>
			        				<tr>
			        					<th>Alquiler</th>
			        					<th>Tipo de alquiler</th>
			        					<th>Plan de Pago</th>
			        					<th>Referencia</th>
			        					<th>Status</th>
			        					<th>Opciones</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mostrarAlquileresR">
			        				
			        			</tbody>
			        		</table>
			        	</div>
			        	<div id="MensajeBsucarArriendo"></div>
			        </center>

			    {!! Form::close() !!}
    		</div>
  		</div>
  	</div>
</div>