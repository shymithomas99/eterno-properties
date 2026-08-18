<div class="element-main position-relative">
    <div class="element-bg">
        <img src="{{ asset('images/bg-element.png') }}" alt="" class="img-fluid">
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
                {{--  <div class="col-lg-6 reveal-right">
                    <form class="newsletter-form">
                        <input type="email" placeholder="Email Address">
                        <a href="#" class="btn-custom btn-primary-custom">Subscribe</a>
                    </form>
                </div>  --}}
                <div class="col-lg-6 reveal-right">
                    <form id="newsletterForm" class="newsletter-form" action="{{ route('newsletter.subscribe') }}"
                        method="POST">

                        @csrf

                        {{-- Email --}}
                        <input type="email" name="email" id="newsletterEmail" placeholder="Email Address"
                            autocomplete="email">

                        <input id="username" type="text" class="hidden-input-field" name="username" value=""
                            autocomplete="off" tabindex="-1" aria-hidden="true">

                        {{-- Subscribe Button --}}
                        <button type="submit" id="newsletterSubmit" class="btn-custom btn-primary-custom">
                            Subscribe
                        </button>
                    </form>
                    {{-- Email Validation Error --}}
                    <div id="newsletterEmailError" class="newsletterEmailError mx-3" style="display: none;">
                    </div>

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
                        <img src="{{ asset('images/footer-logo.png') }}" alt="eterno">
                    </div>
                    <div class="footer-address">
                        <strong>Conglomerate of</strong>
                        @if ($contactpage && $contactpage->address_1)
                            {!! nl2br(e($contactpage->address_1)) !!}
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-xl-3 col-lg-4 col-md-6 footer-col">
                <div class="footer-links-area d-flex justify-content-start justify-content-lg-center">
                    <div>
                        <h5 class="footer-heading">Quick Links</h5>
                        <ul class="footer-links">
                            <li> <a href="{{ route('home') }}"> Home </a> </li>
                            <li> <a href="{{ route('about-us') }}"> About Us </a> </li>
                            <li> <a href="{{ route('offers') }}"> Offers </a> </li>
                            <li> <a href="{{ route('experiences') }}"> Experiences </a> </li>
                            <li> <a href="{{ route('gallery') }}"> Gallery </a> </li>
                            <li> <a href="{{ route('contact') }}"> Contact </a> </li>
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
                            @forelse ($resorts as $resort)
                                <li> <a href="{{ $resort->url }}"> {{ $resort->name }} </a>
                                </li>
                            @empty
                                <li> <span>No resorts available</span> </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Contact Us -->
            <div class="col-xl-4  col-md-6 footer-col">
                <div class="footer-contact-area d-flex justify-content-start justify-content-xl-end">

                    <div>
                        <h5 class="footer-heading">Contact Us</h5>

                        @if ($contactpage)
                            <ul class="footer-contact-list">
                                {{-- Phone 1 --}}
                                @if (!empty($contactpage->phone_1))
                                    <li>
                                        <i class="bi bi-phone"></i> <a
                                            href="tel:{{ preg_replace('/[^0-9+]/', '', $contactpage->phone_1) }}">
                                            {{ $contactpage->phone_1 }} </a>
                                    </li>
                                @endif
                                {{-- Phone 2 --}}
                                @if (!empty($contactpage->phone_2))
                                    <li>
                                        <i class="bi bi-phone"></i> <a
                                            href="tel:{{ preg_replace('/[^0-9+]/', '', $contactpage->phone_2) }}">
                                            {{ $contactpage->phone_2 }} </a>
                                    </li>
                                @endif
                                {{-- Telephone --}}
                                @if (!empty($contactpage->phone_3))
                                    <li>
                                        <i class="bi bi-telephone"></i> <a
                                            href="tel:{{ preg_replace('/[^0-9+]/', '', $contactpage->phone_3) }}">
                                            {{ $contactpage->phone_3 }} </a>
                                    </li>
                                @endif
                                {{-- Email --}}
                                @if (!empty($contactpage->email))
                                    <li>
                                        <i class="bi bi-envelope"></i> <a href="mailto:{{ $contactpage->email_1 }}">
                                            {{ $contactpage->email_1 }} </a>
                                    </li>
                                @endif
                                {{-- Reservation Email --}}
                                @if (!empty($contactpage->email_2))
                                    <li> <i class="bi bi-envelope"></i> <a href="mailto:{{ $contactpage->email_2 }}">
                                            {{ $contactpage->email_2 }}"
                                        </a>
                                    </li>
                                @endif
                            </ul>

                            {{--  <div class="footer-follow">
                                <span>Follow Us</span>

                                <div class="footer-social">

                                    @if (!empty($contactpage->twitter_url))
                                        <a href="{{ $contactpage->twitter_url }}" target="_blank" rel="noopener"
                                            aria-label="X">
                                            <i class="bi bi-twitter-x"></i> </a>
                                    @endif

                                    @if (!empty($contactpage->youtube_url))
                                        <a href="{{ $contactpage->youtube_url }}" target="_blank" rel="noopener"
                                            aria-label="YouTube"> <i class="bi bi-youtube"></i> </a>
                                    @endif

                                    @if (!empty($contactpage->instagram_url))
                                        <a href="{{ $contactpage->instagram_url }}" target="_blank" rel="noopener"
                                            aria-label="Instagram"> <i class="bi bi-instagram"></i> </a>
                                    @endif

                                    @if (!empty($contactpage->facebook_url))
                                        <a href="{{ $contactpage->facebook_url }}" target="_blank" rel="noopener"
                                            aria-label="Facebook"> <i class="bi bi-facebook"></i> </a>
                                    @endif
                                </div>
                            </div>  --}}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>
                ©2026. All rights reserved. Kavumkal Dream Destination Pvt. Ltd.
                <span class="footer-divider">|</span>
                Designed By
                <a href="https://camstech.com/" class="color-primary text-decoration-none" target="_blank">
                    CAMS
                </a>
            </p>

            <div class="footer-legal">
                <a href="#">Terms & Conditions</a>
                <span class="footer-divider">|</span>
                <a href="#">Privacy Policy</a>
            </div>

        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/main.js') }}"></script>
