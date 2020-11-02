<div class="collapse multi-collapse" id="EliminarPromocion" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
	<div class="card">
		<div class="card-header">
	      <a data-toggle="collapse" data-target="#EliminarPromocion" aria-expanded="false" aria-controls="EliminarPromocion" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
	        <strong>Cerrar</strong>
	      </a>
	  	</div>
		<div class="card-body">
			
			{!! Form::open(['route' => ['promociones.destroy',1033], 'method' => 'DELETE']) !!}
				@csrf
				<h3>¿Está realmente seguro de querer eliminar esta Promoción?</h3> 
				El Plan de Pagos volverá al monto original sin descuentos
				<div class="float-right">
					<input type="hidden" name="id" class="id_promocion" id="id_promocion">
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>