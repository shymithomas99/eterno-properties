@extends('admin.layouts.app')

@section('title', 'Contact Page')

@section('content')

    <div class="container-fluid">

        <div class="card shadow mb-4">

            <div class="card-header">

                <h4 class="mb-0">
                    Contact Page
                </h4>

            </div>

            <div class="card-body">

                {{--  @if ($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif  --}}

                <form action="{{ route('admin.contact-page.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <!-- ================= Banner ================= -->

                    <h5 class="mb-3">
                        Banner Section
                    </h5>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label><strong>Banner Title <span class="text-danger">*</span></strong></label>

                                <input type="text" name="banner_title" class="form-control"
                                    value="{{ old('banner_title', $page->banner_title) }}">
                                @error('banner_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>


                        <div class="form-group col-md-6">

                            <label><strong>Banner Image (1920 × 700 px, max 200 KB) <span class="text-danger">*</span></strong></label>

                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="banner_image" name="banner_image"
                                    accept="image/*"
                                    onchange="
                    previewImage(
                        this,
                        'banner_image_preview'
                    );
               ">

                                <label class="custom-file-label" id="banner-image-label" for="banner_image">

                                    {{ $page->banner_image ? $page->banner_image : 'Choose file' }}

                                </label>

                                {{-- Thumbnail inside file input --}}
                                <img id="banner_image_preview"
                                    src="{{ $page->banner_image ? asset($page->banner_image) : asset('img/upload_image.png') }}"
                                    class="file-input-preview">

                            </div>

                            @error('banner_image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>
                        <div class="col-md-12">

                            <div class="form-group">

                                <label><strong>Banner Description <span class="text-danger"></span></strong></label>

                                <textarea name="banner_description" rows="4" class="form-control">{{ old('banner_description', $page->banner_description) }}</textarea>
                                @error('banner_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <hr>

                    <!-- ================= Intro ================= -->

                    <h5 class="mb-3">
                        Introduction Section
                    </h5>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label><strong>Subtitle <span class="text-danger">*</span></strong></label>

                                <input type="text" name="section_subtitle" class="form-control"
                                    value="{{ old('section_subtitle', $page->section_subtitle) }}">

                                @error('section_subtitle')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>

                        <div class="col-md-8">

                            <div class="form-group">

                                <label><strong>Title <span class="text-danger">*</span></strong></label>

                                <input type="text" name="section_title" class="form-control"
                                    value="{{ old('section_title', $page->section_title) }}">


                                @error('section_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <label><strong>Description <span class="text-danger">*</span></strong></label>

                                <textarea name="section_description" rows="5" class="form-control">{{ old('section_description', $page->section_description) }}</textarea>
                                @error('section_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <hr>

                    <!-- ================= Contact Form ================= -->

                    <h5 class="mb-3">
                        Contact Form Section
                    </h5>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label><strong>Form Title <span class="text-danger">*</span></strong></label>

                                <input type="text" name="form_title" class="form-control"
                                    value="{{ old('form_title', $page->form_title) }}">

                                @error('form_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>

                        {{--
                        <div class="form-group col-md-6">

                            <label>
                                <strong>
                                    Form Image (700 × 800 px, max 200 KB)
                                </strong>
                            </label>

                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="form_image" name="form_image"
                                    accept="image/*"
                                    onchange="
        this.closest('.form-group').querySelector('#uploaded_img').src =
        window.URL.createObjectURL(this.files[0]);
    ">

                                <label class="custom-file-label" id="form-image-label" for="form_image">

                                    {{ $page->form_image ?: 'Choose file' }}

                                </label>

                            </div>

                            <img id="uploaded_img"
                                src="{{ $page->form_image ? asset($page->form_image) : asset('img/upload_image.png') }}"
                                width="150" height="100">

                            @error('form_image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>  --}}

                        <div class="form-group col-md-6">

                            <label><strong>Form Image (700 × 800 px, max 200 KB) <span class="text-danger">*</span></strong></label>

                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="form_image" name="form_image"
                                    accept="image/*"
                                    onchange="
                    previewImage(
                        this,
                        'form_image_preview'
                    );
               ">

                                <label class="custom-file-label" id="form-image-label" for="form_image">

                                    {{ $page->form_image ? $page->form_image : 'Choose file' }}

                                </label>

                                {{-- Thumbnail inside file input --}}
                                <img id="form_image_preview"
                                    src="{{ $page->form_image ? asset($page->form_image) : asset('img/upload_image.png') }}"
                                    class="file-input-preview">

                            </div>

                            @error('form_image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>



                        <div class="col-md-12">

                            <div class="form-group">

                                <label><strong>Form Description <span class="text-danger"></span></strong></label>

                                <textarea name="form_description" rows="4" class="form-control">{{ old('form_description', $page->form_description) }}</textarea>
                                @error('form_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <hr>

                    <!-- ================= Contact Info ================= -->

                    <h5 class="mb-3">
                        Contact Information
                    </h5>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label><strong>Phone <span class="text-danger">*</span></strong></label>

                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $page->phone) }}">

                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label><strong>Email <span class="text-danger">*</span></strong></label>

                                <input type="text" name="email" class="form-control"
                                    value="{{ old('email', $page->email) }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label><strong>Address <span class="text-danger">*</span></strong></label>

                                <textarea name="address" rows="3" class="form-control">{{ old('address', $page->address) }}</textarea>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <hr>

                    <!-- ================= Google Map ================= -->

                    <h5 class="mb-3">
                        Google Map
                    </h5>

                    <div class="form-group">

                        <label><strong>Google Map Embed Code <span class="text-danger">*</span></strong></label>

                        <textarea name="map_iframe" rows="6" class="form-control">{{ old('map_iframe', $page->map_iframe) }}</textarea>
                        @error('map_iframe')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <small class="text-muted">
                            Paste the Google Maps Embed iframe here.
                        </small>

                    </div>

                    <hr>

                    <button class="btn btn-primary">

                        <i class="fa fa-save"></i>

                        Update

                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection

@push('style')
    <style>
        .custom-file {
            position: relative;
        }

        .custom-file-label {
            padding-right: 55px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .file-input-preview {
            position: absolute;
            right: 80px;
            top: 50%;
            transform: translateY(-50%);

            width: 40px;
            height: 32px;

            object-fit: cover;

            border-radius: 2px;
            z-index: 10;

            pointer-events: none;
        }
    </style>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('script')
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
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
@endpush
