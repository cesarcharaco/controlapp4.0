<link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}">
<link href="{{ asset('assets/css/login.min.css') }}" rel="stylesheet" type="text/css" style="border-radius: 30px;" />
@include('layouts.css')
<style type="text/css">
    .container-login100{
        background-color: #E8F6F3 !important;
    }
</style>
<body>
    <!-- content -->

    <div class="container-fluid">
        <div class="content row">

            <div class="limiter">
                <div class="container-login100">
                    <!-- <div class="wrap-login100"> -->

                            <!-- <div class="login100-pic js-tilt" data-tilt >
                                <img src="{{ asset('assets/images/logo.jpg') }}" class="border shadow" alt="IMG" style="border-radius: 50%; margin-left: -50px;" width="350" height="350">
                            </div>
                            <div class="logo-mobile">
                                <img src="{{ asset('assets/images/logo.jpg') }}" style="height: 280px;" alt="IMG" class="logo-mobile">
                            </div> -->
                        <div class="card shadow">
                            <center>
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="{{ asset('assets/images/logo.jpg') }}" width="70" height="70" alt="IMG" style="border-radius: 50% !important;" class="">
                                        </div>
                                        <div class="col-9">
                                            <h2 style="font-family: Arial, Helvetica, sans-serif; ">
                                                <strong class="text-primary">{{ __('Login') }}</strong>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <form class="validate-form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="card-body">
                                        @include('flash::message')
                                        @if(count($errors))
                                            <div class="alert alert-danger shadow" role="alert">
                                                <ul>
                                                    @foreach($errors->all() as $error)
                                                    <li>
                                                        {{$error}}
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                            
                                            <div class="alert" style="background-color: #e4eeee;" role="alert" style="border-radius: 30px;">
                                                <strong style="font-family: italic;">La contraseña debe tener al menos 9 carácteres.</strong>
                                            </div>
                                            <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                                                <input id="email" type="text" class="input100 @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                                placeholder="{{ __('E-Mail Address') }}">
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <div class="wrap-input100 validate-input" data-validate = "Password is required">
                                                <input id="password" type="password" class="input100 @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                                </span>
                                            </div>

                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="container-login100-form-btn">
                                                    <button class="login100-form-btn btn-success shadow" type="submit" onclick="loginCargando()">
                                                        <div id="textLogin">
                                                            {{ __('Login') }}
                                                        </div>
                                                        <div class="cargandoLogin" style="display: none;">
                                                            <div class="spinner-border text-white m-2" role="status" id="cargando_E">
                                                                <span class="sr-only">Cargando <span class="titleModal"></span>...</span>
                                                            </div>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center p-t-12">
                                                    <span class="txt1">
                                                        <!-- Forgot -->
                                                    </span>
                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                            {{ __('Forgot Your Password?') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </center>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    ControlApp <label class="badge badge-soft-danger">v1.0.1.</label> Un proyecto desarrollado por <a href="https://eiche.cl/" target="_blank" id="eiche">EICHE</a>.
                </div>
            </div>
        </div>
    </footer>
    @include('layouts.scripts')
</body>

<script type="text/javascript">
    function loginCargando() {
        $('#textLogin').hide();
        $('.cargandoLogin').fadeIn('fast');
    }
</script>
</html>
