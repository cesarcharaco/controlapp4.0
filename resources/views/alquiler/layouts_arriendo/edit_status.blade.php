<div class="collapse multi-collapse" id="statusArriendo" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
        <a data-toggle="collapse" data-target="#statusArriendo" aria-expanded="false" aria-controls="statusArriendo" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
          <strong>Cerrar</strong>
        </a>
      </div>
    <div class="border card-body">
      
      {!! Form::open(['route' => ['statusinstalacion'], 'method' => 'POST']) !!}
        @csrf
        <h3>Desactivar arriendo <span id="NombreArriendo"></span></h3> 
        Se DESACTIVARÁN, NO se ELIMINARÁN los datos de la arriendo. Se cambiará el status a Inactivo.
        <div class="float-right">
          <input type="hidden" name="id" class="id_Arriendo_des" id="id_Arriendo_des">
          <input type="hidden" name="status" class="cambiarStatus" id="cambiarStatusA">
          <button type="submit" class="btn btn-warning btn-sm">Desactivar</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<div class="collapse multi-collapse" id="activarArriendo" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
        <a data-toggle="collapse" data-target="#activarArriendo" aria-expanded="false" aria-controls="activarArriendo" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
          <strong>Cerrar</strong>
        </a>
      </div>
    <div class="border card-body">
      
      {!! Form::open(['route' => ['statusinstalacion'], 'method' => 'POST']) !!}
        @csrf
        <h3>Activar arriendo <span id="NombreArriendo2"></span></h3> 
        Se ACTIVARÁ la arriendo seleccionada, Se cambiará el status a Activo.
        <div class="float-right">
          <input type="hidden" name="id" class="id_Arriendo_des2" id="id_Arriendo_des_A_2">
          <input type="hidden" name="status" class="cambiarStatus2" id="cambiarStatus_A_2">
          <button type="submit" class="btn btn-success btn-sm">Activar</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>