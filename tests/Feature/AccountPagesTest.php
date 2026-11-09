<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_must_log_in_first(): void
    {
        foreach (['account', 'account.bestellingen', 'account.aanvragen', 'account.favorieten', 'account.adressen'] as $route) {
            $this->get(route($route))->assertRedirect(route('login'));
        }
    }

    public function test_old_dashboard_address_goes_to_my_account(): void
    {
        $this->get('/dashboard')->assertRedirect('/account');
    }

    public function test_dashboard_shows_the_parts_from_the_design(): void
    {
        $user = User::factory()->create(['name' => 'Jan de Vries']);

        $this->actingAs($user)->get(route('account'))
            ->assertOk()
            ->assertSeeInOrder([
                'Welkom, Jan de Vries',
                'Particulier account',
                'Dashboard',
                'Mijn bestellingen',
                'Mijn aanvragen',
                'Favorieten',
                'Adresboek',
                'Gegevens',
                'Wachtwoord wijzigen',
                'Uitloggen',
                'Recente bestellingen',
                '#FFS-1026',
                'Laatste aanvraag',
                'Standaardadres',
            ])
            ->assertSee('Voorbeeldgegevens');
    }

    public function test_business_account_shows_the_company_name(): void
    {
        $user = User::factory()->create(['account_type' => 'zakelijk', 'company_name' => 'Voorbeeld BV']);

        $this->actingAs($user)->get(route('account'))
            ->assertSee('Zakelijk account')
            ->assertSee('Voorbeeld BV');
    }

    public function test_every_account_page_works(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('account.bestellingen'))->assertOk()->assertSee('#FFS-1015');
        $this->actingAs($user)->get(route('account.aanvragen'))->assertOk()->assertSee('Offerte camerabewaking');
        $this->actingAs($user)->get(route('account.adressen'))->assertOk()->assertSee('Voorbeeldstraat 12');
        $this->actingAs($user)->get(route('account.favorieten'))->assertOk()->assertSee('U heeft nog geen favorieten');
    }

    public function test_favorites_page_shows_the_saved_products(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['favorieten' => ['bewegingsmelder']])
            ->get(route('account.favorieten'))
            ->assertSee('Bewegingsmelder')
            ->assertSee('Verwijderen uit favorieten');
    }

    public function test_profile_page_is_dutch_and_uses_the_account_menu(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('profile.edit'))
            ->assertOk()
            ->assertSee('aria-label="Mijn account"', false)
            ->assertSee('Opslaan')
            ->assertSee('id="wachtwoord"', false)
            ->assertDontSee('Save')
            ->assertDontSee('bg-white');
    }
}
