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
				<center>
					<div class="row">
						<div class="col-md-6">
			            	<img src="{{ asset('assets/images/bank.png') }}" width="300" height="300">
			            	<h1>Flow Bank</h1>
						</div>
						<div class="col-md-6">
							<div class="shadow" style="border-radius: 30px;">
								<div class="card-body">
									<h1 class="text-success">¡Éxito en el pago!</h1>
									<h3>Su pago se ha realizado exitosamente</h3>
									<p>Orden de Compra: <strong>{{$data['ordenCompra']}}</strong></p>
									<p>Monto: <strong>{{$data['monto']}}</strong></p>
									<p>Descripción: <strong>{{$data['concepto']}}</strong></p>
									<p>Pagador: <strong>{{$data['pagador']}}</strong></p>
									<p>Flow Orden N°: <strong>{{$data['flowOrden']}}</strong></p>
									<a class="btn btn-primary mt-3" href="{{ url('home') }}">Regresar</a>
								</div>
							</div>
						</div>
					</div>
				</center>
            </div>
    	</div>
    </div>

@endsection








