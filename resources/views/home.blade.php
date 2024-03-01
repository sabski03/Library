@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Books and Authors</h1>
                <hr>
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if(session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif
                <div class="card">
                    <form action="{{ url('/searchData') }}" method="GET">
                        @csrf
                        <center>
                            <input type="text" name="search" class="mt-3" placeholder="Search For Authors Or Books">
                            <button type="submit" class="btn btn-sm btn-primary">Search</button>
                        </center>
                    </form>
                    <div class="card-body">
                        @foreach ($books as $book)
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">{{ $book->title }}
                                        <div class="text-end">
                                            @if ($book->status === 'available')
                                                <span class="badge bg-success">Available</span>
                                            @else
                                                <span class="badge bg-danger">Taken</span>
                                            @endif
                                        </div>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <b class="card-text">Release Date:</b> {{ $book->release_date }}
                                    <br>
                                    <b class="card-text">Authors:</b>
                                        @foreach ($book->authors as $author)
                                            {{ $author->name }} {{ $author->last_name }},
                                        @endforeach
                                    <form action="{{ url('/booksStatus/'. $book->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        @if(auth()->check() && (auth()->user()->role_id === 2 || auth()->user()->role_id === 3))
                                            <button type="submit" class="btn btn-primary mt-3">Change Status</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        {{ $books->appends(['search' => request()->input('search')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection











