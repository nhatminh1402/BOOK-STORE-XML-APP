@extends('BookStore.Layouts.base')

@section('body')
    <div class="container mt-5">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-plus-square"></i>
            ADD BOOK
        </button>
        <div class="p-2"></div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">CATEGORY</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">TITLE-LANG</th>
                    <th scope="col">AUTHOR</th>
                    <th scope="col">YEAR</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">ACTIONS</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($xml as $book)
                    <tr class="text-center">
                        <th scope="row">{{ $book->attributes()->id }}</th>
                        <td>{{ $book->attributes()->category }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->title['lang'] }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->year }}</td>
                        <td>{{ $book->price }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('edit', $book->attributes()->id) }}">
                                <i class="bi bi-pen"></i>
                                Edit
                            </a>
                            <a class="btn btn-danger" href="{{ route('delete', $book->attributes()->id) }}">
                                <i class="bi bi-trash"></i>
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">CREATE NEW BOOK</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('store') }}" method="POST">

                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" name="category" required>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="lang" class="form-label">TITLE-LANG</label>
                            <input type="text" class="form-control" id="lang" name="lang">
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" name="author" required>
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control" id="year" name="year" min="1000"
                                max="9999" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01"
                                min="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
