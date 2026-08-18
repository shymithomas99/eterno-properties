@extends('front.layouts.app')
@section('title', 'Offers | ')

@section('content')
    <!-- ========== HERO BANNER ========== -->
    @if ($offerIntro)
        <section class="hero-banner"
            style="background-image:url('{{ asset('uploads/offer-intros/' . $offerIntro->banner_image) }}')">
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

                <!-- Resort Select Dropdown -->
                <div class="offer-resort-select-wrapper">
                    <select class="offer-resort-select" id="resortFilter" aria-label="Select your resort">
                        <option value="all">
                            All Resorts
                        </option>
                        @foreach ($resorts as $resort)
                            <option value="{{ $resort->id }}">
                                {{ $resort->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Info -->
                <div class="filter-info" id="filterInfo">
                    Showing packages for <strong id="selectedResortName">All Resorts</strong>
                </div>

                <div class="row" id="packageGrid">

                    @foreach ($offers as $offer)
                        <div class="col-md-6 col-lg-4 package-col" data-resort="{{ $offer->resort_id }}">
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

                                <a href="javascript:void(0);" class="btn-custom btn-outline-custom" data-bs-toggle="modal"
                                    data-bs-target="#offerModal{{ $offer->id }}">
                                    {{ $offer->button_text }}
                                </a>
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

                <!-- No Results Message -->
                <div class="no-results" id="noResults">
                    <h3>No packages available</h3>
                    <p>Please select a different resort to view available packages.</p>
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
        // ==========================
        // Offers Filter
        // ==========================
        const resortFilter = document.getElementById('resortFilter');
        const packageCols = document.querySelectorAll('.package-col');

        if (resortFilter && packageCols.length > 0) {

            const noResults = document.getElementById('noResults');
            const filterInfo = document.getElementById('filterInfo');
            const selectedResortName = document.getElementById('selectedResortName');

            function filterPackages() {

                const selectedResort = resortFilter.value;
                let visibleCount = 0;

                // Show/Hide "Showing packages for..."
                if (selectedResort === 'all') {
                    filterInfo.classList.remove('show');
                } else {
                    selectedResortName.textContent =
                        resortFilter.options[resortFilter.selectedIndex].text;

                    filterInfo.classList.add('show');
                }

                // Filter cards
                packageCols.forEach(function(col) {

                    if (
                        selectedResort === 'all' ||
                        col.dataset.resort === selectedResort
                    ) {
                        col.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        col.classList.add('hidden');
                    }

                });

                // Show "No packages available" only for a selected resort
                if (selectedResort === 'all') {
                    noResults.classList.remove('show');
                } else {
                    noResults.classList.toggle('show', visibleCount === 0);
                }
            }

            resortFilter.addEventListener('change', filterPackages);

            filterPackages();
        }
    </script>
@endpush

@push('styles')
    <style>
        /* ======================offer Modal Styles=========================== */
        .modal-content {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .modal-close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.95);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
            color: var(--color-text);
        }

        .modal-close-btn:hover {
            background-color: var(--color-white);
            color: var(--color-primary);
            transform: rotate(90deg);
        }

        .modal-image-wrapper {
            position: relative;
            height: 100%;
            min-height: 400px;
        }

        .modal-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .modal-price-tag {
            position: absolute;
            bottom: 30px;
            left: 30px;
            background-color: var(--color-primary);
            color: var(--color-white);
            padding: 12px 24px;
            border-radius: 30px;
            font-family: var(--font-heading);
            font-size: 1.25rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(142, 115, 75, 0.4);
        }

        .modal-content-wrapper {
            padding: 40px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .modal-resort-label {
            font-size: 13px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-primary);
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
        }

        .modal-title {
            font-family: var(--font-heading);
            font-size: 2rem;
            color: var(--color-text);
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .modal-description {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--text-grey);
            margin-bottom: 30px;
        }

        .modal-info-section {
            margin-bottom: 25px;
            padding: 20px;
            background-color: var(--bg-soft);
            border-radius: 12px;
            border-left: 4px solid var(--color-primary);
        }

        .modal-info-title {
            font-family: var(--font-heading);
            font-size: 1.1rem;
            color: var(--color-text);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-info-title svg {
            color: var(--color-primary);
        }

        .modal-info-text {
            font-size: 0.95rem;
            line-height: 1.6;
            color: var(--text-grey);
            margin: 0;
        }

        .modal-actions {
            margin-top: auto;
            display: flex;
            gap: 15px;
            padding-top: 20px;
        }

        .modal-actions .btn-custom {
            flex: 1;
            text-align: center;
        }

        /* Responsive Modal */
        @media (max-width: 768px) {
            .modal-image-wrapper {
                min-height: 250px;
            }

            .modal-content-wrapper {
                padding: 30px 20px;
            }

            .modal-title {
                font-size: 1.5rem;
            }

            .modal-price-tag {
                bottom: 15px;
                left: 15px;
                padding: 10px 18px;
                font-size: 1rem;
            }

            .modal-actions {
                flex-direction: column;
            }

            .modal-close-btn {
                top: 10px;
                right: 10px;
                width: 35px;
                height: 35px;
            }
        }

        /* Package Card Hover Effect */
        .package-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            background: var(--color-white);
            border-radius: 12px;
            overflow: hidden;
            /* box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); */
        }

        .package-card:hover {
            transform: translateY(-8px);
            /* box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15); */
        }

        .package-card-img-wrapper {
            overflow: hidden;
            height: 220px;
        }

        .package-card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .package-card:hover .package-card-img-wrapper img {
            transform: scale(1.1);
        }

        .package-card-title {
            font-family: var(--font-heading);
            font-size: 1.4rem;
            color: var(--color-text);
            margin: 20px 20px 10px;
        }

        .package-card-text {
            padding: 0 20px 20px;
            flex-grow: 1;
            color: var(--text-grey);
            line-height: 1.6;
        }

        .package-card .btn-custom {
            margin: 0 20px 25px;
        }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 80px 20px;
            display: none;
        }

        .no-results h3 {
            font-family: var(--font-heading);
            font-size: 1.8rem;
            color: var(--color-text);
            margin-bottom: 10px;
        }

        .no-results p {
            color: var(--text-grey);
        }

        /* Filter Info */
        .filter-info {
            margin-bottom: 30px;
            padding: 15px 20px;
            background-color: var(--bg-soft);
            border-radius: 8px;
            font-size: 0.95rem;
        }

        .filter-info strong {
            color: var(--color-primary);
        }

        /* Resort Select */
        .offer-resort-select-wrapper {
            max-width: 400px;
            margin: 0 auto 40px;
        }

        .offer-resort-select {
            width: 100%;
            padding: 14px 45px 14px 20px;
            border: 1.5px solid var(--color-primary);
            border-radius: 30px;
            font-size: 15px;
            color: var(--color-text);
            background-color: var(--color-white);
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%238e734b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 20px center;
            transition: all 0.3s ease;
        }

        .offer-resort-select:focus {
            outline: none;
            border-color: var(--color-primary-dark);
            box-shadow: 0 0 0 3px rgba(142, 115, 75, 0.15);
        }

        /* ======================offer Modal Styles end=========================== */
    </style>
@endpush

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
