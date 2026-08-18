@extends('admin.layouts.app')
@section('title', 'View ' . 'Resort')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">View Resort</h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Name:</div>
                <div class="col-md-9">{{ $resort->name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">URL:</div>
                <div class="col-md-9">{{ $resort->url }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Sort Order:</div>
                <div class="col-md-9">{{ $resort->sort_order }}</div>
            </div>

            {{-- Type 1 --}}
            @if($type === '1')

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Created At:</div>
                <div class="col-md-9">{{ $resort->created_at->format('d M Y, h:i A') }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Updated At:</div>
                <div class="col-md-9">{{ $resort->updated_at->format('d M Y, h:i A') }}</div>
            </div>

            {{-- Type 2 --}}
            @elseif($type === '2')

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Place:</div>
                    <div class="col-md-9">{{ $resort->home_place }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Title:</div>
                    <div class="col-md-9">{{ $resort->home_title }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Description:</div>
                    <div class="col-md-9">
                        {!! nl2br(e($resort->home_description)) !!}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Button Text:</div>
                    <div class="col-md-9">{{ $resort->home_button_text }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Button URL:</div>
                    <div class="col-md-9">
                        <a href="{{ $resort->home_button_url }}" target="_blank">
                            {{ $resort->home_button_url }}
                        </a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Image:</div>
                    <div class="col-md-9">
                        @if($resort->home_image)
                            <img src="{{ asset('uploads/resorts/'.$resort->home_image) }}"
                                 class="img-thumbnail"
                                 width="250">
                        @else
                            -
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Status:</div>
                    <div class="col-md-9">
                        @php
                            $class = match ($resort->home_status) {
                                \App\Enums\Status::ACTIVE => 'success',
                                \App\Enums\Status::INACTIVE => 'danger',
                            };
                        @endphp

                        <span class="badge badge-{{ $class }}">
                            {{ $resort->home_status->label() }}
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Created At:</div>
                    <div class="col-md-9">{{ $resort->created_at->format('d M Y, h:i A') }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Updated At:</div>
                    <div class="col-md-9">{{ $resort->home_updated_at->format('d M Y, h:i A') }}</div>
                </div>

            @endif

            {{-- Type 3 --}}
            @if($type === '3')

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Subtitle:</div>
                    <div class="col-md-9">{{ $resort->mega_menu_sub_title }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Title:</div>
                    <div class="col-md-9">{{ $resort->mega_menu_title }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Description:</div>
                    <div class="col-md-9">
                        {!! nl2br(e($resort->mega_menu_description)) !!}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Image:</div>
                    <div class="col-md-9">
                        @if($resort->mega_menu_image)
                            <img src="{{ asset('uploads/resorts/'.$resort->mega_menu_image) }}"
                                 class="img-thumbnail"
                                 width="250">
                        @else
                            -
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Status:</div>
                    <div class="col-md-9">
                        @php
                            $class = match ($resort->mega_menu_status) {
                                \App\Enums\Status::ACTIVE => 'success',
                                \App\Enums\Status::INACTIVE => 'danger',
                            };
                        @endphp

                        <span class="badge badge-{{ $class }}">
                            {{ $resort->mega_menu_status->label() }}
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Created At:</div>
                    <div class="col-md-9">{{ $resort->created_at->format('d M Y, h:i A') }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Updated At:</div>
                    <div class="col-md-9">{{ $resort->mega_menu_updated_at->format('d M Y, h:i A') }}</div>
                </div>

            @endif

            {{-- Type 4 --}}
            @if($type === '4')

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Image:</div>
                    <div class="col-md-9">
                        @if($resort->book_now_image)
                            <img src="{{ asset('uploads/resorts/'.$resort->book_now_image) }}"
                                 class="img-thumbnail"
                                 width="250">
                        @else
                            -
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Status:</div>
                    <div class="col-md-9">
                        @php
                            $class = match ($resort->book_now_status) {
                                \App\Enums\Status::ACTIVE => 'success',
                                \App\Enums\Status::INACTIVE => 'danger',
                            };
                        @endphp

                        <span class="badge badge-{{ $class }}">
                            {{ $resort->book_now_status->label() }}
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Created At:</div>
                    <div class="col-md-9">{{ $resort->created_at->format('d M Y, h:i A') }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Updated At:</div>
                    <div class="col-md-9">{{ $resort->book_now_updated_at->format('d M Y, h:i A') }}</div>
                </div>

            @endif

        </div>

        <div class="card-footer">
            <a href="{{ route('admin.resorts.index', ['type' => $type]) }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('admin.resorts.edit',  ['type' => $type, 'resort' => $resort]) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection