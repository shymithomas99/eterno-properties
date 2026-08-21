<?php

namespace App\Mail;

use App\Models\BookingEnquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingEnquiryAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public BookingEnquiry $enquiry,
        public string $website
    ) {}

    public function build()
    {
        return $this->subject('New Booking Enquiry')->view('front.emails.booking-enquiry-admin');
    }
}
