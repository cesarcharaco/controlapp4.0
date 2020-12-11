@extends('layouts.app')

@section('content')

    <div class="container">
        <input type="hidden" id="colorView" value="#ff3e36 !important">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Multas/Recargas</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Multas/Recargas</h4>
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
    <div class="card border border-danger rounded card-tabla shadow p-3 mb-5 bg-white rounded">
            <div class="row justify-content-center">
                @if(\Auth::user()->tipo_usuario == 'Admin')
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 offset-md-12">
                                <a class="btn btn-warning boton-tabla shadow" data-toggle="modal" data-target="#AsignarMR" onclick="asignar_mr()" style="
                                    border-radius: 10px;
                                    color: white;
                                    height: 35px;
                                    margin-bottom: 5px;
                                    margin-top: 5px;
                                    float: right;
                                    border: 1px solid #f6f6f7!important;
                                    border-color: #35e930  !important;
                                    background-color: #35e930  !important;">
                                    Asignar M/R
                                </a>
                                <a class="btn btn-success boton-tabla shadow" data-toggle="modal" data-target="#crearMulta" onclick="asignar_mr()" style="
                                    border-radius: 10px;
                                    color: white;
                                    height: 35px;
                                    margin-bottom: 5px;
                                    margin-top: 5px;
                                    float: right;
                                    border: 1px solid #f6f6f7!important;
                                    border-color: #ff3e36 !important;
                                    background-color: #ff3e36 !important;">
                                    Nueva Multa/Recarga
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                
    
            <div class="col-md-12">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                  <table id="example1" class="table table-bordered table-hover table-striped dataTable display nowrap" cellspacing="0" style="width: 100% !important;">
                    <thead>
                        <tr class="text-white" id="th1" style="background-color: #ff3e36 !important;">
                            <th>#</th>
                            <th>Motivo</th>
                            <th>Observación</th>
                            <th>Monto</th>
                            <th>Tipo</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $num=0; ?>
                        @if(\Auth::user()->tipo_usuario == 'Admin')
                            @foreach($mr as $key)
                                <tr>
                                    <td align="center">{{$num=$num+1}}</td>
                                    <td>{{$key->motivo}}</td>
                                    <td>{{$key->observacion}}</td>
                                    <td>{{$key->monto}}</td>
                                    <td>{{$key->tipo}}</td>
                                    <td align="center">
                                        <a href="#" class="btn btn-warning btn-sm boton-tabla shadow" data-toggle="modal" data-target="#editarMulta" onclick="EditarMR('{{$key->id}}','{{$key->motivo}}','{{$key->monto}}','{{$key->tipo}}','{{$key->observacion}}')" >
                                            <i data-feather="edit"></i>Editar
                                        </a>

                                        <a href="#" class="btn btn-danger btn-sm boton-tabla shadow"data-toggle="modal" data-target="#eliminarMulta" onclick="eliminar('{{$key->id}}')" class="btn btn-danger btn-sm">
                                            <i data-feather="trash"></i>Eliminar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach()
                        @else
                            @foreach($asignacion as $key)
                                <tr>
                                    <td>{{$num=$num+1}}</td>
                                    <td>{{$key->motivo}}</td>
                                    @if($key->observacion == null)
                                        <td>Sin observación</td>
                                    @else
                                        <td>{{$key->observacion}}</td>
                                    @endif
                                    <td>{{$key->monto}}</td>
                                    <td>{{$key->tipo}}</td>
                                    <td>
                                        @if($key->status == 'Pagada')
                                            <strong class="text-success">{{$key->status}}</strong>
                                            <button data-toggle="tooltip" data-placement="top" title="Seleccione para Editar Código de Transacción" class="btn btn-warning rounded btn-sm" onclick="editarReferencia('{{$key->id}}','{{$key->id_pivot}}');">
                                                <i data-feather="edit"></i>
                                            </button>
                                        @elseif($key->status == 'Por Confirmar')
                                            <strong class="text-warning">{{$key->status}}</strong>
                                        @else
                                            <strong class="text-info">{{$key->status}}</strong>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach()
                        @endif
                        
                    </tbody>
                    
                    </table>
                </thead>
            </div>
    </div>


    @include('multas.layouts.create')
    @include('multas.layouts.edit')
    @include('multas.layouts.delete')
    @include('multas.layouts.editar_referencia')
    @include('multas.layouts.ver_asignados')
