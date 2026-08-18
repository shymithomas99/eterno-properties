@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- (Count) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
                <a href="{{ route('admin.resorts.index', 1) }}" class="text-decoration-none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Resorts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $resortCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-building fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-4 mb-4">
                <a href="{{ route('admin.offers.index', 2) }}" class="text-decoration-none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Offers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $resortCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tag fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-4 mb-4">
                <a href="{{ route('admin.experience-items.index', 2) }}" class="text-decoration-none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Experiences</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $experienceCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-map fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-4 mb-4">
                <a href="{{ route('admin.galleries.index', 2) }}" class="text-decoration-none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Gallery</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $galleryCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-image fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-4 mb-4">
                <a href="{{ route('admin.contact-enquiry.index') }}" class="text-decoration-none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Enquiries</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $contactEnqCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-4 mb-4">
                <a href="{{ route('admin.newsletters.index') }}" class="text-decoration-none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Subscribers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $newsletterSubCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
	
        </div>

        

    </div>
    <!-- /.container-fluid -->

@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
@endpush
@endsection