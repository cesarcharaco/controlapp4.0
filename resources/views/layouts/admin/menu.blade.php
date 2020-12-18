<!-- ========== Left Sidebar Start ========== -->
<div id="left-side-menu">
    <div class="left-side-menu">
        <div class="media user-profile mt-2 mb-2">
            <img src="{{ asset('assets/images/logo.jpg') }}" class="avatar-sm rounded-circle mr-2" alt="Shreyu">

            <div class="media-body">
                <h6 class="pro-user-name mt-0 mb-0">{{ \Auth::user()->name }}</h6>
                <span class="pro-user-desc">{{ \Auth::user()->tipo_usuario }}</span>
            </div>
            <div class="dropdown align-self-center profile-dropdown-menu">
                <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </a>
                <div class="dropdown-menu profile-dropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a href="#" class="dropdown-item notify-item" data-toggle="modal" data-target="#Profile">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user icon-dual icon-xs mr-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span class="text-success">Mi perfil</span>
                    </a>

                    
                    <div class="dropdown-divider"></div>

                    <a href="javascript:void(0);" class="dropdown-item notify-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out icon-dual icon-xs mr-2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span class="text-danger">Salir</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="sidebar-content">
            <!--- Sidemenu -->
            <div id="sidebar-menu" class="slimscroll-menu">
                <ul class="metismenu" id="menu-bar">

                    <li class="menu-title">Funciones</li>

                    <li>
                            <a href="javascript: void(0);" aria-expanded="false">
                                <i data-feather="share"></i>
                            <span> Vista Principal </span>
                                <span class="menu-arrow"></span>
                            </a>

                            <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                <li>
                                    <a href="#" id="vistanotifiNoti1" onclick="notifiNoti(1)">
                                        <span> Notificaciones </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="vistanotifiNoti2" onclick="notifiNoti(2)">
                                        <span> Noticias </span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    @if(\Auth::user()->tipo_usuario != 'Admin' && \Auth::user()->tipo_usuario != 'root')
                        <!-- <li>
                            <a href="{{ url('multas_recargas')}}">
                                <i data-feather="dollar-sign"></i>
                                <span> Multas y recargas </span>
                            </a>
                        </li> -->
                        <li>
                            <a href="{{ url('estados_pagos') }}" aria-expanded="false">
                                <i data-feather="credit-card"></i>
                                <span> Ver Estados de Pago </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('pagos') }}" aria-expanded="false">
                                <i data-feather="dollar-sign"></i>
                                <span> Pagar </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">
                                <i data-feather="clock"></i>
                                <span> Arriendo de Instalación Interna </span>
                                <span class="menu-arrow"></span>
                            </a>

                            <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                <li>
                                    <a href="{{ url('alquiler') }}">Ver mi Agenda</a>
                                </li>
                                <li>
                                    <a href="{{ url('instalaciones')}}">Alquilar una instalación</a>
                                </li>
                            </ul>
                        </li>

                        <!-- <li>
                            <a href="{{ url('instalaciones') }}">
                                <i data-feather="home"></i>
                                <span> Instalaciones </span>
                            </a>
                        </li> -->
                    @endif


                    @if(\Auth::user()->tipo_usuario == 'Admin')
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">
                                <i data-feather="database"></i>
                                <span> Base de Datos </span>
                                <span class="menu-arrow"></span>
                            </a>

                            <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                <li>
                                    <a href="{{ url('inmuebles') }}">
                                        <span> Crear o Editar Inmuebles </span>
                                    </a>
                                </li>
                            
                                <li>
                                    <a href="{{ url('residentes') }}">
                                        <span> Crear o Editar Residentes </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('arriendos') }}">
                                        <span> Asignación de Res/Inm </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" id="vistaPagoComun" onclick="notifiNoti(3)">
                                        <span> Valor de Gastos Comunes </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ url('estacionamientos') }}">
                                        <span> Estacionamientos </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('multas_recargas')}}">
                                        <span> Crear o Editar Multas/Recargas </span>
                                    </a>
                                </li>
                                <!-- <li>
                                    <a class="dropdown-item" onclick="asignar_mr()" data-toggle="modal" data-target="#AsignarMR">
                                        <span> Asignar M/R </span>
                                    </a>
                                </li> -->

                                <li>
                                    <a href="{{ url('instalaciones') }}">
                                        <span> Crear o Editar Instalaciones </span>
                                    </a>
                                </li>


                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">
                                <i data-feather="dollar-sign"></i>
                                <span> Pagos </span>
                                <span class="menu-arrow"></span>
                            </a>

                            <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                <li>
                                    <a href="{{ url('pagos') }}">Pagos de Condominio</a>
                                </li>
                                <li>
                                    <a href="{{ url('pagos_multas')}}">Multas/Recargas</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('estados_pagos') }}" aria-expanded="false">
                                <i data-feather="credit-card"></i>
                                <span> Ver Estados de Pago </span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">
                                <i data-feather="book-open"></i>
                                <span> Reportes </span>
                                <span class="menu-arrow"></span>
                            </a>

                            <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                <li>
                                    <a href="{{ url('reportes')}}">
                                        <span> Gasto Común </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('reportes_multas')}}">
                                        <span> Multas </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('alquiler') }}">
                                <i data-feather="columns"></i>
                                <span> Arriendo de Inst. </span>
                            </a>
                        </li>
                    @endif

                    

                    @if(\Auth::user()->tipo_usuario != 'root')
                        @if(\Auth::user()->tipo_usuario != 'Residente' && \Auth::user()->tipo_usuario != 'Admin')
                            <li>
                                <a href="javascript: void(0);" aria-expanded="false">
                                    <i data-feather="credit-card"></i>
                                    <span> Pagos </span>
                                    <span class="menu-arrow"></span>
                                </a>

                                <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('pagos') }}">Gasto común</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('pagos_multas')}}">Multas</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                       <!--  @if(\Auth::user()->tipo_usuario == 'Residente')
                            <li>
                                <a href="{{ url('consultas') }}">
                                    <i data-feather="credit-card"></i>
                                    <span> Consultas </span>
                                </a>
                            </li>
                        @endif -->

                        
                        <!-- @if(\Auth::user()->tipo_usuario != 'root' && \Auth::user()->tipo_usuario != 'Admin')
                            <li>
                                <a href="{{ url('reportes')}}">
                                    <i data-feather="book-open"></i>
                                        <span> Reportes </span>
                                </a>
                            </li>
                        @endif -->
                    @endif



                        @if(\Auth::user()->tipo_usuario == 'Admin')
                            <li>
                                <a href="{{ url('contabilidad') }}">
                                    <i data-feather="activity"></i>
                                    <span> Balance General </span>
                                </a>
                            </li>
                        @endif

                        @if(\Auth::user()->tipo_usuario == 'root')
                            <li>
                                <a href="{{ url('membresias') }}">
                                    <i data-feather="clock"></i>
                                    <span> Membresías </span>
                                </a>
                            </li>
                        @endif

                    @if(\Auth::user()->tipo_usuario == 'root')
                        <li>
                            <a href="{{ url('anuncios') }}">
                                <i data-feather="columns"></i>
                                <span> Publicidad </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('planes_pago') }}">
                                <i data-feather="dollar-sign"></i>
                                <span> Planes de Pago </span>
                            </a>
                        </li>
                        <!-- <li>
                                <a href="javascript: void(0);" aria-expanded="false">
                                    <i data-feather="columns"></i>
                                    <span> Publicidad </span>
                                    <span class="menu-arrow"></span>
                                </a>

                                <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('anuncios') }}">Anuncios</a>
                                    </li>
                                    <li>
                                        <a href="#">Empresas</a>
                                    </li>
                                    <li>
                                        <a href="#">Control de pagos</a>
                                    </li>
                                </ul>
                            </li> -->
                        <li class="menu-title">Configuración </li>

                    
                        <li>
                            <a href="{{'administradores'}}">
                                <i data-feather="users"></i>
                                <span> Admins </span>
                            </a>
                        </li>
                    @endif
                        @if(\Auth::user()->tipo_usuario == 'Residente')
                            <div class="footer1">
                                <li class="menu-title">
                                     <div style="background-color: white;font-size: 9px; margin-top: 110px; position: relative;">
                                        ControlApp
                                        <label class="badge badge-soft-danger">v1.0.1.</label>
                                        <br>Un proyecto desarrollado por 
                                        <div class="text-primary" style=""><strong>EICHE</strong></div>.
                                    </div>
                                </li>
                            </div>
                        @elseif(\Auth::user()->tipo_usuario == 'root')
                            <div class="footer2">
                                <li class="menu-title">
                                     <div style="background-color: white;font-size: 9px; margin-top: 157px;">
                                        ControlApp
                                        <label class="badge badge-soft-danger">v1.0.1.</label>
                                        <br>Un proyecto desarrollado por 
                                        <div class="text-primary" style=""><strong>EICHE</strong></div>.
                                    </div>
                                </li>
                            </div>
                        @else
                            <div class="footer3">
                                <li class="menu-title">
                                     <div style="background-color: white;font-size: 9px;">
                                        ControlApp
                                        <label class="badge badge-soft-danger">v1.0.1.</label>
                                        <br>Un proyecto desarrollado por 
                                        <div class="text-primary" style=""><strong>EICHE</strong></div>.
                                    </div>
                                </li>
                            </div>
                        @endif
                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>
        </div>
    <!-- Sidebar -left -->
    </div>
</div>


<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->


