<div class="collapse multi-collapse" id="nuevoArriendo" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
      <a data-toggle="collapse" data-target="#nuevoArriendo" aria-expanded="false" aria-controls="nuevoArriendo" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
        <strong>Cerrar</strong>
      </a>
    </div>  
    <div class="border card-body">
      <h4>Nuevo Arriendo <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>

      {!! Form::open(['route' => ['registrar_alquiler'], 'enctype' => 'multipart/form-data', 'method' => 'POST', 'name' => 'registrar_alquiler', 'id' => 'registrar_alquiler', 'data-parsley-validate']) !!}
        @csrf
          
        <div class="row">                
          <div class="col-md-4">
            <div class="form-group">
              <label>Residente <b class="text-danger">*</b></label>
              <select class="form-control select2" id="id_residente" name="id_residente" required="required">
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
            <center>
              <div class="form-group">
                <label>Tipo de Alquiler <b class="text-danger">*</b></label>
                <select class="form-control" name="tipo_alquiler" onchange="TipoAlquiler(this.value)" required>
                  <option selected disabled>Seleccione tipo de alquiler</option>
                  <option value="Permanente">Permanente</option>
                  <option value="Temporal">Temporal</option>
                  <option value="Permanente/Temporal">Permanente/Temporal</option>
                </select>
              </div>
            </center>
          </div>
        </div>
        <center>
        </center>
        <div class="card border rounded">
          <div class="card-body">
            <div id="vistaCostoT" style="display: none;">
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
                      <input name="num_horas" min="1" minlength="2" max="24" data-toggle="touchspin" type="number" class="form-control" required placeholder="Ingrese Nro. de horas" id="num_horas" onkeyup="calcularMontoT(this.value)">
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
                      <input name="monto" min="1" minlength="2" max="24" data-toggle="touchspin" type="number"  class="form-control soloNumeros" placeholder="Monto total a pagar" required readonly="readonly" id="montoTArriendo">
                    </div>
                  </div>                    
                </div>
              </div>
            </div>

            <div id="vistaCostoP" style="display: none; text-align: center;">
              <label>Costo por alquiler permanente: </label>
              <h3><span id="total_costo_p"></span>$</h3>
            </div>
          </div>
        </div>

        <center>
          <div class="form-group">
              <div class="">                  
                  <label for="admins_todos">¿Se realizó el pago?</label>
                  <input type="checkbox" name="pago_realizado" onchange="pagoRealizadoA();" id="pagoRealizado"  data-toggle="tooltip" data-placement="top" title="Seleccione si el pago se realizó correctamente" value="1">
              </div>
              <div id="mostrarRefeC" class="mt-2 mb-2" style="display: none;">
                <label>Referencia <b class="text-danger">*</b></label>
                <input type="text" class="form-control border border-primary" name="referencia" maxlength="20" id="refeCreateA" placeholder="Ingrese número de referencia">
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