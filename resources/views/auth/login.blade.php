@extends('main')

@section('content')
<div class="log-form">
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <h2 class="text-center">@lang('auth.login')</h2>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-at"></i>
                    </span>
                </div>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('auth.email')" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="@lang('auth.password')" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        @if(session('message'))
            <div class="alert alert-info">
                {{session('message')}}
            </div>
        @endif
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">@lang('auth.login')</button>
        </div>

        <div class="clearfix">
            <span class="pull-left checkbox-inline">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    @lang('auth.remember_me')
                </label>
            </span>

            @if (Route::has('password.request'))
                <a class="btn btn-link pull-right" href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                </a>
            @endif
        </div>
    </form>
    <div class="text-center small">@lang('auth.!has_account') <a href="{{ route('register') }}">@lang('auth.reg_here')</a></div>
</div>
@endsection
