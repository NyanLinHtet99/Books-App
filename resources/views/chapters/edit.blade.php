@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <h3 class="fst-italic">
                    <a href="/books/{{ $chapter->book->id }}" style="text-decoration: none;">
                        {{ $chapter->book->title }}
                    </a>
                </h3>
                <p class="blog-post-meta">{{ $chapter->book->created_at->format('Y-m-d') }}
                </p>
                <hr>
                <div class="card p-4">
                    <form action="/chapters/{{ $chapter->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <input type="text" name="title" id="title" required value="{{ $chapter->title }}">
                        </div>
                        <div class="fw-bold d-flex align-items-center mb-2">
                            <p style="line-height: 30px;" class="mb-0">Chapter -</p>
                            <input type="number" name="number" id="number" value="{{ $chapter->number }}">
                        </div>
                        <textarea name="body" id="body" class="fs-5 w-100">
                            {!! $chapter->body !!}
                        </textarea>
                        <button class="mt-2 btn btn-success ">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $('#body').jqxEditor({
                height: "400px",
                width: $('#body').width(),
                tools: 'bold italic underline | left center right',
                theme: 'light'
            });
            $("#title").jqxInput({
                placeHolder: 'Chapter Title',
                height: 30,
                width: 250,
                minLength: 1,
                theme: 'light'
            });
            $("#number").jqxInput({
                height: 30,
                width: 250,
                minLength: 1,
                theme: 'light'
            });
        });
    </script>
@endsection
