@extends("admin.layouts.app")
@section('title', ($testimonial->id ? 'Edit ' : 'Add ') . 'Testimonial')
@section("content")

@use(App\Enums\Status)

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">
            {{ $testimonial->id ? 'Edit ' : 'Add ' }} Testimonial
        </h1>
        
        <form method="POST" action="{{ $testimonial->id ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" enctype="multipart/form-data">
        @csrf
        {{ $testimonial->id ? method_field('PUT') : '' }}
        <div class="card shadow mb-4">
            <div class="card-body">
                
                <!-- <h3 class="font-size-lg text-dark font-weight-bold mb-3">Testimonial</h3> -->
                <div class="row">

                    <div class="form-group col-md-6">
                        <label><strong>Resort <span class="text-danger">*</span></strong></label>
                        <select name="resort_id" id="resort_id" class="form-control">
                            <option value="">-- Select Resort --</option>
                            @foreach ($resorts as $id => $name)
                                <option value="{{ $id }}"
                                    {{ old('resort_id', $testimonial->resort_id ?? '') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('resort_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Title <span class="text-danger">*</span></strong></label>
                        <input type="text"
                            name="title"
                            class="form-control"
                            value="{{ old('title', $testimonial->title) }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Content <span class="text-danger">*</span></strong></label>
                        <textarea name="content"
                                rows="3"
                                class="form-control">{{ old('content', $testimonial->content) }}</textarea>
                        @error('content')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Customer Name <span class="text-danger">*</span></strong></label>
                        <input type="text"
                            name="customer_name"
                            class="form-control"
                            value="{{ old('customer_name', $testimonial->customer_name) }}">
                        @error('customer_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Customer Place <span class="text-danger">*</span></strong></label>
                        <input type="text"
                            name="customer_place"
                            class="form-control"
                            value="{{ old('customer_place', $testimonial->customer_place) }}">
                        @error('customer_place')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Customer Image (100 × 100 px, max 30 KB) <span class="text-danger">*</strong></label>
                        <div class="custom-file mb-3">
                            <input type="file"
                                class="custom-file-input"
                                id="customer_image"
                                name="customer_image"
                                accept="image/*"
                                onchange="document.getElementById('uploaded_img').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="customer_image">
                                {{ $testimonial->customer_image ?: 'Choose file' }}
                            </label>
                        </div>
                        <img id="uploaded_img"
                            src="{{ $testimonial->customer_image ? asset('uploads/testimonials/'.$testimonial->customer_image) : asset('img/upload_image.png') }}">
                        @error('customer_image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Sort Order <span class="text-danger">*</span></strong></label>
                        <input type="number"
                            name="sort_order"
                            class="form-control"
                            value="{{ old('sort_order', $testimonial->sort_order) }}">
                        @error('sort_order')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Status</strong></label>
                        <input type="hidden" name="status" value="{{ Status::INACTIVE->value }}">
                        <div class="custom-control custom-switch">
                            <input
                                type="checkbox"
                                class="custom-control-input"
                                id="status"
                                name="status"
                                value="{{ Status::ACTIVE->value }}"
                                {{ old('status', $testimonial->status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'checked' : '' }}
                            >
                            <label class="custom-control-label" for="status">
                                <span id="status-text">
                                    {{ old('status', $testimonial->status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'Active' : 'Inactive' }}
                                </span>
                            </label>
                        </div>
                    </div>

                </div>   
            </div>
            
            <div class="card-footer">
                <div class="row">
                    <div class="form-group col-6">
                    <button type="submit" class="btn btn-primary mr-3">{{ $testimonial->id ? 'Update' : 'Save' }}</button>
                    <a class="btn btn-secondary ml-3" href="{{ route('admin.testimonials.index') }}">Cancel</a>
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