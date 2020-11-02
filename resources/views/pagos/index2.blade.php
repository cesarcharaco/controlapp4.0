@extends('layouts.app')


@section('content')
    <style type="text/css">
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
            .avatar{
                width: 25px;
                height: 25px;
                /*display: none;   */
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
            .avatar{
                width: 45px;
                height: 45px;    
            }
        }


    </style>
    <div class="container">
        <input type="hidden" id="colorView" value="#ff5c75!important">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pagos</li>
                        <li class="breadcrumb-item active" aria-current="page">Multas y Recargas</li>
                    </ol>
                </nav>
                <span class="PalabraEditarPago">
                    <h4 class="mb-1 mt-0">Pagos - Multas y Recargas</h4>
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
                <div class="card border border-danger rounded card-tabla shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <table class="data-table-basic table table-hover mb-0 tabla-estilo" id="myTable" width="100%" style="position: relative; table-layout: fixed;">
                            <thead>
                                <tr class="bg-danger text-white">
                                    <th></th>
                                    <th>
                                        <span class="tituloTabla">Nombres</span>
                                        <span class="tituloTabla2">N</span>
                                    </th>
                                    <th>
                                        <span class="tituloTabla">Asignaciones</span>
                                        <span class="tituloTabla2">A</span>
                                    </th>
                                    <th>
                                        <span class="tituloTabla">Opciones</span>
                                        <span class="tituloTabla2">O</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($residentes as $key)
                                    <tr>
                                        <td align="center">
                                                
                                            <img src="{{ asset('assets/images/avatar-user.png') }}" class="avatar-md rounded-circle avatar" />
                                            


                                        </td>
                                        <td align="center">
                                            <div class="form-group">
                                                {{$key->nombres}} {{$key->apellidos}}
                                                <br>
                                                <strong>{{$key->rut}}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            
                                            <a href="#" class="btn btn-danger btn-sm shadow" style="border-radius: 5px; width: 100%" onclick="verAsignadosM('{{$key->id}}')" >
                                                <i data-feather="dollar-sign" class="iconosMetaforas" style="float:left;"></i>
                                                <span class="PalabraPagoConfirmar">Ver Asignaciones</span>
                                                <span class="PalabraEditarPago2"><i data-feather="eye" class="iconosMetaforas2"></i>
                                                </span>
                                            </a>                                                
                                        </td>
                                        <td>
                                            <center>
                                                <a href="#" class="btn btn-success btn-sm shadow" style="border-radius: 5px; width: 100%" onclick="pagarMultasResidente('{{$key->id}}')" >
                                                    <i data-feather="dollar-sign" class="iconosMetaforas" style="float:left;"></i>
                                                    <span class="PalabraPagoConfirmar">Pagar</span>
                                                    <span class="PalabraEditarPago2"><i data-feather="dollar-sign" class="iconosMetaforas2"></i>
                                                    </span>
                                                </a>
                                            </center>
                                            <br>
                                            <center>
                                                <a href="#" class="btn btn-info btn-sm shadow" style="border-radius: 5px; width: 100%" onclick="multasPorComprobar('{{$key->id}}')">
                                                    <i data-feather="check-square" class="iconosMetaforas" style="float:left;"></i>
                                                    <span class="PalabraPagoConfirmar">Confirmar</span>
                                                    <span class="PalabraEditarPago2"><i data-feather="check-square" class="iconosMetaforas2"></i></span>
                                                </a>
                                            </center>
                                            
                                        </td>
                                    </tr>
                                @endforeach()
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

    </div>
</div>
</div>

        <div class="card" id="VerFomulario" style="display: none" >
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
                            <center style="color: grey; font-size: 100px; width:100%; font-size: 10vw;">$<span id="TotalPag class="iconosMetaforas2"ar">0</span></center>
                            <input type="hidden" name="total" id="total" value="0">
                        </div>
                    </div>
                </div>
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Rereferencias <b class="danger">*</b></label>
                                <input type="text" required="required" name="referencia" class="form-control">
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

   <div class="modal fade" tabindex="-1" id="verAsignadosMulta" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Asignaciones de la Multa/Recarga</h4>
                    <div id="CargandoAsignadosComprobar" style="display: none;">
                            <div class="spinner-border text-warning m-2" role="status">
                            </div>
                        </div>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <table class="table dataTable table-curved table-striped tabla-estilo" style="width: 100%;">
                            <thead>
                                <tr class="bg-danger text-white">
                                    <th>Motivo</th>
                                    <th>Montos</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="ver_multas_asignadas">
                                
                            </tbody>
                        </table>
                    </center>
                </div>
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
                                        <input type="text" name="referencia_edit" data-toggle="tooltip" data-placement="top" title="Ingrese la referencia con la que se registró el pago" placeholder="Ej: 12345678" class="form-control" required="required" >
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

        {!! Form::open(['route' => ['multas_recargas.confirmar'],'method' => 'POST', 'name' => 'confirmar_multa', 'id' => 'confirmar_multa', 'data-parsley-validate']) !!}
        <div class="modal fade" tabindex="-1" id="PagoConfir" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Multas/Recargas por Confirmar del Residente <span id="nombreResidente"></span></h4>
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
                        <div id="ResidenteTienePagosC">
                            <center>
                                <table class="table dataTable table-curved table-striped tabla-estilo" style="width: 100%;">
                                    <thead>
                                        <tr class="table-danger text-white">
                                            <th align="center"><center>Motivo</center></th>
                                            <th align="center"><center>Fecha</center></th>
                                            <th align="center"><center>Status</center></th>
                                            <th align="center"><center>Confirmar</center></th>
                                    </thead>
                                    <tbody id="muestraMesesMultasComprob">
                                        
                                    </tbody>
                                </table>
                            </center>
                        </div>
                        <div id="ResidenteTienePagosC2">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning" >Confirmar</button>  
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

    <!--   -------------------------------------------------------------- ESTACIONAMIENTOS   -->

    <div class="modal fade" id="VerEsta" role="dialog">
            <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- <div class="modal-header">
                        <h4>Sus <span id="titleModal"></span></h4>
                    </div> -->
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
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

    {!! Form::open(['route' => ['editar_referencia'],'method' => 'POST', 'name' => 'EditarReferencia', 'id' => 'editar_referencia', 'data-parsley-validate']) !!}
        @csrf
        <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editarReferencia" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Editar Código de Transacción</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card border border-warning rounded card-tabla shadow p-3 mb-5 bg-white rounded">
                            <div class="card-body">
                                <div id="codigoActualRef"></div>
                                <center>
                                   <div class="row">
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Código de Trans. Nueva</label>
                                               <input type="text" name="ReferenciaNueva" class="form-control" required>
                                           </div>
                                       </div>
                                   </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id_pivot" name="id_pivot">
                        <button type="submit" class="btn btn-warning" >Editar Código de Trans.</button>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}



