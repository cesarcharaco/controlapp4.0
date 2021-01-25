@extends('layouts.app')

@section('content')

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
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
<div class="card rounded card-tabla shadow p-3 mb-5 bg-white rounded">
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
                        background-color: #2d572c !important;" data-toggle="tooltip" data-placement="top" title="Seleccione para registrar a un residente nuevo">

                        <span><i data-feather="plus"></i>Nuevo Residente</span>
                    </a>
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-12">                
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                <table id="example1" class="table table-bordered table-hover table-striped dataTable" style="width: 100% !important;">
                    <thead>
                        <tr class="text-white" style="background-color: #2d572c !important;">
                            <th width="10">#</th>
                            <th>Nombres</th>
                            <th>Rut</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Inmuebles</th>
                            <th>Estacionamientos</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $num=0 @endphp
                        @foreach($residentes as $key)
                            <tr>
                                <td align="center">{{$num=$num+1}}</td>
                                <td>{{$key->nombres}} {{$key->apellidos}}</td>
                                <td>{{$key->rut}}</td>
                                <td>{{$key->usuario->email}}</td>
                                <td>{{$key->telefono}}</td>
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
                                <td align="center">
                                    @if(\Auth::user()->tipo_usuario == 'Admin')
                                        <a href="#" data-toggle="modal" data-target="#editarResidente" class="btn btn-warning btn-sm boton-tabla shadow" style="border-radius: 5px; width: auto;" onclick="Editar('{{$key->id}}','{{$key->nombres}}','{{$key->apellidos}}','{{$key->rut}}','{{$key->telefono}}','{{$key->usuario->email}}')">
                                            <span data-toggle="tooltip" data-placement="top" title="Seleccione para editar datos">
                                                <i data-feather="edit"></i>Editar
                                            </span>
                                                    
                                        </a>
                                        @if($key->usuario->tipo_usuario != "Admin")
                                        <a href="#" data-toggle="modal" data-target="#eliminarResidente" class="btn btn-danger btn-sm boton-tabla shadow" style="border-radius: 5px; width: auto;" onclick="Eliminar('{{$key->id}}')">
                                            <span data-toggle="tooltip" data-placement="top" title="Seleccione para eliminar residente">
                                                <i data-feather="trash"></i>Eliminar
                                            </span>
                                        </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach()
                    </tbody>
                </table>
            </thead>
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