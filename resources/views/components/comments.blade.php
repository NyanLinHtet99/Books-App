
<div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
        <button
            class="accordion-button
            @if (session('commented')) collapsed @endif
            "
            type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            Comments
        </button>
    </h2>
    <div id="collapseOne"
        class="accordion-collapse collapse
    @if (session('commented')) show @endif
    "
        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            @foreach ($book->comments as $comment)
                <div class="d-flex flex-start mt-4">
                    <a class="me-3" href="#">
                        <img class="rounded-circle shadow-1-strong"
                            src="{{ Storage::url('avatars/' . $comment->user->info->image) }}"
                            alt="avatar" width="65" height="65" />
                    </a>
                    <div class="flex-grow-1 flex-shrink-1">
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-1">
                                    {{ $comment->user->name }} <span class="small">-
                                        {{ $comment->created_at->diffForHumans() }}</span>
                                </p>
                            </div>
                            <p class="small mb-0">
                                {{ $comment->body }}
                            </p>
                        </div>
                    </div>
                </div>
                <hr class="mt-4">
            @endforeach
        </div>
    </div>
</div>
