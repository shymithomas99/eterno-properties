<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="CAMS">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="{{ config('app.name', 'Laravel') }}">
    <meta name="description" content="">

    <title>@yield('title', '') | Admin | {{ config('app.name', 'Laravel') }}</title>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('img/favicon-48x48.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <meta property="og:image" content="{{ asset('img/logo.png') }}">
    <meta property="og:site_name" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @stack('style')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"
            style="background: #8e734b;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
                <!--<div class="sidebar-brand-icon rotate-n-15">-->
                <!--    <i class="fas fa-laugh-wink"></i>-->
                <!--</div>-->
                <div class="sidebar-brand-text mx-3"><img class="" src="{{ asset('img/logo.png') }}"
                        style="width: 90px;height: 55px;margin-left: 55px;margin-top: 7px;"></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Tables -->

            <li class="nav-item {{ request()->is('admin/resorts/1*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.resorts.index', 1) }}"> <i class="fas fa-building"></i>
                    <span>Resorts</span>
                </a>
            </li>


            @php
                $homeMenuOpen = request()->is('admin/banners/1/1*') ||
                                request()->is('admin/banners/2*') ||
                                request()->is('admin/welcome-section*') ||
                                request()->is('admin/resort-intro*') ||
                                request()->is('admin/resorts/2*') ||
                                request()->is('admin/experiences/1*') ||
                                request()->is('admin/experience-items/1*') ||
                                request()->is('admin/video-section*') ||
                                request()->is('admin/offer-intro/1*') ||
                                request()->is('admin/offers/1*') ||
                                request()->is('admin/gallery-intro/1*') ||
                                request()->is('admin/gallery/1*') ||
                                request()->is('admin/testimonial-intro*') ||
                                request()->is('admin/testimonials*');
            @endphp

            <li class="nav-item {{ $homeMenuOpen ? 'active' : '' }}">
                <a class="nav-link {{ $homeMenuOpen ? '' : 'collapsed' }}" href="#" data-toggle="collapse"
                    data-target="#collapseHome" aria-expanded="{{ $homeMenuOpen ? 'true' : 'false' }}"
                    aria-controls="collapseHome">

                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>

                <div id="collapseHome" class="collapse {{ $homeMenuOpen ? 'show' : '' }}" aria-labelledby="headingHome"
                    data-parent="#accordionSidebar">

                    <div class="bg-white py-2 collapse-inner rounded">

                        @php
                            $homeBannerMenuOpen =
                                request()->is('admin/banners/1/1*') || request()->is('admin/banners/2*');
                        @endphp

                        <a class="collapse-item {{ $homeBannerMenuOpen ? 'active' : '' }}" href="#"
                            data-toggle="collapse" data-target="#collapseHomeBanners"
                            aria-expanded="{{ $homeBannerMenuOpen ? 'true' : 'false' }}"
                            aria-controls="collapseHomeBanners">
                            Manage Banners
                        </a>

                        <div id="collapseHomeBanners" class="collapse {{ $homeBannerMenuOpen ? 'show' : '' }}">

                            <div class="bg-light py-2 collapse-inner rounded">
                                <a class="collapse-item {{ request()->is('admin/banners/1/1*') ? 'active' : '' }}"
                                    href="{{ route('admin.banners.edit', ['type' => 1, 'banner' => 1]) }}">
                                    Intro
                                </a>

                                <a class="collapse-item {{ request()->is('admin/banners/2*') ? 'active' : '' }}"
                                    href="{{ route('admin.banners.index', 2) }}">
                                    Images
                                </a>
                            </div>
                        </div>

                        <a class="collapse-item {{ request()->is('admin/welcome-section*') ? 'active' : '' }}"
                            href="{{ route('admin.welcome-section.edit') }}">
                            Welcome
                        </a>

                        @php
                            $homeResortMenuOpen =
                                request()->is('admin/resort-intro*') ||
                                request()->is('admin/resorts/2*');
                        @endphp

                        <a class="collapse-item {{ $homeResortMenuOpen ? 'active' : '' }}"
                            href="#" data-toggle="collapse" data-target="#collapseHomeResorts"
                            aria-expanded="{{ $homeResortMenuOpen ? 'true' : 'false' }}"
                            aria-controls="collapseHomeResorts">
                            Manage Resorts
                        </a>

                        <div id="collapseHomeResorts"
                            class="collapse {{ $homeResortMenuOpen ? 'show' : '' }}">

                            <div class="bg-light py-2 collapse-inner rounded">
                                <a class="collapse-item {{ request()->is('admin/resort-intro*') ? 'active' : '' }}"
                                    href="{{ route('admin.resort-intro.edit') }}">
                                    Intro
                                </a>
                                
                                <a class="collapse-item {{ request()->is('admin/resorts/2*') ? 'active' : '' }}"
                                    href="{{ route('admin.resorts.index', 2) }}">
                                    Resorts
                                </a>
                            </div>
                        </div>

                        <a class="collapse-item {{ request()->is('admin/video-section*') ? 'active' : '' }}"
                            href="{{ route('admin.video-section.edit') }}">
                            Video
                        </a>

                        {{--
                        <a class="collapse-item {{ request()->is('admin/experiences/1*') ? 'active' : '' }}"
                            href="{{ route('admin.experiences.edit', 1) }}">
                            Experiences
                        </a>

                        <a class="collapse-item {{ request()->is('admin/experience-items/1*') ? 'active' : '' }}"
                            href="{{ route('admin.experience-items.index', 1) }}">
                            Experience Items
                        </a>  --}}



                        {{-- Experiences Dropdown --}}
                        <a class="collapse-item {{ request()->is('admin/experiences/1*') || request()->is('admin/experience-items/1*') ? 'active' : '' }}"
                            href="#" data-toggle="collapse" data-target="#collapseExperiences"
                            aria-expanded="{{ request()->is('admin/experiences/1*') || request()->is('admin/experience-items/1*') ? 'true' : 'false' }}"
                            aria-controls="collapseExperiences">
                            Manage Experiences
                        </a>

                        <div id="collapseExperiences"
                            class="collapse {{ request()->is('admin/experiences/1*') || request()->is('admin/experience-items/1*') ? 'show' : '' }}">

                            <div class="bg-light py-2 collapse-inner rounded">

                                <a class="collapse-item {{ request()->is('admin/experiences/1*') ? 'active' : '' }}"
                                    href="{{ route('admin.experiences.edit', 1) }}">
                                    Intro
                                </a>

                                <a class="collapse-item {{ request()->is('admin/experience-items/1*') ? 'active' : '' }}"
                                    href="{{ route('admin.experience-items.index', 1) }}">
                                    Experiences
                                </a>

                            </div>
                        </div>

                        @php
                            $homeOfferMenuOpen =
                                request()->is('admin/offer-intro/1*') || request()->is('admin/offers/1*');
                        @endphp

                        <a class="collapse-item {{ $homeOfferMenuOpen ? 'active' : '' }}" href="#"
                            data-toggle="collapse" data-target="#collapseHomeOffers"
                            aria-expanded="{{ $homeOfferMenuOpen ? 'true' : 'false' }}"
                            aria-controls="collapseHomeOffers">
                            Manage Offers
                        </a>

                        <div id="collapseHomeOffers" class="collapse {{ $homeOfferMenuOpen ? 'show' : '' }}">

                            <div class="bg-light py-2 collapse-inner rounded">
                                <a class="collapse-item {{ request()->is('admin/offer-intro/1*') ? 'active' : '' }}"
                                    href="{{ route('admin.offer-intro.edit', 1) }}">
                                    Intro
                                </a>

                                <a class="collapse-item {{ request()->is('admin/offers/1*') ? 'active' : '' }}"
                                    href="{{ route('admin.offers.index', 1) }}">
                                    Offers
                                </a>
                            </div>
                        </div>

                        @php
                            $homeGalleryMenuOpen =
                                request()->is('admin/gallery-intro/1*') ||
                                request()->is('admin/gallery/1*');
                        @endphp

                        <a class="collapse-item {{ $homeGalleryMenuOpen ? 'active' : '' }}" href="#"
                            data-toggle="collapse" data-target="#collapseHomeGallery"
                            aria-expanded="{{ $homeGalleryMenuOpen ? 'true' : 'false' }}"
                            aria-controls="collapseHomeGallery">
                            Manage Gallery
                        </a>

                        <div id="collapseHomeGallery" class="collapse {{ $homeGalleryMenuOpen ? 'show' : '' }}">

                            <div class="bg-light py-2 collapse-inner rounded">
                                <a class="collapse-item {{ request()->is('admin/gallery-intro/1*') ? 'active' : '' }}"
                                    href="{{ route('admin.gallery-intro.edit', 1) }}">
                                    Intro
                                </a>
                                
                                <a class="collapse-item {{ request()->is('admin/gallery/1*') ? 'active' : '' }}"
                                    href="{{ route('admin.galleries.index', 1) }}">
                                    Gallery
                                </a>
                            </div>
                        </div>

                        @php
                            $homeTestimonialMenuOpen =
                                request()->is('admin/testimonial-intro*') || request()->is('admin/testimonials*');
                        @endphp

                        <a class="collapse-item {{ $homeTestimonialMenuOpen ? 'active' : '' }}" href="#"
                            data-toggle="collapse" data-target="#collapseHomeTestimonials"
                            aria-expanded="{{ $homeTestimonialMenuOpen ? 'true' : 'false' }}"
                            aria-controls="collapseHomeTestimonials">
                            Manage Testimonials
                        </a>

                        <div id="collapseHomeTestimonials"
                            class="collapse {{ $homeTestimonialMenuOpen ? 'show' : '' }}">

                            <div class="bg-light py-2 collapse-inner rounded">
                                <a class="collapse-item {{ request()->is('admin/testimonial-intro*') ? 'active' : '' }}"
                                    href="{{ route('admin.testimonial-intro.edit') }}">
                                    Intro
                                </a>

                                <a class="collapse-item {{ request()->is('admin/testimonials*') ? 'active' : '' }}"
                                    href="{{ route('admin.testimonials.index') }}">
                                    Testimonials
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </li>

            <li
                class="nav-item {{ request()->is('admin/about*') || request()->is('admin/philosophies*') || request()->is('admin/core-values*') ? 'active' : '' }}">
                <a class="nav-link {{ request()->is('admin/about*') || request()->is('admin/philosophies*') || request()->is('admin/core-values*') ? '' : 'collapsed' }}"
                    href="#" data-toggle="collapse" data-target="#collapseAbout"
                    aria-expanded="{{ request()->is('admin/about*') || request()->is('admin/philosophies*') || request()->is('admin/core-values*') ? 'true' : 'false' }}"
                    aria-controls="collapseAbout">
                    <i class="fas fa-info-circle"></i>
                    <span>About</span>
                </a>

                <div id="collapseAbout"
                    class="collapse {{ request()->is('admin/about*') || request()->is('admin/philosophies*') || request()->is('admin/core-values*') ? 'show' : '' }}"
                    data-parent="#accordionSidebar">

                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->is('admin/about') ? 'active' : '' }}"
                            href="{{ route('admin.about.edit') }}">
                            Banner / About / CTA
                        </a>

                        <a class="collapse-item {{ request()->is('admin/philosophies*') ? 'active' : '' }}"
                            href="{{ route('admin.philosophies.index') }}">
                            Philosophy
                        </a>

                        <a class="collapse-item {{ request()->is('admin/core-values*') ? 'active' : '' }}"
                            href="{{ route('admin.core-values.index') }}">
                            Core Values
                        </a>
                    </div>

                </div>

            </li>

            <li class="nav-item {{ request()->is('admin/resorts/3*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.resorts.index', 3) }}"> <i class="fas fa-building"></i>
                    <span>Resorts (Mega Menu)</span>
                </a>
            </li>


            @php
                $offerMenuOpen = request()->is('admin/offer-intro/2*') || request()->is('admin/offers/2*');
            @endphp

            <li class="nav-item {{ $offerMenuOpen ? 'active' : '' }}">
                <a class="nav-link {{ $offerMenuOpen ? '' : 'collapsed' }}" href="#" data-toggle="collapse"
                    data-target="#collapseOffer" aria-expanded="{{ $offerMenuOpen ? 'true' : 'false' }}"
                    aria-controls="collapseOffer">

                    <i class="fas fa-tag"></i>
                    <span>Manage Offers</span>
                </a>

                <div id="collapseOffer" class="collapse {{ $offerMenuOpen ? 'show' : '' }}"
                    aria-labelledby="headingOffer" data-parent="#accordionSidebar">

                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->is('admin/offer-intro/2*') ? 'active' : '' }}"
                            href="{{ route('admin.offer-intro.edit', 2) }}">
                            Intro
                        </a>

                        <a class="collapse-item {{ request()->is('admin/offers/2*') ? 'active' : '' }}"
                            href="{{ route('admin.offers.index', 2) }}">
                            Offers
                        </a>
                    </div>
                </div>
            </li>


            <li
                class="nav-item {{ request()->is('admin/experiences/2*') || request()->is('admin/experience-items/2*') || request()->is('admin/gallery/3*') ? 'active' : '' }}">

                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseExperience">
                    <i class="fas fa-map"></i>
                    <span>Manage Experiences</span>
                </a>

                <div id="collapseExperience"
                    class="collapse {{ request()->is('admin/experiences/2*') || request()->is('admin/experience-items/2*') || request()->is('admin/gallery/3*') ? 'show' : '' }}"
                    data-parent="#accordionSidebar">

                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->is('admin/experiences/2*') ? 'active' : '' }}"
                            href="{{ route('admin.experiences.edit', 2) }}">
                            Intro
                        </a>

                        <a class="collapse-item {{ request()->is('admin/experience-items/2*') ? 'active' : '' }}"
                            href="{{ route('admin.experience-items.index', 2) }}">
                            Experiences
                        </a>

                        <a class="collapse-item {{ request()->is('admin/gallery/3*') ? 'active' : '' }}"
                            href="{{ route('admin.galleries.index', 3) }}">
                            Gallery
                        </a>
                    </div>

                </div>

            </li>


            @php
                $galleryMenuOpen = request()->is('admin/gallery-intro/2*') || request()->is('admin/gallery-categories*') || request()->is('admin/gallery/2*');
            @endphp

            <li class="nav-item {{ $galleryMenuOpen ? 'active' : '' }}">
                <a class="nav-link {{ $galleryMenuOpen ? '' : 'collapsed' }}" href="#" data-toggle="collapse"
                    data-target="#collapseGallery" aria-expanded="{{ $galleryMenuOpen ? 'true' : 'false' }}"
                    aria-controls="collapseGallery">

                    <i class="fas fa-image"></i>
                    <span>Manage Gallery</span>
                </a>

                <div id="collapseGallery" class="collapse {{ $galleryMenuOpen ? 'show' : '' }}"
                    aria-labelledby="headingGallery" data-parent="#accordionSidebar">

                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->is('admin/gallery-intro/2*') ? 'active' : '' }}"
                            href="{{ route('admin.gallery-intro.edit', 2) }}">
                            Intro
                        </a>

                        <a class="collapse-item {{ request()->is('admin/gallery-categories*') ? 'active' : '' }}"
                            href="{{ route('admin.gallery-categories.index') }}">
                            Category
                        </a>

                        <a class="collapse-item {{ request()->is('admin/gallery/2*') ? 'active' : '' }}"
                            href="{{ route('admin.galleries.index', 2) }}">
                            Gallery
                        </a>
                    </div>
                </div>
            </li>


            <li
                class="nav-item {{ request()->is('admin/contact*') || request()->is('admin/contact-enquiry*') ? 'active' : '' }}">

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#contactMenu"
                    aria-expanded="{{ request()->is('admin/contact*') || request()->is('admin/contact-enquiry*') ? 'true' : 'false' }}">

                    <i class="fas fa-envelope"></i>
                    <span>Manage Contact</span>

                </a>

                <div id="contactMenu"
                    class="collapse {{ request()->is('admin/contact*') || request()->is('admin/contact-enquiry*') ? 'show' : '' }}">

                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->is('admin/contact') ? 'active' : '' }}"
                            href="{{ route('admin.contact-page.edit') }}">
                            Page
                        </a>

                        <a class="collapse-item {{ request()->is('admin/contact-enquiry*') ? 'active' : '' }}"
                            href="{{ route('admin.contact-enquiry.index') }}">
                            Enquiries
                        </a>

                    </div>

                </div>

            </li>


            <li class="nav-item {{ request()->is('admin/resorts/4*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.resorts.index', 4) }}"> <i class="fas fa-building"></i>
                    <span>Resorts (Book Now)</span>
                </a>
            </li>

            {{--  <li class="nav-item {{ request()->is('admin/contact-page*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.contact-page.edit') }}"> <i class="fas fa-envelope"></i>
                    <span>Contact</span>
                </a>
            </li>  --}}


            {{-- Settings --}}
            <li class="nav-item {{ request()->routeIs('admin.settings.edit') ? 'active' : '' }}">

                <a class="nav-link {{ request()->routeIs('admin.settings.edit') ? '' : 'collapsed' }}"
                    href="{{ route('admin.settings.edit') }}">

                    <i class="fas fa-cog"></i>
                    <span>Settings</span>

                </a>

            </li>
            {{-- Newsletter Enquiries --}}
            <li class="nav-item {{ request()->routeIs('admin.newsletters.*') ? 'active' : '' }}">

                <a class="nav-link" href="{{ route('admin.newsletters.index') }}">

                    <i class="fas fa-envelope"></i>

                    <span>Newsletter Subscribers</span>

                </a>

            </li>









            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fas fa-bars"></i>
                        </button>
                    </form>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>© {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All Rights Reserved.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to logout?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>

    @stack('modal')

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>-->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    @stack('script')

</body>

</html>
