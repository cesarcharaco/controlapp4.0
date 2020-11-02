{!! Form::open(['route' => ['residentes.update',1033], 'method' => 'PUT']) !!}
    <div class="modal fade" id="editarResidente" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar Residente <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="form-group">
                                    <label>Nombres <b class="text-danger">*</b></label>
                                    <input type="text" name="nombres" placeholder="Nombres del residente" class="form-control" id="nombres_e" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Apellidos <b class="text-danger">*</b></label>
                                    <input type="text" name="apellidos" placeholder="Apellidos del residente" class="form-control" id="apellidos_e" required>
                                </div>
                            </div>
                        </div>
                        <label>Rut <b class="text-danger">*</b></label>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" name="rut" placeholder="Rut del residente" minlength="7" maxlength="8" id="rut_e" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="number" name="verificador" min="1" id="verificador_e" minlength="1" maxlength="1" max="9" value="0" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Teléfono <b class="text-danger">*</b></label>
                                    <input type="text" name="telefono" maxlength="20" placeholder="Teléfono del residente" class="form-control" id="telefono_e" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email <b class="text-danger">*</b></label>
                                    <input type="email" name="email" placeholder="Email del residente" class="form-control" id="email_e" required>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id_e">
                    <button type="submit" class="btn btn-success" >Editar</button>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}