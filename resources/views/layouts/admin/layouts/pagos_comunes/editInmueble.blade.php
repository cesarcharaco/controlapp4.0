{!! Form::open(['route' => ['pagoscomunes.update',1], 'method' => 'PUT', 'name' => 'editar_pagosComunesInmueble', 'id' => 'editar_pagosComunesInmueble', 'data-parsley-validate']) !!}
    @csrf
    <div class="modal fade" id="PagoCInmuebleE" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Costo - Inmuebles - Editar</h4>                
                    <div class="row justify-content-md-center">
                        <div class="col-md-12">
                            <div id="spinnerI2" style="display: none;">
                                <div class="spinner-border text-warning m-2" role="status" id="CargandoPCInmueble2">
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
                                    <select name="anioI" id="anioPagoComunI_E" class="form-control select2" onchange="montosInmuebleAnio(this.value,2)">
                                    </select>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-md-12">
                                <div id="PagoCInmuebles2"></div>
                            </div>
                        </div>
                        
                        <div class="float-right">
                            <input type="hidden" name="tipo" value="Inmueble">
                            <input type="hidden" class="accion" name="accion" value="1">
                            <button type="submit" class="btn btn-success" >Editar</button>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}