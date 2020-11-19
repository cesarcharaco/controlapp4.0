@extends('layouts.app')

@section('content')



    <style type="text/css">
      .seccionControl,#seccionControl1,#seccionControl2,#seccionControl3,#seccionControl4,#seccionControl5,#seccionControl6{
        display: none;
      }
    </style>






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
    <input type="hidden" id="colorView" value="#CB8C4D !important">
    <div class="row page-title" id="tituloP">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Alquiler</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Alquiler</h4>
        </div>
    </div>
    <div class="row page-title" style="display: none;" id="tituloP1">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Instalaciones</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Instalaciones</h4>
        </div>
    </div>
    <div class="row page-title" style="display: none;" id="tituloP2">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Arrendamientos</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Arrendamientos</h4>
        </div>
    </div>
    <div class="row page-title" style="display: none;" id="tituloP3">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('anuncios') }}">Control</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Control y Agenda</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Control y Agenda</h4>
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

    <div id="tablaInstalaciones">
        <div class="card border border-info rounded card-tabla shadow p-3 mb-5 bg-white rounded">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div style="height: 100%;">
                        @include('alquiler.layouts_instalacion.show')
                        @include('alquiler.layouts_instalacion.create')
                        @include('alquiler.layouts_instalacion.edit')
                        @include('alquiler.layouts_instalacion.edit_status')
                        @include('alquiler.layouts_instalacion.delete')
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 offset-md-12">
                            <a data-toggle="collapse" href="#nuevaInstalacion" id="btnRegistrar_insta" role="button" aria-expanded="false" aria-controls="nuevaInstalacion"  class="btn btn-success boton-tabla shadow" onclick="crearInstalacion()" style="
                                border-radius: 10px;
                                color: white;
                                height: 35px;
                                margin-bottom: 5px;
                                margin-top: 5px;
                                float: right;">
                                <span data-toggle="tooltip" data-placement="top" title="Seleccione para registrar una instalación"><i data-feather="plus"></i>Nueva Instalación</span>
                            </a>
                        </div>
                    </div>
                </div>
                

                <div class="col-md-12">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                        <table class="table table-bordered table-hover table-striped dataTable" style="width: 100% !important;">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th width="10"></th>
                                    <th>Nombre</th>
                                    <th>Horario Disponible</th>
                                    <th>Max. personas</th>
                                    <th>Status</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($instalaciones as $key)
                                    <tr>
                                        <td></td>
                                        <td align="center">{{$key->nombre}}</td>
                                        <td>
                                            @foreach($key->dias as $key2)
                                                <span>
                                                    <strong>{{ $key2->dia }}</strong><br>
                                                </span>
                                                @if($key2->dia == 'Lunes')
                                                @elseif($key2->dia == 'Martes')
                                                @elseif($key2->dia == 'Miércoles')
                                                @elseif($key2->dia == 'Jueves')
                                                @elseif($key2->dia == 'Viernes')
                                                @elseif($key2->dia == 'Sábado')
                                                @else
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$key->max_personas}}</td>
                                        <td>
                                            @if($key->status == 'Activo')
                                                    <strong class="text-success">{{$key->status}}</strong>
                                            @else
                                                    <strong class="text-danger">{{$key->status}}</strong>
                                            @endif
                                        </td>
                                        <td align="center">
                                            <br>

                                            <a data-toggle="collapse" href="#VerInstalacion" role="button" aria-expanded="false" aria-controls="VerInstalacion" class="btn btn-success btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="VerInstalacion('{{$key->id}}','{{$key->nombre}}','{{$key->id_dia}}','{{$key->hora_desde}}','{{$key->hora_hasta}}','{{$key->max_personas}}','{{$key->status}}')">

                                                <span><strong>Ver</strong></span>
                                            </a>


                                            <a data-toggle="collapse" href="#editarInstalacion" role="button" aria-expanded="false" aria-controls="editarInstalacion" class="btn btn-warning btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="editarInstalacion('{{$key->id}}','{{$key->nombre}}','{{$key->id_dia}}','{{$key->hora_desde}}','{{$key->hora_hasta}}','{{$key->max_personas}}','{{$key->status}}')">

                                                <span><strong>Editar</strong></span>
                                            </a>
                                            @if($key->status == 'Activo')
                                                <a data-toggle="collapse" href="#statusInstalacion" role="button" aria-expanded="false" aria-controls="statusInstalacion"  class="btn btn-info btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="statusInstalacion('{{$key->id}}','{{$key->nombre}}','{{$key->status}}')">
                                                    <span data-toggle="tooltip" data-placement="top" title="Seleccione para desactivar instalación">Desactivar</span>
                                                </a>
                                            @else
                                                <a data-toggle="collapse" href="#activarInstalacion" role="button" aria-expanded="false" aria-controls="activarInstalacion"  class="btn btn-success btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="statusInstalacion('{{$key->id}}','{{$key->nombre}}','{{$key->status}}')">
                                                    <span data-toggle="tooltip" data-placement="top" title="Seleccione para activar instalación">Activar</span>
                                                </a>
                                            @endif
                                            <a data-toggle="collapse" href="#EliminarInstalacion" role="button" aria-expanded="false" aria-controls="EliminarInstalacion"  class="btn btn-danger btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="eliminarInstalacion('{{$key->id}}')">
                                                <span data-toggle="tooltip" data-placement="top" title="Seleccione para eliminar instalación">Eliminar</span>
                                            </a>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="tablaArriendos">
        <div class="card border border-info rounded card-tabla shadow p-3 mb-5 bg-white rounded">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div style="height: 100%;">
                        @include('alquiler.layouts_arriendo.show')
                        @include('alquiler.layouts_arriendo.create')
                        @include('alquiler.layouts_arriendo.edit')
                        @include('alquiler.layouts_arriendo.edit_status')
                        @include('alquiler.layouts_arriendo.edit_referencias')
                        @include('alquiler.layouts_arriendo.delete')
                    </div>
                </div>
            </div>
            <div class="row justify-content-center" >
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 offset-md-12">
                            <a data-toggle="collapse" href="#nuevoArriendo" id="btnRegistrar_arriendo" role="button" aria-expanded="false" aria-controls="nuevoArriendo" class="btn btn-success boton-tabla shadow" onclick="nuevoArriendo()" style="
                                border-radius: 10px;
                                color: white;
                                height: 35px;
                                margin-bottom: 5px;
                                margin-top: 5px;
                                float: right;">
                                <span><i data-feather="plus"></i>Nuevo Arrendamiento</span>
                                        
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                        <table id="example1" class="table table-bordered table-hover table-striped dataTable" style="width: 100% !important;">
                            <thead>
                                <tr class="bg-info text-white">
                                    <th>#</th>
                                    <th>Residente</th>
                                    <th>Instalación</th>
                                    <th>Tipo de alquiler</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $num=0; @endphp
                                @foreach($alquiler as $key)
                                    <tr>
                                        <td>{{$num=$num+1}}</td>
                                        <td>{{$key->residente->nombres}}</td>
                                        <td>{{$key->instalacion->nombre}}</td>
                                        <td>{{$key->tipo_alquiler}}</td>
                                        <td>
                                            @if($key->fecha)
                                                {{$key->fecha}}
                                            @else
                                                <strong class="text-warning">Temporal</strong>
                                            @endif
                                        </td>
                                        <td>
                                            @if($key->hora)
                                                {{$key->hora}}
                                            @else
                                                <strong class="text-warning">Temporal</strong>
                                            @endif
                                        </td>
                                        <td align="center">
                                            @foreach($key->pagos_has_alquiler as $key2)
                                                
                                            <a data-toggle="collapse" href="#verArriendo2" role="button" aria-expanded="false" aria-controls="verArriendo2" class="btn btn-success btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="VerArriendo(
                                                    '{{$key->residente->nombres}}',
                                                    '{{$key->residente->apellidos}}',
                                                    '{{$key->residente->rut}}',
                                                    '{{$key->instalacion->nombre}}',
                                                    '{{$key->tipo_alquiler}}',
                                                    '{{$key->fecha}}',
                                                    '{{$key->hora}}',
                                                    '{{$key->num_horas}}',
                                                    '{{$key->status}}',
                                                    '{{$key2->status}}',
                                                    '{{$key2->referencia}}',
                                                    '{{$key2->id_planesPago}}'
                                                )">
                                                <strong><i data-feather="eye"></i>Ver</strong>
                                            </a>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-warning dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">
                                                        <span>
                                                            <strong>Editar</strong>
                                                            <i class="uil uil-angle-down"></i>
                                                        </span>
                                                    </button>
                                                    
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 115px, 0px);">
                                                            <a data-toggle="collapse" href="#editarArriendo2" role="button" aria-expanded="false" aria-controls="editarArriendo2" class="dropdown-item" onclick="editarArriendo(
                                                            '{{$key->id}}',
                                                            '{{$key->id_residente}}',
                                                            '{{$key->id_instalacion}}',
                                                            '{{$key->tipo_alquiler}}',
                                                            '{{$key->fecha}}',
                                                            '{{$key->hora}}',
                                                            '{{$key->num_horas}}',
                                                            '{{$key->status}}',
                                                            '{{$key2->status}}',
                                                            '{{$key2->referencia}}',
                                                            '{{$key2->id_planesPago}}'
                                                            )">
                                                            <span>Arriendo</span>
                                                                <strong><i data-feather="edit"></i></strong>
                                                            </span>
                                                        </a>
                                                        @if($key2->status=="En Proceso")
                                                            <a data-toggle="collapse" href="#edit_referencias_arriendos" role="button" aria-expanded="false" aria-controls="edit_referencias_arriendos" class="dropdown-item" onclick="EditReferenciasArriendos('{{$key->id}}')">
                                                                <span>Referencias</span>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                            @endforeach()
                                            {{--
                                            @if($key->status == 'Activo')
                                                <a data-toggle="collapse" href="#statusArriendo" role="button" aria-expanded="false" aria-controls="statusArriendo"  class="btn btn-info btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="statusArriendos('{{$key->id}}','{{$key->nombre}}','{{$key->status}}')">
                                                    <span data-toggle="tooltip" data-placement="top" title="Seleccione para desactivar instalación">Desactivar</span>
                                                    <center>
                                                            <i data-feather="sliders"></i>
                                                        </span>
                                                    </center>
                                                </a>
                                            @else
                                                <a data-toggle="collapse" href="#activarArriendo" role="button" aria-expanded="false" aria-controls="activarArriendo"  class="btn btn-success btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="statusArriendos('{{$key->id}}','{{$key->nombre}}','{{$key->status}}')">
                                                    <span data-toggle="tooltip" data-placement="top" title="Seleccione para activar instalación">Activar</span>
                                                    <center>
                                                            <i data-feather="sliders"></i>
                                                        </span>
                                                    </center>
                                                </a>
                                            @endif
                                            --}}

                                            <a data-toggle="collapse" href="#EliminarArriendo" role="button" aria-expanded="false" aria-controls="EliminarArriendo"  class="btn btn-danger btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="eliminarArriendo('{{$key->id}}','{{$key->id_instalacion}}')">
                                                <span><i data-feather="trash"></i>Eliminar</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="tablaControl">
        <div class="card border border-info rounded card-tabla shadow p-3 mb-5 bg-white rounded">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3" align="right">
                        <div class="row">
                            <div class="col-md-12 offset-md-12">
                                <a class="btn btn-danger boton-tabla shadow" onclick="crearIncidencia()" style="
                                    border-radius: 10px;
                                    color: white;
                                    height: 35px;
                                    margin-bottom: 5px;
                                    margin-top: 5px;
                                    float: right;">
                                    <span>¿Algún problema?</span>
                                    <center>
                                            <i data-feather="plus" class="alert-octagon"></i>
                                        </span>
                                    </center>
                                </a>
                            </div>
                        </div>
                        <div class="form-group card shadow" style="border-radius: 30px !important;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card shadow card-tabla border border-success">
                                                    <div class="card-body">
                                                        <table class="tablaControl table table-striped">
                                                            <thead>
                                                                <tr align="center">
                                                                    <th colspan="2">Estado de alquileres</th>
                                                                </tr>
                                                                <tr align="center">
                                                                    <th align="center">Activos</th>
                                                                    <th align="center">Inactivos</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    $alquilerA=0;
                                                                    $alquilerI=0;
                                                                ?>
                                                                @foreach($alquiler as $key)
                                                                    @if($key->status == 'Activo')
                                                                        @php $alquilerA++; @endphp
                                                                    @else
                                                                        @php $alquilerI++; @endphp
                                                                    @endif
                                                                @endforeach()
                                                                <tr align="center">
                                                                    <td>
                                                                        {{ $alquilerA }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $alquilerI }}
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
                                                        <table class="tablaControl table table-striped">
                                                            <thead>
                                                                <tr align="center">
                                                                    <th colspan="3">Nro. de alquileres por año</th>
                                                                </tr>
                                                                <tr align="center">
                                                                    <th align="center">{{ date('Y') }}</th>
                                                                    <th align="center">{{ date('Y')-1 }}</th>
                                                                    <th align="center">{{ date('Y')-2 }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    $fecha1=0;
                                                                    $fecha2=0;
                                                                    $fecha3=0;
                                                                ?>
                                                                @foreach($alquiler as $key)

                                                                    @if($key->created_at->year == date('Y'))
                                                                        @php $fecha1++; @endphp
                                                                    @elseif($key->created_at->year == date('Y')-1)
                                                                        @php $fecha2++; @endphp
                                                                    @elseif($key->created_at->year == date('Y')-2)
                                                                        @php $fecha3++; @endphp
                                                                    @else
                                                                    
                                                                    @endif

                                                                @endforeach()
                                                                <tr align="center">
                                                                    <td>{{$fecha1}}</td>
                                                                    <td>{{$fecha2}}</td>
                                                                    <td>{{$fecha3}}</td>
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
                                                        <table class="tablaControl table table-striped">
                                                            <thead>
                                                                <tr align="center">
                                                                    <th colspan="2">Estado de instalaciones</th>
                                                                </tr>
                                                                <tr align="center">
                                                                    <th align="center">Activos</th>
                                                                    <th align="center">Inactivos</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    $instalaA=0;
                                                                    $instalaI=0;
                                                                ?>
                                                                @foreach($instalaciones as $key)
                                                                    @if($key->status == 'Activo')
                                                                        @php $instalaA++; @endphp
                                                                    @else
                                                                        @php $instalaI++; @endphp
                                                                    @endif
                                                                @endforeach()
                                                                <tr align="center">
                                                                    <td>
                                                                        {{ $instalaA }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $instalaI }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card shadow card-tabla border border-success">
                                                    <div class="card-body">
                                                        <canvas id="myChart"></canvas>
                                                        <table class="tablaControl table table-striped">
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
                                                                    
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>--}}
                                </div>
                            </div>
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
                background-image: url('{{ asset('assets/images/alquiler/instalaciones.jpg') }}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                ">
                    <div class="card-header">
                        <h3 align="right" class="text-warning" >INSTALACIONES</h3>
                    </div>
                    <div class="card-body p-3 mb-5 ">
                    </div>
                    <div class="card-footer">
                        <strong class="text-warning">Visualizar las instalaciones de la App.</strong>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 center" id="VerTabla2">
            <a href="#" onclick="VerTabla(2)" id="verTabla2-2" style="display: none; width: 100%;">
                <div class="card border border-dark shadow rounded m-7" style="height: 400px;
                background-image: url('{{ asset('assets/images/alquiler/arrendamiento.jpg') }}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                ">
                    <div class="card-header">
                        <h3 align="right" class="text-warning" >ARRENDAMIENTOS</h3>
                    </div>
                    <div class="card-body p-3 mb-5 ">
                    </div>
                    <div class="card-footer">
                        <strong class="text-warning">Visionar los arrendamientos registradas</strong>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 center" id="VerTabla3">
            <a href="#" onclick="VerTabla(3)" id="verTabla2-3" style="display: none; width: 100%;">
                <div class="card border border-dark shadow rounded m-7" style="height: 400px;
                background-image: url('{{ asset('assets/images/alquiler/controlhorario.jpg') }}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                ">
                    <div class="card-header">
                        <h3 align="right" class="text-warning" >AGENDA Y CONTROL</h3>
                    </div>
                    <div class="card-body p-3 mb-5 ">
                    </div>
                    <div class="card-footer">
                        <strong class="text-warning">Gestionar el Control, arrendamientos, tiempo, horarios y agendas a Visualizar en la App.</strong>
                    </div>
                </div>
            </a>
        </div>
    </div>
@include('alquiler.layouts.incidencia')
@endsection


<script type="text/javascript">

    function cerrar(opcion) {
      $('#example1_wrapper').fadeIn('fast');
      $('#btnRegistrar_arriendo').show();
      $('#example2_wrapper').fadeIn('fast');
      $('#btnRegistrar_insta').show();
    }

    function VerArriendo(nombres,apellidos,rut,nombre_I,tipo_alquiler,fecha,hora,num_horas,status,status2,referencia,id_planesPago) {
        $('#btnRegistrar_arriendo').hide();
        $('#example1_wrapper').hide();

        $('#id_residenteArriendo_2').html(nombres+' '+apellidos+' -'+rut);
        $('#instalacionListArriendo_2').html(nombre_I);
        $('#tipo_alquilerArriendo_2').html(tipo_alquiler);
        $('#fechaAlquilerArriendo_2').html(fecha);
        $('#horaAlquilerArriendo_2').html(hora);
        $('#num_horasArriendo_2').html(num_horas);
        $('#statusArriendo_2').html(status);

        $('#pagadoArriendoE_2').html(status2);

        if(status2 == 'Pagado'){
            $('#pagadoArriendoE_2').prop('checked', true);
        }else{
            $('#pagadoArriendoE_2').removeAttr('checked', false);
        }

        $('#pagadoArriendoE2_2').html(status2);

        if(referencia>0){
            $('#referenciaArriendoE_2').html(referencia);
        }else{
            $('#referenciaArriendoE_2').html('Sin Referencia');
        }
        $('#planPArriendoE_2'+id).prop('checked', true);

    }

    function editarArriendo(id,id_residente,id_instalacion,tipo_alquiler,fecha,hora,num_horas,status,status2,referencia,id_planesPago) {
        $('#btnRegistrar_arriendo').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');

        $('#id_residenteArriendoE').val(id_residente);
        $('#instalacionListArriendoE').val(id_instalacion);
        $('#tipo_alquilerArriendoE').val(tipo_alquiler);
        if (tipo_alquiler == 'Temporal') {
            $('#vistaTemporal2').show();
        }else{
            $('#vistaTemporal2').hide();
        }
        $('#fechaAlquilerArriendoE').val(fecha);
        $('#horaAlquilerArriendoE').val(hora);
        $('#num_horasArriendoE').val(num_horas);
        $('#statusArriendoE').val(status);

        $('#pagadoArriendoE').val(status2);

        if(status2 == 'Pagado'){
            $('#pagadoArriendoE').prop('checked', true);
        }else{
            $('#pagadoArriendoE').removeAttr('checked', false);
        }

        $('#pagadoArriendoE2').html(status2);

        $('#referenciaArriendoE').val(referencia);
        $('#planPArriendoE'+id).prop('checked', true);

        $('#id_editarArriendo').val(id);

    }

    function eliminarArriendo(id, id_instalacion) {
        $('#id_ArriendoE').val(id);
        $('#id_instalacion').val(id_instalacion);
        $('#btnRegistrar_arriendo').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');
    }

    function TipoAlquiler(tipo) {
        if(tipo == 'Permanente'){
            $('.vistaTipoAlquiler').fadeOut('fast',
                function() { 
                  $(this).hide();
                });
            $('#fechaAlquiler').removeAttr('required',false);
            $('#horaAlquiler').removeAttr('required',false);
        }else{
            $('.vistaTipoAlquiler').fadeIn(300);
            $('#fechaAlquiler').attr('required',true);
            $('#horaAlquiler').attr('required',true);
        }
    }




    function crearInstalacion() {
        $('#btnRegistrar_insta').fadeOut('fast');
        $('#example2_wrapper').fadeOut('fast');
    }

    function VerInstalacion(id,nombre,id_dia,hora_desde,hora_hasta,max_personas,status) {
        $('#nombreInstalacion_2').html(nombre);
        $('#id_diaInstalacion_2').html(id_dia);
        $('#desdeInstalacion_2').html(hora_desde);
        $('#hastaInstalacion_2').html(hora_hasta);
        $('#npersonasInstalacion_2').html(max_personas);
        $('#statusInstalacion_2').html(status);
        $('#dias_insta_2').empty();

        $.get("instalaciones/"+id+"/buscar_dias",function (data) {
        })
        .done(function(data) {
            console.log(data.length);
            if (data.length>0) {
                $('#dias_insta_2').append('<strong>Dias registrados:</strong>&nbsp;');
                for (var i = 0; i < data.length; i++) {
                   $('#dias_insta_2').append('<span class="text-primary">'+data[i].dia+'</span>&nbsp;');
                }
                $('#dias_insta_2').append('<br>');
            }else{
                $('#dias_insta_2').append('<strong>Sin dias registrados</strong>');
            }

        });

        $('#btnRegistrar_insta').fadeOut('fast');
        $('#example2_wrapper').fadeOut('fast');
    }

    function editarInstalacion(id,nombre,id_dia,hora_desde,hora_hasta,max_personas,status) {
        $('#idInstalacion').val(id);
        $('#nombreInstalacion').val(nombre);
        $('#id_diaInstalacion').val(id_dia);
        $('#desdeInstalacion').val(hora_desde);
        $('#hastaInstalacion').val(hora_hasta);
        $('#npersonasInstalacion').val(max_personas);
        $('#statusInstalacion').val(status);
        $('#dias_insta').empty();

        $.get("instalaciones/"+id+"/buscar_dias",function (data) {
        })
        .done(function(data) {
            console.log(data.length);
            if (data.length>0) {
                $('#dias_insta').append('<strong>Dias registrados:</strong>&nbsp;');
                for (var i = 0; i < data.length; i++) {
                   $('#dias_insta').append('<span class="text-primary">'+data[i].dia+'</span>&nbsp;');
                }
                $('#dias_insta').append('<br>');
            }else{
                $('#dias_insta').append('<strong>Sin dias registrados</strong>');
            }

        });

        $('#btnRegistrar_insta').fadeOut('fast');
        $('#example2_wrapper').fadeOut('fast');
    }

    function eliminarInstalacion(id) {
        $('#id_instalacion_eliminar').val(id);
        $('#btnRegistrar_insta').fadeOut('fast');
        $('#example2_wrapper').fadeOut('fast');
    }




    function nuevoArriendo() {
        $('#btnRegistrar_arriendo').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');
    }
    function crearIncidencia(){
        // alert('assas');
        $('#crearIncidencia').modal('show');
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
          $("#tablaArriendos").fadeOut("slow",
              function() {
                  $(this).hide();
                  $("#tablaControl").fadeOut("slow");
                  $("#tablaInstalaciones")
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
          $("#tablaInstalaciones").fadeOut("slow",
              function() {
                  $(this).hide();
                  $("#tablaControl").fadeOut("slow");
                  $("#tablaArriendos")
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
          $("#tablaInstalaciones").fadeOut("slow",
              function() {
                  $(this).hide();
                  $("#tablaArriendos").fadeOut("slow");
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
  function NuevoAlquiler() {
    $('#verTabla3-2').hide();
    $('#verTabla3-3').hide();
    $("#tablaAlquiler").fadeOut("slow",
      function() {
        $(this).hide();
        $(".seccionQueHacer").fadeIn(100);
        $(function () {
          setTimeout( function(){

              $('#verTabla3-1')
              .css('opacity', 0)
                  .slideDown('slow')
                  .animate(
                      { opacity: 1 },
                      { queue: false, duration: 'slow' }
                  );
              setTimeout( function(){
                  $('#verTabla3-2')
                  .css('opacity', 0)
                  .slideDown('slow')
                  .animate(
                      { opacity: 1 },
                      { queue: false, duration: 'slow' }
                  );
                  setTimeout( function(){
                      $('#verTabla3-3')
                      .css('opacity', 0)
                      .slideDown('slow')
                      .animate(
                          { opacity: 1 },
                          { queue: false, duration: 'slow' }
                      );
                  }  , 500 );
              }  , 500 );
          }  , 500 );
        });
      });
  }
  function seccionNegocio(opcion) {
    if (opcion == 1) {
      $('#cardTipoNegocio1').hide();
      $('#cardTipoNegocio2').hide();
      $('#cardTipoNegocio3').hide();
      $('#cardTipoNegocio4').hide();
      $('#cardTipoNegocio5').hide();
      $('#cardTipoNegocio6').hide();
      $(".seccionQueHacer").fadeOut("slow",
        function() {
          $(this).hide();
          $(".seccionTipoNegocio").fadeIn(300);
        });
      setTimeout( function(){

        $('.seccionControl')
        .css('opacity', 0)
          .slideDown('slow')
          .animate(
              { opacity: 1 },
              { queue: false, duration: 'slow' }
          );
          setTimeout( function(){
            $('#seccionControl1')
            .css('opacity', 0)
                  .slideDown('slow')
                  .animate(
                      { opacity: 1 },
                      { queue: false, duration: 'slow' }
                  );
          }  , 400 );

        $('#cardTipoNegocio1')
          .css('opacity', 0)
              .slideDown('slow')
              .animate(
                  { opacity: 1 },
                  { queue: false, duration: 'slow' }
              );
          setTimeout( function(){
              $('#cardTipoNegocio2')
              .css('opacity', 0)
              .slideDown('slow')
              .animate(
                  { opacity: 1 },
                  { queue: false, duration: 'slow' }
              );
              setTimeout( function(){
                  $('#cardTipoNegocio3')
                  .css('opacity', 0)
                  .slideDown('slow')
                  .animate(
                      { opacity: 1 },
                      { queue: false, duration: 'slow' }
                  );
                  setTimeout( function(){
                    $('#cardTipoNegocio4')
                    .css('opacity', 0)
                    .slideDown('slow')
                    .animate(
                        { opacity: 1 },
                        { queue: false, duration: 'slow' }
                    );
                    setTimeout( function(){
                      $('#cardTipoNegocio5')
                      .css('opacity', 0)
                      .slideDown('slow')
                      .animate(
                          { opacity: 1 },
                          { queue: false, duration: 'slow' }
                      );
                      setTimeout( function(){
                        $('#cardTipoNegocio6')
                        .css('opacity', 0)
                        .slideDown('slow')
                        .animate(
                            { opacity: 1 },
                            { queue: false, duration: 'slow' }
                        );
                    }  , 400 );
                  }  , 400 );
                }  , 400 );
              }  , 400 );
          }  , 400 );
      }  , 1000 );
      $('#negocio').val(1)
    }else{
    }
  }
  function SelectTipoN(opcion){
    $('#InputTipoNegocio').val(opcion);
    $('.seccionTipoNegocio').attr("disabled", "disabled").off('click');
    var a=0;
    for (var i = 0; i < 7; i++) {
      if (i != opcion) {
        $("#cardTipoNegocio"+i).fadeOut("slow");
      }
      a++;
    }
    if(i == 7){
      if(opcion == 1){
        $('#seccionControl2-2').attr('src','{{ asset("assets/images/alquiler/gym.png") }}');
      }else if(opcion == 2){
        $('#seccionControl2-2').attr('src','{{ asset("assets/images/alquiler/market.png") }}');
      }else if(opcion == 3){
        $('#seccionControl2-2').attr('src','{{ asset("assets/images/alquiler/restaurant.png") }}');
      }else if(opcion == 4){
        $('#seccionControl2-2').attr('src','{{ asset("assets/images/alquiler/factory.png") }}');
      }else if(opcion == 5){
        $('#seccionControl2-2').attr('src','{{ asset("assets/images/alquiler/oficina.png") }}');
      }else{
        $('#seccionControl2-2').attr('src','{{ asset("assets/images/alquiler/theater.png") }}');
      }
      $("#cardTipoNegocio"+opcion).fadeOut("slow");
      setTimeout( function(){
        $('#seccionControl2')
        .css('opacity', 0)
              .slideDown('slow')
              .animate(
                  { opacity: 1 },
                  { queue: false, duration: 'slow' }
              );
      }  , 400 );
    }
    $('.seccionTipoNegocio').fadeOut("slow");
    $('.seccionDatosNegocio').fadeIn(300);
  }

  function seccionHorario() {
    $(".seccionDatosNegocio").fadeOut("slow",
      function() {
        $(this).hide();
        $(".seccionHorarioNegocio").fadeIn(300);
      });
    $('#seccionControl3').fadeIn('show');
  }

  function diaNegocio(dia) {
    if(dia == 1){
      if($('#horarioBotonDia1').hasClass('btn-primary')){
        $('.seccionHorarioNegocio').append('<input type="hidden" name="dia[]" class="inputDia1" value="1">');
        $('#horarioBotonDia1').removeClass('btn-primary').addClass('btn btn-success');
      }else{
        $('.inputDia1').remove();
        $('#horarioBotonDia1').removeClass('btn-success').addClass('btn btn-primary');
      }
    }else if(dia == 2){
      if($('#horarioBotonDia2').hasClass('btn-primary')){
        $('.seccionHorarioNegocio').append('<input type="hidden" name="dia[]" class="inputDia2" value="2">');
          $('#horarioBotonDia2').removeClass('btn-primary').addClass('btn btn-success');
      }else{
        $('.inputDia2').remove();
        $('#horarioBotonDia2').removeClass('btn-success').addClass('btn btn-primary');
      }
    }else if(dia == 3){
      if($('#horarioBotonDia3').hasClass('btn-primary')){
        $('.seccionHorarioNegocio').append('<input type="hidden" name="dia[]" class="inputDia3" value="3">');
          $('#horarioBotonDia3').removeClass('btn-primary').addClass('btn btn-success');
      }else{
        $('.inputDia3').remove();
        $('#horarioBotonDia3').removeClass('btn-success').addClass('btn btn-primary');
      }
    }else if(dia == 4){
      if($('#horarioBotonDia4').hasClass('btn-primary')){
        $('.seccionHorarioNegocio').append('<input type="hidden" name="dia[]" class="inputDia4" value="4">');
          $('#horarioBotonDia4').removeClass('btn-primary').addClass('btn btn-success');
      }else{
        $('.inputDia4').remove();
        $('#horarioBotonDia4').removeClass('btn-success').addClass('btn btn-primary');
      }
    }else if(dia == 5){
      if($('#horarioBotonDia5').hasClass('btn-primary')){
        $('.seccionHorarioNegocio').append('<input type="hidden" name="dia[]" class="inputDia5" value="5">');
          $('#horarioBotonDia5').removeClass('btn-primary').addClass('btn btn-success');
      }else{
        $('.inputDia5').remove();
        $('#horarioBotonDia5').removeClass('btn-success').addClass('btn btn-primary');
      }
    }else if(dia == 6){
      if($('#horarioBotonDia6').hasClass('btn-primary')){
        $('.seccionHorarioNegocio').append('<input type="hidden" name="dia[]" class="inputDia6" value="6">');
          $('#horarioBotonDia6').removeClass('btn-primary').addClass('btn btn-success');
      }else{
        $('.inputDia6').remove();
        $('#horarioBotonDia6').removeClass('btn-success').addClass('btn btn-primary');
      }
    }else{
      if($('#horarioBotonDia7').hasClass('btn-primary')){
        $('.seccionHorarioNegocio').append('<input type="hidden" name="dia[]" class="inputDia7" value="7">');
        $('#horarioBotonDia7').removeClass('btn btn-primary').addClass('btn btn-success');
      }else{
        $('.inputDia7').remove();
        $('#horarioBotonDia7').removeClass('btn-success').addClass('btn btn-primary');
      }
    }
  }

  function seccionPago() {
    $(".seccionHorarioNegocio").fadeOut("slow",
      function() {
        $(this).hide();
        $(".seccionPagoNegocio").fadeIn(300);
      });
    $('#seccionControl4').fadeIn('show');
  }
  function SeccionListo() {
    $(".seccionPagoNegocio").fadeOut("slow");
    $('#seccionControl5').fadeIn('show');
    $('#seccionControl6').fadeIn('show');
  }

    function pagoRealizadoA() {
        // alert('ASDASD');
        if($('#pagoRealizado').prop('checked')){
            $('#mostrarRefeC').fadeIn(300);
            $('#refeCreateA').attr('required',true);
        }else{
            $('#mostrarRefeC').fadeOut(300);
            $('#refeCreateA').removeAttr('required',false);
        }
    }

    function statusInstalacion(id, nombre, status) {
        $('#id_instalacion_des').val(id);
        $('#cambiarStatus').val(status);
        $('#NombreInstalacion').html(nombre);

        $('#id_instalacion_des2').val(id);
        $('#cambiarStatus2').val(status);
        $('#NombreInstalacion2').html(nombre);

        $('#btnRegistrar_insta').fadeOut('fast');
        $('#example2_wrapper').fadeOut('fast');
    }

    function statusArriendos(id, nombre, status) {
        $('#id_Arriendo_des').val(id);
        $('#cambiarStatusA').val(status);
        $('#NombreArriendo').html(nombre);

        $('#id_Arriendo_des_A_2').val(id);
        $('#cambiarStatus_A_2').val(status);
        $('#NombreArriendo2').html(nombre);

        $('#btnRegistrar_arriendo').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');
    }

    function EditReferenciasArriendos(id_arriendo) {
        $('#id_arriendoEditReferencia').val(id_arriendo);
        $('#vistaRefeArriendosE').hide();
        $('#cargandoRefeArriendos').css('display','block');
        $('#btnRegistrar_arriendo').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');

        $('#codigoActualRefArr').empty();
        

        $.get("arriendos/"+id_arriendo+"/buscar_referencias",function (data) {
        })
        .done(function(data) {
            if (data[0].refer!= null) {
                console.log(data.length);
                $('#codigoActualRefArr').append(
                    '<center>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label for="">Código de Refer. Actual</label>'+
                                    '<h3 align="center" class="text-warning">'+data[0].refer+'</h3>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</center>'
                );
            }else{
                $('#codigoActualRefArr').append(
                    '<h3 align="center">El alquiler no posee referencia</h3>'
                );
            }

            $('#cargandoRefeArriendos').fadeOut('slow',
                function() { 
                    $(this).hide();
                    $('#vistaRefeArriendosE').fadeIn(300);
            });
            // $('#cargandoRefeArriendos').fadeOut('fast');
            // $('#codigoActualRefArr').fadeIn();

        });
    }
  
</script>