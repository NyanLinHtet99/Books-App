@extends()
<nav class="d-flex justify-items-center justify-content-between">
    <div class="d-flex justify-content-between flex-fill d-sm-none">
        <ul class="pagination">

            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">« Previous</span>
            </li>


            <li class="page-item">
                <a class="page-link" href="http://127.0.0.1:8000?page=2" rel="next">Next »</a>
            </li>
        </ul>
    </div>

    <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
        <div>
            <p class="small text-muted">
                Showing
                <span class="fw-semibold">1</span>
                to
                <span class="fw-semibold">15</span>
                of
                <span class="fw-semibold">20</span>
                results
            </p>
        </div>
        <div>
            <ul class="pagination">
                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                    <span class="page-link" aria-hidden="true">‹</span>
                </li>
                <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000?page=2">2</a></li>
                <li class="page-item">
                    <a class="page-link" href="http://127.0.0.1:8000?page=2" rel="next" aria-label="Next »">›</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
