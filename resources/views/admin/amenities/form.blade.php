@extends('admin.layouts.app')

@section('title', isset($category) ? 'Edit Amenities' : 'Add Amenities')

@section('content')

    <div class="container-fluid">

        {{-- PAGE HEADER --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">

                @if (isset($category))
                    Edit Amenities
                @else
                    Add Amenities
                @endif

            </h1>


            <a href="{{ route('admin.amenities.index') }}" class="btn btn-secondary btn-sm">

                <i class="fas fa-arrow-left"></i>

                Back

            </a>

        </div>


        {{-- VALIDATION ERRORS --}}
        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

            </div>

        @endif


        <div class="card shadow">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">

                    @if (isset($category))
                        {{ $category->name }} - Amenities
                    @else
                        Amenity Details
                    @endif

                </h6>

            </div>


            <div class="card-body">


                {{-- ========================================================= --}}
                {{-- EDIT --}}
                {{-- ========================================================= --}}

                @if (isset($category))

                    <form action="{{ route('admin.amenities.update', $category) }}" method="POST">

                        @csrf

                        @method('PUT')


                        {{-- CATEGORY --}}
                        <div class="form-group">

                            <label>

                                Category

                                <span class="text-danger">
                                    *
                                </span>

                            </label>


                            <input type="text" class="form-control" value="{{ $category->name }}" readonly>

                        </div>


                        <hr>


                        {{-- AMENITIES --}}
                        <div id="amenity-container">

                            @forelse ($amenities as $index => $amenity)
                                <div class="amenity-row border rounded p-3 mb-3">

                                    <div class="row align-items-end">

                                        {{-- AMENITY NAME --}}
                                        <div class="form-group col-md-10 mb-0">

                                            <label>

                                                Amenity Name

                                                <span class="text-danger">
                                                    *
                                                </span>

                                            </label>


                                            <input type="hidden" name="amenities[{{ $index }}][id]"
                                                value="{{ $amenity->id }}">


                                            <input type="text" name="amenities[{{ $index }}][name]"
                                                class="form-control"
                                                value="{{ old('amenities.' . $index . '.name', $amenity->name) }}"
                                                placeholder="Swimming Pool" required>

                                        </div>


                                        {{-- REMOVE --}}
                                        <div class="form-group col-md-2 mb-0">

                                            <button type="button" class="btn btn-danger btn-block remove-amenity">

                                                <i class="fas fa-trash"></i>

                                                Remove

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            @empty

                                {{-- FIRST EMPTY ROW --}}
                                <div class="amenity-row border rounded p-3 mb-3">

                                    <div class="row align-items-end">

                                        <div class="form-group col-md-10 mb-0">

                                            <label>

                                                Amenity Name

                                                <span class="text-danger">
                                                    *
                                                </span>

                                            </label>

                                            <input type="text" name="amenities[0][name]" class="form-control"
                                                placeholder="Swimming Pool" required>

                                        </div>


                                        <div class="form-group col-md-2 mb-0">

                                            <button type="button" class="btn btn-danger btn-block remove-amenity" disabled>

                                                <i class="fas fa-trash"></i>

                                                Remove

                                            </button>

                                        </div>

                                    </div>

                                </div>
                            @endforelse

                        </div>


                        {{-- ADD AMENITY --}}
                        <button type="button" id="add-amenity" class="btn btn-success mb-4">

                            <i class="fas fa-plus"></i>

                            Add Amenity

                        </button>


                        <br>


                        {{-- SUBMIT --}}
                        <button type="submit" class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Update Amenities

                        </button>


                        <a href="{{ route('admin.amenities.index') }}" class="btn btn-secondary">

                            Cancel

                        </a>

                    </form>


                    {{-- ========================================================= --}}
                    {{-- CREATE --}}
                    {{-- ========================================================= --}}
                @else
                    <form action="{{ route('admin.amenities.store') }}" method="POST">

                        @csrf


                        {{-- CATEGORY --}}
                        <div class="form-group">

                            <label>

                                Category

                                <span class="text-danger">
                                    *
                                </span>

                            </label>


                            <select name="amenity_category_id"
                                class="form-control @error('amenity_category_id') is-invalid @enderror" required>

                                <option value="">
                                    Select Category
                                </option>


                                @foreach ($categories as $categoryOption)
                                    <option value="{{ $categoryOption->id }}" @selected(old('amenity_category_id') == $categoryOption->id)>

                                        {{ $categoryOption->name }}

                                    </option>
                                @endforeach

                            </select>


                            @error('amenity_category_id')
                                <span class="invalid-feedback">

                                    {{ $message }}

                                </span>
                            @enderror

                        </div>


                        <hr>


                        {{-- AMENITIES --}}
                        <div id="amenity-container">

                            <div class="amenity-row border rounded p-3 mb-3">

                                <div class="row align-items-end">


                                    {{-- NAME --}}
                                    <div class="form-group col-md-10 mb-0">

                                        <label>

                                            Amenity Name

                                            <span class="text-danger">
                                                *
                                            </span>

                                        </label>


                                        <input type="text" name="amenities[0][name]" class="form-control"
                                            placeholder="Swimming Pool" required>

                                    </div>


                                    {{-- REMOVE --}}
                                    <div class="form-group col-md-2 mb-0">

                                        <button type="button" class="btn btn-danger btn-block remove-amenity" disabled>

                                            <i class="fas fa-trash"></i>

                                            Remove

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- ADD BUTTON --}}
                        <button type="button" id="add-amenity" class="btn btn-success mb-4">

                            <i class="fas fa-plus"></i>

                            Add Amenity

                        </button>


                        <br>


                        {{-- SAVE --}}
                        <button type="submit" class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Save Amenities

                        </button>


                        <a href="{{ route('admin.amenities.index') }}" class="btn btn-secondary">

                            Cancel

                        </a>

                    </form>

                @endif

            </div>

        </div>

    </div>

