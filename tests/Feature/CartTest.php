<?php

namespace Tests\Feature;

use Tests\TestCase;

class CartTest extends TestCase
{
    public function test_empty_cart_shows_a_message(): void
    {
        $this->get(route('winkelwagen'))
            ->assertOk()
            ->assertSee('Uw winkelwagen is leeg')
            ->assertSee('href="'.route('webshop').'"', false);
    }

    public function test_a_product_can_be_added_and_is_shown_with_the_total(): void
    {
        $this->from(route('webshop.show', '4k-ip-camera-buiten'))
            ->post(route('winkelwagen.store'), ['product' => '4k-ip-camera-buiten', 'aantal' => 2])
            ->assertRedirect(route('webshop.show', '4k-ip-camera-buiten'))
            ->assertSessionHas('winkelwagen', ['4k-ip-camera-buiten' => 2]);

        // Nog een keer toevoegen telt op; zonder aantal is het 1
        $this->post(route('winkelwagen.store'), ['product' => '4k-ip-camera-buiten'])
            ->assertSessionHas('winkelwagen', ['4k-ip-camera-buiten' => 3]);

        $this->get(route('winkelwagen'))
            ->assertOk()
            ->assertSee('4K IP-camera buiten')
            ->assertSee('€ 597,00')
            ->assertSee('value="3"', false)
            ->assertSee('aria-label="Winkelwagen, 3 producten"', false);
    }

    public function test_after_adding_the_page_shows_a_message_with_a_link_to_the_cart(): void
    {
        $this->followingRedirects()
            ->from(route('webshop'))
            ->post(route('winkelwagen.store'), ['product' => 'bewegingsmelder'])
            ->assertSee('Bewegingsmelder staat in uw winkelwagen.')
            ->assertSee('Bekijk winkelwagen');
    }

    public function test_quantity_can_be_changed_and_a_product_removed(): void
    {
        $this->withSession(['winkelwagen' => ['bewegingsmelder' => 1, 'dome-camera-binnen' => 1]]);

        $this->patch(route('winkelwagen.update', 'bewegingsmelder'), ['aantal' => 4])
            ->assertRedirect(route('winkelwagen'))
            ->assertSessionHas('winkelwagen', ['bewegingsmelder' => 4, 'dome-camera-binnen' => 1]);

        // Aantal 0 haalt het product weg
        $this->patch(route('winkelwagen.update', 'bewegingsmelder'), ['aantal' => 0])
            ->assertSessionHas('winkelwagen', ['dome-camera-binnen' => 1]);

        $this->delete(route('winkelwagen.destroy', 'dome-camera-binnen'))
            ->assertRedirect(route('winkelwagen'))
            ->assertSessionHas('winkelwagen', []);
    }

    public function test_invalid_quantities_and_unknown_products_are_refused(): void
    {
        $this->post(route('winkelwagen.store'), ['product' => 'bewegingsmelder', 'aantal' => 0])
            ->assertSessionHasErrors(['aantal' => 'Het aantal moet minstens 1 zijn.']);

        $this->post(route('winkelwagen.store'), ['product' => 'bewegingsmelder', 'aantal' => 500])
            ->assertSessionHasErrors(['aantal' => 'U kunt maximaal 99 stuks van één product bestellen.']);

        $this->post(route('winkelwagen.store'), ['product' => 'bestaat-niet'])->assertNotFound();
    }

    public function test_cart_can_be_requested_as_a_quote_with_the_products_filled_in(): void
    {
        $this->withSession(['winkelwagen' => ['bewegingsmelder' => 2, 'netwerkkabel-cat6-50-m' => 1]]);

        $quote = route('contact', ['product' => '2× Bewegingsmelder, 1× Netwerkkabel CAT6 50 m']).'#offerteformulier';

        $this->get(route('winkelwagen'))->assertSee('href="'.e($quote).'"', false);
        $this->get($quote)->assertSee('2× Bewegingsmelder, 1× Netwerkkabel CAT6 50 m');
    }

    public function test_favorites_can_be_toggled(): void
    {
        $this->post(route('favorieten.toggle', 'bewegingsmelder'))->assertSessionHas('favorieten', ['bewegingsmelder']);

        $this->get(route('webshop.show', 'bewegingsmelder'))->assertSee('aria-pressed="true"', false);

        $this->post(route('favorieten.toggle', 'bewegingsmelder'))->assertSessionHas('favorieten', []);
    }
}
