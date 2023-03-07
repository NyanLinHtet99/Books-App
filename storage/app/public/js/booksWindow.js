let data;
const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});
let booksWindow;
(async function () {
    $.ajax({
        url: "/books?page=" + params.page,
        type: "get",
        dataType: "json",
        success: function (response) {
            data = response.data;
        },
    });

    booksWindow = (function () {
        function _createElements(book) {
            let card = $("<div>").addClass("card", "w-100");
            card.css("height", "100%");
            let image = $("<img>").attr({
                src: "/storage/books/" + book.cover,
                id: "cover",
                alt: "cover",
                class: "mx-auto mt-2",
            });
            image.css("width", "200px");
            let body = $("<div>").addClass("card-body");
            let title = $("<h5>").addClass("card-title").text(book.title);
            let description = $("<p>")
                .addClass("card-text")
                .text(book.description);
            let button = $("<a>")
                .attr({
                    href: "#",
                    class: "btn btn-primary",
                })
                .text("Read More");
            body.append(title, description, button);
            card.append(image, body);
            $("#booksWindowContent").html(card);
        }
        function _createWindow(book) {
            let offset = book.offset();
            let width = $("#booksContainer").width() * 0.6;
            let height = 500;
            let minWidth = 300;
            width = width < minWidth ? 300 : width;
            let winHeight = offset.top + height;
            let winWidth = offset.left + width + book.width();
            let x = offset.left + book.width();
            let y = offset.top;
            if (winHeight > $("body").height()) {
                y = offset.top + book.height() - height;
            }
            if (winWidth > $("body").width()) {
                x = offset.left - width;
            }
            $("#booksWindow").jqxWindow({
                position: {
                    x: x,
                    y: y,
                },
                showCloseButton: true,
                maxHeight: 500,
                maxWidth: 500,
                minHeight: 300,
                minWidth: 300,
                height: height,
                width: width,
                animationType: "combined",
                theme: "light",
                initContent: function () {
                    $("#booksWindow").jqxWindow("focus");
                },
            });
        }
        return {
            config: {
                dragArea: null,
            },
            init: function (book, parent) {
                _createElements(book);
                _createWindow(parent);
            },
        };
    })();
})();
$(".book").each(function () {
    let book = $(this);
    book.on("mouseenter", function () {
        let bool = $("#booksWindow").jqxWindow("isOpen");
        if (bool) {
            $("#booksWindow").jqxWindow("close");
        }
    });
    book.on("click", function () {
        let index = $(this).attr("data-index");
        booksWindow.init(data[index], $(this));
        $("#booksWindow").jqxWindow("open");
        return false;
    });
});
$("#booksWindow").on("mouseleave", function () {
    $("#booksWindow").jqxWindow("close");
});
