<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Order #' . $this->order->id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.new_order'
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
        foreach ($this->order->orderItems as $item) {
            if ($item->product->image) {
                $attachments[] = Attachment::fromPath($item->product->image)
                    ->as($item->product->title . '.jpg')
                    ->withMime('image/jpeg');
            }
        }
        $attachments[] = Attachment::fromPath('img/logo.jpg')
            ->as('img/logo.jpg')
            ->withMime('image/jpeg');
        return $attachments;
    }
}
