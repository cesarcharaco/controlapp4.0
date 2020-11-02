@extends('layouts.app')


@section('content')

    <div class="container">
        <input type="hidden" id="colorView" value="#5369f8 !important">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row page-title">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="float-right mt-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Consulta</li>
                                <li class="breadcrumb-item active" aria-current="page">Pagos de Condominio</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Consulta - Pagos de Condominio</h4>
                    </div>
                </div>
                @include('flash::message')
                @if(!empty($errors->all()))
                    <div class="notification is-danger">
                        <h4 class="is-size-4">Por favor, valida los siguientes errores:</h4>
                        <ul>
                            @foreach ($errors->all() as $mensaje)
                                <li>
                                    {{$mensaje}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(\Auth::user()->tipo_usuario != 'Admin')
                    <div class="row">
                        <div class="col-md-6 col-xl-6">
                            <div class="card border border-info rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
                                <input type="hidden" name="id_residente" id="id_reside" value="{{\Auth::user()->id}}">
                                <div class="card-body p-0">
                                    <div class="media p-3">
                                        <div class="media-body">
                                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">Pago de condominio</span>
                                            <!-- <h6 class="mb-0">Pagos retrasados: </h6> -->
                                        </div>
                                     
                                        <div class="form-group">
                                            <!-- <label class="mb-0 text-primary">Pagar mes</label> -->
                                            <h6 class="mb-0"><a href="#" style="width: 100% !important;" onclick="BMesesResidente('{{$buscar->id}}')" class="btn btn-primary">Pagar</a></h6>
                                        </div>

                                    
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-md-6 col-xl-6">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="media p-3">
                                        <div class="media-body">
                                            <span class="text-muted text-muted text-uppercase font-size-12 font-weight-bold">Multas asignadas</span>
                                            <h6 class="mb-0">Total de multas: </h6>
                                        </div>
                                        
                                        <div class="form-group">
                                            <h6 class="mb-0"><a href="#" style="width: 100% !important; position: relative;" onclick="pagarMultasResidente()" class="btn btn-danger">Pagar</a></h6>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                        </div> -->
                    </div>
                @endif
            </div>
        </div>
        @include('flash::message')
        @if(\Auth::user()->tipo_usuario != 'Admin')
            <div class="card border border-success rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <label>Año</label>
                            <select class="form-control select2" onchange="consulta_anual(this.value)">
                                <option value="0" disabled selected>Seleccione año</option>
                                @for($j=0;$j< count($anio);$j++)
                                    <option value="{{ $anio[$j] }}">{{ $anio[$j] }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="card border border-primary rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
            <div class="card-body">
                @if(\Auth::user()->tipo_usuario == 'Admin')
                    <a href="{{ url('pagos') }}" class="btn btn-info text-white shadow">
                        <i data-feather="arrow-left-circle"></i>
                        Regresar a Pagos de Condominio
                    </a>
                @endif
                <table class="table dataTable data-table-basic table-curved table-striped tabla-estilo" style="width: 100%;">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Mes</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="muestraConsultas">
                        @for($i=0; $i < count($status_pago); $i++)
                            
                            <tr>
                                <td>{{ $status_pago[$i][0] }}</td>
                                @if ($status_pago[$i][1] == 'Pendiente') 
                                        <td class="text-warning"><strong>{{ $status_pago[$i][1] }}</strong></td>
                                @elseif ($status_pago[$i][1] == 'Por Confirmar') 
                                        <td class="text-warning"><strong>{{ $status_pago[$i][1] }}</strong> | CÓDIGO DE TRANS.: <b>{{ $status_pago[$i][2] }}</b>
                                            @if(\Auth::user()->tipo_usuario == 'Residente')
                                                <br>
                                                <button class="btn btn-warning btn-sm" onclick="editarReferenciaCP('{{ $status_pago[$i][3] }}','{{ $status_pago[$i][2] }}')">
                                                    <span class="PalabraPagoConfirmar">Editar Código de Trans.</span>
                                                    <center>
                                                        <span class="PalabraEditarPago2">
                                                            <i data-feather="edit" class="iconosMetaforas2"></i></span>
                                                    </center>
                                                </button>
                                            @endif
                                        </td>
                                @elseif ($status_pago[$i][1]== 'Cancelado')
                                        <td class="text-success"><strong>{{ $status_pago[$i][1] }}</strong> | CÓDIGO DE TRANS.: <b>{{ $status_pago[$i][2] }}</b>
                                            @if(\Auth::user()->tipo_usuario == 'Admin')
                                                <button class="btn btn-warning btn-sm" onclick="editarReferenciaCP('{{ $status_pago[$i][3] }}','{{ $status_pago[$i][2] }}')">
                                                    <span class="PalabraPagoConfirmar">Editar Código de Trans.</span>
                                                    <center>
                                                        <span class="PalabraEditarPago2">
                                                            <i data-feather="eye" class="iconosMetaforas2"></i></span>
                                                    </center>
                                                </button>
                                            @endif
                                        </td>
                                @else ($status_pago[$i][1]== 'No aplica')
                                        <td class="text-danger"><strong>{{ $status_pago[$i][1] }}</strong></td>
                                @endif
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>                           
    {!! Form::open(['route' => ['pagos.editar_referencia'],'method' => 'POST', 'name' => 'EditarReferencia', 'id' => 'editar_referencia', 'data-parsley-validate']) !!}
        @csrf
        <div class="modal fade" id="editarReferenciaPC" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Editar Código de Transacción 
                            <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card border border-warning rounded card-tabla shadow p-3 mb-5 bg-white rounded">
                            <div class="card-body">
                                <center>
                                   <div class="row">
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Código de Trans. Actual</label>
                                               <h3 class="text-warning"><span id="CodeRefActual"></span></h3>
                                           </div>
                                       </div>
                                   </div>
                                </center>
                                <center>
                                   <div class="row">
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Código de Trans. Nueva <b class="text-danger">*</b></label>
                                               <input type="text" name="ReferenciaNueva" class="form-control" required>
                                           </div>
                                       </div>
                                   </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id_pago" name="id_pago">
                        <button type="submit" class="btn btn-warning" >Editar Código de Trans.</button>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

@endsection


<script type="text/javascript">

</script>
<script type="text/javascript">
	function consulta_anual(anio){
        $('#muestraConsultas').empty();
        if(anio>0){
    		$.get("consulta/"+anio+"/buscar",function (data) {
            })
            .done(function(data) {
            	if (data.length >0) {
                    for (var i = 0; i < data.length; i++) {
                        var status = data[i][1];
                        if (status == 'Pendiente') {
                            var status_color = '<div class="text-warning"><b>'+status+'</b></div>';
                        }else if(status== 'Cancelado'){
                            var status_color = '<div class="text-success"><b>'+status+'</b></div>';
                        }else if(status == 'Por Confirmar'){
                            var status_color = '<div class="text-warning"><b>'+status+'</b> | CÓDIGO DE TRANS.: <b>'+data[i][2]+'</b></div>';
                        }else{
                            var status_color = '<div class="text-danger"><b>'+status+'</b></div>';
                        }
                        $('#muestraConsultas').append(
                            '<tr>'+
                                '<td>'+data[i][0]+'</td>'+
                                '<td>'+status_color+'</td>'+
                            '</tr>'
                        );
                    }
            	}else{
                    $('#muestraConsultas').append('<tr><td colspan="2" align="center"><h3>Sin datos en el año ingresado</h3></td></tr>');
            	}
     		});
        }
	}

    function editarReferenciaCP(id_pago,codigo_referencia){
        $('#editarReferenciaPC').modal('show');
        $('#CodeRefActual').html(codigo_referencia);
        $('#id_pago').val(id_pago);
    }
</script>
@section('scripts')


@endsection