<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

/**
 * Automatische bevestiging aan de klant: "wij hebben uw aanvraag ontvangen" (wensenformulier, vraag 17).
 */
class QuoteReceived extends Mailable
{
    /**
     * @param  array<string, string|null>  $aanvraag  zie QuoteRequest::aanvraag()
     */
    public function __construct(public array $aanvraag) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Wij hebben uw aanvraag ontvangen');
    }

    public function content(): Content
    {
        return new Content(markdown: 'mail.offerte.bevestiging');
    }
}
