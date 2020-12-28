<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <!------ Include the above in your HEAD tag ---------->
    <title>Controlnice | {{ __('Login') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}">
    <link rel="stylesheet" href="css/style.css">
    <!-- meta tags -->
    <link href="{{ asset('assets/css/login.min.css') }}" rel="stylesheet" type="text/css" style="border-radius: 30px;" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
@include('layouts.css')

<style type="text/css">
    .imagenLogin{
        border-radius: 50%;
        height:500px;
        width: 500px;
        margin-top: -100px;
        margin-left: -100px;
    }

    @media only screen and (max-width: 800px)  {
        .imagenLogin{
            margin-left: 0px;
        }
        .form-login{
            margin-top: 30px;
        }

    }

    @media only screen and (max-width: 1000px)  {
        .imagenLogin{
            margin-top: -30px;
            height:350px;
            width: 350px;
            /*margin-left: -150px;*/
        }
        .footer{
            height: 10px;
            /*display: none;*/
        }
    }

    @media only screen and (max-width: 780px)  {
        .imagenLogin{
            /*border: 1px solid #f6f6f7!important;*/
            /*display: none;*/
        }
    }

</style>
<body>

    <!-- content -->

    <div class="container-fluid">
        <div class="content row">

            <div class="limiter">
                <div class="container-login100">
                    <div class="">
                        <div class="row justify-content-center">
                            <div class="col-md-6 mt-4">
                                <div class="mt-4">
                                    <center>
                                        <img src="{{ asset('assets/images/logo.jpg') }}" alt="IMG" class="imagenLogin">
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border shadow" style="border-radius: 10px">
                                    <div class="card-body">
                                        <form class="form-login" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <span class="login100-form-title">
                                                {{ __('Login') }}
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
                                </div>                                
                            </div>
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
</body>
</html>
