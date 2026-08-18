@extends('front.layouts.app')

@section('content')
    <!-- Hero Section -->
    @if ($banners->count() && $bannerText)
        <section class="hero-section">
            @if ($banners->count())
                @foreach ($banners as $banner)
                    <div class="hero-slideshow">
                        <div class="hero-slide {{ $loop->first ? 'active' : '' }}"
                            style="background-image: linear-gradient(rgba(0,0,0,.45), rgba(0,0,0,.45)), url('{{ asset('uploads/banners/' . $banner->image) }}');">
                        </div>
                    </div>
                @endforeach
            @endif
            @if ($bannerText)
                <div class="container">
                    <div class="hero-content reveal">
                        <h1>{{ $bannerText->title }}</h1>
                        <p>{{ $bannerText->description }}</p>
                    </div>
                </div>
            @endif
        </section>
    @endif

    <!-- Welcome Section -->
    @if ($welcome)
        <section class="welcome-section">
            <div class="container">
                <div class="welcome-card-wrapper reveal">
                    <div class="welcome-card">
                        <div class="welcome-img-left reveal-left">
                            <img src="{{ asset('uploads/welcome-sections/' . $welcome->left_image) }}" alt="Resort View">
                        </div>
                        <div class="welcome-content">
                            <div class="section-label">{{ $welcome->sub_title }}</div>
                            <h2>{{ $welcome->title }}</h2>
                            <p class="subhead">{{ $welcome->description }}</p>
                            <div> <a href="{{ $welcome->button_url }}"
                                    class="btn-custom btn-outline-custom">{{ $welcome->button_text }}</a></div>
                        </div>
                        <div class="welcome-img-right d-none d-xl-block reveal-right">
                            <img src="{{ asset('uploads/welcome-sections/' . $welcome->right_image) }}" alt="Nature View">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    <!-- Resorts Section -->
    @if ($resortIntro || $resorts->count())
        <section class="pinned-section section-space-bottom" id="pinnedSection">
            <div class="container pinned-container">

                <!-- TOP CENTER SECTION HEADING -->
                @if ($resortIntro)
                    <div class="row">
                        <div class="col-12">
                            <div class="resort-header">
                                <span class="section-label">{{ $resortIntro->sub_title }}</span>
                                <h2 class="section-title">{{ $resortIntro->title }}</h2>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- CONTENT ROW -->
                @if ($resorts->count())
                    <div class="row align-items-center g-4 g-lg-5">

                        <!-- Left Column: Navigation Tabs -->
                        <div class="col-lg-4 col-xl-5">
                            <div class="tab-nav" id="tabNav">
                                @foreach ($resorts as $index => $resort)
                                    <button class="tab-nav-btn {{ $index === 0 ? 'active' : '' }}"
                                        data-index="{{ $index }}">
                                        {{ $resort->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Right Column: Moving Track Window -->
                        <div class="col-lg-8 col-xl-7">
                            <div class="resort-window" id="resortWindow">
                                <div class="resort-track" id="resortTrack">

                                    @foreach ($resorts as $index => $resort)
                                        <div class="resort-item {{ $index === 0 ? 'active' : '' }}"
                                            data-index="{{ $index }}">
                                            <div class="property-card">
                                                <div class="property-card-img-wrapper">
                                                    <img src="{{ asset('uploads/resorts/' . $resort->home_image) }}"
                                                        class="img-fluid" alt="{{ $resort->name }}">
                                                    <div class="property-overlay">
                                                        <a href="{{ $resort->url ?? '#' }}"
                                                            class="btn-explore">{{ $resort->home_button_text }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-description">
                                                <h5>{{ $resort->name }} - {{ $resort->home_place }}</h5>
                                                <p>{{ $resort->home_description }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            </div>
        </section>
    @endif

    <!-- Experiences Section -->
    @if ($homeexperiencepage || $homeexperiences->count())
        <section class="experiences-section section-space-bottom">
            <div class="container">
                <div class="reveal">
                    <div class="section-label">{{ $homeexperiencepage?->banner_title }}</div>
                    <h2>{{ $homeexperiencepage?->intro_subtitle }}</h2>
                </div>

                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="experience-main-card reveal-left">
                            <h3>{{ $homeexperiencepage?->intro_title }}</h3>
                            <p>{{ $homeexperiencepage?->intro_description }}</p>
                            <a href="{{ $homeexperiencepage->button_url }}"
                                class="btn-custom btn-custom-white">{{ $homeexperiencepage?->button_text }}</a>
                        </div>
                    </div>
                    @if ($homeexperiences->count())
                        <div class="col-lg-8">
                            <div class="row g-4">
                                @foreach ($homeexperiences as $key => $experience)
                                    <div class="col-md-6">
                                        <div class="experience-card reveal reveal-delay-{{ ($key % 2) + 1 }}">
                                            <div class="experience-icon">
                                                @if ($experience->image)
                                                    <img src="{{ asset('uploads/experience/items/' . $experience->image) }}"
                                                        alt="{{ $experience->title }}">
                                                @endif
                                            </div>
                                            <h4>{{ $experience->title }}</h4>
                                            <p>{{ $experience->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- Video Section -->
    @if ($video)
        <section class="video-section"
            style="background-image:
        linear-gradient(rgba(0,0,0,.3), rgba(0,0,0,.4)),
        url('{{ asset('uploads/video-sections/' . $video->thumbnail_image) }}');">
            <div class="d-flex flex-column align-items-center">
                <div class="play-button reveal-scale" data-bs-toggle="modal" data-bs-target="#videoModal">
                    <i class="bi bi-play-fill"></i>
                </div>
                <h3 class="reveal">{{ $video->title }}</h3>
            </div>


            <!-- Video Modal -->
            <div class="modal fade video-modal-blur" id="videoModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content bg-transparent border-0">

                        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                            data-bs-dismiss="modal" aria-label="Close"></button>

                        <div class="modal-body p-0">
                            <video id="popupVideo" class="w-100 rounded-3" controls>
                                <source src="{{ asset('uploads/video-sections/' . $video->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Offers Section -->
    @if ($offerIntro || $offers->count())
        <section class="offers-section section-space">
            <div class="container">
                @if ($offerIntro)
                    <div class="d-flex flex-column align-items-center reveal">
                        <div class="section-label">{{ $offerIntro->sub_title }}</div>
                        <h2 class="mb-3 text-center">{{ $offerIntro->title }}</h2>
                        <p class="subhead max-910 text-center">
                            {{ $offerIntro->description }}
                        </p>
                    </div>
                @endif

                @if ($offers->count())
                    <div class="row g-4 justify-content-center">
                        @foreach ($offers as $offer)
                            <div class="col-lg-6 reveal {{ $loop->odd ? 'reveal-left' : 'reveal-right' }}">
                                <div class="offer-card mb-2">
                                    <img src="{{ asset('uploads/offers/' . $offer->image) }}" class="img-fluid w-100"
                                        alt="Offer">
                                    <a href="{{ $offer->button_url }}"
                                        class="btn-custom btn-custom-white">{{ $offer->button_text }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($offersType2Count)
                        <div class="text-center mt-5">
                            <a href="{{ route('offers') }}" class="btn-custom btn-outline-custom">Find More Offers</a>
                        </div>
                    @endif
                @endif

            </div>
        </section>
    @endif

    <!-- Gallery Section -->
    @if ($galleryIntro || $galleries->count())
        <section class="gallery-section">
            @if ($galleryIntro)
                <div class="container">
                    <div class="gallery-header mb-5 reveal">

                        <div class="section-label">{{ $galleryIntro->sub_title }}</div>
                        <h2 class="mb-3">{{ $galleryIntro->title }}</h2>
                        <p class="subhead max-910">
                            {{ $galleryIntro->description }}
                        </p>

                    </div>
                </div>
            @endif


            @if ($galleries->count())
                <div class="gallery-slider-wrapper reveal">
                    <div class="gallery-track">
                        {{-- First Set --}}
                        @foreach ($galleries as $gallery)
                            <div class="gallery-slide {{ $loop->odd ? 'gallery-slide-tall' : 'gallery-slide-short' }}">
                                <img src="{{ asset('uploads/galleries/' . $gallery->image) }}" alt="Gallery Image">
                            </div>
                        @endforeach
                        {{-- Second Set for seamless loop --}}
                        @foreach ($galleries as $gallery)
                            <div class="gallery-slide {{ $loop->even ? 'gallery-slide-tall' : 'gallery-slide-short' }}">
                                <img src="{{ asset('uploads/galleries/' . $gallery->image) }}" alt="Gallery Image">
                            </div>
                        @endforeach
                    </div>
                </div>

                @if ($galleryType2Count)
                    <div class="text-center mt-5">
                        <a href="{{ route('gallery') }}" class="btn-custom btn-outline-custom">View Our Gallery</a>
                    </div>
                @endif
            @endif
        </section>
    @endif

    <!-- Testimonials Section -->
    @if ($testimonialIntro || $testimonials->count())
        <section class="testimonials-section section-space">
            @if ($testimonialIntro)
                <div class=" container">
                    <div class="text-center reveal d-flex flex-column align-items-center reveal">
                        <div class="section-label">{{ $testimonialIntro->sub_title }}</div>
                        <h2 class="mb-3">{{ $testimonialIntro->title }}</h2>
                        <p class="subhead max-910 text-center">
                            {{ $testimonialIntro->description }}
                        </p>
                    </div>
                </div>
            @endif

            @if ($testimonials->count())
                @php
                    $tagClasses = ['tag-green', 'tag-brown', 'tag-blue'];
                    $tagIndex = 0;
                @endphp
                <div class="testimonial-slider-wrapper reveal">
                    <div class="testimonial-track">
                        {{-- First Set --}}
                        @foreach ($testimonials->chunk(2) as $column)
                            <div class="testimonial-slide">
                                @foreach ($column as $testimonial)
                                    <div class="testimonial-card {{ !$loop->first ? 'testimonial-card-offset' : '' }}">
                                        <span
                                            class="testimonial-tag {{ $tagClasses[$tagIndex % count($tagClasses)] }}">{{ $testimonial->resort?->name }}</span>
                                        <h5>"{{ $testimonial->title }}"</h5>
                                        <p>"{{ $testimonial->content }}"</p>
                                        <div class="testimonial-author">
                                            <img src="{{ asset('uploads/testimonials/' . $testimonial->customer_image) }}"
                                                alt="{{ $testimonial->customer_name }}" class="author-img">
                                            <span class="author-name">— {{ $testimonial->customer_name }},
                                                {{ $testimonial->customer_place }}</span>
                                        </div>
                                    </div>
                                    @php $tagIndex++; @endphp
                                @endforeach
                            </div>
                        @endforeach

                        {{-- Second Set for seamless loop --}}
                        @php
                            $tagIndex = 0; // Reset index for matching colors
                        @endphp
                        @foreach ($testimonials->chunk(2) as $column)
                            <div class="testimonial-slide">
                                @foreach ($column as $testimonial)
                                    <div class="testimonial-card {{ !$loop->first ? 'testimonial-card-offset' : '' }}">
                                        <span
                                            class="testimonial-tag {{ $tagClasses[$tagIndex % count($tagClasses)] }}">{{ $testimonial->resort?->name }}</span>
                                        <h5>"{{ $testimonial->title }}"</h5>
                                        <p>"{{ $testimonial->content }}"</p>
                                        <div class="testimonial-author">
                                            <img src="{{ asset('uploads/testimonials/' . $testimonial->customer_image) }}"
                                                alt="{{ $testimonial->customer_name }}" class="author-img">
                                            <span class="author-name">— {{ $testimonial->customer_name }},
                                                {{ $testimonial->customer_place }}</span>
                                        </div>
                                    </div>
                                    @php $tagIndex++; @endphp
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>
    @endif


    {{--  @if ($testimonialIntro || $testimonials->count())
        <section class="testimonials-section section-space">
            @if ($testimonialIntro)
                <div class=" container">
                    <div class="text-center reveal d-flex flex-column align-items-center reveal">
                        <div class="section-label">{{ $testimonialIntro->sub_title }}</div>
                        <h2 class="mb-3">{{ $testimonialIntro->title }}</h2>
                        <p class="subhead max-910 text-center">
                            {{ $testimonialIntro->description }}
                        </p>
                    </div>
                </div>
            @endif

            @if ($testimonials->count())
                @php
                    $tagClasses = ['tag-green', 'tag-brown', 'tag-blue'];
                    $tagIndex = 0;
                @endphp
                <div class="testimonial-slider-wrapper reveal">
                    <div class="testimonial-track">
                        @foreach ($testimonials->chunk(2) as $column)
                            <div class="testimonial-slide">
                                @foreach ($column as $testimonial)
                                    <div class="testimonial-card {{ !$loop->first ? 'testimonial-card-offset' : '' }}">
                                        <span
                                            class="testimonial-tag {{ $tagClasses[$tagIndex % count($tagClasses)] }}">{{ $testimonial->resort?->name }}</span>
                                        <h5>"{{ $testimonial->title }}"</h5>
                                        <p>"{{ $testimonial->content }}"</p>
                                        <div class="testimonial-author">
                                            <img src="{{ asset('uploads/testimonials/' . $testimonial->customer_image) }}"
                                                alt="{{ $testimonial->customer_name }}" class="author-img">
                                            <span class="author-name">— {{ $testimonial->customer_name }},
                                                {{ $testimonial->customer_place }}</span>
                                        </div>
                                    </div>
                                    @php $tagIndex++; @endphp
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>
    @endif  --}}
@endsection
