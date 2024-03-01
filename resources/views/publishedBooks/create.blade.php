@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>
                            Publish A New Book
                            <a href="{{ url('published_book') }}" class="btn btn-danger float-end">Cancel</a>
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
                        <form action="{{ url('published_books') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" name="title" placeholder="Book Title" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Book Release Date</label>
                                <input type="date" name="releaseDate" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="available">Available</option>
                                    <option value="busy">Busy</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="authors">Authors</label>
                                <select name="author_ids[]" id="authors" class="form-control" multiple>
                                    <option value="none" selected>- None</option>
                                    @foreach($author as $authors)
                                        <option value="{{ $authors->id }}">{{ $authors->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <h5 class="text-center">Create A New Author</h5>
                            <div class="form-group mb-3">
                                <div class="new-author-fields">
                                    <div class="new-author">
                                        <input type="text" name="new_authors[0][name]" placeholder="Name" class="form-control mb-2">
                                        <input type="text" name="new_authors[0][last_name]" placeholder="Last Name" class="form-control mb-2">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary add-author">Add Another Author</button>
                            </div>
                            <div class="form-group mb-4 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var authorIndex = 1;
            $('.add-author').click(function() {
                var newAuthorField = $('.new-author').first().clone();
                newAuthorField.find('input').val('');
                newAuthorField.find('input').each(function() {
                    var name = $(this).attr('name');
                    $(this).attr('name', name.replace(/\[\d\]/, '[' + authorIndex + ']'));
                });
                $('.new-author-fields').append(newAuthorField);
                authorIndex++;
            });
        });

    </script>
@endsection
