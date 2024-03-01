@extends('layouts.frontend')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Edit User Data - {{ $user->id }}
                            <a href="{{ url('users') }}" class="btn btn-danger float-end">Cancel</a>
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
                        <form action="{{ url('update-users/'.$user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                            </div>
                            <div class="form-group mb-4">
                                <label for="">Last Name</label>
                                <input type="text" name="lastName" value="{{ $user->last_name }}" class="form-control">
                            </div>
                            <div class="form-group mb-4">
                                <label for="">Email</label>
                                <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                            </div>
                            <div class="form-group mb-4">
                                <label for="">Phone</label>
                                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="role">Role</label>
                                <select name="role" class="form-control">
                                    <option value="2" {{ $user->role_id === 2 ? 'selected' : '' }}>Admin</option>
                                    <option value="3" {{ $user->role_id === 3 ? 'selected' : '' }}>Editor</option>
                                    <option value="1" {{ $user->role_id === 1 ? 'selected' : '' }}>User</option>
                                </select>
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
