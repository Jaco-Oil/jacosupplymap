@extends('layouts.auth')

@section('content')

    <div class="signinpanel">

        <div class="row">

            <div class="col-md-7">

                <div class="signin-info">
                    <div class="logopanel">
                        <h1>{{ __('admin.sitename') }}</h1>
                        <h4>{{ __('admin.admin_area') }}</h4>
                    </div><!-- logopanel -->

                    <div class="mb20"></div>

                </div><!-- signin0-info -->

            </div><!-- col-sm-7 -->

            <div class="col-md-5">

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h4 class="nomargin">{{ __('auth.login') }}</h4>
                    <p class="mt5 mb20">{{ __('auth.enter_login_and_password') }}</p>

                    <input id="email" type="email" class="form-control uname " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                    <input id="password" type="password" class="form-control pword @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('auth.password') }}">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            <small>{{ __('auth.forgot_password') }}</small>
                        </a>
                    @endif

                    <button class="btn btn-success btn-block">{{ __('auth.login') }}</button>

                </form>
            </div><!-- col-sm-5 -->

        </div><!-- row -->

        <div class="signup-footer">
            <div class="pull-left">
                &copy; <?php echo date("Y")?>. {{ __('admin.sitename') }}
            </div>
        </div>

    </div><!-- signin -->
@endsection
