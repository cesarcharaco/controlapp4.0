<div class="collapse multi-collapse" id="EliminarInstalacion" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
        <a data-toggle="collapse" data-target="#EliminarInstalacion" aria-expanded="false" aria-controls="EliminarInstalacion" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
          <strong>Cerrar</strong>
        </a>
      </div>
    <div class="border card-body">
      
      {!! Form::open(['route' => ['eliminarInstalacion'], 'method' => 'POST']) !!}
        @csrf
        <h3>Eliminar instalacion <span id="NombreInstalacion"></span></h3> 
        ¿Estas seguro que desea eliminar la instalación?<br>
        Se ELIMINARA, la instalación seleccionada. esta opción no se podrá deshacer en el futuro.
        <div class="float-right">
          <input type="hidden" name="id" class="id_instalacion_eliminar" id="id_instalacion_eliminar">
          <button type="submit" class="btn btn-danger btn-sm">Eliminar instalación</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>