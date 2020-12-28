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
    @if(\Auth::user()->tipo_usuario=="Residente")
        <input type="hidden" name="id_residente" id="id_reside" value="{{\Auth::user()->id}}">
    @endif
    <div class="row page-title">
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

    <div class="card border border-info rounded card-tabla shadow p-3 mb-5 bg-white rounded">
        <div class="row justify-content-center">
            <div class="col-md-12">
                
                <div style="height: 100%;">
                    @include('alquiler.layouts_instalacion.show')
                    @include('alquiler.layouts_arriendo.create')

                    @if(\Auth::user()->tipo_usuario=="Admin")
                        @include('alquiler.layouts_instalacion.create')
                        @include('alquiler.layouts_instalacion.edit')
                        @include('alquiler.layouts_instalacion.edit_status')
                        @include('alquiler.layouts_instalacion.delete')
                    @endif
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @if(\Auth::user()->tipo_usuario=="Admin")
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
            @endif
            

            <div class="col-md-12">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                    <table class="table table-bordered table-hover table-striped dataTable" style="width: 100% !important;">
                        <thead>
                            <tr>
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

                                        <a data-toggle="tooltip" data-placement="top" title="Seleccione para ver la instalación" href="#VerInstalacion" role="button" aria-expanded="false" aria-controls="VerInstalacion" class="btn btn-success btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="VerInstalacion(
                                            '{{$key->id}}',
                                            '{{$key->nombre}}',
                                            '{{$key->id_dia}}',
                                            '{{$key->hora_desde}}',
                                            '{{$key->hora_hasta}}',
                                            '{{$key->costo_permanente}}',
                                            '{{$key->costo_temporal}}',
                                            '{{$key->max_personas}}',
                                            '{{$key->status}}')">

                                            <span>
                                                <i data-feather="eye"></i>Ver
                                            </span>
                                        </a>

                                        @if(\Auth::User()->tipo_usuario !="Admin")
                                            <span data-toggle="tooltip" data-placement="top" title="Seleccione si desea alquilar esta instalación">
                                                <a data-toggle="collapse" href="#nuevoArriendo" id="btnRegistrar_arriendo" role="button" aria-expanded="false" aria-controls="nuevoArriendo" class="btn btn-info shadow btn-sm" onclick="nuevoArriendo('{{$key->id}}')" >
                                                    <i data-feather="dollar-sign"></i>
                                                    Alquilar Instalación
                                                </a>
                                        @endif
                                        @if(\Auth::User()->tipo_usuario=="Admin")
                                            <span data-toggle="tooltip" data-placement="top" title="Seleccione para editar los datos del arriendo">
                                                <a data-toggle="collapse" href="#editarInstalacion" role="button" aria-expanded="false" aria-controls="editarInstalacion" class="btn btn-warning btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="editarInstalacion(
                                                    '{{$key->id}}',
                                                    '{{$key->nombre}}',
                                                    '{{$key->id_dia}}',
                                                    '{{$key->hora_desde}}',
                                                    '{{$key->hora_hasta}}',
                                                    '{{$key->costo_permanente}}',
                                                    '{{$key->costo_temporal}}',
                                                    '{{$key->max_personas}}',
                                                    '{{$key->status}}')">

                                                    <span><strong>Editar</strong></span>
                                                </a>
                                            </span>
                                        @if($key->status == 'Activo')
                                            <span data-toggle="tooltip" data-placement="top" title="Seleccione para desactivar el arriendo">
                                                <a data-toggle="collapse" href="#statusInstalacion" role="button" aria-expanded="false" aria-controls="statusInstalacion"  class="btn btn-info btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="statusInstalacion('{{$key->id}}','{{$key->nombre}}','{{$key->status}}')">
                                                    <span>Desactivar</span>
                                                </a>
                                            </span>
                                        @else
                                            <span data-toggle="tooltip" data-placement="top" title="Seleccione para activar el arriendo">
                                                <a data-toggle="collapse" href="#activarInstalacion" role="button" aria-expanded="false" aria-controls="activarInstalacion"  class="btn btn-success btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="statusInstalacion('{{$key->id}}','{{$key->nombre}}','{{$key->status}}')">
                                                    <span data-toggle="tooltip" data-placement="top" title="Seleccione para activar instalación">Activar</span>
                                                </a>
                                            </span>
                                        @endif
                                        <span data-toggle="tooltip" data-placement="top" title="Seleccione para eliminar instalación">
                                            <a data-toggle="collapse" href="#EliminarInstalacion" role="button" aria-expanded="false" aria-controls="EliminarInstalacion"  class="btn btn-danger btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="eliminarInstalacion('{{$key->id}}')">
                                                <span>Eliminar</span>
                                            </a>
                                        </span>
                                        @endif
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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

    function nuevoArriendo(id_instalacion) {

        
        var id_residente = $('#id_reside').val();
        $('#id_residenteC').val(id_residente);
        $('#instalacionList').val(id_instalacion);
        $('#btnRegistrar_insta').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');
        $('#tipo_alquiler_c').attr('disabled', true);
        $('#tipo_alquilerArriendoE').attr('disabled', true);

        $('#tipo_alquiler_v').hide();
        $('.vistaCostoT').hide();
        $('.vistaCostoP').hide();


        $('#montoTArriendo').val(null).removeAttr('disabled',false);
        $('#costo_temporal').val(null).removeAttr('disabled',false);
        
        $.get("instalacion/"+id_instalacion+"/buscar",function (data) {
        })
        .done(function(data) {
            console.log(data.length);
            if (data.length>0) {
                $('#tipo_alquiler_c').removeAttr('disabled', false).val(0);
                $('#tipo_alquilerArriendoE').removeAttr('disabled', false).val(0);
                $('#tipo_alquiler_v').fadeIn(300);
                $('.vistaCostoT').hide();
                $('.vistaCostoP').hide();

                if(data[0].costo_permanente > 0){
                    $('#total_costo_p').html(data[0].costo_permanente+'$');
                    $('#costo_permanente').val(data[0].costo_permanente);
                }else{
                    $('#total_costo_p').html('Sin costo permanente');
                    $('#costo_permanente').val(0);
                }


                if (data[0].costo_temporal > 0) {
                    $('#montoTArriendo').val(data[0].costo_temporal);
                    $('#costo_temporal').val(data[0].costo_temporal);
                    $('.num_horas').removeAttr('disabled', false);
                }else{
                    $('#montoTArriendo').val(null).attr('disabled',true);
                    $('#costo_temporal').val(null).attr('disabled',true);
                    $('.num_horas').attr('disabled',true);
                }


                $('#num_horas').val(1);
            }
        });
        

    }

    function VerArriendo(nombres,apellidos,rut,nombre_I,tipo_alquiler,fecha,hora,num_horas,status,status2,referencia,id_planesPago) {
        $('#btnRegistrar_arriendo').hide();
        $('#example2_wrapper').hide();

        $('#id_residenteArriendo_2').html(nombres+' '+apellidos+' -'+rut);
        $('#instalacionListArriendo_2').html(nombre_I);
        $('#tipo_alquilerArriendo_2').html(tipo_alquiler);
        if(fecha >0){
            $('#fechaAlquilerArriendo_2').html(fecha);
        }else{
            $('#fechaAlquilerArriendo_2').html('Sin fecha registrada');
        }
        if(hora >0){
            $('#horaAlquilerArriendo_2').html(hora);
        }else{
            $('#horaAlquilerArriendo_2').html('Sin hora registrada');
        }
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
        $('#planPArriendoE_2'+id_planesPago).prop('checked', true);
        $('#verArriendo2').collapse('show');

    }

    function editarArriendo(id,id_residente,id_instalacion,costo_permanente,costo_temporal,tipo_alquiler,fecha,hora,num_horas,status,status2,referencia,monto) {
        $('#tipo_alquiler').val(null);

        $('.tipo_alquiler').show();

        $('#btnRegistrar_arriendo').fadeOut('fast');
        $('#example2_wrapper').fadeOut('fast');

        $('#id_residenteArriendoE').val(id_residente);
        $('#instalacionListArriendoE').val(id_instalacion);
        $('#tipo_alquilerArriendoE').val(tipo_alquiler);


        $('#costo_temporal').val(costo_temporal);
        $('#costo_permanente').val(costo_permanente);


        var monto_temporal = num_horas * costo_temporal;

        $('#monto_t_a').val(monto_temporal);
        $('#montoTArriendoE').val(monto_temporal);
        if (costo_permanente > 0) {
            $('#monto_p_a2').html(costo_permanente);
        }else{
            $('#monto_p_a2').html('Sin costo permanente');
        }

        if(tipo_alquiler == 'Permanente'){
            $(".vistaCostoT").hide();
            $('.vistaCostoP').show();
            $('.fechaAlquiler').removeAttr('required',false);
            $('.horaAlquiler').removeAttr('required',false);
        }else{
            $(".vistaCostoT").show();
            $('.vistaCostoP').hide();
            $('.fechaAlquiler').attr('required',true);
            $('.horaAlquiler').attr('required',true);
        }
        $('#tipo_alquiler_s').html(tipo_alquiler);
        $('#fechaAlquilerArriendoE').val(fecha);
        $('#horaAlquilerArriendoE').val(hora);
        $('#num_horasArriendoE').val(num_horas);
        $('#statusArriendoE').val(status);

        $('#pagadoArriendoE').val(status2);

        // if(status2 == 'Pagado'){
        //     $('#pagadoArriendoE').prop('checked', true);
        // }else{
        //     $('#pagadoArriendoE').removeAttr('checked', false);
        // }

        $('#pagadoArriendoE2').html(status2);
        $('#status_pago_e').empty();
        if (status == 'Pagado') {
            $('#status_pago_e').append('<h1 class="text-success">Pagado</h1>');
        }else if(status2 == 'En Proceso'){
            $('#status_pago_e').append('<h1 class="text-warning">En Proceso</h1>');
        }else{
            $('#status_pago_e').append('<h1 class="text-danger">No Pagado</h1>');
        }

        $('#referenciaArriendoE').val(referencia);
        $('#planPArriendoE'+id).prop('checked', true);

        $('#id_editarArriendo').val(id);

    }

    function eliminarArriendo(id, id_instalacion) {
        $('#id_ArriendoE').val(id);
        $('#id_instalacion').val(id_instalacion);
        $('#btnRegistrar_arriendo').fadeOut('fast');
        $('#example2_wrapper').fadeOut('fast');
    }






    function crearInstalacion() {
        $('#btnRegistrar_insta').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');
    }

    function VerInstalacion(id,nombre,id_dia,hora_desde,hora_hasta,costo_permanente,costo_temporal,max_personas,status) {
        $('#nombreInstalacion_2').html(nombre);
        $('#id_diaInstalacion_2').html(id_dia);
        $('#desdeInstalacion_2').html(hora_desde);
        $('#hastaInstalacion_2').html(hora_hasta);
        $('#costoPInstalacion2').html(costo_permanente);
        $('#costoTInstalacion2').html(costo_temporal);
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

        $('#VerInstalacion').collapse('show');
        $('#btnRegistrar_insta').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');
    }

    function editarInstalacion(id,nombre,id_dia,hora_desde,hora_hasta,costo_permanente,costo_temporal,max_personas,status) {

        $('#idInstalacion').val(id);
        $('#nombreInstalacion').val(nombre);
        $('#id_diaInstalacion').val(id_dia);
        $('#desdeInstalacion').val(hora_desde);
        $('#hastaInstalacion').val(hora_hasta);
        $('#costoPinstala').val(costo_permanente);
        $('#costoTinstala').val(costo_temporal);
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
        $('#example1_wrapper').fadeOut('fast');
    }

    function eliminarInstalacion(id) {
        $('#id_instalacion_eliminar').val(id);
        $('#btnRegistrar_insta').fadeOut('fast');
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
        $('#example1_wrapper').fadeOut('fast');
    }

    function statusArriendos(id, nombre, status) {
        $('#id_Arriendo_des').val(id);
        $('#cambiarStatusA').val(status);
        $('#NombreArriendo').html(nombre);

        $('#id_Arriendo_des_A_2').val(id);
        $('#cambiarStatus_A_2').val(status);
        $('#NombreArriendo2').html(nombre);

        $('#btnRegistrar_arriendo').fadeOut('fast');
        $('#example2_wrapper').fadeOut('fast');
    }

    function EditReferenciasArriendos(id_arriendo) {
        $('#id_arriendoEditReferencia').val(id_arriendo);
        $('#vistaRefeArriendosE').hide();
        $('#cargandoRefeArriendos').css('display','block');
        $('#btnRegistrar_arriendo').fadeOut('fast');
        $('#example2_wrapper').fadeOut('fast');

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
                                    '<h3>Monto de la operación: '+data[0].monto+'</h3>'+
                                    '<h3>Código de Referencia Actual: <b class="text-warning">'+data[0].refer+'</b></h3>'+
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

    function pagarArriendos(id_arriendo) {
        $('#id_pagar_arriendo').val(id_arriendo);
        $('#vistaPagarArriendos').hide();
        $('#cargandoPagarArriendos').css('display','block');
        $('#btnRegistrar_arriendo').fadeOut('fast');
        $('#example2_wrapper').fadeOut('fast');

        $('#monto_pagar').empty();
        

        $.get("arriendos/"+id_arriendo+"/buscar_pagar_arriendo",function (data) {
        })
        .done(function(data) {
            if (data[0].status=='No Pagado') {
                console.log(data[0].status);
                $('#monto_pagar').append(
                    '<center>'+
                        '<div class="row">'+
                            '<div class="col-md-4">'+
                                '<div class="form-group">'+
                                    '<h3>Alquiler: '+data[0].instalacion+'</h3>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<div class="form-group">'+
                                    '<h3>Tipo de alquiler: <span class="text-warning">'+data[0].tipo+'</span></h3>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<div class="form-group">'+
                                    '<h3>Monto de la operación: <span class="text-success">'+data[0].monto+'</span></h3>'+
                                    '<input type="hidden" name="monto_alquiler" id="monto_alquiler" value="'+data[0].monto+'">'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</center>'
                );
                $('#status_arriendo').val(data[0].status);
                $('#tipo_alq').val(data[0].tipo);
                $('#id_instalacion').val(data[0].id_instalacion);
                $('#instalacion').val(data[0].instalacion);
                $('#id_residente_p').val(data[0].id_residente);
                $('#monto_p').val(data[0].monto);
                $('#quitar_ref').css('display','block');
            }else{
                $('#monto_pagar').append(
                    '<h3 align="center">¿Está seguro que desea pagar este alquiler ?</h3>'+
                    '<h3 align="center">Status actual es: <span class="text-warning">'+data[0].status+'</span></h3>'+
                    '<h3 align="center">Referencia de la operación es: <span class="text-warning">'+data[0].refer+'</span></h3>'+
                    '<h3 align="center">Monto de la operación es: '+data[0].monto+'</h3>'
                );
                $('#status_arriendo').val(data[0].status);
                $('#tipo_alq').val(data[0].tipo);
                $('#id_instalacion').val(data[0].id_instalacion);
                $('#instalacion').val(data[0].instalacion);
                $('#id_residente_p').val(data[0].id_residente);
                $('#monto_p').val(data[0].monto);
                $('#quitar_ref').css('display','none');
                $('#referencia').removeAttr('required',false);
            }

            $('#cargandoPagarArriendos').fadeOut('slow',
                function() { 
                    $(this).hide();
                    $('#vistaPagarArriendos').fadeIn(300);
            });

        });
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

    function calcularMontoT(key) {
        var costo = $('#costo_temporal').val();
        var total = key * costo;
        $('#montoTArriendo').val(total);
        $('#monto_t_a').val(total);
    }


    function buscarInslatacion(id) {

        $('#montoTArriendo').val(null).removeAttr('disabled',false);
        $('#costo_temporal').val(null).removeAttr('disabled',false);
        
        $.get("instalacion/"+id+"/buscar",function (data) {
        })
        .done(function(data) {
            console.log(data.length);
            if (data.length>0) {
                $('#tipo_alquiler_c').removeAttr('disabled', false).val(0);
                $('#tipo_alquilerArriendoE').removeAttr('disabled', false).val(0);
                $('#tipo_alquiler_v').fadeIn(300);
                $('.vistaCostoT').hide();
                $('.vistaCostoP').hide();

                if(data[0].costo_permanente > 0){
                    $('#total_costo_p').html(data[0].costo_permanente+'$');
                    $('#costo_permanente').val(data[0].costo_permanente);
                }else{
                    $('#total_costo_p').html('Sin costo permanente');
                    $('#costo_permanente').val(0);
                }


                if (data[0].costo_temporal > 0) {
                    $('#montoTArriendo').val(data[0].costo_temporal);
                    $('#costo_temporal').val(data[0].costo_temporal);
                    $('.num_horas').removeAttr('disabled', false);
                }else{
                    $('#montoTArriendo').val(null).attr('disabled',true);
                    $('#costo_temporal').val(null).attr('disabled',true);
                    $('.num_horas').attr('disabled',true);
                }


                $('#num_horas').val(1);
            }
        });
    }
    function TipoAlquiler(opcion) {

        if(opcion == 'Permanente'){
            $(".vistaCostoT").fadeOut("slow",
              function() {
                $(this).hide();
                $('.vistaCostoP').fadeIn(300);
            });
            $('.fechaAlquiler').removeAttr('required',false);
            $('.horaAlquiler').removeAttr('required',false);
        }else if(opcion == 'Temporal'){
            $(".vistaCostoP").fadeOut("slow",
              function() {
                $(this).hide();
                $('.vistaCostoT').fadeIn(300);
            });
            $('.fechaAlquiler').attr('required',true);
            $('.horaAlquiler').attr('required',true);
        }
        else{
            $('.fechaAlquiler').attr('required',true);
            $('.horaAlquiler').attr('required',true);

            $('.vistaCostoT').fadeIn(300);
            $('.vistaCostoP').fadeIn(300);
        }
    }

    function modalidadAlquiler(opcion) {
        if (opcion == 1) {
            $(".modalidadAlquiler2").fadeOut("slow",
              function() {
                $(this).hide();
                $('.modalidadAlquiler1').fadeIn('show');
            });
            $('.costo_permanente').attr('required',true);
            $('.costo_temporal').removeAttr('required',false);
        }else if(opcion == 2){
            $(".modalidadAlquiler1").fadeOut("slow",
              function() {
                $(this).hide();
                $('.modalidadAlquiler2').fadeIn('show');
            });
            $('.costo_permanente').removeAttr('required',false);
            $('.costo_temporal').attr('required',true);
        }else{
            $('.modalidadAlquiler1').fadeIn(300);
            $('.modalidadAlquiler2').fadeIn(300);

            $('.costo_permanente').attr('required',true);
            $('.costo_temporal').attr('required',true);
        }
    }
    function cargarRef(elemento) {
        d = elemento.value;
        if (d == "") {
          $('#referencia_p').css('display','none');
        } else {
            if(d == "Efectivo"){
                $('#referencia_p').css('display','none');
                $('#refeCreateA').removeAttr('required',false);
                $('#refeCreateA').attr('disabled',true);
            }else{
                $('#referencia_p').removeAttr('style',false);
                $('#refeCreateA').attr('required',true);
                $('#refeCreateA').attr('disabled',false);
            }
        }
    }
  
</script>