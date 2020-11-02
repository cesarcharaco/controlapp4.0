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
        <input type="hidden" id="colorView" value="#25c2e3 !important">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Root</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Root</h4>
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
    <div class="card border border-info rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 offset-md-12">
                        <a class="btn btn-success boton-tabla shadow" id="btnRegistrar_admin" data-toggle="modal" data-target="#crearAdmin" style="
                            border-radius: 10px;
                            color: white;
                            height: 35px;
                            margin-bottom: 5px;
                            margin-top: 5px;
                            float: right;">
                            <span class="PalabraEditarPago ">Nuevo Admin</span>
                            <center>
                                <span class="PalabraEditarPago2 ">
                                    <i data-feather="plus" class="iconosMetaforas2"></i>
                                </span>
                            </center>
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
                <div id="example1_wrapper">
                    <table class="table dataTable data-table-basic table-curved table-striped tabla-estilo" style="width: 100%;">
                        <thead>
                            <tr class="table-default text-white">
                                <td colspan="6" align="center">
                                    <div class="card border border-info" style="background-color: #D6EAF8" role="alert">
                                        <span class="text-dark p-1 mb-1"><strong>Aviso: </strong><br>-Seleccione a un usuario administrador para ver mas opciones.</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-primary text-white" id="th2" style="display: none">
                                <th width="10"></th>
                                <th>
                                    <span class="PalabraEditarPago">Nombres</span>
                                    <span class="PalabraEditarPago2">N</span>
                                </th>
                                <th>
                                    <span class="PalabraEditarPago">Rut</span>
                                    <span class="PalabraEditarPago2">R</span>
                                </th>
                                <th colspan="2">
                                    <center>
                                        <span class="PalabraEditarPago">Opciones</span>
                                        <span class="PalabraEditarPago2">O</span>
                                    </center>
                                </th>
                                <th>
                                    <span class="PalabraEditarPago">Status</span>
                                    <span class="PalabraEditarPago2">S</span>
                                </th>
                            </tr>
                            <tr class="bg-info text-white" id="th1">
                                <th style="width: 1px !important;">#</th>
                                <th>
                                    <span class="PalabraEditarPago">Nombres</span>
                                    <span class="PalabraEditarPago2">N</span>
                                </th>
                                <th>
                                    <span class="PalabraEditarPago">Rut</span>
                                    <span class="PalabraEditarPago2">R</span>
                                </th>
                                <th>
                                    <span class="PalabraEditarPago">Email</span>
                                    <span class="PalabraEditarPago2">@</span>
                                </th>
                                <th>
                                    <span class="PalabraEditarPago">Registrado el</span>
                                    <span class="PalabraEditarPago2">R</span>
                                </th>
                                <th>
                                    <span class="PalabraEditarPago">Status</span>
                                    <span class="PalabraEditarPago2">S</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $num=0 @endphp
                            @foreach($admin as $key)
                                <tr id="vista1-{{$key->id}}" onclick="opcionesTabla(1,'{{$key->id}}')">
                                    <td align="center">
                                        {{$num=$num+1}}
                                    </td>
                                    <td style="position: all;">{{$key->name}}</td>
                                    <td style="position: all;">{{$key->rut}}</td>
                                    <td style="position: all;">{{$key->email}}</td>
                                    <td style="position: all;">{{$key->created_at}}</td>
                                     @if($key->status == 'activo')
                                        <td style="position: all;">
                                                <span class="tituloTabla text-success"><strong>Activo</strong></span>
                                                <span class="tituloTabla2 text-success"><strong>A</strong></span>
                                        </td>
                                    @else
                                        <td style="position: all;">
                                                <span class="tituloTabla text-danger"><strong>Inactivo</strong></span>
                                                <span class="tituloTabla2 text-danger"><strong>I</strong></span>
                                        </td>
                                    @endif
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
                                        <span>{{$key->name}}</span>
                                    </td>
                                    <td>
                                        
                                        <span>{{$key->rut}}</span>
                                    </td>
                                    <td style="display: none"></td>
                                    <td align="center" colspan="2">

                                        <a data-toggle="collapse" href="#verAdmin" role="button" aria-expanded="false" aria-controls="verAdmin" class="btn btn-success btn-sm" onclick="verAdmin('{{$key->id}}','{{$key->name}}','{{$key->rut}}','{{$key->email}}','{{$key->status}}','{{$key->membresia->nombre}}','{{$key->membresia->cant_inmuebles}}','{{$key->membresia->monto}}','{{$key->link_flow}}','{{$key->link_tb}}')">
                                            <span class="PalabraEditarPago ">Ver</span>
                                            <center>
                                                <span class="PalabraEditarPago2 ">
                                                    <i data-feather="eye" class="iconosMetaforas2"></i>
                                                </span>
                                            </center>
                                        </a>

                                        <a href="#" class="btn btn-warning btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px;" data-toggle="modal" data-target="#editarResidente" onclick="Editar('{{$key->id}}','{{$key->name}}','{{$key->rut}}','{{$key->email}}','{{$key->status}}','{{$key->membresia->nombre}}','{{$key->membresia->cant_inmuebles}}','{{$key->membresia->monto}}','{{$key->link_flow}}','{{$key->link_tb}}')">
                                            <span class="PalabraEditarPago ">Editar</span>
                                            <center>
                                                <span class="PalabraEditarPago2 ">
                                                    <i data-feather="edit" class="iconosMetaforas2"></i>
                                                </span>
                                            </center>
                                        </a>

                                        <a href="#" class="btn btn-danger btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px;"data-toggle="modal" data-target="#eliminarResidente" onclick="Eliminar('{{$key->id}}')">
                                            <span class="PalabraEditarPago ">Eliminar</span>
                                            <center>
                                                <span class="PalabraEditarPago2 ">
                                                    <i data-feather="trash" class="iconosMetaforas2"></i>
                                                </span>
                                            </center>
                                        </a>
                                    </td>
                                    @if($key->status == 'activo')
                                        <td style="position: all;">
                                                <span class="tituloTabla text-success"><strong>Activo</strong></span>
                                                <span class="tituloTabla2 text-success"><strong>A</strong></span>
                                        </td>
                                    @else
                                        <td style="position: all;">
                                                <span class="tituloTabla text-danger"><strong>Inactivo</strong></span>
                                                <span class="tituloTabla2 text-danger"><strong>I</strong></span>
                                        </td>
                                    @endif


                                </tr>
                            <!-- <tr style="display: none;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr> -->
                            @endforeach()
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

        




