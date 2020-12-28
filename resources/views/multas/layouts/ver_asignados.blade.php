<div class="modal fade" tabindex="-1" id="verAsignadosMulta" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Asignaciones de la Multa/Recarga</h4>
                <div id="CargandoAsignadosComprobar" style="display: none;">
                        <div class="spinner-border text-warning m-2" role="status">
                        </div>
                    </div>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                    <table class="table dataTable table-curved table-striped tabla-estilo" style="width: 100%;">
                        <thead>
                            <tr class="table-info text-white">
                                <th>Nombres</th>
                                <th>RUT</th>
                                <th>Status</th>
                        </thead>
                        <tbody id="ver_multas_asignadas">
                            
                        </tbody>
                    </table>
                </center>
            </div>
        </div>
    </div>
</div>