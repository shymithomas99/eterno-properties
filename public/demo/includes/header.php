<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eterno Hotels & Resorts</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="48x48" href="images/favicon-48x48.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=16">

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/demo">
                <img src="images/logo.png" alt="eterno-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto my-3 my-lg-0">
                    <?php
                    // Get the current page filename
                    $currentPage = basename($_SERVER['PHP_SELF']);
                    ?>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>"
                            href="/demo">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'about-us.php') ? 'active' : ''; ?>"
                            href="about-us.php">About Us</a>
                    </li>

                 <li class="nav-item mega-dropdown">

                        <a class="nav-link <?php echo (in_array($currentPage, ['camellia-resort.php', 'capithans-dale.php', 'amber-paradise.php'])) ? 'active' : ''; ?>"
                            href="#" id="megaTrigger">
                            Our Resorts
                            <i class="bi bi-chevron-down" style="font-size:0.7rem; margin-left:3px;"></i>
                        </a>

                        <div class="mega-menu">

                            <div class="container">

                                <div class="row">

                                    <div class="col-lg-4 col-xxl-3">

                                        <ul class="mega-resort-list">

                                            <li>

                                                <a href="#" class="active"
                                                    data-image="images/megamenu-r1.jpg"
                                                    data-title="A Luxury Plantation Resort in Munnar"
                                                    data-subtitle="Luxury Plantation Resort"
                                                    data-description="Nestled within 22 acres of lush tea and cardamom plantations, Camellia & Elettaria offers elegant valley-view suites, wooden cottages, and luxury tree houses, blending breathtaking landscapes, comfort, and peaceful mountain serenity.">

                                                    Camellia & Elettaria

                                                </a>

                                            </li>

                                            <li>

                                                <a href="#"
                                                    data-image="images/megamenu-r2.jpg"
                                                    data-title="A Boutique Mountain Retreat in Munnar" data-subtitle="Hill Resort"
                                                    data-description="Nestled amidst Munnar's lush tea plantations and misty hills, Capithans Dale offers elegant accommodations, panoramic mountain views, and immersive nature experiences, creating a peaceful retreat for relaxation and exploration.">

                                                    Capithans Dale

                                                </a>

                                            </li>

                                            <li>

                                                <a href="#"
                                                    data-image="images/megamenu-r3.jpg"
                                                    data-title="A Boutique Mountain Retreat in Vagamon" data-subtitle="Nature Resort"
                                                    data-description="Perched amidst Vagamon's rolling hills, Capithans Dale offers private cottages, panoramic Western Ghats views, an infinity pool, and curated nature experiences, creating a refined mountain retreat for unforgettable escapes.">

                                                    Amber Paradise

                                                </a>

                                            </li>

                                        </ul>

                                    </div>

                                    <div class="col-lg-4">

                                        <div class="mega-image">

                                            <img id="megaImage"
                                                src="images/megamenu-r1.jpg">

                                        </div>

                                    </div>

                                    <div class="col-lg-4 col-xxl-5">

                                        <div class="mega-content">

                                            <h3 id="megaTitle">

                                                A Luxury Plantation Resort in Munnar

                                            </h3>

                                            <h5 id="megaSubtitle">

                                                Luxury Plantation Resort

                                            </h5>

                                            <p id="megaDescription">

                                                Nestled within 22 acres of lush tea and cardamom plantations, Camellia & Elettaria offers elegant valley-view suites, wooden cottages, and luxury tree houses, blending breathtaking landscapes, comfort, and peaceful mountain serenity.

                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'offers.php') ? 'active' : ''; ?>"
                            href="offers.php">Offers</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'experience.php') ? 'active' : ''; ?>"
                            href="experience.php">Experiences</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'gallery.php') ? 'active' : ''; ?>"
                            href="gallery.php">Gallery</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage == 'contact.php') ? 'active' : ''; ?>"
                            href="contact.php">Contact</a>
                    </li>
                </ul>
                <a href="#" class="btn-custom  btn-primary-custom" id="bookNowBtn">Book Now</a>
            </div>
        </div>
    </nav>

    <!-- Book Now Modal -->
    <div class="book-modal-overlay" id="bookModal">
        <div class="book-modal">
            <button class="book-modal-close" id="bookModalClose"><i class="bi bi-x-lg"></i></button>
            <h3>Select Your Resort</h3>
            <p>Choose a resort to continue with your booking</p>
            <div class="book-modal-grid">
                <a href="#" class="book-modal-item">
                    <img src="images/camellia-cta-btn.jpg" alt="Camellia & Elettaria">
                    <span>Camellia & Elettaria</span>
                </a>
                <a href="#" class="book-modal-item">
                    <img src="images/capithans-cta-btn.jpg" alt="Capithans Dale">
                    <span>Capithans Dale</span>
                </a>
                <a href="#" class="book-modal-item">
                    <img src="images/megamenu-r3.jpg" alt="Amber Paradise">
                    <span>Amber Paradise</span>
                </a>
            </div>
        </div>
    </div>