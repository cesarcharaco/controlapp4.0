<!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script> -->
<!-- <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
{{-- <script src="{{ asset('assets/js/jquery.js') }}"></script> --}}

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script> -->


<!-- <script src="{{ asset('assets/js/app.min.js') }}" ></script> -->
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>

<script src="{{ asset('js/app.js') }}" prefer></script>
<script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script>

{{-- timepicker --}}

<!-- dataTables -->
<script src="{{ asset('plugins/dataTables/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('plugins/dataTables/dataTables.responsive.min.js') }}" defer></script>

@if (Request::url() == url('pagos') || Request::url() == url('estados_pagos'))
	<script src="{{ asset('plugins/dataTables/dataTables.bootstrap4.min.js') }}" defer></script>
	<script src="{{ asset('plugins/dataTables/responsive.bootstrap4.min.js') }}" defer></script>
	<script type="text/javascript">
		$( document ).ready(function() {
			$('#left-side-menu').hide();
			$('#content-page').removeClass('content-page').addClass('mb-5').addClass('mt-5');
			$('#content-page').append('<br>');
			$('#content-page2').addClass('mb-5').addClass('mt-5');
			$('#app').addClass('mb-5').addClass('mt-5');
		});
	</script>
@else
	<script src="{{ asset('plugins/dataTables/dataTables.bootstrap4.min.js') }}" defer></script>
	<script src="{{ asset('plugins/dataTables/responsive.bootstrap4.min.js') }}" defer></script>
@endif




<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js" integrity="sha512-G8JE1Xbr0egZE5gNGyUm1fF764iHVfRXshIoUWCTPAbKkkItp/6qal5YAHXrxEu4HNfPTQs6HOu3D5vCGS1j3w==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha512-QEiC894KVkN9Tsoi6+mKf8HaCLJvyA6QIRzY5KrfINXYuP9NxdIkRQhGq3BZi0J4I7V5SidGM3XUQ5wFiMDuWg==" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>




<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.jqueryui.min.js"></script> -->


