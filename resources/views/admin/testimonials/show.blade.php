@extends('admin.layouts.app')
@section('title', 'View ' . 'Testimonial')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">View Testimonial</h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Resort:</div>
                <div class="col-md-9">{{ $testimonial->resort->name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Title:</div>
                <div class="col-md-9">{{ $testimonial->title }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Content:</div>
                <div class="col-md-9">
                    {!! nl2br(e($testimonial->content)) !!}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Customer Image:</div>
                <div class="col-md-9">
                    @if($testimonial->customer_image)
                        <img src="{{ asset('uploads/testimonials/' . $testimonial->customer_image) }}"
                            alt="{{ $testimonial->name }}"
                            class="img-thumbnail"
                            width="250">
                    @else
                        <span class="text-muted">No image available</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Customer Name:</div>
                <div class="col-md-9">{{ $testimonial->customer_name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Customer Place:</div>
                <div class="col-md-9">{{ $testimonial->customer_place }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Sort Order:</div>
                <div class="col-md-9">{{ $testimonial->sort_order }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Status:</div>
                <div class="col-md-9">
                    @php
                        $class = match ($testimonial->status) {
                            \App\Enums\Status::ACTIVE => 'success',
                            \App\Enums\Status::INACTIVE => 'danger',
                        };
                    @endphp

                    <span class="badge badge-{{ $class }}">
                        {{ $testimonial->status->label() }}
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Created At:</div>
                <div class="col-md-9">{{ $testimonial->created_at->format('d M Y, h:i A') }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Updated At:</div>
                <div class="col-md-9">{{ $testimonial->updated_at->format('d M Y, h:i A') }}</div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection