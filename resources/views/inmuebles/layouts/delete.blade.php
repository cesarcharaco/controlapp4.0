{!! Form::open(['route' => ['inmuebles.destroy',1033], 'method' => 'DELETE']) !!}
    @csrf
    <div class="modal fade" id="eliminarInmueble" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Eliminar Inmueble</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                    <h3>¡ATENCIÓN!</h3>
                    <p>Está a punto de eliminar este inmueble con todos sus registros y mensualidades. Esta opción no se podrá deshacer</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id">
                    <button type="submit" class="btn btn-danger" style="border-radius: 50px;">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}