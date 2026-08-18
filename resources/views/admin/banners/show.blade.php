@extends('admin.layouts.app')
@section('title', 'View ' . 'Banner')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">View Banner</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
        @if($type === '1')
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Title:</div>
                <div class="col-md-9">{{ $banner->title }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Description:</div>
                <div class="col-md-9">
                    {!! nl2br(e($banner->description)) !!}
                </div>
            </div>
        @else
        
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Image:</div>
                <div class="col-md-9">
                    @if($banner->image)
                        <img src="{{ asset('uploads/banners/' . $banner->image) }}"
                            alt="{{ $banner->name }}"
                            class="img-thumbnail"
                            width="250">
                    @else
                        <span class="text-muted">No image available</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Sort Order:</div>
                <div class="col-md-9">{{ $banner->sort_order }}</div>
            </div>
        @endif

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Status:</div>
                <div class="col-md-9">
                    @php
                        $class = match ($banner->status) {
                            \App\Enums\Status::ACTIVE => 'success',
                            \App\Enums\Status::INACTIVE => 'danger',
                        };
                    @endphp

                    <span class="badge badge-{{ $class }}">
                        {{ $banner->status->label() }}
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Created At:</div>
                <div class="col-md-9">{{ $banner->created_at->format('d M Y, h:i A') }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Updated At:</div>
                <div class="col-md-9">{{ $banner->updated_at->format('d M Y, h:i A') }}</div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.banners.index', ['type' => $type]) }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('admin.banners.edit', ['type' => $type, 'banner' => $banner]) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection