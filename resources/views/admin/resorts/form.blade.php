@extends("admin.layouts.app")
@section('title', ($resort->id ? 'Edit ' : 'Add ') . 'Resort')
@section("content")

@use(App\Enums\Status)

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">
            Resort
        </h1>
        
        <form method="POST" action="{{ $resort->id ? route('admin.resorts.update', ['type' => $type, 'resort' => $resort]) : route('admin.resorts.store', ['type' => $type]) }}" enctype="multipart/form-data">
        @csrf
        {{ $resort->id ? method_field('PUT') : '' }}
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ $resort->exists ? 'Edit ' : 'Add ' }} Resort
                </h6>
            </div>

            <div class="card-body">

                <div class="row">

                    {{-- ===================================================== --}}
                    {{-- TYPE 1 : Resort Name --}}
                    {{-- ===================================================== --}}
                    <div class="form-group col-md-6">
                        <label><strong>Name <span class="text-danger">{{ $type === '1' ? '*' : '' }}</span></strong></label>

                        <input type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $resort->name) }}"
                            {{ $type !== '1' ? 'readonly' : '' }}>

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>URL <span class="text-danger">{{ $type === '1' ? '*' : '' }}</span></strong></label>

                        <input type="text"
                            name="url"
                            class="form-control"
                            value="{{ old('url', $resort->url) }}"
                            {{ $type !== '1' ? 'readonly' : '' }}>

                        @error('url')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Sort Order <span class="text-danger">{{ $type === '1' ? '*' : '' }}</span></strong></label>
                        <input type="number"
                            name="sort_order"
                            class="form-control"
                            value="{{ old('sort_order', $resort->sort_order) }}"
                            {{ $type !== '1' ? 'readonly' : '' }}>
                        @error('sort_order')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- ===================================================== --}}
                    {{-- TYPE 2 : Home Section --}}
                    {{-- ===================================================== --}}
                    @if($type === '2')

                        <div class="form-group col-md-6">
                            <label><strong>Place <span class="text-danger">*</span></strong></label>

                            <input type="text"
                                name="home_place"
                                class="form-control"
                                value="{{ old('home_place', $resort->home_place) }}">

                            @error('home_place')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><strong>Title <span class="text-danger">*</span></strong></label>

                            <input type="text"
                                name="home_title"
                                class="form-control"
                                value="{{ old('home_title', $resort->home_title) }}">

                            @error('home_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><strong>Description <span class="text-danger">*</span></strong></label>

                            <textarea
                                name="home_description"
                                rows="3"
                                class="form-control">{{ old('home_description', $resort->home_description) }}</textarea>

                            @error('home_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><strong>Button Text <span class="text-danger">*</span></strong></label>

                            <input type="text"
                                name="home_button_text"
                                class="form-control"
                                value="{{ old('home_button_text', $resort->home_button_text) }}">

                            @error('home_button_text')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><strong>Image (660 × 487 px, max 500 KB) <span class="text-danger">*</strong></label>
                            <div class="custom-file mb-3">
                                <input type="file"
                                    class="custom-file-input"
                                    id="home_image"
                                    name="home_image"
                                    accept="image/*"
                                    onchange="document.getElementById('uploaded_home_img').src = window.URL.createObjectURL(this.files[0])">
                                <label class="custom-file-label" for="home_image">
                                    {{ $resort->home_image ?: 'Choose file' }}
                                </label>
                            </div>
                            <img id="uploaded_home_img" class="uploaded-img"
                                src="{{ $resort->home_image ? asset('uploads/resorts/'.$resort->home_image) : asset('img/upload_image.png') }}">
                            @error('home_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><strong>Status</strong></label>
                            <input type="hidden" name="home_status" value="{{ Status::INACTIVE->value }}">
                            <div class="custom-control custom-switch">
                                <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="home_status"
                                    name="home_status"
                                    value="{{ Status::ACTIVE->value }}"
                                    {{ old('home_status', $resort->home_status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'checked' : '' }}
                                >
                                <label class="custom-control-label" for="home_status">
                                    <span id="home_status_text">
                                        {{ old('home_status', $resort->home_status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'Active' : 'Inactive' }}
                                    </span>
                                </label>
                            </div>
                        </div>

                    {{-- ===================================================== --}}
                    {{-- TYPE 3 : Mega Menu --}}
                    {{-- ===================================================== --}}
                    @elseif($type === '3')

                        <div class="form-group col-md-6">
                            <label><strong>Subtitle <span class="text-danger">*</span></strong></label>

                            <input type="text"
                                name="mega_menu_sub_title"
                                class="form-control"
                                value="{{ old('mega_menu_sub_title', $resort->mega_menu_sub_title) }}">

                            @error('mega_menu_sub_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><strong>Title <span class="text-danger">*</span></strong></label>

                            <input type="text"
                                name="mega_menu_title"
                                class="form-control"
                                value="{{ old('mega_menu_title', $resort->mega_menu_title) }}">

                            @error('mega_menu_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><strong>Description <span class="text-danger">*</span></strong></label>

                            <textarea
                                name="mega_menu_description"
                                rows="3"
                                class="form-control">{{ old('mega_menu_description', $resort->mega_menu_description) }}</textarea>

                            @error('mega_menu_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><strong>Image (500 × 462 px, max 200 KB) <span class="text-danger">*</strong></label>
                            <div class="custom-file mb-3">
                                <input type="file"
                                    class="custom-file-input"
                                    id="mega_menu_image"
                                    name="mega_menu_image"
                                    accept="image/*"
                                    onchange="document.getElementById('uploaded_mega_menu_img').src = window.URL.createObjectURL(this.files[0])">
                                <label class="custom-file-label" for="mega_menu_image">
                                    {{ $resort->mega_menu_image ?: 'Choose file' }}
                                </label>
                            </div>
                            <img id="uploaded_mega_menu_img" class="uploaded-img"
                                src="{{ $resort->mega_menu_image ? asset('uploads/resorts/'.$resort->mega_menu_image) : asset('img/upload_image.png') }}">
                            @error('mega_menu_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><strong>Status</strong></label>
                            <input type="hidden" name="mega_menu_status" value="{{ Status::INACTIVE->value }}">
                            <div class="custom-control custom-switch">
                                <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="mega_menu_status"
                                    name="mega_menu_status"
                                    value="{{ Status::ACTIVE->value }}"
                                    {{ old('mega_menu_status', $resort->mega_menu_status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'checked' : '' }}
                                >
                                <label class="custom-control-label" for="mega_menu_status">
                                    <span id="mega_menu_status_text">
                                        {{ old('mega_menu_status', $resort->mega_menu_status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'Active' : 'Inactive' }}
                                    </span>
                                </label>
                            </div>
                        </div>

                    {{-- ===================================================== --}}
                    {{-- TYPE 4 : Book Now --}}
                    {{-- ===================================================== --}}
                    @elseif($type === '4')

                        <div class="form-group col-md-6">
                            <label><strong>Image (400 × 267 px, max 100 KB) <span class="text-danger">*</strong></label>
                            <div class="custom-file mb-3">
                                <input type="file"
                                    class="custom-file-input"
                                    id="book_now_image"
                                    name="book_now_image"
                                    accept="image/*"
                                    onchange="document.getElementById('uploaded_book_now_img').src = window.URL.createObjectURL(this.files[0])">
                                <label class="custom-file-label" for="book_now_image">
                                    {{ $resort->book_now_image ?: 'Choose file' }}
                                </label>
                            </div>
                            <img id="uploaded_book_now_img" class="uploaded-img"
                                src="{{ $resort->book_now_image ? asset('uploads/resorts/'.$resort->book_now_image) : asset('img/upload_image.png') }}">
                            @error('book_now_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label><strong>Status</strong></label>
                            <input type="hidden" name="book_now_status" value="{{ Status::INACTIVE->value }}">
                            <div class="custom-control custom-switch">
                                <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="book_now_status"
                                    name="book_now_status"
                                    value="{{ Status::ACTIVE->value }}"
                                    {{ old('book_now_status', $resort->book_now_status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'checked' : '' }}
                                >
                                <label class="custom-control-label" for="book_now_status">
                                    <span id="book_now_status_text">
                                        {{ old('book_now_status', $resort->book_now_status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'Active' : 'Inactive' }}
                                    </span>
                                </label>
                            </div>
                        </div>

                    @endif

                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-3">
                    {{ $resort->exists ? 'Update' : 'Save' }}
                </button>
                <a href="{{ route('admin.resorts.index', ['type' => $type]) }}"
                    class="btn btn-secondary ml-3">
                    Cancel
                </a>
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
        [
            'home_status',
            'mega_menu_status',
            'book_now_status'
        ].forEach(function(id) {

            const checkbox = document.getElementById(id);

            if (!checkbox) return;

            checkbox.addEventListener('change', function () {

                document.getElementById(id + '_text').textContent =
                    this.checked ? 'Active' : 'Inactive';

            });

        });
    </script>
@endpush