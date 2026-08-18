@extends('admin.layouts.app')
@section('title', 'View ' . 'Gallery Category')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">View Gallery Category</h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Name:</div>
                <div class="col-md-9">{{ $galleryCategory->name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Sort Order:</div>
                <div class="col-md-9">{{ $galleryCategory->sort_order }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Status:</div>
                <div class="col-md-9">
                    @php
                        $class = match ($galleryCategory->status) {
                            \App\Enums\Status::ACTIVE => 'success',
                            \App\Enums\Status::INACTIVE => 'danger',
                        };
                    @endphp

                    <span class="badge badge-{{ $class }}">
                        {{ $galleryCategory->status->label() }}
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Created At:</div>
                <div class="col-md-9">{{ $galleryCategory->created_at->format('d M Y, h:i A') }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Updated At:</div>
                <div class="col-md-9">{{ $galleryCategory->updated_at->format('d M Y, h:i A') }}</div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.gallery-categories.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('admin.gallery-categories.edit', $galleryCategory) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection