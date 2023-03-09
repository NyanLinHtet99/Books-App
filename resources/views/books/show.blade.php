@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="container">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ Storage::url('books/' . $book->cover) }}" class="card-img-top" alt="cover art">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->description }}</p>
                            <div id="rating"></div>
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
        });

        function init() {
            $.ajax({
                url: '/rating?book_id=' + {{ $book->id }},
                type: "get",
                dataType: "json",
                success: function(response) {
                    $("#rating").jqxRating({
                        width: 350,
                        height: 35,
                        value: response.avg_rating,
                        theme: 'light'
                    });
                    $('#rating').on('change', function(e) {
                        $.ajax({
                            url: '/rating/store',
                            type: 'post',
                            dataType: 'json',

                        });
                    });
                },
            });
        }
    </script>
@endsection
