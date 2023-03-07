<div class="container" id="booksContainer">
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
    <div class="row gx-3">
        @foreach ($books as $book)
            <div class="col-lg-3 col-md-4 col-sm-6 book" data-index="{{ $loop->index }}">
                <a href="#">
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
    {{-- <script type="text/javascript">
        let data;
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });
        (async function() {
            $.ajax({
                url: "/books?page=" + params.page,
                type: "get",
                dataType: "json",
                success: function(response) {
                    data = response.data;
                },
            });
        })();
        let booksWindow = (function() {
            function _createElements(book) {
                let card = $('<div>').addClass('card', 'w-100');
                card.css('height', '100%');
                let image = $('<img>').attr({
                    'src': "/storage/books/" + book.cover,
                    'id': 'cover',
                    'alt': 'cover',
                    'class': 'mx-auto mt-2'
                });
                image.css('width', '200px');
                let body = $('<div>').addClass('card-body');
                let title = $('<h5>').addClass('card-title').text(book.title);
                let description = $('<p>').addClass('card-text').text(book.description);
                let button = $('<a>').attr({
                    'href': '#',
                    'class': 'btn btn-primary'
                }).text('Read More');
                body.append(title, description, button);
                card.append(image, body);
                $('#booksWindowContent').html(card);
            };


            function _createWindow(offset) {
                $('#booksWindow').jqxWindow({
                    position: {
                        x: offset.left + 170,
                        y: offset.top + 30
                    },
                    showCloseButton: true,
                    maxHeight: 600,
                    maxWidth: 600,
                    minHeight: 300,
                    minWidth: 300,
                    height: 500,
                    width: 400,
                    autoOpen: true,
                    animationType: 'combined',
                    theme: 'light',
                    initContent: function() {
                        // $('#tab').jqxTabs({
                        //     height: '100%',
                        //     width: '100%'
                        // });
                        $('#booksWindow').jqxWindow('focus');
                    }
                });
            };
            return {
                config: {
                    dragArea: null
                },
                init: function(book, parent) {
                    _createElements(book);
                    _createWindow(parent);
                }
            };
        }());
        $(".book").each(function() {
            let book = $(this);
            book.on('mouseenter', function() {
                let bool = $('#booksWindow').jqxWindow('isOpen');
                if (bool) {
                    $('#booksWindow').jqxWindow('close');
                }
            });
            book.on('click', function() {
                let index = $(this).attr('data-index');
                booksWindow.init(data[index], $(this).offset());
                $('#booksWindow').jqxWindow('open');
            });
        });
        $('#booksWindow').on('mouseleave', function() {
            $('#booksWindow').jqxWindow('close');
        });

        // let books = document.querySelectorAll('.book');
        // books.forEach(book => {
        //     book.addEventListener("mouseenter", (event) => {
        //         console.log(e.target);
        //     });
        // });
    </script> --}}
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
