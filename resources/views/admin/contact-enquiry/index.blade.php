@extends('admin.layouts.app')

@section('title', 'Contact Messages')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                Contact Messages
            </h1>

        </div>

        <div class="card shadow mb-4">

            <div class="card-body">

                <div class="table-responsive">

                    <table id="contactTable" class="table table-bordered" width="100%">

                        <thead>

                            <tr>

                                <th width="5%">#</th>

                                <th>Name</th>

                                <th>Email</th>

                                <th>Phone</th>

                                <th>Resort</th>

                                <th>Date</th>

                                <th width="10%">Action</th>

                            </tr>

                        </thead>

                    </table>

                </div>

            </div>

        </div>



    </div>

@endsection

@push('modal')
    <div class="modal fade" id="delete-contact-modal">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Delete Message

                    </h5>

                    <button class="close" data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    Are you sure you want to delete this message?

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-dismiss="modal">

                        Cancel

                    </button>

                    <button class="btn btn-danger" id="btn-delete-contact">

                        Delete

                    </button>

                </div>

            </div>

        </div>

    </div>
@endpush


@push('script')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {

            let deleteUrl = '';

            let table = $('#contactTable').DataTable({

                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.contact-enquiry.index') }}",

                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },

                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'email',
                        name: 'email'
                    },

                    {
                        data: 'phone',
                        name: 'phone'
                    },

                    {
                        data: 'resort',
                        name: 'resort'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at'
                    },

                    {
                        data: 'actions',
                        name: 'actions',
                        searchable: false,
                        orderable: false
                    }

                ]

            });

            $(document).on('click', '.contact-delete', function() {

                deleteUrl = $(this).data('href');

            });

            $('#btn-delete-contact').click(function() {

                $.ajax({

                    url: deleteUrl,

                    type: 'POST',

                    data: {

                        _method: 'DELETE',

                        _token: '{{ csrf_token() }}'

                    },

                    success: function(response) {

                        $('#delete-contact-modal').modal('hide');

                        table.ajax.reload(null, false);

                    }

                });

            });

        });
    </script>
@endpush
