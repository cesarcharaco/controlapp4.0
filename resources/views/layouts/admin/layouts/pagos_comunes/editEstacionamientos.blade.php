{!! Form::open(['route' => ['pagoscomunes.update',1], 'method' => 'PUT', 'name' => 'editar_pagosComunesEstacionamiento', 'id' => 'editar_pagosComunesEstacionamiento', 'data-parsley-validate']) !!}
    @csrf
    <div class="modal fade" id="PagoCEstacionamiento2" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Costo - Estacionamientos - Editar</h4>                
                    <div class="row justify-content-md-center">
                        <div class="col-md-12">
                            <div id="spinnerE2" style="display: none;">
                                <div class="spinner-border text-warning m-2" role="status" id="CargandoPCEstaciona">
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
                                    <select name="anioE" id="anioPagoComunE2" class="form-control select2" onchange="montosEstacionaAnio(this.value,2)" >
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div id="PagoCEstaciona2"></div>
                            </div>
                        </div>
                        
                        <div class="float-right">
                            <input type="hidden" name="tipo" value="Estacionamiento">
                            <input type="hidden" class="accion" name="accion" value="1">
                            <button type="submit" class="btn btn-success" >Editar</button>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}