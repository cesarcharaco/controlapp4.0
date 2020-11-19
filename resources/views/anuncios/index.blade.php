@extends('layouts.app')

@section('content')

<style type="text/css">
    .card-header, .card-footer{        
        /*-webkit-linear-gradient(to left, #d87602, #d64322);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;*/

        /*background-image:
        linear-gradient(to right, white, gray);*/
        padding: 20px;
        background: rgba(0, 0, 0, 0.6);
        color: gray;
        font: 18px Arial, sans-serif;
    }
</style>

<div class="container">
    <input type="hidden" id="colorView" value="#25c2e3 !important">

    <input type="hidden" id="anunAnioActualMonto" value="{{$anunAnioActualMonto}}">
    <input type="hidden" id="anunAnioAnteriorMonto" value="{{$anunAnioAnteriorMonto}}">
    <input type="hidden" id="anunAnioAntePasadoMonto" value="{{$anunAnioAntePasadoMonto}}">
    


    <div class="row page-title" id="tituloP">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Publicidad</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Publicidad</h4>
        </div>
    </div>
    <div class="row page-title" style="display: none;" id="tituloP1">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Anuncios</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Anuncios</h4>
        </div>
    </div>
    <div class="row page-title" style="display: none;" id="tituloP2">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Empresas</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Empresas</h4>
        </div>
    </div>
    <div class="row page-title" style="display: none;" id="tituloP3">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('anuncios') }}">Publicidad</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Control de Pagos</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Control de Pagos</h4>
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
    <div id="tablaAnucios">
        <div class="card border border-info rounded card-tabla shadow p-3 mb-5 bg-white rounded tabla-estilo">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 offset-md-12">
                            <a class="btn btn-success boton-tabla shadow" data-toggle="modal" data-target="#crearAnuncio" onclick="AnuncioCreate()" style="
                                border-radius: 10px;
                                color: white;
                                height: 35px;
                                margin-bottom: 5px;
                                margin-top: 5px;
                                float: right;">
                                <span><i data-feather="plus"></i>Nuevo Anuncio</span>
                            </a>
                        </div>
                    </div>
                </div>
                

                <div class="col-md-8">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                        <table class="table table-bordered table-hover table-striped dataTable" style="width: 100% !important;">
                            <thead>
                                <tr class="bg-info text-white">
                                    <th>#</th>
                                    <th>Título</th>
                                    <th>URL</th>
                                    <th>Descripción</th>
                                    <th>Imagen</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $num=0 @endphp
                                @foreach($anuncios as $key)
                                    <tr>
                                        <td>{{$num=$num+1}}</td>
                                        <td>{{$key->titulo}}</td>
                                        <td>{{$key->link}}</td>
                                        <td>{{$key->descripcion}}</td>
                                        <td>
                                            <img class="imagenAnun" src="{{ asset($key->url_img) }}" class="avatar" style="width:100%;max-width:640px;">
                                        </td>
                                        <td>
                                            <a href="#" class="border border-light btn btn-info btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="VerAdminAsignado('{{$key->id}}')">
                                                <span><strong><i data-feather="eye"></i>Ver Asignados</strong></span>
                                            </a>
                                            @php $count=0 @endphp
                                            @foreach($EmpresasAnuncios as $key2)
                                                @if($count == 0)
                                                    <a href="#" class="btn btn-warning btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="EditarAnuncio('{{$key->id}}','{{$key->id_empresa}}','{{$key->titulo}}','{{$key->descripcion}}','{{$key->url_img}}','{{$key->link}}','{{$key2->referencia}}','{{$key2->id_planP}}')">
                                                        <span><i data-feather="edit"></i>Editar</span>
                                                    </a>
                                                    @php $count++ @endphp
                                                @endif
                                            @endforeach()

                                            <a href="#" class="btn btn-danger btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="EliminarAnuncio('{{$key->id}}')">
                                                <span><i data-feather="trash"></i>Eliminar</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach()
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @php $num=0 @endphp
                            @foreach($anuncios as $key)
                                @if($num == 0)
                                    <div class="carousel-item active">
                                        <center>
                                            <h3 alt="{{$num=$num+1}} slide"><strong class="text-dark">{{$key->titulo}}</strong></h3>
                                            <br>
                                            <img class="imagenAnun" src="{{ asset($key->url_img) }}" class="avtar" style="width:100%;max-width:640px;">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">
                                                    
                                                </div>
                                            </div>
                                        </center>
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <center>
                                            <h3 alt="{{$num=$num+1}} slide"><strong class="text-dark">{{$key->titulo}}</strong></h3>
                                            <br>
                                            <img class="imagenAnun" src="{{ asset($key->url_img) }}" class="avatar" style="width:100%;max-width:640px;">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">
                                                    
                                                </div>
                                            </div>
                                        </center>
                                    </div>
                                @endif

                                @php $num++ @endphp
                            @endforeach()

                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        </div>
                </div>
            </div>
        </div>
    </div>


    <div id="tablaEmpresas">
        <div class="card border border-warning rounded card-tabla shadow p-3 mb-5 bg-white rounded tabla-estilo">
            

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 offset-md-12">
                                    <a class="btn btn-success boton-tabla shadow" data-toggle="modal" data-target="#NuevaEmpresa" style="
                                        border-radius: 10px;
                                        color: white;
                                        height: 35px;
                                        margin-bottom: 5px;
                                        margin-top: 5px;
                                        float: right;">
                                        <span>Nueva Empresa</span>
                                        <center>
                                            <span>
                                                <i data-feather="plus"></i>
                                            </span>
                                        </center>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                        <table class="table table-bordered table-hover table-striped dataTable" style="width: 100% !important;">
                            <thead>
                                <tr class="bg-info text-white">
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>RUT</th>
                                    <th>Descripción</th>
                                    <th>Status</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $num=0 @endphp
                                @foreach($empresas as $key)
                                    <tr class="vista1-{{$key->id}}" onclick="opcionesTabla(1,'{{$key->id}}')">
                                        <td align="center">
                                            {{$num=$num+1}}
                                        </td>
                                        <td>{{$key->nombre}}</td>
                                        <td>{{$key->rut_empresa}}</td>
                                        <td>{{$key->descripcion}}</td>
                                        @if($key->status == 'Activo')
                                            <td style="position: all;">
                                                    <span class="tituloTabla text-success"><strong>Activo</strong></span>
                                                    <span class="tituloTabla2 text-success"><strong>A</strong></span>
                                            </td>
                                        @else
                                            <td style="position: all;">
                                                    <span class="tituloTabla text-danger"><strong>Inactivo</strong></span>
                                                    <span class="tituloTabla2 text-danger"><strong>I</strong></span>
                                            </td>
                                        @endif
                                        <td>

                                           <a href="#" class="btn btn-warning btn-sm" onclick="editarEmpresa('{{$key->id}}','{{$key->nombre}}','{{$key->rut_empresa}}','{{$key->descripcion}}','{{$key->status}}')">
                                                <span><i data-feather="edit"></i>Editar</span>
                                            </a>
                                        <a href="#" class="btn btn-danger btn-sm" onclick="eliminarEmpresa('{{$key->id}}')">
                                                <span><i data-feather="trash"></i>Eliminar</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach()
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="tablaControl" style="display: none;">
        <div class="card border border-danger card-tabla shadow p-3 mb-5 bg-white">
            <div class="card-body">
                <div class="mb-3" align="right">
                    <button class="btn btn-warning" id="vistaEstadisticas1" onclick="vistaEstadisticas(1)" style="border-radius: 30px;">
                        Ver Estadísticas
                    </button>
                    <button class="btn btn-success" id="vistaEstadisticas2" onclick="vistaEstadisticas(2)" style="border-radius: 30px; display: none;">
                        Ver Anuncios
                    </button>
                </div>
                <div class="controlEstadisticas" style="display: none;">
                    <div class="mb-3" align="right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card shadow card-tabla border border-success">
                                            <div class="card-body">
                                                <table class="tablaControl table table-striped tabla-estilo">
                                                    <thead>
                                                        <tr align="center">
                                                            <th colspan="2">Estado de anuncios</th>
                                                        </tr>
                                                        <tr align="center">
                                                            <th align="center">Activos</th>
                                                            <th align="center">Inactivos</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr align="center">
                                                            <td>
                                                                {{$anunActivos}}
                                                            </td>
                                                            <td>
                                                                {{$anunInactivos}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card shadow card-tabla border border-success">
                                            <div class="card-body">
                                                <table class="tablaControl table table-striped tabla-estilo">
                                                    <thead>
                                                        <tr align="center">
                                                            <th colspan="3">Nro. de Anuncios por año</th>
                                                        </tr>
                                                        <tr align="center">
                                                            <th align="center">{{ date('Y') }}</th>
                                                            <th align="center">{{ date('Y')-1 }}</th>
                                                            <th align="center">{{ date('Y')-2 }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr align="center">
                                                            <td>
                                                                @php $total=0 @endphp
                                                                {{$anunAnioActual}}
                                                                @php $total=$anunAnioActual-$anunAnioAnterior @endphp
                                                                @if($total>=0)
                                                                    <span class="text-success">(+{{$total}})</span>
                                                                @else
                                                                    <span class="text-danger">(-{{$total}})</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @php $total=0 @endphp
                                                                {{$anunAnioAnterior}}
                                                                @php $total=$anunAnioAnterior-$anunAnioAntePasado @endphp
                                                                @if($total>=0)
                                                                    <span class="text-success">(+{{$total}})</span>
                                                                @else
                                                                    <span class="text-danger">(-{{$total}})</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{$anunAnioAntePasado}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card shadow card-tabla border border-success">
                                            <div class="card-body">
                                                <canvas id="myChart"></canvas>
                                                <table class="tablaControl table table-striped tabla-estilo">
                                                    <thead>
                                                        <tr align="center">
                                                            <th colspan="3">Total de ingresos</th>
                                                        </tr>
                                                        <tr align="center">
                                                            <th align="center">{{ date('Y') }}</th>
                                                            <th align="center">{{ date('Y')-1 }}</th>
                                                            <th align="center">{{ date('Y')-2 }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr align="center">
                                                            <td>

                                                                @php $total=0 @endphp
                                                                {{$anunAnioActualMonto}}$
                                                                @php $total=$anunAnioActualMonto-$anunAnioAnteriorMonto @endphp
                                                                @if($total>=0)
                                                                    <span class="text-success">(+{{$total}}$)</span>
                                                                @else
                                                                    <span class="text-danger">(-{{$total}}$)</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @php $total=0 @endphp
                                                                {{$anunAnioAnteriorMonto}}$
                                                                @php $total=$anunAnioAnteriorMonto-$anunAnioAntePasadoMonto @endphp
                                                                @if($total>=0)
                                                                    <span class="text-success">(+{{$total}}$)</span>
                                                                @else
                                                                    <span class="text-danger">(-{{$total}}$)</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{$anunAnioAntePasadoMonto}}$
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="controlAnuncios">
                    <div class="row justify-content-center">
                        @if(!is_null($anuncios))
                            <center>
                                <h1>¡No hay anuncios que gestionar!</h1>
                            </center>
                        @endif
                        <div class="col-md-6">
                            <div class="overflow-auto" style="height: 350px !important;">
                                @foreach($anuncios as $key)
                                    @foreach($EmpresasAnuncios2 as $key2)
                                        @if($key->id == $key2->id_anuncios)
                                            <a href="#" onclick="verInfoControl('{{$key->id}}',1,'{{$key2->status}}')">
                                            @if($key2->status == 'Activo')
                                                <div class="mb-3 card border border border-success" id="tablaCC{{$key->id}}">
                                            @else
                                                <div class="mb-3 card border border border-danger" id="tablaCC{{$key->id}}">
                                            @endif
                                                <?php 
                                                    $fecha1 =   Date('Y-m-d');
                                                    $fecha2 =   Date($key2->fecha_termino);
                                                    $fecha3 =   Date($key2->fecha_orden);

                                                    $dias = (strtotime($fecha2)-strtotime($fecha3))/86400;
                                                    $dias = abs($dias);
                                                    $dias = floor($dias);

                                                    $dias2 = (strtotime($fecha2)-strtotime($fecha1))/86400;
                                                    $dias2 = abs($dias2);
                                                    $dias2 = floor($dias2);

                                                    if($fecha1 > $fecha2){
                                                        $dias   = 0;
                                                        $dias2  = 0;
                                                        $total  = 0;
                                                    }else{
                                                        $dias = abs($dias);
                                                        $dias = floor($dias);

                                                        if ($dias2 != 0) {
                                                            $total = ($dias2*100)/$dias;
                                                        }else{
                                                            $total = 0;
                                                        }
                                                    }
                                                ?>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        
                                                        @if($key2->status == 'Activo')
                                                            <small style="border-radius: 30px;" class=" btn btn-success btn-sm disabled">{{$key2->status}}</small>
                                                        @else
                                                            <small style="border-radius: 30px;" class=" btn btn-danger btn-sm disabled">{{$key2->status}}</small>
                                                        @endif
                                                        <span class="mb-2 p-2" style="font-size: 40px;color: gray; font: 18px Arial, sans-serif;" align="left">
                                                            {{$key->titulo}}
                                                            @foreach($empresas as $key2)
                                                                @if($key->id_empresa == $key2->id)
                                                                    <small> - {{$key2->nombre}}</small>
                                                                @endif
                                                            @endforeach()
                                                        </span>
                                                        @if((strtotime($fecha1)-strtotime($fecha3))/86400 == 0 )
                                                             <small style="color: grey; float: right;border-radius: 30px;">Hoy</small>
                                                        @else
                                                            <small style="color: grey; float: right;border-radius: 30px;">Hace {{(strtotime($fecha1)-strtotime($fecha3))/86400}} Dias</small>
                                                        @endif
                                                        <div class="float-right">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            @if($key2->status == 'Activo')
                                                                <div class="progress mb-2" style="width: 100%;">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="{{$total}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$total}}%"></div>
                                                                </div>
                                                            @else
                                                                <div class="progress mb-2" style="width: 100%;">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="{{$total}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$total}}%"></div>
                                                                </div>
                                                            @endif
                                                            <center><span class="mb-2" style="color: grey; font: 20px Arial, sans-serif;">{{$dias2}}</span> <small style="color: grey"> Dias Restantes</small></center>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="float-right">
                                                                <img src="{{ asset($key->url_img) }}" class="shadow" style="width: 50px; height: 50px; border-radius: 35px !important;">
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        @endif
                                    @endforeach()
                                @endforeach()
                            </div> 
                        </div>
                        <div class="col-md-6">
                            @foreach($anuncios as $key)
                                @foreach($EmpresasAnuncios2 as $key2)
                                    @if($key->id == $key2->id_anuncios)
                                            <div class="verDatosPagoA{{$key2->id}} VerDatosTodos" style="display: none">                                    
                                                <div class="card border shadow" style="
                                                background-image: url('{{ asset($key->url_img) }}');
                                                background-position: center;
                                                background-repeat: no-repeat;
                                                background-size: cover;
                                                display: none;">
                                                    <div class="card-header">
                                                        <button type="button" class="btn btn-success rounded" onclick="verInfoControl('{{$key->id}}',2,'{{$key2->status}}')" style="border-radius: 30px !important; float: left !important;">
                                                            <span>Regresar</span>
                                                            <center>
                                                                <span>
                                                                    <i data-feather="arrow-left"></i>
                                                                </span>
                                                            </center>
                                                        </button>
                                                        <div class="button-list float-right">

                                                            <button type="button" class="btn btn-info rounded" onclick="RenovarPagoPublicidad('{{$key2->id_anuncios}}')" style="border-radius: 30px !important;">
                                                                <span>Renovar</span>
                                                                <center>
                                                                    <span>
                                                                        <i data-feather="dollar-sign"></i>
                                                                    </span>
                                                                </center>
                                                            </button>
                                                           <!--  <button type="button" class="btn btn-warning rounded" onclick="editarPagoPublcidad('{{$key2->id}}','{{$key2->planP->id}}',0)" style="border-radius: 30px !important;">
                                                                <span>Editar</span>
                                                                <center>
                                                                    <span>
                                                                        <i data-feather="edit"></i>
                                                                    </span>
                                                                </center>
                                                            </button> -->
                                                           
                                                            <!-- <button type="button" class="btn btn-danger rounded" onclick="diaNegocio(3)" style="border-radius: 30px !important;">
                                                                <span>Eliminar</span>
                                                                <center>
                                                                    <span>
                                                                        <i data-feather="trash"></i>
                                                                    </span>
                                                                </center>
                                                            </button> -->
                                                        </div>
                                                        <br>
                                                        <br>

                                                    </div>
                                                    <div onclick="verInfoControl('{{$key->id}}',2,'{{$key2->status}}')">
                                                        <div class="card-body bg-white">
                                                            <?php 
                                                                $fecha1 =   Date('Y-m-d');
                                                                $fecha2 =   Date($key2->fecha_termino);
                                                                $fecha3 =   Date($key2->fecha_orden);

                                                                $dias = (strtotime($fecha2)-strtotime($fecha3))/86400;
                                                                $dias = abs($dias);
                                                                $dias = floor($dias);

                                                                $dias2 = (strtotime($fecha2)-strtotime($fecha1))/86400;
                                                                $dias2 = abs($dias2);
                                                                $dias2 = floor($dias2);

                                                                if($fecha1 > $fecha2){
                                                                    $dias   = 0;
                                                                    $dias2  = 0;
                                                                    $total  = 0;
                                                                }else{
                                                                    $dias = abs($dias);
                                                                    $dias = floor($dias);

                                                                    if ($dias2 != 0) {
                                                                        $total = ($dias2*100)/$dias;
                                                                    }else{
                                                                        $total = 0;
                                                                    }
                                                                }
                                                            ?>
                                                            <h3 style="">
                                                                Fecha de orden: 
                                                            </h3>
                                                                <small>{{$key2->fecha_orden}}</small>
                                                            <h3 style="">
                                                                Término de la orden: 
                                                            </h3>
                                                                <small>{{$key2->fecha_termino}}</small>
                                                            <h3 style="">
                                                                Dias restantes: 
                                                            </h3>
                                                                <small>{{$dias}}</small>


                                                        </div>
                                                    </div>
                                                    <div class="bg-white">
                                                        <div class="card-body">
                                                            
                                                            <h3>
                                                                Referencias
                                                            </h3>
                                                            <table width="100%">
                                                                @foreach($pagosAnuncios as $key3)
                                                                    @if($key3->id_planesA == $key2->id)
                                                                        <tr>
                                                                            <td>
                                                                                <button type="button" class="btn btn-warning rounded btn-sm" onclick="editarPagoPublcidad('{{$key2->id}}','{{$key2->planP->id}}','{{$key3->referencia}}','{{$key3->id}}')" style="border-radius: 30px !important;">
                                                                                    <span>Editar</span>
                                                                                    <center>
                                                                                        <span>
                                                                                            <i data-feather="edit"></i>
                                                                                        </span>
                                                                                    </center>
                                                                                </button>
                                                                            </td>
                                                                            <td>{{$key3->referencia}}</td>
                                                                            <td align="right"><strong>{{$key3->monto}} $</strong></td>
                                                                            <td align="right">{{$key3->planes_anuncio->fecha_orden}}</td>
                                                                        </tr>
                                                                    @endif()
                                                                @endforeach()
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endif
                                @endforeach()
                            @endforeach()
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-4 center" id="VerTabla1">
            <a href="#" onclick="VerTabla(1)" id="verTabla2-1" style="display: none; width: 100%;">
                <div class="card border border-dark shadow rounded m-7" style="height: 400px;
                background-image: url('{{ asset('assets/images/anuncios/anuncios.jpg') }}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                ">
                    <div class="card-header">
                        <h3 align="right" class="text-warning" >ANUNCIOS</h3>
                    </div>
                    <div class="card-body p-3 mb-5 ">
                    </div>
                    <div class="card-footer">
                        <strong class="text-warning">Visualizar los Anuncios de la App.</strong>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 center" id="VerTabla2">
            <a href="#" onclick="VerTabla(2)" id="verTabla2-2" style="display: none; width: 100%;">
                <div class="card border border-dark shadow rounded m-7" style="height: 400px;
                background-image: url('{{ asset('assets/images/anuncios/empresa.jpg') }}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                ">
                    <div class="card-header">
                        <h3 align="right" class="text-warning" >EMPRESAS</h3>
                    </div>
                    <div class="card-body p-3 mb-5 ">
                    </div>
                    <div class="card-footer">
                        <strong class="text-warning">Visionar las Empresas Registradas</strong>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 center" id="VerTabla3">
            <a href="#" onclick="VerTabla(3)" id="verTabla2-3" style="display: none; width: 100%;">
                <div class="card border border-dark shadow rounded m-7" style="height: 400px;
                background-image: url('{{ asset('assets/images/anuncios/control.jpg') }}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                ">
                    <div class="card-header">
                        <h3 align="right" class="text-warning" >CONTROL</h3>
                    </div>
                    <div class="card-body p-3 mb-5 ">
                    </div>
                    <div class="card-footer">
                        <strong class="text-warning">Gestionar el Control de Pagos, Duración y Anuncios a Visualizar en la App.</strong>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<!--Anuncios-->

    @include('anuncios.layouts_anuncios.create')
    @include('anuncios.layouts_anuncios.show')
    @include('anuncios.layouts_anuncios.edit')
    @include('anuncios.layouts_anuncios.delete')
    @include('anuncios.layouts_anuncios.editar_orden_anuncio')
    @include('anuncios.layouts_anuncios.renovar_orden_anuncio')

<!--Empresas-->
    
    @include('anuncios.layouts_empresas.create')
    @include('anuncios.layouts_empresas.edit')
    @include('anuncios.layouts_empresas.delete')


@endsection

<script type="text/javascript">
    
    
    


    function select(accion, id, idem, tipo, status) {

        if (accion==1) {
            $('#VerAnuncio').modal('show');
            $('#ver_idem').val(idem);
            $('#ver_tipo').val(tipo);
            $('#ver_status').val(status);
        }
        if(accion==2){
            editar(id, idem, tipo, status);
            $('#editarAnuncio').modal('show');
        }
        if (accion==3) {
            $('#id').val(id);
            $('#eliminarAnuncio').modal('show');
        } else {

        }
    }

    // function eliminar(id) {
    //     $('#id').val(id);
    // }

    function mensual(accion, id) {

        $('#selectO').val(0);
        if (accion==1) {
            $('#SelectAnio1').val(0);
            $('#createMensualidad').modal('show');
            $('#buttonCreate').empty();
            $('#createMensuality1').empty();
            $('#createMensuality2').empty();
            $('#idCreateM').val(id);
            // $('#anioCreateM').val(anio);
        }
        if(accion==2){
            $('#SelectAnio2').val(0);
            $('#editMensuality1').empty();
            $('#editMensuality2').empty();
            $('#buttonEdit').empty();
            $('#editarMensualidad').modal('show');
            $('#idEditM').val(id);
            // $('#anioEditM').val(anio);
        }
        if (accion==3) {
            $('#deleteMensualidad').modal('show');
            $('#idDeleteM').val(id);
            // $('#anioDeleteM').val(anio);
        } 
        if (accion==4){
            $('#buttonShow').empty();
            $('#fechasM').empty();
            $('#MesesM').empty();
            $('#idShowM').val(id);
            $('#VerMensualidades').modal('show');

            $.get('Anuncios/'+id+'/buscar_anios', function(data) {
        
                beforeSend: $('#MesesM').append('Cargando...');
                complete: $('#MesesM').empty();
                    
                if (data.length > 0) {

                    $('#fechasM').append(
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label>Especifique el año para ver la mensualidad</label>'+
                                        '<select class="form-control" onchange="accionM(4,this.value);" id="verFechaMensual">'+
                                            '<option value="0">Seleccionar año</option>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );

                    for (var i = 0; i < data.length; i++) {
                        $('#verFechaMensual').append('<option value="'+data[i].anio+'">'+data[i].anio+'</option>');
                    }
                    
                }else
                    $('#fechasM').append('El Anuncio no posee mensualidades');

            });
        }else {

        }
    }


    function mostrarC(opcion) {
        if (opcion==1) {
            $('#createMensuality1').show();
            $('#createMensuality2').hide();
            $('#montoAnioC').attr('disabled',true);
            $('#accionCreate').val(1);
        } else {
            $('#createMensuality1').hide();
            $('#createMensuality2').show();
            $('#montoAnioC').attr('disabled',false);
            $('#accionCreate').val(2);
        }
    }

    function mostrarE(opcion) {
        if (opcion==1) {
            $('#montoAnio_e').attr('disabled',true);
            $('#editMensuality1').show();
            $('#editMensuality2').hide();
            $('#accionEdit').val(1);
        } else {
            $('#montoAnio_e').attr('disabled',false);
            $('#editMensuality1').hide();
            $('#editMensuality2').show();
            $('#accionEdit').val(2);
        }
    }

    function accionM(accion, anio) {

        var mes = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre',''];
        var f = new Date();
        var m = f.getMonth()+1;
        var a = f.getFullYear();

        if (accion == 1) {
            var id = $('#idCreateM').val();
            $('#anioCreateM').val(anio);

            $.get('Anuncios/'+id+'/'+anio+'/buscar_mensualidad', function(data) {
        

                $('#montoAnio').empty();
                $('#buttonCreate').empty();
                $('#createMensuality1').empty();
                $('#createMensuality2').empty();

                beforeSend: $('#createMensuality1').append('Cargando...');
                complete: $('#createMensuality1').empty();

                if (data.length > 0) {

                    
                    $('#createMensuality1').append('Ya existen registros para este año');
                    $('#buttonC').attr('disabled',true);

                }else{

                    $('#buttonCreate').append(
                        "<div class='card-box'>"+
                            "<div class='row'>"+
                                "<div class='col-md-6' width='100%'>"+
                                    "<a href='#' class='btn btn-block btn-success' onclick='mostrarC(1)'>Montos por mes</a>"+
                                "</div>"+
                                "<div class='col-md-6' width='100%'>"+
                                    "<a href='#' class='btn btn-block btn-warning' onclick='mostrarC(2)'>Monto por año</a>"+
                                "</div>"+
                            "</div>"+
                        "</div"
                    );
                    $('#createMensuality1').append('<label>Montos por mes</label><br>');

                    if(a == anio){
                        for (var i = 0; i < 13; i++) {
                        
                            if(i>=m){
                                $('#createMensuality1').append(
                                    '<div class="row">'+
                                        '<div class="col-md-4">'+
                                            '<div class="form-group">'+
                                                '<input type="hidden" name="mes[]" class="form-control-plaintext">'+
                                                '<label>'+mes[i]+'</label>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-6">'+
                                            '<div class="form-group">'+
                                                '<div class="input-group mb-2">'+
                                                    '<div class="input-group-prepend">'+
                                                        '<div class="input-group-text">$</div>'+
                                                    '</div>'+
                                                    '<input type="number" name="monto[]" class="form-control" placeholder="10">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'
                                );
                            }
                        }

                    }

                    else{
                        for (var i = 1; i < 13; i++) {
                            $('#createMensuality1').append(
                                '<div class="row">'+
                                    '<div class="col-md-4">'+
                                        '<div class="form-group">'+
                                            '<input type="hidden" name="mes[]" class="form-control-plaintext">'+
                                            '<label>'+mes[i]+'</label>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-6">'+
                                        '<div class="form-group">'+
                                            '<div class="input-group mb-2">'+
                                                '<div class="input-group-prepend">'+
                                                    '<div class="input-group-text">$</div>'+
                                                '</div>'+
                                                '<input type="number" name="monto[]" class="form-control" placeholder="10">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                            );
                        } 
                    }
                    $('#createMensuality2').append(
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label>Monto por todo el año</label>'+
                                    '<div class="input-group mb-2">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text">$</div>'+
                                        '</div>'+
                                        '<input type="text" id="montoAnioC" name="montoaAnio" class="form-control" id="montoAnio_e" placeholder="10">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                    $('#createMensuality2').css('display','none');

                    $('#buttonC').attr('disabled',false);
                }
            });

        }
        if (accion == 2) {

            var id = $('#idEditM').val();
            $('#anioEditM').val(anio);

            $.get('Anuncios/'+id+'/'+anio+'/buscar_mensualidad', function(data) {
        
                var m = f.getMonth()-1;
                $('#montoAnio').empty();
                $('#buttonEdit').empty();
                $('#editMensuality1').empty();
                $('#editMensuality2').empty();

                beforeSend: $('#editMensuality1').append('Cargando...');
                complete: $('#editMensuality1').empty();

                if (data.length == 0) {

                    $('#editMensuality1').append('No existen registros de este año para editar');
                    $('#buttonEdit').attr('disabled',true);

                }else{
                    var montoT=data.length-1;
                    $('#buttonEdit').append(
                        "<div class='card-box'>"+
                            "<div class='row'>"+
                                "<div class='col-md-6' width='100%'>"+
                                    "<a href='#' class='btn btn-block btn-success' onclick='mostrarE(1)'>Montos por mes</a>"+
                                "</div>"+
                                "<div class='col-md-6' width='100%'>"+
                                    "<a href='#' class='btn btn-block btn-warning' onclick='mostrarE(2)'>Monto por año</a>"+
                                "</div>"+
                            "</div>"+
                        "</div"
                    );
                    $('#editMensuality1').append('<label>Montos por mes</label><br>');

                    
                    for (var i = 0; i < data.length; i++) {
                            
                            console.log(i);
                            $('#editMensuality1').append(
                                '<div class="row">'+
                                    '<div class="col-md-4">'+
                                        '<div class="form-group">'+
                                            '<input type="hidden" value="'+data[i].mes+'" name="mes[]" class="form-control-plaintext">'+
                                            '<label>'+mes[data[i].mes]+'</label>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-6">'+
                                        '<div class="form-group">'+
                                            '<div class="input-group mb-2">'+
                                                '<div class="input-group-prepend">'+
                                                    '<div class="input-group-text">$</div>'+
                                                '</div>'+
                                                '<input type="number" value="'+data[i].monto+'" name="monto[]" class="form-control" placeholder="10">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                            );

                    }
                    $('#editMensuality2').append(
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label>Monto por todo el año</label>'+
                                    '<div class="input-group mb-2">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text">$</div>'+
                                        '</div>'+
                                        '<input type="text" name="montoaAnio" value="'+data[montoT].monto+'" class="form-control" id="montoAnio_e" placeholder="10" disabled="disabled">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                    $('#editMensuality2').css('display','none');

                    $('#buttonE').attr('disabled',false);
                }
            });
        }
        if (accion == 3) {

            $('#deleteMensuality').empty();
            var id = $('#idDeleteM').val();
            $('#anioDeleteM').val(anio);

            $.get('Anuncios/'+id+'/'+anio+'/buscar_mensualidad', function(data) {
        
                for (var i = 0; i < 13; i++) {
                    $('#montoMese_e'+i).empty();
                }
                $('#montoAnio_e').empty();

                beforeSend: $('#deleteMensuality').append('Cargando...');
                    
                if (data.length > 0) {

                    $('#deleteMensuality').empty();
                    $('#deleteMensuality').append('<h3>Existen registros para este año</h3><br><p>¿Eliminar mensualidad de este año? No habrá vuelta atrás</p>');
                    $('#buttonD').attr('disabled', false);

                }else{
                    $('#deleteMensuality').empty();
                    $('#deleteMensuality').append('No hay registros de este año');
                    $('#buttonD').attr('disabled', true);
                }


            });
        } 
        if (accion == 4){

            var id = $('#idShowM').val();
            $('#MesesM').empty();
            $.get('Anuncios/'+id+'/'+anio+'/buscar_mensualidad', function(data) {
        
                $('#buttonShow').empty();

                beforeSend: $('#MesesM').append('Cargando...');
                complete: $('#MesesM').empty();

                if (data.length > 0) {

                    var montoT=data.length-1;
                    // $('#buttonShow').append(
                    //     "<div class='card-box'>"+
                    //         "<div class='row'>"+
                    //             "<div class='col-md-6' width='100%'>"+
                    //                 "<a href='#' class='btn btn-success' onclick='mostrarS(1)'>Montos por mes</a>"+
                    //             "</div>"+
                    //             "<div class='col-md-6' width='100%'>"+
                    //                 "<a href='#' class='btn btn-warning' onclick='mostrarS(2)'>Monto por año</a>"+
                    //             "</div>"+
                    //         "</div>"+
                    //     "</div"
                    // );
                    $('#MesesM').append('<label>Montos por mes</label><br>');

                    
                    for (var i = 0; i < data.length; i++) {
                            
                        $('#MesesM').append(
                            '<div class="row">'+
                                '<div class="col-md-4">'+
                                    '<div class="form-group">'+
                                        '<button type="button" style="width=100% !important" class="btn btn-block btn-outline-info">'+mes[data[i].mes]+'</button>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-8">'+
                                    '<button class="btn btn-block btn-success" style="width=100% !important">$ <strong>'+data[i].monto+'</strong></button>'+
                                '</div>'+
                            '</div>'
                        );

                    }
                    $('#MesesM').append('<label>Montos por Año</label><br>');

                    $('#MesesM').append(
                        '<div class="row justify-content-center">'+
                            '<div class="col-md-4">'+
                                    '<button type="button" class="btn btn-block btn-outline-warning">'+anio+'</button>'+
                            '</div>'+
                            '<div class="col-md-8">'+
                                    '<button class="btn btn-block btn-warning" style="width=100% !important">$ <strong>'+data[montoT].monto+'</strong></button>'+
                                '</div>'+
                        '</div>'
                    );
                    $('#editMensuality2').css('display','none');

                    $('#buttonE').attr('disabled',false);
                }
            });
        }
    }

    function editar(id, idem, tipo,status) {

        $('#id_e').val(id);
        $('#idem').val(idem);
        $('#tipo').val(tipo);
        $('#status_e').val(status);
    }

    function opcion(opcion) {
        var f = new Date();
        var anio=f.getFullYear();
        // var mes=['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $('#opcion').val(opcion);
        $('#opcion_e').val(opcion);

        if (opcion==2) {
            for (var i = 0; i < 13; i++) {
                $('#montoMeses'+i).prop('disabled',true).val(null).prop('required',false);
            }
            $('#montoAnio').prop('disabled',false).prop('required',true);
        }else {
            for (var i = 0; i < 13; i++) {
                $('#montoMeses'+i).prop('disabled',false).val(null).prop('required',true);
            }
            $('#montoAnio').prop('disabled',true).val(null).prop('required',false);
        }

    }

    function VerTabla(opcion) {
        $('#tituloP').hide();
        $('#tituloP1').hide();
        $('#tituloP2').hide();
        $('#tituloP3').hide();
               
        $('#VerTabla1').hide();
        $('#VerTabla2').hide();
        $('#VerTabla3').hide();

        if (opcion == 1) {
            $("#tablaEmpresas").fadeOut("slow",
                function() {
                    $(this).hide();
                    $("#tablaControl").fadeOut("slow");
                    $("#tablaAnucios")
                        .css('opacity', 0)
                        .slideDown('slow')
                        .animate(
                            { opacity: 1 },
                            { queue: false, duration: 'slow' }
                        );
                    $('#tituloP1').fadeIn(300);
                    $('#VerTabla2').show();
                    $('#VerTabla2').removeClass("col-md-4").addClass("col-md-6");
                    $('#VerTabla3').show();
                    $('#VerTabla3').removeClass("col-md-4").addClass("col-md-6");
                });


        }else if(opcion == 2){
            $("#tablaAnucios").fadeOut("slow",
                function() {
                    $(this).hide();
                    $("#tablaControl").fadeOut("slow");
                    $("#tablaEmpresas")
                        .css('opacity', 0)
                        .slideDown('slow')
                        .animate(
                            { opacity: 1 },
                            { queue: false, duration: 'slow' }
                        );
                    $('#tituloP2').fadeIn(300);
                });

            $('#VerTabla1').show();
            $('#VerTabla1').removeClass("col-md-4").addClass("col-md-6");
            $('#VerTabla3').show();
            $('#VerTabla3').removeClass("col-md-4").addClass("col-md-6");
        }else{
            $("#tablaAnucios").fadeOut("slow",
                function() {
                    $(this).hide();
                    $("#tablaEmpresas").fadeOut("slow");
                    $("#tablaControl")
                        .css('opacity', 0)
                        .slideDown('slow')
                        .animate(
                            { opacity: 1 },
                            { queue: false, duration: 'slow' }
                        );
                    $('#tituloP3').fadeIn(300);
                });
            $('#tituloP3').show();
            $('#VerTabla1').show();
            $('#VerTabla1').removeClass("col-md-4").addClass("col-md-6");
            $('#VerTabla2').show();
            $('#VerTabla2').removeClass("col-md-4").addClass("col-md-6");
        }
    }

    function editarEmpresa(id, nombre, rut, descripcion, status) {
        $('#idEmpresa_e').val(id);
        $('#nombreEmpresa_e').val(nombre);

        $('#rutEmpresa_e').val(rut.substr(0,(rut.length-2)));
        $('#verificadorEmpresa_e').val(rut.substr(-1,(rut.length)));

        $('#descripcionEmpresa_e').val(descripcion);
        $('#statusEmpresa_e').val(status);

        $('#editarEmpresa').modal('show');
    }

    function eliminarEmpresa(id) {
        $('#id_empresa').val(id);
        $('#eliminarEmpresa').modal('show');
    }
    function editarPagoPublcidad(id_PlanesA,id_planP,referencia,id_pagos_anucios) {
        $('#editarOAnuncio').modal('show');
        $('#customRadio1-'+id_planP).prop('checked', true);
        $('#referenciaActual').val(referencia);
        $('#id_orden_pago').val(id_PlanesA);
        $('#id_planEP').val(id_planP);
        $('#id_pagos_anucios').val(id_pagos_anucios);

        $.get("publicidad/"+id+"/editar_pago",function (data) {
        })
        .done(function(data) {
            if (data.length>0) {
                for (var i = 0; i < data.length; i++) {
                    $("#campoMultaRecarga").append('<option value="'+date[i].referencia+'">'+date[i].referencia+'</option>');
                }
            }
        }); 
    }
    function RenovarPagoPublicidad(id_anuncio){
        $('#renovarOAnuncio').modal('show');
        $('#id_orden_pago_r').val(id_anuncio);
    }

    function verInfoControl(id,opcion,status) {

        // $('.VerDatosTodos').fadeOut('slow');
        if (opcion == 1) {
            $('.VerDatosTodos').fadeOut('slow',
                function() {
                    $(this).hide();
                    $('.verDatosPagoA'+id).fadeIn(300);
                });
            $('#tablaCC'+id).removeClass("border-success").removeClass("border-danger").addClass("border-info");
        }else{
            $('.VerDatosTodos').fadeOut('slow');
            if (status == 'Activo') {
                $('#tablaCC'+id).removeClass("border-info").addClass("border-success");
            }else{
                $('#tablaCC'+id).removeClass("border-info").addClass("border-danger");
            }
        }
    }
    function vistaEstadisticas(opcion) {
        if (opcion==1) {
            $('#vistaEstadisticas1').fadeOut('slow',
                function() {
                    $(this).hide();
                    $('#vistaEstadisticas2').fadeIn(300);
                }
            );

            $('.controlAnuncios').fadeOut('slow',
                function() {
                    $(this).hide();
                    $('.controlEstadisticas').fadeIn(300);
                }
            );
        }else{
            $('.VerDatosTodos').fadeOut('slow');
            $('#vistaEstadisticas2').fadeOut('slow',
                function() {
                    $(this).hide();
                    $('#vistaEstadisticas1').fadeIn(300);
                }
            );

            $('.controlEstadisticas').fadeOut('slow',
                function() {
                    $(this).hide();
                    $('.controlAnuncios').fadeIn(300);
                }
            );
        }
    }
    
</script>

