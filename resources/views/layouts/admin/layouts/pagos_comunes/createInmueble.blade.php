<form action="{{ route('pagoscomunes.store') }}" method="POST">
    @csrf
    <div class="modal fade" id="PagoCInmueble" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Costo - Inmuebles - Registrar</h4>                
                    <div class="row justify-content-md-center">
                        <div class="col-md-12">
                            <div id="spinnerI" style="display: none;">
                                <div class="spinner-border text-warning m-2" role="status" id="CargandoPCInmueble">
                                    <!-- <span class="sr-only">Cargando multas y recargas...</span> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                       <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Seleccione año</label>
                                    <select name="anioI" id="anioPagoComunI" class="form-control select2" onchange="montosInmuebleAnio(this.value,1)">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="PagoCInmuebles1"></div>
                            </div>
                        </div>
                        <div class="float-right">
                            <input type="hidden" name="tipo" value="Inmueble">
                            <input type="hidden" class="accion" name="accion" value="1">
                            <button type="submit" class="btn btn-success" >Guardar</button>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</form>