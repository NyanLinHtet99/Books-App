let data;
const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});



(async function () {
    $.ajax({
        url: "/books?page=" + params.page,
        type: "get",
        dataType: "json",
        success: function (response) {
            data = response.data;
        },
    });
        $("#booksWindow").jqxWindow({
            position: 'top, left',
            autoOpen: 'false',
            showCloseButton: true,
            maxHeight: 500,
            maxWidth: 500,
            minHeight: 0,
            minWidth: 0,
            height: 0,
            width: 0,
            animationType: "combined",
            theme: "light",
        });
        $("#booksWindow").jqxWindow("close");
})();
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
            href: "",
            class: "btn btn-primary",
        })
        .text("Read More");
    body.append(title, description, button);
    card.append(image, body);
    $("#booksWindow").jqxWindow('setContent', card);
}
$(".bookWindowLink").each(function () {
    let book = $(this);
    book.on("mousedown", function () {
        let bool = $("#booksWindow").jqxWindow("isOpen");
        if (bool) {
            $("#booksWindow").jqxWindow("close");
        }
    });
    book.on("mouseup", function () {
        let index = $(this).attr("data-index");
        _createElements(data[index]);
        $('#booksWindow').jqxWindow(changeOffset($(this)));
        $("#booksWindow").jqxWindow("open");
        $('html, body').animate({
            scrollTop: $(this).offset().top - 200
        });
        // $('#booksWindow').get(0).scrollIntoView({behavior: 'smooth'});

        return false;
    });
});
$('#booksWindow').on('focus',function(e){
    e.preventDefault();
});
$("#booksWindow").on("mouseleave", function () {
    $("#booksWindow").jqxWindow("close");
});
function changeOffset(book) {
    let offset = book.offset();
    let width = $("#booksContainer").width() * 0.6;
    let height = 460;
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
    return {
        position: {
            x: x,
            y: y,
        },
        height: height,
        width: width,
        minWidth: 350,
        minHeight: 350,
    }
}
