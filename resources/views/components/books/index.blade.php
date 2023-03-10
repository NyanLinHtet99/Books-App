<div class="container" id="booksContainer">
    <div class="d-flex align-items-center">
        <h4 class="h6 me-2">Tags</h4>
        <div id="tags"></div>
        <div id="search"></div>
        <h4 class="h6 me-2 ms-auto" id="sortByTimeHeader">Sort by Time</h4>
        <i class="fa-solid fa-arrow-down-wide-short grow" id="sortByTime"></i>
        <h4 class="h6 me-2 ms-auto" id="sortByAvgHeader">Sort by avg ratings</h4>
        <i class="fa-solid fa-arrow-down-wide-short grow" id="sortByAvg"></i>
    </div>
    <div class="row gx-3 mt-3" id="booksRow"></div>
    <div id="nav"></div>
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
