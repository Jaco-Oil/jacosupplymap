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
                    <form method="POST" action="{{ route('password.reset') }}">
                    @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                    <h4 class="nomargin">{{ __('auth.reset_password') }}</h4>

                        <p class="mt20">{{ __('auth.email_address) }}</p>
                    <input id="email" type="email" class="form-control uname " name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror


                        <p class="mt20">{{ __('auth.password') }}</p>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <p class="mt20">{{ __('auth.confirm_password') }}</p>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                    <button class="btn btn-success btn-block" type="submit">{{ __('auth.reset_password') }}</button>

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
