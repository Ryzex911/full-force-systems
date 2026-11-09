<?php

namespace Tests\Feature;

use App\Support\Catalog;
use Tests\TestCase;

class ProductPageTest extends TestCase
{
    public function test_every_product_has_a_working_page(): void
    {
        foreach (Catalog::products() as $product) {
            $this->get(route('webshop.show', $product['slug']))
                ->assertOk()
                ->assertSee('<h1', false)
                ->assertSee($product['title'])
                ->assertSee($product['price']);
        }
    }

    public function test_product_page_shows_the_parts_from_the_design(): void
    {
        $response = $this->get(route('webshop.show', '4k-ip-camera-buiten'));

        $response->assertSeeInOrder([
            'Webshop',
            "Camera's",
            '4K IP-camera buiten',
            '€ 199,00',
            'Op voorraad',
            'In winkelwagen',
            'Beschrijving',
            'Specificaties',
            'Installatie',
            'Scherp beeld, ook in het donker',
            'Liever laten installeren?',
            'Vaak samen gekocht',
            'NVR-recorder 8 kanalen',
        ], false);
        $response->assertSee('action="'.route('winkelwagen.store').'"', false);
        $response->assertSee('action="'.route('favorieten.toggle', '4k-ip-camera-buiten').'"', false);
        $response->assertSee('href="'.e(route('contact', ['product' => '4K IP-camera buiten'])).'#offerteformulier"', false);
    }

    public function test_webshop_cards_link_to_the_product_page(): void
    {
        $this->get(route('webshop'))
            ->assertSee('href="'.route('webshop.show', 'dome-camera-binnen').'"', false);
    }

    public function test_unknown_product_gives_a_404_page(): void
    {
        $this->get(route('webshop.show', 'bestaat-niet'))->assertNotFound();
    }

    public function test_menu_marks_webshop_as_current_page(): void
    {
        $this->get(route('webshop.show', 'bewegingsmelder'))
            ->assertSee('aria-current="page"', false)
            ->assertSee('Voorbeeldproduct en -specificaties');
    }
}
