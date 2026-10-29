<?php

namespace Tests\Feature;

use App\Support\Catalog;
use Tests\TestCase;

class PackagesPageTest extends TestCase
{
    public function test_packages_page_shows_three_packages(): void
    {
        $response = $this->get(route('pakketten'));

        $response->assertOk();
        $response->assertSee('Kies het pakket dat bij uw woning past');

        foreach (Catalog::packages() as $pakket) {
            $response->assertSee($pakket['name']);
            $response->assertSee($pakket['price']);
            $response->assertSee('aria-label="Pakket kiezen: '.$pakket['name'].'"', false);
            $response->assertSee('href="'.e(route('contact', ['pakket' => $pakket['name']])).'#offerteformulier"', false);
        }

        $response->assertSee('Voorbeeldprijzen en -inhoud');
    }

    public function test_packages_page_shows_the_comparison_table(): void
    {
        $response = $this->get(route('pakketten'));

        $response->assertSee('Wat zit er in elk pakket?');
        $response->assertSee('<table', false);
        $response->assertSee('<th scope="col"', false);

        foreach (Catalog::comparison() as $rij) {
            $response->assertSee($rij['label']);
        }
    }

    public function test_packages_page_shows_business_block_and_process(): void
    {
        $this->get(route('pakketten'))
            ->assertSeeInOrder([
                'Wat zit er in elk pakket?',
                'Zakelijk? Wij maken een voorstel op maat',
                'In vier stappen geregeld',
            ])
            ->assertSee('href="'.e(route('contact', ['klant' => 'zakelijk'])).'#offerteformulier"', false)
            ->assertSee(asset('images/voorbeeld/kantoor.jpg'));
    }

    public function test_menu_marks_packages_as_the_current_page(): void
    {
        $this->get(route('pakketten'))
            ->assertSee('href="'.route('pakketten').'"', false)
            ->assertSee('aria-current="page"', false);
    }
}
