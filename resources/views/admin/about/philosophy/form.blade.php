@extends('admin.layouts.app')

@section('title', $philosophy->exists ? 'Edit Philosophy' : 'Add Philosophy')

@section('content')

    @use(App\Enums\AboutStatus)

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">

                {{ $philosophy->exists ? 'Edit Philosophy' : 'Add Philosophy' }}

            </h1>

            <a href="{{ route('admin.philosophies.index') }}" class="btn btn-secondary btn-sm">

                <i class="fa fa-arrow-left"></i>

                Back

            </a>

        </div>


        <div class="card shadow">

            <div class="card-body">

                <form
                    action="{{ $philosophy->exists ? route('admin.philosophies.update', $philosophy) : route('admin.philosophies.store') }}"
                    method="POST" enctype="multipart/form-data">

                    @csrf

                    @if ($philosophy->exists)
                        @method('PUT')
                    @endif

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label><strong>Title <span class="text-danger">*</span></strong></label>

                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $philosophy->title) }}">

                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label><strong>Sort Order <span class="text-danger">*</span></strong></label>

                                <input type="number" name="sort_order" class="form-control"
                                    value="{{ old('sort_order', $philosophy->sort_order ?? 0) }}">

                                @error('sort_order')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <label><strong>Description <span class="text-danger">*</span></strong></label>

                                <textarea name="description" rows="5" class="form-control">{{ old('description', $philosophy->description) }}</textarea>

                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>

                        <div class="form-group col-md-6">

                            <label>
                                <strong>
                                    Icon Image (48 × 48 px, max 50 KB)
                                </strong>
                            </label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="icon_image" name="icon_image"
                                    accept="image/*"
                                    onchange="document.getElementById('uploaded_img').src = window.URL.createObjectURL(this.files[0])">
                                <label class="custom-file-label" for="icon_image">
                                    {{ $philosophy->icon_image ?: 'Choose file' }}
                                </label>
                            </div>
                            <img id="uploaded_img"
                                src="{{ $philosophy->icon_image ? asset($philosophy->icon_image) : asset('img/upload_image.png') }}">
                            @error('icon_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>






                        <div class="form-group col-md-6">

                            <label>
                                <strong>Status</strong>
                            </label>

                            {{-- Hidden value for Inactive --}}
                            <input type="hidden" name="status" value="{{ AboutStatus::INACTIVE->value }}">

                            <div class="custom-control custom-switch">

                                <input type="checkbox" class="custom-control-input" id="status" name="status"
                                    value="{{ AboutStatus::ACTIVE->value }}"
                                    {{ old('status', $philosophy->status?->value ?? AboutStatus::ACTIVE->value) == AboutStatus::ACTIVE->value
                                        ? 'checked'
                                        : '' }}>

                                <label class="custom-control-label" for="status">
                                    <span id="status-text">
                                        {{ old('status', $philosophy->status?->value ?? AboutStatus::ACTIVE->value) == AboutStatus::ACTIVE->value
                                            ? 'Active'
                                            : 'Inactive' }}
                                    </span>
                                </label>


                            </div>

                        </div>

                    </div>

                    <hr>

                    <button class="btn btn-primary">

                        <i class="fa fa-save"></i>

                        {{ $philosophy->exists ? 'Update' : 'Save' }}

                    </button>

                    <a href="{{ route('admin.philosophies.index') }}" class="btn btn-secondary">

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

@endsection

@push('style')
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

    <script>
        document.getElementById('status').addEventListener('change', function() {
            document.getElementById('status-text').textContent =
                this.checked ? 'Active' : 'Inactive';
        });
    </script>
@endpush
