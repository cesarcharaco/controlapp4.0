<div class="collapse multi-collapse" id="editarArriendo2" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
        <a data-toggle="collapse" data-target="#editarArriendo2" aria-expanded="false" aria-controls="editarArriendo2" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(3)">
          <strong>Cerrar</strong>
        </a>
      </div>
    <div class="border card-body">
      <h4>Editar Arriendo <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
      {!! Form::open(['route' => ['editar_alquiler'], 'enctype' => 'multipart/form-data', 'method' => 'POST', 'name' => 'update_arriendo', 'id' => 'update_arriendo', 'data-parsley-validate']) !!}
        @csrf
        <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist" style="background-color: #C5C5C5 !important;">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-homeE" role="tab" aria-controls="pills-empresaE" aria-selected="true">1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-pagoE" role="tab" aria-controls="pills-datosE" aria-selected="false">2</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-homeE" role="tabpanel" aria-labelledby="pills-home-tab">
                <center>
                  <div class="form-group">
                    <label>Residente <b class="text-danger">*</b></label>
                    <select class="form-control select2" id="id_residenteArriendoE" onchange="buscarTodo(this.value)" name="id_residente" required>
                        <option disabled>Seleccione residente</option>
                        @foreach($residentes as $key)
                            <option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}} - {{$key->rut}}</option>
                        @endforeach()
                    </select>
                  </div>
                   <div class="form-group">
                    <label>Instalación <b class="text-danger">*</b></label>
                    <select class="form-control select2" id="instalacionListArriendoE" name="id_instalacion">
                        <option disabled required>Seleccione instalación</option>
                        @foreach($instalaciones as $key)
                        <option value="{{$key->id}}">{{$key->nombre}} - Dias disponible:@foreach($key->dias as $key2) {{$key2->dia}} @endforeach - {{$key->status}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tipo de Alquiler</label>
                    <select class="form-control select2" id="tipo_alquilerArriendoE" name="tipo_alquiler" onchange="TipoAlquiler(this.value)" required>
                      <option value="Permanente">Permanente</option>
                      <option value="Temporal">Temporal</option>
                    </select>
                  </div>
                  <div class="form-group card shadow vistaTipoAlquiler" style="border-radius: 30px !important; display: none;">
                    <div class="card-body">
                      <div class="form-group">
                        <label>Fecha</label>
                        <input type="date" name="fecha" class="form-control" id="fechaAlquilerArriendoE">
                      </div>
                          
                      <div class="form-group" align="center">
                        <label>Hora</label>
                        <input class="form-control" type="time" name="hora"  id="horaAlquilerArriendoE">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Nro. de horas <b class="text-danger">*</b></label>
                    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                      <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                        <span class="input-group-text" style="width:39px; height:39px;">
                          <i data-feather="watch"></i>
                        </span>
                      </span>
                      <input name="num_horas" min="1" minlength="2" max="24" data-toggle="touchspin" type="number"  class="form-control" placeholder="7" required id="num_horasArriendoE">
                    </div>
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select name="status" class="form-control select2" id="statusArriendoE">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                      </select>
                    </div>                                  
                </center>
            </div>
            <div class="tab-pane fade" id="pills-pagoE" role="tabpanel" aria-labelledby="pills-pago-tab">
                <center>
                    <div class="form-group" id="pagoRealizado">
                            <div>                  
                                <label for="admins_todos">¿Se realizó el pago?</label>
                                <input type="checkbox" name="admins_todos" id="pagadoArriendoE"  data-toggle="tooltip" data-placement="top" title="Seleccione si el pago se realizó correctamente" value="1">
                            </div>
                            <div>  
                                <span id="pagadoArriendoE2"></span>
                            </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Referencia <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" name="referencia" id="referenciaArriendoE" required maxlength="20">
                    </div>
                    <div class="row">
                        <?php $num=0; ?>
                            @foreach($planesPago as $key)
                                @if($num==0)
                                    <div class="col-md-6">
                                        <div class="card shadow border card-tabla rounded" style="border-color: {{$key->color}} !important; height: 400px;">
                                            <div class="card-body">
                                                <div class="custom-control custom-radio mb-2">
                                                  <input type="radio" id="planPArriendoE{{$key->id}}" name="planP" value="{{$key->id}}" checked>
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
                                                  <input type="radio" id="planPArriendoE{{$key->id}}" name="planP" value="{{$key->id}}">
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
                    </div>
                </center>

            </div>
        </div>
        <div align="center">
            <input type="hidden" name="id" id="id_editarArriendo">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>