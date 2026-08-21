@extends('front.layouts.app')
@section('title', 'Offers | ')

@section('content')
    <!-- ========== HERO BANNER ========== -->
    @if ($offerIntro)
        <section class="hero-banner"
            style="
        background:
            linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
            url('{{ $offerIntro?->banner_image
                ? asset('uploads/offer-intros/' . $offerIntro->banner_image)
                : asset('images/contact-hero-bg.jpg') }}')
            center/cover no-repeat;
    ">

            <div class="hero-inner-content px-2">
                <h1>{{ $offerIntro->banner_title }}</h1>
                <p>{{ $offerIntro->banner_description }}</p>
            </div>
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>&rsaquo;</span>
                Offers
            </div>
        </section>
    @endif

    <!-- ========== offers section ========== -->
    @if ($offers->count())
        <section class="section-space">
            <div class="container">

                <div class="row" id="packageGrid">

                    @foreach ($offers as $offer)
                        <div class="col-md-6 col-lg-4 package-col">
                            <div class="package-card">
                                <div class="package-card-img-wrapper">
                                    <img src="{{ asset('uploads/offers/' . $offer->image) }}" alt="{{ $offer->title }}">
                                </div>
                                <h4 class="package-card-title">
                                    {{ $offer->title }}
                                </h4>
                                <p class="package-card-text">
                                    {{ Str::limit($offer->description, 100) }}
                                </p>
                                {{--  <a href="{{ $offer->button_url }}" class="btn-custom btn-outline-custom" target="_blank">
                                    {{ $offer->button_text }}
                                </a>  --}}

                                {{--  <a href="javascript:void(0);" class="btn-custom btn-outline-custom" data-bs-toggle="modal"
                                    data-bs-target="#offerModal{{ $offer->id }}">
                                    {{ $offer->button_text }}
                                </a>  --}}
                            </div>
                        </div>


                        <!-- ========== OFFER DETAILS MODAL ========== -->
                        <div class="modal fade" id="offerModal{{ $offer->id }}" tabindex="-1"
                            aria-labelledby="offerDetailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal"
                                        aria-label="Close modal">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M18 6L6 18M6 6l12 12" />
                                        </svg>
                                    </button>

                                    <div class="modal-body">
                                        <div class="row g-0">
                                            <div class="col-md-5">
                                                <div class="modal-image-wrapper">
                                                    <img id="modalImage"
                                                        src="{{ asset('uploads/offers/' . $offer->image) }}" alt=""
                                                        class="modal-image">
                                                    {{--  <div class="modal-price-tag" id="modalPrice"></div>  --}}
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="modal-content-wrapper">
                                                    <span class="modal-resort-label" id="modalResort"></span>
                                                    <h3 class="modal-title" id="modalTitle"> {{ $offer->title }}</h3>
                                                    <p class="modal-description" id="modalFullDesc">
                                                        {{ $offer->description }}</p>

                                                    <div class="modal-info-section">
                                                        <h5 class="modal-info-title">
                                                            <svg width="20" height="20" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2">
                                                                <path
                                                                    d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                                <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" />
                                                            </svg>
                                                            Offer Includes
                                                        </h5>
                                                        <p class="modal-info-text" id="modalTerms">
                                                            {!! $offer->content !!}

                                                    </div>

                                                    <div class="modal-actions">
                                                        {{--  <a href="booking-enquiry.php"
                                                            class="btn-custom btn-primary-custom">Book Now</a>  --}}
                                                        <button type="button" class="btn-custom btn-outline-custom"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </section>
    @else
        <section class="section-space">
            <div class="container">
                <div class="col-12 text-center">
                    No offers available.
                </div>
            </div>
        </section>
    @endif
@endsection



@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal elements
            const modal = new bootstrap.Modal(document.getElementById('offerDetailsModal'));
            const viewDetailsBtns = document.querySelectorAll('.view-details-btn');

            // Modal content elements
            const modalImage = document.getElementById('modalImage');
            const modalPrice = document.getElementById('modalPrice');
            const modalResort = document.getElementById('modalResort');
            const modalTitle = document.getElementById('modalTitle');
            const modalFullDesc = document.getElementById('modalFullDesc');
            const modalValidity = document.getElementById('modalValidity');
            const modalTerms = document.getElementById('modalTerms');

            // Add click event to all View Details buttons
            viewDetailsBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const card = this.closest('.package-card');

                    // Populate modal with card data
                    modalImage.src = card.dataset.image;
                    modalImage.alt = card.dataset.title;
                    modalPrice.textContent = card.dataset.price;
                    modalResort.textContent = card.dataset.resort;
                    modalTitle.textContent = card.dataset.title;
                    modalFullDesc.textContent = card.dataset.fullDesc;
                    modalValidity.textContent = card.dataset.validity;
                    modalTerms.textContent = card.dataset.terms;

                    // Show modal
                    modal.show();
                });
            });

            // Resort filter functionality (existing)
            const resortFilter = document.getElementById('resortFilter');
            const packageCols = document.querySelectorAll('.package-col');
            const filterInfo = document.getElementById('filterInfo');
            const selectedResortName = document.getElementById('selectedResortName');
            const noResults = document.getElementById('noResults');
            const packageGrid = document.getElementById('packageGrid');

            resortFilter.addEventListener('change', function() {
                const selectedValue = this.value;
                let visibleCount = 0;

                // Update filter info text
                if (selectedValue === 'all') {
                    selectedResortName.textContent = 'All Resorts';
                } else {
                    const selectedOption = this.options[this.selectedIndex].text;
                    selectedResortName.textContent = selectedOption;
                }

                // Filter packages
                packageCols.forEach(col => {
                    const resorts = col.dataset.resorts.split(',');

                    if (selectedValue === 'all' || resorts.includes(selectedValue)) {
                        col.style.display = 'block';
                        visibleCount++;
                    } else {
                        col.style.display = 'none';
                    }
                });

                // Show/hide no results message
                if (visibleCount === 0) {
                    noResults.style.display = 'block';
                    packageGrid.style.display = 'none';
                } else {
                    noResults.style.display = 'none';
                    packageGrid.style.display = 'flex';
                }
            });
        });
    </script>
@endpush
