@extends('layouts.app')

@section('content')

    <style type="text/css">
        .card {
            border: 1px solid #f6f6f7!important;
            border-color: #2d572c !important;
        }
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
        <input type="hidden" id="colorView" value="#2d572c !important">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Flow</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Flow</h4>
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
    <div class="card rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
        <div class="row justify-content-center">
	            <div class="col-md-12">
	               	<form method="post" action="{{ url('payment/flow/orden') }}">
						{{ csrf_field() }}
						<center>
							<div class="row">
								<div class="col-md-6">
					            	<img src="{{ asset('assets/images/bank.png') }}" width="300" height="300">
					            	<h1>Flow Bank</h1>
								</div>
								<div class="col-md-6">
									<div class="shadow" style="border-radius: 30px;">
										<div class="card-body">
											<div class="row justify-content-center">
												<div class="col-md-12">
													<div class="form-group">
														<label>Orden N°:</label>
													 	<div class="input-group mb-2">
		                                                    <div class="input-group-prepend">
		                                                        <div class="input-group-text">
		                                                        	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-hash"><line x1="4" y1="9" x2="20" y2="9"></line><line x1="4" y1="15" x2="20" y2="15"></line><line x1="10" y1="3" x2="8" y2="21"></line><line x1="16" y1="3" x2="14" y2="21"></line></svg>
		                                                        </div>
		                                                    </div>
													 		<input class="form-control border"  type="text" name="orden" id="orden" placeholder="Número de Orden" required>
		                                                </div>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Monto : </label>
														<div class="input-group mb-2">
		                                                    <div class="input-group-prepend">
		                                                        <div class="input-group-text">
		                                                        	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
		                                                        </div>
		                                                    </div>
															<input class="form-control border" type="number" name="monto" id="monto" placeholder="100$" required>
		                                                </div>
													</div>
												</div>
											</div>
											<div class="row justify-content-center">
												<div class="col-md-12">
													<div class="form-group">
														<label>Descripción</label>
														<textarea class="form-control border" type="text" name="concepto" id="concepto" placeholder="Pago del mes actual" required></textarea>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Email pagador (Opcional) : </label>
														<div class="input-group mb-2">
		                                                    <div class="input-group-prepend">
		                                                        <div class="input-group-text">
																	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
		                                                        </div>
		                                                    </div>
															<input class="form-control border" type="email" name="pagador" id="pagador" placeholder="juan123@controlapp.cl">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>
							<button class="btn btn-primary shadow mt-4" id="btnAceptar" type="submit">Aceptar</button>
						</center>
					</form>

	            </div>
    	</div>
    </div>

@endsection


