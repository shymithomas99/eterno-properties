@extends('admin.layouts.app')

@section('title', 'Rooms')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                Rooms
            </h1>

            <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary btn-sm shadow-sm">

                <i class="fas fa-plus fa-sm text-white-50"></i>
                Add Room

            </a>

        </div>


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <div class="card shadow mb-4">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">
                    Room List
                </h6>

            </div>


            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered" width="100%" cellspacing="0">

                        <thead>

                            <tr>

                                <th width="60">
                                    #
                                </th>

                                <th width="130">
                                    Image
                                </th>

                                <th>
                                    Room Name
                                </th>

                                <th>
                                    Slug
                                </th>

                                <th width="220">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($rooms as $room)
                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- MAIN ROOM IMAGE --}}
                                    <td>

                                        @if ($room->main_image)
                                            <img src="{{ asset('uploads/rooms/' . $room->main_image) }}" width="100"
                                                height="70" style="object-fit: cover; border-radius: 4px;"
                                                alt="{{ $room->name }}">
                                        @else
                                            <span class="text-muted">
                                                No Image
                                            </span>
                                        @endif

                                    </td>

                                    <td>
                                        <strong>
                                            {{ $room->name }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $room->slug }}

                                    </td>

                                    <td>
                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-info"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- GALLERY --}}
                                        <a href="{{ route('admin.rooms.gallery-images-form', $room->id) }}"
                                            class="btn btn-sm btn-primary" title="Gallery">
                                            <i class="fas fa-images"></i>
                                        </a>

                                        {{-- DELETE --}}
                                        <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this room?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No rooms found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
