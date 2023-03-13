<hr class="mb-2">
<div class="d-flex flex-start align-items-center">
    <a class="me-3" href="/profile/?user={{ $user->id }}">
        <img class="rounded-circle shadow-1-strong" src="{{ Storage::url('avatars/' . $user->info->image) }}"
            alt="avatar" width="65" height="65" />
    </a>
    <div class="flex-grow-1 flex-shrink-1">
        <div>
            <div class="d-flex justify-content-between align-items-center">
                <p class="mb-1">
                    {{ $user->name }}
                </p>
            </div>
            <p class="small mb-0">
                {{ $user->info->bio }}
            </p>
        </div>
    </div>
</div>
<hr class="mt-2">
