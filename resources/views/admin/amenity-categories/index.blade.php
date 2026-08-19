@extends('admin.layouts.app')

@section('title', 'Amenity Categories')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                Amenity Categories
            </h1>

            <a href="{{ route('admin.amenity-categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus fa-sm text-white-50"></i>
                Add
            </a>

        </div>


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <div class="card shadow mb-4">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">
                    Amenity Category List
                </h6>

            </div>


            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered" width="100%" cellspacing="0">

                        <thead>

                            <tr>

                                <th width="60">#</th>

                                <th>Name</th>

                                <th>Slug</th>

                                <th width="120">
                                    Amenities
                                </th>

                                <th width="100">
                                    Sort Order
                                </th>

                                <th width="100">
                                    Status
                                </th>

                                <th width="150">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($categories as $category)
                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $category->name }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $category->slug }}
                                    </td>

                                    <td>
                                        {{ $category->amenities_count }}
                                    </td>

                                    <td>
                                        {{ $category->sort_order }}
                                    </td>

                                    <td>

                                        @if ($category->status)
                                            <span class="badge badge-success">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                Inactive
                                            </span>
                                        @endif

                                    </td>


                                    <td>

                                        <a href="{{ route('admin.amenity-categories.edit', $category) }}" class="btn btn-sm"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        {{--  <form action="{{ route('admin.amenity-categories.toggle-status', $category) }}"
                                            method="POST" class="d-inline">

                                            @csrf

                                            <button type="submit"
                                                class="btn btn-sm {{ $category->status ? 'btn-warning' : 'btn-success' }}"
                                                title="{{ $category->status ? 'Deactivate' : 'Activate' }}">

                                                <i class="fas {{ $category->status ? 'fa-ban' : 'fa-check' }}"></i>

                                            </button>

                                        </form>  --}}


                                        <form action="{{ route('admin.amenity-categories.destroy', $category) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this category?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center">
                                        No amenity categories found.
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
