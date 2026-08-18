@extends('admin.layouts.app')

@section('title', 'Core Values')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">

                Core Values

            </h1>

            <a href="{{ route('admin.core-values.create') }}" class="btn btn-primary">

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

                    <table id="coreValueTable" class="table table-bordered" width="100%">

                        <thead>

                            <tr>

                                <th width="5%">#</th>

                                <th>Title</th>

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
    <div class="modal fade" id="delete-core-value-modal">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Delete Core Value

                    </h5>

                    <button type="button" class="close" data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    Are you sure you want to delete this record?

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-dismiss="modal">

                        Cancel

                    </button>

                    <button id="btn-delete-core-value" class="btn btn-danger">

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

            let table = $('#coreValueTable').DataTable({

                processing: true,

                serverSide: true,

                ajax: "{{ route('admin.core-values.index') }}",

                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },



                    {
                        data: 'title',
                        name: 'title'
                    },

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


            $(document).on('click', '.core-value-delete', function() {

                deleteUrl = $(this).data('href');

            });


            $('#btn-delete-core-value').click(function() {

                $.ajax({

                    url: deleteUrl,

                    method: 'POST',

                    data: {

                        _token: '{{ csrf_token() }}',

                        _method: 'DELETE'

                    },

                    success: function(response) {

                        $('#delete-core-value-modal').modal('hide');

                        table.ajax.reload(null, false);

                    }

                });

            });

        });
    </script>
@endpush
