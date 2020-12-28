{!! Form::open(['route' => ['empresas.destroy',1033], 'method' => 'DELETE']) !!}
    @csrf 
    <div class="modal fade" id="eliminarEmpresa" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Eliminar Empresa</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <center>
                            <h3>¿Está seguro de querer eliminar esta empresa? Sus anuncios y pagos también serán eliminados. Esta opción no se podrá deshacer</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="id" required id="idAnuncio">
                                    </div>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="float-right">
                        <input type="hidden" name="id" id="id_empresa">
                        <button type="submit" class="btn btn-danger" >Eliminar</button>
                    </div>
                </div>                            
            </div>
        </div>
    </div>
{!! Form::close() !!} 