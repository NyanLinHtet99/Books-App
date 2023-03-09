@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="container">
                    <div class="card">
                        <img src="{{ Storage::url('books/' . $book->cover) }}" class="card-img-top mx-auto mt-3"
                            alt="cover art" style="max-width: 400px">
                        <div class="card-body mt-3">
                            <h5 class="card-title fw-bold">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->description }}</p>
                        </div>
                        <div class="p-4">
                            <div id="rating"></div> <span style="font-size: 0.8rem">Avg user rating</span>
                            <div id="userRating" data-book="{{ $book->id }}"></div>
                            <span style="font-size: 0.8rem">Give rating</span>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($book->tags as $tag)
                                <li class="list-group-item"><a href="/?tag={{ $tag->id }}">{{ $tag->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="card-body">
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
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
            $('#userRating').jqxRating({
                value: 0,
                theme: 'light'
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
                },
            });
        }
    </script>
@endsection
