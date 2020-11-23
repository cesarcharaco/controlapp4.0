@extends('layouts.app')

@section('content')

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
                    <table class="table table-bordered table-hover table-striped dataTable" style="width: 100% !important;">
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
                                        <a class="btn btn-info btn-sm" href="#verAdmin" data-toggle="tooltip" data-placement="top" title="Seleccione para ver los datos del administrador" id="btnRegistrar_arriendo" role="button" aria-expanded="false" aria-controls="verAdmin" onclick="verAdmin(
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
                                        <a href="#" class="btn btn-warning btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="Editar('{{$key->id}}','{{$key->name}}','{{$key->rut}}','{{$key->email}}','{{$key->status}}','{{$key->membresia->nombre}}','{{$key->membresia->cant_inmuebles}}','{{$key->membresia->monto}}')" data-toggle="tooltip" data-placement="top" title="Seleccione para editar los datos del administrador">
                                            <span><i data-feather="edit"></i>Editar</span>
                                        </a>

                                        <a href="#" class="btn btn-danger btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="Eliminar('{{$key->id}}')" data-toggle="tooltip" data-placement="top" title="Seleccione para eliminar al administrador">
                                            <span><i data-feather="trash"></i>Eliminar</span>
                                        </a>
                                    </td>
                                </tr>
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

    function crearAdmin() {
        $('#crearAdmin').modal('show');
    }

    function verAdmin(id,name,rut,email,status,membresia_nombre,membresia_cant,membresia_monto) {
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
        $("#membresia_v").empty();
        $("#membresia_v").append('<div class="card-body border border-warning"><h3>'+membresia_nombre+'</h3> <span>Cant. Inmuebles: '+membresia_cant+'</span> - <strong>Monto: '+membresia_monto+'$</strong></div>');
        // $('#link_flow_edit').val(link_flow);
        // $('#link_tb_edit').val(link_tb);


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


        $('#verAdmin').collapse('show');



        $('#btnRegistrar_admin').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');
    }
        function Editar(id,name,rut,email,status,membresia_nombre,membresia_cant,membresia_monto,link_flow, link_tb) {
            $('#editarResidente').modal('show');

            $('#editarAdmin').modal('show');
            $('#id_admin_e').val(id);
            $('#name_e').val(name);
            $('#rut_e').val(rut.substr(0,(rut.length-2)));
            $('#verificador_e').val(rut.substr(-1,(rut.length)));
            $('#email_e').val(email);
            $('#status_e').val(status);
            $("#membresia_e").empty();
            $("#membresia_e").append('<input id="membresia_actual" class="form-control" value="'+membresia_nombre+' | Cant. Inmuebles: '+membresia_cant+' | Monto: '+membresia_monto+'" disabled="disabled">');
            $('#link_flow_edit').val(link_flow);
            $('#link_tb_edit').val(link_tb);

            $.get("pasarelas/"+id+"/buscar",function (data) {
            })
            .done(function(data) {
                $('#id_pasarela_edit').empty();
                // console.log(data.length);
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