@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="alert alert-danger d-none" role="alert" id="alert">
                    You are not authorize to do this action.
                </div>
                @if ($book->user_id === auth()->user()->id)
                    <div class="d-flex justify-content-end align-items-center" style="cursor: pointer" id="deleteBook"
                        data-id="{{ $book->id }}">
                        <span class="me-2 text-danger">DELETE</span> <i class="fa-solid fa-xmark grow"></i>
                    </div>
                    <div class="d-flex justify-content-end align-items-center" style="cursor: pointer">
                        <a href="/books/{{ $book->id }}/edit" style="text-decoration: none; color:inherit;"><span
                                class="me-2 text-info">Edit</span> <i
                                class="fa-sharp fa-solid fa-pen-to-square grow"></i></a>
                    </div>
                @endif
                <div class="card">
                    <img src="{{ Storage::url('books/' . $book->cover) }}" class="card-img-top mx-auto mt-3" alt="cover art"
                        style="max-width: 400px">
                    <div class="card-body mt-3">
                        <h5 class="card-title fw-bold">{{ $book->title }}</h5>
                        <p class="card-text">{!! $book->description !!}</p>
                    </div>
                    <div class="p-4">
                        <div id="rating"></div> <span style="font-size: 0.8rem" class="fw-bold">Avg user
                            rating</span>
                        <div id="userRating" data-book="{{ $book->id }}"></div>
                        <span style="font-size: 0.8rem" class="fw-bold">Your rating</span>
                    </div>
                    <div class="p-4">
                        <h3 class="h5 fw-bold">Tags</h3>
                        <div class="d-flex">
                            @foreach ($book->tags as $tag)
                                <a href="/?tag={{ $tag->id }}"><span
                                        class="py-1 px-2 badge rounded-pill text-bg-primary me-3">{{ $tag->name }}</span></a>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="comment" method="POST" action="/comment/store">
                            @csrf
                            <input type="number" name="book_id" hidden value="{{ $book->id }}">
                            <div class="mb-3">
                                <label for="comment" class="form-label">Your Comment</label>
                                <textarea class="form-control" id="comment" rows="3" name="body"></textarea>
                            </div>
                            <button class="btn btn-primary">Submit</button>
                        </form>
                        <div class="accordion mt-4" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        Chapters
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class="list-group">
                                            @if ($book->user->id === auth()->user()->id)
                                                <a href="" class="list-group-item list-group-item-action bg-primary"
                                                    style="color:white; text-align: center">Add Chapter</a>
                                            @endif
                                            @foreach ($book->chapters as $chapter)
                                                <div class="d-flex mb-2">
                                                    <a href="/chapters/{{ $chapter->id }}"
                                                        class="list-group-item list-group-item-action" style="cursor: pointer;width: 90%">
                                                        <strong class="me-3">Chapter - {{ $chapter->number }}</strong>
                                                        {{ $chapter->title }}
                                                    </a>
                                                    <a href="/chapters/{{ $chaper->id }}/delete" class="btn btn-danger mx-2">DELETE</a>
                                                    <a href="/chapters/{{ $chaper->id }}/edit" class="btn btn-info">EDIT</a>
                                                </div>

                                            @endforeach
                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <x-comments :book="$book"></x-comments>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            init();
            $('#deleteBook').on('click', function() {
                $.ajax({
                    url: '/books/' + $(this).attr('data-id'),
                    type: 'DELETE',
                    success: function(response) {
                        if (response) {
                            window.location.href = '/';
                        } else {
                            $('#alert').removeClass('d-none');
                        }
                    }
                });
            });
        });
        $('#userRating').on('change', function(e) {
            $.ajax({
                url: '/rating/store',
                type: 'post',
                data: {
                    'book_id': $(this).attr('data-book'),
                    'value': e.value,
                },
                dataType: 'json',
                success: function(response) {
                    $('#rating').jqxRating('setValue', response.avg_rating);
                }
            });
        });

        function init() {
            $.ajax({
                url: '/rating?book_id=' + {{ $book->id }},
                type: "get",
                dataType: "json",
                success: function(response) {
                    $("#rating").jqxRating({
                        value: response.avg_rating,
                        disabled: true,
                        theme: 'light'
                    });
                    $('#userRating').jqxRating({
                        value: response.user_rating,
                        theme: 'light'
                    });
                },
            });
        }
    </script>
@endsection
