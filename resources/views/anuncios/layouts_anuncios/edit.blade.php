{!! Form::open(['route' => ['anuncios.update',1], 'enctype' => 'multipart/form-data', 'method' => 'PUT', 'name' => 'editar_anunc', 'id' => 'editar_anunc', 'data-parsley-validate']) !!}
    @csrf
    <div class="modal fade" id="editarAnuncio" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar anuncio <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>                
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist" style="background-color: #C5C5C5 !important;">
                      <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home2" role="tab" aria-controls="pills-empresa" aria-selected="true">1</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile2" role="tab" aria-controls="pills-datos" aria-selected="false">2</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact2" role="tab" aria-controls="pills-imagen" aria-selected="false">3</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home2" role="tabpanel" aria-labelledby="pills-home-tab">
                            <center>
                                <div class="card border border-info shadow p-3 m-4">
                                    <div class="card-body">
                                        <label for="SelectEmpresa">¿Cuál es la empresa que desea el anuncio? <b class="text-danger">*</b></label>
                                        <select class="form-control select2" name="id_empresa" required id="id_empresa_anuncio">
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
                                            <br>
                                            <input type="checkbox" name="admins_todos" onchange="TodosAdmins()" id="todoAdmin2"  data-toggle="tooltip" data-placement="top" title="Seleccione si desea seleccionar a todos los admins" value="1" checked>
                                            <label for="admins_todos">Seleccionar todos</label>

                                            <select name="id_admins[]" id="SelectAdminA3" class="form-control select2 border border-default" multiple="multiple" required>
                                                @foreach($users_admin as $key)
                                                    <option value="{{$key->id}}">{{$key->name}} - RUT: {{$key->rut}}</option>
                                                @endforeach
                                               
                                            </select>

                                            <div style="display: none;">
                                                <select name="id_admins[]" id="SelectAdminA4" class="form-control select2 border border-default" multiple="multiple" style="display: none;">
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

                      <div class="tab-pane fade" id="pills-profile2" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <center>
                                <div class="card border border-info shadow p-3 m-4">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Título del anuncio <b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" placeholder="Ej: Nuevos modelos de autos" name="titulo" required id="tituloAnunE">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">                                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Link <b class="text-danger">*</b></label>
                                                <input type="url" placeholder="Ej: https://www.google.co.ve/" class="form-control" name="link" required id="urlAnunE">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Descripción <b class="text-danger">*</b></label>
                                                <textarea placeholder="Ej: ¡Con nuevos repuestos traidos desde Suiza!..." class="form-control" name="descripcion" required id="descripAnunE"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>
                      </div>
                      <div class="tab-pane fade" id="pills-contact2" role="tabpanel" aria-labelledby="pills-contact-tab">
                          <center>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Imagen</label>
                                            <div id="mostrarImagenEditar" align="center"></div>
                                            <div class="alert alert-primary" role="alert">
                                                <p><strong>Recordar que:</strong><br>
                                                - La imagen no debe exceder los 800 KB de tamaño<br>
                                                - La imagen no debe tener una anchura mayor a 1024 kb<br>
                                                - La imagen no debe tener una altura mayor a 800 kb</p>
                                            </div>
                                            <input type="file" class="form-control" id="example-fileinput" name="imagen">
                                            <label for="file-upload2" class="label-form2 custom-file-upload btn btn-primary border" style="
                                            cursor: pointer;">
                                                <strong>Seleccionar imagen <b class="text-danger">*</b></strong>
                                            </label>
                                            <input name="imagen" id="file-upload2" type="file" style="display: none;" onchange="input_file(this.value)" required />
                                        </div>
                                    </div>
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
                        <input type="hidden" name="id_anuncio" id="idAnuncioE">
                        <button type="submit" class="btn btn-success" >Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}