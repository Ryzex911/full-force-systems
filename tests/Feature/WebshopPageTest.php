<?php

namespace Tests\Feature;

use App\Support\Catalog;
use Tests\TestCase;

class WebshopPageTest extends TestCase
{
    public function test_webshop_shows_all_nine_products_and_the_filters(): void
    {
        $response = $this->get(route('webshop'));

        $response->assertOk();
        $response->assertSee('9 producten');

        foreach (Catalog::products() as $product) {
            $response->assertSee($product['title']);
        }

        foreach (Catalog::categories() as $categorie) {
            $response->assertSee(e($categorie['label']), false);
        }

        $response->assertSee('name="zoek"', false);
        $response->assertSee('name="sorteer"', false);
        $response->assertSee('name="prijs_van"', false);
        $response->assertSee('name="voorraad"', false);
    }

    public function test_a_category_shows_only_its_products(): void
    {
        $response = $this->get(route('webshop', ['categorie' => 'recorders']))
            ->assertSee('2 producten')
            ->assertSee('NVR-recorder 8 kanalen')
            ->assertSee('NVR-recorder 16 kanalen')
            ->assertDontSee('4K IP-camera buiten');

        // De gekozen categorie is gemarkeerd in de lijst
        $this->assertMatchesRegularExpression('/aria-current="true"\s*>Recorders</', $response->getContent());
    }

    public function test_search_and_price_filters_work(): void
    {
        $this->get(route('webshop', ['zoek' => 'camera']))
            ->assertSee('2 producten')
            ->assertSee('Dome-camera binnen')
            ->assertDontSee('Bewegingsmelder');

        $this->get(route('webshop', ['prijs_tot' => '100']))
            ->assertSee('2 producten')
            ->assertSee('Bewegingsmelder')
            ->assertSee('Netwerkkabel CAT6 50 m');
    }

    public function test_a_search_without_results_shows_a_message(): void
    {
        $this->get(route('webshop', ['zoek' => 'zaklamp']))
            ->assertOk()
            ->assertSee('0 producten')
            ->assertSee('Geen producten gevonden')
            ->assertSee('Alle producten tonen');
    }

    public function test_products_can_be_sorted_by_price(): void
    {
        $this->get(route('webshop', ['sorteer' => 'prijs-laag']))
            ->assertSeeInOrder(['Netwerkkabel CAT6 50 m', 'Bewegingsmelder', 'Dome-camera binnen']);

        $this->get(route('webshop', ['sorteer' => 'prijs-hoog']))
            ->assertSeeInOrder(['NVR-recorder 16 kanalen', 'Draadloze alarmset']);
    }

    public function test_category_links_keep_the_other_filters(): void
    {
        $this->get(route('webshop', ['zoek' => 'camera', 'sorteer' => 'naam']))
            ->assertSee('href="'.e(route('webshop', ['zoek' => 'camera', 'sorteer' => 'naam', 'categorie' => 'recorders'])).'"', false);
    }

    public function test_invalid_filter_values_are_ignored(): void
    {
        $this->get(route('webshop', ['categorie' => 'bodycams', 'prijs_van' => 'veel', 'sorteer' => 'raar']))
            ->assertOk()
            ->assertSee('9 producten');
    }

    public function test_menu_marks_webshop_as_the_current_page_and_home_links_to_it(): void
    {
        $this->get(route('webshop'))
            ->assertSee('href="'.route('webshop').'"', false)
            ->assertSee('aria-current="page"', false);

        $this->get(route('home'))->assertSee('Naar de webshop');
    }
}
