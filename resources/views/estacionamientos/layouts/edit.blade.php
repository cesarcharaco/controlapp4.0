{!! Form::open(['route' => ['estacionamientos.update',1], 'method' => 'PUT', 'name' => 'editar_estac', 'id' => 'editar_estac', 'data-parsley-validate']) !!}
    @csrf
    <div class="modal fade" id="editarEstacionamiento" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar Estacionamiento <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nombre del estacionamiento <b class="text-danger">*</b></label>
                                    <input type="text" id="idem" name="idem" placeholder="Idem del estacionamiento" class="form-control" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Estado del estacionamiento <b class="text-danger">*</b></label>
                                    <select name="status" id="status_e" class="form-control" required placeholder="Introduzca el status del estacionamiento">
                                        <option value="Libre" selected="selected">Libre</option>
                                        <option value="Ocupado" >Ocupado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
                    
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id_e">
                    <input type="hidden" name="opcion" id="opcion_e" value="1">
                    <button type="submit" class="btn btn-warning" style="border-radius: 50px;"><i data-feather="edit"></i></button>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}