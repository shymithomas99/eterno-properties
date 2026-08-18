@extends("admin.layouts.app")
@section('title', ($welcomeSection->id ? 'Edit ' : 'Add ') . 'Welcome')
@section("content")

@use(App\Enums\Status)

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">
            Welcome
        </h1>
        
        <form method="POST" action="{{ route('admin.welcome-section.update') }}" enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}
        <div class="card shadow mb-4">
            <div class="card-body">
                
                <!-- <h3 class="font-size-lg text-dark font-weight-bold mb-3">Welcome</h3> -->
                <div class="row">

                    <div class="form-group col-md-6">
                        <label><strong>Subtitle <span class="text-danger">*</span></strong></label>
                        <input type="text"
                            name="sub_title"
                            class="form-control"
                            placeholder="WELCOME"
                            value="{{ old('sub_title', $welcomeSection->sub_title) }}">
                        @error('sub_title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Title <span class="text-danger">*</span></strong></label>
                        <input type="text"
                            name="title"
                            class="form-control"
                            value="{{ old('title', $welcomeSection->title) }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Description <span class="text-danger">*</span></strong></label>
                        <textarea name="description"
                                rows="3"
                                class="form-control">{{ old('description', $welcomeSection->description) }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label><strong>Left Image (413 × 503 px, max 400 KB) <span class="text-danger">*</strong></label>
                        <div class="custom-file mb-3">
                            <input type="file"
                                class="custom-file-input"
                                id="left_image"
                                name="left_image"
                                accept="image/*"
                                onchange="document.getElementById('left_uploaded_img').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="left_image">
                                {{ $welcomeSection->left_image ?: 'Choose file' }}
                            </label>
                        </div>
                        <img id="left_uploaded_img" class="uploaded-img"
                            src="{{ $welcomeSection->left_image ? asset('uploads/welcome-sections/'.$welcomeSection->left_image) : asset('img/upload_image.png') }}">
                        @error('left_image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Right Image (413 × 503 px, max 400 KB) <span class="text-danger">*</strong></label>
                        <div class="custom-file mb-3">
                            <input type="file"
                                class="custom-file-input"
                                id="right_image"
                                name="right_image"
                                accept="image/*"
                                onchange="document.getElementById('right_uploaded_img').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="right_image">
                                {{ $welcomeSection->right_image ?: 'Choose file' }}
                            </label>
                        </div>
                        <img id="right_uploaded_img" class="uploaded-img"
                            src="{{ $welcomeSection->right_image ? asset('uploads/welcome-sections/'.$welcomeSection->right_image) : asset('img/upload_image.png') }}">
                        @error('right_image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Button Text <span class="text-danger">*</span></strong></label>
                        <input type="text"
                            name="button_text"
                            class="form-control"
                            value="{{ old('button_text', $welcomeSection->button_text) }}">
                        @error('button_text')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Button URL <span class="text-danger">*</span></strong></label>
                        <input type="text"
                            name="button_url"
                            class="form-control"
                            value="{{ old('button_url', $welcomeSection->button_url) }}">
                        @error('button_url')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label><strong>Status</strong></label>
                        <input type="hidden" name="status" value="{{ Status::INACTIVE->value }}">
                        <div class="custom-control custom-switch">
                            <input
                                type="checkbox"
                                class="custom-control-input"
                                id="status"
                                name="status"
                                value="{{ Status::ACTIVE->value }}"
                                {{ old('status', $welcomeSection->status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'checked' : '' }}
                            >
                            <label class="custom-control-label" for="status">
                                <span id="status-text">
                                    {{ old('status', $welcomeSection->status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'Active' : 'Inactive' }}
                                </span>
                            </label>
                        </div>
                    </div>

                </div>   
            </div>
            
            <div class="card-footer">
                <div class="row">
                    <div class="form-group col-6">
                    <button type="submit" class="btn btn-primary mr-3">Update</button>
                    {{-- <a class="btn btn-secondary ml-3" href="{{ route('admin.welcome-section.edit') }}">Cancel</a> --}}
                    </div>
                </div>
            </div>
        </div>
        </form>
        
        
    </div>
    <!-- /.container-fluid -->
@endsection

@push('style')
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('script')
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if(session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif

    @if(session('info'))
        toastr.info("{{ session('info') }}");
    @endif
</script>

<script type="text/javascript">
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script>
    document.getElementById('status').addEventListener('change', function () {
        document.getElementById('status-text').textContent =
            this.checked ? 'Active' : 'Inactive';
    });
</script>
@endpush