@include('root.modales.crearAdmin')
@include('root.modales.eliminarAdmin')
@include('root.modales.editarAdmin')
    </div>
@endsection
@section('scripts')
<script>
$('#check_flow').on('change',function () {
    if ($('#check_flow').prop('checked')) {
      $('#link_flow').attr('disabled',false);
      $("#link_flow").prop('required', true);
    }else{
      $('#link_flow').attr('disabled',true);
      $("#link_flow").removeAttr('required');
      link_flow.value="";
    }
  });    
</script>
<script>
$('#check_tb').on('change',function () {
    if ($('#check_tb').prop('checked')) {
      $('#link_tb').attr('disabled',false);
      $("#link_tb").prop('required', true);
    }else{
      $('#link_tb').attr('disabled',true);
      $("#link_tb").removeAttr('required');
      link_tb.value="";
    }
  });    
</script>

<script>
$('#check_flow_edit').on('change',function () {
    if ($('#check_flow_edit').prop('checked')) {
      $('#link_flow_edit').attr('disabled',false);
      $("#link_flow_edit").prop('required', true);
    }else{
      $('#link_flow_edit').attr('disabled',true);
      $("#link_flow_edit").removeAttr('required');
    }
  });    
</script>
<script>
$('#check_tb_edit').on('change',function () {
    if ($('#check_tb_edit').prop('checked')) {
      $('#link_tb_edit').attr('disabled',false);
      $("#link_tb_edit").prop('required', true);
    }else{
      $('#link_tb_edit').attr('disabled',true);
      $("#link_tb_edit").removeAttr('required');
    }
  });    
</script>

