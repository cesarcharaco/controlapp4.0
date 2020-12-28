<div class="collapse multi-collapse" id="EliminarPlanPago" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
	<div class="card">
		<div class="card-header">
	      <a data-toggle="collapse" data-target="#EliminarPlanPago" aria-expanded="false" aria-controls="EliminarPlanPago" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)" data-toggle="tooltip" data-placement="top" title="Cerrar cuadro de eliminar plan de pago">
	        <strong>Cerrar</strong>
	      </a>
	  	</div>
		<div class="border card-body">
			
			{!! Form::open(['route' => ['planes_pago.destroy',1033], 'method' => 'DELETE']) !!}
				@csrf
				<h3>¿Está realmente seguro de querer eliminar este Plan de Pago?</h3> 
				Se eliminarán todos los pagos y promociones realizados con este plan. Sugerimos que cambie su status.
				<div class="float-right">
					<input type="hidden" name="id" class="id_PlanP">
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>