@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-8">
                <h3 class="pb-4 mb-4 fst-italic border-bottom">
                    <a href="/books/{{ $chapter->book->id }}" style="text-decoration: none;">
                        {{ $chapter->book->title }}
                    </a>
                </h3>

                <article class="blog-post">
                    <h2 class="blog-post-title"><strong class="me-2">Chapter - {{ $chapter->number }}</strong>
                        {{ $chapter->title }}</h2>
                    <p class="blog-post-meta">{{ $chapter->created_at->format('Y-m-d') }} by
                        {{ $chapter->book->user->name }}
                    </p>
                    <p
                        style="text-align: justify;
                    text-justify: inter-word;
                    text-indent: 4rem">
                        {{ $chapter->body }}
                    </p>

                </article>
                <div class="d-flex justify-content-between">
                    <a href="{{ $prevChapter ? '/chapters/' . $prevChapter->id : 'javascript:void(0)' }}"
                        class="btn btn-primary {{ $prevChapter ? '' : 'disabled' }}">Prev</a>
                    <a href="{{ $nextChapter ? '/chapters/' . $nextChapter->id : 'javascript:void(0)' }}"
                        class="btn btn-primary {{ $nextChapter ? '' : 'disabled' }}">Next</a>
                </div>
            </div>
        </div>
    </div>
@endsection
