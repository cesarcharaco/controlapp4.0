<form action="{{ route('multas_recargas.store') }}" method="POST">
    @csrf
    <div class="modal fade" id="crearMulta" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nueva Multa <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                	<label>Motivo<b class="text-danger">*</b></label>
                                    <input type="text" name="motivo" placeholder="Motivo" class="form-control" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                	<label>Observación</label>
                                    <textarea name="observacion" placeholder="Observación" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                	<label>Monto<b class="text-danger">*</b></label>
                                    <input type="number" name="monto" class="form-control" placeholder="Monto" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                	<label>Tipo<b class="text-danger">*</b></label>
                                    <select name="tipo" placeholder="Tipo de Multa" class="form-control select2" required="required">
                                    	<option value="Multa">Multa</option>
                                    	<option value="Recarga">Recarga</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>