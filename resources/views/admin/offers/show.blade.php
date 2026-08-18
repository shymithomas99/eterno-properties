@extends('admin.layouts.app')
@section('title', 'View ' . 'Offer')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">View Offer</h1>

        <div class="card shadow mb-4">
            <div class="card-body">

                @if ($type === '2')
                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">Resort:</div>
                        <div class="col-md-9">{{ $offer->resort->name }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">Title:</div>
                        <div class="col-md-9">{{ $offer->title }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">Description:</div>
                        <div class="col-md-9">
                            {!! nl2br(e($offer->description)) !!}
                        </div>
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Image:</div>
                    <div class="col-md-9">
                        @if ($offer->image)
                            <img src="{{ asset('uploads/offers/' . $offer->image) }}" alt="{{ $offer->name }}"
                                class="img-thumbnail" width="250">
                        @else
                            <span class="text-muted">No image available</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Button Text:</div>
                    <div class="col-md-9">
                        {{ $offer->button_text }}
                    </div>
                </div>
                @if ($type === '2')
                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">Content:</div>
                        <div class="col-md-9">
                            {{ $offer->content }}
                        </div>
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Button URL:</div>
                    <div class="col-md-9">
                        <a href="{{ $offer->button_url }}" target="_blank">
                            {{ $offer->button_url }}
                        </a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Sort Order:</div>
                    <div class="col-md-9">{{ $offer->sort_order }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Status:</div>
                    <div class="col-md-9">
                        @php
                            $class = match ($offer->status) {
                                \App\Enums\Status::ACTIVE => 'success',
                                \App\Enums\Status::INACTIVE => 'danger',
                            };
                        @endphp

                        <span class="badge badge-{{ $class }}">
                            {{ $offer->status->label() }}
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Created At:</div>
                    <div class="col-md-9">{{ $offer->created_at->format('d M Y, h:i A') }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Updated At:</div>
                    <div class="col-md-9">{{ $offer->updated_at->format('d M Y, h:i A') }}</div>
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('admin.offers.index', ['type' => $type]) }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('admin.offers.edit', ['type' => $type, 'offer' => $offer]) }}"
                    class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
@endsection
