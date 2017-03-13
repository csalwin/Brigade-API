@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="login-form">
            <div class="login-content">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="entypo-mail"></i>
                                </div>

                                <input type="text" class="form-control" name="email" id="email" data-mask="email" placeholder="E-mail" autocomplete="off" value="{{ $email or old('email') }}" required autofocus />
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="entypo-lock"></i>
                                </div>

                                <input type="password" class="form-control" name="password" id="password" placeholder="Choose Password" autocomplete="off" required />
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="entypo-lock"></i>
                                </div>

                                <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-login">
                                <i class="entypo-right-open-mini"></i>
                                Reset Password
                            </button>
                        </div>
                    </form>
            </div>
    </div>
</div>
@endsection
