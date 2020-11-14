{!! Form::open(['route' => ['administradores.update',1033], 'method' => 'PUT']) !!}
    <div class="modal fade" id="editarAdmin" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar admin</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="form-group">
                                    <label>Nombre del Admin</label>
                                    <input type="text" name="name_e" id="name_e" placeholder="Nombre"  class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>RUT</label>
                                    <input type="text" name="rut_e" id="rut_e" placeholder="Rut" minlength="7" maxlength="8" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><br></label>
                                    <input type="number" id="verificador_e" min="1" name="verificador_e" minlength="1" maxlength="1" value="0" max="9" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email_e">Email</label>
                                    <input type="email" id="email_e" name="email_e" placeholder="Email del admin" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status_e">Status</label>
                                    <select name="status" id="status_e" class="form-control">
                                        <option value="activo">Activo</option>
                                        <option value="suspendido">Suspendido</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>¿Desea cambiar la membresía?</label>
                                    <input type="checkbox" name="cambiar_membresia" value="si" id="CheckCambiarMembresia" onclick="CambiarMembresia();">
                                </div>
                            </div>
                        </div>
                        <div id="verCambiarMembresia" style="display: none;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="membresia_edit">Membresia actual</label>
                                        <div id="membresia_e">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="link_tb_edit">Cambiar de membresía</label>
                                        <select name="id_membresia" id="id_membresia" class="form-control">
                                            @foreach($membresias as $key)
                                                <option value="{{$key->id}}">{{$key->nombre}} | Cant. Inmubles: {{$key->cant_inmuebles}} | Precio: {{$key->monto}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>¿Desea cambiar las plataformas de pago?</label>
                                    <input type="checkbox" name="cambiar_pagos" value="si" id="CheckCambiarPagos" onclick="CambiarPagos();">
                                </div>
                            </div>
                        </div>
                        <div id="verCambiarPagos" style="display: none;">
                            <strong>Pasarelas de pago registradas</strong>
                            <div class="card border">
                                <div class="card-body">
                                    <div id="id_pasarela_edit"></div>
                                </div>
                            </div>
                            <label>Plataformas de pago</label>
                            @foreach($pasarelas as $key)
                                <div class="card-body border">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2">
                                            <input id="check_pasarela2-{{$key->id}}" type="checkbox" name="id_pasarela[]" value="{{$key->id}}" onclick="selectPasarela(2,'{{$key->id}}')">
                                        </div>
                                        <div class="col-md-4">
                                            <span>{{$key->pasarela}}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="link_pasarela[]" class="form-control" placeholder="Ingrese Link" id="link_pasarela2-{{$key->id}}" disabled>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div> -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>¿Desea cambiar la contraseña de usuario?</label>
                                    <input type="checkbox" name="cambiar" value="si" id="CheckCambiarContraseña" onclick="CambiarContraseña();">
                                </div>
                            </div>
                        </div>
                        <div id="verCambiarContraseña" style="display: none;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ingrese contraseña</label>
                                        <input type="password" name="password" placeholder="Contraseña" id="contraseñaE" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Confirmar contraseña</label>
                                        <input type="password" name="password_confirmation" id="confirmarContraseñaE" placeholder="Confirmar contraseña" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id_admin_e">
                    <button type="submit" class="btn btn-success" >Editar</button>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
