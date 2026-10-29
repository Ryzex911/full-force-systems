<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_homepage_shows_all_sections(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSeeInOrder([
            'Beveiliging zonder compromis',
            'Eén aanspreekpunt voor uw beveiligingstechniek',
            'Kant-en-klaar beveiligd voor een vaste prijs',
            'In vier stappen geregeld',
            'Recent opgeleverd',
            'Zelf bestellen',
            'Wij werken samen met',
        ]);
        $response->assertSee(config('site.phone'));
        $response->assertSee(config('site.email'));
    }

    public function test_menu_links_point_to_sections_on_the_homepage(): void
    {
        $response = $this->get(route('home'));

        // Projecten heeft nog geen eigen pagina: die link springt naar het blok op de homepage
        $response->assertSee('href="'.route('home').'#projecten"', false);
        $response->assertSee('id="projecten"', false);

        // Pagina's die al bestaan krijgen een gewone link
        foreach (['diensten', 'pakketten', 'webshop', 'over-ons', 'contact'] as $page) {
            $response->assertSee('href="'.route($page).'"', false);
        }
    }

    public function test_quote_buttons_go_to_the_form_with_a_prefilled_choice(): void
    {
        $response = $this->get(route('home'));

        $response->assertSee('href="'.route('contact').'#offerteformulier"', false);
        $response->assertSee('href="'.e(route('contact', ['klant' => 'zakelijk'])).'#offerteformulier"', false);
        $response->assertSee('href="'.e(route('contact', ['product' => '4K IP-camera buiten'])).'#offerteformulier"', false);
    }

    public function test_package_cards_link_to_the_packages_page(): void
    {
        $this->get(route('home'))
            ->assertSee('aria-label="Pakket bekijken: Plus"', false)
            ->assertSee('href="'.route('pakketten').'"', false);
    }

    public function test_images_are_served_from_the_project(): void
    {
        $response = $this->get(route('home'));

        $response->assertDontSee('images.unsplash.com');

        preg_match_all('#/(images/[^"]+\.jpg)"#', $response->getContent(), $matches);

        $this->assertNotEmpty($matches[1]);

        foreach (array_unique($matches[1]) as $path) {
            $this->assertFileExists(public_path($path));
        }
    }
}
