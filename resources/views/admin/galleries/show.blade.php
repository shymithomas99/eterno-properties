@extends('admin.layouts.app')
@section('title', 'View ' . 'Gallery')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">View Gallery</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
        @if($type === '2')    
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Resort:</div>
                <div class="col-md-9">{{ $gallery->resort->name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Category:</div>
                <div class="col-md-9">{{ $gallery->galleryCategory->name }}</div>
            </div>
        @endif

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Image:</div>
                <div class="col-md-9">
                    @if($gallery->image)
                        <img src="{{ asset('uploads/galleries/' . $gallery->image) }}"
                            alt="{{ $gallery->name }}"
                            class="img-thumbnail"
                            width="250">
                    @else
                        <span class="text-muted">No image available</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Sort Order:</div>
                <div class="col-md-9">{{ $gallery->sort_order }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Status:</div>
                <div class="col-md-9">
                    @php
                        $class = match ($gallery->status) {
                            \App\Enums\Status::ACTIVE => 'success',
                            \App\Enums\Status::INACTIVE => 'danger',
                        };
                    @endphp

                    <span class="badge badge-{{ $class }}">
                        {{ $gallery->status->label() }}
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Created At:</div>
                <div class="col-md-9">{{ $gallery->created_at->format('d M Y, h:i A') }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Updated At:</div>
                <div class="col-md-9">{{ $gallery->updated_at->format('d M Y, h:i A') }}</div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.galleries.index', ['type' => $type]) }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('admin.galleries.edit', ['type' => $type, 'gallery' => $gallery]) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection