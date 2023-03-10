@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card p-4">
                    <div class="mx-auto my-4">
                        <img src="{{ Storage::url('books/'.$book->cover) }}" class="" alt="cover art"
                            style="max-width: 200px" id="cover">
                        <i class="fas fa-edit grow" id="coverEdit"></i>
                    </div>
                    <form action="/books/{{ $book->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="file" name="cover" id="inputCover" hidden>
                        <div class="mb-4">
                            <input type="text" name="title" id="title" required value="{{ $book->title }}">
                        </div>
                        <textarea name="description" id="description" placeholder="Book's description" class="fs-5 w-100">
                            {!! $book->description !!}
                        </textarea>
                        <button class="mt-2 btn btn-success ">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $('#description').jqxEditor({
                height: "200px",
                width: $('#description').width(),
                tools: 'bold italic underline | left center right',
                theme: 'light'
            });
            $("#title").jqxInput({
                placeHolder: 'Title',
                height: 30,
                width: 250,
                minLength: 1,
                theme: 'light'
            });
            $('#coverEdit').on('click', function() {
                $("#inputCover").trigger("click");
            });
            $("#inputCover").on("change", function() {
                const file = $(this).prop("files");
                if (file) {
                    $("#cover").attr("src", URL.createObjectURL(file[0]));
                }
            });
        });
    </script>
@endsection
