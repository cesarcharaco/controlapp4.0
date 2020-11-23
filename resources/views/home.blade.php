@extends('layouts.app')
@section('content')
    
    <div class="row">
        @if(\Auth::user()->tipo_usuario=="Admin")
            @if(count($anuncios) >0 && \Auth::user()->tipo_usuario!="Admin")
                <div class="col-md-9">
                <div style="margin-right: -25px;">
            @else
                <div class="col-md-12" style="margin-right: 25px;">
                <div style="margin-right: 0px;">
            @endif
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="row page-title">
                        <div class="col-md-12">
                            <nav aria-label="breadcrumb" class="float-right mt-1">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                </ol>
                            </nav>
                            <h4 class="mb-1 mt-0">Vista Principal</h4>
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
                    <div class="row">
                        <div class="col-md-6 col-xl-6">
                            <div class="card border border-info rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
                                <div class="card-body p-0">
                                    <div class="media p-4">
                                        <div class="media-body">
                                            <span class="text-info text-uppercase font-size-12 font-weight-bold">Pago Comúnes</span>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4">
                                                    <h6 style="margin-top: 24px;color: #CB8C4D !important;" align="center">Costo Inmueble</h6>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <h6><a href="#" style="width: 100% !important;" onclick="PagoC(1)" class="btn btn-primary shadow">Registrar</a></h6>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <h6><a href="#" style="width: 100% !important;" onclick="PagoC(3)" class="btn btn-warning shadow">Editar</a></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4">
                                                    <h6 style="margin-top: 10px;color: #cccc00 !important;" align="center">Costo Estacionamiento</h6>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <h6><a href="#" style="width: 100% !important;" onclick="PagoC(2)" class="btn btn-primary shadow">Registrar</a></h6>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <h6><a href="#" style="width: 100% !important;" onclick="PagoC(4)" class="btn btn-warning shadow">Editar</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-6">
                            <div class="card rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="
                                    display: none;
                                    border: 1px solid #f6f6f7!important;
                                    border-color: #2d572c !important;
                                    ">
                                <div class="card-body p-0">
                                    <div class="media">
                                        <div class="media-body">
                                            <center><span class="text-success text-uppercase font-size-12 font-weight-bold" style="color:#2d572c !important;">Residentes</span></center>
                                            <div class="row justify-content-center">
                                                <div class="col-md-6">
                                                    <div class="card shadow" style="border: 1px solid #f6f6f7!important; border-color: #2d572c !important;">
                                                        <table width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center"><span>Registrados: </span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">{{ residentes() }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center"><span style="color: #CB8C4D !important;">C/Inmuebles:</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">{{ residentes_alquilados_i() }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center"><span style="color: #cccc00 !important;">C/Estaciona.:</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">{{ residentes_alquilados_e() }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" align="center">
                                                        <label style="color: #2d572c !important;">Nuevo Residente</label>
                                                        <a href="#" style="
                                                            width: 100% !important;
                                                            position: relative;
                                                            border: 1px solid #f6f6f7!important;
                                                            border-color: #2d572c !important;
                                                            background-color: #2d572c !important;" class="btn shadow" onclick="NuevoResidente()"><strong class="text-white">Agregar</strong>
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
                        <div class="col-md-6 col-xl-6">
                            <div class="card rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="
                                display: none;
                                border: 1px solid #f6f6f7!important;
                                border-color: #CB8C4D !important; ">
                                <div class="card-body p-0">
                                    <div class="media p-2">
                                        <div class="media-body">
                                            <center>
                                                <span class="text-success text-uppercase font-size-12 font-weight-bold" style="color: #CB8C4D  !important">Inmuebles</span>
                                            </center>
                                            <div class="row justify-content-center">
                                                <div class="col-md-6">
                                                    <div class="card shadow" style="border: 1px solid #f6f6f7!important; border-color: #CB8C4D !important;">
                                                        <table width="100%">
                                                            <tbody>
                                                                <tr>
                                                                        <td align="center"><span>Existencias:</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center">{{ existencia_i() }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center"><span>Alquilados:</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center">{{ alquilados_i_t() }}</td>
                                                                    </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" align="center">
                                                        <label class="mb-0" style="color: #CB8C4D !important">Nuevo Inmueble</label>
                                                        <h6 class="mb-0">
                                                            <strong>
                                                                <a href="#" data-toggle="modal" data-target="#crearInmueble" style="
                                                                    width: 100% !important;
                                                                    position: relative;
                                                                    border: 1px solid #f6f6f7!important;
                                                                    border-color: #CB8C4D !important; 
                                                                    background-color: #CB8C4D !important; " class="btn shadow"><strong class="text-white">Agregar</strong>
                                                                </a>
                                                            </strong>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-6">
                            <div class="card rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="
                                display: none;
                                border: 1px solid #f6f6f7!important;
                                border-color:#cccc00 !important;">
                                <div class="card-body p-0">
                                    <div class="media p-2">
                                        <div class="media-body">
                                            <center>
                                                <span class="text-uppercase font-size-12 font-weight-bold" style="color: #cccc00 !important;">Estacionamientos</span>
                                            </center>
                                            <div class="row justify-content-center">
                                                <div class="col-md-6">
                                                    <div class="card shadow" style="border: 1px solid #f6f6f7!important; border-color: #cccc00 !important;">
                                                        <table width="100%">
                                                            <tbody>
                                                                <tr>
                                                                        <td align="center"><span>Existencias:</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center">{{ existencia_e() }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center"><span>Alquilados:</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center">{{ alquilados_e_t() }}</td>
                                                                    </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" align="center">
                                                    <label class="mb-0" style="color: #cccc00 !important;">Nuevo Estacionamiento</label>
                                                    <h6 class="mb-0">
                                                        <strong>
                                                            <a href="#" style="
                                                            width: 100% !important;
                                                            position: relative;
                                                            border: 1px solid #f6f6f7!important;
                                                            border-color: #cccc00 !important;
                                                            background-color: #cccc00 !important;
                                                            " data-toggle="modal" data-target="#crearEstacionamiento" class="btn btn-danger shadow">Agregar</a>
                                                        </strong>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                       {{--  <div class="col-md-6 col-xl-3">
                            <div class="card border border-info rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
                                <div class="card-body p-0">
                                    <div class="media p-3">
                                        <div class="media-body">
                                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">New
                                                Visitors</span>
                                            <h2 class="mb-0">750</h2>
                                        </div>
                                        <div class="align-self-center" style="position: relative;">
                                            <div id="today-new-visitors-chart" class="apex-charts" style="min-height: 45px;"><div id="apexcharts8pshvzb5k" class="apexcharts-canvas apexcharts8pshvzb5k light" style="width: 90px; height: 45px;"><svg id="SvgjsSvg1653" width="90" height="45" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1655" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1654"><clipPath id="gridRectMask8pshvzb5k"><rect id="SvgjsRect1660" width="92" height="47" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMask8pshvzb5k"><rect id="SvgjsRect1661" width="92" height="47" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><linearGradient id="SvgjsLinearGradient1667" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1668" stop-opacity="0.45" stop-color="rgba(255,190,11,0.45)" offset="0.45"></stop><stop id="SvgjsStop1669" stop-opacity="0.05" stop-color="rgba(255,255,255,0.05)" offset="1"></stop><stop id="SvgjsStop1670" stop-opacity="0.05" stop-color="rgba(255,255,255,0.05)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1659" x1="0" y1="0" x2="0" y2="45" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="45" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1673" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1674" class="apexcharts-xaxis-texts-g" transform="translate(0, 1.875)"></g></g><g id="SvgjsG1677" class="apexcharts-grid"><line id="SvgjsLine1679" x1="0" y1="45" x2="90" y2="45" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1678" x1="0" y1="1" x2="0" y2="45" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1663" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1664" class="apexcharts-series" seriesName="seriesx1" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1671" d="M 0 45L 0 33.75C 3.15 33.75 5.85 15.3 9 15.3C 12.15 15.3 14.85 26.55 18 26.55C 21.15 26.55 23.85 6.75 27 6.75C 30.15 6.75 32.85 16.650000000000002 36 16.650000000000002C 39.15 16.650000000000002 41.85 33.75 45 33.75C 48.15 33.75 50.85 25.2 54 25.2C 57.15 25.2 59.85 39.6 63 39.6C 66.15 39.6 68.85 28.8 72 28.8C 75.15 28.8 77.85 40.95 81 40.95C 84.15 40.95 86.85 20.700000000000003 90 20.700000000000003C 90 20.700000000000003 90 20.700000000000003 90 45M 90 20.700000000000003z" fill="url(#SvgjsLinearGradient1667)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask8pshvzb5k)" pathTo="M 0 45L 0 33.75C 3.15 33.75 5.85 15.3 9 15.3C 12.15 15.3 14.85 26.55 18 26.55C 21.15 26.55 23.85 6.75 27 6.75C 30.15 6.75 32.85 16.650000000000002 36 16.650000000000002C 39.15 16.650000000000002 41.85 33.75 45 33.75C 48.15 33.75 50.85 25.2 54 25.2C 57.15 25.2 59.85 39.6 63 39.6C 66.15 39.6 68.85 28.8 72 28.8C 75.15 28.8 77.85 40.95 81 40.95C 84.15 40.95 86.85 20.700000000000003 90 20.700000000000003C 90 20.700000000000003 90 20.700000000000003 90 45M 90 20.700000000000003z" pathFrom="M -1 45L -1 45L 9 45L 18 45L 27 45L 36 45L 45 45L 54 45L 63 45L 72 45L 81 45L 90 45"></path><path id="SvgjsPath1672" d="M 0 33.75C 3.15 33.75 5.85 15.3 9 15.3C 12.15 15.3 14.85 26.55 18 26.55C 21.15 26.55 23.85 6.75 27 6.75C 30.15 6.75 32.85 16.650000000000002 36 16.650000000000002C 39.15 16.650000000000002 41.85 33.75 45 33.75C 48.15 33.75 50.85 25.2 54 25.2C 57.15 25.2 59.85 39.6 63 39.6C 66.15 39.6 68.85 28.8 72 28.8C 75.15 28.8 77.85 40.95 81 40.95C 84.15 40.95 86.85 20.700000000000003 90 20.700000000000003" fill="none" fill-opacity="1" stroke="#ffbe0b" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask8pshvzb5k)" pathTo="M 0 33.75C 3.15 33.75 5.85 15.3 9 15.3C 12.15 15.3 14.85 26.55 18 26.55C 21.15 26.55 23.85 6.75 27 6.75C 30.15 6.75 32.85 16.650000000000002 36 16.650000000000002C 39.15 16.650000000000002 41.85 33.75 45 33.75C 48.15 33.75 50.85 25.2 54 25.2C 57.15 25.2 59.85 39.6 63 39.6C 66.15 39.6 68.85 28.8 72 28.8C 75.15 28.8 77.85 40.95 81 40.95C 84.15 40.95 86.85 20.700000000000003 90 20.700000000000003" pathFrom="M -1 45L -1 45L 9 45L 18 45L 27 45L 36 45L 45 45L 54 45L 63 45L 72 45L 81 45L 90 45"></path><g id="SvgjsG1665" class="apexcharts-series-markers-wrap"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1685" r="0" cx="0" cy="0" class="apexcharts-marker wz4q8s84y no-pointer-events" stroke="#ffffff" fill="#ffbe0b" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g><g id="SvgjsG1666" class="apexcharts-datalabels"></g></g></g><line id="SvgjsLine1680" x1="0" y1="0" x2="90" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1681" x1="0" y1="0" x2="90" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1682" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1683" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1684" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1658" width="0" height="0" x="0" y="0" rx="0" ry="0" fill="#fefefe" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect><g id="SvgjsG1675" class="apexcharts-yaxis" rel="0" transform="translate(-21, 0)"><g id="SvgjsG1676" class="apexcharts-yaxis-texts-g"></g></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip dark"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 190, 11);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                                            <span class="text-danger font-weight-bold font-size-13"><i class="uil uil-arrow-down"></i> 5.05%</span>
                                        <div class="resize-triggers"><div class="expand-trigger"><div style="width: 91px; height: 67px;"></div></div><div class="contract-trigger"></div></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>--}}

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card border border-success rounded shadow p-3 mb-5 bg-white rounded" style="display: none;">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <center><h4>Notificaciones</h4></center>
                                        </div>
                                        <div class="col-md-3">
                                            @if(\Auth::user()->tipo_usuario=="Admin")
                                                <a style="width: 100%" href="#" data-toggle="modal" data-target="#crearNotficacion" class="btn btn-success">Nueva</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @foreach($notificaciones as $key)
                                    @if(\Auth::user()->tipo_usuario=="Admin")
                                    <h4>{{$key->titulo}}</h4>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <p>{{$key->motivo}}</p>
                                            </div>
                                            <div class="col-md-5">
                                                <ul>
                                                {{ mostrar_resi_has_notif($key->id) }}
                                                </ul>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="dropdown align-self-center float-right">
                                                    <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="uil uil-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-177px, 20px, 0px);">
                                                        <!-- item-->
                                                        <!-- <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editarNotificacion"><i class="uil uil-edit-alt mr-2"></i>Editar</a> -->
                                                        <!-- item-->
                                                        <div class="dropdown-divider"></div>
                                                        <!-- item-->
                                                        <a href="{{ route('eliminarNotificacion', $key->id)}}" class="dropdown-item text-danger"><i class="uil uil-trash mr-2"></i>Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif(\Auth::user()->tipo_usuario!=="Admin")
                                        @if($key->publicar=="Todos" || buscar_notificacion($residente->id,$key->id)>0)
                                        <h4>{{$key->titulo}}</h4>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <p>{{$key->motivo}}</p>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="dropdown align-self-center float-right">
                                                    <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="uil uil-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-177px, 20px, 0px);">
                                                        <!-- item-->
                                                        <!-- <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editarNotificacion"><i class="uil uil-edit-alt mr-2"></i>Editar</a> -->
                                                        <!-- item-->
                                                        <div class="dropdown-divider"></div>
                                                        <!-- item-->
                                                        <a href="{{ route('eliminarNotificacion', $key->id)}}" class="dropdown-item text-danger"><i class="uil uil-trash mr-2"></i>Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endif
                                    @endforeach()
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border border-success rounded shadow p-3 mb-5 bg-white rounded" style="display: none;">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <center><h4>Noticias</h4></center>
                                        </div>
                                        <div class="col-md-5">
                                            @if(\Auth::user()->tipo_usuario=="Admin")
                                                <a style="width: 100%" href="#" data-toggle="modal" data-target="#crearNoticia" class="btn btn-success">Nueva</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    
                                    @foreach($noticias as $key)
                                    <h4>{{$key->titulo}}</h4>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <p>{{$key->contenido }}</p>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="dropdown align-self-center float-right">
                                                    <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="uil uil-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-177px, 20px, 0px);">
                                                        <!-- item-->
                                                        <!-- <a href="#" class="dropdown-item" data-toggle="modal" data-target="#editarNoticia" ><i class="uil uil-edit-alt mr-2"></i>Editar</a> -->
                                                        <!-- item-->
                                                        <div class="dropdown-divider"></div>
                                                        <!-- item-->
                                                        <a href="{{ route('eliminarNoticia', $key->id)}}" class="dropdown-item text-danger"><i class="uil uil-trash mr-2"></i>Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                    @endforeach()
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(\Auth::user()->tipo_usuario=="root")
            <input type="hidden" id="colorView" value="#25c2e3 !important">
            <div class="col-md-12 container-fluid">
                <br>
                <div class="row">
                    
                    <div class="col-md-8" style="float: left; position: relative;">
                        <div style="width: 100%;" id="vistaAdminRoot">
                            <div class="card border border-info rounded card-tabla shadow p-3 mb-5 bg-white rounded">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 offset-md-12">
                                                <a class="btn btn-success boton-tabla shadow" id="btnRegistrar_admin" data-toggle="tooltip" data-placement="top" title="Seleccione para registrar un nuevo administrador" onclick="crearAdmin()" style="
                                                    border-radius: 10px;
                                                    color: white;
                                                    height: 35px;
                                                    margin-bottom: 5px;
                                                    margin-top: 5px;
                                                    float: right;" >
                                                    <span><i data-feather="plus"></i>Nuevo Admin</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                        <div class="col-md-12">
                                            <div style="width: 100%;">
                                                @include('root.layouts.showAdmin')
                                            </div>
                                        </div>

                                    <div class="col-md-12">
                                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                                            <table class="table table-bordered table-hover table-striped dataTable" style="width: 100% !important;" data-toggle="tooltip" data-placement="top" checked="checked" title="Si desea ver mas opciones, dirijase a la vista de Admins">
                                                <thead>
                                                    <tr class="bg-primary text-white">
                                                        <th>Nombres</th>
                                                        <th>Rut</th>
                                                        <th>Email</th>
                                                        <th>Registrado el</th>
                                                        <th>Status</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($admin as $key)
                                                        <tr>

                                                            <td>{{$key->name}}</td>
                                                            <td>{{$key->rut}}</td>
                                                            <td>{{$key->email}}</td>
                                                            <td>{{$key->created_at}}</td>
                                                             @if($key->status == 'activo')
                                                                <td style="position: all;">
                                                                        <span class="text-success"><strong>Activo</strong></span>
                                                                        <span class="text-success"><strong>A</strong></span>
                                                                </td>
                                                            @else
                                                                <td style="position: all;">
                                                                        <span class="text-danger"><strong>Inactivo</strong></span>
                                                                        <span class="text-danger"><strong>I</strong></span>
                                                                </td>
                                                            @endif
                                                            <td>
                                                                <a data-target="#crearInmueble" class="btn btn-info btn-sm" href="#verAdmin" id="btnRegistrar_arriendo" role="button" aria-expanded="false" aria-controls="verAdmin" onclick="verAdmin(
                                                                    '{{$key->id}}',
                                                                    '{{$key->name}}',
                                                                    '{{$key->rut}}',
                                                                    '{{$key->email}}',
                                                                    '{{$key->status}}',
                                                                    '{{$key->membresia->nombre}}',
                                                                    '{{$key->membresia->cant_inmuebles}}',
                                                                    '{{$key->membresia->monto}}'
                                                                    )">
                                                                    
                                                                    <span><i data-feather="eye"></i>Ver</span>
                                                                </a>
                                                                <!-- <a data-toggle="modal" data-target="#editarAdmin" href="#" class="btn btn-warning btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="Editar('{{$key->id}}','{{$key->name}}','{{$key->rut}}','{{$key->email}}','{{$key->status}}','{{$key->membresia->nombre}}','{{$key->membresia->cant_inmuebles}}','{{$key->membresia->monto}}')">
                                                                    <span><i data-feather="edit"></i>Editar</span>
                                                                </a>

                                                                <a data-toggle="modal" data-target="#eliminarAdmin" href="#" class="btn btn-danger btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="Eliminar('{{$key->id}}')" >
                                                                    <span><i data-feather="trash"></i>Eliminar</span>
                                                                </a> -->
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
                    </div>
                    
                    <div class="col-md-4">
                        <div style="margin-top: -30px; width: auto;" id="anuncioRoot">
                            <table class="table table-striped">
                                <thead>
                                    <th>
                                        <strong class="text-dark" style="font-size: 20px;">Anuncios</strong>
                                        <a data-toggle="tooltip" data-placement="top" checked="checked" title="Seleccione si desea registrar un nuevo anuncio en el sistema" href="#" style="float: right" class="btn btn-success btn-sm" onclick="AnuncioCreate()">
                                            <span class="PalabraEditarPago">Crear anuncio</span>
                                            <span class="PalabraEditarPago2">
                                                <i data-feather="plus" class="iconosMetaforas2"></i>
                                            </span>
                                        </a>
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($anuncios as $key)
                                        <tr style="background-color: white;">
                                            <td align="center">
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Seleccione si desea ver los administradores que pueden visualizar el anuncio" style="border-radius: 50px; width: 28px; height: 28px;" onclick="VerAdminAsignado('{{$key->id}}')" class="btn btn-info btn-sm">
                                                    a
                                                </a>
                                                <!-- <a href="#" style="border-radius: 50px; width: 28px; height: 28px;" onclick="EditarAnuncio('{{$key->id}}','{{$key->titulo}}','{{$key->descripcion}}','{{$key->url_img}}','{{$key->link}}')" class="btn btn-warning btn-sm">
                                                    e
                                                </a> -->
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Seleccione si desea eliminar el anuncio del sistema" style="border-radius: 50px; width: 28px; height: 28px;" onclick="EliminarAnuncio('{{$key->id}}')" class="btn btn-danger btn-sm">
                                                    x
                                                </a>

                                                <div onclick="window.open('{{$key->link}}', '_blank');">
                                                    
                                                    <span class="text-dark"><strong>{{$key->titulo}}</strong></span>
                                                    <center><img align="center" class="imagenAnun text-dark" src="{{ asset($key->url_img) }}" style="width: 100%; padding: 15px 15px 15px 15px; border-radius: 10%;" ></center>

                                                    <p class="text-dark" align="center">{{$key->descripcion}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach()
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @if(count($anuncios)>0)
                <div class="col-md-9">
                <div style="margin-right: -10px;">
            @else
                <div class="col-md-12" style="margin-right: 25px;">
                <div style="margin-right: 0px;">
            @endif
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        @include('flash::message')
                        <div class="row page-title">
                        <div class="col-md-12">
                            <nav aria-label="breadcrumb" class="float-right mt-1">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                </ol>
                            </nav>
                            <h4 class="mb-1 mt-0">Vista Principal</h4>
                        </div>
                    </div>
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
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="card border border-primary rounded shadow p-3 mb-5 bg-white rounded" style="display: none;">
                                    <input type="hidden" name="id_residente" id="id_reside" value="{{\Auth::user()->id}}">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-primary text-uppercase font-size-12 font-weight-bold">Pago de Condominio</span>
                                                <h6 class="mb-0">Pagos Retrasados: </h6>
                                            </div>                                             
                                            <div class="form-group">
                                                <!-- <label class="mb-0 text-primary">Pagar mes</label> -->
                                                <h6 class="mb-0"><a href="#" style="width: 100% !important;" onclick="BMesesResidente('{{$residente->id}}')" class="btn btn-primary">Pagar</a></h6>
                                            </div>                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="card border border-danger rounded shadow p-3 mb-5 bg-white rounded" style="display: none;">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-danger text-uppercase font-size-12 font-weight-bold">Multas/Recargas Asignadas</span>
                                                <h6 class="mb-0">Total de Multas/Recargas: </h6>
                                            </div>
                                            
                                            <div class="form-group">
                                                <!-- <label class="mb-0 text-danger">Pagar multa</label> -->
                                                <h6 class="mb-0"><a href="#" style="width: 100% !important; position: relative;" onclick="pagarMultasResidente('{{$residente->id}}')" class="btn btn-danger">Pagar</a></h6>
                                            </div>
                                        </div>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="card border border-success rounded shadow p-3 mb-5 bg-white rounded" style="display: none;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center><h4>Notificaciones</h4></center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach($notificaciones as $key)
                                    @if($key->publicar=="Todos" || buscar_notificacion($residente->id,$key->id)>0)
                                    <h4>{{$key->titulo}}</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>{{$key->motivo}}</p>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach()
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border border-success rounded shadow p-3 mb-5 bg-white rounded" style="display: none;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center><h4>Noticias</h4></center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                
                                @foreach($noticias as $key)
                                    <h4>{{$key->titulo}}</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>{{$key->contenido }}</p>
                                        </div>
                                    </div>
                                    
                                    
                                @endforeach()
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        @if(count($anuncios)>0)
            @if(\Auth::user()->tipo_usuario!='Admin')
                <div class="col-md-3">
                    <div class="card anuncioRoot" style="display: none; position: absolute; margin-right: -30px;">
                            <div class="card-header">
                                <strong class="text-dark" style="font-size: 20px;">Anuncios</strong>
                            </div>
                        <div class="card-body">
                            @foreach($anuncios as $key)
                                <div onclick="window.open('{{$key->link}}', '_blank');">                                    
                                    <span class="text-dark"><strong>{{$key->titulo}}</strong></span>
                                    <img class="imagenAnun text-dark" src="{{ asset($key->url_img) }}" width="250" height="200" style="padding: 15px 15px 15px 15px; border-radius: 10%; position: relative;">
                                    <p class="text-dark" align="center">{{$key->descripcion}}</p>
                                </div>
                            @endforeach()
                        </div>
                    </div>
                </div>
            @endif
        @endif
        
    </div>

@endif


    <!-- -----------------------------------------------MODALES -------------------------------------->
    <form action="{{ route('noticias.store') }}" method="POST" name="registrar_noticia" data-parsley-validate>
        @csrf
        <div class="modal fade" id="crearNoticia" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Nueva Noticia</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="form-group">
                                    <input type="text" name="titulo" placeholder="Título" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="contenido" placeholder="Contenido" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('notificaciones.store') }}" method="POST" name="registrar_notificacion" data-parsley-validate>
        @csrf
        <div class="modal fade" id="crearNotficacion" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Nueva Notificación</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="form-group">
                                    <input type="text" name="titulo" required="required" placeholder="Título" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="motivo" required="required" placeholder="Motivo" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="checkbox" name="todos" onchange="bloquear(this)" id="todos"  data-toggle="tooltip" data-placement="top" checked="checked" title="Seleccione si desea que la notificación sea para todos" >
                                    <label for="todos">Para Todos</label>
                                    
                                    <select name="id_residente[]" disabled="disabled" id="id_residente" multiple="multiple" class="form-control select2">
                                        <option value="#" disabled="disabled">Seleccione El/Los Residente(s)</option>
                                        @foreach($residentes as $key)
                                        <option value="{{ $key->id }}"> {{ $key->apellidos }}, {{ $key->nombres }} - RUT: {{ $key->rut }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

     {!! Form::open(['route' => ['anuncios.update',1], 'enctype' => 'multipart/form-data', 'method' => 'PUT', 'name' => 'editar_anunc', 'id' => 'editar_anunc', 'data-parsley-validate']) !!}
        @csrf
        <div class="modal fade" id="editarAnuncio" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Editar anuncio</h4>                
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Título del anuncio</label>
                                    <input type="text" id="tituloAnunE" class="form-control" placeholder="Ej: Nuevos modelos de autos" name="titulo" required>
                                </div>
                            </div>
                       
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="url" id="urlAnunE" placeholder="Ej: https://www.google.co.ve/" class="form-control" name="link" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea id="descripAnunE" placeholder="Ej: ¡Con nuevos repuestos traidos desde Suiza!..." class="form-control" name="descripcion" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Imagen</label>
                                    <div id="mostrarImagenEditar" align="center"></div>
                                    <input id="imagenAnunE" type="file" class="form-control" id="example-fileinput" name="imagen">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="id_anuncio" required id="idAnuncioE">
                        <div class="float-right">
                            <button type="submit" class="btn btn-success" >Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

    <form action="{{ route('anuncios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="crearAnuncio" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Nuevo anuncio</h4>                
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist" style="background-color: #C5C5C5 !important;">
                          <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-empresa" aria-selected="true">1</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-datos" aria-selected="false">2</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-imagen" aria-selected="false">3</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="pills-pago-tab" data-toggle="pill" href="#pills-pago" role="tab" aria-controls="pills-pago" aria-selected="false">4</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <center>
                                <div class="card border border-info shadow p-3 m-4">
                                    <div class="card-body">
                                        <label for="SelectEmpresa">¿Cuál es la empresa que desea el anuncio?</label>
                                        <select class="form-control select2" name="id_empresa" required>
                                            @foreach($empresas as $key)
                                                <option value="{{$key->id}}">{{$key->nombre}} .- {{$key->rut_empresa}}</option>
                                            @endforeach()
                                        </select>
                                    </div>
                                </div>                                    
                                <div class="form-group">
                                </div>
                                <div class="card border border-info shadow p-3 m-4">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>¿Cuales administradores podrán visualizar el anuncio?</label> 
                                            <div class="">                                                                                
                                                <input type="checkbox" name="admins_todos" onchange="TodosAdmins()" id="todoAdmin"  data-toggle="tooltip" data-placement="top" title="Seleccione si desea seleccionar a todos los admins" value="1">
                                                <label for="admins_todos">Seleccionar todos</label>
                                            </div>
                                            <select name="id_admins[]" id="SelectAdminA" class="form-control select2 border border-default" multiple="multiple" >
                                                @foreach($users_admin as $key)
                                                    <option value="{{$key->id}}">{{$key->name}} - RUT: {{$key->rut}}</option>
                                                @endforeach
                                                
                                            </select>

                                            <div style="display: none">
                                                <select name="id_admins[]" id="SelectAdminA2" class="form-control select2 border border-default" multiple="multiple" style="display: none;">
                                                    @foreach($users_admin as $key)
                                                        <option value="{{$key->id}}">{{$key->name}} - RUT: {{$key->rut}}</option>
                                                    @endforeach
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>


                          </div>
                          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <center>
                                    <div class="card border border-info shadow p-3 m-4">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Título del anuncio</label>
                                                    <input type="text" class="form-control" placeholder="Ej: Nuevos modelos de autos" name="titulo" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">                                                       
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Link</label>
                                                    <input type="url" placeholder="Ej: https://www.google.co.ve/" class="form-control" name="link" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Descripción</label>
                                                    <textarea placeholder="Ej: ¡Con nuevos repuestos traidos desde Suiza!..." class="form-control" name="descripcion" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </center>
                          </div>
                          <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                              <center>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Imagen</label>
                                                <div class="alert alert-primary" role="alert">
                                                    <p><strong>Recordar que:</strong><br>
                                                    - La imagen no debe exceder los 800 KB de tamaño<br>
                                                    - La imagen no debe tener una anchura mayor a 1024 kb<br>
                                                    - La imagen no debe tener una altura mayor a 800 kb</p>
                                                </div>
                                                <input type="file" class="form-control" id="example-fileinput" name="imagen" required>
                                            </div>
                                        </div>
                                    </div>
                              </center>

                          </div>

                          <div class="tab-pane fade" id="pills-pago" role="tabpanel" aria-labelledby="pills-pago-tab">
                            <center>
                                <div class="form-group">
                                    <label>Referencia</label>
                                    <input type="text" class="form-control" name="referencia" required>
                                </div>
                                <div class="row">
                                    <?php $num=0; ?>
                                    @if(count($promociones)>0)
                                        @foreach($planesPago as $key)
                                            @foreach($promociones as $key2)
                                                @if($key->id == $key2->id_planP) 
                                                    @php $monto=$key->monto*$key2->porcentaje/100 @endphp
                                                    @php $monto2=$key->monto-$monto @endphp
                                                    @if($num==0)
                                                        <div class="col-md-6">
                                                            <div class="card shadow border card-tabla rounded" style="height: 400px; border: solid !important; border-color: #ff7043 !important;">
                                                                <div class="ribbon"><span>¡LIMITADO!</span></div>
                                                                <div class="ribbon2"><span>-{{$key2->porcentaje}}%</span></div>
                                                                <div class="card-body">
                                                                    <div class="custom-control custom-radio mb-2">
                                                                      <input type="radio" id="customRadio1" name="planP" value="{{$key->id}}" checked>
                                                                    </div>
                                                                   <h3>{{$key->nombre}}</h3>
                                                                   <span>{{$key->dias}} dias</span>
                                                                   <br>
                                                                    <span style="font-size: 30px;">$</span><span style="font-size: 50px;"><s>{{$key->monto}}</s></span><strong>/Mes</strong><br>
                                                                    <div style="margin-top: -30px !important;">
                                                                        <span style="font-size: 30px; color: #ff7043 !important;">$</span><span style="font-size: 70px; color: #ff7043 !important;">{{$monto2}}</span><strong style=" color: #ff7043 !important;">/Mes</strong>
                                                                    </div>
                                                                   <br>
                                                                   <center>
                                                                    <img align="center" class="imagenAnun3" src="{{ asset($key->url_img) }}" style="">
                                                                   </center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-md-6">
                                                            <div class="card shadow border card-tabla rounded" style="height: 400px; border: solid !important; border-color: #ff7043 !important;">
                                                                <div class="ribbon"><span>¡LIMITADO!</span></div>
                                                                <div class="ribbon2"><span>-{{$key2->porcentaje}}%</span></div>
                                                                <div class="card-body">
                                                                    <div class="custom-control custom-radio mb-2">
                                                                      <input type="radio" id="customRadio1" name="planP" value="{{$key->id}}">
                                                                    </div>
                                                                   <h3>{{$key->nombre}}</h3>
                                                                   <span>{{$key->dias}} dias</span>
                                                                   <br>
                                                                    <span style="font-size: 30px;">$</span><span style="font-size: 50px;"><s>{{$key->monto}}</s></span><strong>/Mes</strong><br>
                                                                    <div style="margin-top: -30px !important;">
                                                                        <span style="font-size: 30px; color: #ff7043 !important;">$</span><span style="font-size: 70px; color: #ff7043 !important;">{{$monto2}}</span><strong style=" color: #ff7043 !important;">/Mes</strong>
                                                                    </div>
                                                                   <br>
                                                                   <center>
                                                                    <img align="center" class="imagenAnun3" src="{{ asset($key->url_img) }}" style="">
                                                                   </center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    @if($num==0)
                                                        <div class="col-md-6">
                                                            <div class="card shadow border card-tabla rounded" style="border-color: {{$key->color}} !important; height: 400px;">
                                                                <div class="card-body">
                                                                    <div class="custom-control custom-radio mb-2">
                                                                      <input type="radio" id="customRadio1" name="planP" value="{{$key->id}}" checked>
                                                                    </div>
                                                                   <h3>{{$key->nombre}}</h3>
                                                                   <span>{{$key->dias}} dias</span>
                                                                   <br>
                                                                    <span style="font-size: 30px;">$</span><span style="font-size: 70px;">{{$key->monto}}</span><strong>/Mes</strong>
                                                                   <br>
                                                                   <center>
                                                                    <img align="center" class="imagenAnun2" src="{{ asset($key->url_img) }}">
                                                                   </center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-md-6">
                                                            <div class="card shadow border card-tabla rounded" style="border-color: {{$key->color}} !important; height: 400px;">
                                                                <div class="card-body">
                                                                    <div class="custom-control custom-radio mb-2">
                                                                      <input type="radio" id="customRadio1" name="planP" value="{{$key->id}}">
                                                                    </div>
                                                                   <h3>{{$key->nombre}}</h3>
                                                                   <span>{{$key->dias}} dias</span>
                                                                   <br>
                                                                    <span style="font-size: 30px;">$</span><span style="font-size: 70px;">{{$key->monto}}</span><strong>/Mes</strong>
                                                                   <br>
                                                                   <center>
                                                                    <img align="center" class="imagenAnun2" src="{{ asset($key->url_img) }}">
                                                                   </center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach()
                                            <?php $num++; ?>
                                        @endforeach()
                                    @else
                                        @foreach($planesPago as $key)
                                            @if($num==0)
                                                <div class="col-md-6">
                                                    <div class="card shadow border card-tabla rounded" style="border-color: {{$key->color}} !important; height: 400px;">
                                                        <div class="card-body">
                                                            <div class="custom-control custom-radio mb-2">
                                                              <input type="radio" id="customRadio1" name="planP" value="{{$key->id}}" checked>
                                                            </div>
                                                           <h3>{{$key->nombre}}</h3>
                                                           <span>{{$key->dias}} dias</span>
                                                           <br>
                                                            <span style="font-size: 30px;">$</span><span style="font-size: 70px;">{{$key->monto}}</span><strong>/Mes</strong>
                                                           <br>
                                                           <center>
                                                            <img align="center" class="imagenAnun2" src="{{ asset($key->url_img) }}">
                                                           </center>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-6">
                                                    <div class="card shadow border card-tabla rounded" style="border-color: {{$key->color}} !important; height: 400px;">
                                                        <div class="card-body">
                                                            <div class="custom-control custom-radio mb-2">
                                                              <input type="radio" id="customRadio1" name="planP" value="{{$key->id}}">
                                                            </div>
                                                           <h3>{{$key->nombre}}</h3>
                                                           <span>{{$key->dias}} dias</span>
                                                           <br>
                                                            <span style="font-size: 30px;">$</span><span style="font-size: 70px;">{{$key->monto}}</span><strong>/Mes</strong>
                                                           <br>
                                                           <center>
                                                            <img align="center" class="imagenAnun2" src="{{ asset($key->url_img) }}">
                                                           </center>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <?php $num++; ?>
                                        @endforeach()
                                    @endif
                                </div>
                            </center>
                          </div>
                        </div>
                        <center>
                            <div class="row">
                                <div class="col-md-12">
                                </div>
                            </div>
                        </center>
                        <div class="float-right">
                            <button type="submit" class="btn btn-success" >Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    {!! Form::open(['route' => ['anuncios.destroy',1033], 'method' => 'DELETE']) !!}
        @csrf
        <div class="modal fade" id="eliminarAnuncio" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Eliminar anuncio</h4>                
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3>¿Está seguro de querer eliminar el anuncio? Esta opción no se podrá deshacer</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id" required id="idAnuncio">
                                </div>
                            </div>
                        </div>

                        <div class="float-right">
                            <button type="submit" class="btn btn-danger" >Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

    





@include('root.modales.crearAdmin')
@include('root.modales.eliminarAdmin')
@include('root.modales.editarAdmin')

@endsection
<script type="text/javascript">
    function bloquear(event) {
        
        if($('input:checkbox[name=todos]').is(':checked')) { 
            console.log('chequeado');
            $('#id_residente').attr('disabled', true);
        } else {  
            console.log('no chequeado');
            $('#id_residente').removeAttr('disabled');
        }
   
    }
</script>
<script type="text/javascript">
    
</script>

@section('scripts')
    <script>
    $(function () {
      $('select').each(function () {
        $(this).select2({
          theme: 'bootstrap4',
          width: 'style',
          placeholder: $(this).attr('placeholder'),
          allowClear: Boolean($(this).data('allow-clear')),
        });
      });
    
    });
    </script>
@endsection


