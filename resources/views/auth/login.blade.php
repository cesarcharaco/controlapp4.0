<link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}">
<link href="{{ asset('assets/css/login.min.css') }}" rel="stylesheet" type="text/css" style="border-radius: 30px;" />
@include('layouts.css')

<body>
    <!-- content -->

    <div class="container-fluid">
        <div class="content row">

            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100 border shadow">
                        <div class="" data-tilt>
                            <img width="400" height="400" src="{{ asset('assets/images/logo.jpg') }}" alt="IMG">
                        </div>
                        <!-- <div class="logo-mobile">
                            <img src="{{ asset('assets/images/logo.jpg') }}" style="height: 280px;" alt="IMG" class="logo-mobile">
                        </div> -->

                        <div class="card shadow">
                            <center>
                                
                            
                                <div class="card-body">
                                    <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <span class="login100-form-title" style="font-family: Arial, Helvetica, sans-serif;">
                                            <strong class="text-primary">{{ __('Login') }}</strong>
                                        </span>
                                        @include('flash::message')
                                        @if(count($errors))
                                        <div class="alert alert-danger" role="alert">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                <li>
                                                    {{$error}}
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                                            <input id="email" type="text" class="input100 @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="{{ __('E-Mail Address') }}">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="alert" style="background-color: #e4eeee;" role="alert" style="border-radius: 30px;">
                                            <strong style="font-family: italic;">La contraseña debe tener al menos 9 carácteres.</strong>
                                        </div>
                                        <div class="wrap-input100 validate-input" data-validate = "Password is required">
                                            <input id="password" type="password" class="input100 @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="fa fa-lock" aria-hidden="true"></i>
                                            </span>
                                        </div>

                                        <div class="container-login100-form-btn">
                                            <button class="login100-form-btn btn-success" type="submit">
                                                {{ __('Login') }}
                                            </button>
                                        </div>

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
                                    </form>
                                </div>
                            </center>
                        </div>
                    </div>
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
</html>
