
    {!! Form::open(['route' => ['editar_referencia'],'method' => 'POST', 'name' => 'EditarReferencia', 'id' => 'editar_referencia', 'data-parsley-validate']) !!}
        @csrf
        <div class="modal fade" id="editarReferencia" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Editar Código de Transacción <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card border border-warning rounded card-tabla shadow p-3 mb-5 bg-white rounded">
                            <div class="card-body">
                                <div id="codigoActualRef"></div>
                                <center>
                                   <div class="row">
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Código de Trans. Nueva <b class="text-danger">*</b></label>
                                               <input type="text" name="ReferenciaNueva" class="form-control" max="20" maxlength="20" required>
                                           </div>
                                       </div>
                                   </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id_pivot" name="id_pivot">
                        <button type="submit" class="btn btn-warning" >Editar Código de Trans.</button>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}