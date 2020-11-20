<div class="collapse multi-collapse" id="pagarArriendos" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
	<div class="card">
		<div class="card-header" style="background-color: white !important;">
		    <a data-toggle="collapse" data-target="#pagarArriendos" aria-expanded="false" aria-controls="pagarArriendos" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
		      <strong>Cerrar</strong>
		    </a>
		    <h3>Pagar arriendo</h3>
		</div>
		<div class="border card-body">		  
		  {!! Form::open(['route' => ['pagar_alquiler_resi'], 'method' => 'POST']) !!}
		    @csrf
		    <center>
		        <div class="card border border-warning rounded card-tabla shadow p-3 mb-5 bg-white rounded">
		            <div class="card-body">
		            	<div id="cargandoPagarArriendos">
					        <div class="spinner-border text-warning m-2" role="status" id="cargando_E">
					            <span class="sr-only">Pagar operación</span>
					        </div>
					        <h3>Cargando pagar operación</h3>
					    </div>

					    <div id="vistaPagarArriendos">
			                <div id="monto_pagar"></div>
			                <center>
			                   <div class="row">
			                       <div class="col-md-12">
			                           <div class="form-group">
			                               <label for="">Código de Referencia <b class="text-danger">*</b></label>
			                               <input type="text" name="referencia" class="form-control" required placeholder="Ingrese su nueva referencia">
			                           </div>
			                       </div>
			                   </div>
			                </center>
					        <div align="center">
					            <input type="text" name="id_alquiler" id="id_pagar_arriendo">
					            <button type="submit" class="btn btn-success">Pagar arriendo</button>
					        </div>
					    </div>
		            </div>
		        </div>
		    </center>
		  {!! Form::close() !!}
		</div>
	</div>
</div>