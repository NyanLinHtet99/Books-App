<div class="card border-0" style="height: 100%">
    <div class="row g-0">
        <div class="col-md-4 text-center">
            <img src="{{ Storage::url('avatars/' . auth()->user()->info->image) }}" alt="Avatar"
                class="img-fluid my-5 rounded-circle" style="width: 100px;height: 100px" id="avatar" />
            <i class="fas fa-edit mb-5 grow" id="editImage"></i>
        </div>
        <div class="col-md-8">
            <div class="card-body p-4">
                <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" id="userForm">
                    @csrf
                    <input type="file" name="image" id="inputImage" hidden class="userForm-input">
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <p class="bg-info alert d-none" id="UpdateAlert">Changes will be updated after saved</p>
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                    <div class="col-6 mb-3">
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required
                            form="userForm" class="userForm-input">
                    </div>
                    <div class="col-6 mb-3">
                        <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required
                            form="userForm" class="userForm-input">
                    </div>

                </div>
                <h6>Bio</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                    <div class="col mb-3">
                        <textarea name="bio" id="bio" rows="3" class="form-control userForm-input" maxlength="100"
                            form="userForm">{{ auth()->user()->info->bio ?? '' }}</textarea>
                    </div>
                </div>
                <div class="row w-25 my-2 ms-auto">
                    <button class="btn btn-success" type="submit" form="userForm" id="userFormBtn"
                        disabled>Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
