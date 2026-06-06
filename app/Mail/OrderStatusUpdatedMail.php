<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $status;
    public $items; // فقط منتجات المتجر

    public function __construct($order, $status, $items)
    {
        $this->order = $order;
        $this->status = $status;
        $this->items = $items;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Update on Your Order #' . $this->order->id
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.order_status_updated'
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

        foreach ($this->items as $item) {
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
