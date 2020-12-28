@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Arriendos</h1>
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
                    <div class="col-md-12">
                        <label>Detalles de adquisiciones</label>
                        <select class="form-control select2" id="residente" onchange="buscarTodo(this.value)">
                            <option value="0">Seleccione residente</option>
                            @foreach($residentes as $key)
                                <option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}} - {{$key->rut}}</option>
                            @endforeach()
                        </select>
                    </div>
                    
                </div>
            </div>
        </div>
        <div id="mensaje"></div>
        <div class="row">
            <div class="col-lg-3">
                <div id="MuestraResidente"></div>
            </div>
            <div class="col-lg-9">
                <div id="MuestraAsigna" style="display: none;">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-activity-tab" data-toggle="pill" href="#pills-activity" role="tab" aria-controls="pills-activity" aria-selected="true">
                                        Inmuebles
                                    </a>
                                    

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-projects-tab" data-toggle="pill" href="#pills-projects" role="tab" aria-controls="pills-projects" aria-selected="false">
                                        Estacionamientos
                                    </a>
                                    

                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade active show" id="pills-activity" role="tabpanel" aria-labelledby="pills-activity-tab">
                                    <a href="#" class="btn btn-sm btn-rounded btn-success" onclick="NuevoAsignaInm()">Nuevo</a>
                                    <br><br>
                                    <div id="VerInmuebles"></div>
                                </div>


                                <div class="tab-pane fade" id="pills-projects" role="tabpanel" aria-labelledby="pills-projects-tab">

                                    <a href="#" class="btn btn-sm btn-rounded btn-success" onclick="NuevoAsignaEst()">Nuevo</a>
                                    <br><br>
                                    <div id="VerEstacionamientos"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <form action="{{ route('arriendos.asignando') }}" method="POST" name="registrar_Arriendo" data-parsley-validate>
            @csrf
            <div class="modal fade" id="modalInmueble" role="dialog">
                <div class="modal-dialog modals-default">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Asignar nuevo inmueble</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <center>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <label><b>Seleccione un/unos Inmueble(s)</b></label><br>
                                            <div class="dropdown bootstrap-select show-tick show">
                                            <select name="id_inmueble[]" class="form-control select2" required="required" title="Seleccione un Inmueble" multiple="multiple">
                                                @foreach($inmuebles as $key)
                                                    <option value="{{$key->id}}">{{$key->idem}}</option>
                                                @endforeach()
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_residente" id="id_residente">
                            <input type="hidden" name="opcion" value="inmueble">
                            <button type="submit" class="btn btn-sm btn-rounded btn-success">Nuevo</i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="{{ route('arriendos.asignando') }}" method="POST" name="registrar_Arriendo" data-parsley-validate>
            @csrf
            <div class="modal fade" id="modalEsta" role="dialog">
                <div class="modal-dialog modals-default">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Asignar nuevo estacionamiento</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <center>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="id_estacionamiento[]" class="form-control" required="required" title="Seleccione un Estacionamiento" multiple="multiple">
                                                @foreach($estacionamientos as $key)
                                                    <option value="{{$key->id}}">{{$key->idem}}</option>
                                                @endforeach()
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_residente" id="id_residente2">
                            <input type="hidden" name="opcion" value="estacionacionamiento">
                            <button type="submit" class="btn btn-sm btn-rounded btn-success">Nuevo</i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

            
            
    </div>

<form action="{{ route('residentes.store') }}" method="POST" name="registrar_Arriendo" data-parsley-validate>
    @csrf
    <div class="modal fade" id="crearArriendo" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nuevo Arriendo</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="form-group">
                                    <input type="text" name="nombres" placeholder="Nombres del Arriendo" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="apellidos" placeholder="Apellidos del Arriendo" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="number" name="rut" placeholder="Rut del Arriendo" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="number" name="telefono" placeholder="Teléfono del Arriendo" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email del Arriendo" class="form-control">
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection


