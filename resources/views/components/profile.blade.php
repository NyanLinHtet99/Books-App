<div class="card" style="border-radius: .5rem; height: 100%">
    <div class="row g-0">
        <div class="col-md-4 text-center"
            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
            <img src="{{ Storage::url('avatars/' . auth()->user()->info->image) }}" alt="Avatar"
                class="img-fluid my-5 rounded-circle" style="width: 100px;height: 100px" />
            <i class="fas fa-edit mb-5"></i>
        </div>
        <div class="col-md-8">
            <div class="card-body p-4">
                <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="inputImage">Select Image:</label>
                        <input type="file" name="image" id="inputImage"
                            class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>

                </form>
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                    <div class="col-6 mb-3">
                        <h6>Email</h6>
                        <input type="text" id="email" class="text-muted" value="{{ auth()->user()->email }}">
                    </div>

                </div>
                <h6>Projects</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                    <div class="col-6 mb-3">
                        <h6>Recent</h6>
                        <p class="text-muted">Lorem ipsum</p>
                    </div>
                    <div class="col-6 mb-3">
                        <h6>Most Viewed</h6>
                        <p class="text-muted">Dolor sit amet</p>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                    <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                    <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
