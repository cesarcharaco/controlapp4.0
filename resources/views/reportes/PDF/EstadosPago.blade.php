<!DOCTYPE html>
<html>
<head>
	<title>Estados de Pago</title>
	<style type="text/css">

		body {
			/*background-image: url('../../public/assets/images/fondos.png');
			background-repeat: no-repeat;
			background-attachment: fixed;*/

		  	font-family: 'helvetica neue', helvetica, arial, sans-serif;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			/*border: 3px solid grey;*/
  			border-radius: 0.5em;
  			overflow: hidden;
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
		  font-size: 20px;
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

	<div style="text-align: right">
		<center><img width="300" height="300" style="border-radius: 50px;" src="../public/assets/images/logo.jpg"></center>
	</div>
	<table id="example1" class="" cellspacing="0" style="width: 100% !important;">
        <thead>
            <tr>
                <th>Inmueble</th>
                @if(\Auth::user()->tipo_usuario=="Admin")
                	<th>Residente</th>
                @endif
                <th>Mes</th>
                <th data-toggle="tooltip" data-placement="top" title="Monto de Gasto Común">Monto</th>
                <th>Estado de Pago</th>
                <th>Monto M/R</th>
                <th>Descripción M/R</th>
                <th>Estado de Pago M/R</th>
            </tr>
        </thead>
        <tbody>
            @foreach($residentes as $key) 
                @foreach($meses as $key2)
                <tr>
                <td>
                    <ul>
                        @foreach($key->inmuebles as $key3)
                            <li>{{ $key3->idem }}</li>
                        @endforeach
                    </ul>
                </td>
                @if(\Auth::user()->tipo_usuario=="Admin")
                    <td>{{ $key->apellidos }}, {{ $key->nombres }}</td>
                @endif
                <td>{{ $key2->mes }}</td>
                <td data-toggle="tooltip" data-placement="top" title="Monto de Gasto Común">{{ pc_total($key2->id,$anio,$key->id_admin,$key->id) }}$
                </td>
                <td>{{ status_pagos($key->id,$key2->id,$anio) }}</td>
                <td>
                    <ul>
                        @foreach($key->mr as $key4)
                            <li>{{ $key4->monto }}$</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach($key->mr as $key4)
                            <li>{{ $key4->motivo }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach($key->mr as $key4)
                       		@if($key4->pivot->status == 'Pagada')
                            	<li><span style="color: green;"><strong>{{ $key4->pivot->status }}</strong></span></li>
                            @else
                            	<li><strong>{{ $key4->pivot->status }}</strong></li>
                            @endif
                        @endforeach
                    </ul>
                </td>
                {{-- <td>Opciones</td> --}}
            </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

</body>
</html>