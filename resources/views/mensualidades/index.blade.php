@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Mensualidades</h1>
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
        <div class="card">
            <div class="card-body">
                
                <div class="row justify-content-center">
                    @if(\Auth::user()->tipo_usuario == 'Admin')
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 offset-md-9">
                                    <a class="btn btn-success" data-toggle="modal" data-target="#crearMensualidad" style="border-radius: 30px; color: white;">
                                        <span> Nueva Mensualidad </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    
        
            <div class="col-md-12">
                

                <table class="table table-hover" id="myTable" width="100%">
                    <thead>
                        <tr>
                            <th>Inmueble</th>
                            <th>Mes</th>
                            <th>Año</th>
                            <th>Monto</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mensualidades as $key)
                            <tr>
                                <td>{{$key->inmuebles->idem}}</td>
                                <td>{{$key->mes}}</td>
                                <td>{{$key->anio}}</td>
                                <td>{{$key->monto}}</td>
                                <td>
                                    <!-- <a href="#" data-toggle="modal" onclick="Editar('{{$key->id}}','{{$key->inmuebles->id}}','{{$key->mes}}','{{$key->anio}}','{{$key->monto}}')" data-target="#editarMensualidad" class="btn btn-warning btn-sm">Editar</a> -->
                                    @if(\Auth::user()->tipo_usuario == 'Admin')
                                        <a href="#" data-toggle="modal" onclick="Eliminar('{{$key->id}}')" data-target="#eliminarMensualidad" class="btn btn-danger btn-sm">Eliminar</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach()
                    </tbody>
                </table>

            </div>
            
        </div>
        

    </div>

    <form action="{{ route('mensualidades.store') }}" method="POST" name="registrar_mensualidad" data-parsley-validate>
        @csrf
        <div class="modal fade" id="crearMensualidad" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Nueva Mensualidad 
                            <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Inmueble <b class="text-danger">*</b></label>
                                    <select type="text" name="id_inmueble" placeholder="Inmueble" class="form-control" required>
                                        @foreach($inmuebles as $key)
                                            <option value="{{$key->id}}"> {{$key->idem}} - {{$key->tipo}}</option>
                                        @endforeach()
                                    </select>
                                </div>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mes <b class="text-danger">*</b></label>
                                    <select type="text" multiple="multiple" name="mes[]" placeholder="Inmueble" class="form-control" required>
                                        <option value="" disabled="" selected="">Especifique el mes</option>
                                        <option value="1">Enero</option>
                                        <option value="2">Febrero</option>
                                        <option value="3">Marzo</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Mayo</option>
                                        <option value="6">Junio</option>
                                        <option value="7">Julio</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Año <b class="text-danger">*</b></label>
                                    <select type="text" name="anio" placeholder="Inmueble" class="form-control" required>
                                        <option value="" disabled="" selected="">Especifique el año</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Monto <b class="text-danger">*</b></label>
                                    <input type="number" name="monto" class="form-control" placeholder="Monto a especificar" required>
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

    <!-- <form method="POST">
        <div class="modal fade" id="editarMensualidad" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Editar Mensualidad</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select type="text" name="id_inmueble" placeholder="Inmueble" class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select type="text" name="mes" placeholder="Inmueble" class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select type="text" name="anio" placeholder="Inmueble" class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="number" name="monto" class="form-control" placeholder="Monto a especificar">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select type="text" name="status" placeholder="Status del Mensualidad" class="form-control">
                                    	<option value="Cancelado">Cancelado</option>
                                    	<option value="Pendiente">Pendiente</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id">
                        <button type="submit" class="btn btn-success" >Editar</button>
                    </div>
                </div>
            </div>
        </div>
    </form> -->

     {!! Form::open(['route' => ['mensualidades.destroy',1033], 'method' => 'DELETE']) !!}
        <div class="modal fade" id="eliminarMensualidad" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Eliminar Mensualidad</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h2>¡Atención!</h2>
                        <h4>¿Está realmente seguro de querer eliminar esta mensualidad?</h4>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="id">
                        <button type="submit" class="btn btn-success" >Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    

@endsection

<script type="text/javascript">
        // function Editar(id, id_inmueble, mes, año, monto) {
        //     // alert('asdasd');
        //     $('#id_e').val(id);
        //     $('#idem_e').val(idem);
        //     $('#tipo_e').val(tipo);
        //     $('#status_e').val(status);
        // }
        
    </script>
    <script type="text/javascript">

        function Eliminar(id) {
            $('#id').val(id);
        }
    </script>