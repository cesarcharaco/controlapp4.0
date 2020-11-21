<div class="collapse multi-collapse" id="nuevaInstalacion" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
        <a data-toggle="collapse" data-target="#nuevaInstalacion" aria-expanded="false" aria-controls="nuevaInstalacion" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
          <strong>Cerrar</strong>
        </a>
      </div>
    <div class="border card-body">
      {!! Form::open(['route' => ['alquiler.store'], 'enctype' => 'multipart/form-data', 'method' => 'POST', 'name' => 'registrar_instalacion', 'id' => 'registrar_instalacion', 'data-parsley-validate']) !!}
        @csrf
        <h3 align="center" style="
          color: gray;
          font: 18px Arial, sans-serif;">
          Nueva Instalación <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small>
        </h3>
        <center>
          <div class="form-group">
            <label>Nombre <b class="text-danger">*</b></label>
            <input type="text" name="nombre" class="form-control" required placeholder="Instalación 1" required>
          </div>

          {{--<div class="form-group">
            <label>Tipo de Alquiler <b class="text-danger">*</b></label>
            <select class="form-control" name="tipo_alquiler" required>
              <option selected disabled>Seleccione tipo de alquiler</option>
              <option value="Permanente">Permanente</option>
              <option value="Temporal">Temporal</option>
              <option value="Permanente/Temporal">Permanente/Temporal</option>
            </select>
          </div>--}}
          <div class="form-group card shadow" style="border-radius: 30px !important; justify-content: left !important; align-content: left !important;" >
            <div class="card-body">
              <label>Horario de disponibilidad <b class="text-danger">*</b></label>
              <br>
              <i data-feather="minus"></i>
              <div class="button-list" style="width: 100% !important">
                @foreach($dias as $key)
                  <input type="checkbox" value="{{$key->id}}" name="id_dia[]">
                  <label>{{$key->dia}}</label>
                @endforeach
              </div>
              <br>
              <div class="row justify-content-center">
                <div class='col-md-6'>
                  <div class="form-group">
                    <label>Hora Desde</label>
                    <div class='input-group date' id='datetimepicker6'>
                        <input class="form-control" id="example-time" type="time" name="hora_desde">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                  </div>
              </div>
                <div class="col-md-6">
                  <div class="form-group" align="center">
                    <label>Hora Hasta</label>
                    <input class="form-control" id="example-time" type="time" name="hora_hasta">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-6">
              <div class="card border border-success shadow">
                <div class="card-body">
                  <div class="row justify-content-center">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Costo por alquiler permanente <b class="text-danger">*</b></label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                              <div class="input-group-text">$</div>
                          </div>
                          <input name="costo_permanente" type="number" class="form-control" id="inlineFormInputGroup" placeholder="1000000">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Costo por alquiler por hora <b class="text-danger">*</b></label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                              <div class="input-group-text">$</div>
                          </div>
                          <input name="costo_temporal" type="number" class="form-control" id="inlineFormInputGroup" placeholder="10">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Nro. máximo de personas <b class="text-danger">*</b></label>
                    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                      <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                        <span class="input-group-text" style="width:39px; height:39px;">
                          <i data-feather="users"></i>
                        </span>
                      </span>
                      <input name="max_personas" min="1" minlength="1" max="50" data-toggle="touchspin" type="number" data-bts-prefix="$" class="form-control" placeholder="7" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control select2" id="status_PlanP">
                      <option value="Activo">Activo</option>
                      <option value="Inactivo">Inactivo</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          <button type="submit" class="btn btn-success">Agregar</button>
        </center>
      {!! Form::close() !!}
    </div>
  </div>
</div>
