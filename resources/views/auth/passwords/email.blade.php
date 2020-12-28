<link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}">
<link href="{{ asset('assets/css/login.min.css') }}" rel="stylesheet" type="text/css" style="border-radius: 30px;" />
@include('layouts.css')
<body>

    <!-- content -->

    <div class="container-fluid">
        <div class="content row">

            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100">
                        <div class="login100-pic js-tilt" data-tilt>
                            <img src="{{ asset('assets/images/logo.jpg') }}" alt="IMG">
                        </div>
                        <div class="logo-mobile">
                            <img src="{{ asset('assets/images/logo.jpg') }}" style="height: 280px;" alt="IMG" class="logo-mobile">
                        </div>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <span class="login100-form-title">
                                {{ __('Reset Password') }}
                            </span>
                            <div class="row">
                                <div class="col-md-12">
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
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <center>
                                        <div class="form-group">
                                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                    </center>
                                </div>
                            </div>

                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary" style="width: 100%">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                            <a href="{{ route('login')}}">Regresar</a>
                        </form>
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
