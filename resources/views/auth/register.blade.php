@extends('layouts.main')

@section('body')
<div class="container py-5">
    <div class="w-50 center border rounded px-3 py-3 mx-auto">
        <h1>{{ __('auth.register') }}</h1>
        <form action="{{ route('user.create') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">{{ __('auth.username') }}</label>
                <input type="username" value="" name="username" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>
                @if ($errors->has('username'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('auth.email') }}</label>
                <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('auth.password') }}</label>
                <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">{{ __('auth.confPassword') }}</label>
                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control{{ $errors->has('confirmPassword') ? ' is-invalid' : '' }}" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            @if(session()->has('alert'))
                <p>{{ session('alert') }}</p>
            @endif
            @include('layouts.partials.recaptcha')
            <div class="mb-3 d-grid">
                <button name="submit" type="submit" class="btn btn-primary">{{ __('auth.register') }}</button>
            </div>
        </form>
        <a href="{{ route('login') }}" class="align-items-center justify-content-between">
            <span>{{ __('auth.alreadyReg') }}</span>
        </a>
    </div>
</div>
@endsection