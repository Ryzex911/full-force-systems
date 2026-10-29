<?php

namespace Tests\Feature;

use App\Support\Catalog;
use Tests\TestCase;

class ServiceDetailPageTest extends TestCase
{
    public function test_every_service_has_a_working_detail_page(): void
    {
        foreach (config('site.services') as $service) {
            $response = $this->get(route('diensten.show', $service['slug']));

            $response->assertOk();
            $response->assertSeeInOrder([
                $service['title'],
                'Wat u krijgt',
                'Duidelijk vooraf wat het kost',
                'In vier stappen geregeld',
                'Goed om te weten',
                'Bijpassende producten',
            ]);

            foreach ($service['benefits'] as $voordeel) {
                $response->assertSee($voordeel['title']);
            }

            foreach ($service['faq'] as $vraag) {
                $response->assertSee(e($vraag), false);
            }

            foreach (Catalog::productsBySlug($service['products']) as $product) {
                $response->assertSee($product['title']);
            }

            $response->assertSee('href="'.e(route('contact', ['dienst' => $service['slug']])).'#offerteformulier"', false);
        }
    }

    public function test_camera_page_shows_the_texts_from_the_design(): void
    {
        $this->get(route('diensten.show', 'camerabewaking'))
            ->assertSee('Van eerste advies tot uitleg bij oplevering')
            ->assertSee('vanaf pakket Basis')
            ->assertSee('Kan ik de beelden op mijn telefoon bekijken?')
            ->assertSee('Antwoorden volgen van de opdrachtgever.')
            ->assertSee('Werkgebied: Gelderland · Brabant · Limburg')
            ->assertDontSee('Voorbeeldtekst');
    }

    public function test_services_without_a_design_are_marked_as_example(): void
    {
        $this->get(route('diensten.show', 'alarmsystemen'))
            ->assertSee('Voorbeeldtekst — wordt nog nagelezen door de opdrachtgever.');
    }

    public function test_breadcrumb_and_menu_point_to_the_services_page(): void
    {
        $this->get(route('diensten.show', 'video-intercom'))
            ->assertSee('<a href="'.route('diensten').'" class="hover:text-ink">Diensten</a>', false)
            ->assertSee('aria-current="page"', false);
    }

    public function test_unknown_service_gives_a_404_page(): void
    {
        $this->get('/diensten/bestaat-niet')
            ->assertNotFound()
            ->assertSee('Deze pagina bestaat niet (meer)');
    }

    public function test_services_page_and_footer_link_to_the_detail_pages(): void
    {
        $response = $this->get(route('diensten'));

        foreach (config('site.services') as $service) {
            $response->assertSee('href="'.route('diensten.show', $service['slug']).'"', false);
        }

        $response->assertSee('Meer informatie');
    }
}
