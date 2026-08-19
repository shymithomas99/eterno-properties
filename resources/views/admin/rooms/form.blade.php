@extends('admin.layouts.app')

@section('title', ($room->id ? 'Edit ' : 'Add ') . 'Room')

@section('content')

    @use(App\Enums\Status)

    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                {{ $room->id ? 'Edit' : 'Add' }} Room
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
        <form method="POST"
            action="{{ $room->id ? route('admin.rooms.update', ['type' => $type, 'room' => $room]) : route('admin.rooms.store', $type) }}"
            enctype="multipart/form-data">

            @csrf

            @if ($room->id)
                @method('PUT')
            @endif


            {{-- =========================================================
                 ROOM DETAILS
            ========================================================== --}}
            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">
                        Room Details
                    </h6>

                </div>


                <div class="card-body">

                    <div class="row">

                        {{-- Room Name --}}
                        <div class="col-md-6 mb-3">

                            <label for="name">
                                <strong>
                                    Room Name
                                    <span class="text-danger">*</span>
                                </strong>
                            </label>

                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name', $room->name) }}" placeholder="Enter room name" required>

                            @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Slug (rooms page only) --}}
                        @if ((int) $type === 2)
                            <div class="col-md-6 mb-3">

                                <label for="slug">
                                    <strong>
                                        Slug
                                        <span class="text-danger">*</span>
                                    </strong>
                                </label>

                                <input type="text" id="slug" name="slug" class="form-control"
                                    value="{{ old('slug', $room->slug) }}" placeholder="room-slug" required>

                                @error('slug')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>
                        @endif


                        {{-- Description --}}
                        <div class="col-md-12 mb-3">

                            <label for="description">
                                <strong>
                                    Description
                                </strong>
                            </label>

                            <textarea id="description" name="description" rows="5" class="form-control" placeholder="Enter room description">{{ old('description', $room->description) }}</textarea>

                            @error('description')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            @if ((int) $type === 2)
                {{-- =========================================================
                     ROOM INFORMATION
                 ========================================================== --}}
                <div class="card shadow mb-4">

                    <div class="card-header py-3">

                        <h6 class="m-0 font-weight-bold text-primary">
                            Room Information
                        </h6>

                    </div>


                    <div class="card-body">

                        <div class="row">

                            {{-- Bed --}}
                            <div class="col-md-3 mb-3">

                                <label for="bed_type">
                                    <strong>
                                        Bed Type
                                    </strong>
                                </label>

                                <input type="text" id="bed_type" name="bed_type" class="form-control"
                                    placeholder="King Bed" value="{{ old('bed_type', $room->bed_type) }}">

                                @error('bed_type')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>


                            {{-- Guests --}}
                            <div class="col-md-3 mb-3">

                                <label for="guests">
                                    <strong>
                                        Guests
                                    </strong>
                                </label>

                                <input type="text" id="guests" name="guests" class="form-control"
                                    placeholder="3 Adults" value="{{ old('guests', $room->guests) }}">

                                @error('guests')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>


                            {{-- Size --}}
                            <div class="col-md-3 mb-3">

                                <label for="size">
                                    <strong>
                                        Room Size
                                    </strong>
                                </label>

                                <input type="text" id="size" name="size" class="form-control"
                                    placeholder="350 sq.ft." value="{{ old('size', $room->size) }}">

                                @error('size')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>


                            {{-- View --}}
                            <div class="col-md-3 mb-3">

                                <label for="view">
                                    <strong>
                                        View
                                    </strong>
                                </label>

                                <input type="text" id="view" name="view" class="form-control"
                                    placeholder="Valley View" value="{{ old('view', $room->view) }}">

                                @error('view')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>
            @endif


            {{-- =========================================================
                 ROOM IMAGE & SETTINGS
            ========================================================== --}}
            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">
                        Room Image & Settings
                    </h6>

                </div>


                <div class="card-body">

                    <div class="row">

                        {{-- Main Image --}}
                        <div class="col-md-6 mb-3">
                            <label><strong>Main Image (850 × 630 px, max 100 KB) <span
                                        class="text-danger">*</span></strong></label>

                            <div class="custom-file">

                                <input type="file" class="custom-file-input" id="main_image" name="main_image"
                                    accept="image/jpeg,image/png,image/webp">


                                <label class="custom-file-label" for="main_image">

                                    <span class="file-name">

                                        {{ $room->main_image ? basename($room->main_image) : 'Choose file' }}

                                    </span>


                                    @if ($room->main_image)
                                        <img id="imagePreview" src="{{ asset('uploads/rooms/' . $room->main_image) }}"
                                            class="file-preview" alt="Room Image">
                                    @endif

                                </label>

                            </div>


                            @error('main_image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Sort Order --}}
                        <div class="col-md-3 mb-3">

                            <label for="sort_order">
                                <strong>
                                    Sort Order
                                </strong>
                            </label>

                            <input type="number" id="sort_order" name="sort_order" class="form-control" min="0"
                                value="{{ old('sort_order', $room->sort_order ?? 0) }}">

                            @error('sort_order')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        <div class="col-md-3 mb-3 d-flex align-items-center">
                            <label><strong>Status</strong></label>
                            <input type="hidden" name="status" value="{{ Status::INACTIVE->value }}">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status" name="status"
                                    value="{{ Status::ACTIVE->value }}"
                                    {{ old('status', $offer->status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status">
                                    <span id="status-text">
                                        {{ old('status', $offer->status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'Active' : 'Inactive' }}
                                    </span>
                                </label>
                            </div>



                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                 ACTION BUTTONS
            ========================================================== --}}
            <div class="text-right mb-4">

                <button type="submit" class="btn btn-primary">

                    <i class="fa fa-save"></i>

                    {{ $room->id ? 'Update' : 'Save' }}{{ (int) $type === 2 ? ' and Continue' : '' }}

                </button>


                <a href="{{ route('admin.rooms.index', $type) }}" class="btn btn-secondary">

                    <i class="fa fa-times"></i>

                    Cancel

                </a>

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


        .form-group label,
        .form-control+label {

            font-weight: 500;

        }


        .card-header {

            background-color: #f8f9fc;

        }


        .form-check-input {

            cursor: pointer;

        }


        .form-check-label {

            cursor: pointer;

        }
    </style>
@endpush

@push('script')
    <script>
        document.getElementById('status').addEventListener('change', function() {
            document.getElementById('status-text').textContent = this.checked ? 'Active' : 'Inactive';
        });
    </script>
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
            | Main Image Preview
            |--------------------------------------------------------------------------
            */

            $('#main_image').on('change', function() {

                if (!this.files || !this.files[0]) {
                    return;
                }


                const file = this.files[0];


                /*
                |--------------------------------------------------------------------------
                | File Label
                |--------------------------------------------------------------------------
                */

                const label = $(this)
                    .siblings('.custom-file-label');


                /*
                |--------------------------------------------------------------------------
                | File Name
                |--------------------------------------------------------------------------
                */

                const fileName = label.find('.file-name');

                fileName.text(file.name);


                /*
                |--------------------------------------------------------------------------
                | Existing Preview
                |--------------------------------------------------------------------------
                */

                let preview = $('#imagePreview');


                /*
                |--------------------------------------------------------------------------
                | Create Preview
                |--------------------------------------------------------------------------
                */

                if (!preview.length) {

                    preview = $('<img>', {

                        id: 'imagePreview',

                        class: 'file-preview',

                        alt: 'Room Image'

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
            | Generate Slug Automatically
            |--------------------------------------------------------------------------
            */

            $('#name').on('input', function() {

                const slug = $('#slug');


                if (!slug.data('edited')) {

                    slug.val(
                        $(this).val()
                        .toLowerCase()
                        .trim()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-')
                    );

                }

            });


            /*
            |--------------------------------------------------------------------------
            | Detect Manual Slug Editing
            |--------------------------------------------------------------------------
            */

            $('#slug').on('input', function() {

                $(this).data('edited', true);

            });


        });
    </script>

    <script type="text/javascript">
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>
        document.getElementById('status').addEventListener('change', function() {
            document.getElementById('status-text').textContent =
                this.checked ? 'Active' : 'Inactive';
        });
    </script>
@endpush
