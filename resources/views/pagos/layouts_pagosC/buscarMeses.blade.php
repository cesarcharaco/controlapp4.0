<div class="modal fade" id="buscarMesesPago" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Buscar Pagos por mes</h4>
                <div class="CargandoMesesPago">
			        <div class="spinner-border text-info m-2" role="status">
	                    <span class="sr-only">Cargando...</span>
	                </div>
                </div>
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
        		<div id="tablaMostarMeses"></div>
            </div>

            <div class="modal-footer border-bottom">
                <button type="button" data-dismiss="modal" class="btn btn-info">Cerrar</button>
            </div>
        </div>
    </div>
</div>