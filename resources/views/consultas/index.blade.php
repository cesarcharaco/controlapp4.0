@extends('layouts.app')


@section('content')

    <div class="container">
        <input type="hidden" id="colorView" value="#5369f8 !important">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row page-title">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="float-right mt-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Consulta</li>
                                <li class="breadcrumb-item active" aria-current="page">Pagos de Condominio</li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">Consulta - Pagos de Condominio</h4>
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
                @if(\Auth::user()->tipo_usuario != 'Admin')
                    <div class="row">
                        <div class="col-md-6 col-xl-6">
                            <div class="card border border-info rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
                                <input type="hidden" name="id_residente" id="id_reside" value="{{\Auth::user()->id}}">
                                <div class="card-body p-0">
                                    <div class="media p-3">
                                        <div class="media-body">
                                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">Pago de condominio</span>
                                            <!-- <h6 class="mb-0">Pagos retrasados: </h6> -->
                                        </div>
                                     
                                        <div class="form-group">
                                            <!-- <label class="mb-0 text-primary">Pagar mes</label> -->
                                            <h6 class="mb-0">
                                                <a data-toggle="tooltip" data-placement="top" title="Seleccione si desea pagar un condominio actual o atrasado" href="#" style="width: 100% !important;" onclick="BMesesResidente('{{$buscar->id}}')" class="btn btn-primary">Pagar</a>
                                            </h6>
                                        </div>

                                    
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-xl-6">
                            <div class="card border border-success rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
                                <div class="card-body p-0">
                                    <div class="media p-3">
                                        <div class="media-body">
                                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">Pago de alquileres</span>
                                            <!-- <h6 class="mb-0">Pagos retrasados: </h6> -->
                                        </div>
                                     
                                        <div class="form-group">
                                            <!-- <label class="mb-0 text-primary">Pagar mes</label> -->
                                            <h6 class="mb-0">
                                                <a data-toggle="tooltip" data-placement="top" title="Seleccione si desea pagar un alquiler actual o atrasado" href="#" style="width: 100% !important;" onclick="pagoAlquileres()" class="btn btn-success">Pagar</a>
                                            </h6>
                                        </div>&nbsp;
                                        {{--<div class="form-group">
                                            <!-- <label class="mb-0 text-primary">Pagar mes</label> -->
                                            @if($buscar_alquiler > 0)
                                                <h6 class="mb-0"><a href="#" style="width: 100% !important;" onclick="pagoArriendos()" class="btn btn-warning">Editar referencias</a></h6>
                                            @endif
                                        </div>
                                        --}}
                                    
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--<div class="col-md-4 col-xl-4">
                            <div class="card border border-warning rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
                                <div class="card-body p-0">
                                    <div class="media p-3">
                                        <div class="media-body">
                                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">Editar referencias</span>
                                            <!-- <h6 class="mb-0">Pagos retrasados: </h6> -->
                                        </div>
                                     
                                        <div class="form-group">
                                            <!-- <label class="mb-0 text-primary">Pagar mes</label> -->
                                            <h6 class="mb-0"><a href="#" style="width: 100% !important;" onclick="pagoArriendos()" class="btn btn-warning">Editar</a></h6>
                                        </div>

                                    
                                    </div>
                                </div>
                            </div>
                        </div>--}}

                    </div>
                @endif
            </div>
        </div>
        @include('flash::message')
        @if(\Auth::user()->tipo_usuario != 'Admin')
            <div class="card border border-success rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <label>Año</label>
                            <select class="form-control select2" onchange="consulta_anual(this.value)">
                                <option value="0" disabled selected>Seleccione año</option>
                                @for($j=0;$j< count($anio);$j++)
                                    <option value="{{ $anio[$j] }}">{{ $anio[$j] }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="card border border-primary rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
            <div class="card-body">
                @if(\Auth::user()->tipo_usuario == 'Admin')
                    <a href="{{ url('pagos') }}" class="btn btn-info text-white shadow">
                        <i data-feather="arrow-left-circle"></i>
                        Regresar a Pagos de Condominio
                    </a>
                @endif
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                    <table id="tableConsultas" class="table table-bordered table-hover table-striped display nowrap" cellspacing="0" style="width: 100% !important;">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>Mes</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="muestraConsultas">
                            @for($i=0; $i < count($status_pago); $i++)                                
                                <tr>
                                    <td>{{ $status_pago[$i][0] }}</td>
                                    @if ($status_pago[$i][1] == 'Pendiente') 
                                            <td class="text-warning"><strong>{{ $status_pago[$i][1] }}</strong></td>
                                    @elseif ($status_pago[$i][1] == 'Por Confirmar') 
                                            <td class="text-warning"><strong>{{ $status_pago[$i][1] }}</strong> <br> CÓDIGO DE TRANS.: <b><br>{{ $status_pago[$i][2] }}</b>
                                                @if(\Auth::user()->tipo_usuario == 'Residente')
                                                    <br>
                                                    <button class="btn btn-warning btn-sm" onclick="editarReferenciaCP('{{ $status_pago[$i][3] }}','{{ $status_pago[$i][2] }}')">
                                                        <span><i data-feather="edit"></i>Editar Código de Trans.</span>
                                                    </button>
                                                @endif
                                            </td>
                                    @elseif ($status_pago[$i][1]== 'Cancelado')
                                            <td class="text-success"><strong>{{ $status_pago[$i][1] }}</strong> <br> CÓDIGO DE TRANS.: <b><br>{{ $status_pago[$i][2] }}</b>
                                                @if(\Auth::user()->tipo_usuario == 'Admin')
                                                    <br>
                                                    <button class="btn btn-warning btn-sm" onclick="editarReferenciaCP('{{ $status_pago[$i][3] }}','{{ $status_pago[$i][2] }}')">
                                                        <span><i data-feather="edit"></i>Editar Código de Trans.</span>
                                                    </button>
                                                @endif
                                            </td>
                                    @else ($status_pago[$i][1]== 'No aplica')
                                            <td class="text-danger"><strong>{{ $status_pago[$i][1] }}</strong></td>
                                    @endif
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>                           
    {!! Form::open(['route' => ['pagos.editar_referencia'],'method' => 'POST', 'name' => 'EditarReferencia', 'id' => 'editar_referencia', 'data-parsley-validate']) !!}
        @csrf
        <div class="modal fade" id="editarReferenciaPC" role="dialog">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Editar Código de Transacción 
                            <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card border border-warning rounded card-tabla shadow p-3 mb-5 bg-white rounded">
                            <div class="card-body">
                                <center>
                                   <div class="row">
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Código de Trans. Actual</label>
                                               <h3 class="text-warning"><span id="CodeRefActual"></span></h3>
                                           </div>
                                       </div>
                                   </div>
                                </center>
                                <center>
                                   <div class="row">
                                       <div class="col-md-12">
                                           <div class="form-group">
                                               <label for="">Código de Trans. Nueva <b class="text-danger">*</b></label>
                                               <input type="text" name="ReferenciaNueva" class="form-control" max="20" maxlength="20" required>
                                           </div>
                                       </div>
                                   </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id_pago" name="id_pago">
                        <button type="submit" class="btn btn-warning" >Editar Código de Trans.</button>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}


    @include('consultas.layouts.editar_referencias')
    @include('consultas.layouts.pagar_alquiler')
    
