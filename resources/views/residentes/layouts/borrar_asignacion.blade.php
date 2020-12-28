<form action="{{ route('arriendos.retirar') }}" method="POST" name="BorrarAsignacion" data-parsley-validate>
    @csrf
    <div class="modal fade" id="BorrarAsignacion" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-danger">Eliminar asignación</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>¿Está seguro de querer borrar esta asignación?</h3><br> NO podrá deshacer el cambio
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_residente" id="id_residenteBorrar">
                    <input type="hidden" name="id_estacionamiento" id="id_estacionamientoBorrar">
                    <input type="hidden" name="id_inmueble" id="id_inmuebleBorrar">
                    <button type="submit" class="btn btn-danger" >Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</form>