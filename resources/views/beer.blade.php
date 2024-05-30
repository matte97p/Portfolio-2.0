@extends('layouts.main')

@section('body')
<div class="container py-5">
    <div class="container">
        <h1> {{ __('main.welcome') }}, {{ Auth::user()->name }}</h1>
    </div>
    <div class="d-flex justify-content-around">
        <a href="{{ route('dashboard') }}">
            <button class="btn btn-primary btn-custom-primary btn-custom">{{ __('main.menus.dashboard') }}</button>
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button name="submit" type="submit" class="btn btn-danger">{{ __('auth.logout') }}</button>
        </form>
    </div>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>{{ __('beer.id') }}</th>
                <th>{{ __('beer.name') }}</th>
                <th>{{ __('beer.type') }}</th>
                <th>{{ __('beer.city') }}</th>
                <th>{{ __('beer.address') }}</th>
                <th>{{ __('beer.phone') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->brewery_type }}</td>
                <td>{{ $row->city }}</td>
                <td>{{ $row->address_1 }}</td>
                <td>{{ $row->phone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection