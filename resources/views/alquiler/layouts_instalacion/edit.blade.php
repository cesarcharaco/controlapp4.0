<div class="collapse multi-collapse" id="editarInstalacion" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
        <a data-toggle="collapse" data-target="#editarInstalacion" aria-expanded="false" aria-controls="editarInstalacion" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(3)">
          <strong>Cerrar</strong>
        </a>
      </div>
    <div class="border card-body">
      {!! Form::open(['route' => ['editar_instalacion'], 'enctype' => 'multipart/form-data', 'method' => 'POST', 'name' => 'update_instalacion', 'id' => 'update_instalacion', 'data-parsley-validate']) !!}
        @csrf
        <h3 align="center" style="
          color: gray;
          font: 18px Arial, sans-serif;">
          Editar Instalación <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small>
        </h3>
        <center>
          <div class="form-group">
            <label>Nombre <b class="text-danger">*</b></label>
            <input type="text" name="nombre" class="form-control" required placeholder="Instalación 1" id="nombreInstalacion">
          </div>
          <div class="form-group card shadow" style="border-radius: 30px !important;">
            <div class="card-body">
              
              <label>Horario de disponibilidad <b class="text-danger">*</b></label>
              <br>
              <i data-feather="minus"></i>
              <div class="card-body">
                <div id="dias_insta"></div>
              </div>
              <br>
              <div class="form-group">
                <div class="button-list" style="width: 100% !important">
                @foreach($dias as $key)
                  <input type="checkbox" id="id_diaInstalaciones" value="{{$key->id}}" name="id_dia[]">
                  <label>{{$key->dia}}</label>
                @endforeach
              </div>
              </div>
              <br>
              <div class="row justify-content-center">
                <div class="col-md-6">
                  <div class="form-group" align="center">
                    <label>Desde</label>
                    <input class="form-control" type="time" name="hora_desde" id="desdeInstalacion">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group" align="center">
                    <label>Hasta</label>
                    <input class="form-control" type="time" name="hora_hasta" id="hastaInstalacion">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-4">
              <div class="form-group">
                <label>Costo por alquiler permanente <b class="text-danger">*</b></label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                      <div class="input-group-text">$</div>
                  </div>
                  <input name="costo_permanente" type="number" class="form-control" placeholder="1000000" id="costoPinstala">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Costo por alquiler por hora <b class="text-danger">*</b></label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                      <div class="input-group-text">$</div>
                  </div>
                  <input name="costo_temporal" type="number" class="form-control" placeholder="10" id="costoTinstala">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Nro. máximo de personas <b class="text-danger">*</b></label>
                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                  <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                    <span class="input-group-text" style="width:39px; height:39px;">
                      <i data-feather="users"></i>
                    </span>
                  </span>
                  <input name="max_personas" min="1" minlength="1" max="50" data-toggle="touchspin" type="number" data-bts-prefix="$" class="form-control" placeholder="7" required id="npersonasInstalacion">
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="id" id="idInstalacion">
          <button type="submit" class="btn btn-warning">Editar</button>
        </center>
      {!! Form::close() !!}
    </div>
  </div>
</div>