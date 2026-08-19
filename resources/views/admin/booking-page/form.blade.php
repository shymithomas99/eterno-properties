@extends('admin.layouts.app')

@section('title', 'Booking Page')

@section('content')

    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                Booking Page
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
        <form action="{{ route('admin.booking-page.update') }}" method="POST" enctype="multipart/form-data">

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

                            <label for="banner_title">

                                <strong>
                                    Banner Title
                                    <span class="text-danger">*</span>
                                </strong>

                            </label>

                            <input type="text" name="banner_title" id="banner_title" class="form-control"
                                value="{{ old('banner_title', $bookingPage->banner_title) }}"
                                placeholder="Enter banner title">

                            @error('banner_title')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Banner Image --}}
                        <div class="form-group col-md-6">

                            <label><strong>Banner Image (1920 × 700 px, max 200 KB) <span
                                        class="text-danger">*</span></strong></label>

                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="banner_image" name="banner_image"
                                    accept="image/jpeg,image/png,image/webp">


                                <label class="custom-file-label" for="banner_image">

                                    <span class="file-name">

                                        {{ $bookingPage->banner_image ? basename($bookingPage->banner_image) : 'Choose file' }}

                                    </span>


                                    @if ($bookingPage->banner_image)
                                        <img id="banner_uploaded_img"
                                            src="{{ asset('uploads/booking-page/' . $bookingPage->banner_image) }}"
                                            class="file-preview" alt="Booking Banner Image">
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

                            <label for="banner_description">

                                <strong>
                                    Banner Description
                                </strong>

                            </label>


                            <textarea name="banner_description" id="banner_description" rows="5" class="form-control"
                                placeholder="Enter banner description">{{ old('banner_description', $bookingPage->banner_description) }}</textarea>


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
            | Banner Image Preview
            |--------------------------------------------------------------------------
            */

            $('#banner_image').on('change', function() {

                if (!this.files || !this.files[0]) {
                    return;
                }


                const file = this.files[0];


                const label = $(this)
                    .siblings('.custom-file-label');


                const fileName = label.find('.file-name');


                /*
                |--------------------------------------------------------------------------
                | Show File Name
                |--------------------------------------------------------------------------
                */

                fileName.text(file.name);


                /*
                |--------------------------------------------------------------------------
                | Find Existing Preview
                |--------------------------------------------------------------------------
                */

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

                        alt: 'Booking Banner Image'

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
