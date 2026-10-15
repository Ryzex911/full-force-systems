<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

/**
 * E-mail naar Full Force Systems met een nieuwe offerteaanvraag.
 * Met "Beantwoorden" in het mailprogramma antwoordt u direct aan de klant (replyTo).
 */
class QuoteRequested extends Mailable
{
    /**
     * @param  array<string, string|null>  $aanvraag  zie QuoteRequest::aanvraag()
     */
    public function __construct(public array $aanvraag) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address($this->aanvraag['email'], $this->aanvraag['naam'])],
            subject: 'Nieuwe offerteaanvraag van '.$this->aanvraag['naam'],
        );
    }

    public function content(): Content
    {
        return new Content(markdown: 'mail.offerte.aanvraag');
    }
}
