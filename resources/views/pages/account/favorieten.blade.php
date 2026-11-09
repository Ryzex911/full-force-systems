{{-- Favorieten: de producten met een hartje ($products uit de sessie, zie App\Support\Favorites) --}}
@extends('layouts.account')

@section('title', 'Favorieten')

@section('account')
    <div class="flex flex-col gap-1">
        <h2 class="text-h3 text-ink">Favorieten</h2>
        <p class="text-body-sm text-ink-2">Producten die u met het hartje heeft bewaard.</p>
    </div>

    @if ($products)
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($products as $product)
                <div class="flex flex-col gap-2">
                    <x-product-card
                        :slug="$product['slug']"
                        :icon="$product['icon']"
                        :category="$product['category']"
                        :title="$product['title']"
                        :price="$product['price']"
                        :image="$product['image']"
                        :in-stock="$product['in_stock']"
                        class="grow"
                    />
                    <form method="POST" action="{{ route('favorieten.toggle', $product['slug']) }}">
                        @csrf
                        <button type="submit" class="text-body-sm flex items-center gap-1.5 text-ink-3 hover:text-brand-ink">
                            <x-icon name="heart" class="size-4 fill-current" />
                            Verwijderen uit favorieten
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div class="card flex flex-col items-start gap-4 p-6">
            <span class="icon-tile"><x-icon name="heart" class="size-6" /></span>
            <p class="text-body text-ink-2">U heeft nog geen favorieten. Klik op een productpagina op het hartje om een product te bewaren.</p>
            <x-button :href="route('webshop')">Naar de webshop</x-button>
        </div>
    @endif
@endsection
