@extends('main')

@section('content')
    <div class="log-form">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <h2 class="text-center">@lang('auth.register')</h2>
            <p class="small">@lang('auth.reg_fill')</p>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    </div>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="@lang('auth.username')" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
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
                        <i class="fas fa-at"></i>
                    </span>
                    </div>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('auth.email')" value="{{ old('email') }}" required autocomplete="email">
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
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="@lang('auth.password')" required autocomplete="new-password">
                    @error('password')
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
                        <i class="fas fa-check"></i>
                        <i class="fas fa-lock"></i>
                    </span>
                    </div>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('auth.conf_password')" required autocomplete="new-password">
                </div>
            </div>
            @if(session('message'))
                <div class="alert alert-info">
                    {{session('message')}}
                </div>
            @endif
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">@lang('auth.register')</button>
            </div>

        </form>
        <div class="text-center small">@lang('auth.has_account') <a href="{{ route('login') }}">@lang('auth.log_here')</a></div>
    </div>
@endsection
