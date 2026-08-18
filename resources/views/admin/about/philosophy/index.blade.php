@extends('admin.layouts.app')

@section('title', 'Philosophy')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                Philosophy
            </h1>

            <a href="{{ route('admin.philosophies.create') }}" class="btn btn-primary">

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

                    <table class="table table-bordered" id="philosophyTable" width="100%">

                        <thead>

                            <tr>

                                <th width="5%">#</th>

                                <th width="12%">Icon</th>

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
    <div class="modal fade" id="delete-philosophy-modal" tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Delete Philosophy

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

                    <button class="btn btn-danger" id="btn-delete-philosophy">

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

            var deleteUrl = '';

            var table = $('#philosophyTable').DataTable({

                processing: true,

                serverSide: true,

                ajax: "{{ route('admin.philosophies.index') }}",

                order: [
                    [5, 'desc']
                ],

                columns: [

                    {
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'icon_image',
                        name: 'icon_image',
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


            $(document).on(
                'click',
                '.philosophy-delete',
                function() {

                    deleteUrl = $(this).data('href');

                }
            );


            $('#btn-delete-philosophy').click(function() {

                $.ajax({

                    url: deleteUrl,

                    type: 'POST',

                    data: {

                        _method: 'DELETE',

                        _token: '{{ csrf_token() }}'

                    },

                    success: function(response) {

                        $('#delete-philosophy-modal').modal('hide');

                        table.ajax.reload();

                    }

                });

            });

        });
    </script>
@endpush
