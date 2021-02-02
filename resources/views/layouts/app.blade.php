<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1.0, minimum-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ControlApp') }}</title>
    
    



    <link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}">
    
    @include('layouts.css')

    
    @toastr_css

        <style type="text/css">

                .ribbon {
          position: absolute;
          left: -5px; top: -5px;
          z-index: 1;
          overflow: hidden;
          width: 75px; height: 75px;
          text-align: right;
        }
        .ribbon span {
          font-size: 10px;
          font-weight: bold;
          color: #FFF;
          text-transform: uppercase;
          text-align: center;
          line-height: 20px;
          transform: rotate(-45deg);
          -webkit-transform: rotate(-45deg);
          width: 100px;
          display: block;
          background: #79A70A;
          background: linear-gradient(#FF7043 0%, #C9B216 100%);
          box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
          position: absolute;
          top: 19px; left: -21px;
        }
        .ribbon span::before {
          content: "";
          position: absolute; left: 0px; top: 100%;
          z-index: -1;
          border-left: 3px solid #C9B216;
          border-right: 3px solid transparent;
          border-bottom: 3px solid transparent;
          border-top: 3px solid #C9B216;
        }
        .ribbon span::after {
          content: "";
          position: absolute; right: 0px; top: 100%;
          z-index: -1;
          border-left: 3px solid transparent;
          border-right: 3px solid #C9B216;
          border-bottom: 3px solid transparent;
          border-top: 3px solid #C9B216;
        }







        .ribbon2 {
          position: absolute;
          right: -5px; top: -5px;
          z-index: 1;
          overflow: hidden;
          width: 75px; height: 75px;
          text-align: right;
        }
        .ribbon2 span {
          font-size: 10px;
          font-weight: bold;
          color: #FFF;
          text-transform: uppercase;
          text-align: center;
          line-height: 20px;
          transform: rotate(45deg);
          -webkit-transform: rotate(45deg);
          width: 100px;
          display: block;
          background: #79A70A;
          background: linear-gradient(#FF7043 0%, #FF7043 100%);
          box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
          position: absolute;
          top: 19px; right: -21px;
        }
        .ribbon2 span::before {
          content: "";
          position: absolute; left: 0px; top: 100%;
          z-index: -1;
          border-left: 3px solid #FF7043;
          border-right: 3px solid transparent;
          border-bottom: 3px solid transparent;
          border-top: 3px solid #FF7043;
        }
        .ribbon2 span::after {
          content: "";
          position: absolute; right: 0px; top: 100%;
          z-index: -1;
          border-left: 3px solid transparent;
          border-right: 3px solid #FF7043;
          border-bottom: 3px solid transparent;
          border-top: 3px solid #FF7043;
        }

        .imagenAnun3{
            width: 40%;
            height: auto;
            max-width:500px; 
            margin-right: -25px !important;
            margin-top: -30px !important;
        }

        .imagenAnun2{
            /*display: none;*/
            width: 40%;
            height: auto;
            /*height:70%;*/
            max-width:500px; 
            margin-right: -25px !important;
        }

            .botonParpadeante {
  
              animation-name: parpadeo;
              animation-duration: 3s;
              animation-timing-function: linear;
              animation-iteration-count: infinite;

              -webkit-animation-name:parpadeo;
              -webkit-animation-duration: 3s;
              -webkit-animation-timing-function: linear;
              -webkit-animation-iteration-count: infinite;
            }

            @-moz-keyframes parpadeo{  
              0% { opacity: 1.0; }
              50% { opacity: 0.0; }
              100% { opacity: 1.0; }
            }

            @-webkit-keyframes parpadeo {  
              0% { opacity: 1.0; }
              50% { opacity: 0.0; }
               100% { opacity: 1.0; }
            }

            @keyframes parpadeo {  
              0% { opacity: 1.0; }
               50% { opacity: 0.0; }
              100% { opacity: 1.0; }
            }
        .palabraVerInmueble2, .palabraVerEstaciona2,.PalabraEditarPago2, .tituloTabla2,.card-home2{
        {
            display: none;
        }
        @media only screen and (max-width: 800px)  {
            #anuncioRoot{

                margin-left: -20px !important;
            }
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
                width: 100%;
            }
            .imagenAnun2{
                width: 40%;
            }
            .imagenAnun3{
                width: 20%;
            }

        }
        @media only screen and (max-width: 200px)  {
            .footer3{
                height: 100px;
                /*display: none;*/
            }
            .footer2{
                height: 200px;
            }
            .botonesEditEli{
                width: 15px;
                height: 15px;
            }
            .iconosMetaforas2{
                width: 5px;
                height: 5px;    
            }
            .imagenAnun3{
                width: 20%;
            }
        }
        @media screen and (max-width: 480px) {
            .footer1{
                height: 50;
            }
            .footer2{
                /*margin-bottom: 40px;*/
                height: 60px;
                position: relative;
                /*display: none;*/
            }
            .footer3{
                display: none;
                height: 500px;
            }
            .tabla-estilo{
                font-size: 7px;
            }
            .card-home{
                display: none;
            }
            .card-home2{
                display: block;
            }
            .boton-tabla{
                font-size: 7px;
                width: 50px;
                height: 20px;
                border-radius: 30px;
            }
            .card-tabla{
                width: 100%
            }
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
            .imagenAnun3{
                width: 20%;
            }
        }


    </style>

    <style type="text/css">
        /*#body1{
            background-color: white;
            background-image: url("{{ asset('assets/images/logo.jpg') }}");
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: 90%;
                background-repeat: no-repeat;
                background-position: center;
                width: auto;
                height: auto;
        }*/
        .table-curved  style="table-layout: fixed;"{
        border-collapse: separate;
        }
        .table-curved  style="table-layout: fixed;"{
            border: solid #ccc 1px;
            border-radius: 6px;
            border-left:0px;
        }
        .table-curved td, .table-curved th  style="table-layout: fixed;"{
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
        }
        .table-curved th  style="table-layout: fixed;"{
            border-top: none;
        }
        .table-curved th:first-child  style="table-layout: fixed;"{
            border-radius: 6px 0 0 0;
        }
        .table-curved th:last-child  style="table-layout: fixed;"{
            border-radius: 0 6px 0 0;
        }
        .table-curved th:only-child style="table-layout: fixed;"{
            border-radius: 6px 6px 0 0;
        }
        .table-curved tr:last-child td:first-child  style="table-layout: fixed;"{
            border-radius: 0 0 0 6px;
        }
        .table-curved tr:last-child td:last-child  style="table-layout: fixed;"{
            border-radius: 0 0 6px 0;
        }

        .anuncio{

        }

        .tabla-estilo{
            position: relative;
            table-layout: fixed;
            border-radius: 30px;
        }
        .imagenAnun{
            /*width: 100%;*/
            margin-left: -20px;
            /*margin-right: -100px;*/
            /*height: 80%;*/
            /*margin:auto;*/
        }

        .footer1{

            position: relative; 
            bottom: 0px;
            left: 0;
            right: 0;
            top: 60px;
            
            /*margin-top: 500px;*/
        }

        .footer2{

            position: relative; 
            bottom: 0px;
            left: 0;
            right: 0;
            top: 60px;
            
            /*margin-top: 500px;*/
        }

        .footer3{

            position: relative; 
            bottom: 0px;
            left: 0;
            right: 0;
            top: 60px;
            
            /*margin-top: 500px;*/
        }
        .card-tabla{
            border-radius: 30px !important;
        }
        
        /*@media screen and (max-width: -480px) {
            #inner{
                top: 500px;
                position: relative; 
                width: 50%;
            }
        }*/



        @media screen and (max-width: 800px) {
            .footer1{
                height: 100px;
            }
            .footer2{
                margin-bottom: 160px;
                margin-top: 0px;
                height: 100px;
                /*position: relative;*/
            }
            .footer3{
                height: 101px;
            }

            .anuncioRoot{
                width: 100%;
            }
            .imagenAnun3{
                width: 20%;
            }
        }
    </style>
    
</head>
@if(\Auth::user()->tipo_usuario=="root")
    <body id="body1">
@else
    <body>
@endif
    <!-- <img src="" class="rounded-circle" alt="" style="position: relative;" /> -->
    <div id="app">
        <div class="" style="min-height: 100% !important; position: relative !important;">
            @include('layouts.admin.header')
            
            
            @include('layouts.admin.menu')
            @jquery
            @toastr_js
            @toastr_render

            <div class="content-page" id="content-page">
              <div id="content-page2">
                @include('layouts.admin.notificaciones')
                @include('layouts.admin.noticias')
                
                @if(\Auth::user()->tipo_usuario =='Admin')
                  @include('layouts.admin.pagos_comunes')
                @endif
                
                  <div class="content" id="contenidoPagina">

                      <!-- Start Content-->

                      <div class="container-fluid">
                          <!-- <div class="row page-title">
                              <div class="col-md-12">
                                  <h4 class="mb-1 mt-0">ControlApp <label class="badge badge-soft-danger">v1.0.1</label>
                                  </h4>
                              </div>
                          </div> -->
                              
                              <app></app>

                              @yield('statusarea')
                              @yield('breadcomb')
                              @yield('content')
                                  




                              {!! Form::open(['route' => ['asignar_mr'],'method' => 'POST', 'name' => 'asignar_multa', 'id' => 'asignar_multa', 'data-parsley-validate']) !!}
                                  @csrf
                                  <div class="modal fade" id="AsignarMR" role="dialog">
                                      <div class="modal-dialog modals-default">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4>Asignar M/R</h4>
                                                  <button type="button" class="close" data-dismiss="modal">
                                                      <span>&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                  <center>
                                                      @if(\Auth::user()->tipo_usuario == 'Admin')
                                                          <div class="row">
                                                              <div class="col-md-12">
                                                                  <div div="form-group">
                                                                      <label>Multas - Recargas</label>
                                                                      <pre><select multiple class="custom-select custom-select-sm" name="id_mr[]" id="campoMultaRecarga" required>
                                                                      </select></pre>
                                                                  </div>
                                                              </div>
                                                              
                                                          </div>

                                                          <div class="row">
                                                              <div class="col-md-12">
                                                                  <div div="form-group">
                                                                      <label>Residentes</label>
                                                                      <select multiple class="custom-select custom-select-sm" name="id_residente[]" id="campoResidentes">
                                                                      </select>
                                                                      <div style="display: none;">
                                                                          <select multiple class="custom-select custom-select-sm" name="id_residente[]" id="campoResidentes2">
                                                                      </select>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="row">
                                                              <div class="col-md-12">
                                                                  <label>¿Quiere asignar las multas y recargas a todos los residentes?</label>
                                                                  <input type="checkbox" value="AsignarTodos" name="registrarTodos" onclick="cambiarResiT()">
                                                                  <input type="hidden" name="opcion" id="opcionAsignaT" value="1">
                                                              </div>
                                                          </div>
                                                      @else
                                                          <div class="row">
                                                              <div class="col-md-12">
                                                                  <div div="form-group">
                                                                      <label>Multas - Recargas</label>
                                                                      <pre><select multiple class="custom-select custom-select-sm" name="id_mr[]" id="campoMultaRecarga" required>
                                                                      </select></pre>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          
                                                      @endif
                                                  </center>

                                              </div>
                                              <div class="modal-footer border-bottom">
                                                  <button type="submit" class="btn btn-success">Asignar</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                              {!! Form::close() !!}

                                                  
                              {!! Form::open(['route' => ['Editar_perfil'],'method' => 'POST', 'name' => 'Editar_perfil', 'id' => 'Editar_perfil', 'data-parsley-validate']) !!}
                                  @csrf
                                  <div class="modal fade bd-example-modal-lg" id="Profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                              <div class="modal-body">
                                                  <button type="button" class="close" data-dismiss="modal">
                                                      <span>&times;</span>
                                                  </button>
                                                  <div class="row">
                                                      
                                                  
                                                      <div class="col-lg-6">
                                                          <div class="card">
                                                              <div class="card-body">
                                                                  <center>
                                                                      <div class="text-center mt-3">
                                                                          <img src="assets/images/logo.jpg" alt="" class="rounded-circle" width="80" height="80">
                                                                          <div class="form-group row">
                                                                              <div class="col-md-12">
                                                                                  <center>
                                                                                      <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
                                                                                      <label class="col-md-6 col-form-label" for="example-static">Nombres</label>
                                                                                      <input type="text" readonly="" class="form-control-plaintext" id="nombres_profile" value="{{Auth::user()->name}}">
                                                                                      <input type="text" name="nombres" class="form-control" id="nombres_profileE" value="{{Auth::user()->name}}" style="display: none;" required>
                                                                                      @if(\Auth::user()->tipo_usuario=="Residente")
                                                                                          <input type="text" readonly="" class="form-control-plaintext" id="apellidos_profile" value="{{ apellido() }}">
                                                                                          <input type="text" name="apellidos" class="form-control" id="apellidos_profileE" value="{{ apellido() }}" style="display: none;">
                                                                                      @endif
                                                                                  </center>
                                                                              </div>
                                                                          </div>
                                                                          <h6 class="text-muted font-weight-normal mt-1 mb-4">
                                                                              <div class="form-group row">
                                                                                  <div class="col-lg-12">
                                                                                      <center>
                                                                                          <label class="col-md-4 col-form-label" for="example-static">Rut</label>
                                                                                          <input type="text" readonly="" class="form-control-plaintext" id="rut_profile" value="{{Auth::user()->rut}}">

                                                                                          <div  id="rut_profileE" style="display: none;">
                                                                                              <div class="row">
                                                                                                  <div class="col-md-7">
                                                                                                      <input type="text" name="rut" minlength="7" maxlength="8" class="form-control" id="rut_profileEdit" value="123124123" required>
                                                                                                  </div>
                                                                                                  <div class="col-md-3">
                                                                                                      <input type="text" name="verificador" min="1" minlength="1" maxlength="2" class="form-control" id="verificadorEdit" value="123124123" required>
                                                                                                  </div>
                                                                                              </div>
                                                                                          </div>
                                                                                      </center>
                                                                                  </div>
                                                                              </div>
                                                                          </h6>

                                                                      </div>
                                                                  </center>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="card">
                                                              <div class="card-body">
                                                                  <center>
                                                                      <div class="row" id="buttonEditP2" style="display: none;">
                                                                          <div class="col-md-6">
                                                                              <a href="#" onclick="EditarProfile2()" class="btn btn-primary" style="width: 100%; border-radius: 30px;">Volver</a>
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                              <center><button type="submit" class="btn btn-success" id="btnGuardarProfile" style="width: 100%; border-radius: 30px;">Guardar</button></center>
                                                                              
                                                                          </div>
                                                                      </div>
                                                                      <div class="row" id="buttonEditP">
                                                                          <div class="col-md-12">
                                                                              <a href="#" onclick="EditarProfile()" class="btn btn-success" style="width: 100%; border-radius: 30px;">Editar</a>
                                                                          </div>
                                                                      </div>
                                                                      <div class="mt-3 pt-2">
                                                                          <h4 class="mb-3 font-size-15">Información de contacto</h4>

                                                                          <div class="form-group row">
                                                                              <div class="col-lg-12">
                                                                                  <label>Email</label>
                                                                                  <input type="email" name="email" class="form-control" id="email_profileE"value="{{Auth::user()->email}}" style="display: none;" required>
                                                                                  <input type="email" readonly="" class="form-control-plaintext" id="email_profile"value="{{Auth::user()->email}}">
                                                                              </div>
                                                                          </div>
                                                                          @if(\Auth::user()->tipo_usuario!="Admin")
                                                                            <div class="form-group row">
                                                                                <div class="col-lg-12">
                                                                                    <label>Teléfono</label>
                                                                                    <input type="text" readonly="" class="form-control-plaintext" id="telefono_profile"value="13123123">
                                                                                    <input type="text" name="telefono" maxlength="20" class="form-control" id="telefono_profileE"value="13123123" style="display: none;" required>
                                                                                </div>
                                                                            </div>
                                                                          @endif
                                                                          
                                                                      </div>
                                                                  </center>
                                                              </div>
                                                          </div>
                                                      </div>

                                                  </div>
                                              </div>
                                             
                                          </div>
                                      </div>
                                  </div>
                              {!! Form::close() !!}

                            <!-- --------------------------------------------REGISTRAR ESTACIONAMIENTOS--------------------------------------------------------- -->    

                              <form action="{{ route('estacionamientos.store') }}" method="POST">
                                  @csrf
                                  <div class="modal fade" id="crearEstacionamiento" role="dialog">
                                      <div class="modal-dialog modals-default">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4>Nuevo Estacionamiento <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                                                  <button type="button" class="close" data-dismiss="modal">
                                                      <span>&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                  <center>
                                                      <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <label>Idem del estacionamiento <b class="text-danger">*</b></label>
                                                                  <input type="text" name="idem" placeholder="Idem del estacionamiento" class="form-control" required="required">
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <label>Estado del estacionamiento <b class="text-danger">*</b></label>
                                                                  <select name="status" class="form-control" required placeholder="Introduzca el status del estacionamiento">
                                                                      <option value="Libre" selected="selected">Libre</option>
                                                                      <option value="Ocupado" >Ocupado</option>
                                                                  </select>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      

                                                      
                                                      <!-- <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <label>Especifique el año para los montos</label>
                                                                  <select name="anio" id="anio2" class="form-control">
                                                                      <?php $anio=date('Y');?>
                                                                      @for($i=0; $i<10; $i++)
                                                                          <option value="{{$anio++}}">{{$anio-1}}</option>
                                                                      @endfor
                                                                  </select>
                                                              </div>
                                                          </div>
                                                      </div> -->
                                                      

                                                      {{--
                                                      
                                                      <h4>Mensualidad del estacionamiento</h4>


                                                          <div class="widget-tabs-list">
                                                          <ul class="nav nav-tabs tab-nav-left">
                                                              <li class="active"><a class="active" data-toggle="tab" href="#mes" onclick="opcion(1)">Montos por mes</a></li>
                                                              <li><a data-toggle="tab" href="#anio" onclick="opcion(2)">Montos por año</a></li>
                                                          </ul>
                                                          <div class="tab-content tab-custom-st">
                                                              <div id="mes" class="tab-pane fade in active show">
                                                                  <div class="tab-ctn">
                                                                      <div class="row">
                                                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                              <div class="add-todo-list notika-shadow ">
                                                                                  <div class="card-box">
                                                                                      @php $i=0; @endphp
                                                                                      @foreach($meses as $key)
                                                                                          <div class="row">
                                                                                              <div class="col-md-4">
                                                                                                  <div class="form-group">
                                                                                                      <input type="hidden" value="{{$key->mes}}" name="mes[]" id="meses{{$i}}" class="form-control-plaintext">
                                                                                                      <label>{{$key->mes}}</label>
                                                                                                  </div>
                                                                                              </div>
                                                                                              <div class="col-md-6">
                                                                                                  <div class="form-group">
                                                                                                      <div class="input-group mb-2">
                                                                                                          <div class="input-group-prepend">
                                                                                                              <div class="input-group-text">$</div>
                                                                                                          </div>
                                                                                                          <input type="number" name="monto[]" id="montoMeses{{$i}}" class="form-control" placeholder="10">
                                                                                                      </div>
                                                                                                  </div>
                                                                                              </div>
                                                                                          </div>
                                                                                          @php $i++; @endphp
                                                                                      @endforeach()

                                                                                      
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>

                                                              <div id="anio" class="tab-pane fade">
                                                                  <div class="tab-ctn">
                                                                      <div class="row">
                                                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                              <div class="add-todo-list notika-shadow ">
                                                                                  <div class="card-box">
                                                                                      <div class="row">
                                                                                          <div class="col-md-12">
                                                                                              <div class="form-group">
                                                                                                  <label>Monto por todo el año</label>
                                                                                                  <div class="input-group mb-2">
                                                                                                      <div class="input-group-prepend">
                                                                                                          <div class="input-group-text">$</div>
                                                                                                      </div>
                                                                                                      <input type="text" name="montoAnio" class="form-control" id="montoAnio" placeholder="10" disabled>
                                                                                                  </div>
                                                                                              </div>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div> 
                                                      --}}
                                                  </center>
                                                  <input type="hidden" name="opcion" id="opcion" value="1">
                                                  <button type="submit" class="btn btn-success" style="border-radius: 50px; float: right;">Guardar</i></button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </form>
                            <!-- --------------------------------------------REGISTRAR RESIDENTE--------------------------------------------------------- -->    
                              <form action="{{ route('residentes.store') }}" method="POST" name="registrar_residente" data-parsley-validate>
                                  @csrf
                                  <div class="modal fade" id="crearResidente" role="dialog">
                                      <div class="modal-dialog modals-default">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4>Nuevo Residente <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                                                  <button type="button" class="close" data-dismiss="modal">
                                                      <span>&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                  <center>
                                                      <div class="row">
                                                          <div class="col-md-12">
                                                              
                                                              <div class="form-group">
                                                                  <label>Nombres <b class="text-danger">*</b></label>
                                                                  <input type="text" name="nombres" placeholder="Nombres del residente" class="form-control" required>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <label>Apellidos <b class="text-danger">*</b></label>
                                                                  <input type="text" name="apellidos" placeholder="Apellidos del residente" class="form-control" required>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <label>Rut <b class="text-danger">*</b></label>
                                                      <div class="row">
                                                          <div class="col-md-10">
                                                              <div class="form-group">
                                                                  <input type="text" name="rut" placeholder="Rut del residente" minlength="7" maxlength="8" class="form-control" required>
                                                              </div>
                                                          </div>
                                                          
                                                          <div class="col-md-2">
                                                              <div class="form-group">
                                                                  <div style="float: left !important;">
                                                                      <input type="number" name="verificador" min="1" minlength="1" maxlength="1" value="0" class="form-control" max="9" required>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <p>
                                                        <strong>Nota:</strong> La contraseña para ingresar será <strong>rut</strong>-<strong>verificador</strong>
                                                      </p>
                                                      <p>
                                                        <strong>Ejemplo:</strong> 1234567<strong>-8</strong>
                                                      </p>
                                                      <hr>
                                                      <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <label>Teléfono <b class="text-danger">*</b></label>
                                                                  <input type="text" name="telefono" maxlength="20" placeholder="Teléfono del residente" class="form-control" required>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <label>Email <b class="text-danger">*</b></label>
                                                                  <input type="email" name="email" placeholder="Email del residente" class="form-control" required>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <p class="text-success"><strong>Debe seleccionar al menos inmueble para proceder con el registro</strong></p>
                                                      <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <label>¿Asignar inmueble? <b class="text-danger">*</b></label>
                                                                  <select name="id_inmuebles[]" multiple class="form select2" multiple="" id="asignaInmueResidente" required>
                                                                      
                                                                  </select>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <label>¿Asignar estacionamiento? </label>
                                                                  <select name="id_estacionamientos[]" multiple class="form select2" multiple="" id="asignaEstaResidente">

                                                                  </select>
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

                              
                            <!-----------------------------------------------PAGAR MESES RESIDENTE---------------------------------------- -->
                              <form action="{{ route('pagos.store') }}" method="POST" class="parsley-examples">
                                @csrf
                                <div class="modal fade" id="pagarMesesModal" role="dialog">
                                  <div class="modal-dialog modals-default">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h4>Pagar arriendos</h4>
                                        <div id="CargandoPagarArriendos" style="display: none;">
                                            <div class="spinner-border text-warning m-2" role="status"></div>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <h5 align="center">Meses a pagar</h5>
                                        <hr>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="tipo_pago">Tipo de pago <b style="color: red;">*</b></label>
                                              <select name="tipo_pago" id="tipo_pago" required="required" class="form-control" onchange="carg(this);">
                                                <option value="" disabled>Seleccione tipo de pago...</option>
                                                <option value="Transferencia">Transferencia</option>
                                                @if(\Auth::user()->tipo_usuario=="Admin")
                                                <option value="Efectivo">Efectivo</option>
                                                @endif
                                                @if(\Auth::user()->tipo_usuario!="Admin")
                                                <option value="Flow">Flow</option>
                                                @endif
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                        <hr>
                                        <center>
                                          <div id="muestraMesesAPagar">
                                              
                                          </div>
                                          <div id="muestraMesesAPagar2" style="display: none;">
                                              <h3 align="center">No hay inmuebles que pagar</h3>
                                          </div>
                                        </center>
                                      </div>
                                      <div class="modal-footer">
                                          <input type="hidden" name="opcion" id="opcion" value="1">
                                          <button type="submit" class="btn btn-success" style="border-radius: 50px;">Guardar</i></button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </form>

                            <!-----------------------------------------------PAGAR MULTAS RESIDENTE---------------------------------------- -->
                              <form action="{{ route('pagar.mr') }}" method="POST">
                                @csrf
                                <div class="modal fade" id="pagarMultasModal" role="dialog">
                                  <div class="modal-dialog modals-default">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h4>Pagar Multas/Recargas</h4>
                                        <div id="CargandoMultasResi" style="display: none;">
                                            <div class="spinner-border text-warning m-2" role="status">
                                                <!-- <span class="sr-only">Cargando multas y recargas...</span> -->
                                            </div>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <center>
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <div class="form-group">
                                                      <label>Multas/Recargas <b style="color: red;">*</b></label>
                                                      <select class="form-control select2" name="id_mensMulta[]" id="MultasPagarResi" onchange="montoTotalMulta(this.value)" required="">
                                                          
                                                      </select>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="form-group">
                                                <label for="tipo_pago">Tipo de pago <b style="color: red;">*</b></label>
                                                <select name="tipo_pago" id="tipo_pago" required="required" class="form-control" onchange="carg(this);">
                                                  <option value="">Seleccione tipo de pago...</option>
                                                  <option value="Transferencia">Transferencia</option>
                                                  @if(\Auth::user()->tipo_usuario=="Admin")
                                                  <option value="Efectivo">Efectivo</option>
                                                  @endif
                                                  @if(\Auth::user()->tipo_usuario!="Admin")
                                                  <option value="Flow">Flow</option>
                                                  @endif
                                                </select>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row" style="display: none;" id="referencia_p">
                                              <div class="col-md-12">
                                                  <div class="form-group">
                                                      <label>Referencia <b style="color: red;">*</b></label>
                                                      <input type="text" maxlength="20" max="20" class="form-control" name="referencia" required placeholder="Ingrese referencia" id="referencia_p_arriendos">
                                                  </div>
                                              </div>
                                          </div>
                                          @if(\Auth::user()->tipo_usuario=="admin")
                                              <div class="card border border-info shadow p-3 mb-5 bg-white">
                                                  <div class="row" id="mis_mr">
                                                      <div class="col-md-12">
                                                          <table id="mrSeleccionado" class="table tabla-estilo" style="width: 100%;" alt="Max-width 100%">
                                                              
                                                          </table>
                                                      </div>
                                                  </div>
                                              </div>
                                          @else
                                              <div class="card border border-info shadow p-3 mb-5 bg-white">
                                                  <div class="row" id="mis_mr">
                                                      <div class="col-md-12">
                                                          <table id="mrSeleccionado2" class="table tabla-estilo" style="width: 100%;" alt="Max-width 100%">
                                                              
                                                          </table>
                                                      </div>
                                                  </div>
                                              </div>
                                          @endif
                                          <label align="center">Total a Pagar</label>
                                          <div class="card border border-dark shadow p-1 mb-3 bg-white">
                                              <div class="row" id="mis_mr">
                                                  <div class="col-md-12">
                                                      <div class="form-group">
                                                          <span style="font-size: 20px" class="text-dark" id="TotalPagarMR">0</span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div style="display: none;" id="idMultaForm">
                                              
                                          </div>
                                        </center>
                                      </div>
                                      <div class="modal-footer">
                                          <input type="hidden" name="opcion" id="opcion" value="1">
                                          <input type="hidden" name="id_residente" id="id_residente_mr">
                                          <input type="hidden" id="totalMR2" name="total">
                                          <button type="submit" class="btn btn-danger" style="border-radius: 50px;">Pagar</i></button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </form>

                              <form action="{{ route('pagar.mr') }}" method="POST">
                                  @csrf
                                  <div class="modal fade" id="pagarMultasModal2" role="dialog">
                                      <div class="modal-dialog modals-default">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4>Pagar Multas/Recargas</h4>
                                                  <div id="CargandoMultasResi" style="display: none;">
                                                      <div class="spinner-border text-warning m-2" role="status">
                                                          <!-- <span class="sr-only">Cargando multas y recargas...</span> -->
                                                      </div>
                                                  </div>
                                                  <button type="button" class="close" data-dismiss="modal">
                                                      <span>&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                  <center>
                                                      <p>Estos residentes han confirmado un pago a esta multa/Recarga</p>
                                                      <div id="VerConfirmarPagoR"></div>
                                                      <div id="VerConfirmarPagoR2"></div>
                                                  </center>
                                              </div>
                                              <div class="modal-footer">
                                                  <input type="hidden" name="opcion" id="opcion" value="1">
                                                  <input type="hidden" name="id_residente" id="idResidenteConfirmar">
                                                  <input type="hidden" name="id_multa" id="idMultaConfirmar">
                                                  <button type="submit" class="btn btn-danger" style="border-radius: 50px;">Pagar</i></button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </form>

                              <form action="{{ route('inmuebles.store') }}" method="POST">
                                  @csrf
                                  <div class="modal fade" id="crearInmueble" role="dialog">
                                      <div class="modal-dialog modals-default">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4>Nuevo Inmueble <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                                                  <button type="button" class="close" data-dismiss="modal">
                                                      <span>&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                  <center>
                                                      <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="form-group" style="text-align:center;">
                                                                  <center> <label>Idem del inmueble<b class="text-danger">*</b></label>
                                                                      <input type="text" name="idem" placeholder="Idem del Inmueble" class="form-control" required="required">
                                                                  </center>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <center>
                                                                      <label>Tipo de Inmueble <b class="text-danger">*</b></label>
                                                                      <select name="tipo" class="form-control" required placeholder="Introduzca el tipo de Inmueble" required="required">
                                                                          <option value="Casa" selected="selected">Casa</option>
                                                                          <option value="Apartamento" >Apartamento</option>
                                                                          <option value="Anexo" >Anexo</option>
                                                                          <option value="Habitación" >Habitación</option>
                                                                          <option value="Otro" >Otro</option>
                                                                      </select>
                                                                  </center>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <center>
                                                                      <label>Estado del Inmueble <b class="text-danger">*</b></label>
                                                                      <select name="status" class="form-control" required placeholder="Introduzca el status del Inmueble">
                                                                          <option value="Disponible" selected="selected">Disponible</option>
                                                                          <option value="No Disponible" >No Disponible</option>
                                                                      </select>
                                                                  </center>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <center>
                                                                      <label>¿El inmueble posee estacionamientos? <b class="text-danger">*</b></label>
                                                                      <select name="estacionamiento" class="form-control select2" onchange="CheckboxCuantos(this.value)" id="PoseeEstacionamientoI" required placeholder="¿Algún estacionamiento para el inmueble?">
                                                                          <option value="Si">Si</option>
                                                                          <option value="No" selected="selected">No</option>
                                                                      </select>
                                                                  </center>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="row" id="cuantosEstaciona" style="display: none;">
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <label>Cantidad de estacionamientos <b class="text-danger">*</b></label>
                                                                  <input type="number" name="Cuantos" class="form-control" placeholder="1">
                                                              </div>
                                                          </div>
                                                      </div>
                                                      
                                                      

                                                      {{--<div class="row">
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <label>Asignar estacionamientos al inmueble</label><label class="badge badge-soft-warning">Opcional</label>
                                                                  <select name="id_estacionamientos" class="form-control select2" required placeholder="¿Algún estacionamiento para el inmueble?">
                                                                      <option value="0" selected="selected">Seleccionar estacionamientos</option>
                                                                      @foreach($estacionamientos as $key)
                                                                          <option value="{{$key->id}}">{{$key->idem}}</option>
                                                                      @endforeach()
                                                                  </select>
                                                              </div>
                                                          </div>
                                                      </div> --}}

                                                      <!-- <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <label>Especifique el año para los montos</label>
                                                                  <select name="anio" id="anio2" class="form-control" onchange="mostrarMCreate(this.value);">
                                                                      <?php $anio=date('Y');?>
                                                                      @for($i=0; $i<10; $i++)
                                                                          <option value="{{$anio++}}">{{$anio-1}}</option>
                                                                      @endfor
                                                                  </select>
                                                              </div>
                                                          </div>
                                                      </div> -->

                                                      {{--<h4>Mensualidad del Inmueble</h4>
                                                      


                                                      <div class="widget-tabs-list">
                                                          <ul class="nav nav-tabs tab-nav-left">
                                                              <li class="active"><a class="active" data-toggle="tab" href="#mes" onclick="opcion(1)">Montos por mes</a></li>
                                                              <li><a data-toggle="tab" href="#anio" onclick="opcion(2)">Montos por año</a></li>
                                                          </ul>
                                                          <div class="tab-content tab-custom-st">
                                                              <div id="mes" class="tab-pane fade in active show">
                                                                  <div class="tab-ctn">
                                                                      <div class="row">
                                                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                              <div class="add-todo-list notika-shadow ">
                                                                                  <div class="card-box">
                                                                                      @php $i=0; @endphp
                                                                                      @foreach($meses as $key)
                                                                                          <div class="row">
                                                                                              <div class="col-md-4">
                                                                                                  <div class="form-group">
                                                                                                      <input type="hidden" value="{{$key->mes}}" name="mes[]" id="meses{{$i}}" class="form-control-plaintext">
                                                                                                      <label>{{$key->mes}}</label>
                                                                                                  </div>
                                                                                              </div>
                                                                                              <div class="col-md-6">
                                                                                                  <div class="form-group">
                                                                                                      <div class="input-group mb-2">
                                                                                                          <div class="input-group-prepend">
                                                                                                              <div class="input-group-text">$</div>
                                                                                                          </div>
                                                                                                          <input type="number" name="monto[]" id="montoMeses{{$i}}" class="form-control" placeholder="10">
                                                                                                      </div>
                                                                                                  </div>
                                                                                              </div>
                                                                                          </div>
                                                                                          @php $i++; @endphp
                                                                                      @endforeach()

                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>

                                                              <div id="anio" class="tab-pane fade">
                                                                  <div class="tab-ctn">
                                                                      <div class="row">
                                                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                              <div class="add-todo-list notika-shadow ">
                                                                                  <div class="card-box">
                                                                                      <div class="row">
                                                                                          <div class="col-md-12">
                                                                                              <div class="form-group">
                                                                                                  <label>Monto por todo el año</label>
                                                                                                  <div class="input-group mb-2">
                                                                                                      <div class="input-group-prepend">
                                                                                                          <div class="input-group-text">$</div>
                                                                                                      </div>
                                                                                                      <input type="text" name="montoAnio" class="form-control" id="montoAnio" placeholder="10" disabled>
                                                                                                  </div>
                                                                                              </div>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      --}}
                                                  </center>
                                                  <input type="hidden" name="opcion" id="opcion" value="1">
                                                  <button type="submit" class="btn btn-success" style="border-radius: 50px; float: right;">Guardar</i></button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </form>


                      <!-- -------------------------------- ANUNCIOS ------------------------------------- -->
   
                      <div class="modal fade" id="verAsignadosAnuncios" role="dialog">
                          <div class="modal-dialog modals-default">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4>Administradores asignados</h4>
                                      <div id="CargandoAdminsAsignados" style="display: none;">
                                          <div class="spinner-border text-warning m-2" role="status"></div>
                                      </div>               
                                      <button type="button" class="close" data-dismiss="modal">
                                          <span>&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <center>
                                          <div id="administradoresA"></div>
                                      </center>
                                      <div class="float-right">
                                          <button type="submit" class="btn btn-info" data-dismiss="modal">Aceptar</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

         

                          
                      </div> <!-- container-fluid -->

                  </div> <!-- content -->
                </div>
            </div>
        </div>
    {{-- @include('layouts.admin.footer') --}}
    </div>
    <!-- Scripts -->
        <script type="text/javascript">

        function FlowCheck(opcion) {
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

        function CheckboxCuantos(){
            if($('#PoseeEstacionamientoI').val() == 'Si'){
                $('#cuantosEstaciona').css('display','block');
            }else{
                $('#cuantosEstaciona').css('display','none');
            }

        }
        </script>
  <script>
      //FUNCIÓN PARA DESHABILITAR REFERENCIA EN PAGAR ARRIENDO
      var referencia_p_arriendos = document.getElementById('input');
      function carg(elemento) {
        d = elemento.value;
        if (d == "") {
          $('#referencia_p').css('display','none');
        } else {
          if(d == "Flow" || d == "Efectivo"){
            $('#referencia_p').css('display','none');
            $('#referencia_p_arriendos').removeAttr('required',false);
            $('#referencia_p_arriendos').attr('disabled',true);
          }else{
            $('#referencia_p').removeAttr('style',false);
            //$('#referencia_p').css('style','block');
            $('#referencia_p_arriendos').attr('required',true);
            $('#referencia_p_arriendos').attr('disabled',false);
          }            
        }
      }
  </script>
        @include('layouts.scripts')
        
@section('scripts')
@endsection
</body>
</html>
