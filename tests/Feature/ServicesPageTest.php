<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServicesPageTest extends TestCase
{
    public function test_services_page_shows_every_service(): void
    {
        $response = $this->get(route('diensten'));

        $response->assertOk();
        $response->assertSee('Beveiligings&shy;techniek voor woning en bedrijf', false);

        foreach (config('site.services') as $service) {
            $response->assertSee($service['title']);
            $response->assertSee('id="'.$service['slug'].'"', false);

            foreach ($service['points'] as $point) {
                $response->assertSee($point);
            }
        }
    }

    public function test_services_page_shows_audiences_process_and_quote_block(): void
    {
        $response = $this->get(route('diensten'));

        $response->assertSeeInOrder([
            'Thuis of op de zaak: wij regelen het',
            'Voor thuis',
            'Voor bedrijven',
            'In vier stappen geregeld',
        ]);
        $response->assertSee('href="'.route('pakketten').'"', false);
        $response->assertSee('id="offerte"', false);
    }

    public function test_menu_marks_services_as_the_current_page(): void
    {
        $response = $this->get(route('diensten'));

        $response->assertSee('href="'.route('diensten').'"', false);
        $response->assertSee('aria-current="page"', false);
    }

    public function test_homepage_links_to_the_services_page(): void
    {
        $response = $this->get(route('home'));

        $response->assertSee('href="'.route('diensten').'"', false);

        foreach (config('site.services') as $service) {
            $response->assertSee('href="'.route('diensten').'#'.$service['slug'].'"', false);
        }
    }
}
