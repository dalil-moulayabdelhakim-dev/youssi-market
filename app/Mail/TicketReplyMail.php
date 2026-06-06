<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketReplyMail extends Mailable
{
    use Queueable, SerializesModels;


    public $ticket;
    public $type;
    /**
     * Create a new message instance.
     */
    public function __construct($ticket, $type)
    {
        $this->ticket = $ticket;
        $this->type = $type;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Reply Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.ticket',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];
        $attachments[] = Attachment::fromPath('img/logo.jpg')
            ->as('img/logo.jpg')
            ->withMime('image/jpeg');
        return $attachments;
    }
}
