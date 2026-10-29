<?php

namespace Tests\Feature;

use App\Mail\QuoteReceived;
use App\Mail\QuoteRequested;
use Illuminate\Support\Facades\Mail;
use RuntimeException;
use Tests\TestCase;

class ContactPageTest extends TestCase
{
    /** Een volledig en geldig ingevuld formulier. */
    private function geldigeAanvraag(array $anders = []): array
    {
        return array_merge([
            'klanttype' => 'particulier',
            'naam' => 'Jan de Vries',
            'bedrijfsnaam' => '',
            'email' => 'jan@voorbeeld.nl',
            'telefoon' => '06 12345678',
            'postcode_plaats' => '6534 AJ Nijmegen',
            'dienst' => 'camerabewaking',
            'producten' => 'Pakket Plus',
            'omschrijving' => 'Ik wil camera’s rond mijn woning laten plaatsen.',
        ], $anders);
    }

    public function test_contact_page_shows_the_form_and_contact_details(): void
    {
        $response = $this->get(route('contact'));

        $response->assertOk();
        $response->assertSee('Contact en offerte');
        $response->assertSee('action="'.route('contact.store').'"', false);
        $response->assertSee('name="_token"', false);

        foreach (['klanttype', 'naam', 'bedrijfsnaam', 'email', 'telefoon', 'postcode_plaats', 'dienst', 'producten', 'omschrijving'] as $veld) {
            $response->assertSee('name="'.$veld.'"', false);
        }

        $response->assertSee(config('site.phone'));
        $response->assertSee(config('site.email'));
        $response->assertSee(config('site.address.street'));
    }

    public function test_links_can_prefill_the_form(): void
    {
        $this->get(route('contact', ['dienst' => 'alarmsystemen', 'klant' => 'zakelijk']))
            ->assertSee('<option value="alarmsystemen" selected>', false)
            ->assertSee('data-klant-vast="zakelijk"', false);

        $this->get(route('contact', ['pakket' => 'Plus']))
            ->assertSee('value="Pakket Plus"', false);

        $this->get(route('contact', ['product' => 'NVR-recorder 8 kanalen']))
            ->assertSee('value="NVR-recorder 8 kanalen"', false);
    }

    public function test_unknown_prefill_values_are_ignored(): void
    {
        $this->get(route('contact', ['dienst' => 'bestaat-niet', 'klant' => 'iets-anders']))
            ->assertOk()
            ->assertDontSee('selected>', false)
            ->assertDontSee('data-klant-vast', false);
    }

    public function test_a_valid_request_is_mailed_to_the_company_and_confirmed_to_the_customer(): void
    {
        Mail::fake();

        $this->post(route('contact.store'), $this->geldigeAanvraag())
            ->assertRedirect(route('contact'))
            ->assertSessionHas('verzonden', true);

        Mail::assertSent(QuoteRequested::class, function (QuoteRequested $mail) {
            return $mail->hasTo(config('site.email'))
                && $mail->hasReplyTo('jan@voorbeeld.nl')
                && $mail->aanvraag['dienst'] === 'Camerabewaking';
        });

        Mail::assertSent(QuoteReceived::class, fn (QuoteReceived $mail) => $mail->hasTo('jan@voorbeeld.nl'));

        $this->followingRedirects()
            ->post(route('contact.store'), $this->geldigeAanvraag())
            ->assertSee('Bedankt voor uw aanvraag');
    }

    public function test_required_fields_show_dutch_error_messages(): void
    {
        Mail::fake();

        $this->from(route('contact'))
            ->post(route('contact.store'), [])
            ->assertRedirect(route('contact'))
            ->assertSessionHasErrors([
                'klanttype' => 'Kies of u particulier of zakelijk bent.',
                'naam' => 'Vul uw naam in.',
                'email' => 'Vul uw e-mailadres in.',
                'omschrijving' => 'Vertel kort wat u wilt beveiligen.',
            ]);

        Mail::assertNothingSent();
    }

    public function test_business_requests_need_a_company_name_and_a_valid_email(): void
    {
        $this->post(route('contact.store'), $this->geldigeAanvraag([
            'klanttype' => 'zakelijk',
            'bedrijfsnaam' => '',
            'email' => 'geen-emailadres',
        ]))->assertSessionHasErrors(['bedrijfsnaam', 'email']);
    }

    public function test_errors_are_shown_next_to_the_fields_and_input_is_kept(): void
    {
        $this->followingRedirects()
            ->from(route('contact'))
            ->post(route('contact.store'), $this->geldigeAanvraag(['email' => 'fout']))
            ->assertSee('Niet alles is goed ingevuld')
            ->assertSee('Vul een geldig e-mailadres in')
            ->assertSee('aria-invalid="true"', false)
            ->assertSee('value="Jan de Vries"', false);
    }

    public function test_spam_robots_get_a_thank_you_but_nothing_is_sent(): void
    {
        Mail::fake();

        $this->post(route('contact.store'), $this->geldigeAanvraag(['website' => 'http://spam.example']))
            ->assertSessionHas('verzonden', true);

        Mail::assertNothingSent();
    }

    public function test_a_mail_failure_keeps_the_input_and_shows_a_message(): void
    {
        Mail::shouldReceive('to')->andThrow(new RuntimeException('Mailserver niet bereikbaar'));

        $this->from(route('contact'))
            ->post(route('contact.store'), $this->geldigeAanvraag())
            ->assertRedirect(route('contact'))
            ->assertSessionHas('mislukt', true)
            ->assertSessionHasInput('naam', 'Jan de Vries');
    }
}
