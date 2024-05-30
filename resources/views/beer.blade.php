@extends('layouts.main')

@section('body')
<div class="container py-5">
    <div class="container">
        <h1> Welcome, {{ Auth::user()->name }}</h1>
    </div>
    <div class="d-flex justify-content-around">
        <a href="{{ route('dashboard') }}">
            <button class="btn btn-primary btn-custom-primary btn-custom">{{ 'Dashboard' }}</button>
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button name="submit" type="submit" class="btn btn-danger">{{ 'Logout' }}</button>
        </form>
    </div>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Type</th>
                <th>City</th>
                <th>Address</th>
                <th>Phone</th>
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