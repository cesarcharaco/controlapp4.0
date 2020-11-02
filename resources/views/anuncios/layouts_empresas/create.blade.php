{!! Form::open(['route' => ['empresas.store'],'method' => 'POST', 'name' => 'registrarEmpresa', 'id' => 'registrar_empresa', 'data-parsley-validate']) !!}
    @csrf 
    <div class="modal fade" id="NuevaEmpresa" role="dialog" style="border-radius: 30px !important;">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nueva Empresa <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre<b class="text-danger">*</b></label>
                                    <input type="text" name="nombre" class="form-control border-info" required placeholder="Nombre de la empresa">
                                </div>
                            </div>
                        </div>

                        <label for="rut">Rut<b class="text-danger">*</b></label>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" name="rut" placeholder="Rut de la empresa" minlength="7" maxlength="8" class="form-control border-info" required>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div style="float: left !important;">
                                        <input type="number" name="verificador" min="1" minlength="1" maxlength="1" value="0" class="form-control border-info" max="9" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descripción <b class="text-danger">*</b></label>
                                    <textarea class="form-control border-info" name="descripcion" placeholder="¿Alguna descripción sobre la empresa?" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">¿La empresa se registrará como activa?</label>
                                    <select class="form-control select2 border-info" required name="status">
                                        <option value="Activo" selected>Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </center>
                    <div class="float-right">
                        <button type="submit" class="btn btn-success" >Agregar</button>
                    </div>
                </div>                            
            </div>
        </div>
    </div>
{!! Form::close() !!}