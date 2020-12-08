@extends('layouts.app')


@section('content')
    <div class="container">
        <input type="hidden" id="colorView" value="#25c2e3 !important">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pagos</li>
                        <li class="breadcrumb-item active" aria-current="page">Pagos comunes</li>
                    </ol>
                </nav>
                <span>
                    <h4 class="mb-1 mt-0">Pagos - Pagos comunes</h4>
                </span>
            </div>
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
            
        
            @if(\Auth::user()->tipo_usuario == 'Admin')
                <div class="card border border-info rounded card-tabla shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                            <table id="example1" class="table table-bordered table-hover table-striped dataTable display nowrap" cellspacing="0" style="width: 100% !important;">
                                <thead>
                                    <tr class="bg-info text-white">
                                        <th>Nombres</th>
                                        <th>RUT</th>
                                        <th>Asignaciones</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($residentes as $key)
                                        <tr>
                                            <td align="center">
                                                <div class="form-group">
                                                    {{$key->nombres}} {{$key->apellidos}}
                                                    <br>
                                                </div>
                                            </td>
                                            <td>
                                                {{$key->rut}}
                                            </td>
                                            <td align="center">
                                                @foreach($asignaIn as $key2)
                                                    @if($key2->id_residente == $key->id)
                                                        <a data-toggle="tooltip" data-placement="top" title="Inmuebles asignados al residente" style="
                                                            background-color: #CB8C4D !important;" class="btn btn-sm shadow" onclick="VerResi('{{$key2->id_residente}}')" href="#">
                                                            <i data-feather="home" class="clipboard"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                                <a data-toggle="tooltip" data-placement="top" title="Consultar los pagos comunes realizados del residente" href="{{ url('pagos/'.$key->id.'/consultas')}}" class="btn btn-danger btn-sm shadow">
                                                    <i data-feather="clipboard" class="clipboard"></i>
                                                </a>
                                                <br><br>
                                                @foreach($asignaEs as $key2)
                                                    @if($key2->id_residente == $key->id)
                                                        <a data-toggle="tooltip" data-placement="top" title="Estacionamientos asignados al residente" style="background-color: #cccc00 !important;" class="btn btn-sm shadow" onclick="VerEstacionamientos('{{$key2->id_residente}}')" href="#">
                                                                <i data-feather="truck" class="clipboard"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                                                                         
                                            </td>
                                            <td align="center">
                                                @php $cuenta=0; @endphp
                                                @foreach($asignaIn as $key2)
                                                    @if($key2->id_residente == $key->id)
                                                        @if($cuenta==0)

                                                            <div class="row justify-content-center">
                                                                <div style="margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="Editar pagos realizados por el residente" class="dropdown align-self-center profile-dropdown-menu">
                                                                    
                                                                    <a href="#" class="dropdown-toggle mr-0 btn btn-sm btn-warning shadow" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false"> 
                                                                        <i data-feather="edit"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu profile-dropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">


                                                                        <a href="#" class="dropdown-item notify-item" onclick="EditarPago('{{$key->id}}',1)" >
                                                                            <span class="text-primary">Pago Común</span>
                                                                        </a>

                                                                        <a href="#" class="dropdown-item notify-item" onclick="EditarPago('{{$key->id}}',3)" >
                                                                            <span class="text-danger">Multas</span>
                                                                        </a>

                                                                    </div>
                                                                </div>
                                                                <a style="margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="Seleccione para realizar un pago común" href="#" onclick="BMesesResidente('{{$key->id}}')" class=" btn btn-sm btn-success shadow">
                                                                    <i data-feather="dollar-sign"></i>
                                                                </a>
                                                                <a data-toggle="tooltip" data-placement="top" title="Ver pagos por confirmar del residente" href="#" class="btn btn btn-info btn-sm shadow" onclick="pagosPorComprobar('{{$key->id}}')">
                                                                    <i data-feather="eye"></i>
                                                                </a>
                                                            </div>   
                                                            @php $cuenta++; @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @foreach($asignaEs as $key2)
                                                        @if($key2->id_residente == $key->id)
                                                            @if($cuenta==0) 
                                                                <div class="dropdown align-self-center profile-dropdown-menu">
                                                                    
                                                                    <a style="border-radius: 5px; width: 100%;" href="#" class="dropdown-toggle mr-0 btn btn-sm btn-warning"data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> 
                                                                    <span style="position: relative;">
                                                                        <i data-feather="edit" style="float:left;"></i>Editar Pago
                                                                    </span>
                                                                    </a>

                                                                    <div class="dropdown-menu profile-dropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">


                                                                        <a href="#" class="dropdown-item notify-item" onclick="EditarPago('{{$key->id}}',1)" >
                                                                            <span class="text-primary">Pago común</span>
                                                                        </a>

                                                                        <!-- <a href="#" class="dropdown-item notify-item" onclick="EditarPago('{{$key->id}}',2)" >
                                                                            <span class="text-warning">Estacionamientos</span>
                                                                        </a> -->

                                                                        <a href="#" class="dropdown-item notify-item" onclick="EditarPago('{{$key->id}}',3)" >
                                                                            <span class="text-danger">Multas</span>
                                                                        </a>

                                                                        
                                                                        <!-- <div class="dropdown-divider"></div> -->

                                                                    </div>
                                                                </div>
                                                                <br>


                                                                <a style="border-radius: 5px; width: 100%;" href="#" onclick="BMesesResidente('{{$key->id}}')" class=" btn btn-sm btn-success"> 
                                                                    <i data-feather="dollar-sign" style="float:left;"></i>
                                                                    <span>Realizar Pago</span>
                                                                </a>

                                                                <br><br>
                                                                <center><a href="#" class="btn btn btn-info btn-sm" style="border-radius: 5px; width: 100%" onclick="pagosPorComprobar('{{$key->id}}')">
                                                                    <i data-feather="eye" style="float:left;"></i>
                                                                    <span>Pagos por Confirmar</span>
                                                                </a></center>
                                                                @php $cuenta++; @endphp
                                                            @endif
                                                        @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach()
                                </tbody>
                                </table>
                        </thead>
                    </div>
                </div>
            @endif

    </div>
