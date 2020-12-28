<form action="{{ route('estacionamientos.store') }}" method="POST">
    @csrf
    <div class="modal fade" id="crearEstacionamiento" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nuevo Estacionamiento <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                	<label>Idem <b class="text-danger">*</b></label>
                                    <input type="text" name="idem" placeholder="Idem del estacionamiento" class="form-control" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Estado del estacionamiento <b class="text-danger">*</b></label>
                                    <select name="status" class="form-control" required placeholder="Introduzca el status del estacionamiento">
                                        <option value="Libre" selected="selected">Libre</option>
                                        <option value="Ocupado" >Ocupado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </center>
                </div> 
                <div class="modal-footer">
                    <input type="hidden" name="opcion" id="opcion" value="1">
                    <button type="submit" class="btn btn-success" style="border-radius: 50px;">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>