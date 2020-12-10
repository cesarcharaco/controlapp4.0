<form action="{{ route('notificaciones.store') }}" method="POST" name="registrar_notificacion" data-parsley-validate>
    @csrf
    <div class="modal fade" id="crearNotficacion" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nueva Notificación</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="form-group">
                                <input type="text" name="titulo" required="required" placeholder="Título" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="motivo" required="required" placeholder="Motivo" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="checkbox" name="todos" onchange="bloquear(this)" id="todos"  data-toggle="tooltip" data-placement="top" checked="checked" title="Seleccione si desea que la notificación sea para todos" >
                                <label for="todos">Para Todos</label>
                                
                                <select name="id_residente[]" disabled="disabled" id="id_residente" multiple="multiple" class="form-control select2">
                                    <option value="#" disabled="disabled">Seleccione El/Los Residente(s)</option>
                                    @foreach($residentes as $key)
                                    <option value="{{ $key->id }}"> {{ $key->apellidos }}, {{ $key->nombres }} - RUT: {{ $key->rut }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>