@endsection


@push('script')
    <script>
        $(document).ready(function() {

            let index = $('#amenity-container .amenity-row').length;


            /*
            |--------------------------------------------------------------------------
            | Add Amenity
            |--------------------------------------------------------------------------
            */

            $('#add-amenity').on('click', function() {

                let row = `

                <div class="amenity-row border rounded p-3 mb-3">

                    <div class="row align-items-end">

                        <div class="form-group col-md-10 mb-0">

                            <label>

                                Amenity Name

                                <span class="text-danger">
                                    *
                                </span>

                            </label>

                            <input
                                type="text"
                                name="amenities[${index}][name]"
                                class="form-control"
                                placeholder="Swimming Pool"
                                required>

                        </div>


                        <div class="form-group col-md-2 mb-0">

                            <button
                                type="button"
                                class="btn btn-danger btn-block remove-amenity">

                                <i class="fas fa-trash"></i>

                                Remove

                            </button>

                        </div>

                    </div>

                </div>

            `;


                $('#amenity-container').append(row);

                index++;

                updateRemoveButtons();

            });


            /*
            |--------------------------------------------------------------------------
            | Remove Amenity
            |--------------------------------------------------------------------------
            */

            $(document).on(
                'click',
                '.remove-amenity',
                function() {

                    $(this)
                        .closest('.amenity-row')
                        .remove();

                    updateRemoveButtons();

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Enable / Disable Remove Buttons
            |--------------------------------------------------------------------------
            */

            function updateRemoveButtons() {

                let rows = $('#amenity-container .amenity-row');

                if (rows.length <= 1) {

                    rows.find('.remove-amenity')
                        .prop('disabled', true);

                } else {

                    rows.find('.remove-amenity')
                        .prop('disabled', false);

                }

            }


            updateRemoveButtons();

        });
    </script>
@endpush
