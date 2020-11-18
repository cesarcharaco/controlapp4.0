<div class="collapse multi-collapse" id="edit_referencias_arriendos" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
        <a data-toggle="collapse" data-target="#edit_referencias_arriendos" aria-expanded="false" aria-controls="edit_referencias_arriendos" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
          <strong>Cerrar</strong>
        </a>
        <h3>Editar referencias de arriendos</h3>
      </div>
    <div class="border card-body">
      
      {!! Form::open(['route' => ['statusinstalacion'], 'method' => 'POST']) !!}
        @csrf
        <center>
	        <div class="card border border-warning rounded card-tabla shadow p-3 mb-5 bg-white rounded">
	            <div class="card-body">
	            	<div id="cargandoRefeArriendos">
				        <div class="spinner-border text-warning m-2" role="status" id="cargando_E">
				            <span class="sr-only">Cargando referencia</span>
				        </div>
				        <h3>Cargando referencia</h3>
				    </div>

				    <div id="vistaRefeArriendosE">
		                <div id="codigoActualRefArr"></div>
		                <center>
		                   <div class="row">
		                       <div class="col-md-12">
		                           <div class="form-group">
		                               <label for="">Código de Refer. Nueva <b class="text-danger">*</b></label>
		                               <input type="text" name="ReferenciaNueva" class="form-control" required>
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