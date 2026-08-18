<div class="element-main position-relative">
    <div class="element-bg">
        <img src="images/bg-element.png" alt="" class="img-fluid">
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <!-- Newsletter Section -->
    <div class="newsletter-section">
        <div class="container">
            <h2 class="reveal-left">Stay connected with what actually matters</h2>
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal-left">
                    <p class="subhead mb-0 color-primary">To receive updates about exclusive experiences, events,
                        new
                        destinations and
                        more, please
                        register your interest.</p>
                </div>
                <div class="col-lg-6 reveal-right">
                    <form class="newsletter-form">
                        <input type="email" placeholder="Email Address">
                        <a href="#" class="btn-custom btn-primary-custom">Subscribe</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row footer-main-row reveal">
            <!-- Logo & Address -->
            <div class="col-xl-3 col-lg-4 col-md-6 footer-col">
                <div class="footer-logo-area">
                    <div class="footer-logo-img">
                        <img src="images/footer-logo.png" alt="">
                    </div>
                    <div class="footer-address">
                        <strong>Conglomerate of</strong>
                        Kavumkal Dream Destination Pvt. Ltd.<br>
                        Ltd. 2/288, Kavumkal Building,<br>
                        Ranni P.O., Pathanamthitta,<br>
                        Kerala, India - 689 672
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-xl-3 col-lg-4 col-md-6 footer-col">
                <div class="footer-links-area d-flex justify-content-start justify-content-lg-center">
                    <div>
                        <h5 class="footer-heading">Quick Links</h5>
                        <ul class="footer-links">
                            <li><a href="about-us.php">About Us</a></li>
                            <li><a href="offers.php">Offers</a></li>
                            <li><a href="experience.php">Experiences</a></li>
                            <li><a href="gallery.php">Gallery</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Our Resorts -->
            <div class="col-xl-2 col-lg-4 col-md-6 footer-col">
                <div
                    class="footer-links-area d-flex justify-content-start justify-content-md-start justify-content-lg-center">
                    <div>
                        <h5 class="footer-heading">Our Resorts</h5>
                        <ul class="footer-links">
                            <li><a href="#">Camellia & Elettaria</a></li>
                            <li><a href="#">Capithans Dale</a></li>
                            <li><a href="#">Amber Paradise</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Contact Us -->
            <div class="col-xl-4  col-md-6 footer-col">
                <div class="footer-contact-area d-flex justify-content-start justify-content-xl-end">

                    <div>
                        <h5 class="footer-heading">Contact Us</h5>

                        <ul class="footer-contact-list">
                            <li>
                                <i class="bi bi-phone"></i>
                                <a href="tel:+919744227000">+91 97 442 27 000</a>
                            </li>

                            <li>
                                <i class="bi bi-phone"></i>
                                <a href="tel:+919656362644">+91 96 563 62 644</a>
                            </li>

                            <li>
                                <i class="bi bi-telephone"></i>
                                <a href="tel:+914865285101">+91 48 65 285 101</a>
                            </li>

                            <li>
                                <i class="bi bi-envelope"></i>
                                <a href="mailto:sales@eternohotelsresorts.com">
                                    sales@eternohotelsresorts.com
                                </a>
                            </li>

                            <li>
                                <i class="bi bi-envelope"></i>
                                <a href="mailto:reservation@eternohotelsresorts.com">
                                    reservation@eternohotelsresorts.com
                                </a>
                            </li>
                        </ul>

                        <div class="footer-follow">
                            <span>Follow Us</span>

                            <div class="footer-social">
                                <a href="#" target="_blank" rel="noopener" aria-label="X">
                                    <i class="bi bi-twitter-x"></i>
                                </a>

                                <a href="#" target="_blank" rel="noopener" aria-label="YouTube">
                                    <i class="bi bi-youtube"></i>
                                </a>

                                <a href="#" target="_blank" rel="noopener" aria-label="Instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>

                                <a href="#" target="_blank" rel="noopener" aria-label="Facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>©2026. All rights reserved. Kavumkal Dream Destination Pvt. Ltd. <span class="footer-divider">|</span>
                Designed By <a href="https://camstech.com/" class="color-primary text-decoration-none" target="_blank">
                    CAMS</a>
            </p>
            <div class="footer-legal">
                <a href="#">Terms & Conditions</a>
                <span class="footer-divider">|</span>
                <a href="#">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js?v=17"></script>
<script src="https://unpkg.com/lenis@1.3.11/dist/lenis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>

