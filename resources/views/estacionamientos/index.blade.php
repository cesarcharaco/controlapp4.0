@extends('layouts.app')

@section('content')

    <div class="container">
        <input type="hidden" id="colorView" value="#cccc00 !important">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Estacionamientos</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Estacionamientos</h4>
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
    <div class="card rounded card-tabla shadow p-3 mb-5 bg-white rounded">
        <div class="row justify-content-center">
            @if(\Auth::user()->tipo_usuario == 'Admin')
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 offset-md-12">
                            <a class="btn boton-tabla shadow" data-toggle="modal" data-target="#crearEstacionamiento" style="
                                border-radius: 10px;
                                color: white;
                                height: 35px;
                                margin-bottom: 5px;
                                margin-top: 5px;
                                float: right;
                                border: 1px solid #f6f6f7!important;
                                border-color: #cccc00 !important;
                                background-color: #cccc00 !important;">

                                <span class="text-white"><i data-feather="plus"></i>Nuevo Estacionamientos</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            

        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
            <table id="example1" class="table table-bordered table-hover table-striped dataTable display nowrap" cellspacing="0" style="width: 100% !important;">
                <thead>
                    <tr class="bg-primary text-white">
                        <th>#</th>
                        <th>Idem</th>
                        <th>Status</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $num=0 @endphp
                    @foreach($estacionamientos as $key)
                        <tr>
                            <td align="center">{{$num=$num+1}}</td>
                            <td>{{$key->idem}}</td>
                            @if($key->status == 'Libre')
                                <td>Libre</td>
                            @else
                                <td>En Uso</td>
                            @endif
                            <td>
                                @if(\Auth::user()->tipo_usuario == 'Admin')
                                    <a href="#" class="btn btn-warning btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="select(2,'{{$key->id}}','{{$key->idem}}','{{$key->status}}')">
                                        <i data-feather="edit"></i>Editar
                                    </a>

                                    <a href="#" class="btn btn-danger btn-sm boton-tabla shadow" style="border-radius: 5px;" onclick="select(3,'{{$key->id}}','{{$key->idem}}','{{$key->status}}')">
                                        <i data-feather="trash"></i>Eliminar
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach()
                </tbody>
            </table>
        </div>
    </div> 

    @include('estacionamientos.layouts.create')
    @include('estacionamientos.layouts.show')
    @include('estacionamientos.layouts.edit')
    @include('estacionamientos.layouts.delete')

    @include('estacionamientos.layouts.registrar_mensualidad')
    @include('estacionamientos.layouts.editar_mensualidad')
    @include('estacionamientos.layouts.ver_mensualidad')
    @include('estacionamientos.layouts.mensualidad_delete')

    </div>
            


@endsection