@endsection

<script type="text/javascript">


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
    function verAsignadosM(id_residente){
        $('#CargandoAsignadosComprobar').css('display','block');
        $('#ver_multas_asignadas').empty();
        $('#verAsignadosMulta').modal('show');
        
        $.get('mr/'+id_residente+'/asignados2', function(data) {
        })
        .done(function(data) {
                if(data.length>0){
                    for (var i = 0; i < data.length; i++) {
                        var clase="";
                        var referencia="";
                        if(data[i].referencia > 0){
                            referencia="<br>CÓDIGO TRANS.: <b>"+data[i].referencia+"</b>";
                        }else{
                            referencia="";
                        }
                        if(data[i].status == 'Pagada'){
                            $('#ver_multas_asignadas').append(
                                '<tr class='+clase+'>'+
                                    '<td align="center"><center>'+data[i].motivo+'</center></td>'+
                                    '<td align="center"><center>'+data[i].monto+'</center></td>'+
                                    '<td align="center" class="text-success"><center><strong>'+data[i].status+'</strong>'+referencia+'</center>'+
                                        '<button style="width:100% !important;" class="btn btn-warning rounded btn-sm" onclick="editarReferencia('+data[i].id+','+data[i].id_pivot+');">'+
                                            '<span class="PalabraPagoConfirmar">Editar Código de Trans.</span>'+
                                            '<span class="PalabraEditarPago2">Editar</span>'+
                                        '</button>'+
                                    '</td>'+
                                '</tr>'
                            );
                        }else if(data[i].status == 'Por Confirmar'){
                            $('#ver_multas_asignadas').append(
                                '<tr class='+clase+'>'+
                                    '<td align="center"><center>'+data[i].motivo+'</center></td>'+
                                    '<td align="center"><center>'+data[i].monto+'</center></td>'+
                                    '<td align="center" class="text-success"><center>'+
                                        '<div class="text-warning"><strong>' +data[i].status+'</strong> | CÓDIGO TRANS.: <b>'+data[i].referencia+'</b></div>'+'</center>'+
                                    '</td>'+
                                '</tr>'
                            );
                        }else{
                            $('#ver_multas_asignadas').append(
                                '<tr class='+clase+'>'+
                                    '<td align="center"><center>'+data[i].motivo+'</center></td>'+
                                    '<td align="center"><center>'+data[i].monto+'</center></td>'+
                                    '<td align="center" class="text-info"><center><strong>'+data[i].status+'</strong>'+referencia+'</center></td>'+
                                '</tr>'
                            );
                        }
                    }
                }else{
                    $('#ver_multas_asignadas').append(
                                '<tr>'+
                                    '<td align="center" colspan="3"><center>El residente no tiene asignaciones</center></td>'+
                                '</tr>'
                            );
                }
        });
        $('#CargandoAsignadosComprobar').css('display','none');
    }

    function editarReferencia(id_multa, id_pivot) {
        $('#verAsignadosMulta').modal('hide');
        $('#editarReferencia').modal('show');
        $('#codigoActualRef').empty();
        $('#id_pivot').val(id_pivot);

        $.get('mr/'+id_multa+'/asignados', function(data) {
        })
        .done(function(data) {
            if(data.length>0){
                for (var i = 0; i < data.length; i++) {
                    if(data[i].id_pivot == id_pivot){
                        $('#codigoActualRef').append(
                            '<center>'+
                                '<div class="row">'+
                                    '<div class="col-md-12">'+
                                        '<div class="form-group">'+
                                            '<label for="">Código de Trans. Actual</label>'+
                                            '<h3 align="center" class="text-warning">'+data[i].referencia+'</h3>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</center>'
                        );
                    }
                }
            }else{
                alert('no hay');
            }
        });
    }
</script>
@section('scripts')

<script type="text/javascript">

</script>

@endsection