@extends("admin.layouts.app")
@section('title', 'Resorts')
@section("content")

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Page Heading -->
            <div class="col-6">
            <h1 class="h3 mb-2 text-gray-800">
                Resorts
            </h1>
            </div>
            @if($type === '1')
            <div class="col-6 text-right">
                <a href="{{route('admin.resorts.create', ['type' => $type])}}" class="btn btn-primary" ><i class="fa fa-plus"></i> Add</a>
            </div>
            @endif
        </div>
        <!--<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.-->
        <!--    For more information about DataTables, please visit the <a target="_blank"-->
        <!--        href="https://datatables.net">official DataTables documentation</a>.</p>-->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <!--<div class="card-header py-3">-->
            <!--    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>-->
            <!--</div>-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="resort-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>URL</th>
                                @if($type !== '1') <th>Image</th> @endif
                                @if ($type !== '4' && $type !== '1') <th>Title</th> @endif
                                <th>Sort Order</th>
                                @if($type !== '1') <th>Status</th> @endif
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@push('modal')      

    <!-- Delete Modal-->
    <div class="modal fade" id="delete-resort-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to delete this data?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-delete-resort "><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
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
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
<!--<script src="{{ asset('js/jquery.toast.min.js')}}" type="text/javascript"></script>-->
<!--<script src="{{ asset('js/toastr.js')}}" type="text/javascript"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if(session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif

    @if(session('info'))
        toastr.info("{{ session('info') }}");
    @endif
</script>

<script type="text/javascript">

   $(function() {

    $('#resort-table').DataTable({

         processing: true,
         serverSide: true,

         ajax: '{{ route("admin.resorts.index", ["type" => $type]) }}',
        @if($type === '2')
            columns: [
                    { data: 'name', name: 'name' },
                    { data: 'url', name: 'url' },
                    { data: 'home_image', name: 'home_image' },
                    { data: 'home_title', name: 'home_title' },
                    { data: 'sort_order', name: 'sort_order' },
                    { data: 'home_status', name: 'home_status' },
                    { data: 'actions', orderable: false}
                ],
        @elseif ($type === '3')
            columns: [
                    { data: 'name', name: 'name' },
                    { data: 'url', name: 'url' },
                    { data: 'mega_menu_image', name: 'mega_menu_image' },
                    { data: 'mega_menu_title', name: 'mega_menu_title' },
                    { data: 'sort_order', name: 'sort_order' },
                    { data: 'mega_menu_status', name: 'mega_menu_status' },
                    { data: 'actions', orderable: false}
                ],
        @elseif ($type === '4')
            columns: [
                    { data: 'name', name: 'name' },
                    { data: 'url', name: 'url' },
                    { data: 'book_now_image', name: 'book_now_image' },
                    { data: 'sort_order', name: 'sort_order' },
                    { data: 'book_now_status', name: 'book_now_status' },
                    { data: 'actions', orderable: false}
                ],
        @else
            columns: [
                    { data: 'name', name: 'name' },
                    { data: 'url', name: 'url' },
                    { data: 'sort_order', name: 'sort_order' },
                    { data: 'actions', orderable: false}
                ],
        @endif
         order: [[ 0, "desc" ]]

     });
 

     $('table').on('click','.resort-delete', function(e){
        var href=$(this).data('href');
            $('.btn-delete-resort').off().click(function() {
		      $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                    type: 'DELETE',
                    //data:{},
                    dataType : 'JSON', 
                    url : href,
                    success: function(response){
                        $('#delete-resort-modal').modal('hide');
                        $('#resort-table').DataTable().ajax.reload();
                        toastr.success(response.message);
                    },
                    error: function (xhr) {
                        $('#delete-resort-modal').modal('hide');
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            toastr.error(xhr.responseJSON.message);
                        } else {
                            toastr.error('Something went wrong.');
                        }
                    }
              });
   		 });
    });

   });

</script>
@endpush