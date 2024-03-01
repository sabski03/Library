@extends('layouts.frontend')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Dashboard</h1>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-6 mb-5 mt-5">
                <a href="{{ url('author') }}" class="btn btn-lg btn-dark btn-block w-75 h-100">
                    <h2>Authors</h2>
                    <p>Total: {{ $author }}</p>
                </a>
            </div>
            <div class="col-md-6 mb-5 mt-5">
                <a href="{{ url('published_book') }}" class="btn btn-lg btn-success btn-block w-75 h-100">
                    <h2>Books</h2>
                    <p>Total: {{ $availableBooks }}</p>
                </a>
            </div>
            <div class="col-md-6 mt-5">
                <a href="{{ url('published_book') }}" class="btn btn-lg btn-danger btn-block w-75 h-100">
                    <h2>Books</h2>
                    <p>Total: {{ $busyBooks }}</p>
                </a>
            </div>
            <div class="col-md-6 mt-5">
                <a href="{{ url('users') }}" class="btn btn-lg btn-primary btn-block w-75 h-100">
                    <h2>Users</h2>
                    <p>Total: {{ $user }}</p>
                </a>
            </div>
        </div>
    </div>
@endsection


