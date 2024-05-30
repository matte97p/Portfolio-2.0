@extends('layouts.main')

@section('body')
<div class="container py-5">
    <div class="container">
        <h1> {{ __('dashboard.welcome') }}, {{ Auth::user()->username }}</h1>
    </div>
    <div class="d-flex justify-content-around">
        <a href="{{ route('beer.breweries') }}">
            <button class="btn btn-primary btn-custom-primary btn-custom">{{ __('main.menus.breweries') }}</button>
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button name="submit" type="submit" class="btn btn-danger">{{ __('auth.logout') }}</button>
        </form>
    </div>
</div>
@endsection