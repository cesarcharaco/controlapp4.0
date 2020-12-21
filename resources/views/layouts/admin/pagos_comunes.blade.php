<div class="collapse multi-collapse" id="verPagosComunes" style=" margin-left: -12px; margin-top: -45px;width: 103% !important; background-color: white !important; position: relative;">
    <div class="card" style=" border-color: white!important;">
      <div class="card-header">
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
              <div class="card border border-success rounded shadow p-3 mb-5 bg-white rounded" style="display: none; border-color: #43d39e!important;">
                  <div class="card-header" style="background-color: white !important;">
                      <div class="row">
                          <div class="col-md-10">
                              <center><h4>Pagos Comunes</h4></center>
                          </div>
                          <div class="col-md-2">  
                            <a data-toggle="collapse" data-target="#verPagosComunes" aria-expanded="false" aria-controls="verPagosComunes" class="btn btn-primary text-white" style="border-radius: 5px; float: right;" onclick="cerrarVP()">
                              Cerrar
                            </a>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                    	<div class="row">
	                        <div class="col-md-12 col-xl-12">
	                            <div class="card border border-info rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
	                                <div class="card-body p-0">
	                                    <div class="media p-4">
	                                        <div class="media-body">
	                                            <h4 align="center" class="text-info text-uppercase font-size-12 font-weight-bold">Valor de Gastos Comúnes</h4>
	                                            <div class="row justify-content-center">
	                                            	<div class="col-md-6">
			                                            <div class="row">
			                                                <div class="col-lg-6 col-md-6">
			                                                    <h4 style="margin-top: 18px;color: #CB8C4D !important;" align="center">Costo Inmueble</h4>
			                                                </div>
			                                                <div class="col-lg-6 col-md-6">
			                                                	<a href="#" style="width: 100% !important;" onclick="PagoC(1)" class="btn btn-outline-primary shadow">
			                                                		<i data-feather="eye"></i>Buscar Gastos Comunes
			                                                	</a>
			                                                </div>
			                                                {{--<div class="col-lg-4 col-md-4">
			                                                    <h4><a href="#" style="width: 100% !important;" onclick="PagoC(3)" class="btn btn-warning shadow">Editar</a></h4>
			                                                </div>--}}
			                                            </div>
	                                            	</div>
	                                            	<div class="col-md-6">
		                                            {{--<div class="row">
		                                                <div class="col-lg-6 col-md-6">
		                                                    <h4 style="margin-top: 10px;color: #cccc00 !important;" align="center">Costo Estacionamiento</h4>
		                                                </div>
		                                                <div class="col-lg-6 col-md-6">
		                                                    <h4><a href="#" style="width: 100% !important;" onclick="PagoC(2)" class="btn btn-primary shadow">Registrar</a></h4>
		                                                </div>
		                                                <div class="col-lg-4 col-md-4">
		                                                    <h4><a href="#" style="width: 100% !important;" onclick="PagoC(4)" class="btn btn-warning shadow">Editar</a></h4>
		                                                </div>
		                                            </div>--}}
	                                            	</div>
	                                            </div>
	                                        </div>
	                                        <div class="form-group">
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
</div>
@include('layouts.admin.layouts.pagos_comunes.createInmueble')
@include('layouts.admin.layouts.pagos_comunes.editInmueble')
@include('layouts.admin.layouts.pagos_comunes.createEstacionamientos')
@include('layouts.admin.layouts.pagos_comunes.editEstacionamientos')