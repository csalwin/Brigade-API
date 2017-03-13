@extends('layouts.login')

@section('content')
    <div class="login-form">
        <div class="login-content">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <div class="form-forgotpassword-success">
                    <i class="entypo-check"></i>
                    <h3>Reset email has been sent.</h3>
                    <p>Please check your email, reset password link will expire in 24 hours.</p>
                </div>
                <div class="form-steps">
                    <div class="step current" id="step-1">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="entypo-mail"></i>
                                </div>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" data-mask="email" autocomplete="off" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-login">
                                Send Password Reset Link
                                <i class="entypo-right-open-mini"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
