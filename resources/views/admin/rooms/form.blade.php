@extends('admin.layouts.app')

@section('title', ($room->id ? 'Edit ' : 'Add ') . 'Room')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ $room->id ? 'Edit' : 'Add' }} Room
            </h1>
        </div>

        <div class="card shadow mb-4">

            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">
                    Room Details
                </h6>
            </div>

            <div class="card-body">

                <form method="POST"
                    action="{{ $room->id ? route('admin.rooms.update', $room) : route('admin.rooms.store') }}"
                    enctype="multipart/form-data">

                    @csrf

                    @if ($room->id)
                        @method('PUT')
                    @endif

                    <div class="row">

                        {{-- Room Name --}}
                        <div class="col-md-6 mb-3">

                            <label for="name">
                                Room Name <span class="text-danger">*</span>
                            </label>

                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name', $room->name) }}" required>

                            @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Slug --}}
                        <div class="col-md-6 mb-3">

                            <label for="slug">
                                Slug <span class="text-danger">*</span>
                            </label>

                            <input type="text" id="slug" name="slug" class="form-control"
                                value="{{ old('slug', $room->slug) }}" required>

                            @error('slug')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Description --}}
                        <div class="col-md-12 mb-3">

                            <label for="description">
                                Description
                            </label>

                            <textarea id="description" name="description" rows="5" class="form-control">{{ old('description', $room->description) }}</textarea>

                            @error('description')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Bed --}}
                        <div class="col-md-3 mb-3">

                            <label for="bed_type">
                                Bed Type
                            </label>

                            <input type="text" id="bed_type" name="bed_type" class="form-control" placeholder="King Bed"
                                value="{{ old('bed_type', $room->bed_type) }}">

                        </div>


                        {{-- Guests --}}
                        <div class="col-md-3 mb-3">

                            <label for="guests">
                                Guests
                            </label>

                            <input type="text" id="guests" name="guests" class="form-control" placeholder="3 Adults"
                                value="{{ old('guests', $room->guests) }}">

                        </div>


                        {{-- Size --}}
                        <div class="col-md-3 mb-3">

                            <label for="size">
                                Room Size
                            </label>

                            <input type="text" id="size" name="size" class="form-control"
                                placeholder="350 sq.ft." value="{{ old('size', $room->size) }}">

                        </div>


                        {{-- View --}}
                        <div class="col-md-3 mb-3">

                            <label for="view">
                                View
                            </label>

                            <input type="text" id="view" name="view" class="form-control"
                                placeholder="Valley View" value="{{ old('view', $room->view) }}">

                        </div>


                        {{-- Main Image --}}
                        <div class="col-md-6 mb-3">

                            <label for="main_image">
                                Main Image
                            </label>

                            <input type="file" id="main_image" name="main_image" class="form-control" accept="image/*">

                            @if ($room->main_image)
                                <div class="mt-2">

                                    <img id="imagePreview" src="{{ asset('uploads/rooms/' . $room->main_image) }}"
                                        width="150" height="100" style="object-fit:cover;">

                                </div>
                            @endif

                            @error('main_image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Sort Order --}}
                        <div class="col-md-3 mb-3">

                            <label for="sort_order">
                                Sort Order
                            </label>

                            <input type="number" id="sort_order" name="sort_order" class="form-control" min="0"
                                value="{{ old('sort_order', $room->sort_order ?? 0) }}">

                        </div>


                        {{-- Published --}}
                        <div class="col-md-3 mb-3 d-flex align-items-center">

                            <div class="form-check">

                                <input type="checkbox" class="form-check-input" id="published" name="published"
                                    value="1" {{ old('published', $room->published ?? true) ? 'checked' : '' }}>

                                <label class="form-check-label" for="published">
                                    Published
                                </label>

                            </div>

                        </div>

                    </div>


                    <hr>

                    <button type="submit" class="btn btn-primary">
                        {{ $room->id ? 'Update and Continue' : 'Save and Continue' }}
                    </button>

                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </form>

            </div>

        </div>

    </div>

@endsection


@push('scripts')
    <script>
        document.getElementById('main_image').addEventListener('change', function() {

            if (this.files && this.files[0]) {

                document.getElementById('imagePreview').src =
                    window.URL.createObjectURL(this.files[0]);

            }

        });


        // Generate slug automatically

        document.getElementById('name').addEventListener('input', function() {

            const slug = document.getElementById('slug');

            if (!slug.dataset.edited) {

                slug.value = this.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');

            }

        });

        document.getElementById('slug').addEventListener('input', function() {
            this.dataset.edited = 'true';
        });
    </script>
@endpush
