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
                        <form class="login100-form validate-form" method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group ">
                                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="input100" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
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
