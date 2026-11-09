<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Support\Cart;
use App\Support\Catalog;
use App\Support\Nav;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Winkelwagen (in de sessie, zie App\Support\Cart).
 * Afrekenen (iDEAL / bankoverschrijving) komt later; tot die tijd vraagt de bezoeker de inhoud aan via het offerteformulier.
 */
class CartController extends Controller
{
    public function index(): View
    {
        $lines = Cart::lines();

        return view('pages.winkelwagen', [
            'lines' => $lines,
            'total' => Catalog::euro(Cart::total()),
            'quoteUrl' => $lines ? Nav::quote(['product' => Cart::summary()]) : Nav::quote(),
        ]);
    }

    /** "In winkelwagen" op een productkaart of de productpagina. */
    public function store(CartItemRequest $request): RedirectResponse
    {
        $product = $this->product((string) $request->input('product'));

        Cart::add($product['slug'], (int) $request->validated('aantal'));

        return back()->with('melding', [
            'tekst' => $product['title'].' staat in uw winkelwagen.',
            'link' => route('winkelwagen'),
            'linkTekst' => 'Bekijk winkelwagen',
        ]);
    }

    public function update(CartItemRequest $request, string $slug): RedirectResponse
    {
        $product = $this->product($slug);

        Cart::set($product['slug'], (int) $request->validated('aantal'));

        return to_route('winkelwagen')->with('melding', ['tekst' => 'Uw winkelwagen is bijgewerkt.']);
    }

    public function destroy(string $slug): RedirectResponse
    {
        $product = $this->product($slug);

        Cart::remove($product['slug']);

        return to_route('winkelwagen')->with('melding', ['tekst' => $product['title'].' is uit uw winkelwagen gehaald.']);
    }

    /** Het product bij de slug, of een 404 als het niet bestaat. */
    private function product(string $slug): array
    {
        return Catalog::product($slug) ?? abort(404);
    }
}
