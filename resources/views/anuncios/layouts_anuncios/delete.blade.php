{!! Form::open(['route' => ['anuncios.destroy',1033], 'method' => 'DELETE']) !!}
    @csrf
    <div class="modal fade" id="eliminarAnuncio" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Eliminar anuncio</h4>                
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <h3>¿Está seguro de querer eliminar el anuncio? Esta opción no se podrá deshacer</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id" required id="idAnuncio">
                                </div>
                            </div>
                        </div>

                        <div class="float-right">
                            <button type="submit" class="btn btn-danger" >Eliminar</button>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}