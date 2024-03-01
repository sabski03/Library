
@extends('layouts.frontend')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Edit Author - {{ $author->id }}
                            <a href="{{ url('author') }}" class="btn btn-danger float-end">Cancel</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ url('/update-author/' . $author->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $author->name }}" class="form-control">
                            </div>
                            <div class="form-group mb-4">
                                <label for="">Last Name</label>
                                <input type="text" name="lastName" value="{{ $author->last_name }}" class="form-control">
                            </div>

                            <div class="form-group mb-3 text-center">
                                <button type="Submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
