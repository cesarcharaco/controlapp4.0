<div class="vistaColumnaInstalaciones nuevoArriendo2 border shadow" align="center" id="crearInstalacion" style="border-radius: 30px !important;">
    <div class="card-body">
      {!! Form::open(['route' => ['alquiler.store'], 'enctype' => 'multipart/form-data', 'method' => 'POST', 'name' => 'registrar_instalacion', 'id' => 'registrar_instalacion', 'data-parsley-validate']) !!}
          @csrf
        <h3 align="center" style="
          color: gray;
            font: 18px Arial, sans-serif;">
            Nueva Instalación <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small>
          </h3>
          <div class="form-group">
            <label>Nombre <b class="text-danger">*</b></label>
            <input type="text" name="nombre" class="form-control" required placeholder="Instalación 1" required>
          </div>
          <div class="form-group card shadow" style="border-radius: 30px !important;">
            <div class="card-body">
              
              <label>Horario de disponibilidad <b class="text-danger">*</b></label>
              <br>
              <i data-feather="minus"></i>
              <div class="form-group">
                  <select name="id_dia[]" id="id_dia" class="form-control select2" multiple="multiple" required>
                      @foreach($dias as $key)
                        <option value="{{$key->id}}">{{$key->dia}}</option>
                      @endforeach
                  </select>
              </div>
              <br>
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <div class="form-group" align="center">
                    <label>Desde</label>
                    <input class="form-control" id="example-time" type="time" name="hora_desde">
                  </div>
                </div>
              </div>
              <div class="row justify-content-center">
                <div class="col-md-12">
                </div>
                <div class="col-md-12">
                  <div class="form-group" align="center">
                    <label>Hasta</label>
                    <input class="form-control" id="example-time" type="time" name="hora_hasta">
                  </div>
                </div>
              </div>
            </div>
          </div>
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
          <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control select2" id="status_PlanP">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
              </select>
          </div>
        <button type="submit" class="btn btn-success">Agregar</button>
      {!! Form::close() !!}
    </div>
</div>