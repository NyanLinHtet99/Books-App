@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <h3 class="fst-italic">
                    <a href="/books/{{ $book->id }}" style="text-decoration: none;">
                        {{ $book->title }}
                    </a>
                </h3>
                <p class="blog-post-meta">{{ $book->created_at->format('Y-m-d') }}
                </p>
                <hr>
                <div class="card p-4">
                    <form action="/{{ $book->id }}/chapters/store" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input type="text" name="title" id="title" required>
                        </div>
                        <div class="fw-bold d-flex align-items-center mb-2">
                            <p style="line-height: 30px;" class="mb-0">Chapter -</p>
                            <input type="number" name="number" id="number"
                                value="{{ $book->chapters->max('number') + 1 }}">
                        </div>
                        <textarea name="body" id="body" class="fs-5 w-100">
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
