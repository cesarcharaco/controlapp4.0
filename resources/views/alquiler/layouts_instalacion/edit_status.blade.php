<div class="collapse multi-collapse" id="statusInstalacion" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
        <a data-toggle="collapse" data-target="#statusInstalacion" aria-expanded="false" aria-controls="statusInstalacion" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
          <strong>Cerrar</strong>
        </a>
      </div>
    <div class="border card-body">
      
      {!! Form::open(['route' => ['desactivar_instalacion'], 'method' => 'POST']) !!}
        @csrf
        <h3>Desactivar instalación <span id="NombreInstalacion"></span></h3> 
        Se DESACTIVARÁN, NO se ELIMINARÁN los datos de la instalación. Se cambiará el status a Inactivo.
        <div class="float-right">
          <input type="hidden" name="id" class="id_instalacion_des" id="id_instalacion_des">
          <button type="submit" class="btn btn-warning btn-sm">Desactivar</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<div class="collapse multi-collapse" id="activarInstalacion" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
        <a data-toggle="collapse" data-target="#activarInstalacion" aria-expanded="false" aria-controls="activarInstalacion" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
          <strong>Cerrar</strong>
        </a>
      </div>
    <div class="border card-body">
      
      {!! Form::open(['route' => ['desactivar_instalacion'], 'method' => 'POST']) !!}
        @csrf
        <h3>Activar instalación <span id="NombreInstalacion2"></span></h3> 
        Se ACTIVARÁ la instalación seleccionada, Se cambiará el status a Activo.
        <div class="float-right">
          <input type="hidden" name="id" class="id_instalacion_des2" id="id_instalacion_des2">
          <button type="submit" class="btn btn-success btn-sm">Activar</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>