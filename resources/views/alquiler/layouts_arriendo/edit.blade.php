<div class="collapse multi-collapse" id="editarArriendo2" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
        <a data-toggle="collapse" data-target="#editarArriendo2" aria-expanded="false" aria-controls="editarArriendo2" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(3)">
          <strong>Cerrar</strong>
        </a>
      </div>
    <div class="border card-body">
      <h4>Editar Arriendo <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
      {!! Form::open(['route' => ['editar_alquiler'], 'enctype' => 'multipart/form-data', 'method' => 'POST', 'name' => 'update_arriendo', 'id' => 'update_arriendo', 'data-parsley-validate']) !!}
        @csrf
          

          @if(\Auth::User()->tipo_usuario=="Admin")
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Residente <b class="text-danger">*</b></label>
                  <select class="form-control select2" id="id_residenteArriendoE" onchange="buscarTodo(this.value)" name="id_residente" required>
                      <option disabled>Seleccione residente</option>
                      @foreach($residentes as $key)
                          <option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}} - {{$key->rut}}</option>
                      @endforeach()
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Instalación <b class="text-danger">*</b></label>
                  <select class="form-control select2" id="instalacionListArriendoE" name="id_instalacion">
                      <option disabled required>Seleccione instalación</option>
                      @foreach($instalaciones as $key)
                      <option value="{{$key->id}}">{{$key->nombre}} - Dias disponible:@foreach($key->dias as $key2) {{$key2->dia}} @endforeach - {{$key->status}}</option>
                      @endforeach
                  </select>
                </div>                  
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Tipo de Alquiler <b class="text-danger">*</b></label>
                  <select class="form-control tipo_alquiler border" name="tipo_alquiler" id="tipo_alquilerArriendoE" onchange="TipoAlquiler(this.value)" required>
                    <option value="0" selected disabled>Seleccione tipo de alquiler</option>
                    <option value="Permanente">Permanente</option>
                    <option value="Temporal">Temporal</option>
                    <option value="Permanente/Temporal">Permanente/Temporal</option>
                  </select>
                </div>
              </div>
            </div>
          @else
            <input type="hidden" name="id_residente" value="{{\Auth::User()->residente->id}}">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Instalación <b class="text-danger">*</b></label>
                  <select class="form-control select2" id="instalacionListArriendoE" name="id_instalacion">
                      <option disabled required>Seleccione instalación</option>
                      @foreach($instalaciones as $key)
                      <option value="{{$key->id}}">{{$key->nombre}} - Dias disponible:@foreach($key->dias as $key2) {{$key2->dia}} @endforeach - {{$key->status}}</option>
                      @endforeach
                  </select>
                </div>                  
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tipo de Alquiler <b class="text-danger">*</b></label>
                  <select class="form-control buscarInslatacion border" name="tipo_alquiler" id="tipo_alquilerArriendoE" onchange="TipoAlquiler(this.value)" required>
                    <option value="0" selected disabled>Seleccione tipo de alquiler</option>
                    <option value="Permanente">Permanente</option>
                    <option value="Temporal">Temporal</option>
                    <option value="Permanente/Temporal">Permanente/Temporal</option>
                  </select>
                </div>
              </div>
            </div>
          @endif
                <div class="card border rounded">
                  <div class="card-body">
                    <h4 align="center">Tipo de alquiler actual: <span id="tipo_alquiler_s" class="text-warning"></span></h4>
                    <div class="vistaCostoT" style="display: none;">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group" align="center">
                            <label>Fecha <b class="text-danger">*</b></label>
                            <input type="date" name="fecha" class="form-control fechaAlquiler" id="fechaAlquilerArriendoE">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group" align="center">
                            <label>Hora <b class="text-danger">*</b></label>
                            <input class="form-control horaAlquiler" type="time" name="hora" id="horaAlquilerArriendoE">
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
                              <input name="num_horas" min="1" minlength="2" max="24" data-toggle="touchspin" type="number" class="form-control num_horas" required placeholder="Ingrese Nro. de horas" id="num_horasArriendoE" onkeyup="calcularMontoT(this.value)">
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
                              <input name="monto" min="1" minlength="2" max="24" data-toggle="touchspin" type="number"  class="form-control soloNumeros" placeholder="Monto total a pagar" required readonly="readonly" id="monto_t_a">
                            </div>
                          </div>                    
                        </div>
                      </div>
                    </div>

                    <div class="vistaCostoP" style="display: none; text-align: center;">
                      <label>Costo por alquiler permanente: </label>
                      <h3><span id="monto_p_a2"></span>$</h3>
                    </div>
                  </div>
                </div>
                <center>
                  {{--
                    <div class="form-group" id="pagoRealizado">
                      <div>                  
                          <label for="admins_todos">¿Se realizó el pago?</label>
                          <input type="checkbox" name="admins_todos" id="pagadoArriendoE"  data-toggle="tooltip" data-placement="top" title="Seleccione si el pago se realizó correctamente" value="1">
                      </div>
                      <div>  
                          <span id="pagadoArriendoE2"></span>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Referencia </label>
                        <input type="text" class="form-control" name="referencia" id="referenciaArriendoE" maxlength="20">
                    </div>
                    --}}
                      <label>Estado de pago:</label>
                      <h3><span id="status_pago_e"></span></h3>
                </center>

        <div align="center">
            <input type="hidden" name="id" id="id_editarArriendo">
            <button type="submit" class="btn btn-warning">Guardar</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>