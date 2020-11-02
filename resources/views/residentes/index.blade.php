@extends('layouts.app')

@section('content')

    <style type="text/css">
        .card {
            border: 1px solid #f6f6f7!important;
            border-color: #2d572c !important;
        }
        .palabraVerInmueble2, .palabraVerEstaciona2,.PalabraEditarPago2, .tituloTabla2
        {
            display: none;
        }
        @media only screen and (max-width: 800px)  {

            .PalabraEditarPago, .PalabraRealizarPago, .PalabraPagoConfirmar{
                display: none;
            }
            .palabraVerInmueble{
                display: none;
            }
            .palabraVerInmueble2{
                display: block;
            }
            .palabraVerEstaciona{
                display: none;
            }
            .palabraVerEstaciona2{
                display: block;
            }
            .PalabraEditarPago2{
                display: block;
            }
            .iconosMetaforas{
                display: none;    
            }
            .card-table{
                width: 100%
            }

        }
        @media only screen and (max-width: 200px)  {
            .botonesEditEli{
                width: 15px;
                height: 15px;
            }
            .iconosMetaforas2{
                width: 5px;
                height: 5px;    
            }
        }
        @media screen and (max-width: 480px) {
            .tituloTabla{
                display: none;
            }
            .tituloTabla2{
                display: block;
            }
            .iconosMetaforas2{
                width: 15px;
                height: 15px;    
            }
            .botonesEditEli{
                width: 30px;
                height: 30px;
                margin-top: 5px;
                    
            }
        }


    </style>
    <div class="container">
        <input type="hidden" id="colorView" value="#2d572c !important">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Residentes</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Residentes</h4>
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
    <div class="card rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
            <div class="row justify-content-center">
                @if(\Auth::user()->tipo_usuario == 'Admin')
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 offset-md-12">
                                <a class="btn btn-success shadow" onclick="NuevoResidente()" style="
                                    border-radius: 10px;
                                    color: white;
                                    height: 35px;
                                    margin-bottom: 5px;
                                    margin-top: 5px;
                                    float: right;
                                    border: 1px solid #f6f6f7!important;
                                    border-color: #2d572c !important;
                                    background-color: #2d572c !important;">

                                    <span class="PalabraEditarPago">Nuevo Residente</span>
                                    <center>
                                        <span class="PalabraEditarPago2">
                                            <i data-feather="plus" class="iconosMetaforas2"></i>
                                        </span>
                                    </center>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                
    
            <div class="col-md-12">
                
                <table class="table dataTable data-table-basic table-curved table-striped tabla-estilo" id="tablaResidentes" style="width: 100%;">
                    <thead>
                        <tr class="table-default text-white">
                            <td colspan="5" align="center">
                                <div class="card border border-info" style="" role="alert">
                                    <span class="text-dark p-1 mb-1"><strong>Aviso: </strong><br>-Seleccione a un residente para ver mas opciones.</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="text-white" id="th1" style="background-color: #2d572c !important;">
                            <th width="10">#</th>
                            <th>
                                <span class="PalabraEditarPago">Nombres</span>
                                <span class="PalabraEditarPago2">N</span>
                            </th>
                            <th>
                                <span class="PalabraEditarPago">Rut</span>
                                <span class="PalabraEditarPago2">R</span>
                            </th>
                            <th>
                                <span class="PalabraEditarPago">Correo</span>
                                <span class="PalabraEditarPago2">@</span>
                            </th>
                            <th>
                                <span class="PalabraEditarPago">Teléfono</span>
                                <span class="PalabraEditarPago2">Tel</span>
                            </th>
                        </tr>
                        <tr class="bg-primary text-white" id="th2" style="display: none">
                            <th width="10"></th>
                            <th>
                                <span class="PalabraEditarPago">Nombres</span>
                                <span class="PalabraEditarPago2">N</span>
                            </th>
                            <th>
                                <span class="PalabraEditarPago">Opciones</span>
                                <span class="PalabraEditarPago2">O</span>
                            </th>
                            <th>
                                <span class="PalabraEditarPago">Inmuebles</span>
                                <span class="PalabraEditarPago2">I</span>
                            </th>
                            <th>
                                <span class="PalabraEditarPago">Estacionamientos</span>
                                <span class="PalabraEditarPago2">E</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $num=0 @endphp
                        @foreach($residentes as $key)
                            <tr id="vista1-{{$key->id}}" onclick="opcionesTabla(1,'{{$key->id}}')">
                                <td align="center">{{$num=$num+1}}</td>
                                <td>{{$key->nombres}} {{$key->apellidos}}</td>
                                <td>{{$key->rut}}</td>
                                <td>{{$key->usuario->email}}</td>
                                <td>{{$key->telefono}}</td>
                            </tr>
                            <tr id="vista2-{{$key->id}}" class="table-success" style="display: none;">
                                <td width="10">
                                    <button class="btn btn-success btn-sm boton-tabla shadow botonesEditEli" onclick="opcionesTabla(2,'{{$key->id}}')">
                                        <span class="PalabraEditarPago ">Regresar</span>
                                        <center>
                                            <span class="PalabraEditarPago2 ">
                                                <i data-feather="arrow-left" class="iconosMetaforas2"></i>
                                            </span>
                                        </center>
                                    </button>
                                </td>
                                <td>
                                    
                                    <span>{{$key->nombres}} {{$key->apellidos}}</span>
                                </td>
                                <td align="center">
                                    @if(\Auth::user()->tipo_usuario == 'Admin')
                                        <a href="#" data-toggle="modal" data-target="#editarResidente" class="btn btn-warning btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px; width: auto;" onclick="Editar('{{$key->id}}','{{$key->nombres}}','{{$key->apellidos}}','{{$key->rut}}','{{$key->telefono}}','{{$key->usuario->email}}')">
                                            <span class="PalabraEditarPago ">Editar</span>
                                            <center>
                                                <span class="PalabraEditarPago2 ">
                                                    <i data-feather="edit" class="iconosMetaforas2"></i>
                                                </span>
                                            </center>
                                        </a>

                                        <a href="#" data-toggle="modal" data-target="#eliminarResidente" class="btn btn-danger btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px; width: auto;" onclick="Eliminar('{{$key->id}}')">
                                            <span class="PalabraEditarPago ">Eliminar</span>
                                            <center>
                                                <span class="PalabraEditarPago2 ">
                                                    <i data-feather="trash" class="iconosMetaforas2"></i>
                                                </span>
                                            </center>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <?php $j=0; ?>
                                    @foreach($key->inmuebles as $key2)
                                        @if($key2->pivot->status=="En Uso")
                                        <span class="text-primary"><strong>{{$j=$j+1}}.-{{$key2->idem}}</strong></span><br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <?php $k=0; ?>
                                    @foreach($key->estacionamientos as $key2)
                                        @if($key2->pivot->status=="En Uso")
                                        <span class="text-warning"><strong>{{$k=$k+1}}.-{{$key2->idem}}</strong></span><br>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr style="display: none;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach()
                    </tbody>
                </table>
            </div>
    </div>
        






    

            @include('residentes.layouts.delete')
            @include('residentes.layouts.edit')
            @include('residentes.layouts.borrar_asignacion')
    </div>

@endsection

<script type="text/javascript">
        function Editar(id,nombres,apellidos,rut,telefono,email,id_usuario) {
            $('#id_e').val(id);
            $('#nombres_e').val(nombres);
            $('#apellidos_e').val(apellidos);
            $('#rut_e').val(rut.substr(0,(rut.length-2)));
            $('#verificador_e').val(rut.substr(-1,(rut.length)));
            $('#telefono_e').val(telefono);
            $('#email_e').val(email);
        }

        function borrarA(id_residente, id_inmueble, id_estacionamiento) {
        $('#BorrarAsignacion').modal('show');

        $('#id_residenteBorrar').empty();
        $('#id_estacionamientoBorrar').empty();
        $('#id_inmuebleBorrar').empty();

        $('#id_residenteBorrar').val(id_residente);
        $('#id_estacionamientoBorrar').val(id_estacionamiento);
        $('#id_inmuebleBorrar').val(id_inmueble);
    }
        
        
    </script>
    <script type="text/javascript">

        function Eliminar(id) {
            $('#id').val(id);
        }
    </script>