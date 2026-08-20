@extends('admin.layouts.app')

@section('title', ($offer->id ? 'Edit ' : 'Add ') . 'Offer')

@section('content')

    @use(App\Enums\Status)

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">
            {{ $offer->id ? 'Edit ' : 'Add ' }} Offer
        </h1>

        <form method="POST"
            action="{{ $offer->id
                ? route('admin.offers.update', ['type' => $type, 'offer' => $offer])
                : route('admin.offers.store', ['type' => $type]) }}"
            enctype="multipart/form-data">

            @csrf

            @if ($offer->id)
                @method('PUT')
            @endif

            <div class="card shadow mb-4">

                <div class="card-body">

                    <div class="row">

                        {{-- ========================================================= --}}
                        {{-- TYPE 2 - TITLE --}}
                        {{-- ========================================================= --}}

                        @if ($type === 2)
                            <div class="form-group col-md-6">

                                <label>
                                    <strong>
                                        Title
                                        <span class="text-danger">*</span>
                                    </strong>
                                </label>

                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $offer->title) }}">

                                @error('title')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>
                        @endif


                        {{-- ========================================================= --}}
                        {{-- TYPE 2 - DESCRIPTION --}}
                        {{-- ========================================================= --}}

                        @if ($type === 2)
                            <div class="form-group col-md-6">

                                <label>
                                    <strong>
                                        Description
                                        <span class="text-danger">*</span>
                                    </strong>
                                </label>

                                <textarea name="description" rows="3" class="form-control">{{ old('description', $offer->description) }}</textarea>

                                @error('description')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>
                        @endif


                        {{-- ========================================================= --}}
                        {{-- IMAGE --}}
                        {{-- ========================================================= --}}

                        <div class="form-group col-md-6">

                            <label>
                                <strong>
                                    Image

                                    @if ($type === 1)
                                        (648 × 592 px, max 200 KB)
                                    @elseif ($type === 2)
                                        (800 × 533 px, max 200 KB)
                                    @endif

                                    <span class="text-danger">*</span>
                                </strong>
                            </label>

                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="image" name="image"
                                    accept="image/jpeg,image/jpg,image/png,image/webp">

                                <label class="custom-file-label" for="image">

                                    {{ $offer->image ?: 'Choose file' }}

                                </label>

                            </div>

                            <img id="uploaded_img"
                                src="{{ $offer->image ? asset('uploads/offers/' . $offer->image) : asset('img/upload_image.png') }}"
                                class="img-thumbnail" style="max-width: 300px; max-height: 250px; object-fit: contain;">

                            @error('image')
                                <small class="text-danger d-block mt-2">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- ========================================================= --}}
                        {{-- BUTTON TEXT --}}
                        {{-- ========================================================= --}}

                        <div class="form-group col-md-6">

                            <label>
                                <strong>
                                    Button Text
                                    <span class="text-danger">*</span>
                                </strong>
                            </label>

                            <input type="text" name="button_text" class="form-control"
                                value="{{ old('button_text', $offer->button_text) }}">

                            @error('button_text')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- ========================================================= --}}
                        {{-- SORT ORDER --}}
                        {{-- ========================================================= --}}

                        <div class="form-group col-md-6">

                            <label>
                                <strong>
                                    Sort Order
                                    <span class="text-danger">*</span>
                                </strong>
                            </label>

                            <input type="number" name="sort_order" class="form-control" min="1"
                                value="{{ old('sort_order', $offer->sort_order) }}">

                            @error('sort_order')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- ========================================================= --}}
                        {{-- TYPE 2 - OFFER CONTENT --}}
                        {{-- ========================================================= --}}

                        @if ($type === 2)
                            <div class="form-group col-md-6">

                                <label>
                                    <strong>
                                        Offer Content
                                    </strong>
                                </label>

                                <textarea name="content" id="offerContent" class="form-control" rows="10">{{ old('content', $offer->content) }}</textarea>

                                @error('content')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>
                        @endif


                        {{-- ========================================================= --}}
                        {{-- TYPE 1 - BUTTON URL --}}
                        {{-- ========================================================= --}}

                        @if ($type === 1)
                            <div class="form-group col-md-6">

                                <label>
                                    <strong>
                                        Button URL
                                        <span class="text-danger">*</span>
                                    </strong>
                                </label>

                                <input type="url" name="button_url" class="form-control"
                                    placeholder="https://example.com" value="{{ old('button_url', $offer->button_url) }}">

                                @error('button_url')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>
                        @endif


                        {{-- ========================================================= --}}
                        {{-- STATUS --}}
                        {{-- ========================================================= --}}

                        <div class="form-group col-md-6">

                            <label>
                                <strong>Status</strong>
                            </label>

                            {{-- Inactive when checkbox is unchecked --}}
                            <input type="hidden" name="status" value="{{ Status::INACTIVE->value }}">

                            <div class="custom-control custom-switch">

                                <input type="checkbox" class="custom-control-input" id="status" name="status"
                                    value="{{ Status::ACTIVE->value }}"
                                    {{ old('status', $offer->status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'checked' : '' }}>

                                <label class="custom-control-label" for="status">

                                    <span id="status-text">

                                        {{ old('status', $offer->status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value
                                            ? 'Active'
                                            : 'Inactive' }}

                                    </span>

                                </label>

                            </div>

                            @error('status')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- FOOTER --}}
                {{-- ========================================================= --}}

                <div class="card-footer">

                    <button type="submit" class="btn btn-primary mr-2">

                        {{ $offer->id ? 'Update' : 'Save' }}

                    </button>

                    <a class="btn btn-secondary" href="{{ route('admin.offers.index', ['type' => $type]) }}">

                        Cancel

                    </a>

                </div>

            </div>

        </form>

    </div>

@endsection


@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css">
@endpush


@push('script')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>


    {{-- ========================================================= --}}
    {{-- IMAGE PREVIEW --}}
    {{-- ========================================================= --}}

    <script>
        $(document).ready(function() {

            $('#image').on('change', function(event) {

                const file = event.target.files[0];

                if (file) {

                    $('#uploaded_img').attr(
                        'src',
                        URL.createObjectURL(file)
                    );

                    $(this)
                        .siblings('.custom-file-label')
                        .addClass('selected')
                        .html(file.name);
                }

            });

        });
    </script>


    {{-- ========================================================= --}}
    {{-- SUMMERNOTE --}}
    {{-- ========================================================= --}}

    @if ($type === 2)
        <script>
            $(document).ready(function() {

                $('#offerContent').summernote({

                    height: 300,

                    placeholder: 'Enter the full offer details...',

                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]

                });

            });
        </script>
    @endif


    {{-- ========================================================= --}}
    {{-- STATUS SWITCH --}}
    {{-- ========================================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const status = document.getElementById('status');
            const statusText = document.getElementById('status-text');

            if (status && statusText) {

                status.addEventListener('change', function() {

                    statusText.textContent =
                        this.checked ?
                        'Active' :
                        'Inactive';

                });

            }

        });
    </script>

@endpush
