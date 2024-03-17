@extends('BookStore.Layouts.base')

@section('body')
    <div class="container">
        <h2 class="text-center mt-3">UPDATE BOOK</h2>
        <form action="{{ route('update', $book->attributes()->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" name="category" value="{{ $book->attributes()->category }}" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
            </div>
            <div class="mb-3">
                <label for="lang" class="form-label">TITLE-LANG</label>
                <input type="text" class="form-control" id="lang" value="{{ $book->title['lang'] }}" name="lang">
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" value="{{ $book->author }}" id="author" name="author" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="number" class="form-control" value="{{ $book->year }}" id="year" name="year" min="1000" max="9999"
                    required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" value="{{ $book->price }}" id="price" name="price" step="0.01" min="0"
                    required>
            </div>

            <div class="modal-footer">
                <a href="{{route("index")}}"><button type="button" class="btn btn-secondary">BACK</button></a>
                <button type="submit" class="btn btn-primary ms-2">SAVE</button>
            </div>
        </form>
    </div>
@endsection
