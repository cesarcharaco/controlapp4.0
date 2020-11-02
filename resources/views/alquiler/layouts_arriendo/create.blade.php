<div class="collapse multi-collapse" id="nuevoArriendo" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
      <a data-toggle="collapse" data-target="#nuevoArriendo" aria-expanded="false" aria-controls="nuevoArriendo" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
        <strong>Cerrar</strong>
      </a>
    </div>  
    <div class="border card-body">
      <h4>Nuevo Arriendo <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>

      {!! Form::open(['route' => ['registrar_alquiler'], 'enctype' => 'multipart/form-data', 'method' => 'POST', 'name' => 'registrar_alquiler', 'id' => 'registrar_alquiler', 'data-parsley-validate']) !!}
        @csrf
          <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist" style="background-color: #C5C5C5 !important;">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-empresa" aria-selected="true">1</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-pago" role="tab" aria-controls="pills-datos" aria-selected="false">2</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent" style="width: 100% !important">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <center>
                  <div class="form-group">
                    <label>Residente <b class="text-danger">*</b></label>
                    <select class="form-control select2" id="id_residente" onchange="buscarTodo(this.value)" name="id_residente" required>
                        <option disabled>Seleccione residente</option>
                        @foreach($residentes as $key)
                            <option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}} - {{$key->rut}}</option>
                        @endforeach()
                    </select>
                  </div>
                   <div class="form-group">
                    <label>Instalación <b class="text-danger">*</b></label>
                    <select class="form-control select2" id="instalacionList" name="id_instalacion">
                        <option disabled required>Seleccione instalación</option>
                        @foreach($instalaciones as $key)
                        @if($key->status=="Activo")
                            <option value="{{$key->id}}">{{$key->nombre}} - Dias disponible:@foreach($key->dias as $key2) {{$key2->dia}} @endforeach - {{$key->status}}</option>
                        @endif
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tipo de Alquiler <b class="text-danger">*</b></label>
                    <select class="form-control select2" id="tipo_alquiler" name="tipo_alquiler" onchange="TipoAlquiler(this.value)" required>
                      <option value="Permanente">Permanente</option>
                      <option value="Temporal">Temporal</option>
                    </select>
                  </div>
                  <div class="form-group card shadow vistaTipoAlquiler" style="border-radius: 30px !important; display: none;">
                    <div class="card-body">
                      <div class="form-group">
                        <label>Fecha</label>
                        <input type="date" max="<?php echo date('Y-m-d');?>" name="fecha" class="form-control" id="fechaAlquiler">
                      </div>
                          
                      <div class="form-group" align="center">
                        <label>Hora</label>
                        <input type="text" id="basic-timepicker" class="form-control flatpickr-input" placeholder="Basic timepicker" readonly="readonly">
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
                      <input name="num_horas" min="1" minlength="2" max="24" data-toggle="touchspin" type="number"  class="form-control" placeholder="7" required>
                    </div>
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select name="status" class="form-control select2" id="status_PlanP">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                      </select>
                    </div>                                  
                </center>
            </div>
            <div class="tab-pane fade" id="pills-pago" role="tabpanel" aria-labelledby="pills-pago-tab">
                <center>
                    <div class="form-group" id="pagoRealizado">
                        <div class="">                  
                            <label for="admins_todos">¿Se realizó el pago?</label>
                            <input type="checkbox" name="admins_todos" onchange="TodosAdmins()" id="todoAdmin"  data-toggle="tooltip" data-placement="top" title="Seleccione si el pago se realizó correctamente" value="1">
                        </div>
                        <label>Referencia <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" name="referencia" maxlength="20" required>
                    </div>
                    <div class="row">
                        <?php $num=0; ?>
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
                    </div>
                </center>
            </div>
          </div>
          <div align="center">
              <button type="submit" class="btn btn-success">Guardar</button>
          </div>
        {!! Form::close() !!}
    </div>
  </div>
</div>