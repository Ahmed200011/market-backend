<?php

namespace App\Mail;

// use Illuminate\Mail\Address;


use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
// use Illuminate\Foundation\Auth\User;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public User $user)
    {
        //
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome Mail from Laravel 10 by ahmed',
            // from: new Address('ahmed@laravel.com', 'Ahmed')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // Attachment::fromStorageDisk('public','/dashboard/assets/images/products/6803a7b49a472pixel8.jpeg')

        ];
    }
}
