@extends('admin.layouts.app')

@section('title', ($experience->exists ? 'Edit' : 'Add') . ' Experience ' . ($type == 1 ? '(Home Page)' : '(Inner
    Page)'))

@section('content')

    @use(App\Enums\ExperienceStatus)

    <div class="container-fluid">

        {{-- Page Heading --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                {{ $experience->exists ? 'Edit' : 'Add' }}
                Experience
                {{ $type == 1 ? '(Home Page)' : '(Inner Page)' }}
            </h1>

            <a href="{{ route('admin.experience-items.index', $type) }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i>
                Back
            </a>

        </div>


        {{-- Card --}}
        <div class="card shadow mb-4">

            <div class="card-body">

                <form
                    action="{{ $experience->exists
                        ? route('admin.experience-items.update', [
                            'type' => $type,
                            'experience' => $experience,
                        ])
                        : route('admin.experience-items.store', $type) }}"
                    method="POST" enctype="multipart/form-data">

                    @csrf

                    @if ($experience->exists)
                        @method('PUT')
                    @endif


                    {{-- =====================================================
                        SUBTITLE + TITLE
                        Subtitle is only for Inner Page (type = 2)
                    ====================================================== --}}
                    <div class="row">

                        @if ($type == 2)
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        <strong>
                                            Subtitle
                                            <span class="text-danger">*</span>
                                        </strong>
                                    </label>

                                    <input type="text" name="subtitle" class="form-control"
                                        value="{{ old('subtitle', $experience->subtitle) }}">

                                    @error('subtitle')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                            </div>
                        @endif


                        <div class="{{ $type == 2 ? 'col-md-6' : 'col-md-12' }}">

                            <div class="form-group">

                                <label>
                                    <strong>
                                        Title
                                        <span class="text-danger">*</span>
                                    </strong>
                                </label>

                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $experience->title) }}">

                                @error('title')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- =====================================================
                        DESCRIPTION
                    ====================================================== --}}
                    <div class="form-group">

                        <label>
                            <strong>
                                Description
                                <span class="text-danger">*</span>
                            </strong>
                        </label>

                        <textarea name="description" rows="5" class="form-control">{{ old('description', $experience->description) }}</textarea>

                        @error('description')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- =====================================================
                        EXPERIENCE LIST
                        Only for Inner Page (type = 2)
                    ====================================================== --}}
                    @if ($type == 2)
                        <div class="form-group">

                            <label>
                                <strong>
                                    Experience List
                                </strong>
                            </label>

                            <small class="text-muted d-block mb-2">
                                Enter one item per line.
                            </small>

                            <textarea name="experience_list" rows="6" class="form-control">{{ old('experience_list', $experience->experience_list) }}</textarea>

                            @error('experience_list')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>
                    @endif


                    {{-- =====================================================
                        IMAGE + SORT ORDER + STATUS
                    ====================================================== --}}
                    <div class="row">

                        {{-- IMAGE --}}
                        <div class="{{ $type == 2 ? 'col-md-6' : 'col-md-8' }}">

                            <div class="form-group">

                                <label>
                                    <strong>
                                        Image

                                        @if ($type == 1)
                                            (48 × 48 px, max 50 KB)
                                        @elseif ($type == 2)
                                            (746 × 798 px, max 200 KB)
                                        @endif

                                        <span class="text-danger">*</span>
                                    </strong>
                                </label>

                                <div class="custom-file mb-3">

                                    <input type="file" class="custom-file-input" id="image" name="image"
                                        accept="image/*">

                                    <label class="custom-file-label" id="image-label" for="image">
                                        {{ $experience->image ? basename($experience->image) : 'Choose file' }}
                                    </label>

                                </div>


                                {{-- Image Preview --}}
                                <div>

                                    <img id="uploaded_img"
                                        src="{{ $experience->image ? asset('uploads/experience/items/' . $experience->image) : asset('img/upload_image.png') }}"
                                        width="150" height="150"
                                        style="
                                            object-fit: cover;
                                            border: 1px solid #ddd;
                                            padding: 3px;
                                        "
                                        alt="Image Preview">

                                </div>


                                @error('image')
                                    <small class="text-danger d-block mt-2">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- SORT ORDER --}}
                        <div class="{{ $type == 2 ? 'col-md-3' : 'col-md-2' }}">

                            <div class="form-group">

                                <label>
                                    <strong>
                                        Sort Order
                                        <span class="text-danger">*</span>
                                    </strong>
                                </label>

                                <input type="number" name="sort_order" class="form-control" min="1"
                                    value="{{ old('sort_order', $experience->sort_order ?? 1) }}">

                                @error('sort_order')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- STATUS --}}
                        <div class="{{ $type == 2 ? 'col-md-3' : 'col-md-2' }}">

                            <div class="form-group">

                                <label>
                                    <strong>
                                        Status
                                    </strong>
                                </label>

                                {{-- Inactive value when checkbox is unchecked --}}
                                <input type="hidden" name="status" value="{{ ExperienceStatus::INACTIVE->value }}">

                                <div class="custom-control custom-switch mt-2">

                                    <input type="checkbox" class="custom-control-input" id="status" name="status"
                                        value="{{ ExperienceStatus::ACTIVE->value }}"
                                        {{ old('status', $experience->status?->value ?? ExperienceStatus::ACTIVE->value) ==
                                        ExperienceStatus::ACTIVE->value
                                            ? 'checked'
                                            : '' }}>

                                    <label class="custom-control-label" for="status">
                                        <span id="status-text">
                                            {{ old('status', $experience->status?->value ?? ExperienceStatus::ACTIVE->value) ==
                                            ExperienceStatus::ACTIVE->value
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


                    <hr>


                    {{-- =====================================================
                        BUTTONS
                    ====================================================== --}}
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>

                        {{ $experience->exists ? 'Update' : 'Save' }}
                    </button>

                    <a href="{{ route('admin.experience-items.index', $type) }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </form>

            </div>

        </div>

    </div>

@endsection


@push('style')
    {{-- Toastr CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush


@push('script')
    {{-- Toastr JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    {{-- =====================================================
        TOASTR MESSAGES
    ====================================================== --}}
    <script>
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
    </script>


    {{-- =====================================================
        IMAGE PREVIEW + FILE NAME
    ====================================================== --}}
    <script>
        document.getElementById('image').addEventListener('change', function() {

            const file = this.files[0];

            if (!file) {
                return;
            }

            // Show file name
            document.getElementById('image-label').textContent = file.name;

            // Show image preview
            const preview = document.getElementById('uploaded_img');

            preview.src = URL.createObjectURL(file);

        });
    </script>


    {{-- =====================================================
        STATUS SWITCH
    ====================================================== --}}
    <script>
        document.getElementById('status').addEventListener('change', function() {

            document.getElementById('status-text').textContent =
                this.checked ? 'Active' : 'Inactive';

        });
    </script>
@endpush