</div>
</div>

        <div class="card" id="VerFomulario" style="display: none" >
            <div class="card-header">
                <button type="button" class="close" onclick="
                    $('#VerFomulario').fadeOut('slow',
                        function() { 
                            $('#VerFomulario').hide();
                            $('#ElCarrousel').fadeIn(300);
                    });">
                    <span>&times;</span>
                </button>
            </div>
           {!! Form::open(['route' => ['pagos.store'],'method' => 'POST', 'name' => 'registrarPago', 'id' => 'registrar_pago', 'data-parsley-validate']) !!}
                @csrf
            <div class="card-body">
                <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><div class="text-primary">Inmuebles</div></label>
                            <select class="form-control select2" id="mis_inmuebles" name="inmuebles[]" onchange="montoTotalI(this.value)" data-plugin="multiselect" data-selectable-optgroup="true" disabled>
                                <option value="0" selected disabled>Seleccione</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><div class="text-warning">Estacionamientos</div></label>
                            <select class="form-control select2" id="mis_estacionamientos" name="estacionamientos[]" onchange="montoTotalE(this.value)" data-plugin="multiselect" data-selectable-optgroup="true" disabled>
                                <option value="0" selected disabled>Seleccione</option>
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <div id="spinner" style="display: none;">
                            <div class="spinner-border text-warning m-2" role="status" id="cargando_E">
                                <span class="sr-only">Cargando multas y recargas...</span>
                            </div>
                            <p>Cargando multas y recargas...</p>
                        </div>
                        <p id="ResidenteTieneMultas" style="display: none;">El residente no posee multas ni recargas</p>
                    </div>
                </div>
                
                    <div class="row" id="mis_mr">
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label><div class="text-danger">Multas</div><div class="text-success">Recargas</div></label>
                                <br>
                                <select name="id_mr[]" class="form-control selct2" id="mr" onchange="montoTotalM(this.value)" disabled>
                                    <option value="0" selected disabled>Seleccione</option>
                                    
                                </select>
                                {{-- <font style="vertical-align: inherit; color: red">Multa 1 - 9999$</font><br> --}}
                                
                            </div>
                        </div> -->
                        <div class="col-md-12">
                            <table id="mrSeleccionado" class="data-table-basic" style="width: 100%; table-layout: auto;" alt="Max-width 100%">
                                
                            </table>
                        </div>
                    </div>
                
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Total a pagar</label>
                            <center style="color: grey; font-size: 100px; width:100%; font-size: 10vw;">$<span id="TotalPag">0</span></center>
                            <input type="hidden" name="total" id="total" value="0">
                        </div>
                    </div>
                </div>
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Rereferencias <b class="text-danger">*</b></label>
                                <input type="text" required="required" name="referencia" max="20" maxlength="20" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                            
                            <div style="display: none">
                                <input type="hidden" name="id_residente" id="verF">
                                <select class="form-control" name="id_mensInmueble[]" id="id_mensInmuebleR" multiple></select>
                                <select class="form-control" name="id_mensEstaciona[]" id="id_mensEstacionaR" multiple></select>
                                <select class="form-control" name="id_mensMulta[]" id="id_mensMultaR" multiple></select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-rounded">Aceptar</button>
                    </div>
                {!! Form::close() !!}

                
                
            </div>
        </div>
    </div>

    <!-- <form method="POST">
        <div class="modal fade" id="crearPago" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Nuevo Pago</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select type="text" name="id_mensualidad" placeholder="Mensualidad" class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-bottom">
                        <button type="submit" class="btn btn-success" id="botonG" disabled>Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form> -->

     {!! Form::open(['route' => ['pagos.update',1],'method' => 'PUT', 'name' => 'editarPago', 'id' => 'editar_pago', 'data-parsley-validate']) !!}
                @csrf
        <div class="modal fade" id="editar_p" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="titleE"></h4>
                        <!-- <div class="spinner-border text-warning m-2" role="status" id="cargando_E">
                            <span class="sr-only">Cargando...</span>
                        </div> -->
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class=" col-form-label" for="example-static">Referencia con la que se registró el pago</label>
                                        <input type="text" name="referencia_edit" data-toggle="tooltip" data-placement="top" title="Ingrese la referencia con la que se registró el pago" placeholder="Ej: 12345678" class="form-control" required="required" max="20" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            
                            <div id="MuestraEstacionamiento2" style="display: none;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="Cancelado">Cancelado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label data-toggle="tooltip" data-placement="top" title="Seleccione el año al cual corresponde el pago" class=" col-form-label" for="example-static">Año de pago</label>
                                        <select   class="form-control select2" name="anio" id="anio" onchange="BuscarEditar(this.value)" >
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            

                            <div id="MuestraInmueble">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label data-toggle="tooltip" data-placement="top" title="Seleccione el mes que desea colocar como pendiente, de acuerdo al inmueble" class="text-primary col-form-label" for="example-static">Meses</label>
                                            <select   class="border border-primary form-control select2" name="id_inmueble" id="id_inmuebleEditar" disabled>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="MuestraEstacionamiento">
                                <div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label data-toggle="tooltip" data-placement="top" title="Seleccione el mes que desea colocar como pendient, de acuerdo al estacionamiento" class="text-warning col-form-label" for="example-static">Estacionamientos</label>
                                            <select   class="border border-warning form-control select2" name="id_estacionamiento" id="id_estacionamientoEditar" disabled>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="MuestraMulta">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label   data-toggle="tooltip" data-placement="top" title="Seleccione la Multa o Recarga que desea colocar como pendiente" class="text-success col-form-label" for="example-static">Multas - Recargas</label>
                                            <select class="border border-success form-control select2" name="id_multa" id="id_multaEditar" disabled>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="opcion" id="opcion">
                        <input type="hidden" name="id_residente_edit" id="id_residente_edit">
                        <button type="submit" class="btn btn-success" >Editar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form method="POST">
        <div class="modal fade" id="eliminarPago" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Eliminar Pago</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h2>¡Atención!</h2>
                        <h4>¿Está realmente seguro de querer eliminar este Pago?</h4>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id">
                        <button type="submit" class="btn btn-success" >Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <!--   -------------------------------------------------------------- RESIDENCIAS   -->

    

    <!--   -------------------------------------------------------------- ESTACIONAMIENTOS   -->

    <div class="modal fade" id="VerEsta" role="dialog">
            <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <center>
                            <h4>Sus <span class="titleModal"></span></h4>
                            <div class="cargandoArriendos" style="display: none;">
                                <div class="spinner-border text-warning m-2" role="status" id="cargando_E">
                                    <span class="sr-only">Cargando <span class="titleModal"></span>...</span>
                                </div>
                                <p>Cargando <span class="titleModal"></span>...</p>
                            </div>
                        </center>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div id="VerEstaFade" style="display: none">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                  <div class="carousel-inner">
                                    
                                  </div>
                                  <a class="carousel-control-prev" style="margin-left: -100px;" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="carousel-control-next" style="margin-right: -100px;" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {!! Form::open(['route' => ['pagos.store'],'method' => 'POST', 'name' => 'registrarPago', 'id' => 'registrar_pago', 'data-parsley-validate']) !!}
        <div class="modal fade" id="PagoConfir" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Pagos por Confirmar del Residente <span id="nombreResidente"></span></h4>
                        <div id="CargandoPagosComprobar" style="display: none;">
                            <div class="spinner-border text-warning m-2" role="status">
                                <!-- <span class="sr-only">Cargando multas y recargas...</span> -->
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="muestraMesesAComprob">
                                                            
                        </div>
                        <div id="muestraMesesAComprob2">
                                                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning" >Confirmar</button>  
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}


