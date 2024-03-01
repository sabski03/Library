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
                            Authors
                            <a href="{{ url('author/create') }}" class="btn btn-primary float-end">Add Author</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Last Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($author as $authors)
                                <tr>
                                    <td>{{ $authors->id }}</td>
                                    <td>{{ $authors->name }}</td>
                                    <td>{{ $authors->last_name }}</td>
                                    <td>
                                        <a href="{{ url('author/edit/' . $authors->id ) }}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ url('delete-author/' . $authors->id) }}" method="POST">
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
                            {{ $author->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
