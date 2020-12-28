{!! Form::open(['route' => ['administradores.destroy',1033], 'method' => 'DELETE']) !!}
    <div class="modal fade" id="eliminarAdmin" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Eliminar Admin</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2>¡Atención!</h2>
                    <h4>¿Está realmente seguro de querer eliminar este Admin?</h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id_admin">
                    <button type="submit" class="btn btn-danger" >Eliminar</button>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}