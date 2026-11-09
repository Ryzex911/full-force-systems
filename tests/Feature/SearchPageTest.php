<?php

namespace Tests\Feature;

use Tests\TestCase;

class SearchPageTest extends TestCase
{
    public function test_search_page_without_a_term_shows_suggestions(): void
    {
        $this->get(route('zoeken'))
            ->assertOk()
            ->assertSee('Veel gezocht')
            ->assertSee('href="'.route('zoeken', ['q' => 'Camera']).'"', false);
    }

    public function test_search_finds_products_services_and_projects(): void
    {
        $this->get(route('zoeken', ['q' => 'camera']))
            ->assertOk()
            ->assertSee('resultaten voor')
            ->assertSeeInOrder(['Producten', '4K IP-camera buiten', 'Diensten', 'Camerabewaking'])
            ->assertSee('href="'.route('diensten.show', 'camerabewaking').'"', false);

        $this->get(route('zoeken', ['q' => 'beuningen']))
            ->assertSee('Tax administraties')
            ->assertSee('href="'.route('projecten.show', 'tax-administraties').'"', false);
    }

    public function test_all_words_must_match(): void
    {
        $this->get(route('zoeken', ['q' => 'camera buiten']))
            ->assertSee('4K IP-camera buiten')
            ->assertDontSee('Dome-camera binnen');
    }

    public function test_search_without_results_shows_a_message(): void
    {
        $this->get(route('zoeken', ['q' => 'zaklamp']))
            ->assertOk()
            ->assertSee('Geen resultaten voor')
            ->assertSee('zaklamp');
    }

    public function test_header_shows_the_search_link(): void
    {
        $this->get(route('home'))->assertSee('href="'.route('zoeken').'"', false);
    }
}
