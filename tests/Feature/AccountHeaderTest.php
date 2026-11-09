<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountHeaderTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_see_a_login_link_in_the_header(): void
    {
        $this->get(route('home'))
            ->assertSee('href="'.route('login').'"', false)
            ->assertSee('aria-label="Inloggen"', false)
            ->assertDontSee('aria-label="Mijn account"', false);
    }

    public function test_guests_are_sent_to_the_login_page_for_their_account(): void
    {
        $this->get(route('account'))->assertRedirect(route('login'));
    }

    public function test_logged_in_users_see_my_account_in_the_header_and_their_details(): void
    {
        $user = User::factory()->create(['name' => 'Jan de Vries', 'email' => 'jan@voorbeeld.nl']);

        $this->actingAs($user)->get(route('home'))
            ->assertSee('href="'.route('account').'"', false)
            ->assertSee('aria-label="Mijn account"', false)
            ->assertDontSee('aria-label="Inloggen"', false);

        $this->actingAs($user)->get(route('account'))
            ->assertOk()
            ->assertSee('Mijn account')
            ->assertSee('Welkom, Jan de Vries')
            ->assertSee('Particulier account')
            ->assertSee('action="'.route('logout').'"', false);

        // Het e-mailadres staat bij "Gegevens"
        $this->actingAs($user)->get(route('profile.edit'))->assertSee('jan@voorbeeld.nl');
    }

    public function test_profile_page_shows_its_content_inside_the_site_layout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('profile.edit'))
            ->assertOk()
            ->assertSee('Hoofdnavigatie')
            ->assertSee('Uw gegevens')
            ->assertSee('Wachtwoord wijzigen')
            ->assertSee('Account verwijderen')
            ->assertSee('name="email"', false)
            ->assertDontSee('Profile Information');
    }

    public function test_users_can_log_out(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('logout'))->assertRedirect('/');
        $this->assertGuest();
    }
}