<script type="text/javascript">

    function cerrar(opcion) {
      $('#example1_wrapper').fadeIn('fast');
      $('#btnRegistrar_admin').show();
    }

    function verAdmin(id,name,rut,email,status,membresia_nombre,membresia_cant,membresia_monto,link_flow, link_tb) {
        $('#ver_pasarelas_pago').empty();
        $('#ver_pasarelas_pago').append('Cargando pasarelas...');
        if (status == 'activo') {
            status='<div class="card-body" style="height:110px !important;"><h3><span class="text-success">Activo</span></h3></div>';
        }else{
            status='<div class="card-body" style="height:110px !important;"><h3><span class="text-danger">Suspendido</span></h3></div>';
        }
        $('#id_admin_v').html(id);
        $('#name_v').html(name);
        $('#rut_v').html(rut);
        $('#email_v').html(email);
        $('#status_v').html(status);
        $("#membresia_v").append('<div class="card-body border border-warning"><h3>'+membresia_nombre+'</h3> <span>Cant. Inmuebles: '+membresia_cant+'</span> - <strong>Monto: '+membresia_monto+'$</strong></div>');
        $('#link_flow_edit').val(link_flow);
        $('#link_tb_edit').val(link_tb);


        $.get("pasarelas/"+id+"/buscar",function (data) {
        })
        .done(function(data) {
            $('#ver_pasarelas_pago').empty();
            console.log(data.length)
            if (data.length>0) {
                for (var i = 0; i < data.length; i++) {
                    $('#ver_pasarelas_pago').append('<h3>'+data[i].pasarela+' - '+data[i].link_pasarela+'</h3>');
                }
            }else{
                $('#ver_pasarelas_pago').append('<h3>No hay pasarelas de pago</h3>');
            }
        });






        $('#btnRegistrar_admin').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');
    }
        function Editar(id,name,rut,email,status,membresia_nombre,membresia_cant,membresia_monto,link_flow, link_tb) {
            $('#editarAdmin').modal('show');
            $('#id_admin_e').val(id);
            $('#name_e').val(name);
            $('#rut_e').val(rut.substr(0,(rut.length-2)));
            $('#verificador_e').val(rut.substr(-1,(rut.length)));
            $('#email_e').val(email);
            $('#status_e').val(status);
            $("#membresia_e").append('<input id="membresia_actual" class="form-control" value="'+membresia_nombre+' | Cant. Inmuebles: '+membresia_cant+' | Monto: '+membresia_monto+'" disabled="disabled">');
            $('#link_flow_edit').val(link_flow);
            $('#link_tb_edit').val(link_tb);

            $.get("pasarelas/"+id+"/buscar",function (data) {
            })
            .done(function(data) {
                $('#id_pasarela_edit').empty();
                console.log(data.length)
                if (data.length>0) {
                    for (var i = 0; i < data.length; i++) {
                        $('#id_pasarela_edit').append('<span><strong>'+data[i].pasarela+':</strong> '+data[i].link_pasarela+'</span><br>');
                    }
                }else{
                    $('#id_pasarela_edit').append('<h2>No tiene pasarelas de pago registradas</h2>');
                }
            });
        }

        function CambiarContraseña() {
            if($('#CheckCambiarContraseña').prop('checked')){

                $('#verCambiarContraseña').fadeIn(300);
                $('#contraseñaE').attr('required',true);
                $('#confirmarContraseñaE').attr('required',true);
                
            }else{

                $('#verCambiarContraseña').fadeOut('slow',
                    function() { 
                        $(this).css('display','none');
                });
                $('#contraseñaE').removeAttr('required',false);
                $('#confirmarContraseñaE').removeAttr('required',false);               
            }
        }

        function CambiarPagos() {
            if($('#CheckCambiarPagos').prop('checked')){

                $('#verCambiarPagos').fadeIn(300);
                $('#contraseñaE').attr('required',true);
                $('#confirmarContraseñaE').attr('required',true);
                
            }else{

                $('#verCambiarPagos').fadeOut('slow',
                    function() { 
                        $(this).css('display','none');
                });
                $('#contraseñaE').removeAttr('required',false);
                $('#confirmarContraseñaE').removeAttr('required',false);               
            }
        }

        function CambiarMembresia() {
            if($('#CheckCambiarMembresia').prop('checked')){

                $('#verCambiarMembresia').fadeIn(300);
                $('#contraseñaE').attr('required',true);
                $('#confirmarContraseñaE').attr('required',true);
                
            }else{

                $('#verCambiarMembresia').fadeOut('slow',
                    function() { 
                        $(this).css('display','none');
                });
                $('#contraseñaE').removeAttr('required',false);
                $('#confirmarContraseñaE').removeAttr('required',false);               
            }
        }
        function agregarPasarelas() {
            if($('#CheckagregarPasarelas').prop('checked')){

                $('#pasarelas_pago').fadeIn(300);
                $('#id_pasarela').attr('required',true);
                $('#link_pasarela').attr('required',true);
                
            }else{

                $('#pasarelas_pago').fadeOut('slow',
                    function() { 
                        $(this).css('display','none');
                });
                $('#id_pasarela').removeAttr('required',false);
                $('#link_pasarela').removeAttr('required',false);               
            }
        }
        
    </script>
    <script type="text/javascript">

        function Eliminar(id) {
            $('#eliminarAdmin').modal('show');
            $('#id_admin').val(id);
        }
        // function decimal(valor) {
        //     alert(valor.length);
        //     var valor2='';

        //     if(valor.length=<3){
        //         valor2=String(valor.substr(1,2,3)+'.'+valor.substr(4,5,6));
        //     }

        //     alert(valor2);



        // }
    </script>
    @endsection