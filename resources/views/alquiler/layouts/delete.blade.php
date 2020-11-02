<div class="vistaColumnaInstalaciones EliminarArriendo border border-warning shadow" id="EliminarInstalacion" style="display: none; border-radius: 30px !important;">
    <div class="card-body">
      
      {!! Form::open(['route' => ['desactivar_instalacion'], 'method' => 'POST']) !!}
        @csrf
        <h3>Desactivar instalacion</h3> 
        Se DESACTIVARÁN, NO se ELIMINARÁN los datos de la instalación. Se cambiará el status a Inactivo.
        <div class="float-right">
          <input type="hidden" name="id" class="id_instalacionE" id="id_instalacionE">
          <button type="submit" class="btn btn-warning btn-sm">Desactivar</button>
        </div>
      {!! Form::close() !!}
    </div>
</div>