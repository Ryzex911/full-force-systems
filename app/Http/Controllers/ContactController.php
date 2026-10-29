<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequest;
use App\Mail\QuoteReceived;
use App\Mail\QuoteRequested;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class ContactController extends Controller
{
    /**
     * Toon de pagina Contact en offerte.
     *
     * Andere pagina's linken hierheen met een keuze in de url, zodat het formulier al half is ingevuld:
     *   /contact?dienst=camerabewaking   → gewenste dienst
     *   /contact?pakket=Plus             → product(en): "Pakket Plus"
     *   /contact?product=NVR-recorder    → product(en)
     *   /contact?klant=zakelijk          → particulier of zakelijk
     */
    public function show(Request $request): View
    {
        $services = collect(config('site.services'))->pluck('title', 'slug');

        $dienst = $request->query('dienst');
        $klant = $request->query('klant');

        $producten = match (true) {
            filled($request->query('pakket')) => 'Pakket '.$request->query('pakket'),
            filled($request->query('product')) => $request->query('product'),
            default => null,
        };

        return view('pages.contact', [
            'services' => $services,
            'prefill' => [
                'dienst' => $services->has($dienst) ? $dienst : null,
                'producten' => $producten ? Str::limit((string) $producten, 100, '') : null,
                'klanttype' => in_array($klant, ['particulier', 'zakelijk'], true) ? $klant : null,
            ],
        ]);
    }

    /**
     * Verstuur een offerteaanvraag.
     *
     * De aanvraag gaat per e-mail naar het bedrijf (config('site.email')) en de klant krijgt een automatische
     * bevestiging (wensenformulier, vraag 17). Lokaal staat MAIL_MAILER=log: de e-mails komen dan in
     * storage/logs/laravel.log in plaats van in een echte mailbox.
     * Later, met het adminpanel, slaan we de aanvraag ook op in de database.
     */
    public function store(QuoteRequest $request): RedirectResponse
    {
        // Verborgen veld dat alleen spam-robots invullen: doe alsof het gelukt is, maar verstuur niets.
        if (filled($request->input('website'))) {
            return to_route('contact')->with('verzonden', true);
        }

        $aanvraag = $request->aanvraag();

        try {
            Mail::to(config('site.email'))->send(new QuoteRequested($aanvraag));
        } catch (Throwable $fout) {
            report($fout);

            return back()->withInput()->with('mislukt', true);
        }

        try {
            Mail::to($aanvraag['email'])->send(new QuoteReceived($aanvraag));
        } catch (Throwable $fout) {
            // De aanvraag is binnen; alleen de bevestiging aan de klant mislukte. Wel loggen, niet stoppen.
            report($fout);
        }

        return to_route('contact')->with('verzonden', true);
    }
}
