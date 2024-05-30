@extends('layouts.main')

@section('body')
<div class="container py-5">
    <div class="w-50 center border rounded px-3 py-3 mx-auto">
        <h1>{{ __('auth.login') }}</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">{{ __('auth.username') }}</label>
                <input type="username" id="username" name="username" value="{{ old('username') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('auth.password') }}</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3 d-grid">
                <button name="submit" type="submit" class="btn btn-primary">{{ __('auth.login') }}</button>
            </div>
        </form>
        <a href="{{ route('register') }}" class="align-items-center justify-content-between">
            <span>{{ __('auth.notReg') }}</span>
        </a>
        @if ($errors->any())
            @foreach( $errors->all() as $message )
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>{{ $message }}</span>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection