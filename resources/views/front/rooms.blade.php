@extends('front.layouts.app')
@section('title', 'Offers | ')
{{--  <title>Room Selection | Eterno Resort</title>  --}}
@section('content')

    <!-- SVG Definitions (Hidden) - UNIFIED ICON FAMILY -->
    <svg style="display: none;">
        <!-- Room Size Icon: Simple square with dimension arrows -->
        <symbol id="icon-size" viewBox="0 0 24 24">
            <rect x="4" y="4" width="16" height="16" rx="1" />
            <path d="M9 4v16M15 4v16M4 9h16M4 15h16" />
        </symbol>
        <!-- Bed Size Icon: Minimal bed outline -->
        <symbol id="icon-bed" viewBox="0 0 24 24">
            <path d="M3 18v-6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v6" />
            <path d="M3 14h18" />
            <path d="M7 10V8a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2" />
        </symbol>

        <!-- Guests Icon: Two people outline -->
        <symbol id="icon-guests" viewBox="0 0 24 24">
            <circle cx="9" cy="8" r="3" />
            <path d="M3 20v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" />
            <circle cx="17" cy="8" r="2.5" />
            <path d="M21 20v-2a3 3 0 0 0-2-2.83" />
        </symbol>

        <!-- View Icon: Mountain peaks -->
        <symbol id="icon-view" viewBox="0 0 24 24">
            <path d="M8 3l4 8 5-5 5 15H2L8 3z" />
        </symbol>
    </svg>

    <section class="hero-banner contact-banner"
        style="
        background-image:
        linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
             url('{{ $roomPage?->banner_image ? asset('uploads/room-page/' . $roomPage->banner_image) : '' }}');
    ">
        <div class="hero-inner-content px-2">
            <h1>
                {{ $roomPage?->title ?? 'Select Your Sanctuary' }}
            </h1>
            <p>
                {{ $roomPage?->description ??
                    'Discover our collection of thoughtfully designed rooms and tree houses, each offering a unique perspective of the Western Ghats.' }}
            </p>
        </div>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>&rsaquo;</span>
            Rooms
        </div>

    </section>

    <section class="section-space">
        <div class="container">
            <!-- ROOMS LISTING -->
            <div class="room-list">

                @foreach ($rooms as $index => $room)
                    @php
                        $reverse = $index % 2 === 1;
                        $galleryId = 'gallery-' . $room->id;
                        $mainImage = $room->main_image
                            ? asset('uploads/rooms/' . $room->main_image)
                            : 'https://via.placeholder.com/1200x800?text=Room';
                    @endphp

                    <article class="room-card" data-gallery="{{ $galleryId }}">
                        <div class="row g-0 h-100 {{ $reverse ? 'flex-lg-row-reverse' : '' }}">
                            <div class="col-lg-6">
                                <div class="room-image-wrapper">
                                    <img src="{{ $mainImage }}" alt="{{ $room->name }}">
                                    <div class="gallery-trigger"><i class="fas fa-images"></i> View Gallery</div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex">
                                <div class="room-info w-100">
                                    <h3>{{ $room->name }}</h3>
                                    <p class="room-desc">{{ $room->description }}</p>

                                    <div class="room-specs">
                                        <div class="spec-item">
                                            <svg class="spec-icon-svg">
                                                <use href="#icon-bed"></use>
                                            </svg>
                                            <span class="spec-text">{{ $room->bed_type }}</span>
                                        </div>
                                        <div class="spec-item">
                                            <svg class="spec-icon-svg">
                                                <use href="#icon-guests"></use>
                                            </svg>
                                            <span class="spec-text">{{ $room->guests }}</span>
                                        </div>
                                        <div class="spec-item">
                                            <svg class="spec-icon-svg">
                                                <use href="#icon-size"></use>
                                            </svg>
                                            <span class="spec-text">{{ $room->size }}</span>
                                        </div>
                                        <div class="spec-item">
                                            <svg class="spec-icon-svg">
                                                <use href="#icon-view"></use>
                                            </svg>
                                            <span class="spec-text">{{ $room->view }}</span>
                                        </div>
                                    </div>

                                    <div class="card-action-area">
                                        <a href="{{ route('booking-form', ['resort' => $room->slug]) }}"
                                            class="btn-custom btn-primary-custom" onclick="event.stopPropagation()">Book
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="{{ $galleryId }}" style="display:none;">
                            @if ($room->main_image)
                                <img src="{{ asset('uploads/rooms/' . $room->main_image) }}" alt="{{ $room->name }}">
                            @endif

                            @foreach ($room->galleryImages as $g)
                                @if (!$room->main_image || $g->image !== $room->main_image)
                                    <img src="{{ asset('uploads/rooms/gallery-images/' . $g->image) }}"
                                        alt="{{ $room->name }}">
                                @endif
                            @endforeach
                        </div>

                    </article>
                @endforeach

            </div>

            <!-- AMENITIES SECTIONS (STACKED VERTICALLY) -->
            <div class="amenities-wrapper">
                <div class="d-flex flex-column">

                    @foreach ($amenityCategories as $category)
                        <div class="amenities-card">
                            <h3 class="amenities-card-title">{{ $category->name }}</h3>
                            <div class="row amenities-grid">
                                @foreach ($category->amenities as $amenity)
                                    <div class="col-6 col-md-6 col-lg-3">
                                        <div class="amenity-item"><i class="fas fa-check amenity-check"></i><span
                                                class="amenity-text">{{ $amenity->name }}</span></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <!-- ENHANCED CTA SECTION (RENAMED TO booking-banner) -->
            <div class="booking-banner">
                <div class="banner-content">
                    <span class="banner-label">Begin Your Journey</span>
                    <div class="banner-divider"></div>
                    <h2 class="banner-title">Ready to Experience the Tranquility of Bison Valley?</h2>
                    <p class="banner-description">
                        Reserve your sanctuary amidst the mist-kissed hills and verdant forests.
                        Let us craft an unforgettable retreat tailored to your desires.
                    </p>
                    <a href="{{ route('booking-form') }}" class="btn-custom btn-primary-custom">Book Your Stay Now</a>
                </div>
            </div>

        </div>
    </section>

    <!-- Lightbox Structure -->
    <div id="lightbox" class="lightbox-overlay">
        <button class="lb-close" onclick="closeLightbox()">&times;</button>
        <button class="lb-nav lb-prev" onclick="navigateLightbox(-1)"><i class="fas fa-chevron-left"></i></button>
        <img id="lb-image" class="lb-img" src="" alt="Room Gallery">
        <button class="lb-nav lb-next" onclick="navigateLightbox(1)"><i class="fas fa-chevron-right"></i></button>
    </div>
