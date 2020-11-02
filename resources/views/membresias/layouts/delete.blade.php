<div class="collapse multi-collapse" id="EliminarMembresia" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
	<div class="card">
		<div class="card-header">
	      <a data-toggle="collapse" data-target="#EliminarMembresia" aria-expanded="false" aria-controls="EliminarMembresia" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
	        <strong>Cerrar</strong>
	      </a>
	    </div>
		<div class="card-body">
			{!! Form::open(['route' => ['membresias.destroy',1033], 'method' => 'DELETE']) !!}
				@csrf
			
				<h3>¿Está realmente seguro de querer eliminar esta membresía?</h3> 
				Se eliminarán todos los pagos y datos relacionadas a esta membresía.
				<center>
					<input type="hidden" name="id_membresia" id="id_membresia">
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</center>
			{!! Form::close() !!}
		</div>
	</div>
</div>