@extends("admin.layouts.app")
@section('title', ($galleryCategory->id ? 'Edit ' : 'Add ') . 'Gallery Category')
@section("content")

@use(App\Enums\Status)

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">
            {{ $galleryCategory->id ? 'Edit ' : 'Add ' }} Gallery Category
        </h1>
        
        <form method="POST" action="{{ $galleryCategory->id ? route('admin.gallery-categories.update', $galleryCategory) : route('admin.gallery-categories.store') }}" enctype="multipart/form-data">
        @csrf
        {{ $galleryCategory->id ? method_field('PUT') : '' }}
        <div class="card shadow mb-4">
            <div class="card-body">
                
                <!-- <h3 class="font-size-lg text-dark font-weight-bold mb-3">Gallery Category</h3> -->
                <div class="row">

                    <div class="form-group col-md-6">
                        <label><strong>Name <span class="text-danger">*</span></strong></label>
                        <input type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $galleryCategory->name) }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label><strong>Sort Order <span class="text-danger">*</span></strong></label>
                        <input type="number"
                            name="sort_order"
                            class="form-control"
                            value="{{ old('sort_order', $galleryCategory->sort_order) }}">
                        @error('sort_order')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label><strong>Status</strong></label>
                        <input type="hidden" name="status" value="{{ Status::INACTIVE->value }}">
                        <div class="custom-control custom-switch">
                            <input
                                type="checkbox"
                                class="custom-control-input"
                                id="status"
                                name="status"
                                value="{{ Status::ACTIVE->value }}"
                                {{ old('status', $galleryCategory->status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'checked' : '' }}
                            >
                            <label class="custom-control-label" for="status">
                                <span id="status-text">
                                    {{ old('status', $galleryCategory->status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'Active' : 'Inactive' }}
                                </span>
                            </label>
                        </div>
                    </div>

                </div>   
            </div>
            
            <div class="card-footer">
                <div class="row">
                    <div class="form-group col-6">
                    <button type="submit" class="btn btn-primary mr-3">{{ $galleryCategory->id ? 'Update' : 'Save' }}</button>
                    <a class="btn btn-secondary ml-3" href="{{ route('admin.gallery-categories.index') }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        </form>
        
        
    </div>
    <!-- /.container-fluid -->
@endsection

@push('style')

@endpush

@push('script')
    <script type="text/javascript">
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>
        document.getElementById('status').addEventListener('change', function () {
            document.getElementById('status-text').textContent =
                this.checked ? 'Active' : 'Inactive';
        });
    </script>
@endpush