@extends('admin.layouts.app')

@section('title', 'About')

@section('content')

    @use(App\Enums\AboutStatus)

    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                About Page
            </h1>

        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Main Form --}}
        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">

            @csrf

            @method('PUT')


            {{-- =========================================================
                 BANNER SECTION
            ========================================================== --}}
            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">
                        Banner Section
                    </h6>

                </div>


                <div class="card-body">

                    <div class="row">

                        {{-- Banner Title --}}
                        <div class="col-md-6">

                            <label><strong>Banner Title <span class="text-danger">*</span></strong></label>

                            <input type="text" name="banner_title" id="banner_title" class="form-control"
                                value="{{ old('banner_title', $about->banner_title) }}">

                            @error('banner_title')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Banner Image --}}
                        <div class="form-group col-md-6">

                            <label for="banner_image">
                                <strong>
                                    Banner Image (1920 × 700 px, max 200 KB)
                                </strong>
                            </label>

                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="banner_image" name="banner_image"
                                    accept="image/*">

                                <label class="custom-file-label" for="banner_image">

                                    <span class="file-name">
                                        {{ $about->banner_image ? basename($about->banner_image) : 'Choose file' }}
                                    </span>

                                    @if ($about->banner_image)
                                        <img id="banner_uploaded_img" src="{{ asset($about->banner_image) }}"
                                            class="file-preview" alt="Banner Image">
                                    @endif

                                </label>

                            </div>


                            @error('banner_image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Banner Description --}}
                        <div class="col-md-12 mt-3">

                            <label><strong>Banner Description <span class="text-danger">*</span></strong></label>

                            <textarea name="banner_description" id="banner_description" rows="5" class="form-control">{{ old('banner_description', $about->banner_description) }}</textarea>

                            @error('banner_description')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                 ABOUT / INTRO SECTION
            ========================================================== --}}
            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">
                        About Section
                    </h6>

                </div>


                <div class="card-body">

                    <div class="row">

                        {{-- Intro Title --}}
                        <div class="col-md-6">

                            <label><strong>Title <span class="text-danger">*</span></strong></label>

                            <input type="text" name="intro_title" id="intro_title" class="form-control"
                                value="{{ old('intro_title', $about->intro_title) }}">

                            @error('intro_title')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Intro Image --}}
                        <div class="form-group col-md-6">

                            <label for="intro_image">
                                <strong>
                                    Intro Image (800 × 535 px, max 200 KB)
                                </strong>
                            </label>

                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="intro_image" name="intro_image"
                                    accept="image/*">

                                <label class="custom-file-label" for="intro_image">

                                    <span class="file-name">
                                        {{ $about->intro_image ? basename($about->intro_image) : 'Choose file' }}
                                    </span>

                                    @if ($about->intro_image)
                                        <img id="intro_uploaded_img" src="{{ asset($about->intro_image) }}"
                                            class="file-preview" alt="Intro Image">
                                    @endif

                                </label>

                            </div>


                            @error('intro_image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Intro Description --}}
                        <div class="col-md-12 mt-3">

                            <label><strong>Description <span class="text-danger">*</span></strong></label>

                            <textarea name="intro_description" id="intro_description" rows="6" class="form-control">{{ old('intro_description', $about->intro_description) }}</textarea>

                            @error('intro_description')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                 CALL TO ACTION SECTION
            ========================================================== --}}
            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">
                        Call To Action
                    </h6>

                </div>


                <div class="card-body">

                    <div class="row">

                        {{-- CTA Title --}}
                        <div class="col-md-6">

                            <label><strong>CTA Title <span class="text-danger">*</span></strong></label>

                            <input type="text" name="cta_title" id="cta_title" class="form-control"
                                value="{{ old('cta_title', $about->cta_title) }}">

                            @error('cta_title')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- CTA Button Text --}}
                        <div class="col-md-6">

                            <label><strong>Button Text <span class="text-danger">*</span></strong></label>

                            <input type="text" name="cta_button_text" id="cta_button_text" class="form-control"
                                value="{{ old('cta_button_text', $about->cta_button_text) }}">

                            @error('cta_button_text')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- CTA Button Link --}}
                        <div class="col-md-6 mt-3">

                            <label><strong>Button Link <span class="text-danger">*</span></strong></label>

                            <input type="text" name="cta_button_link" id="cta_button_link" class="form-control"
                                value="{{ old('cta_button_link', $about->cta_button_link) }}">

                            @error('cta_button_link')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- CTA Background Image --}}
                        <div class="form-group col-md-6 mt-3">

                            <label for="cta_background_image">
                                <strong>
                                    CTA Background Image (1920 × 900 px, max 200 KB)
                                </strong>
                            </label>

                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="cta_background_image"
                                    name="cta_background_image" accept="image/*">

                                <label class="custom-file-label" for="cta_background_image">

                                    <span class="file-name">
                                        {{ $about->cta_background_image ? basename($about->cta_background_image) : 'Choose file' }}
                                    </span>

                                    @if ($about->cta_background_image)
                                        <img id="cta_uploaded_img" src="{{ asset($about->cta_background_image) }}"
                                            class="file-preview" alt="CTA Background Image">
                                    @endif

                                </label>

                            </div>


                            @error('cta_background_image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- CTA Description --}}
                        <div class="col-md-12 mt-3">

                            <label><strong>Description <span class="text-danger">*</span></strong></label>

                            <textarea name="cta_description" id="cta_description" rows="5" class="form-control">{{ old('cta_description', $about->cta_description) }}</textarea>

                            @error('cta_description')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Status --}}
                        {{--  <div class="col-md-6 mt-3">

                            <div class="form-group">

                                <label><strong>Status <span class="text-danger"></span></strong></label>

                                <select name="status" id="status" class="form-control">

                                    <option value="{{ AboutStatus::ACTIVE->value }}"
                                        {{ old('status', $about->status?->value ?? AboutStatus::ACTIVE->value) == AboutStatus::ACTIVE->value
                                            ? 'selected'
                                            : '' }}>
                                        Active
                                    </option>

                                    <option value="{{ AboutStatus::INACTIVE->value }}"
                                        {{ old('status', $about->status?->value ?? AboutStatus::ACTIVE->value) == AboutStatus::INACTIVE->value
                                            ? 'selected'
                                            : '' }}>
                                        Inactive
                                    </option>

                                </select>

                                @error('status')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>  --}}

                    </div>

                </div>

            </div>


            {{-- =========================================================
                 UPDATE BUTTON
            ========================================================== --}}
            <div class="text-right mb-4">

                <button type="submit" class="btn btn-primary">

                    <i class="fa fa-save"></i>
                    Update

                </button>

            </div>


        </form>

    </div>