@endsection

<script type="text/javascript">

    function mostrarFormulario(id_residente) {

        $('#mis_inmuebles').empty().append('<option selected disabled>Seleccione los inmuebles</option');
        $('#mis_estacionamientos').empty().append('<option selected disabled>Seleccione los estacionamientos</option');
        $('#mr').empty().append('<option selected disabled>Seleccione las Multas - Recargas</option');
        $('#TotalPagar').html(parseInt(0));
        $('#mrSeleccionado').empty();
        $('#mrSeleccionado').append(
            '<thead>'+
                '<th>Inmuebles</th>'+
                '<th>Estacionamientos</th>'+
                '<th>Multa</th>'+
                '<th>Recarga</th>'+
                '<th>Acción</th>'+
            '</thead>'+
            '<tbody>'+
                
            '</tbody>'
        );
        $('#id_mensInmuebleR').empty();
        $('#id_mensEstacionaR').empty();
        $('#id_mensMultaR').empty();

        $('#ElCarrousel').fadeOut('slow',
            function() { 
                $('#carrousel').hide();
                $('#VerFomulario').fadeIn(300);
        });

        $('#verF').val(id_residente);
        // $('#VerFomulario').css('display','block');

        mostrar_datos(id_residente);
        mostrar_datos2(id_residente);
        mis_mr(id_residente);
        // $('#spinner').css('display', 'none');
    }


    function EditarPago(id_residente, opcion) {
        //console.log('editar pago');
        $('#MuestraEstacionamiento2').css('display','none');
        $('#verF').val(id_residente);
        $('#editar_p').modal('show');
        $('#MuestraInmueble').hide();
        $('#MuestraEstacionamiento').hide();
        $('#MuestraMulta').hide();

        $('#id_inmuebleEditar').empty();
        $('#id_estacionamientoEditar').empty();
        $('#id_multaEditar').empty();

        $('#anio').empty();
        // $('#anio').append('<option selected disabled value="0">Seleccione año</option');


        // $('#id_añoE').append('<option></option>');

        $("#id_residente_edit").val(id_residente);
        if (opcion == 1) {
            $('#opcion').val(1);
            // $('#titleE').text('Editar pago de Inmuebles');
            $('#titleE').text('Editar pago común');
            $('#MuestraInmueble').show();
            //console.log(id_residente);
            $.get("inmuebles/"+id_residente+"/buscar_anios",function (data) {
            })
            .done(function(data) {
                    //console.log(data.length);
                    if (data.length>0) {
                        // $("#anio").empty();
                        $("#anio").append('<option value="0">Seleccione el año</option>');
                        for (var i = 0; i < data.length ; i++) {
                            
                            $("#anio").append('<option value="'+data[i].anio+'">'+data[i].anio+'</option>');
                        }
                    }
            });
        }

        if (opcion == 2) {
            $('#MuestraEstacionamiento2').css('display','block');
            $('#opcion').val(2);
            $('#titleE').text('Editar pago de Estacionamientos');
            $('#MuestraEstacionamiento').show();
            $.get("estacionamientos/"+id_residente+"/buscar_anios",function (data) {
            })
            .done(function(data) {
                    //console.log(data.length);
                    if (data.length>0) {
                        $("#anio").empty();
                        $("#anio").append('<option value="0">Seleccione el año</option>');
                        for (var i = 0; i < data.length ; i++) {
                            
                            $("#anio").append('<option value="'+data[i].anio+'">'+data[i].anio+'</option>');
                        }
                    }
            });
        }

        if (opcion == 3) {
            $('#opcion').val(3);
            $('#titleE').text('Editar pago con Multas y Recargas');
            $('#MuestraMulta').show();
            $.get("mr/"+id_residente+"/buscar_anios",function (data) {
            })
            .done(function(data) {
                    //console.log(data.length);
                    if (data.length>0) {
                        $("#anio").empty();
                        $("#anio").append('<option value="0">Seleccione el año</option>');
                        for (var i = 0; i < data.length ; i++) {
                            
                            $("#anio").append('<option value="'+data[i].anio+'">'+data[i].anio+'</option>');
                        }
                    }
            });
        }

    }

    function BuscarEditar(anio) {

            var id_residente =$('#verF').val();
            $('#id_inmuebleEditar').empty();
            $('#id_estacionamientoEditar').empty();
            $("#id_multaEditar").empty();

            $.get("inmuebles/"+id_residente+"/"+anio+"/buscar_inmuebles",function (data) {
                if (data.length>0) {
                    
                    $('#id_inmuebleEditar').append('<option selected disabled>Seleccione los meses</option>');
                    for(i=0 ; i<data.length ; i++){
                        // $('#id_inmuebleEditar').append(
                            inmuebles_meses_editar(data[i].id)
                        // );

                    }
                }else{
                        $('#id_inmuebleEditar').append('<option>El residente no tiene pagos cancelados en los inmuebles</option>');
                }
            })
            .done(function(data) {
                
            });


            //console.log('holaaa');
            $.get("estacionamientos/"+id_residente+"/"+anio+"/buscar_estacionamientos",function (data) {
                if (data.length>0) {
                        $('#id_estacionamientoEditar').removeAttr('disabled',false);
                        $('#id_estacionamientoEditar').append('<option selected disabled>Seleccione los meses</option>');
                    for(i=0 ; i<data.length ; i++){
                        $('#id_estacionamientoEditar').append(
                            '<optgroup label="'+data[i].idem+'" id="id_estacionamientoEditar'+data[i].id+'">'+estacionamientos_meses_editar(data[i].id)+'</optgroup>'
                        );

                    }
                }else{
                        $('#id_estacionamientoEditar').append('<option>El residente no tiene compras realizadas en los estacionamientos</option>');
                }
            })
            .done(function(data) {
                
                //console.log(data.length);
                            
                
            });

            $.get("mr/"+id_residente+"/"+anio+"/buscar_mr",function (data) {
            })
            .done(function(data) {
                if (data.length>0) {
                    $("#id_multaEditar").removeAttr('disabled',false);
                    for (var i = 0; i < data.length; i++) {
                       $("#id_multaEditar").append('<option value="'+data[i].id+'"><font style="vertical-align: inherit; color: red">'+data[i].motivo+' - '+ data[i].tipo+' - monto: '+data[i].monto+'$</font></option>');
                    }
                }else{
                    $('#id_multaEditar').append('<option>El residente no tiene compras realizadas en las Multas-Recargas</option>');
                    $("#id_multaEditar").css('display','none');
                }
                // $("#id_multaEditar").removeAttr('disabled');
            });



            /*
            $.get("estacionamientos/"+id_residente+"/buscar_anios",function (data) {
            })
            .done(function(data) {
                for (var i = 0; i < data.length; i++) {
                    $('#id_estacionamientoEditar').append('<option selected value="'+data[i].id+'"></option>');
                }
            });*/
    }
    function inmuebles_meses_editar(id_inmueble) {
        var mes='';
        $.get("mostrar/"+id_inmueble+"/meses_inmuebles",function (data) {
        })
        .done(function(data) {
            // alert(data.length);
            if (data.length>0) {
                for(var i=0; i < data.length; i++){
                    //console.log(data[i].mes);
                    // if (data[i].status=="Pendiente") {
                        mes=mostrar_mes(parseInt(data[i].mes));
                        //console.log(mes);
                    $('#id_inmuebleEditar').append('<option value="'+data[i].id+'"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'+mes+'</font></font></option>');
                    // }
                }
                $('#id_inmuebleEditar').removeAttr('disabled',false);
            
            }else{
                $('#id_inmuebleEditar').append('<option>No hay meses cancelados en estos registros</option>');
                $('#id_inmuebleEditar').attr('disabled',true);
            }
        });
    }

    function estacionamientos_meses_editar(id_estacionamiento) {

       
        $.get("mostrar/"+id_estacionamiento+"/meses_estacionamientos",function (data) {
        })
        .done(function(data) {
            if (data.length>0) {
                for(var i=0; i < data.length; i++){
                    //console.log(i);
                    // if (data[i].status=="Pendiente") {
                    $('#id_estacionamientoEditar'+id_estacionamiento).append('<option value="'+data[i].id+'"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'+mostrar_mes(data[i].mes)+'</font></font></option>');
                    // }
                }
            }else{
                $('#id_estacionamientoEditar'+id_estacionamiento).append('<option>No hay meses pagados en este estacionamiento</option>');
            }
            $('#id_inmuebleEditar').removeAttr('disabled');
            $('#id_estacionamientoEditar').removeAttr('disabled');
        });
    }

    function mis_mr(id_residente) {
        $('#ResidenteTieneMultas').css('display','none');
        $('#spinner').css('display', 'block');
        $.get("arriendos/"+id_residente+"/buscar_mr",function (data2) {
        })
        .done(function(data2) {
            if (data2.length>0) {
                for (var i = 0; i < data2.length; i++) {

                    $.get("multas_recargas/"+data2[i].id+"/buscar",function (data) {
                    })
                    .done(function(data) {

                        // $("#mr option[value=" + id_multa + "]").attr('disabled',true);
                        var monto= parseFloat(data[0].monto);
                        var tipo= ""+data[0].tipo+"";
                        if(data[0].tipo == 'Recarga'){
                            var tipo=1;
                            $('#mrSeleccionado').append(
                                '<tr id="trMulta'+data[0].id+'">'+
                                    '<td>'+
                                        '<div class="text-success">Recarga </div>'+
                                    '</td>'+
                                    '<td>'+
                                        '<div class="text-success">'+data[0].motivo+'</div>'+
                                    '</td>'+
                                    '<td>'+
                                        '<div class="text-success">$'+monto+'</div>'+
                                    '</td>'+
                                    '<td>'+
                                        '<div class="text-success"></div>'+
                                    '</td>'+
                                    // '<td>'+
                                    //     '<button type="button" onclick="borrarMultaT('+data[0].id+','+monto+','+tipo+')" class="btn btn-danger btn-rounded btn-sm">Borrar</button>'+
                                    // '</td>'+
                                '</tr>'
                            );
                            
                            montoTotal(1,monto);
                        }
                        if(data[0].tipo == 'Multa'){
                            var tipo=2;
                            $('#mrSeleccionado').append(
                                '<tr id="trMulta'+data[0].id+'">'+
                                    '<td>'+
                                        '<div class="text-danger">Multa </div>'+
                                    '</td>'+
                                    '<td>'+
                                        '<div class="text-danger">'+data[0].motivo+'</div>'+
                                    '</td>'+
                                    '<td>'+
                                        '<div class="text-danger"></div>'+
                                    '</td>'+
                                    '<td>'+
                                        '<div class="text-danger">$'+monto+'</div>'+
                                    '</td>'+
                                    // '<td>'+
                                    //     '<button type="button" onclick="borrarMultaT('+data[0].id+','+monto+','+tipo+')" class="btn btn-danger btn-rounded btn-sm">Borrar</button>'+
                                    // '</td>'+
                                '</tr>'
                            );
                            montoTotal(2,monto);
                        }

                        $('#id_mensMultaR').append('<option selected id="multaR'+data[0].id+'" value="'+data[0].id+'">'+data[0].id+'</option>');
                        // alert(i +'   '+ data2.length);
                        if (i == data2.length) {
                            $('#spinner').css('display', 'none');
                        }
                    });
                }
            }else{
                $('#spinner').css('display', 'none');
                $('#ResidenteTieneMultas').css('display','block');
            }




            // if (data.length>0) {
            //     for (var i = 0; i < data.length; i++) {
            //        $("#mr").append('<option value="'+data[i].id+'"><font style="vertical-align: inherit; color: red">'+data[i].motivo+' - '+ data[i].tipo+' - monto: '+data[i].monto+'$</font></option>');
            //     }
            // }else{
            //     $("#mr").css('display','none');
            // }
            // $('#mr').removeAttr('disabled');

        });       
    }
    function mostrar_datos(id_residente) {
        //console.log('entro'+id_residente);

        $.get("arriendos/"+id_residente+"/buscar_inmuebles2",function (data) {
        })
        .done(function(data) {

            for(i=0 ; i<data.length ; i++){
                
                        $('#mis_inmuebles').append(
                            '<optgroup id="inmuebles'+data[i].id+'" label="'+data[i].idem+'">'+inmuebles_meses(data[i].id)+'</optgroup>'
                        );

            }
                        
            
        });

    }
    function inmuebles_meses(id_inmueble) {

        $.get("arriendos/"+id_inmueble+"/buscar_inmuebles3",function (data) {
            for(var i=0; i < data.length; i++){
                if (data[i].status=="Pendiente") {
                $('#inmuebles'+id_inmueble).append('<option value="'+data[i].id+'"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'+mostrar_mes(data[i].mes)+'</font></font></option>');
                }
            }
        })
        .done(function(data) {
            //console.log(data.length);
            //console.log('hola');
        
        });
    }

    function mostrar_datos2(id_residente) {
        //console.log('entro'+id_residente);

       $.get("arriendos/"+id_residente+"/buscar_estacionamientos2",function (data) {
        })
        .done(function(data) {
            //console.log(data.length);
            for(i=0 ; i<data.length ; i++){
                
                        $('#mis_estacionamientos').append(
                            '<optgroup id="estacionamientos'+data[i].id+'" label="'+data[i].idem+'">'+estacionamientos_meses(data[i].id)+'</optgroup>'
                        );

            }
                        
            
        });

    }
    function estacionamientos_meses(id_estacionamiento) {

        $.get("arriendos/"+id_estacionamiento+"/buscar_estacionamientos3",function (data) {
            for(var i=0; i < data.length; i++){
                if (data[i].status=="Pendiente") {
                $('#estacionamientos'+id_estacionamiento).append('<option value="'+data[i].id+'"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'+mostrar_mes(data[i].mes)+'</font></font></option>');
                }
            }
        })
        .done(function(data) {
            //console.log(data.length);
            
            
            $('#mis_inmuebles').removeAttr('disabled');
            $('#mis_estacionamientos').removeAttr('disabled');

        });
    }
    var mes = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre',''];
    var fecha = new Date();
    var anio = fecha.getFullYear();
    var avatar= "{{ asset('assets/images/avatar-user.png') }}";
    var house= "{{ asset('assets/images/house.png') }}";
    var parkin= "{{ asset('assets/images/parkin.png') }}";

    function montoTotalI(id_inmueble){
        if(id_inmueble!= null){
            $.get("mensualidadInmueble/"+id_inmueble+"/buscar",function (data) {
            })
            .done(function(data) {
                $("#mis_inmuebles option[value=" + id_inmueble + "]").attr('disabled',true);
                var monto= parseFloat(data[0].monto);
                $('#mrSeleccionado').append(
                    '<tr id="trInmueble'+data[0].id+'">'+
                        '<td>'+
                            '<div class="text-primary">'+data[0].idem+'</div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="text-primary">'+mostrar_mes(data[0].mes)+' </div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="text-primary">$'+monto+'</div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="text-primary"></div>'+
                        '</td>'+
                        '<td>'+
                            '<button type="button" onclick="borrarInmuebleT('+id_inmueble+','+monto+')" class="btn btn-danger btn-rounded btn-sm">Borrar</button>'+
                        '</td>'+
                    '</tr>'
                );
                $('#id_mensInmuebleR').append('<option selected id="inmuebleR'+data[0].id+'" value="'+data[0].id+'">'+data[0].id+'</option>');
                montoTotal(2,monto);
            });
        }
    }
    function montoTotalE(id_estacionamiento){
        if(id_estacionamiento!= null){
            $.get("mensualidadEstacionamiento/"+id_estacionamiento+"/buscar",function (data) {
            })
            .done(function(data) {
                $("#mis_estacionamientos option[value=" + id_estacionamiento + "]").attr('disabled',true);
                var monto= parseFloat(data[0].monto);
                $('#mrSeleccionado').append(
                    '<tr id="trEstacionamiento'+data[0].id+'">'+
                        '<td>'+
                            '<div class="text-warning">'+data[0].idem+'</div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="text-warning">'+mostrar_mes(data[0].mes)+' </div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="text-warning">$'+monto+'</div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="text-warning"></div>'+
                        '</td>'+
                        '<td>'+
                            '<button type="button" onclick="borrarEstacionamientoT('+id_estacionamiento+','+monto+');" class="btn btn-danger btn-rounded btn-sm">Borrar</button>'+
                        '</td>'+
                    '</tr>'
                );
                $('#id_mensEstacionaR').append('<option selected id="estacionamientoR'+data[0].id+'" value="'+data[0].id+'">'+data[0].id+'</option>');
                montoTotal(2,monto);
            });
        }
    }
    function montoTotalM(id_multa){
        if(id_multa!= null){
            $.get("multas_recargas/"+id_multa+"/buscar",function (data) {
            })
            .done(function(data) {

                $("#mr option[value=" + id_multa + "]").attr('disabled',true);
                var monto= parseFloat(data[0].monto);
                var tipo= ""+data[0].tipo+"";
                if(data[0].tipo == 'Recarga'){
                    var tipo=1;
                    $('#mrSeleccionado').append(
                        '<tr id="trMulta'+data[0].id+'">'+
                            '<td>'+
                                '<div class="text-success">Recarga </div>'+
                            '</td>'+
                            '<td>'+
                                '<div class="text-success">'+data[0].motivo+'</div>'+
                            '</td>'+
                            '<td>'+
                                '<div class="text-success">$'+monto+'</div>'+
                            '</td>'+
                            '<td>'+
                                '<div class="text-success"></div>'+
                            '</td>'+
                            '<td>'+
                                '<button type="button" onclick="borrarMultaT('+data[0].id+','+monto+','+tipo+')" class="btn btn-danger btn-rounded btn-sm">Borrar</button>'+
                            '</td>'+
                        '</tr>'
                    );
                    
                    montoTotal(1,monto);
                }
                if(data[0].tipo == 'Multa'){
                    var tipo=2;
                    $('#mrSeleccionado').append(
                        '<tr id="trMulta'+data[0].id+'">'+
                            '<td>'+
                                '<div class="text-danger">Multa </div>'+
                            '</td>'+
                            '<td>'+
                                '<div class="text-danger">'+data[0].motivo+'</div>'+
                            '</td>'+
                            '<td>'+
                                '<div class="text-danger"></div>'+
                            '</td>'+
                            '<td>'+
                                '<div class="text-danger">$'+monto+'</div>'+
                            '</td>'+
                            '<td>'+
                                '<button type="button" onclick="borrarMultaT('+id_multa+','+monto+','+tipo+')" class="btn btn-danger btn-rounded btn-sm">Borrar</button>'+
                            '</td>'+
                        '</tr>'
                    );
                    montoTotal(2,monto);
                }

                $('#id_mensMultaR').append('<option selected id="multaR'+data[0].id+'" value="'+data[0].id+'">'+data[0].id+'</option>');
            });
        }
    }


    function borrarInmuebleT(id_inmueble, monto) {
        $("#mis_inmuebles option[value=" + id_inmueble + "]").removeAttr('disabled');
        $("#trInmueble"+id_inmueble).remove();
        $("#inmuebleR"+id_inmueble).remove();
        montoTotal(1,monto);
    }
    function borrarEstacionamientoT(id_estacionamiento, monto) {
        $("#mis_estacionamientos option[value=" + id_estacionamiento + "]").removeAttr('disabled');
        $("#trEstacionamiento"+id_estacionamiento).remove();
        $("#estacionamientoR"+id_estacionamiento).remove();
        montoTotal(1,monto);
    }
    function borrarMultaT(id_multa, monto, tipo) {
        $("#mis_mr option[value=" + id_multa + "]").removeAttr('disabled');
        $("#trMulta"+id_multa).remove();
        $("#multaR"+id_multa).remove();
        if (tipo == 1) {
            montoTotal(1,monto);
        }else{
            montoTotal(2,monto);
        }
        
    }


    function montoTotal(tipo, monto){
        var total=0;
        var cuentaFilas = $('#mrSeleccionado tr').length;
        if (cuentaFilas == 0) {
            $('#TotalPagar').html(parseInt(0));
            //$('#total').val(0);
        } else {
            if (tipo == 1) {
                $('#TotalPagar').html(parseInt($('#TotalPagar').html())-monto);
                $("#total").val($("#TotalPagar").html());
            } else if(tipo == 2) {
                $('#TotalPagar').html(parseInt($('#TotalPagar').html())+monto);
                $("#total").val($("#TotalPagar").html());
            }
        }
    }







    //-----------------------------------------------------------------------------------CARROUSEL---------------------------------------------------------

    function buscarResidentes(id_residente) {
        $('.carrousel').empty();

        $.get('arriendos/'+id_residente+'/buscar_residente',function (data) {

        })
        .done(function(data) {
            var verF= $('#verF');
            $('.carrousel').append(
                '<div class="card" style="margin-left: 20px;" width="900px">'+
                    '<form class="form-row align-items-center">'+
                        '<div class="form-group mr-4">'+
                            '<img src="'+avatar+'" width="50px" height="50px"  style="margin-left: 5px;" />'+
                        '</div>'+
                        '<div class="form-group mr-6">'
                            +data[0].nombres+ ' ' +data[0].apellidos+
                            '<br>'
                            +data[0].rut+
                        '</div>'+
                            
                                
                            '<div class="btn-group mt-2 mr-1">'+
                                '<a onclick="VerResi('+data[0].id+')" href="#"><img src="'+house+'" class="avatar-md rounded-circle"/></a>'+
                            '</div>'+

                            '<div class="btn-group mt-2 mr-1">'+
                                '<a onclick="VerEstacionamientos('+data[0].id+')" href="#"><img src="'+parkin+'" class="avatar-md"/>'+
                            '</div>'+
                                
                            
                            '<a href="#" onclick="registrarPago('+data[0].id+')" class=" btn btn-sm btn-success"> Pagar</a>'+
                    '</form>'+
                '</div>'
            );
        });
    }

    function registrarPago(id_residente) {
        $('#verF').val(id_residente);
        $('#VerFomulario').css('display','block');
    }

    function VerResi(id_residente) {
        $('.cargandoArriendos').show();
        $('#VerEstaFade').css('display','none');
        $('.titleModal').html('Residencias');
        $('.carousel-inner').empty();
        $('#VerEsta').modal('show');
        $('#MostrarEstacionamientos').empty();

        
        $.get("arriendos/"+id_residente+"/buscar_inmuebles2",function (data) {
        })
        .done(function(data) {

            
            if(data.length>0){
                for(i=0 ; i<data.length ; i++){
                    // alert()
                    if (i==0) {
                        $('.carousel-inner').append(
                            '<div class="carousel-item active">'+
                                '<center>'+
                                    '<h3 alt="'+i+' slide"background-color:gray; width: 100%; opacity: 0.7;"><strong class="text-primary">'+data[i].idem+'</strong></h3>'+
                                    '<div class="row justify-content-center">'+
                                        '<div class="col-md-12">'+
                                            '<table class="table table-curved data-table-basic2 table-striped tabla-estilo shadow p-3 mb-5 bg-white rounded" style="width:90%;">'+
                                                '<thead><center>'+
                                                    // '<tr class="bg-info text-white" align="center">'+
                                                    //     '<th align="center" class="text-white" align="center"><strong align="center">Montos por mes</strong></th>'+
                                                    //     '<th align="center" class="text-white" align="center"><strong align="center">Status</strong></th>'+
                                                    //     '<th></th>'+
                                                    // '</tr>'+
                                                '</center></thead>'+
                                                '<tbody class="inmuebleBody'+data[i].id+'">'+
                                                '</tbody>'+
                                            '</table>'+
                                        '</div>'+
                                    '</div>'+

                                '</center>'
                                // ''+
                                // '<label><h4>Montos por mes</h4></label><br>'+
                                // '<div class="inner'+data[i].id+'"></div>'
                        );

                        detalles(data[i].id);
                    }else{
                        $('.carousel-inner').append(
                            '<div class="carousel-item">'+
                                '<center>'+
                                    '<h3 alt="'+i+' slide"background-color:gray; width: 100%; opacity: 0.7;"><strong class="text-primary">'+data[i].idem+'</strong></h3>'+
                                    '<div class="row justify-content-center">'+
                                        '<div class="col-md-12">'+
                                            '<table class="table table-curved data-table-basic2 table-striped tabla-estilo shadow p-3 mb-5 bg-white rounded" style="width:90%;">'+
                                                '<thead><center>'+
                                                    // '<tr class="bg-info text-white" align="center">'+
                                                    //     '<th align="center" class="text-white" align="center"><strong align="center">Montos por mes</strong></th>'+
                                                    //     '<th align="center" class="text-white" align="center"><strong align="center">Status</strong></th>'+
                                                    //     '<th></th>'+
                                                    // '</tr>'+
                                                '</center></thead>'+
                                                '<tbody class="inmuebleBody'+data[i].id+'">'+

                                                '</tbody>'+
                                            '</table>'+
                                        '</div>'+
                                    '</div>'+
                                '</center>'
                        );

                        detalles(data[i].id);
                    }
                    $('.carousel-inner').append('</div>');
                }
            }else{
                $('.carousel-inner').append('<h3>El residente no tiene Inmuebles registrados</h3>');
            }
                        
            
        $('.cargandoArriendos').hide();
        });
    }

    function detalles(id_inmueble){
        //console.log(id_inmueble);
        $.get("arriendos/"+id_inmueble+"/buscar_inmuebles3",function (data) {
        })
        .done(function(data) {
            //console.log(data);
            for(var i=0; i < data.length; i++){
                $('.inmuebleBody'+id_inmueble).append('<tr>');
                    if(data[i].status == 'Pendiente'){
                        $('.inmuebleBody'+id_inmueble).append(
                            '<td align="center"><strong>'+mes[data[i].mes-1]+'</strong></td>'+
                            '<td align="center" class="text-success"><strong>'+data[i].status+'</strong></td>'+
                            '<td></td>'
                        );
                    }else if(data[i].status == 'Por Confirmar'){
                        $('.inmuebleBody'+id_inmueble).append(
                            '<td align="center"><strong>'+mes[data[i].mes-1]+'</strong></td>'+
                            // '<td align="center" class="text-warning"><strong>'+data[i].status+'</strong></td>'
                            '<td align="center" class="text-warning"><strong>' +data[i].status+'</strong><br> CÓDIGO TRANS.: <b>'+data[i].referencia+'</b></td>'+
                            '<td></td>'
                        );
                    }else{
                        $('.inmuebleBody'+id_inmueble).append(
                            '<td align="center"><strong>'+mes[data[i].mes-1]+'</strong></td>'+
                            '<td align="center" class="text-danger"><strong>'+data[i].status+'</strong></td>'+
                            '<td align="center">'+
                                '<div class="form-group">'+
                                    '<div style="font-size: 1em; ">'+
                                        '<svg class="bi bi-lock-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'+
                                          '<rect width="11" height="9" x="2.5" y="7" rx="2"/>'+
                                          '<path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>'+
                                        '</svg>'+
                                    '</div>'+
                                '</div>'+
                            '</td>'
                        );
                    }
                $('.inmuebleBody'+id_inmueble).append('</tr>');
                if(i==data.length-1){
                    $('#VerEstaFade').fadeIn('slow');
                }
            }



        });
    }

    
    function mostrar_mes(num) {
        switch (num) {
            case 1:
                return 'Enero';
                break;
            case 2:
                return 'Febrero';
                break;
            
            case 3:
                return 'Marzo';
                break;
            
            case 4:
                return 'Abril';
                break;
            
            case 5:
                return 'Mayo';
                break;
            
            case 6:
                return 'Junio';
                break;
            
            case 7:
                return 'Julio';
                break;
            
            case 8:
                return 'Agosto';
                break;
            
            case 9:
                return 'Septiembre';
                break;
            
            case 10:
                return 'Octubre';
                break;
            
            case 11:
                return 'Noviembre';
                break;
            
            case 12:
                return 'Diciembre';
                break;
            
            
        }
    }

    function buscarArriendos(id_arriendo) {
        $('#buttonCreate').empty();
        $('#createMensuality1').empty();
        $('#createMensuality2').empty();

        // alert(id_arriendo);
        $.get('inmuebles/'+id_arriendo+'/'+anio+'/buscar_mensualidad', function(data) {
        }).done(function(data) {
            if (data.length > 0) {
                // alert('trae');
                var montoT=data.length-1;
                    $('#buttonCreate').append(
                        "<div class='card-box'>"+
                            "<div class='row'>"+
                                "<div class='col-md-12' width='100%'>"+
                                    "<a href='#' disabled class='btn btn-block btn-success'><h4>Montos por mes</h4></a>"+
                                "</div>"+
                                // "<div class='col-md-6' width='100%'>"+
                                //     "<a href='#' class='btn btn-block btn-warning' onclick='mostrarE(2)'>Monto por año</a>"+
                                // "</div>"+
                            "</div>"+
                        "</div"
                    );
                    $('#createMensuality1').append('<label><h4>Montos por mes</h4></label><br>');

                    
                    for (var i = 0; i < data.length; i++) {
                            
                            //console.log(i);
                            $('#createMensuality1').append(
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
                                                // '<div class="input-group-prepend">'+
                                                //     '<div class="input-group-text">$</div>'+
                                                // '</div>'+
                                                '<label><strong>$'+data[i].monto+'</strong></label>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                            );

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
                                        '<input type="text" name="montoaAnio" value="'+data[montoT].monto+'" class="form-control" id="montoAnio_e" placeholder="10" disabled="disabled">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                    $('#createMensuality2').css('display','none');            
               

            }else{
                // alert('NO TRAE')
                $('#buttonCreate').append('<h3>No hay mensualidades para el año actual</h3>');
            }
        });
    }

    function VerEstacionamientos(id_residente) {
        $('#VerEstaFade').css('display','none');
        $('.cargandoArriendos').show()
        $('.titleModal').html('Estacionamientos');
        $('.carousel-inner').empty();
        $('#VerEsta').modal('show');
        $('#MostrarEstacionamientos').empty();

        
        $.get("arriendos/"+id_residente+"/buscar_estacionamientos2",function (data) {
        })
        .done(function(data) {

                //console.log(data.length+'.........');
            //alert(data.length);
            for(i=0 ; i<data.length ; i++){
                if (i==0) {
                        $('.carousel-inner').append(
                            '<div class="carousel-item active">'+
                                '<center>'+
                                    '<h3 alt="'+i+' slide"background-color:gray; width: 100%; opacity: 0.7;"><strong class="text-warning">'+data[i].idem+'</strong></h3>'+
                                    '<div class="row justify-content-center">'+
                                        '<div class="col-md-12">'+
                                            '<table class="table table-curved data-table-basic2 table-striped tabla-estilo shadow p-3 mb-5 bg-white rounded" style="width:90%;">'+
                                                // '<thead><center>'+
                                                //     '<tr class="bg-info text-white" align="center">'+
                                                //         '<th align="center" class="text-white" align="center"><strong align="center">Montos por mes</strong></th>'+
                                                //         '<th align="center" class="text-white" align="center"><strong align="center">Status</strong></th>'+
                                                //     '</tr>'+
                                                // '</center></thead>'+
                                                '<tbody class="EstacionaBody'+data[i].id+'">'+
                                                '</tbody>'+
                                            '</table>'+
                                        '</div>'+
                                    '</div>'+

                                '</center>'
                        );

                        detalles2(data[i].id);
                    }else{
                        $('.carousel-inner').append(
                            '<div class="carousel-item">'+
                                '<center>'+
                                    '<h3 alt="'+i+' slide"background-color:gray; width: 100%; opacity: 0.7;"><strong class="text-warning">'+data[i].idem+'</strong></h3>'+
                                    '<div class="row justify-content-center">'+
                                        '<div class="col-md-12">'+
                                            '<table class="table table-curved data-table-basic2 table-striped tabla-estilo shadow p-3 mb-5 bg-white rounded" style="width:90%;">'+
                                                // '<thead><center>'+
                                                //     '<tr class="bg-info text-white" align="center">'+
                                                //         '<th align="center" class="text-white" align="center"><strong align="center">Montos por mes</strong></th>'+
                                                //         '<th align="center" class="text-white" align="center"><strong align="center">Status</strong></th>'+
                                                //     '</tr>'+
                                                // '</center></thead>'+
                                                '<tbody class="EstacionaBody'+data[i].id+'">'+
                                                '</tbody>'+
                                            '</table>'+
                                        '</div>'+
                                    '</div>'+

                                '</center>'
                        );

                        detalles2(data[i].id);
                    }
                    $('.carousel-inner').append('</div>');
            }
                        
        $('.cargandoArriendos').hide();
        });
    }

    function detalles2(id_estacionamiento){
            //console.log(id_inmueble);
            $.get("arriendos/"+id_estacionamiento+"/buscar_estacionamientos3",function (data) {
            })
            .done(function(data) {
                //console.log(data.length);
                // for(var i=0; i < data.length; i++){
                //     $('.inner'+id_estacionamiento).append(
                //         '<div class="row">'+
                //             '<div class="col-md-12">'+ 
                //                 '<label>'+mostrar_mes(data[i].mes)+'</label>'+
                //                 '<label style="float:right;">'+data[i].status+'</label>'+
                //             '</div>'+
                //         '</div>'
                //     );
                // }
                for(var i=0; i < data.length; i++){
                    $('.EstacionaBody'+id_estacionamiento).append('<tr>');
                    if(data[i].status == 'Pendiente'){
                        $('.EstacionaBody'+id_estacionamiento).append(
                            '<td align="center"><strong>'+mes[data[i].mes-1]+'</strong></td>'+
                            '<td align="center" class="text-success"><strong>'+data[i].status+'</strong></td>'+
                            '<td></td>'
                        );
                    }else if(data[i].status == 'Por Confirmar'){
                        $('.EstacionaBody'+id_estacionamiento).append(
                            '<td align="center"><strong>'+mes[data[i].mes-1]+'</strong></td>'+
                            '<td align="center" class="text-warning"><strong>'+data[i].status+'</strong></td>'+
                            '<td></td>'
                        );
                    }else{
                        $('.EstacionaBody'+id_estacionamiento).append(
                            '<td align="center"><strong>'+mes[data[i].mes-1]+'</strong></td>'+
                            '<td align="center" class="text-danger"><strong>'+data[i].status+'</strong></td>'+
                            '<td align="center">'+
                                '<div class="form-group">'+
                                    '<div style="font-size: 1em; ">'+
                                        '<svg class="bi bi-lock-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'+
                                          '<rect width="11" height="9" x="2.5" y="7" rx="2"/>'+
                                          '<path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>'+
                                        '</svg>'+
                                    '</div>'+
                                '</div>'+
                            '</td>'
                        );
                    }
                    $('.EstacionaBody'+id_estacionamiento).append('</tr>');
                    if(i==data.length-1){
                        $('#VerEstaFade').fadeIn('slow');
                    }
                }

            });
        }

    function buscarEstacionamientos(id_arriendo) {
        $('#muestraEsta1').empty();
        $('#muestraEsta2').empty();
        // $('#muestrEsta3').empty();

        $.get('estacionamientos/'+id_arriendo+'/'+anio+'/buscar_mensualidad', function(data) {
        }).done(function(data) {
            if (data.length > 0) {
                // alert('trae');
                var montoT=data.length-1;
                    $('#muestraEsta1').append(
                        "<div class='card-box'>"+
                            "<div class='row'>"+
                                "<div class='col-md-12' width='100%'>"+
                                    "<a href='#' disabled class='btn btn-block btn-success'><h4>Montos por mes</h4></a>"+
                                "</div>"+
                                // "<div class='col-md-6' width='100%'>"+
                                //     "<a href='#' class='btn btn-block btn-warning' onclick='mostrarE(2)'>Monto por año</a>"+
                                // "</div>"+
                            "</div>"+
                        "</div"
                    );
                    $('#muestraEsta2').append('<label><h4>Montos por mes</h4></label><br>');

                    
                    for (var i = 0; i < data.length; i++) {
                            
                        $('#muestraEsta2').append(
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
                                            // '<div class="input-group-prepend">'+
                                            //     '<div class="input-group-text">$</div>'+
                                            // '</div>'+
                                            '<label><strong>$'+data[i].monto+'</strong></label>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'
                        );

                    }
               

            }else{
                // alert('NO TRAE')
                $('#muestrEsta1').append('<h3>No hay mensualidades para el año actual</h3>');
            }
        });
    }

</script>
@section('scripts')

<script type="text/javascript">

</script>

@endsection