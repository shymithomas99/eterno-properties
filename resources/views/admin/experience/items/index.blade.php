@extends('admin.layouts.app')

@section('title', 'Experience Items ' . ($type == 1 ? '(Home Page)' : '(Inner Page)'))

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                Experience Items {{ $type == 1 ? '(Home Page)' : '(Inner Page)' }}
            </h1>

            <a href="{{ route('admin.experience-items.create', $type) }}" class="btn btn-primary">

                <i class="fa fa-plus"></i>

                Add

            </a>

        </div>
        {{--
        @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}

            </div>
        @endif  --}}


        <div class="card shadow mb-4">

            <div class="card-body">

                <div class="table-responsive">

                    <table id="experienceTable" class="table table-bordered" width="100%">

                        <thead>

                            <tr>

                                <th width="5%">#</th>

                                <th width="10%">Image</th>

                                <th>Title</th>

                                {{--  <th width="12%">Layout</th>  --}}

                                <th width="10%">Order</th>

                                <th width="10%">Status</th>

                                <th width="12%">Created</th>

                                <th width="12%">Action</th>

                            </tr>

                        </thead>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection


@push('modal')
    <div class="modal fade" id="delete-experience-modal" tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Delete Experience

                    </h5>

                    <button type="button" class="close" data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    Are you sure you want to delete this Experience?

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-dismiss="modal">

                        Cancel

                    </button>

                    <button class="btn btn-danger" id="btn-delete-experience">

                        Delete

                    </button>

                </div>

            </div>

        </div>

    </div>
@endpush


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

    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {

            let deleteUrl = '';

            let table = $('#experienceTable').DataTable({

                processing: true,

                serverSide: true,

                ajax: "{{ route('admin.experience-items.index', $type) }}",

                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'title',
                        name: 'title'
                    },

                    {{--  {
                        data: 'layout',
                        name: 'layout'
                    },  --}}

                    {
                        data: 'sort_order',
                        name: 'sort_order'
                    },

                    {
                        data: 'status',
                        name: 'status'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at'
                    },

                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }

                ]

            });


            $(document).on(
                'click',
                '.experience-delete',
                function() {

                    deleteUrl = $(this).data('href');

                }
            );


            $('#btn-delete-experience').click(function() {

                $.ajax({

                    url: deleteUrl,

                    type: 'POST',

                    data: {

                        _method: 'DELETE',

                        _token: '{{ csrf_token() }}'

                    },

                    success: function(response) {

                        $('#delete-experience-modal').modal('hide');

                        table.ajax.reload(null, false);

                    }

                });

            });

        });
    </script>
@endpush
