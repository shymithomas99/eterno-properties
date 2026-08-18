@extends('admin.layouts.app')

@section('title', 'Newsletter Enquiries')

@section('content')

    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                Newsletter Enquiries
            </h1>

        </div>

        {{-- Newsletter Table --}}
        <div class="card shadow mb-4">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">
                    Newsletter Subscribers
                </h6>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>
                                <th width="80">#</th>
                                <th>Email Address</th>
                                <th>Subscribed On</th>
                                <th width="100">Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($newsletters as $newsletter)
                                <tr>

                                    <td>
                                        {{ $newsletters->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        {{ $newsletter->email }}
                                    </td>

                                    <td>
                                        {{ $newsletter->created_at->format('d M Y, h:i A') }}
                                    </td>

                                    <td>

                                        <form action="{{ route('admin.newsletters.destroy', $newsletter->id) }}"
                                            method="POST" class="delete-newsletter-form" style="display: inline;">

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center py-4">

                                        No newsletter enquiries found.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                @if ($newsletters->hasPages())
                    <div class="mt-3">

                        {{ $newsletters->links() }}

                    </div>
                @endif

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