@endsection

<script type="text/javascript">
    
    function EditarMR(id,motivo,monto,tipo,observacion) {

        $('#id_edit').val(id);
        $('#motivo_e').val(motivo);
        $('#monto_e').val(monto);
        $('#observacion_e').val(observacion);
        $("#tipo_edit").val(tipo);
        $("#mensajeEditar").val(tipo);
    }

    function eliminar(id) {
        $('#id_delete').val(id);
    }
    function verAsignados(id_multa){
        $('#CargandoAsignadosComprobar').css('display','block');
        $('#ver_multas_asignadas').empty();
        $('#verAsignadosMulta').modal('show');
        
        $.get('mr/'+id_multa+'/asignados', function(data) {
        })
        .done(function(data) {
                if(data.length>0){
                    for (var i = 0; i < data.length; i++) {
                        if(data[i].status == 'Pagada'){
                            $('#ver_multas_asignadas').append(
                                '<tr>'+
                                    '<td align="center"><center>'+data[i].nombres+' '+data[i].apellidos+'</center></td>'+
                                    '<td align="center"><center>'+data[i].rut+'</center></td>'+
                                    '<td align="center" class="text-success"><center>'+data[i].status+'</center></td>'+
                                '</tr>'
                            );
                        }else if(data[i].status == 'Por Confirmar'){
                            $('#ver_multas_asignadas').append(
                                '<tr>'+
                                    '<td align="center"><center>'+data[i].nombres+' '+data[i].apellidos+'</center></td>'+
                                    '<td align="center"><center>'+data[i].rut+'</center></td>'+
                                    '<td align="center" class="text-success"><center>'+
                                        '<div class="text-warning"><strong>' +data[i].status+'</strong> | CÓDIGO TRANS.: <b>'+data[i].referencia+'</b></div>'+'</center>'+
                                    '</td>'+
                                '</tr>'
                            );
                        }else{
                            $('#ver_multas_asignadas').append(
                                '<tr>'+
                                    '<td align="center"><center>'+data[i].nombres+' '+data[i].apellidos+'</center></td>'+
                                    '<td align="center"><center>'+data[i].rut+'</center></td>'+
                                    '<td align="center" class="text-info"><center>'+data[i].status+'</center></td>'+
                                '</tr>'
                            );
                        }
                        // $.get('mr/'+data[i].id+'/asignados2',function (data2) {
                        // })
                        // .done(function(data2) {
                        //     if(data2[i].status == 'Por Confirmar'){
                        //         $('#ver_multas_asignadas').append(
                        //             '<p class="text-warning"><strong>' +data2[i].status+'</strong> | CÓDIGO TRANS.: <b>'+data2[i].referencia+'</b></p>'
                        //         );
                        //     }else{
                        //         $('#ver_multas_asignadas').append(
                        //             '<center><label>'+data[i].rut+'</label></center>'+
                        //         );
                        //     }
                        // });
                    }
                }else{
                    $('#ver_multas_asignadas').append(
                                '<tr>'+
                                    '<td align="center" colspan="3"><center>No se encuentra asiganda a ningún residente</center></td>'+
                                '</tr>'
                            );
                }
        });
        $('#CargandoAsignadosComprobar').css('display','none');
    }

    function editarReferencia(id_multa, id_pivot) {
        $('#editarReferencia').modal('show');
        $('#codigoActualRef').empty();
        $('#id_pivot').val(id_pivot);

        $.get('mr/'+id_multa+'/asignados', function(data) {
        })
        .done(function(data) {
            if(data.length>0){
                for (var i = 0; i < data.length; i++) {
                    // alert(data[i].refer);
                    if(data[i].id_pivot == id_pivot){
                        $('#codigoActualRef').append(
                            '<center>'+
                                '<div class="row">'+
                                    '<div class="col-md-12">'+
                                        '<div class="form-group">'+
                                            '<label for="">Código de Trans. Actual</label>'+
                                            '<h3 align="center" class="text-warning">'+data[0].refer+'</h3>'+
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