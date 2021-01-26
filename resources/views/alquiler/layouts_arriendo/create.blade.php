<div class="collapse multi-collapse" id="nuevoArriendo" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
      <a data-toggle="collapse" data-target="#nuevoArriendo" aria-expanded="false" aria-controls="nuevoArriendo" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
        <strong>Cerrar</strong>
      </a>
    </div>  
    <div class="border card-body">
      <h4>Nuevo Arriendo <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
      <hr>
      {!! Form::open(['route' => ['registrar_alquiler'], 'enctype' => 'multipart/form-data', 'method' => 'POST', 'name' => 'registrar_alquiler', 'id' => 'registrar_alquiler', 'data-parsley-validate']) !!}
        @csrf
          

        @if(\Auth::User()->tipo_usuario=="Admin")
          <div>
            <label for="AlquilerParaAdmin">¿Desea alquilarlo para usted?</label>
              <input type="checkbox" name="id_admin" onchange="alquilerAmin();" id="AlquilerParaAdmin"  data-toggle="tooltip" data-placement="top" title="Seleccione si desea asignarse un alquiler" value="{{ \Auth::User()->id }}">
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group" id="todosResidentesR">
                <label>Residente <b class="text-danger">*</b></label>
                <select class="form-control select2" id="select_id_residente" name="id_residente" required="required">
                    <option disabled value selected>Seleccione residente</option>
                    @foreach($residentes as $key)
                        <option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}} - {{$key->rut}}</option>
                    @endforeach()
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Instalación <b class="text-danger">*</b></label>
                <select class="form-control select2" id="instalacionList" name="id_instalacion" required="required" onchange="buscarInslatacion(this.value)">
                    <option disabled value selected>Seleccione instalación</option>
                    @foreach($instalaciones as $key)
                    @if($key->status=="Activo")
                        <option value="{{$key->id}}">{{$key->nombre}} - Dias disponible:@foreach($key->dias as $key2) {{$key2->dia}} @endforeach - {{$key->status}}</option>
                    @endif
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <center id="tipo_alquiler_v" style="display: none;">
                <div class="form-group">
                  <label>Tipo de Alquiler <b class="text-danger">*</b></label>
                  <select class="form-control buscarInslatacion tipo_alquiler" id="tipo_alquiler_c"  name="tipo_alquiler" onchange="TipoAlquiler(this.value)" required disabled>
                    <option value="0" selected disabled>Seleccione tipo de alquiler</option>
                    <option value="Permanente">Permanente</option>
                    <option value="Temporal">Temporal</option>
                  </select>
                </div>
              </center>
            </div>
          </div>
        @else
          <input type="hidden" name="id_residente" value="{{\Auth::User()->residente->id}}">
          @if (Request::url() == route('instalaciones'))
            <!-- <input type="hidden" id="id_residenteC" name="id_residente"> -->
            <input type="hidden" id="instalacionList" name="id_instalacion">
            <div class="row">
              <div class="col-md-12">
                <center id="tipo_alquiler_v" style="display: none;">
                  <div class="form-group">
                    <label>Tipo de Alquiler <b class="text-danger">*</b></label>
                    <select class="form-control tipo_alquiler border" name="tipo_alquiler" id="tipo_alquiler_c" onchange="TipoAlquiler(this.value)" required disabled>
                      <option value="0" selected disabled>Seleccione tipo de alquiler</option>
                      <option value="Permanente">Permanente</option>
                      <option value="Temporal">Temporal</option>
                    </select>
                  </div>
                </center>
              </div>
            </div>
          @else
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Instalación <b class="text-danger">*</b></label>
                  <select class="form-control select2" id="instalacionList" name="id_instalacion" required="required" onchange="buscarInslatacion(this.value)">
                      <option disabled value selected>Seleccione instalación</option>
                      @foreach($instalaciones as $key)
                        @if($key->status=="Activo")
                          <option value="{{$key->id}}">{{$key->nombre}} - Dias disponible:@foreach($key->dias as $key2) {{$key2->dia}} @endforeach - {{$key->status}}</option>
                        @endif
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <center id="tipo_alquiler_v" style="display: none;">
                  <div class="form-group">
                    <label>Tipo de Alquiler <b class="text-danger">*</b></label>
                    <select class="form-control tipo_alquiler border" name="tipo_alquiler" id="tipo_alquiler_c" onchange="TipoAlquiler(this.value)" required disabled>
                      <option value="0" selected disabled>Seleccione tipo de alquiler</option>
                      <option value="Permanente">Permanente</option>
                      <option value="Temporal">Temporal</option>
                    </select>
                  </div>
                </center>
              </div>
            </div>
          @endif
        @endif
        <center>
        </center>
        <div class="card border rounded">
          <div class="card-body">
            <div class="vistaCostoT" style="display: none;">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group" align="center">
                    <label>Fecha <b class="text-danger">*</b></label>
                    <input type="date" name="fecha" class="form-control fechaAlquiler">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group" align="center">
                    <label>Hora <b class="text-danger">*</b></label>
                    <input class="form-control horaAlquiler" type="time" name="hora">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nro. de horas <b class="text-danger">*</b></label>
                    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                      <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                        <span class="input-group-text" style="width:39px; height:39px;">
                          <i data-feather="watch"></i>
                        </span>
                      </span>
                      <input name="num_horas" min="1" max="24" data-toggle="touchspin" type="number" class="form-control num_horas" required placeholder="Ingrese Nro. de horas" id="num_horas" onkeyup="calcularMontoT(this.value)">
                    </div>
                  </div>                    
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Monto total a pagar <b class="text-danger">*</b></label>
                    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                      <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                        <span class="input-group-text" style="width:39px; height:39px;">
                          <i data-feather="dollar-sign"></i>
                        </span>
                      </span>
                      <input name="monto" min="1" data-toggle="touchspin" type="number"  class="form-control soloNumeros" placeholder="Monto total a pagar" required readonly="readonly" id="montoTArriendo">
                    </div>
                  </div>                    
                </div>
              </div>
            </div>

            <div class="vistaCostoP" style="display: none; text-align: center;">
              <label>Costo por alquiler permanente: </label>
              <h3><span id="total_costo_p"></span></h3>
            </div>
          </div>
        </div>

        <center>
          <div class="form-group">
            <p><strong>Nota: </strong>Para pagar por <span class="text-info">Flow</span> registre el arrendamiento y luego proceda con el pago</p>
          </div>
          <div class="form-group">
              <div class="">                  
                  <label for="admins_todos">¿Se realizó el pago?</label>
                  <input type="checkbox" name="pago_realizado" onchange="pagoRealizadoA();" id="pagoRealizado"  data-toggle="tooltip" data-placement="top" title="Seleccione si el pago se realizó correctamente" value="1">
              </div>
              <div class="row" id="mostrarRefeC" style="display: none;">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="tipo_pago">Tipo de pago <b style="color: red;">*</b></label>
                    <select name="tipo_pago" id="tipo_pago" required="required" class="form-control" onchange="cargarRef(this);">
                      <option value="">Seleccione tipo de pago...</option>
                      <option value="Transferencia">Transferencia</option>
                      @if(\Auth::user()->tipo_usuario=="Admin")
                      <option value="Efectivo">Efectivo</option>
                      @endif
                    </select>
                  </div>
                </div>
                <div class="col-md-6" id="referencia_p" style="display: none;">
                  <div class="form-group">
                    <label for="refeCreateA">Referencia <b class="text-danger">*</b></label>
                    <input type="text" class="form-control border border-primary" name="referencia" maxlength="20" id="refeCreateA" placeholder="Ingrese número de referencia">
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
          </div>
        </center>
                    
        <div align="center">
            <input type="hidden" id="costo_temporal" name="costo_temporal">
            <input type="hidden" id="costo_permanente" name="costo_permanente">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>