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
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <h4 class="nomargin">{{ __('auth.remind_password') }}</h4>
                    <p class="mt5 mb20">{{ __('auth.email_address') }}</p>

                    <input id="email" type="email" class="form-control uname " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                    <button class="btn btn-success btn-block">{{ __('auth.remind_password') }}</button>

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
