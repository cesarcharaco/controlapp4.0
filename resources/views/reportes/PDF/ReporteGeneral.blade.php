<?php
  libxml_use_internal_errors(true);
  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reporte General</title>
	<style type="text/css">

		body {
			/*background-image: url('../../public/assets/images/fondos.png');
			background-repeat: no-repeat;
			background-attachment: fixed;*/

		  	font-family: 'helvetica neue', helvetica, arial, sans-serif;
		}

		table {
			table-layout: fixed;
			width: 100%;
			border-collapse: collapse;
			border: 3px solid grey;
  			border-radius: 1em;
  			overflow: hidden;
		}

		thead th:nth-child(1) {
		  width: 30%;
		}

		thead th:nth-child(2) {
		  width: 20%;
		}

		thead th:nth-child(3) {
		  width: 15%;
		}

		thead th:nth-child(4) {
		  width: 35%;
		}

		th, td {
		  padding: 5px;
		  font-size: 10px;
		}

		/* --------------------------------------------------- */

		thead th, tfoot th {
		  font-family: 'Rock Salt', cursive;
		}

		th {
		  /*letter-spacing: 2px;*/
		}

		td {
		  letter-spacing: 1px;
		}

		tbody td {
		  text-align: center;
		}

		tfoot th {
		  text-align: right;
		}


		/* --------------------------------------------------------- */

		thead, tfoot {
		  color: white;
		  text-shadow: 1px 1px 1px black;
		}

		thead th, tfoot th, tfoot td {
		  background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.5));
		  border: 3px solid blue;
		}


		/* --------------------------------------------------------- */
		tbody tr:nth-child(odd) {
		  background-color: white;
		}

		tbody tr:nth-child(even) {
		  background-color: #D5D7D8;
		}

		table {
		  background-color: #D5D7D8;
		}
	</style>
</head>
<body>
	<div>
		<table style="width: 100% !important;" border="1">
			<tbody>
				<tr>
					<th width="30%"><center><img width="100" height="100" style="border-radius: 50px;" src="../public/assets/images/logo.jpg"></center></th>
					<th width="70%" style="font-size: 16px;">CONTROLNICE <br>REPORTE GENERAL DE GASTO COMÚN</th>
				</tr>
				<tr>
					<th colspan="2" align="center">Año: {{ $anio }}</th>
				</tr>
			</tbody>
		</table>
	</div>
	<div style="text-align: right; display: none;">
		<center><img width="300" height="300" style="border-radius: 50px;" src="../public/assets/images/logo.jpg"></center>
	</div>
	<!-- <p> Formato PDF para explicar la gestión y datos que se han almacenado hasta ahora</p> -->
	<table width="100%" border="1">
		{{-- <thead>
			<th>Asignación de inmueble</th>
			<th>Nombre residente</th>
			<th>Monto gasto común</th>
			<th>Estado de pago de gasto común</th>
			<th>Monto de Recarga</th>
			<th>Detalle de recarga</th>
			<th>Estado de pago de recarga</th>
			<th>Rut/Clave</th>
			<th>Correo</th>
			<th>Teléfono de contacto</th>
			<th>Asignación de estacionamiento</th>
		</thead> --}}
		<tbody>
			@for($i=0; $i < count($meses); $i++)
				<tr>
					<th colspan="6">Mes: {{ meses($meses[$i]) }}</th>
				</tr>
				@foreach($residentes as $key)
					<tr>
						<th>Inmueble(s)</th>
						<th>Nombre residente</th>
						<th>Rut/Clave</th>
						<th colspan="2">Correo</th>
						<th>Teléfono de contacto</th>
					</tr>
					<tr>
						<td>{{ inmuebles_asig($key->id) }}</td>
						<td>{{ $key->apellidos }}, {{ $key->nombres }}</td>
						<td>{{ $key->rut }}</td>
						<td colspan="2">{{ $key->usuario->email }}</td>
						<td>{{ $key->telefono }}</td>
					</tr>
					<tr>
						<!-- <th>Estacionamiento(s)</th> -->
						<th>Monto gasto común</th>
						<th colspan="2">Estado de pago de gasto común</th>
						<th>Monto de Recarga</th>
						<th colspan="2">Estado de pago de recarga</th>
						<!-- <th>Detalle de recarga</th> -->
					</tr>
					<tr>
						<!-- <td>{{ estacionamientos_asig($key->id) }}</td> -->
						<td>{{ gasto_comun_mes($meses[$i],$key->id,$anio) }}</td>
						<td colspan="2"> 
							{{ status_gastos_i($meses[$i],$key->id,$anio) }}
							<br>
							{{ status_gastos_e($meses[$i],$key->id,$anio) }}
						</td>
						<td>{{ montos_mr($meses[$i],$key->id,$anio) }}</td>
						<td colspan="2">{{ status_montos_mr($meses[$i],$key->id,$anio) }}</td>
						<!-- <td></td> -->
					</tr>
					

				@endforeach
				<tr>
					<td colspan="6" style="background-color: gray;"><br></td>
				</tr>
				
			@endfor
		</tbody>
	</table>

</body>
</html>