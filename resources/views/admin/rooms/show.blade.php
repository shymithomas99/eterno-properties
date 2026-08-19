@extends('admin.layouts.app')

@section('title', 'View Room')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Room</h1>
            <a href="{{ route('admin.rooms.index', $type) }}" class="btn btn-secondary btn-sm">Back</a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Name:</div>
                    <div class="col-md-9">{{ $room->name }}</div>
                </div>
                @if ((int) $type === 2)
                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">Slug:</div>
                        <div class="col-md-9">{{ $room->slug }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">Bed Type:</div>
                        <div class="col-md-9">{{ $room->bed_type }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">Guests:</div>
                        <div class="col-md-9">{{ $room->guests }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">Size:</div>
                        <div class="col-md-9">{{ $room->size }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">View:</div>
                        <div class="col-md-9">{{ $room->view }}</div>
                    </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Description:</div>
                    <div class="col-md-9">{!! nl2br(e($room->description)) !!}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Image:</div>
                    <div class="col-md-9">
                        @if ($room->main_image)
                            <img src="{{ asset('uploads/rooms/' . $room->main_image) }}" class="img-thumbnail"
                                width="250" alt="{{ $room->name }}">
                        @else
                            <span class="text-muted">No image available</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Sort Order:</div>
                    <div class="col-md-9">{{ $room->sort_order }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Status:</div>
                    <div class="col-md-9"><span
                            class="badge badge-{{ $room->status === \App\Enums\Status::ACTIVE ? 'success' : 'danger' }}">{{ $room->status->label() }}</span>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.rooms.edit', ['type' => $type, 'room' => $room]) }}"
                    class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
@endsection
