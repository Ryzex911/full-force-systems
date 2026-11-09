<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** De meldingen bij inloggen, registreren en wachtwoord wijzigen zijn Nederlands en zeggen "u" (lang/nl). */
class DutchMessagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_wrong_login_gives_a_dutch_message(): void
    {
        $user = User::factory()->create();

        $this->post('/login', ['email' => $user->email, 'password' => 'fout-wachtwoord'])
            ->assertSessionHasErrors(['email' => 'Het e-mailadres of wachtwoord klopt niet.']);
    }

    public function test_empty_registration_gives_dutch_messages(): void
    {
        $this->post('/register', [])
            ->assertSessionHasErrors([
                'name' => 'Vul uw naam in.',
                'email' => 'Vul uw e-mailadres in.',
            ]);
    }

    public function test_login_and_register_pages_use_u_instead_of_je(): void
    {
        $this->get('/login')->assertSee('Log in op uw')->assertDontSee('Log in op je');
        $this->get('/register')->assertSee('Heeft u al een account?')->assertDontSee('Heb je al een account?');
    }
}
