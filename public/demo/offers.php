<?php include("includes/header.php"); ?>


<!-- ========== HERO BANNER ========== -->
<section class="hero-banner offers-banner">
    <div class="hero-inner-content px-2">
        <h1>Exclusive Offers Await</h1>
        <p>Discover limited-time offers designed to make your getaway even more memorable</p>
    </div>
    <div class="breadcrumb">
        <a href="index.php">Home</a><span>&rsaquo;</span>Offers
    </div>
</section>

<!-- ========== offers section ========== -->
<section class="section-space">
    <div class="container">

        <!-- Resort Select Dropdown -->
        <div class="offer-resort-select-wrapper">
            <select class="offer-resort-select" id="resortFilter" aria-label="Select your resort">
                <option value="all">All Resorts</option>
                <option value="camellia-elettaria">Camellia & Elettaria</option>
                <option value="capithans-dale">Capithans Dale</option>
                <option value="amber-paradise">Amber Paradise</option>
            </select>
        </div>

        <!-- Filter Info -->
        <div class="filter-info" id="filterInfo">
            Showing packages for <strong id="selectedResortName">All Resorts</strong>
        </div>

        <!-- Package Cards Grid -->
        <div class="row" id="packageGrid">

            <!-- Card 1: Early Bird Escape -->
            <div class="col-md-6 col-lg-4 package-col" data-resorts="camellia-elettaria,capithans-dale">
                <div class="package-card">
                    <div class="package-card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80"
                            alt="Early Bird Escape">
                    </div>
                    <h4 class="package-card-title">Early Bird Escape</h4>
                    <p class="package-card-text">Save 10% when you book at least 7 days in advance</p>
                    <a href="#" class="btn-custom btn-outline-custom">View Details</a>
                </div>
            </div>

            <!-- Card 2: Romantic Getaway -->
            <div class="col-md-6 col-lg-4 package-col" data-resorts="amber-paradise,capithans-dale">
                <div class="package-card">
                    <div class="package-card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=800&q=80"
                            alt="Romantic Getaway">
                    </div>
                    <h4 class="package-card-title">Romantic Getaway</h4>
                    <p class="package-card-text">Celebrate love amidst nature</p>
                    <a href="#" class="btn-custom btn-outline-custom">View Details</a>
                </div>
            </div>

            <!-- Card 3: Stay Longer, Experience More -->
            <div class="col-md-6 col-lg-4 package-col" data-resorts="camellia-elettaria,amber-paradise">
                <div class="package-card">
                    <div class="package-card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80"
                            alt="Stay Longer">
                    </div>
                    <h4 class="package-card-title">Stay Longer, Experience More</h4>
                    <p class="package-card-text">Make your escape last a little longer. Enjoy an extended stay
                        surrounded by nature.</p>
                    <a href="#" class="btn-custom btn-outline-custom">View Details</a>
                </div>
            </div>

            <!-- Card 4: Monsoon Retreat -->
            <div class="col-md-6 col-lg-4 package-col" data-resorts="capithans-dale,camellia-elettaria">
                <div class="package-card">
                    <div class="package-card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=800&q=80"
                            alt="Monsoon Retreat">
                    </div>
                    <h4 class="package-card-title">Monsoon Retreat</h4>
                    <p class="package-card-text">Experience the magic of monsoon with misty landscapes, refreshing
                        rain, cozy stays.</p>
                    <a href="#" class="btn-custom btn-outline-custom">View Details</a>
                </div>
            </div>

            <!-- Card 5: Adventure Seeker -->
            <div class="col-md-6 col-lg-4 package-col" data-resorts="amber-paradise,capithans-dale">
                <div class="package-card">
                    <div class="package-card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800&q=80"
                            alt="Adventure Seeker">
                    </div>
                    <h4 class="package-card-title">Adventure Seeker</h4>
                    <p class="package-card-text">Thrilling activities and outdoor adventures for the brave explorer
                    </p>
                    <a href="#" class="btn-custom btn-outline-custom">View Details</a>
                </div>
            </div>

            <!-- Card 6: Wellness Retreat -->
            <div class="col-md-6 col-lg-4 package-col" data-resorts="camellia-elettaria,amber-paradise">
                <div class="package-card">
                    <div class="package-card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800&q=80"
                            alt="Wellness Retreat">
                    </div>
                    <h4 class="package-card-title">Wellness Retreat</h4>
                    <p class="package-card-text">Rejuvenate your mind and body with our spa and wellness programs
                    </p>
                    <a href="#" class="btn-custom btn-outline-custom">View Details</a>
                </div>
            </div>

            <!-- Card 7: Family Fun Package -->
            <div class="col-md-6 col-lg-4 package-col" data-resorts="capithans-dale,amber-paradise">
                <div class="package-card">
                    <div class="package-card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80"
                            alt="Family Fun Package">
                    </div>
                    <h4 class="package-card-title">Family Fun Package</h4>
                    <p class="package-card-text">Create unforgettable memories with activities for the whole family
                    </p>
                    <a href="#" class="btn-custom btn-outline-custom">View Details</a>
                </div>
            </div>

            <!-- Card 8: Culinary Experience -->
            <div class="col-md-6 col-lg-4 package-col" data-resorts="camellia-elettaria,capithans-dale">
                <div class="package-card">
                    <div class="package-card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800&q=80"
                            alt="Culinary Experience">
                    </div>
                    <h4 class="package-card-title">Culinary Experience</h4>
                    <p class="package-card-text">Savor exquisite local cuisine and cooking classes with expert chefs
                    </p>
                    <a href="#" class="btn-custom btn-outline-custom">View Details</a>
                </div>
            </div>

            <!-- Card 9: Photography Tour -->
            <div class="col-md-6 col-lg-4 package-col" data-resorts="amber-paradise,camellia-elettaria">
                <div class="package-card">
                    <div class="package-card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1452587925148-ce544e77e70d?w=800&q=80"
                            alt="Photography Tour">
                    </div>
                    <h4 class="package-card-title">Photography Tour</h4>
                    <p class="package-card-text">Capture stunning landscapes with our guided photography experiences
                    </p>
                    <a href="#" class="btn-custom btn-outline-custom">View Details</a>
                </div>
            </div>

            <!-- Card 10: Sunset Cruise -->
            <div class="col-md-6 col-lg-4 package-col" data-resorts="capithans-dale,amber-paradise">
                <div class="package-card">
                    <div class="package-card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80"
                            alt="Sunset Cruise">
                    </div>
                    <h4 class="package-card-title">Sunset Cruise</h4>
                    <p class="package-card-text">Enjoy breathtaking sunsets on a private cruise with dinner</p>
                    <a href="#" class="btn-custom btn-outline-custom">View Details</a>
                </div>
            </div>

        </div>

        <!-- No Results Message -->
        <div class="no-results" id="noResults">
            <h3>No packages available</h3>
            <p>Please select a different resort to view available packages.</p>
        </div>

    </div>
</section>


<?php include("includes/footer.php"); ?>