@endsection

@push('scripts')
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Extract gallery images directly from HTML elements
        function getGalleryImages(galleryId) {
            const container = document.getElementById(galleryId);
            if (!container) return [];
            const imgs = container.querySelectorAll('img');
            return Array.from(imgs).map(img => img.src);
        }

        let currentGallery = [];
        let currentIndex = 0;
        const lightbox = document.getElementById('lightbox');
        const lbImage = document.getElementById('lb-image');

        // Initialize click handlers for room cards
        document.querySelectorAll('.room-card').forEach(card => {
            card.addEventListener('click', (e) => {
                // Prevent lightbox opening if clicking on the book button
                if (e.target.closest('.btn-custom')) return;

                const galleryId = card.getAttribute('data-gallery');
                currentGallery = getGalleryImages(galleryId);
                if (currentGallery.length > 0) {
                    currentIndex = 0;
                    updateImage();
                    lightbox.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        }

        function navigateLightbox(dir) {
            event.stopPropagation();
            currentIndex += dir;
            if (currentIndex >= currentGallery.length) currentIndex = 0;
            if (currentIndex < 0) currentIndex = currentGallery.length - 1;

            lbImage.style.opacity = 0;
            setTimeout(() => {
                updateImage();
                lbImage.style.opacity = 1;
            }, 150);
        }

        function updateImage() {
            lbImage.src = currentGallery[currentIndex];
        }

        document.addEventListener('keydown', (e) => {
            if (!lightbox.classList.contains('active')) return;
            if (e.key === 'ArrowRight') navigateLightbox(1);
            if (e.key === 'ArrowLeft') navigateLightbox(-1);
            if (e.key === 'Escape') closeLightbox();
        });

        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) closeLightbox();
        });

        lbImage.style.transition = 'opacity 0.15s ease';
    </script>
@endpush
