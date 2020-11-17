<div class="collapse multi-collapse" id="verArriendo2" style=" margin-left: -8px; width: 100% !important; background-color: white !important; border-radius: 30px !important;">
  <div class="card">
    <div class="card-header" style="background-color: white !important;">
        <a data-toggle="collapse" data-target="#verArriendo2" aria-expanded="false" aria-controls="verArriendo2" class="btn btn-primary btn-sm text-uppercase float-right text-white" style="border-radius: 5px; float: right;" onclick="cerrar(3)">
          <strong>Cerrar</strong>
        </a>
      </div>
    <div class="border card-body">
        <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist" style="background-color: #C5C5C5 !important;">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-homeE_2" role="tab" aria-controls="pills-empresaE" aria-selected="true">1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-pagoE_2" role="tab" aria-controls="pills-datosE" aria-selected="false">2</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-homeE_2" role="tabpanel" aria-labelledby="pills-home-tab">
                <center>
                	<div class="row justify-content-center">
                		<div class="col-md-6">
		                  <div class="form-group">
		                    <label>Residente </label>
		                    <br>
		                    <strong><span id="id_residenteArriendo_2"></span></strong>
		                  </div>
                		</div>
                		<div class="col-md-6">
	                   <div class="form-group">
	                    <label>Instalación </label>
	                    <br>
	                    <strong><span id="instalacionListArriendo_2"></span></strong>
	                  </div>
                	</div>
                </div>
                	<hr>
                <div class="col-md-6">
                	<div class="col-md-6">
	                  <div class="form-group">
	                    <label>Tipo de Alquiler</label>
	                    <br>
	                    <strong><span id="tipo_alquilerArriendo_2"></span></strong>
	                  </div>
                	</div>
                	<div class="col-md-6">
	                  <div class="form-group card shadow vistaTipoAlquiler" style="border-radius: 30px !important; display: none;">
	                    <div class="card-body">
	                      <div class="form-group">
	                        <label>Fecha</label>
	                        <strong><span id="fechaAlquilerArriendo_2"></span></strong>
	                      </div>
	                          
	                      <div class="form-group" align="center">
	                        <label>Hora</label>
	                        <strong><span id="horaAlquilerArriendo_2"></span></strong>
	                      </div>
	                    </div>
	                  	</div>
	                 </div>
                	</div>
                	<hr>
                	<div class="row">
                		<div class="col-md-6">
		                  	<div class="form-group">
		                    <label>Nro. de horas </label>
		                      <strong><span id="num_horasArriendo_2"></span></strong>
			                </div>
                		</div>
                		<div class="col-md-6">
			                <div class="form-group">
			                  <label>Status</label>
			                  <br>
			                  <strong><span id="statusArriendo_2"></span></strong>
			                </div>                                  
                		</div>
                	</div>
                </center>
            </div>
            <div class="tab-pane fade" id="pills-pagoE_2" role="tabpanel" aria-labelledby="pills-pago-tab">
                <center>
                    <div class="form-group" id="pagoRealizado_2">
                        <label for="admins_todos">¿Se realizó el pago?</label>
                        <span id="pagadoArriendoE2_2"></span>
                    </div>
                    <div class="form-group">
                        <label>Referencia </label>
                        <span id="referenciaArriendoE_2"></span>
                    </div>
                    <div class="row">
                        <?php $num=0; ?>
                            @foreach($planesPago as $key)
                                @if($num==0)
                                    <div class="col-md-6">
                                        <div class="card shadow border card-tabla rounded" style="border-color: {{$key->color}} !important; height: 400px;">
                                            <div class="card-body">
                                                <div class="custom-control custom-radio mb-2">
                                                  <input type="radio" id="planPArriendoE{{$key->id}}" name="planP" value="{{$key->id}}" checked disabled>
                                                </div>
                                               <h3>{{$key->nombre}}</h3>
                                               <span>{{$key->dias}} dias</span>
                                               <br>
                                                <span style="font-size: 30px;">$</span><span style="font-size: 70px;">{{$key->monto}}</span><strong>/Mes</strong>
                                               <br>
                                               <center>
                                                <img align="center" class="img-responsive" width="180" height="180" src="{{ asset($key->url_img) }}">
                                               </center>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <div class="card shadow border card-tabla rounded" style="border-color: {{$key->color}} !important; height: 400px;">
                                            <div class="card-body">
                                                <div class="custom-control custom-radio mb-2">
                                                  <input type="radio" id="planPArriendoE{{$key->id}}" name="planP" value="{{$key->id}}" disabled>
                                                </div>
                                               <h3>{{$key->nombre}}</h3>
                                               <span>{{$key->dias}} dias</span>
                                               <br>
                                                <span style="font-size: 30px;">$</span><span style="font-size: 70px;">{{$key->monto}}</span><strong>/Mes</strong>
                                               <br>
                                               <center>
                                                <img align="center" class="img-responsive" width="180" height="180" src="{{ asset($key->url_img) }}">
                                               </center>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <?php $num++; ?>
                            @endforeach()
                    </div>
                </center>

            </div>
        </div>
    </div>
  </div>
</div>