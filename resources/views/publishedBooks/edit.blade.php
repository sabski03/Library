
@extends('layouts.frontend')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Edit Published Book - {{ $book->id }}
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
                        <form action="{{ url('/update_published_book/'. $book->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4">
                                <label for="">Title</label>
                                <input type="text" name="title" value="{{ $book->title }}" class="form-control">
                            </div>
                            <div class="form-group mb-4">
                                <label for="">Release Date</label>
                                <input type="date" name="releaseDate" value="{{ $book->release_date }}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="available" {{ $book->status === 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="busy" {{ $book->status === 'busy' ? 'selected' : '' }}>Busy</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="authors">Authors - {{ $book->authors->count() }} Active</label>
                                <select name="author_ids[]" id="authors" class="form-control" multiple>
                                    <option value="none">- None</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ $book->authors->contains($author->id) ? 'selected' : '' }}>
                                            {{ $author->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <h5 class="text-center">Add A New Author (None Existing One)</h5>
                            <div class="form-group mb-3">
                                <div class="new-author-fields">
                                    <div class="new-author">
                                        <input type="text" name="new_authors[0][name]" placeholder="Name" class="form-control mb-2">
                                        <input type="text" name="new_authors[0][last_name]" placeholder="Last Name" class="form-control mb-2">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary add-author">Add Another Author</button>
                            </div>


                            <div class="form-group mb-3 text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
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
