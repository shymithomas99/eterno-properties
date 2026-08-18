@extends('front.layouts.app')
@section('title', 'Offers | ')
{{--  <title>Booking Enquiry - Eterno Hotels & Resorts</title>  --}}
@section('content')



    <section class="hero-banner contact-banner"
        style="background-image:
        linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
        url('asset('images/contact-hero-bg.jpg') ');">

        {{--  {{ dd($page) }}  --}}
        <div class="hero-inner-content px-2">
            <h1>Booking Enquiry</h1>
            <p>Ready to experience the warmth and luxury of Eterno? Fill out the form below and our reservations team
                will get back to you within 24 hours.</p>
        </div>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a><span>&rsaquo;</span>Booking Form
        </div>
    </section>

    <!-- Booking Enquiry Form Section -->
    <section class="booking-section">
        <div class="container">
            <div class="booking-wrapper">
                <div class="row g-0">


                    <!-- Form Side -->
                    <div class="col-lg-12">
                        <div class="booking-form-side">
                            <span class="section-label">Get In Touch</span>
                            <h2>Send Us Your Enquiry</h2>
                            <p>Fill in your details below and we'll prepare a personalised booking proposal for you.</p>

                            <!-- Alert Messages -->
                            <div class="form-alert alert-success" id="successAlert" role="alert">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Thank you! Your enquiry has been submitted successfully. We'll contact you
                                    shortly.</span>
                            </div>

                            <div class="form-alert alert-error" id="errorAlert" role="alert">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span>Something went wrong. Please try again or contact us directly.</span>
                            </div>

                            <form id="bookingForm" action="{{ route('booking.enquiry.store') }}" method="POST">
                                @csrf

                                {{-- Honeypot (same as contact) --}}
                                <div class="honeypot-field" aria-hidden="true">
                                    <label for="username-contact">Username</label>
                                    <input type="text" id="username-contact" name="username" value=""
                                        tabindex="-1" autocomplete="off">
                                </div>

                                <div class="form-row">
                                    <!-- Guest Name -->
                                    <div class="form-group">
                                        <label for="guestName" class="form-label">
                                            Guest Name <span class="required">*</span>
                                        </label>
                                        <input type="text" id="guestName" name="guestName" class="form-control-custom"
                                            placeholder="Enter your full name" autocomplete="name">
                                        <div class="field-error" data-error-for="guestName"></div>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="form-group">
                                        <label for="email" class="form-label">
                                            Email Address <span class="required">*</span>
                                        </label>
                                        <input type="email" id="email" name="email" class="form-control-custom"
                                            placeholder="Enter your email address" autocomplete="email">
                                        <div class="field-error" data-error-for="email"></div>
                                    </div>

                                    <!-- Phone Number -->
                                    <div class="form-group">
                                        <label for="phone" class="form-label">
                                            Phone Number <span class="required">*</span>
                                        </label>
                                        <input type="tel" id="phone" name="phone" class="form-control-custom"
                                            placeholder="Enter your phone number" autocomplete="tel">
                                        <div class="field-error" data-error-for="phone"></div>
                                    </div>

                                    <!-- Arrival Date -->
                                    <div class="form-group">
                                        <label for="arrivalDate" class="form-label">
                                            Arrival Date <span class="required">*</span>
                                        </label>
                                        <input type="date" id="arrivalDate" name="arrivalDate"
                                            class="form-control-custom" placeholder="Select arrival date">
                                        <div class="field-error" data-error-for="arrivalDate"></div>
                                    </div>

                                    <!-- Number of Persons -->
                                    <div class="form-group">
                                        <label for="guests" class="form-label">
                                            Number of Persons <span class="required">*</span>
                                        </label>
                                        <input type="number" id="guests" name="guests" class="form-control-custom"
                                            placeholder="Enter number of persons">
                                        <div class="field-error" data-error-for="guests"></div>
                                    </div>

                                    <!-- Preferred Resort (Optional but useful) -->
                                    <div class="form-group">
                                        <label for="resort" class="form-label">
                                            Preferred Room
                                        </label>
                                        <select id="resort" name="resort" class="form-control-custom">
                                            <option value="" {{ request()->get('resort') ? '' : 'selected' }}>Select
                                                your room</option>
                                            @foreach ($rooms ?? [] as $r)
                                                <option value="{{ $r->slug }}"
                                                    {{ old('resort') == $r->slug || request()->get('resort') == $r->slug ? 'selected' : '' }}>
                                                    {{ $r->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="field-error" data-error-for="resort"></div>
                                    </div>

                                    <!-- Message -->
                                    <div class="form-group full-width">
                                        <label for="message" class="form-label">
                                            Message
                                        </label>
                                        <textarea id="message" name="message" class="form-control-custom"
                                            placeholder="Tell us about your preferences, special requirements, or any questions you have." rows="5"
                                            maxlength="1000"></textarea>
                                        <div class="field-error" data-error-for="message"></div>
                                    </div>
                                </div>

                                <button type="submit" class="btn-submit" id="submitBtn">
                                    <span id="submitLoader" style="display:none;">Sending...</span>
                                    <span id="submitText">Submit Enquiry</span>
                                </button>

                                {{-- reCAPTCHA token --}}
                                <input type="hidden" name="recaptcha_token" id="recaptcha_token">

                                <div class="form-footer">
                                    By submitting this form, you agree to our privacy policy and terms of service.
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <style>
        .swal2-popup {
            font-family: inherit;
        }

        .honeypot-field {
            position: absolute !important;
            left: -9999px !important;
            top: -9999px !important;
            width: 1px !important;
            height: 1px !important;
            overflow: hidden !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }

        .field-error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 6px;
            display: none;
        }

        .field-error.show {
            display: block;
        }

        .input-error {
            border-color: #dc3545 !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const form = document.getElementById('bookingForm');

            if (!form) return;

            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitLoader = document.getElementById('submitLoader');

            function clearErrors() {
                document.querySelectorAll('.field-error').forEach(function(el) {
                    el.innerHTML = '';
                    el.classList.remove('show');
                });
                form.querySelectorAll('.input-error').forEach(function(el) {
                    el.classList.remove('input-error');
                });
            }

            function showErrors(errors) {
                Object.keys(errors).forEach(function(field) {
                    const errorEl = document.querySelector('[data-error-for="' + field + '"]');
                    const inputEl = form.querySelector('[name="' + field + '"]');
                    if (errorEl && errors[field].length > 0) {
                        errorEl.textContent = errors[field][0];
                        errorEl.classList.add('show');
                    }
                    if (inputEl) inputEl.classList.add('input-error');
                });
            }

            // Remove field error while typing
            form.querySelectorAll('input, select, textarea').forEach(function(field) {
                field.addEventListener('input', function() {
                    const err = document.querySelector('[data-error-for="' + this.name + '"]');
                    if (err) {
                        err.innerHTML = '';
                        err.classList.remove('show');
                    }
                    this.classList.remove('input-error');
                });
                field.addEventListener('change', function() {
                    const err = document.querySelector('[data-error-for="' + this.name + '"]');
                    if (err) {
                        err.innerHTML = '';
                        err.classList.remove('show');
                    }
                    this.classList.remove('input-error');
                });
            });

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                clearErrors();

                // Honeypot
                const honeypot = form.querySelector('[name="username"]');
                if (honeypot && honeypot.value.trim() !== '') {
                    await Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Unable to submit your enquiry. Please try again.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // Loading
                submitBtn.disabled = true;
                if (submitText) submitText.style.display = 'none';
                if (submitLoader) submitLoader.style.display = 'inline';

                try {
                    // Generate reCAPTCHA token
                    const token = await grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', {
                        action: 'booking_form'
                    });
                    document.getElementById('recaptcha_token').value = token;

                    const formData = new FormData(form);

                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        await Swal.fire({
                            icon: 'success',
                            title: 'Thank You!',
                            text: data.message,
                            confirmButtonText: 'OK'
                        });
                        form.reset();
                        clearErrors();
                        document.getElementById('recaptcha_token').value = '';
                    } else if (response.status === 422) {
                        if (data.errors) {
                            showErrors(data.errors);
                        } else {
                            await Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: data.message ||
                                    'Security verification failed. Please try again.',
                                confirmButtonText: 'OK'
                            });
                        }
                    } else {
                        await Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: data.message || 'Something went wrong. Please try again.',
                            confirmButtonText: 'OK'
                        });
                    }

                } catch (err) {
                    console.error('Booking form error:', err);
                    await Swal.fire({
                        icon: 'error',
                        title: 'Something Went Wrong',
                        text: 'Unable to submit your enquiry. Please try again.',
                        confirmButtonText: 'OK'
                    });
                } finally {
                    submitBtn.disabled = false;
                    if (submitText) submitText.style.display = 'inline';
                    if (submitLoader) submitLoader.style.display = 'none';
                }
            });
        });
    </script>
@endpush
