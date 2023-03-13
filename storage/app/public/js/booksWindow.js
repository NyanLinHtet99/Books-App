let data;
let urlData = {
    tags: [],
};
let params = new URLSearchParams(window.location.search);
// URLSearchParams.prototype.remove = function (key, value) {
//     const entries = this.getAll(key);
//     const newEntries = entries.filter((entry) => entry !== value);
//     this.delete(key);
//     newEntries.forEach((newEntry) => this.append(key, newEntry));
// };
// let params = new Proxy(new URLSearchParams(window.location.search), {
//     get: (searchParams, prop) => searchParams.get(prop),
// });
// if (params.get("tags")) {
//     urlData["tags"] = params.getAll("tags");
// }
if (params.get("page")) {
    urlData["page"] = params.get("page");
}
if (params.get("sort")) {
    urlData["sort"] = params.get("sort");
}
if (params.get("search")) {
    urlData["search"] = params.get("search");
}
if (params.get("user")) {
    urlData["user"] = params.get("user");
}
//document ready function
$(function () {
    // prepare the data
    var source = {
        datatype: "json",
        datafields: [
            {
                name: "name",
            },
            {
                name: "id",
            },
        ],
        url: "/tags",
        async: false,
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    // Create a jqxComboBox
    $("#tags").jqxDropDownList({
        selectedIndex: 0,
        source: dataAdapter,
        displayMember: "name",
        valueMember: "id",
        theme: "light",
        incrementalSearch: true,
        searchMode: "startswithignorecase",
        width: 200,
        height: 30,
    });
    $("#tags").jqxDropDownList("insertAt", { name: "All", id: "all" }, 0);

    // trigger the select event.
    $("#tags").on("select", function (e) {
        let id = $(this).jqxDropDownList("val");
        if (id === "all") {
            urlData["tags"] = [];
            deleteUrlParam("tags");
            $("#tagsContainer > div.tag").remove();
        } else if (urlData.tags.includes(id)) {
            return;
        } else {
            let index = $(this).jqxDropDownList("getSelectedIndex");
            insertUrlParam("tags", index);
            urlData["tags"].push(id);
            createTags(e.args.item.label, id, index);
        }
        delete urlData["page"];
        deleteUrlParam("page");
        sendRequest();
    });
    if (params.getAll("tags")) {
        params.getAll("tags").forEach((tag) => {
            $("#tags").jqxDropDownList("selectIndex", tag);
        });
    }
    $("#sort").on("click", function () {
        delete urlData["page"];
        deleteUrlParam("page");
        if (params.get("sort")) {
            delete urlData["sort"];
            deleteUrlParam("sort");
            sendRequest();
            $("#sortHeader").text("Sort by avg ratings");
            return;
        }
        urlData["sort"] = true;
        insertUrlParam("sort", true);
        $("#sortHeader").text("Sorted by avg ratings");
        sendRequest();
    });
    var nameSource = {
        datatype: "json",
        datafields: [
            {
                name: "title",
            },
        ],
        url: "/titles",
    };
    var nameDataAdapter = new $.jqx.dataAdapter(nameSource);
    // $("#search").jqxInput({
    //     source: nameDataAdapter,
    //     placeHolder: "Enter your search",
    //     displayMember: "title",
    //     valueMember: 'id',
    //     theme: 'light',
    //     width: '30%',
    // });
    $("#search").jqxComboBox({
        autoComplete: true,
        searchMode: "contains",
        source: nameDataAdapter,
        displayMember: "title",
        theme: "light",
        width: "40%",
    });

    $("#searchButton").on("click", function () {
        deleteUrlParam("page");
        delete urlData["page"];
        if ($("#search").jqxComboBox("val") == "") {
            deleteUrlParam("search");
            delete urlData["search"];
            sendRequest();
            return;
        }
        insertUrlParam("search", $("#search").jqxComboBox("val"));
        urlData["search"] = $("#search").jqxComboBox("val");
        sendRequest();
    });
    sendRequest();
});
//call ajax
function sendRequest() {
    $("#spin").removeClass("d-none");
    $.ajax({
        url: "/books/",
        data: urlData,
        type: "get",
        dataType: "json",
        success: function (response) {
            //create books grid and pagination links
            $("#spin").addClass("d-none");
            createIndex(response);
            //laravel responded with the paginate object get the data from it
            data = response.data;
            params = new URLSearchParams(window.location.search);
            $("#search").jqxComboBox(
                "val",
                params.get("search") ? params.get("search") : null
            );

            init();
        },
    });
}
//init function responsible for setting thing up
function init() {
    $("#booksWindow").jqxWindow({
        position: "top, left",
        autoOpen: "false",
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
    //book window link is the anchor tag inside the book responsible for opening the window.
    $(".bookWindowLink").each(function () {
        let book = $(this);
        book.on("mouseenter", function () {
            let bool = $("#booksWindow").jqxWindow("isOpen");
            if (bool) {
                $("#booksWindow").jqxWindow("close");
            }
        });
        //there is a data attribute to mark its index in the data array which would be used below to change the content of the window with
        //its data. pass in the parent of the anchor tag to get the offset value it.
        book.on("click", function () {
            let index = $(this).attr("data-index");
            _createElements(data[index]);
            $("#booksWindow").jqxWindow(changeOffset($(this).parent()));
            $("#booksWindow").jqxWindow("open");
            //this stop the scroll bar from reseting and jumping around when the opened window cannot fully appear on the viewport
            //this causes the mouse to jump around along with scroll if not stoped
            var scrollPosition = [self.pageXOffset, self.pageYOffset];
            window.scrollTo(scrollPosition[0], scrollPosition[1]);
            //return false to the click function of anchor tag stop the scrollbar from reseting due to the href'#'
            return false;
        });
    });

    $("#booksWindow").on("mouseleave", function () {
        $("#booksWindow").jqxWindow("close");
    });

    //bind event listiner to pagination link call the init function agian to set up all the event listiner and jqx window agian
    //if not the window will not open
    $(".page-link").each(function () {
        let link = $(this);
        link.on("click", function (e) {
            //stop the anchor from going to the href location. Instead use ajax to request and change the data
            e.preventDefault();
            let page_url = new URL($(this).prop("href"));
            let page_no = page_url.searchParams.get("page");
            insertUrlParam("page", page_no);
            urlData["page"] = page_no;
            sendRequest();
            return false;
        });
    });

    // $(".tag-link").each(function () {
    //     let link = $(this);
    //     link.on("click", function (e) {
    //         //stop the anchor from going to the href location. Instead use ajax to request and change the data
    //         e.preventDefault();
    //         insertUrlParam("tag", $(this).attr("data-tag"));
    //         url.searchParams.set("page", $(this).attr("data-tag"));
    //         sendRequest();
    //     });
    // });
}
function insertUrlParam(key, value) {
    if (history.pushState) {
        let searchParams = new URLSearchParams(window.location.search);
        if (key === "tags") {
            searchParams.append(key, value);
        } else searchParams.set(key, value);
        let newurl =
            window.location.protocol +
            "//" +
            window.location.host +
            window.location.pathname +
            "?" +
            searchParams.toString();
        window.history.pushState({ path: newurl }, "", newurl);
    }
}
function deleteUrlParam(key) {
    if (history.pushState) {
        let searchParams = new URLSearchParams(window.location.search);
        searchParams.delete(key);
        let newurl =
            window.location.protocol +
            "//" +
            window.location.host +
            window.location.pathname +
            "?" +
            searchParams.toString();
        window.history.pushState({ path: newurl }, "", newurl);
    }
}
function deleteUrlParamKeyValue(key, value) {
    if (history.pushState) {
        let searchParams = new URLSearchParams(window.location.search);
        const entries = searchParams.getAll(key);
        const newEntries = entries.filter((entry) => parseInt(entry) !== value);
        searchParams.delete(key);
        newEntries.forEach((newEntry) => searchParams.append(key, newEntry));
        let newurl =
            window.location.protocol +
            "//" +
            window.location.host +
            window.location.pathname +
            "?" +
            searchParams.toString();
        window.history.pushState({ path: newurl }, "", newurl);
    }
}

//functions for creating books Window and finding the offset direction of it
function _createElements(book) {
    //this create a bootstrap card which contian image,title,description and read more button
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
    let description = $("<p>").append(book.description).addClass("card-text");
    let tags = $("<div>").addClass("d-flex my-3");
    book.tags.forEach((tag) => {
        let span = $("<span>")
            .addClass("py-1 badge rounded-pill text-bg-secondary me-2")
            .text(tag.name);
        let a = $("<a>")
            .attr({
                href: "#",
                "data-tag": tag.id,
                class: "tag-link",
            })
            .css("cursor", "pointer");
        a.on("click", function (e) {
            //stop the anchor from going to the href location. Instead use ajax to request and change the data
            e.preventDefault();
            $("#tags").val($(this).attr("data-tag"));
            return false;
        });
        a.append(span);
        tags.append(a);
    });
    let button = $("<a>")
        .attr({
            href: "/books/" + book.id,
            class: "btn btn-primary",
        })
        .text("Read More");
    body.append(title, description, tags, button);
    card.append(image, body);
    $("#booksWindow").jqxWindow("setContent", card);
}

function changeOffset(book) {
    /*
        first get the offset of the clicked item
        then set width dynamically acording to the width of its container
        check whether the set width is possible or not by comparing it with minWidth
        find the approximate value of full window's width and height to calculate whether it will go out of bound or not

    */
    let offset = book.offset();
    let width = $("#booksContainer").width() * 0.6;
    let height = 500;
    let minWidth = 300;
    width = width < minWidth ? 300 : width;
    let winHeight = offset.top + height;
    let winWidth = offset.left + width + book.width();
    let x = offset.left + book.width();
    let y = offset.top;

    if (winHeight > $(window).height()) {
        y = offset.top - (height - book.height());
        if (y < 0) {
            y = offset.top;
        }
    }
    if (winWidth > $(window).width()) {
        x = offset.left - width;
    }
    if ($("body").width() < 570) {
        let bookMid = offset.left + book.width() * 0.5;
        x = bookMid - width * 0.5;
        y = offset.top;
    }
    return {
        position: {
            x: x,
            y: y,
        },
        height: height,
        width: width,
        minWidth: 350,
        minHeight: 500,
    };
}
/*
    Function for creating books
*/
function createIndex(response) {
    /*create nav then substitute it. clear books row and then append book */
    let nav = createNav(response);
    $("#nav").html(nav);
    let data = response.data;
    $("#booksRow").html("");
    data.forEach((data, i) => {
        let book = createBooks(data, i);
        $("#booksRow").append(book);
    });
}
//create pagination nav
function createNav(data) {
    let nav = $("<nav>").addClass(
        "d-flex justify-items-center justify-content-between"
    );
    let div_sm = smallDiv(data);
    nav.append(div_sm);
    return nav;
}
//create small version of pagination
function smallDiv(data) {
    let div_sm = $("<div>").addClass(
        "d-flex justify-content-between flex-fill"
    );
    let ul_sm = $("<ul>").addClass("pagination");
    let prev_li = $("<li>").addClass("page-item");
    if (!data.prev_page_url) {
        prev_li.addClass("disabled");
        let span = $("<span>").addClass("page-link").text("« Previous");
        prev_li.append(span);
    } else {
        let a = $("<a>")
            .attr({
                href: data.prev_page_url,
                class: "page-link",
            })
            .text("« Previous");
        prev_li.append(a);
    }
    let next_li = $("<li>").addClass("page-item");
    if (!data.next_page_url) {
        next_li.addClass("disabled");
        let span = $("<span>").addClass("page-link").text("Next »");
        next_li.append(span);
    } else {
        let a = $("<a>")
            .attr({
                href: data.next_page_url,
                class: "page-link",
            })
            .text("Next »");
        next_li.append(a);
    }
    ul_sm.append(prev_li, next_li);
    div_sm.append(ul_sm);
    return div_sm;
}
//create book
function createBooks(data, i) {
    let div = $("<div>").addClass("col-lg-3 col-md-4 col-sm-6");
    let a = $("<a>").attr({
        href: "#",
        class: "bookWindowLink",
        "data-index": i,
    });
    let content = $("<div>").addClass("content");
    let overlay = $("<div>").addClass("content-overlay");
    let img = $("<img>").attr({
        src: "/storage/books/" + data.cover,
        alt: "cover",
        class: "img-fluid content-image",
        id: "cover",
    });
    let content_detail = $("<div>").addClass("content-details fadeIn-bottom");
    let h3 = $("<h3>").addClass("fs-6").text(data.title);
    content_detail.append(h3);
    content.append(overlay, img, content_detail);
    a.append(content);
    div.append(a);
    return div;
}
function createTags(label, id, index) {
    let div = $("<div>").addClass("position-relative px-2 tag");
    let span = $("<span>")
        .addClass("py-1 px-2 badge rounded-pill text-bg-primary")
        .text(label);
    let i = $("<i>").addClass(
        "fa-solid fa-circle-xmark position-absolute top-0 end-0 grow"
    );
    div.on("click", function () {
        deleteUrlParamKeyValue("tags", index);
        urlData.tags = urlData.tags.filter((item) => item !== id);
        $(this).remove();
        sendRequest();
    });
    div.append(span, i);
    $("#tagsContainer").append(div);
}
