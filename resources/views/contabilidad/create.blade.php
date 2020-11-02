@extends('layouts.app')

@section('content')
    <style type="text/css">
        .card {
            border: 1px solid #f6f6f7!important;
            border-color: black !important;
        }
    </style>
    <input type="hidden" id="colorView" value="#CB8C4D !important">
    <div class="container">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Balance General</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Balance General</h4>
            </div>
        </div>
        @include('flash::message')
        @if(count($errors))
            <div class="alert-list m-4">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>
                            {{$error}}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        
    </div>
    <div class="card rounded card-tabla shadow p-3 mb-5 bg-white rounded">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12">
                <div class="card" style="border: 1px solid #f6f6f7!important; border-color: black !important;">
                    <div class="card-body p-0">
                        <div class="media p-2">
                            <div class="media-body">
                                <center>
                                    <h4 class="header-title mt-0 mb-3">MOVIMIENTO DE BALANCE GENERAL</h4>
                                </center>
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="form-group" align="center">
                                            <strong>Filtro de busqueda</strong>
                                            <div class="col-md-12">
                                                <form class="form-horizontal" action="{{ route('contabilidad.create') }}" method="GET">
                                                    @csrf
                                                    <div class="row justify-content-center">
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="7dias" name="filtro" class="custom-control-input filtro" value="7dias">
                                                            <label class="custom-control-label" for="7dias">Últimos 7 días &nbsp;</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="30dias" name="filtro" class="custom-control-input filtro" value="30dias">
                                                            <label class="custom-control-label" for="30dias">Últimos 30 días &nbsp;</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="rango_fecha" name="filtro" class="custom-control-input filtro" value="rango_fecha">
                                                            <label class="custom-control-label" for="rango_fecha">Rango de fecha &nbsp;</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-2" style="display: none;">
                                                            <input type="radio" id="meses" name="filtro" class="custom-control-input filtro" value="meses">
                                                            <label class="custom-control-label" for="meses">Por meses &nbsp;</label>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" id="filtro_fechas" style="display: none;">
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-lg-4 col-form-label" for="fecha_desde">Desde</label>
                                                                <div class="col-lg-8">
                                                                    <input class="form-control" id="fecha_desde" type="date" name="fecha_desde" max="<?php $hoy=date('Y-m-d'); echo $hoy;?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-lg-4 col-form-label" for="fecha_hasta">Hasta:</label>
                                                                <div class="col-lg-8">
                                                                    <input class="form-control" id="fecha_hasta" type="date" name="fecha_hasta" max="<?php $hoy=date('Y-m-d'); echo $hoy;?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center" id="filtro_meses" style="display: none;">
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label" for="busqueda_mes">Busqueda por mes:</label>
                                                            <div class="col-lg-8">
                                                                <input class="form-control" id="busqueda_mes" type="month" name="busqueda_mes" name="busqueda_mes" max="<?php $hoy=date('Y-m'); echo $hoy;?>" min="<?php $hoy=date('2019-01'); echo $hoy;?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mt-3">
                                                        <button class="btn btn-success btn-rounded">Buscar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" align="center">
                                            <strong>Saldo Disponible a la fecha @php echo date('d/m/Y'); @endphp</strong>
                                            <button class="btn btn-success btn-rounded btn-block">
                                                <strong class="text-dark">
                                                    {!! $saldo !!} USD
                                                </strong>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" align="center">
                                            <strong>Regresar a Posición Consolidada</strong>
                                            <a href="{{ route('contabilidad.index') }}" class="btn btn-danger btn-rounded btn-block">
                                                <strong class="text-white">Regresar</strong>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3" align="center">Balance General del día (Contabilidad) 
                            <i class='uil uil-comment-exclamation' data-toggle="tooltip" data-placement="right" data-original-title="Aviso: Balance del mes en curso"></i>
                        </h4>
                        <table id="selection-datatable" class="table dt-responsive nowrap table-bordered" style="width: 100%;">
                            <thead>
                                <tr bgcolor="#3490dc" class="text-white">
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th>Ingreso</th>
                                    <th>Egreso</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contabilidad as $key)
                                <tr>
                                    <td>{{$key->created_at}}</td>
                                    <td>{{$key->descripcion}}</td>
                                    <td>{{$key->ingreso}}</td>
                                    <td>{{$key->egreso}}</td>
                                    <td>{{$key->saldo}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            {!! Form::open(['route' => 'reportes_mensual_pdf', 'method' => 'POST',  'target' => '_blank']) !!}
                @csrf
                <input type="hidden" name="pdf" value="{{$pdf}}">
                <button type="submit" class="btn btn-danger btn-rounded">
                    <strong class="text-white">Imprimir PDF</strong>
                </button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $(".filtro").click(function(evento){          
            var valor = $(this).val();          
            if(valor == 'rango_fecha'){
                $("#filtro_fechas").removeAttr("style");
                $("#filtro_meses").css("display", "none");
                $("#fecha_desde").prop('required', true);
                $("#fecha_hasta").prop('required', true);
                $("#busqueda_mes").prop('required', false);
            }else if(valor == 'meses') {
                $("#filtro_meses").css("display", "block");
                $("#filtro_fechas").css("display", "none");
                $("#fecha_desde").prop('required', false);
                $("#fecha_hasta").prop('required', false);
                $("#busqueda_mes").prop('required', true);
            } else if(valor == '7dias') {
                $("#filtro_meses").css("display", "none");
                $("#filtro_fechas").css("display", "none");
                $("#fecha_desde").prop('required', false);
                $("#fecha_hasta").prop('required', false);
                $("#busqueda_mes").prop('required', false);
            } else if(valor == '30dias') {
                $("#filtro_meses").css("display", "none");
                $("#filtro_fechas").css("display", "none");
                $("#fecha_desde").prop('required', false);
                $("#fecha_hasta").prop('required', false);
                $("#busqueda_mes").prop('required', false);
            }
        });
    });
</script>
<!-- Datatables init -->
<script src="{{ asset('assets/js/data-table/datatables.init.js') }}"></script>
<!-- Plugin js-->
<script src="{{ asset('assets/libs/parsleyjs/parsley.min.js') }}"></script>
<!-- Validation init js-->
<script src="{{ asset('assets/js/form-validation.init.js') }}"></script>
@endsection