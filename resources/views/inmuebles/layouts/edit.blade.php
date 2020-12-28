{!! Form::open(['route' => ['inmuebles.update',1], 'method' => 'PUT', 'name' => 'editar_inmueble', 'id' => 'editar_inmueble', 'data-parsley-validate']) !!}
            @csrf
            <div class="modal fade" id="editarInmueble" role="dialog">
                <div class="modal-dialog modals-default">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Editar Inmueble <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <center>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nombre del Inmueble <b class="text-danger">*</b></label>
                                            <input type="text" id="idem" name="idem" placeholder="Idem del Inmueble" class="form-control" required="required">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tipo de Inmueble <b class="text-danger">*</b></label>
                                            <select name="tipo" id="tipo" class="form-control" required placeholder="Introduzca el tipo de Inmueble">
                                                <option value="Casa" selected="selected">Casa</option>
                                                <option value="Apartamento" >Apartamento</option>
                                                <option value="Anexo" >Anexo</option>
                                                <option value="Habitación" >Habitación</option>
                                                <option value="Otro" >Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Estado del Inmueble <b class="text-danger">*</b></label>
                                            <select name="status" id="status_e" class="form-control" required placeholder="Introduzca el status del Inmueble">
                                                <option value="Disponible" selected="selected">Disponible</option>
                                                <option value="No Disponible" >No Disponible</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>¿Cuántos? </label>
                                            <input type="number" name="Cuantos[]" class="form-control" placeholder="1">
                                        </div>
                                    </div>
                                </div>
                            </center>
                        </div>
                            
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="id_e">
                            <input type="hidden" name="opcion" id="opcion_e" value="1">
                            <button type="submit" class="btn btn-warning" style="border-radius: 50px;">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}