<!-- <script>
    gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

    document.addEventListener("DOMContentLoaded", () => {
        const section = document.getElementById("pinnedSection");
        const navButtons = document.querySelectorAll(".tab-nav-btn");
        const items = document.querySelectorAll(".resort-item");
        const track = document.getElementById("resortTrack");
        const windowEl = document.getElementById("resortWindow");
        const totalItems = items.length;

        let currentIndex = -1;

        // Update Active Tab & Card State
        function updateActiveState(index) {
            if (index === currentIndex) return;

            navButtons.forEach((btn, idx) => {
                btn.classList.toggle("active", idx === index);

                if (idx === index && window.innerWidth < 992) {
                    const navContainer = document.getElementById("tabNav");


                    const btnOffsetLeft = btn.offsetLeft;
                    const containerPadding = parseFloat(getComputedStyle(navContainer).paddingLeft) || 0;


                    navContainer.scrollTo({
                        left: btnOffsetLeft - containerPadding,
                        behavior: 'smooth'
                    });
                }
            });

            items.forEach((item, idx) => {
                item.classList.toggle("active", idx === index);
            });

            currentIndex = index;
        }

        // ==========================================================================
        // DESKTOP: GSAP Pinned Vertical Scroll Logic (>= 992px)
        // ==========================================================================
        let st;

        function getItemCenterOffsetY(index) {
            const targetItem = items[index];
            const itemTop = targetItem.offsetTop;
            const itemHeight = targetItem.offsetHeight;
            return -(itemTop + (itemHeight / 2));
        }

        function initDesktopGSAP() {
            gsap.set(track, { y: getItemCenterOffsetY(0) });

            st = ScrollTrigger.create({
                trigger: section,
                start: "top top",
                end: () => `+=${window.innerHeight * (totalItems - 0.5)}`,
                pin: true,
                scrub: 0.6,
                snap: {
                    snapTo: 1 / (totalItems - 1),
                    duration: { min: 0.25, max: 0.5 },
                    delay: 0.05,
                    ease: "power2.inOut"
                },
                onUpdate: (self) => {
                    const progress = self.progress;
                    const rawIndex = progress * (totalItems - 1);
                    const activeIndex = Math.min(Math.round(rawIndex), totalItems - 1);

                    updateActiveState(activeIndex);

                    const firstOffset = getItemCenterOffsetY(0);
                    const lastOffset = getItemCenterOffsetY(totalItems - 1);
                    const currentOffset = gsap.utils.interpolate(firstOffset, lastOffset, progress);

                    gsap.to(track, {
                        y: currentOffset,
                        duration: 0.1,
                        overwrite: "auto",
                        ease: "none"
                    });
                }
            });
        }

        // ==========================================================================
        // MOBILE / TABLET: Native Swipe + IntersectionObserver (< 992px)
        // ==========================================================================
        let observer;

        function initMobileObserver() {
            const options = {
                root: windowEl,
                threshold: 0.6
            };

            observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const activeIndex = parseInt(entry.target.getAttribute("data-index"));
                        updateActiveState(activeIndex);
                    }
                });
            }, options);

            items.forEach((item) => observer.observe(item));
        }

        // ==========================================================================
        // TAB CLICK HANDLERS
        // ==========================================================================
        navButtons.forEach((btn) => {
            btn.addEventListener("click", (e) => {
                const targetIndex = parseInt(e.currentTarget.getAttribute("data-index"));

                if (window.innerWidth >= 992 && st) {
                    const totalScrollDistance = st.end - st.start;
                    const targetScrollPos = st.start + (totalScrollDistance * (targetIndex / (totalItems - 1)));

                    gsap.to(window, {
                        scrollTo: targetScrollPos,
                        duration: 0.7,
                        ease: "power2.out"
                    });
                } else {
                    const targetSlide = items[targetIndex];
                    windowEl.scrollTo({
                        left: targetSlide.offsetLeft,
                        behavior: "smooth"
                    });
                }
            });
        });

        // ==========================================================================
        // BREAKPOINT CHECK & RESIZE
        // ==========================================================================
        function checkBreakpoint() {
            if (window.innerWidth >= 992) {
                if (observer) observer.disconnect();
                if (!st) initDesktopGSAP();
            } else {
                if (st) {
                    st.kill();
                    st = null;
                    gsap.set(track, { clearProps: "all" });
                }
                initMobileObserver();
            }
        }

        checkBreakpoint();

        window.addEventListener("resize", () => {
            checkBreakpoint();
            if (window.innerWidth >= 992) {
                gsap.set(track, { y: getItemCenterOffsetY(currentIndex < 0 ? 0 : currentIndex) });
            }
        });
    });
</script> -->
</body>

</html>