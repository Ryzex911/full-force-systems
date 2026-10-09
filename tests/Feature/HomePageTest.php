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

        foreach (['diensten', 'pakketten', 'webshop', 'projecten', 'offerte'] as $anchor) {
            $response->assertSee('href="'.route('home').'#'.$anchor.'"', false);
            $response->assertSee('id="'.$anchor.'"', false);
        }
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
