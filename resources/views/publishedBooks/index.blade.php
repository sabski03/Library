@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if(session('delete'))
                    <div class="alert alert-danger">
                        {{ session('delete') }}
                    </div>
                @endif
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>
                            Published Books
                            <a href="{{ url('publish/create') }}" class="btn btn-primary float-end">Publish A Book</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Release Date</th>
                                <th>Status</th>
                                <th>Author Name & Last Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($book as $books)
                                <tr>
                                    <td>{{ $books->id }}</td>
                                    <td>{{ $books->title }}</td>
                                    <td>{{ $books->release_date }}</td>
                                    <td>
                                        @if($books->status === 'available')
                                            <span style="color: green;">{{ $books->status }}</span>
                                        @elseif($books->status === 'busy')
                                            <span style="color: red;">{{ $books->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach($books->authors as $author)
                                            <span>{{ $author->name }} {{$author->last_name}}, </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ url('published_book/edit/'. $books->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ url('delete_published_book/'. $books->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $book->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