@endsection


{{-- =========================================================
     STYLE
========================================================== --}}
@push('style')
    {{-- Toastr CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <style>
        /*
                                    |--------------------------------------------------------------------------
                                    | File Input Preview
                                    |--------------------------------------------------------------------------
                                    */

        .custom-file {
            position: relative;
        }

        .custom-file-label {
            display: flex;
            align-items: center;

            padding-right: 110px;

            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .custom-file-label .file-name {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;

            padding-right: 5px;
        }

        .custom-file-label .file-preview {
            position: absolute;

            right: 72px;
            top: 50%;

            transform: translateY(-50%);

            width: 36px;
            height: 30px;

            object-fit: cover;

            border-radius: 2px;

            z-index: 10;

            pointer-events: none;
        }
    </style>
@endpush


{{-- =========================================================
     SCRIPT
========================================================== --}}
@push('script')
    {{-- Toastr JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        $(document).ready(function() {


            /*
            |--------------------------------------------------------------------------
            | Toastr Messages
            |--------------------------------------------------------------------------
            */

            @if (session('success'))

                toastr.success(@json(session('success')));
            @endif


            @if (session('error'))

                toastr.error(@json(session('error')));
            @endif


            @if (session('warning'))

                toastr.warning(@json(session('warning')));
            @endif


            @if (session('info'))

                toastr.info(@json(session('info')));
            @endif



            /*
            |--------------------------------------------------------------------------
            | Banner Image
            |--------------------------------------------------------------------------
            */

            $('#banner_image').on('change', function() {

                if (!this.files || !this.files[0]) {
                    return;
                }

                const file = this.files[0];

                const label = $(this).siblings('.custom-file-label');

                const fileName = label.find('.file-name');

                fileName.text(file.name);


                let preview = $('#banner_uploaded_img');


                /*
                |--------------------------------------------------------------------------
                | Create Preview If It Does Not Exist
                |--------------------------------------------------------------------------
                */

                if (!preview.length) {

                    preview = $('<img>', {
                        id: 'banner_uploaded_img',
                        class: 'file-preview',
                        alt: 'Banner Image'
                    });

                    label.append(preview);

                }


                /*
                |--------------------------------------------------------------------------
                | Update Preview
                |--------------------------------------------------------------------------
                */

                preview.attr(
                    'src',
                    URL.createObjectURL(file)
                );

            });



            /*
            |--------------------------------------------------------------------------
            | Intro Image
            |--------------------------------------------------------------------------
            */

            $('#intro_image').on('change', function() {

                if (!this.files || !this.files[0]) {
                    return;
                }

                const file = this.files[0];

                const label = $(this).siblings('.custom-file-label');

                const fileName = label.find('.file-name');

                fileName.text(file.name);


                let preview = $('#intro_uploaded_img');


                /*
                |--------------------------------------------------------------------------
                | Create Preview If It Does Not Exist
                |--------------------------------------------------------------------------
                */

                if (!preview.length) {

                    preview = $('<img>', {
                        id: 'intro_uploaded_img',
                        class: 'file-preview',
                        alt: 'Intro Image'
                    });

                    label.append(preview);

                }


                /*
                |--------------------------------------------------------------------------
                | Update Preview
                |--------------------------------------------------------------------------
                */

                preview.attr(
                    'src',
                    URL.createObjectURL(file)
                );

            });



            /*
            |--------------------------------------------------------------------------
            | CTA Background Image
            |--------------------------------------------------------------------------
            */

            $('#cta_background_image').on('change', function() {

                if (!this.files || !this.files[0]) {
                    return;
                }

                const file = this.files[0];

                const label = $(this).siblings('.custom-file-label');

                const fileName = label.find('.file-name');

                fileName.text(file.name);


                let preview = $('#cta_uploaded_img');


                /*
                |--------------------------------------------------------------------------
                | Create Preview If It Does Not Exist
                |--------------------------------------------------------------------------
                */

                if (!preview.length) {

                    preview = $('<img>', {
                        id: 'cta_uploaded_img',
                        class: 'file-preview',
                        alt: 'CTA Background Image'
                    });

                    label.append(preview);

                }


                /*
                |--------------------------------------------------------------------------
                | Update Preview
                |--------------------------------------------------------------------------
                */

                preview.attr(
                    'src',
                    URL.createObjectURL(file)
                );

            });


        });
    </script>
@endpush
