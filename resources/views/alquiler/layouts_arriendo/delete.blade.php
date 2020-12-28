<div class="collapse multi-collapse" id="EliminarArriendo" style="width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
        <a data-toggle="collapse" data-target="#EliminarArriendo" aria-expanded="false" aria-controls="EliminarArriendo" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
          <strong>Cerrar</strong>
        </a>
      </div>
    <div class="border card-body">
      {!! Form::open(['route' => ['eliminar_alquiler'], 'method' => 'POST']) !!}
        @csrf
        <h3>¿Está realmente seguro de querer eliminar este Arriendo?</h3> 
        Se eliminarán todos los datos y pagos relacionados a este arriendo.
        <div class="float-right">
          <input type="hidden" name="id" class="id_ArriendoE" id="id_ArriendoE">
          <input type="hidden" name="id_instalacion" class="id_ArriendoE" id="id_instalacion">
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>