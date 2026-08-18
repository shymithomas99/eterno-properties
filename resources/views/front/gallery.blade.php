@extends('front.layouts.app')
@section('title', 'Gallery | ')

@section('content')
<!-- ========== HERO BANNER ========== -->
@if($galleryIntro)
<section class="hero-banner"
    style="background-image:url('{{ asset('uploads/gallery-intros/'.$galleryIntro->banner_image) }}')">

    <div class="hero-inner-content px-2">
        <h1>{{ $galleryIntro->banner_title }}</h1>
        <p>{{ $galleryIntro->banner_description }}</p>
    </div>

    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span>&rsaquo;</span>
        Gallery
    </div>
</section>
@endif

<!-- gallery section start here -->
@if($categories->count())
<section class="gallery-section-space">
    <div class="container">
        <!-- Resort Selector -->
        <div class="resort-selector">
            <select id="resortSelect">
                <option value="all">Select your resort</option>
                @foreach($resorts as $resort)
                    <option value="{{ $resort->id }}">
                        {{ $resort->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Category Filter -->
        <div class="category-filter">
            <button class="category-btn active"
                data-category="all">
                All
            </button>
            @foreach($categories as $category)
                <button
                    class="category-btn"
                    data-category="{{ $category->id }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>

        <!-- Gallery Grid - Images hardcoded in HTML -->
        <div class="gallery-grid" id="galleryGrid">
            @foreach($galleries as $gallery)
            <div class="gallery-item"
                data-resort="{{ $gallery->resort_id }}"
                data-category="{{ $gallery->gallery_category_id }}">
                <img
                    src="{{ asset('uploads/galleries/'.$gallery->image) }}"
                    alt="{{ $gallery->galleryCategory?->title }}"
                    loading="lazy">
            </div>
            @endforeach
        </div>

        <div class="no-results" id="noResults">No images found for this selection.</div>
    </div>
</section>
@else
<section class="gallery-section-space">
<div class="container">
    <div class="col-12 text-center">
        No images available.
    </div>
</div>
</section>
@endif

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
    <span class="lightbox-close">&times;</span>
    <span class="lightbox-nav lightbox-prev">&#10094;</span>
    <span class="lightbox-nav lightbox-next">&#10095;</span>
    <div class="lightbox-content">
        <img src="" alt="Gallery Image" id="lightboxImage">
    </div>
    <div class="lightbox-counter" id="lightboxCounter"></div>
</div>
@endsection

@push('scripts')
<script>
    // ==========================
    // Gallery Lightbox
    // ==========================
    const galleryItems = document.querySelectorAll('.gallery-item');
    if (galleryItems.length > 0) {
        let currentCategory = 'all';
        let currentResort = 'all';
        let currentImageIndex = 0;
        let visibleItems = [];

        function applyFilters() {
            const galleryNoResults = document.getElementById('galleryNoResults') || document.getElementById('noResults');
            visibleItems = [];
            let visibleCount = 0;

            galleryItems.forEach((item) => {
                const resortMatch = currentResort === 'all' || item.dataset.resort === currentResort;
                const categoryMatch = currentCategory === 'all' || item.dataset.category === currentCategory;

                if (resortMatch && categoryMatch) {
                    item.classList.remove('hidden');
                    visibleItems.push(item);
                    visibleCount++;
                } else {
                    item.classList.add('hidden');
                }
            });

            if (galleryNoResults) {
                galleryNoResults.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        }

        function setActiveCategory(category) {
            currentCategory = category;
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.category === category);
            });
        }

        function openLightbox(item) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightboxImage');
            const lightboxCounter = document.getElementById('lightboxCounter');

            currentImageIndex = visibleItems.indexOf(item);
            if (currentImageIndex === -1) currentImageIndex = 0;

            const img = visibleItems[currentImageIndex].querySelector('img');
            if (img) {
                lightboxImage.src = img.src;
                lightboxImage.alt = img.alt;
            }
            lightboxCounter.textContent = `${currentImageIndex + 1} / ${visibleItems.length}`;

            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function updateLightboxImage() {
            const lightboxImage = document.getElementById('lightboxImage');
            const lightboxCounter = document.getElementById('lightboxCounter');

            if (visibleItems.length > 0) {
                const img = visibleItems[currentImageIndex].querySelector('img');
                if (img) {
                    lightboxImage.src = img.src;
                    lightboxImage.alt = img.alt;
                }
                lightboxCounter.textContent = `${currentImageIndex + 1} / ${visibleItems.length}`;
            }
        }

        function nextImage() {
            if (visibleItems.length > 0) {
                currentImageIndex = (currentImageIndex + 1) % visibleItems.length;
                updateLightboxImage();
            }
        }

        function prevImage() {
            if (visibleItems.length > 0) {
                currentImageIndex = (currentImageIndex - 1 + visibleItems.length) % visibleItems.length;
                updateLightboxImage();
            }
        }

        applyFilters();

        const resortSelect = document.getElementById('resortSelect');
        if (resortSelect) {
            resortSelect.addEventListener('change', function () {
                currentResort = this.value;
                setActiveCategory('all');
                applyFilters();
            });
        }

        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                setActiveCategory(this.dataset.category);
                applyFilters();
            });
        });

        galleryItems.forEach(item => {
            item.addEventListener('click', function () {
                if (!this.classList.contains('hidden')) {
                    openLightbox(this);
                }
            });
        });

        const lightboxClose = document.querySelector('.lightbox-close');
        const lightboxNext = document.querySelector('.lightbox-next');
        const lightboxPrev = document.querySelector('.lightbox-prev');
        const lightboxEl = document.getElementById('lightbox');

        if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
        if (lightboxNext) lightboxNext.addEventListener('click', (e) => { e.stopPropagation(); nextImage(); });
        if (lightboxPrev) lightboxPrev.addEventListener('click', (e) => { e.stopPropagation(); prevImage(); });

        if (lightboxEl) {
            lightboxEl.addEventListener('click', function (e) {
                if (e.target === this) closeLightbox();
            });
        }

        document.addEventListener('keydown', function (e) {
            if (lightboxEl && lightboxEl.classList.contains('active')) {
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowRight') nextImage();
                if (e.key === 'ArrowLeft') prevImage();
            }
        });
    }
</script>
@endpush