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
                                    <h4 class="header-title mt-0 mb-3">POSICIÓN CONSOLIDADO</h4>
                                </center>
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="form-group" align="center">
                                            <strong>Saldo Disponible</strong>
                                            <button class="btn btn-success btn-rounded btn-block">
                                                <strong class="text-dark">
                                                    {!! $saldo !!} USD
                                                </strong>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" align="center">
                                            <strong>Registrar Egreso</strong>
                                            <button data-toggle="modal" data-target="#registrar_egreso" class="btn btn-warning btn-rounded btn-block">
                                                <strong class="text-white">Agregar</strong>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" align="center">
                                            <strong>Consultar Movimientos</strong>
                                            <a href="{{ route('contabilidad.create') }}" class="btn btn-rounded btn-block" style="background: #3490dc;">
                                                <strong class="text-white">Consultar</strong>
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
                        <h4 class="header-title mt-0 mb-3" align="center">Balance General (Contabilidad) 
                            <i class='uil uil-comment-exclamation' data-toggle="tooltip" data-placement="right" data-original-title="Aviso: Balance del mes en curso"></i>
                        </h4>
                        <table id="#" class="table dataTable dt-responsive nowrap table-bordered" style="width: 100%;">
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
                                    <th>{{$key->created_at}}</th>
                                    <th>{{$key->descripcion}}</th>
                                    <th>{{$key->ingreso}}</th>
                                    <th>{{$key->egreso}}</th>
                                    <th>{{$key->saldo}}</th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
<!-- --------------------------------------------MODAL DE EGRESO------------------------------------------------------ -->
<div class="modal fade" id="registrar_egreso" role="dialog" data-controls-modal="registrar_egreso" data-backdrop="static" data-keyboard="false">
    <form action="{{ route('contabilidad.store') }}" method="POST" name="registrarEgreso" id="registrarEgreso" class="parsley-examples">
        @csrf
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>
                        <i class='uil-usd-circle' data-toggle="tooltip" data-placement="right" data-original-title="Aviso: Acá podrá registar un egreso"></i>
                        Registrar Egreso <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" id="cerrar">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="egreso">Monto de egreso: <b style="color: red;">*</b></label>
                            <input type="number" name="egreso" class="form-control" placeholder="Monto de Egreso" required="required" data-parsley-type="number" min="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="descripcion">Descripción: <b style="color: red;">*</b></label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Ingrese Descripción" required="required" title="Ingrese la descripción del egreso" data-parsley-type="text" data-parsley-maxlength="20">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" id="cerrar1" class="close">Cerrar</button>
                    <button type="submit" class="btn btn-success btn-rounded">Registrar Egreso</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $("#cerrar").on("click", function(event){
        console.log('vaciar form');
        event.preventDefault();
        $('#registrarEgreso').trigger("reset");
    })
    $("#cerrar1").on("click", function(event){
        console.log('vaciar form 1');
        event.preventDefault();
        $('#registrarEgreso').trigger("reset");
    });
</script>

<!-- Datatables init -->
<script src="{{ asset('assets/js/data-table/datatables.init.js') }}"></script>
<!-- Plugin js-->
<script src="{{ asset('assets/libs/parsleyjs/parsley.min.js') }}"></script>
<!-- Validation init js-->
<script src="{{ asset('assets/js/form-validation.init.js') }}"></script>
@endsection