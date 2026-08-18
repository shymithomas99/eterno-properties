@extends('front.layouts.app')
@section('title', 'Experiences | ')

@section('content')
    <!-- ========== HERO BANNER ========== -->

    <section class="hero-banner experience-banner"
        style="background:
            linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
            url('{{ $experiencepage?->banner_image ? asset($experiencepage->banner_image) : asset('images/contact-hero-bg.jpg') }}')
            center/cover no-repeat;">
        <div class="hero-inner-content px-2 reveal">
            <h1>{{ $experiencepage->banner_title }}</h1>

            <p>
                {{ $experiencepage->banner_description }}
            </p>
        </div>

        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>&rsaquo;</span>
            Experience
        </div>
    </section>

    <!-- ========== heading section ========== -->
    <section class="exp-main section-space">
        <div class="container text-center reveal">

            <div class="section-label mb-4">
                {{ $experiencepage->intro_subtitle }}
            </div>

            <h3 class="subhead-v2">
                {{ $experiencepage->intro_description }}
            </h3>

        </div>
    </section>


    <section class="exp-section">
        <div class="container">
            @foreach ($experiences as $index => $experience)
                <div
                    class="row align-items-center g-0 g-xl-4 mb-180
                {{ $index % 2 == 1 ? 'mountain-bg' : '' }}
                {{ $index % 2 == 0 ? 'reveal-left' : 'reveal-right' }}">

                    {{-- Image --}}
                    <div class="col-xl-7
                    {{ $index % 2 == 1 ? 'order-1 order-xl-2' : '' }}">
                        <div class="exp-img-wrapper img-height">
                            <img src="{{ asset('uploads/experience/items/' . $experience->image) }}"
                                alt="{{ $experience->subtitle }}">
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="col-xl-5
                    {{ $index % 2 == 1 ? 'order-2 order-xl-1' : '' }}">

                        <div class="exp-card">

                            <div class="section-label mb-4">
                                {{ $experience->subtitle }}
                            </div>

                            <h3 class="mb-3">
                                {{ $experience->title }}
                            </h3>

                            <p class="subhead mb-4 mb-md-5">
                                {{ $experience->description }}
                            </p>

                            @if (!empty($experience->experience_list))
                                <p class="subhead fw-semibold mb-2">
                                    Experiences include:
                                </p>

                                <ul class="exp-list">

                                    @foreach (preg_split('/\r\n|\r|\n/', $experience->experience_list) as $item)
                                        @if (trim($item) !== '')
                                            <li>{{ trim($item) }}</li>
                                        @endif
                                    @endforeach

                                </ul>
                            @endif

                        </div>

                    </div>

                </div>
            @endforeach
        </div>
    </section>


    <!-- Gallery Section -->
    <section class="img-gallery">
        <div class="">
            <div class="row g-0">
                @foreach ($experiencegallaries as $gallery)
                    <div class="col-6 col-md-4 col-lg-2 fade-in-up">
                        <div class="img-gallery-item">
                            <img src="{{ asset('uploads/galleries/' . $gallery->image) }}" alt="Experience Gallery"
                                class="gallery-img">
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
