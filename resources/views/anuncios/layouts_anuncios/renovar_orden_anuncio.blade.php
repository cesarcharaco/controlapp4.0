{!! Form::open(['route' => ['renovar_orden_anuncio'], 'method' => 'GET', 'name' => 'editarOrdenAnuncio', 'id' => 'editarOrdenAnuncio', 'data-parsley-validate']) !!}
    @csrf
    <div class="modal fade" id="renovarOAnuncio" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Renovar Anuncio <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="form-group">
                            <label>Nro. Referencia <b class="text-danger">*</b></label>
                            <input type="text" name="referencia" class="form-control" required="">
                        </div>
                        <div class="row">
                            <?php $num=0; ?>
                            @foreach($planesPago as $key)
                                @foreach($promociones as $key2)
                                    @if($key->id == $key2->id_planP)
                                        @php $monto=$key->monto*$key2->porcentaje/100 @endphp
                                        @php $monto2=$key->monto-$monto2 @endphp
                                        @if($num==0)
                                            <div class="col-md-6">
                                                <div class="card shadow border card-tabla rounded" style="height: 400px; border: solid !important; border-color: #ff7043 !important;">
                                                    <div class="ribbon"><span>¡LIMITADO!</span></div>
                                                    <div class="ribbon2"><span>-{{$key2->porcentaje}}%</span></div>
                                                    <div class="card-body">
                                                        <div class="custom-control custom-radio mb-2">
                                                          <input type="radio" id="customRadio1" name="planP" value="{{$key->id}}" checked>
                                                        </div>
                                                       <h3>{{$key->nombre}}</h3>
                                                       <span>{{$key->dias}} dias</span>
                                                       <br>
                                                        <span style="font-size: 30px;">$</span><span style="font-size: 50px;"><s>{{$key->monto}}</s></span><strong>/Mes</strong><br>
                                                        <div style="margin-top: -30px !important;">
                                                            <span style="font-size: 30px; color: #ff7043 !important;">$</span><span style="font-size: 70px; color: #ff7043 !important;">{{$monto2}}</span><strong style=" color: #ff7043 !important;">/Mes</strong>
                                                        </div>
                                                       <br>
                                                       <center>
                                                        <img align="center" class="imagenAnun3" src="{{ asset($key->url_img) }}" style="">
                                                       </center>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-6">
                                                <div class="card shadow border card-tabla rounded" style="height: 400px; border: solid !important; border-color: #ff7043 !important;">
                                                    <div class="ribbon"><span>¡LIMITADO!</span></div>
                                                    <div class="ribbon2"><span>-{{$key2->porcentaje}}%</span></div>
                                                    <div class="card-body">
                                                        <div class="custom-control custom-radio mb-2">
                                                          <input type="radio" id="customRadio1" name="planP" value="{{$key->id}}">
                                                        </div>
                                                       <h3>{{$key->nombre}}</h3>
                                                       <span>{{$key->dias}} dias</span>
                                                       <br>
                                                        <span style="font-size: 30px;">$</span><span style="font-size: 50px;"><s>{{$key->monto}}</s></span><strong>/Mes</strong><br>
                                                        <div style="margin-top: -30px !important;">
                                                            <span style="font-size: 30px; color: #ff7043 !important;">$</span><span style="font-size: 70px; color: #ff7043 !important;">{{$monto2}}</span><strong style=" color: #ff7043 !important;">/Mes</strong>
                                                        </div>
                                                       <br>
                                                       <center>
                                                        <img align="center" class="imagenAnun3" src="{{ asset($key->url_img) }}" style="">
                                                       </center>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        @if($num==0)
                                            <div class="col-md-6">
                                                <div class="card shadow border card-tabla rounded" style="border-color: {{$key->color}} !important; height: 400px;">
                                                    <div class="card-body">
                                                        <div class="custom-control custom-radio mb-2">
                                                          <input type="radio" id="customRadio1" name="planP" value="{{$key->id}}" checked>
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
                                        @else
                                            <div class="col-md-6">
                                                <div class="card shadow border card-tabla rounded" style="border-color: {{$key->color}} !important; height: 400px;">
                                                    <div class="card-body">
                                                        <div class="custom-control custom-radio mb-2">
                                                          <input type="radio" id="customRadio1" name="planP" value="{{$key->id}}">
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
                                        @endif
                                    @endif
                                @endforeach()
                                <?php $num++; ?>
                            @endforeach()
                        </div>
                    </center>
                    <div class="float-right">
                        <input type="hidden" name="id_anuncio" id="id_orden_pago_r">
                        <button type="submit" class="btn btn-success" >Actualizar</button>
                    </div>
                </div>                            
            </div>
        </div>
    </div>
</form>