@endsection


<script type="text/javascript">

</script>
<script type="text/javascript">
	function consulta_anual(anio){
        $('#muestraConsultas').empty();
        if(anio>0){
    		$.get("consulta/"+anio+"/buscar",function (data) {
            })
            .done(function(data) {
            	if (data.length >0) {
                    for (var i = 0; i < data.length; i++) {
                        var status = data[i][1];
                        if (status == 'Pendiente') {
                            var status_color = '<div class="text-warning"><b>'+status+'</b></div>';
                        }else if(status== 'Cancelado'){
                            var status_color = '<div class="text-success"><b>'+status+'</b></div>';
                        }else if(status == 'Por Confirmar'){
                            var status_color = '<div class="text-warning"><b>'+status+'</b> | CÓDIGO DE TRANS.: <b>'+data[i][2]+'</b></div>';
                        }else{
                            var status_color = '<div class="text-danger"><b>'+status+'</b></div>';
                        }
                        $('#muestraConsultas').append(
                            '<tr>'+
                                '<td>'+data[i][0]+'</td>'+
                                '<td>'+status_color+'</td>'+
                            '</tr>'
                        );
                    }
            	}else{
                    $('#muestraConsultas').append('<tr><td colspan="2" align="center"><h3>Sin datos en el año ingresado</h3></td></tr>');
            	}
     		});
        }
	}

    function editarReferenciaCP(id_pago,codigo_referencia){
        $('#editarReferenciaPC').modal('show');
        $('#CodeRefActual').html(codigo_referencia);
        $('#id_pago').val(id_pago);
    }


    function pagoArriendos() {
        $('#selectInstalacionesArr').hide();
        $('#pagarAlquilerResidente').modal('hide');

        setTimeout(function(){
            $('#editar_referencia_residente').modal('show');
        }, 500);
        $('#vistaRefeArriendosE').hide();
        $('#cargandoRefeArriendos').css('display','block');

        $('#codigoActualRefArr2').empty();
        $('#codigoActualRefArr').empty();
        $('#id_instalacion_arriendos').empty();
        var id_residente= $('#id_reside').val();

        $.get("residentes/"+id_residente+"/buscar_referencias",function (data) {
        })
        .done(function(data) {
            console.log(data.length);
            if (data.length > 0) {
                $('#selectInstalacionesArr').fadeIn(300);
                $('#cargandoRefeArriendos').fadeOut('slow');
                $('#id_instalacion_arriendos').append(
                        '<option selected disabled>Seleccione instalación</option>'
                    );
                for (var i = 0; i < data.length; i++) {
                    $('#id_instalacion_arriendos').append(
                        '<option value="'+data[i].id+'">'+data[i].nombre+' - '+data[i].status+'</option>'
                    );
                }
                // $('#codigoActualRefArr').append(
                //     '<center>'+
                //         '<div class="row">'+
                //             '<div class="col-md-12">'+
                //                 '<div class="form-group">'+
                //                     '<label for="">Código de Refer. Actual</label>'+
                //                     '<h3 align="center" class="text-warning">'+data[0].refer+'</h3>'+
                //                 '</div>'+
                //             '</div>'+
                //         '</div>'+
                //     '</center>'
                // );
            }else{
                $('#codigoActualRefArr2').append(
                    '<h3 align="center">El residente no posee instalaciones</h3>'
                );
                $('#cargandoRefeArriendos').fadeOut('slow');
            }

            // $('#cargandoRefeArriendos').fadeOut('slow',
            //     function() { 
            //         $(this).hide();
            //         $('#vistaRefeArriendosE').fadeIn(300);
            // });
            // $('#cargandoRefeArriendos').fadeOut('fast');
            // $('#codigoActualRefArr').fadeIn();

        });
    }

    function buscarReferenciasInsta(id_instalacion) {
        $('#codigoActualRefArr2').empty();


        $('#cargandoRefeArriendos').show();


        $('#codigoActualRefArr').empty();
        $('#ReferenciaNueva').val(null);
        $('#ReferenciaNueva').attr('disabled',true);
        $('#botonEditarRefe').attr('disabled',true);

        $('#pagarAlquilerResidente').modal('hide');
        setTimeout(function(){
            $('#editar_referencia_residente').modal('show');
        }, 500);

        $.get("residentes/"+id_instalacion+"/buscar_referencias2",function (data) {
        })
        .done(function(data) {
            console.log(data.length);
            if (data.length > 0) {
                if (data[0].status == 'En Proceso') {

                    if (data[0].refer) {
                        var refer = data[0].refer;
                    }else{
                        var refer = 'Sin referencia registrada';
                    }

                    $('#codigoActualRefArr').append(
                        '<center>'+
                            '<div class="row">'+
                                '<div class="col-md-12">'+
                                    '<div class="form-group">'+
                                        '<label for="">Código de Refer. Actual</label>'+
                                        '<h3 align="center" class="text-warning">'+refer+'</h3>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</center>'
                    );
                    $('#cargandoRefeArriendos').fadeOut('slow',
                        function() { 
                            $(this).hide();
                            $('#vistaRefeArriendosE').show();
                            $('#ReferenciaNueva').removeAttr('disabled',false);
                            $('#botonEditarRefe').removeAttr('disabled',false);
                    });
                }else if(data[0].status == 'Pagado'){

                    $('#vistaRefeArriendosE').hide();
                    $('#codigoActualRefArr2').append(
                        '<h3 align="center" class="text-success">¡El arriendo está pagado!</h3>'
                    );
                    $('#cargandoRefeArriendos').fadeOut('slow');

                }else{
                    $('#vistaRefeArriendosE').hide();
                    $('#codigoActualRefArr2').append(
                        '<h3 align="center">¡Este arriendo aún no ha sido pagado!</h3>'
                    );
                    $('#cargandoRefeArriendos').fadeOut('slow');
                }

                $('#id_arriendoEditReferencia').val(data[0].id_alquiler);

            }else{
                $('#codigoActualRefArr2').append(
                    '<h3 align="center">El residente no posee instalaciones</h3>'
                );
                $('#cargandoRefeArriendos').fadeOut('slow');
            }

            // $('#cargandoRefeArriendos').fadeOut('fast');
            // $('#codigoActualRefArr').fadeIn();

        });
    }

    function pagoAlquileres() {
        $('#example3_wrapper').empty();
        var id_residente= $('#id_reside').val();
        $('#cargandoPagoAlquileres').show();
        $('#pagarAlquilerResidente').modal('show');
        $('#mostrarAlquileresR').empty();

        $.get("residentes/"+id_residente+"/buscar_alquileres",function (data) {
        })
        .done(function(data) {
            console.log(data.length);
            if (data.length > 0) {
                $('#example3_wrapper').append(
                    '<table id="tablaArriendosR" class="table table-bordered table-hover table-striped display nowrap" style="width: 100% !important;">'+
                        '<thead>'+
                            '<tr>'+
                                '<th>Alquiler</th>'+
                                '<th>Tipo de alquiler</th>'+
                                '<th>Referencia</th>'+
                                '<th>Status</th>'+
                                '<th>Opciones</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody id="mostrarAlquileresR">'+
                            
                        '</tbody>'+
                    '</table>'
                );

                for (var i = 0; i < data.length; i++) {
                    if (data[i].status == 'No Pagado') {
                        var nombre= data[i].nombre;
                        var pagar = '<a data-toggle="tooltip" data-placement="top" title="Seleccione para pagar el alquiler" href="#" class="btn btn-warning" onclick="PagarAlquileres2('+data[i].id_alquiler+')">Pagar</a>';
                    }else{
                        if(data[i].status == 'En Proceso'){
                            var nombre= '<span class="text-warning">'+data[i].nombre+'</span>';
                            var pagar = '<a data-toggle="tooltip" data-placement="top" title="Seleccione si desea editar los datos del pago del alquiler" href="#" onclick="buscarReferenciasInsta('+data[i].id_instalacion+')" class="btn btn-warning">Editar</a>';
                        } else if(data[i].status == 'Pagado') {
                            var nombre= '<span class="text-success">'+data[i].nombre+'</span>';
                            var pagar = '<span class="text-success">Alquiler pagado</span>';
                        }
                    }
                    $('#mostrarAlquileresR').append(
                        '<tr>'+
                            '<td>'+nombre+'</td>'+
                            '<td>'+data[i].tipo_alquiler+'</td>'+
                            '<td>'+data[i].refer+'</td>'+
                            '<td>'+data[i].status+'</td>'+
                            '<td>'+pagar+'</td>'+
                        '</tr>'
                    );
                }

                if (i == data.length) {
                    $("#tablaArriendosR").DataTable({
                        "responsive": true,
                        "autoWidth": true,
                        "sort": false,
                        language: {
                            "decimal": "",
                            "emptyTable": "No hay información",
                            "info": "Mostrando la página _PAGE_ de _PAGES_",
                            "infoEmpty": "Mostrando 0 de 0 Entradas",
                            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_ Entradas",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "",
                            "zeroRecords": "Sin resultados encontrados",
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Próximo",
                            "previous": "Anterior",
                        }
                    });
                }
            }else{
                $('#MensajeBsucarArriendo').empty();
                $('#MensajeBsucarArriendo').append('<h3>No tiene asignado ningún alquiler</h3>');
            }
            $('#cargandoPagoAlquileres').hide();
        });
        
    }

    function PagarAlquileres2(id_alquiler) {

        $('#datosPagarAlquiler').hide();
        var id_residente= $('#id_reside').val();

        $.get("residentes/"+id_residente+"/buscar_alquileres",function (data) {
        })
        .done(function(data) {
            console.log(data.length);
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    if (data[i].id_alquiler == id_alquiler) {
                        $('#datosPagarAlquiler').show();

                        $('#nombreA').html(data[i].nombre);
                        $('#tipoAlquilerA').html(data[i].tipo_alquiler);
                        $('#montoA').html(data[i].monto_alquiler);
                        $('#monto_alquiler').val(data[i].monto_alquiler);
                    }
                }
            }else{
            }
        });


        $('#example3_wrapper').fadeOut('slow',
            function() { 
                $(this).hide();
                $('#referenciaBuscarArriendo').fadeIn(300);
        });
        $('#id_alquier_arriendo').val(id_alquiler);
    }

    function volverTablaPagarC() {

        $('#editar_referencia_residente').modal('hide');
        // $('#pagarAlquilerResidente').modal('show');
        setTimeout(function(){
            $('#pagarAlquilerResidente').modal('show');
        }, 500);
    }
    function volverTablaPagarC2() {

        $('#referenciaBuscarArriendo').fadeOut('slow',
            function() { 
                $(this).hide();
                $('#example3_wrapper').fadeIn(300);
        });
        // example3_wrapper
        // referenciaBuscarArriendo
    }

    function FlowCheckConsulta() {
      if($('#checkFlow').prop('checked')){
        // alert('Si');
        $('#referencia_p_arriendos').val(null);
        $('#referencia_p_arriendos').removeAttr('required',false);
        $('#referencia_p_arriendos').attr('disabled',true);
        $('#referencia_p_arriendos').removeClass('border').removeClass('border-primary');
      }else{
        // alert('No');
        $('#referencia_p_arriendos').attr('required',true);
        $('#referencia_p_arriendos').removeAttr('disabled',false);
        $('#referencia_p_arriendos').addClass('border').addClass('border-primary');
      }
    }

</script>
@section('scripts')


@endsection