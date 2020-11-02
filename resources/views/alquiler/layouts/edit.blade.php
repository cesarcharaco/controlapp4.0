<div class="vistaColumnaInstalaciones editarArriendo border border-warning shadow" id="editarInstalacion" style="display: none; border-radius: 30px !important;">
    <div class="card-body">
      {!! Form::open(['route' => ['editar_instalacion'], 'enctype' => 'multipart/form-data', 'method' => 'POST', 'name' => 'update_instalacion', 'id' => 'update_instalacion', 'data-parsley-validate']) !!}
          @csrf
        <h3 align="center" style="
          color: gray;
            font: 18px Arial, sans-serif;">
            Editar Instalación
          </h3>
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required placeholder="Instalación 1" required id="nombreInstalacion">
          </div>
          <div class="form-group card shadow" style="border-radius: 30px !important;">
            <div class="card-body">
              
              <label>Horario de disponibilidad</label>
              <br>
              <i data-feather="minus"></i>
              <div class="form-group">
                <select name="id_dia[]" id="id_diaInstalaciones" class="form-control select2" multiple="multiple" required>
                    @foreach($dias as $key)
                        <option value="{{$key->id}}">{{$key->dia}}</option>
                    @endforeach
                </select>
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
          <div class="form-group">
            <label>Nro. máximo de personas</label>
            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
              <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                <span class="input-group-text" style="width:39px; height:39px;">
                  <i data-feather="users"></i>
                </span>
              </span>
              <input name="max_personas" min="1" minlength="1" max="50" data-toggle="touchspin" type="number" data-bts-prefix="$" class="form-control" placeholder="7" required id="npersonasInstalacion">
            </div>
          </div>
          <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control select2" id="status_PlanP" id="statusInstalacion">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
              </select>
          </div>
          
          <input type="hidden" name="id" id="idInstalacion">
        <button type="submit" class="btn btn-warning">Editar</button>
      {!! Form::close() !!}
    </div>
</div>