<script type="text/javascript">




	$(document).ready(function() {
	    var anunAnioActualMonto= $('#anunAnioActualMonto').val();
	    var anunAnioAnteriorMonto= $('#anunAnioAnteriorMonto').val();
	    var anunAnioAntePasadoMonto= $('#anunAnioAntePasadoMonto').val();

	    var ctx = document.getElementById('myChart').getContext('2d');
	    var myChart = new Chart(ctx, {
	        type: 'bar',
	        data: {
	            labels: [a+' - '+anunAnioActualMonto+'$', a-1+' - '+anunAnioAnteriorMonto+'$', a-2+' - '+anunAnioAntePasadoMonto+'$'],
	            datasets: [{
	                label: 'Ingresos obtenidos por año',
	                data: [anunAnioActualMonto, anunAnioAnteriorMonto, anunAnioAntePasadoMonto],
	                backgroundColor: [
	                    'rgba(255, 99, 132, 0.2)',
	                    'rgba(54, 162, 235, 0.2)',
	                    'rgba(255, 206, 86, 0.2)'
	                ],
	                borderColor: [
	                    'rgba(255, 99, 132, 1)',
	                    'rgba(54, 162, 235, 1)',
	                    'rgba(255, 206, 86, 1)'
	                ],
	                borderWidth: 1
	            }]
	        },
	        options: {
	            scales: {
	                yAxes: [{
	                    ticks: {
	                        beginAtZero: true
	                    }
	                }]
	            }
	        }
	    });
	});
	var f = new Date();
    var a=f.getFullYear();
    var ms=f.getMonth();


	function VerCards() {
        $(function () {
            setTimeout( function(){

                $('#verTabla2-1')
                .css('opacity', 0)
                    .slideDown('slow')
                    .animate(
                        { opacity: 1 },
                        { queue: false, duration: 'slow' }
                    );
                setTimeout( function(){
                    $('#verTabla2-2')
                    .css('opacity', 0)
                    .slideDown('slow')
                    .animate(
                        { opacity: 1 },
                        { queue: false, duration: 'slow' }
                    );
                    setTimeout( function(){
                        $('#verTabla2-3')
                        .css('opacity', 0)
                        .slideDown('slow')
                        .animate(
                            { opacity: 1 },
                            { queue: false, duration: 'slow' }
                        );
                    }  , 500 );
                }  , 500 );
            }  , 500 );
        });
    }
	$(document).ready(VerCards);
	var mes = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre',''];
    function mostrar_mes(num) {
        switch (num) {
            case 1:
                return 'Enero';
                break;
            case 2:
                return 'Febrero';
                break;
            
            case 3:
                return 'Marzo';
                break;
            
            case 4:
                return 'Abril';
                break;
            
            case 5:
                return 'Mayo';
                break;
            
            case 6:
                return 'Junio';
                break;
            
            case 7:
                return 'Julio';
                break;
            
            case 8:
                return 'Agosto';
                break;
            
            case 9:
                return 'Septiembre';
                break;
            
            case 10:
                return 'Octubre';
                break;
            
            case 11:
                return 'Noviembre';
                break;
            
            case 12:
                return 'Diciembre';
                break;
            
            
        }
    }
	$(function () {

		
		if( $('#colorView').val() != 0 ){
			colorP=$('#colorView').val();
			colorPaginador = "background-color: "+colorP+";";
		}else{
			colorPaginador = "background-color: aqua";
		}

		$(".dataTable").DataTable({
			"paging": true,
            "bPaginate": true,
			"pageLength": 50,
			"responsive": true,
      		"autoWidth": true,
      		language: {
		        "decimal": "",
		        "emptyTable": "No hay información",
		        "info": "Mostrando la página _PAGE_ de _PAGES_",
		        "infoEmpty": "Mostrando 0 de 0 Entradas",
		        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
		        "infoPostFix": "",
		        "thousands": ",",
		        "lengthMenu": "Mostrar _MENU_ Entradas",
		        "loadingRecords": "Cargando...",
		        "processing": "Procesando...",
		        "search": "",
		        "zeroRecords": "Sin resultados encontrados",
		        "first": "Primero",
		        "last": "Ultimo",
		        "next": "Próximo",
		        "previous": "Anterior",
	        }
		});

		$("#tableConsultas").DataTable({
			"pageLength": 50,
			"responsive": true,
      		"autoWidth": true,
      		"sort": false,
      		language: {
	        "decimal": "",
	        "emptyTable": "No hay información",
	        "info": "Mostrando la página _PAGE_ de _PAGES_",
	        "infoEmpty": "Mostrando 0 de 0 Entradas",
	        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
	        "infoPostFix": "",
	        "thousands": ",",
	        "lengthMenu": "Mostrar _MENU_ Entradas",
	        "loadingRecords": "Cargando...",
	        "processing": "Procesando...",
	        "search": "",
	        "zeroRecords": "Sin resultados encontrados",
	        "first": "Primero",
	        "last": "Ultimo",
	        "next": "Próximo",
	        "previous": "Anterior",
	        
	        }
		});

		$('.data-table-basic').DataTable({
	        "pageLength": 50,
            "paging": true,
            "bPaginate": true,
            "ordering": false,
            "lengthChange": false,
            "lengthMenu": false,
            "pagingType": "simple_numbers",
            // "searching": false,
            // "bFilter": false,
            // "info":     false,
	        language: {
	        "decimal": "",
	        "emptyTable": "No hay información",
	        "info": "Mostrando la página _PAGE_ de _PAGES_",
	        "infoEmpty": "Mostrando 0 de 0 Entradas",
	        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
	        "infoPostFix": "",
	        "thousands": ",",
	        "lengthMenu": "Mostrar _MENU_ Entradas",
	        "loadingRecords": "Cargando...",
	        "processing": "Procesando...",
	        "search": "",
	        "zeroRecords": "Sin resultados encontrados",
	        "first": "Primero",
	        "last": "Ultimo",
	        "next": "Próximo",
	        "previous": "Anterior",
	        
	        }

	    });

	    $('#data-table-basic2').DataTable({
	        "pageLength": 50,
            // "paging": false,
            // "bPaginate": false,
            "ordering": false,
            "lengthChange": false,
            "lengthMenu": false,
            "pagingType": "simple_numbers",
            // "searching": false,
            // "bFilter": false,
            // "info":     false,
	        language: {
	        "decimal": "",
	        "emptyTable": "No hay información",
	        "info": "Mostrando la página _PAGE_ de _PAGES_",
	        "infoEmpty": "Mostrando 0 de 0 Entradas",
	        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
	        "infoPostFix": "",
	        "thousands": ",",
	        "lengthMenu": "Mostrar _MENU_ Entradas",
	        "loadingRecords": "Cargando...",
	        "processing": "Procesando...",
	        "search": "",
	        "zeroRecords": "Sin resultados encontrados",
	        "paginate": {
	            "first": "Primero",
	            "last": "Ultimo",
	            "next": "<buttom class='btn' style='border-radius:50%;"+colorPaginador+"'><strong> > </strong></buttom>",
	            "previous": "<buttom class='btn' style='border-radius:50%;"+colorPaginador+"'><strong> < </strong></buttom>",
            	// "pagingType": "scrolling",
            	"sPaginationType": "four_button",
	          }
	        }

	    });
	    $('#vista_pagos_mes').hide();

	    $('.page-link').css('font-size', '12px');

	    $('.dataTables_length').css('display','none');
	    $('.dataTables_info').attr('align','center');

	    $('#tablaInstalaciones').hide();
        $('#tablaArriendos').hide();
        $('#tablaControl').hide();

		$('.vistaPromociones').hide();


	    // $('.dataTables_paginate').removeChild('span');
		$('#tablaAnucios').hide();
		$('#tablaEmpresas').hide();
	    $('.card').fadeIn(500);

	    // $('.paginate_button').addClass('btn btn-sm text-dark').attr('onclick="paginateButton();"');


		
		$('.VerEstaciona').carousel();
		$('#id_residente').select2();
		$('select').each(function () {
			$(this).select2({
			  theme: 'bootstrap4',
			  width: 'style',
			  placeholder: $(this).attr('placeholder'),
			  allowClear: Boolean($(this).data('allow-clear')),
			});
		});

		$('.carrousel').slick({
		  slidesToShow: 3,
		  slidesToScroll: 1,
		  autoplay: true,
		  autoplaySpeed: 2000,
		});

		$('.multi-collapse').collapse('hide');

	});

	// function paginateButton(){
	// 	 $('.paginate_button').addClass('btn btn-sm text-dark').attr('onclick="paginateButton();"');
	// }

	function cambiarResiT() {
		var valor = $('#opcionAsignaT').val();
		if (valor==1) {

			$("#campoResidentes").attr('disabled',true);
			$('#opcionAsignaT').val(2);
			
			var options = $("#campoResidentes2 > option").clone();
            $("#campoResidentes > option").remove();
            $("#campoResidentes").append(options);
		}else{
			$("#campoResidentes").removeAttr('disabled');
			$('#opcionAsignaT').val(1);
		}

	}

	function asignar_mr() {
		$("#campoMultaRecarga").empty();
		$.get("multas_recargas/1/buscar_mr_all",function (data) {
	    })
	    .done(function(data) {
	    	console.log(data.length)
	        if (data.length>0) {
	            for (var i = 0; i < data.length; i++) {
	               $("#campoMultaRecarga").append('<option value="'+data[i].id+'"><font style="vertical-align: inherit; color: red">'+data[i].motivo+' - '+ data[i].tipo+' - monto: '+data[i].monto+'$</font></option>');
	            }
	        }else{
	        	$("#campoMultaRecarga").attr('disabled',true);
	        	$("#campoMultaRecarga").append('<option selected disabled><font style="vertical-align: inherit; color: red">No hay multas ni recargas registradas</font></option>');
	        }

	    });	

	    $.get('residentes/1/buscar_residente2',function (data) {
	    })
	    .done(function(data) {
	        if (data.length>0) {
	            for (var i = 0; i < data.length; i++) {
	            	if ($('#option_mr_resi-'+data[i].id).val() == undefined || ($('#option_mr_resi-'+data[i].id).val() == null)) {
		               $("#campoResidentes").append('<option id="option_mr_resi-'+data[i].id+'" value="'+data[i].id+'">'+data[i].nombres+' '+data[i].apellidos+' - '+data[i].rut+'</option>');
		               $("#campoResidentes2").append('<option value="'+data[i].id+'">'+data[i].nombres+' '+data[i].apellidos+' - '+data[i].rut+'</option>');

		            }else{
		            }
	            }
	        }else{
	        	$("#campoResidentes").attr('disabled',true);
	        	$("#campoResidentes").append('<option selected disabled><font style="vertical-align: inherit; color: red">No hay residentes registrados</font></option>');
	        	$("#campoResidentes2").attr('disabled',true);
	        	$("#campoResidentes2").append('<option selected disabled><font style="vertical-align: inherit; color: red">No hay residentes registrados</font></option>');
	        }

	    });
	}

	function Profile(){
		// $('#perfil').modal('show');
	}

	function EditarProfile() {
		$('#btnGuardarProfile').fadeIn(300);
		var rut=$('#rut_profile').val();
		$('#rut_profileEdit').val(rut.substr(0,(rut.length-2)));
		$('#verificadorEdit').val(rut.substr(-1,(rut.length)));

		$('#buttonEditP').fadeOut('slow',
			function() { 
				$(this).hide();
				$('#buttonEditP2').fadeIn(300);
		});

		$('#nombres_profile').fadeOut('slow',
			function() { 
				$(this).hide();
				$('#nombres_profileE').fadeIn(300);
		});
		$('#apellidos_profile').fadeOut('slow',
			function() { 
				$(this).hide();
				$('#apellidos_profileE').fadeIn(300);
		});

		$('#rut_profile').fadeOut('slow',
			function() { 
				$(this).hide();
				$('#rut_profileE').fadeIn(300);
		});

		$('#email_profile').fadeOut('slow',
			function() { 
				$(this).hide();
				$('#email_profileE').fadeIn(300);
		});

		$('#telefono_profile').fadeOut('slow',
			function() { 
				$(this).hide();
				$('#telefono_profileE').fadeIn(300);
		});
	}

	function EditarProfile2() {
		$('#btnGuardarProfile').fadeOut('slow');

		$('#buttonEditP2').fadeOut('slow',
			function() { 
				$(this).hide();
				$('#buttonEditP').fadeIn(300);
		});

		$('#nombres_profileE').fadeOut('slow',
			function() { 
				$(this).hide();
				$('#nombres_profile').fadeIn(300);
		});
		$('#apellidos_profileE').fadeOut('slow',
			function() { 
				$(this).hide();
				$('#apellidos_profile').fadeIn(300);
		});

		$('#rut_profileE').fadeOut('slow',
			function() { 
				$(this).hide();
				$('#rut_profile').fadeIn(300);
		});

		$('#email_profileE').fadeOut('slow',
			function() { 
				$(this).hide();
				$('#email_profile').fadeIn(300);
		});

		$('#telefono_profileE').fadeOut('slow',
			function() { 
				$(this).hide();
				$('#telefono_profile').fadeIn(300);
		});

	}


	// function productos(){
	// }

	// function productos2(){
	// 	$('#productos2').fadeOut('slow',
	// 		function() { 
	// 			$(this).hide(); 
	// 			$('#productos').fadeIn(300);
	// 	});
	// }


    

	function EMontos() {

	}

	function EspecificarMontoB(opcion){

		if(opcion ==1){

			$('#muestraMultaMonto').fadeOut('slow',
				function() { 
					$(this).hide();
					$('#muestraEstacionamientoMonto').fadeOut('slow');
					$('#muestraEstacionamientoMonto').hide();

			});
			$('#muestraInmuebleMonto').fadeIn(300);
		}

		if (opcion == 2) {
			$('#muestraInmuebleMonto').fadeOut('slow',
				function() { 
					$(this).hide();
					$('#muestraMultaMonto').fadeOut('slow');
					$('#muestraMultaMonto').hide();

			});
			$('#muestraEstacionamientoMonto').fadeIn(300);
		}

		if (opcion == 3) {
			$('#muestraEstacionamientoMonto').fadeOut('slow',
				function() { 
					$(this).hide();
					$('#muestraInmuebleMonto').fadeOut('slow');
					$('#muestraInmuebleMonto').hide();

			});
			$('#muestraMultaMonto').fadeIn(300);
		}

		
	}
	function PagoC(opcion) {
		$('#PagoCInmuebles2').empty();
		$('#PagoCEstaciona2').empty();
		$('.accion').val(1);
		if (opcion ==1) {
			$('#anioPagoComunI').empty();
			$('#anioPagoComunI').append('<option selected>Seleccione año</option>');
			for (var i = a; i < a+5; i++) {
				$('#anioPagoComunI').append('<option value="'+i+'">'+i+'</option>');
			}
			$('#PagoCInmueble').modal('show');
		}
		if(opcion ==2){
			$('#anioPagoComunE').empty();
			$('#anioPagoComunE').append('<option selected>Seleccione año</option>');
			for (var i = a; i < a+5; i++) {
				$('#anioPagoComunE').append('<option value="'+i+'">'+i+'</option>');
			}
			$('#PagoCEstacionamiento').modal('show');
			$('#PagoCEstaciona').empty();
		}
		if(opcion==3) {
			$('#anioPagoComunI_E').empty();
			$('#anioPagoComunI_E').append('<option selected>Seleccione año</option>');
			for (var i = a; i < a+5; i++) {
				$('#anioPagoComunI_E').append('<option value="'+i+'">'+i+'</option>');
			}
			$('#PagoCInmuebleE').modal('show');
		}
		if(opcion==4){
			$('#anioPagoComunE2').empty();
			$('#anioPagoComunE2').append('<option selected>Seleccione año</option>');
			for (var i = a; i < a+5; i++) {
				$('#anioPagoComunE2').append('<option value="'+i+'">'+i+'</option>');
			}
			$('#PagoCEstacionamiento2').modal('show');
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

	function montosEstacionaAnio(anio, opcion) {
		$('#editar2').empty();
		$('#spinnerE').css('display','block');
		$('#spinnerE2').css('display','block');
		var id =1;
		$.get('pagoscomunes/2/'+anio+'/buscarPagoC', function(data) {
        		
                $('#PagoCEstaciona1').empty();
                $('#PagoCEstaciona2').empty();
                

                

                if (opcion == 1) {


	               	if (data.length == 0){
                	// $('#PagoCEstaciona1').append('<label>Montos por mes</label><br>');

	                    $('#PagoCEstaciona1').append(
	                        "<div class='card-box'>"+
	                            "<div class='row'>"+
	                                "<div class='col-md-6' width='100%'>"+
	                                    "<a href='#' class='btn btn-block btn-success' onclick='mostrarC(1)'>Montos por mes</a>"+
	                                "</div>"+
	                                "<div class='col-md-6' width='100%'>"+
	                                    "<a href='#' class='btn btn-block btn-warning' onclick='mostrarC(2)'>Monto por año</a>"+
	                                "</div>"+
	                            "</div>"+
	                        "</div>"
	                    );
	               		$('#PagoCEstaciona1').append(
	               			'<div id="mostrarAnioI" style="display:none;">'+
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
		                        '</div>'+
		                    '</div>'
	                    );
	               		$('#PagoCEstaciona1').append('<div id="mostrarAnioM"><label>Montos por mes</label><br></div>');
						
	                    for (var i = 0; i < 12; i++) {
	                        $('#mostrarAnioM').append(
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
	                                            '<input type="text" name="monto[]" class="form-control" placeholder="10" value="0">'+
	                                        '</div>'+
	                                    '</div>'+
	                                '</div>'+
	                            '</div>'
	                        );
	                    }
	                }else{
	                	$('#PagoCEstaciona1').append('<h3>Ya hay registros de pago común para este año</h3>');
	                }
                }else{
	               	if (data.length > 0){
					// $('#PagoCEstaciona2').append('<label>Montos por mes</label><br>');



	               		$('#PagoCEstaciona2').append(
	                        "<div class='card-box'>"+
	                            "<div class='row'>"+
	                                "<div class='col-md-6' width='100%'>"+
	                                    "<a href='#' class='btn btn-block btn-success' onclick='mostrarC(1)'>Montos por mes</a>"+
	                                "</div>"+
	                                "<div class='col-md-6' width='100%'>"+
	                                    "<a href='#' class='btn btn-block btn-warning' onclick='mostrarC(2)'>Monto por año</a>"+
	                                "</div>"+
	                            "</div>"+
	                        "</div>"
	                    );
	               		$('#PagoCEstaciona2').append(
	               			'<div id="mostrarAnioI" style="display:none;">'+
		                        '<div class="row">'+
		                            '<div class="col-md-12">'+
		                                '<div class="form-group">'+
		                                    '<label>Monto por todo el año</label>'+
		                                    '<div class="input-group mb-2">'+
		                                        '<div class="input-group-prepend">'+
		                                            '<div class="input-group-text">$</div>'+
		                                        '</div>'+
		                                        '<input type="text" id="montoAnioC" name="montoaAnio" value="'+data[0].monto+'" class="form-control" id="montoAnio_e" placeholder="10">'+
		                                    '</div>'+
		                                '</div>'+
		                            '</div>'+
		                        '</div>'+
		                    '</div>'
	                    );
	               		$('#PagoCEstaciona2').append('<div id="mostrarAnioM"><label>Montos por mes</label><br></div>');
	                    for (var i = 0; i < 12; i++) {

	                    	var monto=0;

	                    	if(data[i].monto > 0){
	                    		monto=data[i].monto;
	                    	}else{
	                    		monto=0;
	                    	}
	                    
	                        $('#mostrarAnioM').append(
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
	                                            '<input type="text" name="monto[]" class="form-control" placeholder="10" value="'+monto+'">'+
	                                        '</div>'+
	                                    '</div>'+
	                                '</div>'+
	                            '</div>'
	                        );
	                    }
	                }else{
	                	$('#PagoCEstaciona2').append('<h3>¡No hay registros de este año para editar!</h3>');
	                }
                }
            })
		.done(function(data) {
			$('#spinnerE').css('display','none');
			$('#spinnerE2').css('display','none');
		});
	}
	function montosInmuebleAnio(anio,opcion) {
		$('#editar1').empty();
		$('#spinnerI').css('display','block');
		$('#spinnerI2').css('display','block');
		var id =1;
		$.get('pagoscomunes/1/'+anio+'/buscarPagoC', function(data) {
			
        		
                $('#PagoCInmuebles1').empty();
                $('#PagoCInmuebles2').empty();
                

                if (opcion == 1) {

				
	               	if (data.length == 0){

	               		$('#PagoCInmuebles1').append(
	               			"<p class='text-success'>Registrando nuevo gasto común para este año</p>"+
	                        "<div class='card-box'>"+
	                            "<div class='row'>"+
	                                "<div class='col-md-6' width='100%'>"+
	                                    "<a href='#' class='btn btn-block btn-success' onclick='mostrarC(1)'>Montos por mes</a>"+
	                                "</div>"+
	                                "<div class='col-md-6' width='100%'>"+
	                                    "<a href='#' class='btn btn-block btn-warning' onclick='mostrarC(2)'>Monto por año</a>"+
	                                "</div>"+
	                            "</div>"+
	                        "</div>"
	                    );
	               		$('#PagoCInmuebles1').append(
	               			'<div id="mostrarAnioI" style="display:none;">'+
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
		                        '</div>'+
		                    '</div>'
	                    );
                		$('#PagoCInmuebles1').append('<div id="mostrarAnioM"><label>Montos por mes</label><br></div>');
	                    
	                    for (var i = 0; i < 12; i++) {
	                    
	                        $('#mostrarAnioM').append(
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
	                                            '<input type="text" name="monto[]" class="form-control" placeholder="10" value="0">'+
	                                        '</div>'+
	                                    '</div>'+
	                                '</div>'+
	                            '</div>'
	                        );

	                    }
	                }else{
	                	$('#PagoCInmuebles1').append(
	                        "<p class='text-warning'>¡Ya existen valores para este año!</p>"+
	                        "<div class='card-box'>"+
	                            "<div class='row'>"+
	                                "<div class='col-md-6' width='100%'>"+
	                                    "<a href='#' class='btn btn-block btn-success' onclick='mostrarC(1)'>Montos por mes</a>"+
	                                "</div>"+
	                                "<div class='col-md-6' width='100%'>"+
	                                    "<a href='#' class='btn btn-block btn-warning' onclick='mostrarC(2)'>Monto por año</a>"+
	                                "</div>"+
	                            "</div>"+
	                        "</div>"
	                    );
	               		$('#PagoCInmuebles1').append(
	               			'<div id="mostrarAnioI" style="display:none;">'+
		                        '<div class="row">'+
		                            '<div class="col-md-12">'+
		                                '<div class="form-group">'+
		                                    '<label>Monto por todo el año</label>'+
		                                    '<div class="input-group mb-2">'+
		                                        '<div class="input-group-prepend">'+
		                                            '<div class="input-group-text">$</div>'+
		                                        '</div>'+
		                                        '<input type="text" id="montoAnioC" name="montoaAnio" class="form-control" value="'+data[0].monto+'"  id="montoAnio_e" placeholder="10">'+
		                                    '</div>'+
		                                '</div>'+
		                            '</div>'+
		                        '</div>'+
		                    '</div>'
	                    );
                		$('#PagoCInmuebles1').append('<div id="mostrarAnioM"><label>Montos por mes</label><br></div>');
	                    
	                    for (var i = 0; i < 12; i++) {
	                    	
	                    	var monto=0;

	                    	if(data[i].monto > 0){
	                    		monto=data[i].monto;
	                    	}else{
	                    		monto=0;
	                    	}
	                        $('#mostrarAnioM').append(
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
	                                            '<input type="text" name="monto[]" class="form-control" placeholder="10" value="'+monto+'">'+
	                                        '</div>'+
	                                    '</div>'+
	                                '</div>'+
	                            '</div>'
	                        );
	                    }
	                }
                }else{

	               	if (data.length > 0){
	               		$('#PagoCInmuebles2').append(
	                        "<div class='card-box'>"+
	                            "<div class='row'>"+
	                                "<div class='col-md-6' width='100%'>"+
	                                    "<a href='#' class='btn btn-block btn-success' onclick='mostrarC(1)'>Montos por mes</a>"+
	                                "</div>"+
	                                "<div class='col-md-6' width='100%'>"+
	                                    "<a href='#' class='btn btn-block btn-warning' onclick='mostrarC(2)'>Monto por año</a>"+
	                                "</div>"+
	                            "</div>"+
	                        "</div>"
	                    );
	               		$('#PagoCInmuebles2').append(
	               			'<div id="mostrarAnioI" style="display:none;">'+
		                        '<div class="row">'+
		                            '<div class="col-md-12">'+
		                                '<div class="form-group">'+
		                                    '<label>Monto por todo el año</label>'+
		                                    '<div class="input-group mb-2">'+
		                                        '<div class="input-group-prepend">'+
		                                            '<div class="input-group-text">$</div>'+
		                                        '</div>'+
		                                        '<input type="text" id="montoAnioC" value="'+data[0].monto+'" name="montoaAnio" class="form-control" id="montoAnio_e" placeholder="10">'+
		                                    '</div>'+
		                                '</div>'+
		                            '</div>'+
		                        '</div>'+
		                    '</div>'
	                    );
                		$('#PagoCInmuebles2').append('<div id="mostrarAnioM"><label>Montos por mes</label><br></div>');

	                    for (var i = 0; i < 12; i++) {
	                    	
	                    	var monto=0;

	                    	if(data[i].monto > 0){
	                    		monto=data[i].monto;
	                    	}else{
	                    		monto=0;
	                    	}
	                        $('#mostrarAnioM').append(
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
	                                            '<input type="text" name="monto[]" class="form-control" placeholder="10" value="'+monto+'">'+
	                                        '</div>'+
	                                    '</div>'+
	                                '</div>'+
	                            '</div>'
	                        );
	                    }
	                }else{
	                	$('#PagoCInmuebles2').append('<h3>¡No hay registros de este año para editar!</h3>');
	                }
                }
            })
		.done(function(data) {
			$('#spinnerI').css('display','none');
			$('#spinnerI2').css('display','none');
		});
	}

	function mostrarC(opcion) {
        if (opcion==1) {
        	$('#montoAnioC').removeAttr('required',false);
            $('#mostrarAnioM').show();
            $('#mostrarAnioI').css('display','none');
            $('#montoAnioC').attr('disabled',true);
            $('.accion').val(1);
        } else {
        	$('#montoAnioC').attr('required',true);
            $('#mostrarAnioM').hide();
            $('#mostrarAnioI').css('display','block');
            $('#montoAnioC').attr('disabled',false);
            $('.accion').val(2);
        }
    }

	function NuevoResidente() {
		console.log('hola');
		$('#crearResidente').modal('show');
		$('#asignaInmueResidente').empty();
		$('#asignaEstaResidente').empty();

		$.get('inmuebles_disponibles/1044/buscar', function (data) {
		})
		.done(function(data) {
			console.log(data.length);
			if(data.length>0){

				for (var i = 0; i < data.length; i++) {
					$('#asignaInmueResidente').append('<option value="'+data[i].id+'">'+data[i].idem+'</option>');
				}
			}else{
				$('#asignaInmueResidente').append('<option disabled>No hay inmuebles disponibles para asignar</option>');
			}

		});

		$.get('estacionamientos_disponibles/1044/buscar', function (data) {
		})
		.done(function(data) {

			if(data.length>0){

				for (var i = 0; i < data.length; i++) {
					$('#asignaEstaResidente').append('<option value="'+data[i].id+'">'+data[i].idem+'</option>');
				}
			}else{
				$('#asignaEstaResidente').append('<option disabled>No hay estacionamientos disponibles para asignar</option>');
			}

		});

	}





















	//------------------------VISTA RESIDENTES-------------------------------------

	


	function BMesesResidente(id_residente) {
		$('#mostrarFlow').hide();
		$('#pagarMesesModal').modal('show');
		$('#MesPagarResi').empty();
		$('#muestraMesesAPagar').empty();
		$('#muestraMesesAPagar2').css('display','none');
		$('#CargandoPagarArriendos').css('display','block');
		var m=f.getMonth();

		$.get("arriendos/"+id_residente+"/buscar_inmuebles2", function(data) {
		})
		.done(function(data) {
			
			$.get("arriendos/"+data[0].id+"/buscar_inmuebles3",function (data2) {
			})


			.done(function(data2) {
				if(data2.length>0){
					for (var i = 0; i < data2.length; i++) {

						if(data2[i].alquiler_status=="En Uso"){
							if(i>0 && i<12){

								if(data2[i].status == 'Pendiente'){
									$('#muestraMesesAPagar').append(
										'<div class="row">'+
						                    '<div class="col-md-4">'+
						                        '<div class="form-group">'+
						                            '<input type="hidden" name="id_mes[]" class="form-control-plaintext">'+
						                            '<label>'+mes[i]+ '</label>'+
						                        '</div>'+
						                    '</div>'+
						                    '<div class="col-md-4">'+
						                    	'<p class="text-success">' +data2[i].status+'</p>'+
						                    '</div>'+
						                    '<div class="col-md-4">'+
						                    	'<div class="form-group">'+
													'<div class="mt-3">'+
			                                            '<div class="custom-control custom-checkbox mb-2">'+
			                                                '<input type="checkbox"  name="mes[]" value="'+data2[i].mes+'" class="custom-control-input" id="customCheck'+i+'" data-parsley-mincheck="1" required>'+
			                                                '<label class="custom-control-label" for="customCheck'+i+'"></label>'+
			                                            '</div>'+
			                                        '</div>'+
			                                    '</div>'+
						                    '</div>'+
						                '</div><hr>'
						            );
								}else if(data2[i].status == 'Por Confirmar'){
									$('#muestraMesesAPagar').append(
										'<div class="row border">'+
						                    '<div class="col-md-4">'+
						                        '<div class="form-group">'+
						                            '<input type="hidden" name="mes[]" class="form-control-plaintext">'+
						                            '<label style="color:gray;">'+mes[i]+ '</label>'+
						                        '</div>'+
						                    '</div>'+
						                    '<div class="col-md-4">'+
						                    	'<p class="text-warning"><strong>' +data2[i].status+'</strong> | CÓDIGO TRANS.: <b>'+data2[i].referencia+'</b></p>'+
						                    '</div>'+
						                    '<div class="col-md-4">'+
						                    	'<div class="form-group">'+
							                        '<div style="font-size: 1em; ">'+
						                                '<svg class="bi bi-lock-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'+
														  '<rect width="11" height="9" x="2.5" y="7" rx="2"/>'+
														  '<path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>'+
														'</svg>'+
							                        '</div>'+
												'</div>'+
						                    '</div>'+
						                '</div>'
						            );
								}
								else{
									$('#muestraMesesAPagar').append(
										'<div class="row border">'+
						                    '<div class="col-md-4">'+
						                        '<div class="form-group">'+
						                            '<input type="hidden" name="mes[]" class="form-control-plaintext">'+
						                            '<label style="color:gray;">'+mes[i]+ '</label>'+
						                        '</div>'+
						                    '</div>'+
						                    '<div class="col-md-4">'+
						                    	'<p class="text-danger"><strong>' +data2[i].status+'</strong></p>'+
						                    '</div>'+
						                    '<div class="col-md-4">'+
						                    	'<div class="form-group">'+
							                        '<div style="font-size: 1em; ">'+
						                                '<svg class="bi bi-lock-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'+
														  '<rect width="11" height="9" x="2.5" y="7" rx="2"/>'+
														  '<path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>'+
														'</svg>'+
							                        '</div>'+
												'</div>'+
						                    '</div>'+
						                '</div>'
						            );
								}
							}
						}//cierre de if de status alquilado
					}//cierre del for
					$('#muestraMesesAPagar').append(
						'<br><div class="row border" style="display:none;" id="referencia_p">'+
		                    '<div class="col-md-12">'+
		                        '<div class="form-group">'+
		                            '<label>Referencia</label>'+
		                            '<input type="number" name="referencia" placeholder="Nro. de referencia" id="referencia_p_arriendos" maxlength="20" class="form-control border border-primary" required="required">'+
		                        '</div>'+
		                    '</div>'+
		                '</div>'
		            );
		            $('#muestraMesesAPagar').append('<input type="hidden" name="id_user" value="'+id_residente+'" >');
		            $('#mostrarFlow').show();
				}else{
					$('#muestraMesesAPagar2').css('display','block');
				}

			});
			$('#CargandoPagarArriendos').css('display','none');
		});
	}




	function pagarMultasResidente(id_residente) {
		$('#CargandoMultasResi').css('display','block');
		$('#MultasPagarResi').empty();
		$('#idMultaForm').empty();
		$('#mrSeleccionado').empty();
		$('#mrSeleccionado2').empty();
		$('#id_mensMultaR').empty();
		 $('#TotalPagarMR').html(parseInt(0));
		$('#total').val(0);
		$('#pagarMultasModal').modal('show');
		$('#id_residente_mr').empty();
		$('#id_residente_mr').val(id_residente);
		$.get('multas_residentes/'+id_residente+'/buscar', function(data) {
		})
		.done(function(data) {
			if(data.length){
				$('#MultasPagarResi').append('<option value="0" selected disabled>Seleccione Multa/Recarga</option>');	
				for (var i = 0; i < data.length; i++) {
					if (data[i].status == 'Enviada') {
						$('#MultasPagarResi').append('<option class="text-danger" value="'+data[i].id+'">'+data[i].motivo+' -  '+data[i].tipo+' - '+data[i].monto+'  -  '+data[i].anio+'</option>');					
					}
				}
			}else{
				$('#MultasPagarResi').append('<option disabled selected>El residente no tiene multas disponibles para pagar</option>');
			}
			$('#CargandoMultasResi').css('display','none');
		});
	}

	function PagarMultasAdmin(id_multa){
		$('#VerConfirmarPagoR').empty();
		$('#VerConfirmarPagoR2').empty();
		$('#CargandoMultasResi').css('display','block');
		$('#pagarMultasModal2').modal('show');

		$.get("residentes_confirmar/"+id_multa+"/buscar", function(data) {
		})
		.done(function(data) {
			if(data.length>0){
				$('#VerConfirmarPagoR').append(
					'<select class="form-control select2" id="SelectConfirmarPagoR" onchange="selectResiMulta('+id_multa+',this.value)" name="id_residente">'+
					'</select>'
				);


				$('#SelectConfirmarPagoR').append('<option disabled selected>Seleccione residente</option>');
				for (var i = 0; i < data.length; i++) {
					$('#SelectConfirmarPagoR').append(
						'<option value="'+data[i].id+'">'+data[i].nombres+' '+data[i].apellidos+' - '+data[i].rut+'</option>'
					);
				}
			}
			else{
				alert('nada');
			}
		$('#CargandoMultasResi').css('display','none');
		});
	}

	function selectResiMulta(id_multa,id_residente){
		$('#idResidenteConfirmar').val(id_residente);
		$('#idMultaConfirmar').val(id_multa);
		$('#VerConfirmarPagoR2').append(
			'<br><div class="row">'+
                '<div class="col-md-12">'+
                    '<div class="form-group">'+
                        '<label>Referencia</label>'+
                        '<input type="text" class="form-control" name="referencia" placeholder="Ingrese el número de Referencia" max="20" maxlength="20" required>'+
                    '</div>'+
                '</div>'+
            '</div>'
		);
		$('#VerConfirmarPagoR2').append(
			'<br><div class="row">'+
                '<div class="col-md-5">'+
                    '<center>'+
                    	'<h3 class="text-warning">Por Confirmar</h3>'+
                    '</center>'+
                '</div>'+
                '<div class="col-md-2">'+
                    '<center>'+
                    	'<h3>></h3>'+
                    '</center>'+
                '</div>'+
                '<div class="col-md-5">'+
                    '<center>'+
                    	'<h3 class="text-success">Pagado</h3>'+
                    '</center>'+
                '</div>'+
            '</div>'
		);
	}
	//------------------------FIN VISTA RESIDENTES---------------------------------
	function AnuncioCreate(){
		$('#crearAnuncio').modal('show');
	}

	function EditarAnuncio(id,id_empresa,titulo,descripcion,url_img,link,referencia,id_planP){
		$('#id_empresa_anuncio').val(id_empresa);
		$('#SelectAdminA3').val();
		$('#editarAnuncio').modal('show');
		$('#mostrarImagenEditar').empty();
		$('#mostrarImagenEditar').append('<img class="imagenAnun text-dark" src="'+url_img+'" width="250" height="200">');
		$('#idAnuncioE').val(id);
		$('#tituloAnunE').val(titulo);
		$('#urlAnunE').val(link);
		$('#descripAnunE').val(descripcion);
		$('#referenciaAnuncioE').val(referencia);
		$('#customRadio2-'+id_planP).attr('checked',true);
	}

	function EliminarAnuncio(id){
		$('#eliminarAnuncio').modal('show');
		$('#idAnuncio').val(id);
	}

	function pagosPorComprobar(id_residente) {
        $('#PagoConfir').modal('show');
		$('#muestraMesesAComprob').empty();
		$('#muestraMesesAComprob2').empty();
		$('#CargandoPagosComprobar').css('display','block');
		var m=f.getMonth();

		$.get("arriendos/"+id_residente+"/buscar_inmuebles2", function(data) {
		})
		.done(function(data) {
			
			$.get("arriendos/"+data[0].id+"/buscar_inmuebles3",function (data2) {
			})


			.done(function(data2) {
				var j=0;
				var l=0;
				var k=0;
				if(data2.length>0){
					for (var i = 0; i < data2.length; i++) {
						if(data2[i].status == 'Por Confirmar'){
							j=j+1;
						}
						if(j>0){

							if(data2[i].status == 'Por Confirmar'){
								k++;
								$('#muestraMesesAComprob').append(
									'<div class="row">'+
					                    '<div class="col-md-4">'+
					                        '<div class="form-group">'+
					                            '<input type="hidden" name="id_mes[]" class="form-control-plaintext">'+
					                            '<label>'+mes[i]+ '</label>'+
					                        '</div>'+
					                    '</div>'+
					                    '<div class="col-md-4">'+
					                    	'<p class="text-success">' +data2[i].status+'</p> CÓDIGO TRANS.: <b>'+data2[i].referencia+'</b>'+
					                    '</div>'+
					                    '<div class="col-md-4">'+
					                    	'<div class="form-group">'+
												'<div class="mt-3">'+
		                                            '<div class="custom-control custom-checkbox mb-2">'+
		                                                '<input type="checkbox"  name="mes[]" value="'+data2[i].mes+'" class="custom-control-input" id="customCheck'+i+'">'+
		                                                '<label class="custom-control-label" for="customCheck'+i+'"></label>'+
		                                            '</div>'+
		                                        '</div>'+
		                                    '</div>'+
					                    '</div>'+
					                '</div>'
					            );
							}else{
								k=0;
								l++;
							}
						}
					}//cierre del for
					if(l == 0 && k == 0){
						$('#muestraMesesAComprob').append('<h3>El residente no posee pagos por comprobar</h3>');
					}
		            $('#muestraMesesAComprob').append('<input type="hidden" name="id_residente" value="'+id_residente+'" >');
		            $('#muestraMesesAComprob').append('<input type="hidden" name="opcion" value="3" >');
				}else{
					$('#muestraMesesAPagar2').css('display','block');
					// $('#muestraMesesAComprob2').append('El residente no tiene pagos por confirmar');
				}

			});
			$('#CargandoPagosComprobar').css('display','none');
		});
    }

    function multasPorComprobar(id_residente) {
    	$('#ResidenteTienePagosC').css('display','none');
    	$('#ResidenteTienePagosC2').empty();
        $('#PagoConfir').modal('show');
		$('#muestraMesesMultasComprob').empty();
		$('#muestraMesesMultasComprob2').empty();
		$('#CargandoPagosComprobar').css('display','block');
		var m=f.getMonth();

		$.get('mr/'+id_residente+'/'+a+'/buscar_mr_confirmar', function(data) {
		})
		.done(function(data) {
			
			var j=0;
			var l=0;
			var k=0;
			if(data.length>0){
				$('#ResidenteTienePagosC').css('display','block');
				for (var i = 0; i < data.length; i++) {
					if(data[i].tipo == 'Multa'){
						$('#muestraMesesMultasComprob').append(
							'<tr>'+
								'<td><span class="text-danger"><b>'+data[i].tipo+': </b></span>'+data[i].motivo+'</td>'+
								'<td align="center">'+mostrar_mes(data[i].mes)+'<br>'+data[i].anio+'</td>'+
								'<td class="text-warning" align="center"><b>'+data[i].status+'</b><br><center>CÓDIGO TRANS.: <br><strong>'+data[i].referencia+ '</strong></center></td>'+
								'<td>'+
									'<center>'+
                                        '<div class="custom-control custom-checkbox">'+
                                            '<input type="checkbox"  name="id_mr[]" value="'+data[i].id_resi_mr+'" class="custom-control-input" id="customCheck'+i+'">'+
                                            '<input type="hidden"  name="referencia[]" value="'+data[i].referencia+'">'+
                                            '<label class="custom-control-label" for="customCheck'+i+'"></label>'+
                                        '</div>'+
	                                '</center>'+
								'</td>'+
							'</tr>'
			            );
					}else{
						$('#muestraMesesMultasComprob').append(
							'<tr>'+
								'<td><span class="text-success"><b>'+data[i].tipo+': </b></span>'+data[i].motivo+'</td>'+
								'<td align="center">'+mostrar_mes(data[i].mes)+'<br>'+data[i].anio+'</td>'+
								'<td class="text-warning" align="center"><b>'+data[i].status+'</b><br><center>CÓDIGO TRANS.: <br><strong>'+data[i].referencia+ '</strong></center></td>'+
								'<td>'+
									'<center>'+
                                        '<div class="custom-control custom-checkbox">'+
                                            '<input type="checkbox"  name="id_mr[]" value="'+data[i].id_resi_mr+'" class="custom-control-input" id="customCheck'+i+'">'+
                                            '<input type="hidden"  name="referencia[]" value="'+data[i].referencia+'">'+
                                            '<label class="custom-control-label" for="customCheck'+i+'"></label>'+
                                        '</div>'+
	                                '</center>'+
								'</td>'+
							'</tr>'
			            );
					}
				}//cierre del for
				// if(l == 0 && k == 0){
				// 	$('#muestraMesesMultasComprob').append('<h3>El residente no posee pagos por comprobar</h3>');
				// }
	            $('#muestraMesesMultasComprob').append('<input type="hidden" name="id_residente" value="'+id_residente+'" >');
	            $('#muestraMesesMultasComprob').append('<input type="hidden" name="opcion" value="3" >');
			}else{
				$('#ResidenteTienePagosC').css('display','none');
				$('#muestraMesesAPagar2').css('display','block');
				$('#ResidenteTienePagosC2').append('<h3 align="center">El residente no tiene multas o recargas</h3>');
			}
			$('#CargandoPagosComprobar').css('display','none');
		});
    }

    function montoTotalMulta(id_multa){
    	// alert(id_multa);
        if(id_multa!= null){
            $.get("multas_recargas/"+id_multa+"/buscar",function (data) {
            })
            .done(function(data) {
            	$('#MultasPagarResi').val(0);
            	var m = data[0].motivo;
            	if (m.length > 25) {
            		motivo = m.substr(0,25)+"...";
            	}else{
            		motivo=m;
            	}
                var monto= parseFloat(data[0].monto);
                var tipo= ""+data[0].tipo+"";

                if(data[0].tipo == 'Recarga'){
                	var tipo2 = 1;
                	var textcolor ="text-success";
                }else{
                	var tipo2 = 2;
                	var textcolor ="text-danger";
                }
                $('#mrSeleccionado').append(
                    '<tr id="trMulta'+data[0].id+'" style="width:100%; position:relative;">'+
                        '<th style="position:relative;" width="30%">'+
                            '<div class="'+textcolor+'">'+motivo+'</div>'+
                        '</th>'+
                        '<td align="right">'+
                            '<div class="'+textcolor+'"><strong>'+data[0].tipo +'</strong></div>'+
                        '</td>'+
                        '<td align="left">'+
                            '<div class="'+textcolor+'"><strong>$'+monto+'</strong></div>'+
                        '</td>'+
                        '<td>'+
                            '<button type="button" onclick="borrarMultaT('+data[0].id+','+monto+','+tipo2+')" class="btn btn-danger btn-rounded btn-sm">Borrar</button>'+
                            '</td>'+
                    '</tr>'
                );
                $('#mrSeleccionado2').append(
                    '<tr id="trMulta'+data[0].id+'-2" style="width:100%; position:relative;">'+
                        '<th style="position:relative;" width="30%">'+
                            '<div class="'+textcolor+'">'+motivo+'</div>'+
                        '</th>'+
                        '<td align="right">'+
                            '<div class="'+textcolor+'"><strong>'+data[0].tipo +'</strong></div>'+
                        '</td>'+
                        '<td align="left">'+
                            '<div class="'+textcolor+'"><strong>$'+monto+'</strong></div>'+
                        '</td>'+
                        '<td>'+
                            '<button type="button" onclick="borrarMultaT('+data[0].id+','+monto+','+tipo2+')" class="btn btn-danger btn-rounded btn-sm">Borrar</button>'+
                            '</td>'+
                    '</tr>'
                );

                $('#idMultaForm').append('<input type="hidden" name="id_mensMulta[]" id="inputM'+id_multa+'" value="'+id_multa+'">');
                    
                montoTotal(2,monto);
                $("#MultasPagarResi option[value=" + id_multa + "]").attr('disabled',true);
                

                $('#id_mensMultaR').append('<option selected id="multaR'+data[0].id+'" value="'+data[0].id+'">'+data[0].id+'</option>');
            });
        }
    }
    function borrarMultaT(id_multa, monto, tipo) {
        $("#MultasPagarResi option[value=" + id_multa + "]").removeAttr('disabled');
        $("#inputM"+id_multa).remove();
        $("#inputM"+id_multa+'-2').remove();
        $("#trMulta"+id_multa).remove();
        $("#trMulta"+id_multa+'-2').remove();

        montoTotal(1,monto);

        
    }

    function montoTotal(tipo, monto){
        var total=0;
        // var cuentaFilas = $('#mrSeleccionado tr').length;
        // if (cuentaFilas == 0) {
            // $('#TotalPagar').html(parseInt(0));
            //$('#total').val(0);
        // } else {
        if (tipo == 1) {
        	var montoT=parseInt($('#TotalPagarMR').html())-monto;
            $('#TotalPagarMR').html(montoT);
            $("#totalMR2").val(montoT);
        } else if(tipo == 2) {
        	var montoT=parseInt($('#TotalPagarMR').html())+monto;
            $('#TotalPagarMR').html(montoT);
            $("#totalMR2").val(montoT);
        }
        // }
    }
    function VerAdminHome(opcion) {
    	if (opcion == 1) {
	        $('#mostrarAdmins').fadeIn(300);

	    	$('#botonAdmins').fadeOut('slow',
	            function() { 
	                $(this).hide();
	                $('#botonAdmins2').fadeIn(300);
	        });
    	}else{
	        $('#botonAdmins2').fadeOut('slow');
	    	$('#mostrarAdmins').fadeOut('slow',
	            function() { 
	                $(this).hide();
	                $('#botonAdmins').fadeIn(300);
	        });
    	}
    }

    function VerAdminAsignado(id_anuncio) {
    	$('#CargandoAdminsAsignados').show();
    	$('#administradoresA').empty();
    	$('#verAsignadosAnuncios').modal('show');

    	$.get('anuncios/'+id_anuncio+'/admin_asignados',function (data) {
	    })
	    .done(function(data) {
	    	if (data.length>0) {
    			$("#administradoresA").append(
    				'<table class="table dataTable data-table-basic table-curved table-striped tabla-estilo" style="width:100%; table-layout: auto;">'+
    					'<thead>'+
    						'<tr class="bg-info text-white">'+
    							'<th>Nombre</th>'+
    							'<th>Rut</th>'+
    							'<th>Email</th>'+
    						'</tr>'+
    					'</thead>'+
    					'<tbody id="tablaBodyAnunciosA">'+
    						
    					'</tbody>'+
    				'</table>'
    			);

	    		for (var i = 0; i < data.length; i++) {
	    			$("#tablaBodyAnunciosA").append(
	    				'<tr>'+
							'<td>'+data[i].name+'</td>'+
							'<td>'+data[i].rut+'</td>'+
							'<td>'+data[i].email+'</td>'+
						'</tr>'
	    			);
	    		}
			}else{
	        	$("#administradoresA").append('<h3 align="center">Sin administradores asignados</h3>');
	        }
	        $('#CargandoAdminsAsignados').hide();
		});	
    }
    function TodosAdmins() {

    		
    	if($('#todoAdmin').prop('checked')){

    		$('#SelectAdminA').attr('disabled',true);
    		$('#SelectAdminA').removeAttr('required',false);

    		var options = $("#SelectAdminA2 > option").clone();
    		$("#SelectAdminA > option").remove();
    		$("#SelectAdminA").append(options);

    	}else{
    		$('#SelectAdminA').removeAttr('disabled',false);
    		$('#SelectAdminA').attr('required',true);
    	}


    	if($('#todoAdmin2').prop('checked')){

			$('#SelectAdminA3').attr('disabled',true);
			$('#SelectAdminA3').removeAttr('required',false);

    		var options = $("#SelectAdminA4 > option").clone();
    		$("#SelectAdminA3 > option").remove();
    		$("#SelectAdminA3").append(options);

    	}else{
    		$('#SelectAdminA3').removeAttr('disabled',false);
    		$('#SelectAdminA3').attr('required',true);
    	}
    }

    function input_file(file){
    	$('.label-form').removeClass('btn-primary').addClass('btn-success').html('<strong>Archivo seleccionado </strong><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>');

    	$('.label-form2').removeClass('btn-primary').addClass('btn-success').html('<strong>Archivo seleccionado </strong><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>');

    }


    function selectPasarela(opcion, id){
    	if ($('#check_pasarela'+opcion+'-'+id).prop('checked')) {
    		$('#link_pasarela'+opcion+'-'+id).removeAttr('disabled',false);
    		$('#link_pasarela'+opcion+'-'+id).attr('required',true);
    		$('#link_pasarela'+opcion+'-'+id).addClass('border').addClass('border-success');
    	}else{
    		$('#link_pasarela'+opcion+'-'+id).attr('disabled',true);
    		$('#link_pasarela'+opcion+'-'+id).removeAttr('required',false);
    		$('#link_pasarela'+opcion+'-'+id).removeClass('border').removeClass('border-success');
    		$('#link_pasarela'+opcion+'-'+id).val(null);
    	}
    }

    function selectPasarela2(id) {
    	
    }

    function deletePasarelas(opcion) {
    	$('.opcion'+opcion).remove();
    }




    function crearAdmin() {
        $('#crearAdmin').modal('show');
    }

    function verAdmin(id,name,rut,email,status,membresia_nombre,membresia_cant,membresia_monto) {
        $('#ver_pasarelas_pago').empty();
        $('#ver_pasarelas_pago').append('Cargando pasarelas...');
        if (status == 'activo') {
            status='<div class="card-body" style="height:110px !important;"><h3><span class="text-success">Activo</span></h3></div>';
        }else{
            status='<div class="card-body" style="height:110px !important;"><h3><span class="text-danger">Suspendido</span></h3></div>';
        }
        $('#id_admin_v').html(id);
        $('#name_v').html(name);
        $('#rut_v').html(rut);
        $('#email_v').html(email);
        $('#status_v').html(status);
        $("#membresia_v").empty();
        $("#membresia_v").append('<div class="card-body border border-warning"><h3>'+membresia_nombre+'</h3> <span>Cant. Inmuebles: '+membresia_cant+'</span> - <strong>Monto: '+membresia_monto+'$</strong></div>');
        // $('#link_flow_edit').val(link_flow);
        // $('#link_tb_edit').val(link_tb);


        $.get("pasarelas/"+id+"/buscar",function (data) {
        })
        .done(function(data) {
            $('#ver_pasarelas_pago').empty();
            console.log(data.length)
            if (data.length>0) {
                for (var i = 0; i < data.length; i++) {
                    $('#ver_pasarelas_pago').append('<h3>'+data[i].pasarela+' - '+data[i].link_pasarela+'</h3>');
                }
            }else{
                $('#ver_pasarelas_pago').append('<h3>No hay pasarelas de pago</h3>');
            }
        });


        $('#verAdmin').collapse('show');



        $('#btnRegistrar_admin').fadeOut('fast');
        $('#example1_wrapper').fadeOut('fast');
    }
        function EditarAdmin(id,name,rut,email,status,membresia_nombre,membresia_cant,membresia_monto,link_flow, link_tb) {
            $('#editarAdmin').modal('show');

            $('#editarAdmin').modal('show');
            $('#id_admin_e').val(id);
            $('#name_e').val(name);
            $('#rut_e').val(rut.substr(0,(rut.length-2)));
            $('#verificador_e').val(rut.substr(-1,(rut.length)));
            $('#email_e').val(email);
            $('#status_e').val(status);
            $("#membresia_e").empty();
            $("#membresia_e").append('<input id="membresia_actual" class="form-control" value="'+membresia_nombre+' | Cant. Inmuebles: '+membresia_cant+' | Monto: '+membresia_monto+'" disabled="disabled">');
            $('#link_flow_edit').val(link_flow);
            $('#link_tb_edit').val(link_tb);

            $.get("pasarelas/"+id+"/buscar",function (data) {
            })
            .done(function(data) {
                $('#id_pasarela_edit').empty();
                // console.log(data.length);
                if (data.length>0) {
                    for (var i = 0; i < data.length; i++) {
                        $('#id_pasarela_edit').append('<span><strong>'+data[i].pasarela+':</strong> '+data[i].link_pasarela+'</span><br>');
                    }
                }else{
                    $('#id_pasarela_edit').append('<h2>No tiene pasarelas de pago registradas</h2>');
                }
            });
        }

        function CambiarContraseña() {
            if($('#CheckCambiarContraseña').prop('checked')){

                $('#verCambiarContraseña').fadeIn(300);
                $('#contraseñaE').attr('required',true);
                $('#confirmarContraseñaE').attr('required',true);
                
            }else{

                $('#verCambiarContraseña').fadeOut('slow',
                    function() { 
                        $(this).css('display','none');
                });
                $('#contraseñaE').removeAttr('required',false);
                $('#confirmarContraseñaE').removeAttr('required',false);               
            }
        }

        function CambiarPagos() {
            if($('#CheckCambiarPagos').prop('checked')){

                $('#verCambiarPagos').fadeIn(300);
                $('#contraseñaE').attr('required',true);
                $('#confirmarContraseñaE').attr('required',true);
                
            }else{

                $('#verCambiarPagos').fadeOut('slow',
                    function() { 
                        $(this).css('display','none');
                });
                $('#contraseñaE').removeAttr('required',false);
                $('#confirmarContraseñaE').removeAttr('required',false);               
            }
        }

        function CambiarMembresia() {
            if($('#CheckCambiarMembresia').prop('checked')){

                $('#verCambiarMembresia').fadeIn(300);
                $('#contraseñaE').attr('required',true);
                $('#confirmarContraseñaE').attr('required',true);
                
            }else{

                $('#verCambiarMembresia').fadeOut('slow',
                    function() { 
                        $(this).css('display','none');
                });
                $('#contraseñaE').removeAttr('required',false);
                $('#confirmarContraseñaE').removeAttr('required',false);               
            }
        }
        function agregarPasarelas() {
            if($('#CheckagregarPasarelas').prop('checked')){

                $('#pasarelas_pago').fadeIn(300);
                $('#id_pasarela').attr('required',true);
                $('#link_pasarela').attr('required',true);
                
            }else{

                $('#pasarelas_pago').fadeOut('slow',
                    function() { 
                        $(this).css('display','none');
                });
                $('#id_pasarela').removeAttr('required',false);
                $('#link_pasarela').removeAttr('required',false);               
            }
        }
        function EliminarAdmin(id) {
            $('#eliminarAdmin').modal('show');
            $('#id_admin').val(id);
        }

        function notifiNoti(opcion){
        	$('.multi-collapse').collapse('hide');
        	if (opcion==1) {
        		$('#verNotificaciones').collapse('show');
        		$('#vistanotifiNoti1').removeAttr('onclick',false);
        		$('#vistanotifiNoti1').attr('onclick','cerrarVP()');
        	}else if(opcion==2){
        		$('#verNoticias').collapse('show');
        		$('#vistanotifiNoti2').removeAttr('onclick',false);
        		$('#vistanotifiNoti2').attr('onclick','cerrarVP()');
        	}else{
        		$('#verPagosComunes').collapse('show');
        		$('#vistaPagoComun').removeAttr('onclick',false);
        		$('#vistaPagoComun').attr('onclick','cerrarVP()');
        	}
			$('#contenidoPagina').fadeOut('fast');
        }

   //      function buscarNotificaciones(opcion) {
   //  		$.get('buscar/'+opcion+'/notificaciones',function (data) {
		 //    })
		 //    .done(function(data) {
   //      		if (data.length>0) {
   //      			$('#notificacionesShow').append(

   //      			);
   //      		}else{
   //      			$('#notificacionesShow').append('<h3>Sin Notificaciones</h3>');
   //      		}
			// });
   //      }
        function cerrarVP() {
        	$('.multi-collapse').collapse('hide');
        	$('#contenidoPagina').fadeIn(300);
        	$('#vistanotifiNoti1').removeAttr('onclick',false);
        	$('#vistanotifiNoti1').attr('onclick','notifiNoti(1)');
			$('#vistanotifiNoti2').removeAttr('onclick',false);
        	$('#vistanotifiNoti2').attr('onclick','notifiNoti(2)');
        	$('#vistaPagoComun').removeAttr('onclick',false);
        	$('#vistaPagoComun').attr('onclick','notifiNoti(3)');
        }

        function verMesesPagosC() {

        	$('.CargandoMesesPago').show();
        	$('#selectMesesPagosC').val(ms+1);
        	$('#buscarMesesPago').modal('show');
        	verMesesPagosC2(ms+1);
        }

        function verMesesPagosC2(mes) {
        	$('.CargandoMesesPago').show();
        	$('#tablaMostarMeses').empty();
        	$.get("pagoscomunes/"+mes+"/buscarPagoC",function (data) {
		    })
		    .done(function(data) {
		    	if(data.length > 0){
		        	$('#tablaMostarMeses').append(
		        		'<table id="tablaPagosMeses" class="table dataTable data-table-basic table-curved table-striped tabla-estilo" style="width:100%; table-layout: auto;">'+
							'<thead>'+
								'<tr class="bg-info text-white">'+
									'<th>Item</th>'+
									'<th>Id de Inmueble</th>'+
									'<th>Residente</th>'+
									'<th>Mes y Año</th>'+
									'<th>Monto</th>'+
									'<th>Estado de pago</th>'+
								'</tr>'+
							'</thead>'+
							'<tbody id="tablaBodyMesPagoC">'+
								
							'</tbody>'+
		    			'</table>'
		        	);


		        	for (var i = 0; i < data.length; i++) {
		        		if (data[i].status == 'Cancelado') {
			        		$('#tablaBodyMesPagoC').append(
			        			'<tr>'+
			        				'<td>'+data[i].idem+'</td>'+
			        				'<td>'+data[i].id_inmueble+'</td>'+
			        				'<td>'+data[i].nombres+' '+data[i].apellidos+' - <br><strong>'+data[i].rut+'</strong></td>'+
			        				'<td>'+data[i].mes+'</td>'+
			        				'<td>'+data[i].monto+'</td>'+
			        				'<td><span class="text-success">'+data[i].status+'</span></td>'+
			        			'</tr>'
			        		);
		        		}else if(data[i].status == 'Pendiente'){
		        			$('#tablaBodyMesPagoC').append(
			        			'<tr>'+
			        				'<td>'+data[i].idem+'</td>'+
			        				'<td>'+data[i].id_inmueble+'</td>'+
			        				'<td>'+data[i].nombres+' '+data[i].apellidos+' - <br><strong>'+data[i].rut+'</strong></td>'+
			        				'<td>'+data[i].mes+'</td>'+
			        				'<td>'+data[i].monto+'</td>'+
			        				'<td><span class="text-info">'+data[i].status+'</span></td>'+
			        			'</tr>'
			        		);
		        		}
		        	}
			    	if (i == data.length) {
			        	$("#tablaPagosMeses").DataTable({
							"paging": true,
				            "bPaginate": true,
							"pageLength": 50,
							"responsive": true,
				      		"autoWidth": true,
				      		language: {
						        "decimal": "",
						        "emptyTable": "No hay información",
						        "info": "Mostrando la página _PAGE_ de _PAGES_",
						        "infoEmpty": "Mostrando 0 de 0 Entradas",
						        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
						        "infoPostFix": "",
						        "thousands": ",",
						        "lengthMenu": "Mostrar _MENU_ Entradas",
						        "loadingRecords": "Cargando...",
						        "processing": "Procesando...",
						        "search": "",
						        "zeroRecords": "Sin resultados encontrados",
						        "first": "Primero",
						        "last": "Ultimo",
						        "next": "Próximo",
						        "previous": "Anterior",
					        }
						});

			    	}
        			$('.CargandoMesesPago').hide();
		    	}else{
		    		$('#tablaMostarMeses').append('<h3>Sin pagos registrados para este mes</h3>');
		    		$('.CargandoMesesPago').hide();
		    	}
			});	

        }


        function verMesesMultas() {

        	$('.CargandoMesesPagoM').show();
        	$('#selectMesesMulta').val(ms+1);
        	$('#buscarMesesMulta').modal('show');
        	verMesesPagosMultas2(ms+1);
        }

        function verMesesPagosMultas2(mes) {
        	$('.CargandoMesesPagoM').show();
        	$('#tablaMostarMesesM').empty();
        	$.get("pagoscomunes/"+mes+"/buscarMultas",function (data) {
		    })
		    .done(function(data) {
		    	if(data.length > 0){
		    		$('#tablaMostarMesesM').append(
		        		'<table id="tablaPagosMesesM" class="table dataTable data-table-basic table-curved table-striped tabla-estilo" style="width:100%; table-layout: auto;">'+
							'<thead>'+
								'<tr class="bg-info text-white">'+
									'<th>Multa/Recarga</th>'+
									'<th>Residente</th>'+
									'<th>Mes</th>'+
									'<th>Monto</th>'+
									'<th>Estado de pago</th>'+
								'</tr>'+
							'</thead>'+
							'<tbody id="tablaBodyMesMulta">'+
								
							'</tbody>'+
		    			'</table>'
		        	);


		        	for (var i = 0; i < data.length; i++) {
		        		if (data[i].status == 'Pagada') {
			        		$('#tablaBodyMesMulta').append(
			        			'<tr>'+
			        				'<td>'+data[i].motivo+'</td>'+
			        				'<td>'+data[i].nombres+' '+data[i].apellidos+' - <br><strong>'+data[i].rut+'</strong></td>'+
			        				'<td>'+data[i].mes+'</td>'+
			        				'<td>'+data[i].monto+'</td>'+
			        				'<td><span class="text-success">'+data[i].status+'</span></td>'+
			        			'</tr>'
			        		);
		        		}else if(data[i].status == 'Por Confirmar'){
		        			$('#tablaBodyMesMulta').append(
			        			'<tr>'+
			        				'<td>'+data[i].motivo+'</td>'+
			        				'<td>'+data[i].nombres+' '+data[i].apellidos+' - <br><strong>'+data[i].rut+'</strong></td>'+
			        				'<td>'+data[i].mes+'</td>'+
			        				'<td>'+data[i].monto+'</td>'+
			        				'<td><span class="text-info">'+data[i].status+'</span></td>'+
			        			'</tr>'
			        		);
		        		}
		        	}
			    	if (i == data.length) {
			        	$("#tablaPagosMesesM").DataTable({
							"paging": true,
				            "bPaginate": true,
							"pageLength": 50,
							"responsive": true,
				      		"autoWidth": true,
				      		language: {
						        "decimal": "",
						        "emptyTable": "No hay información",
						        "info": "Mostrando la página _PAGE_ de _PAGES_",
						        "infoEmpty": "Mostrando 0 de 0 Entradas",
						        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
						        "infoPostFix": "",
						        "thousands": ",",
						        "lengthMenu": "Mostrar _MENU_ Entradas",
						        "loadingRecords": "Cargando...",
						        "processing": "Procesando...",
						        "search": "",
						        "zeroRecords": "Sin resultados encontrados",
						        "first": "Primero",
						        "last": "Ultimo",
						        "next": "Próximo",
						        "previous": "Anterior",
					        }
						});

			    	}
        			$('.CargandoMesesPagoM').hide();
		    	}else{
		    		$('#tablaMostarMesesM').append('<h3>Sin pagos registrados para este mes</h3>');
		    		$('.CargandoMesesPagoM').hide();
		    	}
			});	

        }
    function filtro_pagos() {
    	
        $('#mrSeleccionado').remove();
        $('#mrSeleccionado2').remove();
        var anio = $('#anio_select').val();
        var mes = $('#mes_select').val();

        if (anio != null && mes != null) {
            $('#CargandoFiltroPagos').show();
            $('#example1_wrapper').empty();

            $.get("pagos/"+anio+"/"+mes+"/filtro",function (data) {
            })
            .done(function(data) {
            
                //console.log(data.length)
                if (data.length > 0) {
                	mes=parseInt(mes);
                	anio=parseInt(anio);
                	var contenido='';
                    for (var i = 0; i < data.length; i++) {
                    	buscar_inmuebles(data[i].id,anio,mes,i);
                    	total_pagar(data[i].id,anio,mes,i);
                    	multas(data[i].id,anio,mes,i);
                    	contenido+='<tr>'+
                                '<td><ul id="mis_inmuebles'+i+'"></ul></td>'+
                                '<td><ul id="id_mis_inmuebles'+i+'"></ul></td>'+
                                '<td>'+data[i].nombres+', '+data[i].apellidos+'</td>'+
                                '<td>'+mostrar_mes(mes)+' '+anio+'</td>'+
                                '<td data-toggle="tooltip" data-placement="top" title="Monto de Gasto Común"><span id="total_pagar'+i+'"></span></td>'+
                                '<td><ul id="status_inmuebles'+i+'"></ul></td>'+
                                // '<td><a href="#" class="btn btn-success btn-sm">Ingresar Pago en Efectivo</a></td>'+
                                '<td><ul id="mis_multas'+i+'"></ul></td>'+
                                '<td><span id="total_multas'+i+'"></span></td>'+
                                '<td><ul id="mis_status_mr'+i+'"></ul></td>'+
                                // '<td><a href="#" class="btn btn-success btn-sm">Ingresar Pago en Efectivo</a></th>'+
                            '</tr>';
                    }
                    	$('#example1_wrapper').append(
                        '<table id="example1" class="table table-bordered table-hover table-striped dataTable display nowrap" cellspacing="0" style="width: 100% !important;">'+
                            '<thead>'+
                                '<tr>'+
                                	'<th>Inmueble</th>'+
                                    '<th>Id de Inmueble</th>'+
                                    '<th>Residente</th>'+
                                    '<th>Mes y Año</th>'+
                                    '<th data-toggle="tooltip" data-placement="top" title="Monto de Gasto Común">Monto</th>'+
                                    '<th>Estado de Pago</th>'+
                                    // '<th></th>'+
                                    '<th>Detalle M/R</th>'+
                                    '<th>Monto M/R</th>'+
                                    '<th>Estado de Pago M/R</th>'+
                                    // '<th></th>'+
                                '</tr>'+
                            '</thead>'+
                            '<tbody>'+contenido+
                            '</tbody>'+
                        '</table>'
                    );

                    //}
                }
                else{
                    $('#example1_wrapper').append(
                        '<table id="example1" class="table table-bordered table-hover table-striped dataTable display nowrap" cellspacing="0" style="width: 100% !important;">'+
                            '<thead>'+
                                 '<tr>'+
                                	'<th>Inmueble</th>'+
                                    '<th>Id de Inmueble</th>'+
                                    '<th>Residente</th>'+
                                    '<th>Mes y Año</th>'+
                                    '<th data-toggle="tooltip" data-placement="top" title="Monto de Gasto Común">Monto</th>'+
                                    '<th>Estado de Pago</th>'+
                                    '<th></th>'+
                                    '<th>Detalle M/R</th>'+
                                    '<th>Monto M/R</th>'+
                                    '<th>Estado de Pago M/R</th>'+
                                    // '<th></th>'+
                                '</tr>'+
                            '</thead>'+
                            '<tbody>'+
                            '</tbody>'+
                        '</table>'
                    );

                }
                $('#CargandoFiltroPagos').hide();
                $(".dataTable").DataTable({
                    "paging": true,
                    "bPaginate": true,
                    "pageLength": 50,
                    "responsive": true,
                    "autoWidth": true,
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando la página _PAGE_ de _PAGES_",
                        "infoEmpty": "Mostrando 0 de 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Entradas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "",
                        "zeroRecords": "Sin resultados encontrados",
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Próximo",
                        "previous": "Anterior",
                    }
                });
            }); 
        }
    }
    function buscar_inmuebles(id_residente,anio,mes,numero){
        		
        	$.get('arriendos/'+id_residente+'/'+anio+'/'+mes+'/mostrar_inmuebles',function(data){
        		//console.log(data.length);
        		$('#mis_inmuebles').empty();
        		$('#status_inmuebles').empty();
        		if(data.length>0){
        			for (var i = 0; i < data.length; i++) {
        				$('#id_mis_inmuebles'+numero).append('<li>'+data[i].id_inmueble+'</li>');
        				$('#mis_inmuebles'+numero).append('<li>'+data[i].idem+'</li>');
        				$('#status_inmuebles'+numero).append('<li>'+data[i].pago_status+'</li>');
        			}
        		
        		}else{
        			$('#id_mis_inmuebles'+numero).append('Debe registrar pagos');
        			$('#mis_inmuebles'+numero).append('Debe registrar pagos');
        			$('#status_inmuebles'+numero).append('<span style="color:red">Con Deuda</span>');
        		}
        	});
        		
    }
    function total_pagar(id_residente,anio,mes,numero){
        		
        	$.get('arriendos/'+id_residente+'/'+anio+'/'+mes+'/total_pagar',function(data){
        		//console.log(data);
        		if(data.length>0){
        			$('#total_pagar'+numero).text(data+'$');
        		}
        	});
        		
    }

    function multas(id_residente,anio,mes,numero){
        		
        	$.get('arriendos/'+id_residente+'/'+anio+'/'+mes+'/buscar_mr2',function(data){
        		//console.log(data);
        		
        		$('#mis_multas').empty();
        		var total=0;
        		var motivo='';
        		var monto=0;
        		// alert(data.length);
        		if(data.length > 0){
        			for (var i = 0; i < data.length; i++) {
        				motivo=data[i].motivo.substring(0, 30);
        				$('#mis_multas'+numero).append('<li>'+motivo+'</li>');
        				$('#mis_status_mr'+numero).append('<li>'+data[i].status+'</li>');
        				monto+=parseFloat(data[i].monto);
        			}
        			$('#total_multas'+numero).text(monto);
        		}else{
        			$('#mis_multas'+numero).append('Sin Multas/Recargas');
        			$('#mis_status_mr'+numero).append('-');
					$('#total_multas'+numero).text('-');
        		}
        	});       		
    }
</script>
<!-- Plugin js-->
<script src="{{ asset('assets/libs/parsleyjs/parsley.min.js') }}"></script>
<!-- Validation init js-->
<script src="{{ asset('assets/js/form-validation.init.js') }}"></script>
@yield('scripts')