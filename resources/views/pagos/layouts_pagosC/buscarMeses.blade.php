<div class="modal fade" id="buscarMesesPago" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Buscar Pagos por mes</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                	<label>Meses</label>
                    <select type="text" name="mes" class="form-control" id="selectMesesPagosC" onchange="verMesesPagosC2(this.value)">
                        @foreach($meses2 as $key)
                        	<option value="{{$key->id}}">{{$key->mes}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="CargandoPagosC">
			        <div class="spinner-border text-warning m-2" role="status" id="cargando_E">
				            <span class="sr-only">Cargando referencia</span>
				        </div>
				        <h3>Cargando referencia</h3>
			    </div>
        		<div id="tablaMostarMeses"></div>
            </div>

            <div class="modal-footer border-bottom">
                <button type="button" data-dismiss="modal" class="btn btn-info">Cerrar</button>
            </div>
        </div>
    </div>
</div>