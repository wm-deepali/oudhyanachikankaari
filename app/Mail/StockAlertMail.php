<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StockAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly array $critical,  // products with stock <= critical threshold
        public readonly array $low,       // products with stock > critical but <= low threshold
        public readonly int   $criticalThreshold,
        public readonly int   $lowThreshold,
    ) {}

    public function envelope(): Envelope
    {
        $total = count($this->critical) + count($this->low);

        return new Envelope(
            subject: "⚠️ Stock Alert — {$total} " . str_plural('product', $total) . " need attention",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.stock-alert',
        );
    }
}