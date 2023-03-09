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
@endsection
