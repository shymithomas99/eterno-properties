<?php

namespace App\Mail;

use App\Models\ContactEnquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactEnquiryAdminMail extends Mailable
{
    use Queueable, SerializesModels;
    public function __construct(public ContactEnquiry $enquiry) {}



    public function build()
    {
        return $this->subject('New Contact Enquiry')->view('front.emails.contact-enquiry-admin');
    }
}