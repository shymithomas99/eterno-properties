@extends('admin.layouts.app')
@section('title', ($offer->id ? 'Edit ' : 'Add ') . 'Offer')
@section('content')

    @use(App\Enums\Status)

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">
            {{ $offer->id ? 'Edit ' : 'Add ' }} Offer
        </h1>

        <form method="POST"
            action="{{ $offer->id ? route('admin.offers.update', ['type' => $type, 'offer' => $offer]) : route('admin.offers.store', ['type' => $type]) }}"
            enctype="multipart/form-data">
            @csrf
            {{ $offer->id ? method_field('PUT') : '' }}
            <div class="card shadow mb-4">
                <div class="card-body">

                    <!-- <h3 class="font-size-lg text-dark font-weight-bold mb-3">Offer</h3> -->
                    <div class="row">
                        @if ($type === '2')
                            <div class="form-group col-md-6">
                                <label><strong>Resort <span class="text-danger">*</span></strong></label>
                                <select name="resort_id" id="resort_id" class="form-control">
                                    <option value="">-- Select Resort --</option>
                                    @foreach ($resorts as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ old('resort_id', $offer->resort_id ?? '') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('resort_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label><strong>Title <span class="text-danger">*</span></strong></label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $offer->title) }}">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label><strong>Description <span class="text-danger">*</span></strong></label>
                                <textarea name="description" rows="3" class="form-control">{{ old('description', $offer->description) }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                        @endif

                        <div class="form-group col-md-6">
                            {{--  <label><strong>Image (Recommended dimensions: 800 × 800 px) <span class="text-danger">*</strong></label>  --}}
                            <label>
                                <strong>
                                    Image

                                    @if ($type == 1)
                                        (648 × 592 px, max 200 KB)
                                    @elseif ($type == 2)
                                        (800 × 533 px, max 200 KB)
                                    @endif

                                    <span class="text-danger">*</span>
                                </strong>
                            </label>


                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="image" name="image"
                                    accept="image/*"
                                    onchange="document.getElementById('uploaded_img').src = window.URL.createObjectURL(this.files[0])">
                                <label class="custom-file-label" for="image">
                                    {{ $offer->image ?: 'Choose file' }}
                                </label>
                            </div>
                            <img id="uploaded_img"
                                src="{{ $offer->image ? asset('uploads/offers/' . $offer->image) : asset('img/upload_image.png') }}">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><strong>Button Text <span class="text-danger">*</span></strong></label>
                            <input type="text" name="button_text" class="form-control"
                                value="{{ old('button_text', $offer->button_text) }}">
                            @error('button_text')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><strong>Sort Order <span class="text-danger">*</span></strong></label>
                            <input type="number" name="sort_order" class="form-control"
                                value="{{ old('sort_order', $offer->sort_order) }}">
                            @error('sort_order')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        @if ($type === '2')
                            <div class="form-group col-md-6">
                                <label>
                                    <strong>Offer Content</strong>
                                </label>
                                <textarea name="content" id="offerContent" class="form-control" rows="10">{{ old('content', $offer->content) }}</textarea>

                                @error('content')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endif
                        @if ($type === '1')
                            <div class="form-group col-md-6">
                                <label><strong>Button URL <span class="text-danger">*</span></strong></label>
                                <input type="text" name="button_url" class="form-control"
                                    value="{{ old('button_url', $offer->button_url) }}">
                                @error('button_url')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endif



                        <div class="form-group col-md-6">
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

                <div class="card-footer">
                    <div class="row">
                        <div class="form-group col-6">
                            <button type="submit"
                                class="btn btn-primary mr-3">{{ $offer->id ? 'Update' : 'Save' }}</button>
                            <a class="btn btn-secondary ml-3"
                                href="{{ route('admin.offers.index', ['type' => $type]) }}">Cancel</a>
                        </div>
                    </div>
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
