@extends('admin.layouts.app')
@section('title', ($gallery->id ? 'Edit ' : 'Add ') . 'Gallery')
@section('content')

    @use(App\Enums\Status)

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">
            {{ $gallery->id ? 'Edit ' : 'Add ' }} Gallery
        </h1>

        <form method="POST"
            action="{{ $gallery->id ? route('admin.galleries.update', ['type' => $type, 'gallery' => $gallery]) : route('admin.galleries.store', ['type' => $type]) }}"
            enctype="multipart/form-data">
            @csrf
            {{ $gallery->id ? method_field('PUT') : '' }}
            <div class="card shadow mb-4">
                <div class="card-body">

                    <!-- <h3 class="font-size-lg text-dark font-weight-bold mb-3">Gallery</h3> -->
                    <div class="row">
                        @if ($type === '2')
                            <div class="form-group col-md-6">
                                <label><strong>Resort <span class="text-danger">*</span></strong></label>
                                <select name="resort_id" id="resort_id" class="form-control">
                                    <option value="">-- Select Resort --</option>
                                    @foreach ($resorts as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ old('resort_id', $gallery->resort_id ?? '') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('resort_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label><strong>Category <span class="text-danger">*</span></strong></label>
                                <select name="gallery_category_id" id="gallery_category_id" class="form-control">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($galleryCategories as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ old('gallery_category_id', $gallery->gallery_category_id ?? '') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('gallery_category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endif

                        <div class="form-group col-md-6">
                            <label>
                                <strong>
                                    Image

                                    @if ($type == 1)
                                        (370 × 546 px, max 200 KB)
                                    @elseif ($type == 2)
                                        (1000 × 750 px, max 200 KB)
                                    @elseif ($type == 3)
                                        (294 × 294 px, max 200 KB)
                                    @endif
                                    <span class="text-danger">*</span>
                                </strong>

                            </label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="image" name="image"
                                    accept="image/*"
                                    onchange="document.getElementById('uploaded_img').src = window.URL.createObjectURL(this.files[0])">
                                <label class="custom-file-label" for="image">
                                    {{ $gallery->image ?: 'Choose file' }}
                                </label>
                            </div>
                            <img id="uploaded_img"
                                src="{{ $gallery->image ? asset('uploads/galleries/' . $gallery->image) : asset('img/upload_image.png') }}">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label><strong>Sort Order <span class="text-danger">*</span></strong></label>
                            <input type="number" name="sort_order" class="form-control"
                                value="{{ old('sort_order', $gallery->sort_order) }}">
                            @error('sort_order')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label><strong>Status</strong></label>
                            <input type="hidden" name="status" value="{{ Status::INACTIVE->value }}">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status" name="status"
                                    value="{{ Status::ACTIVE->value }}"
                                    {{ old('status', $gallery->status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status">
                                    <span id="status-text">
                                        {{ old('status', $gallery->status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'Active' : 'Inactive' }}
                                    </span>
                                </label>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="form-group col-6">
                            <button type="submit"
                                class="btn btn-primary mr-3">{{ $gallery->id ? 'Update' : 'Save' }}</button>
                            <a class="btn btn-secondary ml-3"
                                href="{{ route('admin.galleries.index', ['type' => $type]) }}">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
    <!-- /.container-fluid -->
@endsection

@push('style')
@endpush

@push('script')
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