<script type="text/javascript">

    function select(accion, id, idem, status) {

        if (accion==1) {
            $('#VerEstacionamiento').modal('show');
            $('#ver_idem').val(idem);
            $('#ver_status').val(status);
        }
        if(accion==2){
            editar(id, idem, status);
            $('#editarEstacionamiento').modal('show');
        }
        if (accion==3) {
            $('#id').val(id);
            $('#eliminarEstacionamiento').modal('show');
        } else {

        }
    }

    // function eliminar(id) {
    //     $('#id').val(id);
    // }

    function mensual(accion, id) {

        $('#selectO').val(0);
        if (accion==1) {
            $('#SelectAnio1').val(0);
            $('#createMensualidad').modal('show');
            $('#buttonCreate').empty();
            $('#createMensuality1').empty();
            $('#createMensuality2').empty();
            $('#idCreateM').val(id);
            // $('#anioCreateM').val(anio);
        }
        if(accion==2){
            $('#SelectAnio2').val(0);
            $('#editMensuality1').empty();
            $('#editMensuality2').empty();
            $('#buttonEdit').empty();
            $('#editarMensualidad').modal('show');
            $('#idEditM').val(id);
            // $('#anioEditM').val(anio);
        }
        if (accion==3) {
            $('#deleteMensualidad').modal('show');
            $('#idDeleteM').val(id);
            // $('#anioDeleteM').val(anio);
        } 
        if (accion==4){
            $('#buttonShow').empty();
            $('#fechasM').empty();
            $('#MesesM').empty();
            $('#idShowM').val(id);
            $('#VerMensualidades').modal('show');

            $.get('estacionamientos/'+id+'/buscar_anios', function(data) {
        
                beforeSend: $('#MesesM').append('Cargando...');
                complete: $('#MesesM').empty();
                    
                if (data.length > 0) {

                    $('#fechasM').append(
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label>Especifique el año para ver la mensualidad</label>'+
                                        '<select class="form-control" onchange="accionM(4,this.value);" id="verFechaMensual">'+
                                            '<option value="0">Seleccionar año</option>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );

                    for (var i = 0; i < data.length; i++) {
                        $('#verFechaMensual').append('<option value="'+data[i].anio+'">'+data[i].anio+'</option>');
                    }
                    
                }else
                    $('#fechasM').append('El estacionamiento no posee mensualidades');

            });
        }else {

        }
    }


    function mostrarC(opcion) {
        if (opcion==1) {
            $('#createMensuality1').show();
            $('#createMensuality2').hide();
            $('#montoAnioC').attr('disabled',true);
            $('#accionCreate').val(1);
        } else {
            $('#createMensuality1').hide();
            $('#createMensuality2').show();
            $('#montoAnioC').attr('disabled',false);
            $('#accionCreate').val(2);
        }
    }

    function mostrarE(opcion) {
        if (opcion==1) {
            $('#montoAnio_e').attr('disabled',true);
            $('#editMensuality1').show();
            $('#editMensuality2').hide();
            $('#accionEdit').val(1);
        } else {
            $('#montoAnio_e').attr('disabled',false);
            $('#editMensuality1').hide();
            $('#editMensuality2').show();
            $('#accionEdit').val(2);
        }
    }

    function accionM(accion, anio) {

        var mes = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre',''];
        var f = new Date();
        var m = f.getMonth()+1;
        var a = f.getFullYear();

        if (accion == 1) {
            var id = $('#idCreateM').val();
            $('#anioCreateM').val(anio);

            $.get('estacionamientos/'+id+'/'+anio+'/buscar_mensualidad', function(data) {
        

                $('#montoAnio').empty();
                $('#buttonCreate').empty();
                $('#createMensuality1').empty();
                $('#createMensuality2').empty();

                beforeSend: $('#createMensuality1').append('Cargando...');
                complete: $('#createMensuality1').empty();

                if (data.length > 0) {

                    
                    $('#createMensuality1').append('Ya existen registros para este año');
                    $('#buttonC').attr('disabled',true);

                }else{

                    $('#buttonCreate').append(
                        "<div class='card-box'>"+
                            "<div class='row'>"+
                                "<div class='col-md-6' width='100%'>"+
                                    "<a href='#' class='btn btn-block btn-success' onclick='mostrarC(1)'>Montos por mes</a>"+
                                "</div>"+
                                "<div class='col-md-6' width='100%'>"+
                                    "<a href='#' class='btn btn-block btn-warning' onclick='mostrarC(2)'>Monto por año</a>"+
                                "</div>"+
                            "</div>"+
                        "</div"
                    );
                    $('#createMensuality1').append('<label>Montos por mes</label><br>');

                    if(a == anio){
                        for (var i = 0; i < 13; i++) {
                        
                            if(i>=m){
                                $('#createMensuality1').append(
                                    '<div class="row">'+
                                        '<div class="col-md-4">'+
                                            '<div class="form-group">'+
                                                '<input type="hidden" name="mes[]" class="form-control-plaintext">'+
                                                '<label>'+mes[i]+'</label>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-6">'+
                                            '<div class="form-group">'+
                                                '<div class="input-group mb-2">'+
                                                    '<div class="input-group-prepend">'+
                                                        '<div class="input-group-text">$</div>'+
                                                    '</div>'+
                                                    '<input type="number" name="monto[]" class="form-control" placeholder="10">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'
                                );
                            }
                        }

                    }

                    else{
                        for (var i = 1; i < 13; i++) {
                            $('#createMensuality1').append(
                                '<div class="row">'+
                                    '<div class="col-md-4">'+
                                        '<div class="form-group">'+
                                            '<input type="hidden" name="mes[]" class="form-control-plaintext">'+
                                            '<label>'+mes[i]+'</label>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-6">'+
                                        '<div class="form-group">'+
                                            '<div class="input-group mb-2">'+
                                                '<div class="input-group-prepend">'+
                                                    '<div class="input-group-text">$</div>'+
                                                '</div>'+
                                                '<input type="number" name="monto[]" class="form-control" placeholder="10">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                            );
                        } 
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
                                        '<input type="text" id="montoAnioC" name="montoaAnio" class="form-control" id="montoAnio_e" placeholder="10">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                    $('#createMensuality2').css('display','none');

                    $('#buttonC').attr('disabled',false);
                }
            });

        }
        if (accion == 2) {

            var id = $('#idEditM').val();
            $('#anioEditM').val(anio);

            $.get('estacionamientos/'+id+'/'+anio+'/buscar_mensualidad', function(data) {
        
                var m = f.getMonth()-1;
                $('#montoAnio').empty();
                $('#buttonEdit').empty();
                $('#editMensuality1').empty();
                $('#editMensuality2').empty();

                beforeSend: $('#editMensuality1').append('Cargando...');
                complete: $('#editMensuality1').empty();

                if (data.length == 0) {

                    $('#editMensuality1').append('No existen registros de este año para editar');
                    $('#buttonEdit').attr('disabled',true);

                }else{
                    var montoT=data.length-1;
                    $('#buttonEdit').append(
                        "<div class='card-box'>"+
                            "<div class='row'>"+
                                "<div class='col-md-6' width='100%'>"+
                                    "<a href='#' class='btn btn-block btn-success' onclick='mostrarE(1)'>Montos por mes</a>"+
                                "</div>"+
                                "<div class='col-md-6' width='100%'>"+
                                    "<a href='#' class='btn btn-block btn-warning' onclick='mostrarE(2)'>Monto por año</a>"+
                                "</div>"+
                            "</div>"+
                        "</div"
                    );
                    $('#editMensuality1').append('<label>Montos por mes</label><br>');

                    
                    for (var i = 0; i < data.length; i++) {
                            
                            console.log(i);
                            $('#editMensuality1').append(
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
                                                '<div class="input-group-prepend">'+
                                                    '<div class="input-group-text">$</div>'+
                                                '</div>'+
                                                '<input type="number" value="'+data[i].monto+'" name="monto[]" class="form-control" placeholder="10">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                            );

                    }
                    $('#editMensuality2').append(
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
                    $('#editMensuality2').css('display','none');

                    $('#buttonE').attr('disabled',false);
                }
            });
        }
        if (accion == 3) {

            $('#deleteMensuality').empty();
            var id = $('#idDeleteM').val();
            $('#anioDeleteM').val(anio);

            $.get('estacionamientos/'+id+'/'+anio+'/buscar_mensualidad', function(data) {
        
                for (var i = 0; i < 13; i++) {
                    $('#montoMese_e'+i).empty();
                }
                $('#montoAnio_e').empty();

                beforeSend: $('#deleteMensuality').append('Cargando...');
                    
                if (data.length > 0) {

                    $('#deleteMensuality').empty();
                    $('#deleteMensuality').append('<h3>Existen registros para este año</h3><br><p>¿Eliminar mensualidad de este año? No habrá vuelta atrás</p>');
                    $('#buttonD').attr('disabled', false);

                }else{
                    $('#deleteMensuality').empty();
                    $('#deleteMensuality').append('No hay registros de este año');
                    $('#buttonD').attr('disabled', true);
                }


            });
        } 
        if (accion == 4){

            var id = $('#idShowM').val();
            $('#MesesM').empty();
            $.get('estacionamientos/'+id+'/'+anio+'/buscar_mensualidad', function(data) {
        
                $('#buttonShow').empty();

                beforeSend: $('#MesesM').append('Cargando...');
                complete: $('#MesesM').empty();

                if (data.length > 0) {

                    var montoT=data.length-1;
                    // $('#buttonShow').append(
                    //     "<div class='card-box'>"+
                    //         "<div class='row'>"+
                    //             "<div class='col-md-6' width='100%'>"+
                    //                 "<a href='#' class='btn btn-success' onclick='mostrarS(1)'>Montos por mes</a>"+
                    //             "</div>"+
                    //             "<div class='col-md-6' width='100%'>"+
                    //                 "<a href='#' class='btn btn-warning' onclick='mostrarS(2)'>Monto por año</a>"+
                    //             "</div>"+
                    //         "</div>"+
                    //     "</div"
                    // );
                    $('#MesesM').append('<label>Montos por mes</label><br>');

                    
                    for (var i = 0; i < data.length; i++) {
                            
                        $('#MesesM').append(
                            '<div class="row">'+
                                '<div class="col-md-4">'+
                                    '<div class="form-group">'+
                                        '<button type="button" style="width=100% !important" class="btn btn-block btn-outline-info">'+mes[data[i].mes]+'</button>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-8">'+
                                    '<button class="btn btn-block btn-success" style="width=100% !important">$ <strong>'+data[i].monto+'</strong></button>'+
                                '</div>'+
                            '</div>'
                        );

                    }
                    $('#MesesM').append('<label>Montos por Año</label><br>');

                    $('#MesesM').append(
                        '<div class="row justify-content-center">'+
                            '<div class="col-md-4">'+
                                    '<button type="button" class="btn btn-block btn-outline-warning">'+anio+'</button>'+
                            '</div>'+
                            '<div class="col-md-8">'+
                                    '<button class="btn btn-block btn-warning" style="width=100% !important">$ <strong>'+data[montoT].monto+'</strong></button>'+
                                '</div>'+
                        '</div>'
                    );
                    $('#editMensuality2').css('display','none');

                    $('#buttonE').attr('disabled',false);
                }
            });
        }
    }

    function editar(id, idem, status) {

        $('#id_e').val(id);
        $('#idem').val(idem);
        $('#status_e').val(status);
    }

    function opcion(opcion) {
        var f = new Date();
        var anio=f.getFullYear();
        // var mes=['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $('#opcion').val(opcion);
        $('#opcion_e').val(opcion);

        if (opcion==2) {
            for (var i = 0; i < 13; i++) {
                $('#montoMeses'+i).prop('disabled',true).val(null).prop('required',false);
            }
            $('#montoAnio').prop('disabled',false).prop('required',true);
        }else {
            for (var i = 0; i < 13; i++) {
                $('#montoMeses'+i).prop('disabled',false).val(null).prop('required',true);
            }
            $('#montoAnio').prop('disabled',true).val(null).prop('required',false);
        }

    }
    
</script>