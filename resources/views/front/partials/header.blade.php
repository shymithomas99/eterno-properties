<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('images/favicon-48x48.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Eterno Hotels & Resorts">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto my-3 my-lg-0">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about-us') ? 'active' : '' }}"
                            href="{{ route('about-us') }}">About Us</a>
                    </li>


                    <li class="nav-item mega-dropdown">

                        <a class="nav-link" href="#" id="megaTrigger">
                            Our Resorts
                            <i class="bi bi-chevron-down" style="font-size:0.7rem; margin-left:3px;">
                            </i>
                        </a>
                        @if ($megaMenuResorts->count())
                            <div class="mega-menu">
                                <div class="container">
                                    <div class="row">
                                        {{-- Resort List --}}
                                        <div class="col-lg-4 col-xxl-3">
                                            <ul class="mega-resort-list">
                                                @foreach ($megaMenuResorts as $key => $resort)
                                                    <li>
                                                        <a href="{{ $resort->url }}"
                                                            class="{{ $key === 0 ? 'active' : '' }}"
                                                            data-image="{{ asset('uploads/resorts/' . $resort->mega_menu_image) }}"
                                                            data-title="{{ $resort->mega_menu_title }}"
                                                            data-subtitle="{{ $resort->mega_menu_sub_title }}"
                                                            data-description="{{ $resort->mega_menu_description }}">
                                                            {{ $resort->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        {{-- Resort Image --}}
                                        <div class="col-lg-4">
                                            <div class="mega-image">
                                                @if ($megaMenuResorts->count())
                                                    <img id="megaImage"
                                                        src="{{ asset('uploads/resorts/' . $megaMenuResorts->first()->mega_menu_image) }}"
                                                        alt="{{ $megaMenuResorts->first()->name }}">
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Resort Content --}}
                                        <div class="col-lg-4 col-xxl-5">
                                            <div class="mega-content">
                                                @if ($megaMenuResorts->count())
                                                    <h3 id="megaTitle">
                                                        {{ $megaMenuResorts->first()->mega_menu_title }}
                                                    </h3>
                                                    <h5 id="megaSubtitle">
                                                        {{ $megaMenuResorts->first()->mega_menu_sub_title }}
                                                    </h5>
                                                    <p id="megaDescription">
                                                        {{ $megaMenuResorts->first()->mega_menu_description }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('offers') ? 'active' : '' }}"
                            href="{{ route('offers') }}">
                            Offers
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('experiences') ? 'active' : '' }}"
                            href="{{ route('experiences') }}">
                            Experiences
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}"
                            href="{{ route('gallery') }}">
                            Gallery
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                            href="{{ route('contact') }}">
                            Contact
                        </a>
                    </li>
                </ul>
                <a href="#" class="btn-custom  btn-primary-custom" id="bookNowBtn">Book Now</a>
            </div>
        </div>
    </nav>

    <!-- Book Now Modal -->
    @if ($bookNowResorts->count())
        <div class="book-modal-overlay" id="bookModal">
            <div class="book-modal">
                <button class="book-modal-close" id="bookModalClose"><i class="bi bi-x-lg"></i></button>
                <h3>Select Your Resort</h3>
                <p>Choose a resort to continue with your booking</p>
                <div class="book-modal-grid">
                    @foreach ($bookNowResorts as $resort)
                        <a href="{{ $resort->url ?? '#' }}" class="book-modal-item">
                            <img src="{{ asset('uploads/resorts/' . $resort->book_now_image) }}"
                                alt="{{ $resort->name }}">
                            <span>{{ $resort->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
