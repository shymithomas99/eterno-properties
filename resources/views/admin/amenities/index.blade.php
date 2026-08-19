@extends('admin.layouts.app')

@section('title', 'Amenities')

@section('content')

    <div class="container-fluid">

        {{-- PAGE HEADER --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                Amenities
            </h1>

            <a href="{{ route('admin.amenities.create') }}" class="btn btn-primary">

                <i class="fas fa-plus fa-sm text-white-50"></i>

                Add

            </a>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}

            </div>
        @endif


        {{-- CARD --}}
        <div class="card shadow mb-4">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">
                    Amenity List
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

                                <th width="250">
                                    Category
                                </th>

                                <th>
                                    Amenities
                                </th>

                                <th width="150">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($categories as $category)

                                <tr>

                                    {{-- NUMBER --}}
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- CATEGORY --}}
                                    <td>

                                        <strong>
                                            {{ $category->name }}
                                        </strong>

                                    </td>


                                    {{-- AMENITIES --}}
                                    <td>

                                        @if ($category->amenities->isNotEmpty())
                                            <div class="d-flex flex-wrap">

                                                @foreach ($category->amenities as $amenity)
                                                    <span class="badge badge-light border mr-2 mb-2 p-2">

                                                        {{ $amenity->name }}

                                                    </span>
                                                @endforeach

                                            </div>
                                        @else
                                            <span class="text-muted">
                                                No amenities added.
                                            </span>
                                        @endif

                                    </td>


                                    {{-- ACTIONS --}}
                                    <td>

                                        {{-- EDIT ALL AMENITIES --}}
                                        <a href="{{ route('admin.amenities.edit', $category) }}" class="btn btn-sm"
                                            title="Edit Amenities">

                                            <i class="fas fa-edit"></i>

                                        </a>


                                        {{-- DELETE ALL --}}
                                        @if ($category->amenities->isNotEmpty())
                                            <form action="{{ route('admin.amenities.destroy-category', $category) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete all amenities under this category?');">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm" title="Delete All Amenities">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center">

                                        No amenities found.

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
