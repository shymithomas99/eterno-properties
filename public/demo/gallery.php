<?php include("includes/header.php"); ?>


<!-- ========== HERO BANNER ========== -->
<section class="hero-banner">
    <div class="hero-inner-content px-2">
        <h1>Every Picture Tells a Story</h1>
        <p>Explore breathtaking moments from our resorts through carefully curated imagery</p>
    </div>
    <div class="breadcrumb">
        <a href="index.php">Home</a><span>&rsaquo;</span>Gallery
    </div>
</section>
<!-- gallery section start here -->
<section class="gallery-section-space">
    <div class="container">
        <!-- Resort Selector -->
        <div class="resort-selector">
            <select id="resortSelect">
                <option value="all">Select your resort</option>
                <option value="resort1">Camellia & Elettaria Resort</option>
                <option value="resort2">Capithans Dale Resort</option>
                <option value="resort3">Amber Paradise</option>
            </select>
        </div>

        <!-- Category Filter -->
        <div class="category-filter">
            <button class="category-btn active" data-category="all">All</button>
            <button class="category-btn" data-category="accommodation">Accommodation</button>
            <button class="category-btn" data-category="dining">Dining</button>
            <button class="category-btn" data-category="experiences">Experiences</button>
            <button class="category-btn" data-category="adventure">Adventure</button>
            <button class="category-btn" data-category="wellness">Wellness &amp; Spa</button>
        </div>

        <!-- Gallery Grid - Images hardcoded in HTML -->
        <div class="gallery-grid" id="galleryGrid">

            <!-- Mountain View Resort Images -->
            <div class="gallery-item" data-resort="resort1" data-category="accommodation">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/1e2f91f7e-57ee-45b1-ad81-55ed66c7198f.png"
                    alt="Mountain View Resort - Balcony with Valley View" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort1" data-category="accommodation">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/197a79f73-3450-412a-92b9-d4079ebf4168.png"
                    alt="Mountain View Resort - Luxury Bedroom" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort1" data-category="dining">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/1a0084922-9dce-4367-ab36-3bc4c41d5618.png"
                    alt="Mountain View Resort - Rooftop Restaurant" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort1" data-category="wellness">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/148c4672e-a683-416c-b311-ec2c6b42258a.png"
                    alt="Mountain View Resort - Spa with Waterfall" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort1" data-category="adventure">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/1a43e94b0-669e-4e1e-bb51-d15f5500292d.png"
                    alt="Mountain View Resort - ATV Adventure" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort1" data-category="adventure">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/104d285e6-daee-4687-a35f-f27212161e42.png"
                    alt="Mountain View Resort - Jeep Safari" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort1" data-category="experiences">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/147a95355-40f6-45ed-a0ba-ea7a521411d2.png"
                    alt="Mountain View Resort - Game Room" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort1" data-category="experiences">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/1a3ac4911-5ecd-4021-9390-bf87b913d864.png"
                    alt="Mountain View Resort - Bonfire Night" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort1" data-category="dining">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/1b3d9368e-577a-4e28-b109-465c0879ee3b.png"
                    alt="Mountain View Resort - Fine Dining Hall" loading="lazy">
            </div>

            <!-- Beach Paradise Resort Images -->
            <div class="gallery-item" data-resort="resort2" data-category="accommodation">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/1a3938184-fa4b-4d6c-b7a6-d30b0706020b.png"
                    alt="Beach Paradise Resort - Infinity Pool" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort2" data-category="dining">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/19a80ed38-34d6-4f73-a731-b37713fa23d4.png"
                    alt="Beach Paradise Resort - Beachside Seafood Dinner" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort2" data-category="accommodation">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/1d6e5db01-4a9f-4014-a719-ea6f7d7f09d1.png"
                    alt="Beach Paradise Resort - Ocean View Bedroom" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort2" data-category="wellness">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/19238cf4e-eb26-44bd-b3c8-9d732f869fa8.png"
                    alt="Beach Paradise Resort - Ocean View Spa" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort2" data-category="adventure">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/16fb5d87d-1e2f-406e-8ec5-a940ff7aa50d.png"
                    alt="Beach Paradise Resort - Snorkeling Adventure" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort2" data-category="experiences">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/1b74d3c57-1c1a-4606-9b5d-499eec0a587f.png"
                    alt="Beach Paradise Resort - Beach Party" loading="lazy">
            </div>

            <!-- Forest Retreat Images -->
            <div class="gallery-item" data-resort="resort3" data-category="accommodation">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/11f43d922-61f8-4f66-88a0-29605d79ee61.png"
                    alt="Forest Retreat - Treehouse Cabin" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort3" data-category="accommodation">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/15fb6da6b-3cc0-4a3a-bb6c-f0f1c5081d32.png"
                    alt="Forest Retreat - Cabin Interior with Fireplace" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort3" data-category="dining">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/118d81a8d-0461-49e9-b541-5f713ee3e039.png"
                    alt="Forest Retreat - Forest Dining" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort3" data-category="wellness">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/167f70a82-941b-4378-955d-7c28570c55e9.png"
                    alt="Forest Retreat - Forest Yoga" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort3" data-category="adventure">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/1237a4482-e508-435a-83fd-8c9dfdafef39.png"
                    alt="Forest Retreat - Zip Line Adventure" loading="lazy">
            </div>

            <div class="gallery-item" data-resort="resort3" data-category="experiences">
                <img src="https://image.qwenlm.ai/public_source/0a0e401c-b892-440b-8dbf-853b6c87b0fe/1872ac107-ff98-4a12-9c34-43a2f23922f8.png"
                    alt="Forest Retreat - Campfire Storytelling" loading="lazy">
            </div>

        </div>

        <div class="no-results" id="noResults">No images found for this selection.</div>
    </div>
</section>
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



<?php include("includes/footer.php"); ?>