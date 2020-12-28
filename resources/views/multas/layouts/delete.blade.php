{!! Form::open(['route' => ['multas_recargas.destroy',1033],'method' => 'DELETE', 'name' => 'EliminarMulta', 'id' => 'eliminar_multa', 'data-parsley-validate']) !!}
    @csrf
    <div class="modal fade" id="eliminarMulta" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Eliminar Multa</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2>¡Atención!</h2>
                    <h4>¿Está realmente seguro de querer eliminar este Multa?</h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_mr" id="id_delete">
                    <button type="submit" class="btn btn-danger" >Eliminar</button>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}