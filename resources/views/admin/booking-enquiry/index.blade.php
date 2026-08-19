@extends('admin.layouts.app')

@section('title', 'Booking Enquiries')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Booking Enquiries</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="bookingTable" class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Preferred Room</th>
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
    <div class="modal fade" id="delete-booking-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Booking Enquiry</h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">Are you sure you want to delete this enquiry?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" id="btn-delete-booking">Delete</button>
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
            const table = $('#bookingTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.booking-enquiry.index') }}",
                columns: [{
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

            $(document).on('click', '.booking-delete', function() {
                deleteUrl = $(this).data('href');
            });

            $('#btn-delete-booking').click(function() {
                $.ajax({
                    url: deleteUrl,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $('#delete-booking-modal').modal('hide');
                        table.ajax.reload(null, false);
                    }
                });
            });
        });
    </script>
@endpush
