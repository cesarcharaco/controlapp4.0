<form action="{{ route('anuncios.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="crearAnuncio" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nuevo anuncio <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>                
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist" style="background-color: #C5C5C5 !important;">
                      <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-empresa" aria-selected="true">1</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-datos" aria-selected="false">2</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-imagen" aria-selected="false">3</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pills-pago-tab" data-toggle="pill" href="#pills-pago" role="tab" aria-controls="pills-pago" aria-selected="false">4</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <center>
                            <div class="card border border-info shadow p-3 m-4">
                                <div class="card-body">
                                    <label for="SelectEmpresa">¿Cuál es la empresa que desea el anuncio? <b class="text-danger">*</b></label>
                                    <select class="form-control select2" name="id_empresa" required>
                                        @foreach($empresas as $key)
                                            <option value="{{$key->id}}">{{$key->nombre}} .- {{$key->rut_empresa}}</option>
                                        @endforeach()
                                    </select>
                                </div>
                            </div>                                    
                            <div class="form-group">
                            </div>
                            <div class="card border border-info shadow p-3 m-4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>¿Cuales administradores podrán visualizar el anuncio? <b class="text-danger">*</b></label> 
                                        <div class="">                                                                                
                                            <input type="checkbox" name="admins_todos" onchange="TodosAdmins()" id="todoAdmin"  data-toggle="tooltip" data-placement="top" title="Seleccione si desea seleccionar a todos los admins" value="1">
                                            <label for="admins_todos">Seleccionar todos</label>
                                        </div>
                                        <select required name="id_admins[]" id="SelectAdminA" class="form-control select2 border border-default" multiple="multiple">
                                            @foreach($users_admin as $key)
                                                <option value="{{$key->id}}">{{$key->name}} - RUT: {{$key->rut}}</option>
                                            @endforeach
                                            
                                        </select>

                                        <div style="display: none">
                                            <select name="id_admins[]" id="SelectAdminA2" class="form-control select2 border border-default" multiple="multiple" style="display: none;">
                                                @foreach($users_admin as $key)
                                                    <option value="{{$key->id}}">{{$key->name}} - RUT: {{$key->rut}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </center>


                      </div>
                      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <center>
                                <div class="card border border-info shadow p-3 m-4">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Título del anuncio <b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" placeholder="Ej: Nuevos modelos de autos" name="titulo" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">                                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Link <b class="text-danger">*</b></label>
                                                <input type="url" placeholder="Ej: https://www.google.co.ve/" class="form-control" name="link" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Descripción <b class="text-danger">*</b></label>
                                                <textarea placeholder="Ej: ¡Con nuevos repuestos traidos desde Suiza!..." class="form-control" name="descripcion" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>
                      </div>
                      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                          <center>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Imagen <b class="text-danger">*</b></label>
                                            <div class="alert alert-primary" role="alert">
                                                <p><strong>Recordar que:</strong><br>
                                                - La imagen no debe exceder los 800 KB de tamaño<br>
                                                - La imagen no debe tener una anchura mayor a 1024 kb<br>
                                                - La imagen no debe tener una altura mayor a 800 kb</p>
                                            </div>
                                            <label for="file-upload" class="label-form custom-file-upload btn btn-primary border" style="
                                            /*padding: 6px 12px;*/
                                            cursor: pointer;">
                                                <strong>Seleccionar imagen</strong>
                                            </label>
                                            <input name="imagen" id="file-upload" type="file" style="display: none;" onchange="input_file(this.value)" required />
                                        </div>
                                    </div>
                                </div>
                          </center>

                      </div>

                      <div class="tab-pane fade" id="pills-pago" role="tabpanel" aria-labelledby="pills-pago-tab">
                          <center>
                                <div class="form-group">
                                    <label>Referencia <b class="text-danger">*</b></label>
                                    <input type="text" class="form-control" name="referencia" max="20" maxlength="20" required>
                                </div>
                                <div class="row">
                                    <?php $num=0; ?>
                                    @if(count($promociones)>0)
                                        @foreach($planesPago as $key)
                                            @foreach($promociones as $key2)
                                                @if($key->id == $key2->id_planP) 
                                                    @php $monto=$key->monto*$key2->porcentaje/100 @endphp
                                                    @php $monto2=$key->monto-$monto @endphp
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
                                    @else
                                        @foreach($planesPago as $key)
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
                                            <?php $num++; ?>
                                        @endforeach()
                                    @endif
                                </div>
                          </center>

                      </div>
                    </div>
                    <center>
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>
                    </center>
                    <div class="float-right">
                        <button type="submit" class="btn btn-success" >Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>