@extends('admin.layouts.app')

@section('title', 'Room Gallery')

@section('content')

    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">
                    Upload / Delete Gallery Images
                </h6>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-12 mb-4">
                        <label><strong>Gallery Images (850 × 630 px, max 100 KB) <span
                                    class="text-danger">*</span></strong></label>

                        <div class="input-images-1"></div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-12">

                        <a href="{{ route('admin.rooms.index', $type) }}" class="btn btn-primary">
                            Done
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection


@push('style')
    {{-- Toastr CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

    {{-- Image uploader CSS --}}
    <link href="{{ asset('css/image-uploader.min.css') }}" rel="stylesheet" type="text/css">
@endpush


@push('script')
    {{-- Toastr JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

    {{-- Image uploader JS --}}
    <script src="{{ asset('js/image-upload.js') }}"></script>

    <script>
        $(document).ready(function() {

            let preloaded = [];

            @if ($room->galleryImages && $room->galleryImages->isNotEmpty())

                @foreach ($room->galleryImages as $gallery)

                    preloaded.push({
                        id: {{ $gallery->id }},
                        src: "{{ asset('uploads/rooms/gallery-images/' . $gallery->image) }}"
                    });
                @endforeach
            @endif


            $('.input-images-1').imageUploader({

                /*
                Existing images
                */
                preloaded: preloaded,

                /*
                Name of file input
                */
                imagesInputName: 'gallery_images',

                /*
                Name used for existing image IDs
                */
                preloadedInputName: 'old',

                /*
                Delete existing/new image
                */
                deleteUrl: "{{ route('admin.rooms.delete-image', $type) }}",

                /*
                Upload image
                */
                uploadUrl: "{{ route('admin.rooms.upload-image', $type) }}",

                /*
                Room ID
                */
                id: {{ $room->id }}

            });

        });
    </script>
@endpush
