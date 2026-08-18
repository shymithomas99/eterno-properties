@extends('admin.layouts.app')

@section('title', ($category->exists ? 'Edit' : 'Add') . ' Amenity Category')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">

                {{ $category->exists ? 'Edit' : 'Add' }}
                Amenity Category

            </h1>

            <a href="{{ route('admin.amenity-categories.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i>
                Back
            </a>

        </div>


        <div class="card shadow">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">
                    Category Details
                </h6>

            </div>


            <div class="card-body">

                <form
                    action="{{ $category->exists
                        ? route('admin.amenity-categories.update', $category)
                        : route('admin.amenity-categories.store') }}"
                    method="POST">

                    @csrf

                    @if ($category->exists)
                        @method('PUT')
                    @endif


                    <div class="row">

                        <div class="form-group col-md-6">

                            <label>
                                Category Name
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $category->name) }}" placeholder="Property Facilities">

                            @error('name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        <div class="form-group col-md-6">

                            <label>
                                Slug
                            </label>

                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                                value="{{ old('slug', $category->slug) }}" placeholder="property-facilities">

                            @error('slug')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                Sort Order
                            </label>

                            <input type="number" name="sort_order"
                                class="form-control @error('sort_order') is-invalid @enderror"
                                value="{{ old('sort_order', $category->sort_order ?? 0) }}" min="0">

                            @error('sort_order')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        <div class="form-group col-md-4">

                            <label>
                                Status
                            </label>

                            <div class="custom-control custom-switch mt-2">

                                <input type="checkbox" class="custom-control-input" id="status" name="status"
                                    value="1" @checked(old('status', $category->exists ? $category->status : true))>

                                <label class="custom-control-label" for="status">
                                    Active
                                </label>

                            </div>

                        </div>

                    </div>


                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>

                        {{ $category->exists ? 'Update' : 'Save' }}

                    </button>


                    <a href="{{ route('admin.amenity-categories.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </form>

            </div>

        </div>

    </div>

@endsection
