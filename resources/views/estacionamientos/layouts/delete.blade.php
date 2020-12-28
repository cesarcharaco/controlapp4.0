{!! Form::open(['route' => ['estacionamientos.destroy',1033], 'method' => 'DELETE']) !!}
    @csrf
    <div class="modal fade" id="eliminarEstacionamiento" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Eliminar Estacionamiento</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>¡ATENCIÓN!</h3>
                    <p>Está a punto de eliminar un estacionamiento con todos sus registros y mensualidades. Esta opción no se podrá deshacer</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id">
                    <button type="submit" class="btn btn-danger" style="border-radius: 50px;"><i data-feather="trash-2"></i></button>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}