<?php

namespace App\Mail;

use App\Models\ContactInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactInquiryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public ContactInquiry $inquiry;

    public function __construct(ContactInquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    public function build(): self
    {
        return $this->subject('New Contact Inquiry Received')
            ->view('emails.contact-inquiry-notification');
    }
}