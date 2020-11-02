{!! Form::open(['route' => ['multas_recargas.update',1033],'method' => 'PUT', 'name' => 'EditarMulta', 'id' => 'editar_multa', 'data-parsley-validate']) !!}
    @csrf
    <div class="modal fade" id="editarMulta" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar <span id="mensajeEditar"></span>
                    	<br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                	<label>Motivo <b class="text-danger">*</b></label>
                                    <input id="motivo_e" type="text" name="motivo" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                	<label>Observación</label>
                                    <textarea id="observacion_e" name="observacion" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                	<label>Monto <b class="text-danger">*</b></label>
                                    <input id="monto_e" type="number" name="monto" class="form-control" placeholder="Monto" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                	<label>Tipo <b class="text-danger">*</b></label>
                                    <select name="tipo" id="tipo_edit" class="select2" required>
                                    	<option value="Multa">Multa</option>
                                    	<option value="Recarga">Recarga</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_edit" name="id">
                    <button type="submit" class="btn btn-success" >Editar</button>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}