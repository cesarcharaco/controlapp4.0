<div class="collapse multi-collapse" id="desactivarInstalacion" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
        <a data-toggle="collapse" data-target="#desactivarInstalacion" aria-expanded="false" aria-controls="desactivarInstalacion" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
          <strong>Cerrar</strong>
        </a>
      </div>
    <div class="border card-body">
      
      {!! Form::open(['route' => ['desactivar_instalacion'], 'method' => 'POST']) !!}
        @csrf
        <h3>Desactivar instalación 1</h3> 
        Se DESACTIVARÁN, NO se ELIMINARÁN los datos de la instalación. Se cambiará el status a Inactivo.
        <div class="float-right">
          <input type="hidden" name="id" class="id_instalacionE" id="id_instalacionE">
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
        <h3>Activar instalación 1</h3> 
        Se ACTIVARÁ la instalación seleccionada, Se cambiará el status a Activo.
        <div class="float-right">
          <input type="hidden" name="id" class="id_instalacionE" id="id_instalacionE">
          <button type="submit" class="btn btn-warning btn-sm">Activar</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>