<script type="text/javascript">
    function NuevoAsignaInm() {
        $('#modalInmueble').modal('show');
    }


    function NuevoAsignaEst() {
        $('#modalEsta').modal('show');
    }


    function buscarTodo(id_residente) {
        $('#MuestraResidente').empty();
        $('#MuestraAsigna').css('display','none');
        $('#id_residente').val(id_residente);
        $('#id_residente2').val(id_residente);

        $.get('arriendos/'+id_residente+'/buscar_residente', function(data) {

            beforeSend: $('#mensaje').append('Cargando...');
            complete: $('#mensaje').empty();

            if (data.length > 0) {
                console.log('trae');
                $('#MuestraResidente').append(
                    '<div class="card">'+
                        '<div class="card-body">'+
                            '<div class="text-center mt-3">'+
                                '<img src="assets/images/logo.jpg" alt="" class="avatar-lg rounded-circle">'+
                                '<h5 class="mt-2 mb-0">'+data[0].nombres+' '+data[0].apellidos+'</h5>'+
                                '<h6 class="text-muted font-weight-normal mt-2 mb-0">Residente regular</h6>'+
                                '<h6 class="text-muted font-weight-normal mt-1 mb-4">Chile</h6>'+

                                // <button type="button" class="btn btn-primary btn-sm mr-1">Follow</button>
                                // <button type="button" class="btn btn-white btn-sm">Message</button>
                            '</div>'+

                            '<div class="mt-5 pt-2 border-top">'+
                                '<h4 class="mb-3 font-size-15">Servicios adquiridos</h4>'+
                                '<p class="text-muted mb-4">Estacionamientos</p>'+
                            '</div>'+
                            '<div class="mt-3 pt-2 border-top">'+
                                '<h4 class="mb-3 font-size-15">Información de contacto</h4>'+
                                '<div class="table-responsive">'+
                                    '<table class="table table-borderless mb-0 text-muted">'+
                                        '<tbody>'+
                                            '<tr>'+
                                                '<th scope="row">Email</th>'+
                                                '<td>'+data[0].email+'</td>'+
                                            '</tr>'+
                                            '<tr>'+
                                                '<th scope="row">Teléfono</th>'+
                                                '<td>'+data[0].telefono+'</td>'+
                                            '</tr>'+
                                        '</tbody>'+
                                    '</table>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
                );

                $('#MuestraAsigna').css('display','block');
                inmueble(id_residente);
                estacionamientos(id_residente);
                



            }else{
                $('#MuestraResidente').empty();
                $('#MuestraAsigna').css('display','none');
                console.log('no trae');
            }
        });
    }

    function inmueble(id_residente) {

        $('#VerInmuebles').empty();
        $.get('arriendos/'+id_residente+'/buscar_inmuebles', function(data) {
            if (data.length > 0) {
                $('#VerInmuebles').append('<div class="table-responsive">'+
                    '<table id="tablaMuestraInm" class="table table-striped mb-0">'+
                        '<thead>'+
                            '<tr>'+
                            '<th scope="col">#</th>'+
                            '<th scope="col">Idem</th>'+
                            '</tr>'+
                        '</thead>'+
                    '</table>'+
                '</div>');

                for (var i = 0; i < data.length; i++) {
                    var n=i+1;
                    $('#tablaMuestraInm').append(
                        '<tbody>'+
                            '<tr>'+
                            '<th scope="row">'+n+'</th>'+
                            '<td>'+data[i].idem+'</td>'+
                            '</tr>'+
                        '</tbody>'
                    );
                }
            }else{
                $('#VerInmuebles').append('<h3>No tiene inmuebles asignados</h3>');
            }
        });
    }

    function estacionamientos(id_residente) {

        $('#VerEstacionamientos').empty();
        $.get('arriendos/'+id_residente+'/buscar_estacionamientos', function(data) {
            if (data.length > 0) {
                $('#VerEstacionamientos').append('<div class="table-responsive">'+
                    '<table id="tablaMuestraEsta" class="table table-striped mb-0">'+
                        '<thead>'+
                            '<tr>'+
                            '<th scope="col">#</th>'+
                            '<th scope="col">Idem</th>'+
                            '</tr>'+
                        '</thead>'+
                    '</table>'+
                '</div>');

                for (var i = 0; i < data.length; i++) {
                    var n=i+1;
                    $('#tablaMuestraEsta').append(
                        '<tbody>'+
                            '<tr>'+
                            '<th scope="row">'+n+'</th>'+
                            '<td>'+data[i].idem+'</td>'+
                            '</tr>'+
                        '</tbody>'
                    );
                }
            }else{
                $('#VerEstacionamientos').append('<h3>No tiene estacionamientos asignados</h3>');
            }
        });
    }
</script>