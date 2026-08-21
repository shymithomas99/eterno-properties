<?php

namespace App\Mail;

use App\Models\BookingEnquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingEnquiryUserMail extends Mailable
{
    use Queueable, SerializesModels;

    // public function __construct(public BookingEnquiry $enquiry) {}

    public function __construct(
        public BookingEnquiry $enquiry,
        public string $website
    ) {}

    public function build()
    {
        return $this->subject('Thank You for Your Booking Enquiry')->view('front.emails.booking-enquiry-user');
    }
}
