@extends('admin.layouts.app')

@section('title', $coreValue->exists ? 'Edit Core Value' : 'Add Core Value')

@section('content')
    @use(App\Enums\AboutStatus)

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">

                {{ $coreValue->exists ? 'Edit Core Value' : 'Add Core Value' }}

            </h1>

            <a href="{{ route('admin.core-values.index') }}" class="btn btn-secondary btn-sm">

                <i class="fa fa-arrow-left"></i>

                Back

            </a>

        </div>


        <div class="card shadow mb-4">

            <div class="card-body">

                <form
                    action="{{ $coreValue->exists ? route('admin.core-values.update', $coreValue) : route('admin.core-values.store') }}"
                    method="POST" enctype="multipart/form-data">

                    @csrf

                    @if ($coreValue->exists)
                        @method('PUT')
                    @endif


                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label><strong>Title <span class="text-danger">*</span></strong></label>

                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $coreValue->title) }}">

                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="form-group">

                                <label><strong>Sort Order <span class="text-danger">*</span></strong></label>

                                <input type="number" name="sort_order" class="form-control"
                                    value="{{ old('sort_order', $coreValue->sort_order ?? 0) }}">

                                @error('sort_order')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>


                        <div class="col-md-12">

                            <div class="form-group">

                                <label><strong>Description <span class="text-danger">*</span></strong></label>

                                <textarea name="description" rows="5" class="form-control">{{ old('description', $coreValue->description) }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>



                        <div class="form-group col-md-6">

                            <label>
                                <strong>Status</strong>
                            </label>

                            {{-- Hidden value for Inactive --}}
                            <input type="hidden" name="status" value="{{ AboutStatus::INACTIVE->value }}">

                            <div class="custom-control custom-switch">

                                <input type="checkbox" class="custom-control-input" id="status" name="status"
                                    value="{{ AboutStatus::ACTIVE->value }}"
                                    {{ old('status', $philosophy->status?->value ?? AboutStatus::ACTIVE->value) == AboutStatus::ACTIVE->value
                                        ? 'checked'
                                        : '' }}>

                                <label class="custom-control-label" for="status">
                                    <span id="status-text">
                                        {{ old('status', $philosophy->status?->value ?? AboutStatus::ACTIVE->value) == AboutStatus::ACTIVE->value
                                            ? 'Active'
                                            : 'Inactive' }}
                                    </span>
                                </label>

                            </div>

                        </div>

                    </div>


                    <hr>


                    <button type="submit" class="btn btn-primary">

                        <i class="fa fa-save"></i>

                        {{ $coreValue->exists ? 'Update' : 'Save' }}

                    </button>


                    <a href="{{ route('admin.core-values.index') }}" class="btn btn-secondary">

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

@endsection

@push('style')
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('script')
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    </script>
@endpush
