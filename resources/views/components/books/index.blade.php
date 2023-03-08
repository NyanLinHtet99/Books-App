<div class="container" id="booksContainer">
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
    <div class="row gx-3">
        @foreach ($books as $book)
            <div class="col-lg-3 col-md-4 col-sm-6">

                    <a href="#" class="bookWindowLink" data-index="{{ $loop->index }}">
                        <div class="content" style="height:200px">
                            <div class="content-overlay"></div>
                            <img src="{{ Storage::url('books/' . $book->cover) }}" alt="cover"
                                class="img-fluid content-image" id="cover" />
                            <div class="content-details fadeIn-bottom">
                                <h3 class="fs-6">{{ $book->title }}</h3>
                            </div>
                        </div>
                    </a>


            </div>
        @endforeach

    </div>
    {{ $books->links() }}
    <div id="books">
        <div>
            <div id="booksWindow">
                <div id="booksWindowHeader">
                    <span>
                        Book
                    </span>
                </div>
                <div id="booksWindowContent">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ Storage::url('js/booksWindow.js') }}" type="module"></script>
</div>