<script src="https://unpkg.com/lenis@1.3.11/dist/lenis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>



@push('styles')
    <style>
        .recaptcha-notice {
            width: 100%;
            flex-basis: 100%;
            text-align: center;
            font-size: 11px;
            line-height: 1.5;
            margin: 8px 0;
            opacity: 0.75;
        }

        .recaptcha-notice a {
            text-decoration: underline;
        }
    </style>
@endpush
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {


            const newsletterForm = document.getElementById('newsletterForm');
            const newsletterEmail = document.getElementById('newsletterEmail');
            const newsletterEmailError = document.getElementById('newsletterEmailError');
            const newsletterSubmit = document.getElementById('newsletterSubmit');
            const honeypot = document.getElementById('username');

            if (
                !newsletterForm ||
                !newsletterEmail ||
                !newsletterEmailError ||
                !newsletterSubmit ||
                !honeypot
            ) {
                return;
            }

            newsletterForm.addEventListener('submit', function(e) {

                e.preventDefault();



                clearEmailError();


                const email = newsletterEmail.value.trim();




                if (email === '') {

                    showEmailError('Email is required.');

                    return;
                }



                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailPattern.test(email)) {

                    showEmailError(
                        'The email field must be a valid email address.'
                    );

                    return;
                }


                newsletterSubmit.disabled = true;
                newsletterSubmit.textContent = 'Subscribing...';



                fetch("{{ route('newsletter.subscribe') }}", {

                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',

                            'X-CSRF-TOKEN': document.querySelector(
                                '#newsletterForm input[name="_token"]'
                            ).value
                        },

                        body: JSON.stringify({



                            email: email,


                            username: honeypot.value

                        })

                    })



                    .then(async response => {

                        const data = await response.json();


                        if (response.status === 422) {



                            if (data.honeypot === true) {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Unable to Subscribe',
                                    text: data.message || 'Unable to process your request.',
                                    confirmButtonText: 'OK'
                                });

                                throw new Error('honeypot');
                            }



                            if (
                                data.errors &&
                                data.errors.email &&
                                data.errors.email.length > 0
                            ) {

                                showEmailError(data.errors.email[0]);
                            }

                            throw new Error('validation');
                        }




                        if (response.status === 409) {

                            Swal.fire({
                                icon: 'warning',
                                title: 'Already Subscribed',
                                text: data.message,
                                confirmButtonText: 'OK'
                            });

                            throw new Error('duplicate');
                        }




                        if (!response.ok) {

                            throw new Error(
                                data.message ||
                                'Something went wrong. Please try again.'
                            );
                        }




                        return data;

                    })




                    .then(data => {

                        if (data.success) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Subscribed!',
                                text: data.message,
                                confirmButtonText: 'OK'
                            });



                            newsletterForm.reset();




                            clearEmailError();
                        }

                    })



                    .catch(error => {

                        /*
                        |--------------------------------------------------------------------------
                        | Already handled errors
                        |--------------------------------------------------------------------------
                        */

                        if (
                            error.message === 'validation' ||
                            error.message === 'honeypot' ||
                            error.message === 'duplicate'
                        ) {
                            return;
                        }



                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong',
                            text: error.message || 'Please try again later.',
                            confirmButtonText: 'OK'
                        });

                    })




                    .finally(() => {

                        newsletterSubmit.disabled = false;
                        newsletterSubmit.textContent = 'Subscribe';

                    });

            });



            function showEmailError(message) {

                newsletterEmail.classList.add('is-invalid');

                newsletterEmailError.textContent = message;

                newsletterEmailError.style.display = 'block';

            }




            function clearEmailError() {

                newsletterEmail.classList.remove('is-invalid');

                newsletterEmailError.textContent = '';

                newsletterEmailError.style.display = 'none';

            }



            newsletterEmail.addEventListener('input', function() {

                clearEmailError();

            });

        });
    </script>
@endpush


@stack('scripts')
</body>

</html>
