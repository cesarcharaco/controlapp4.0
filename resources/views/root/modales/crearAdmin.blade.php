<form action="{{ route('administradores.store') }}" method="POST" name="registrar_admin" data-parsley-validate>
    @csrf
    <div class="modal fade" id="crearAdmin" role="dialog">
        <div class="modal-dialog modals-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nuevo Admin <small>Todos los campos (<b style="color: red;">*</b>) son requeridos.</small></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="form-group">
                                    <label>Nombre del Admin <b style="color: red;">*</b></label>
                                    <input type="text" name="name" placeholder="Nombre"  class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>RUT <b style="color: red;">*</b></label>
                                    <input type="text" name="rut" id="rut" placeholder="Rut" minlength="7" maxlength="8" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div style="float: left !important;">
                                        <label><br></label>
                                        <input type="number" name="verificador" min="0" minlength="1" maxlength="2" max="9" value="0" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email <b style="color: red;">*</b></label>
                                    <input type="email" name="email" placeholder="Email del admin" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="membrecia">Membresía <b style="color: red;">*</b></label>
                                    <select name="id_membresia" id="id_membresia" required="required" class="form-control">
                                        <option value="">Seleccione una membresía...</option>
                                        @foreach($membresias as $key)
                                            <option value="{{$key->id}}">{{$key->nombre}} | Monto: {{$key->monto}} $</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ingrese contraseña <b style="color: red;">*</b></label>
                                    <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Confirmar contraseña <b style="color: red;">*</b></label>
                                    <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" class="form-control" required>
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