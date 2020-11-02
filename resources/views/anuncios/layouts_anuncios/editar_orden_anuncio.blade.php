{!! Form::open(['route' => ['editar_orden_anuncio'], 'method' => 'GET', 'name' => 'editarOrdenAnuncio', 'id' => 'editarOrdenAnuncio', 'data-parsley-validate']) !!}
    @csrf
    <div class="modal fade" id="editarOAnuncio" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar Orden de Pago <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="form-group">
                            <label>Referencia Actual <b class="text-danger">*</b></label>
                            <input type="text" name="referencia" id="referenciaActual" class="form-control" required disabled="disabled">
                        </div>
                        <div class="form-group">
                            <label>Nueva Referencia <b class="text-danger">*</b></label>
                            <input type="text" name="referencia_e" id="referencia_new" class="form-control" required>
                        </div>
                        <div class="row">
                            @foreach($planesPago as $key)
                                <div class="col-md-6">
                                    <div class="card shadow border card-tabla rounded" style="border-color: {{$key->color}} !important;">
                                        <div class="card-body">
                                            <div class="custom-control custom-radio mb-2">
                                              <input type="radio" id="customRadio1-{{$key->id}}" name="planP" value="{{$key->id}}" disabled>
                                            </div>
                                           <h3>{{$key->nombre}}</h3>
                                           <span>{{$key->dias}} dias</span>
                                           <br>
                                            <span style="font-size: 30px;">$</span><span style="font-size: 70px;">{{$key->monto}}</span><strong>/Mes</strong>
                                           <br>
                                           <center>
                                            <img align="center" class="imagenAnun2" src="{{ asset($key->url_img) }}">
                                           </center>
                                        </div>
                                    </div>
                                </div>
                            @endforeach()
                        </div>
                    </center>
                    <div class="float-right">
                        <input type="hidden" name="id_pagos_anucios" id="id_pagos_anucios">
                        <input type="hidden" name="id" id="id_orden_pago">
                        <input type="hidden" name="planP" id="id_planEP">
                        <button type="submit" class="btn btn-success" >Actualizar</button>
                    </div>
                </div>                            
            </div>
        </div>
    </div>
</form>