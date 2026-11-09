{{--
    Bovenste deel: kruimelpad, foto links, rechts categorie, naam, prijs, voorraad, aantal en "In winkelwagen".
--}}
@use('App\Support\Nav')

<section class="pt-8 pb-16 lg:pt-10 lg:pb-24">
    <div class="wrap flex flex-col gap-8">
        <x-breadcrumbs :crumbs="[
            ['label' => 'Webshop', 'url' => route('webshop')],
            ['label' => $product['category'], 'url' => route('webshop', ['categorie' => $product['category_slug']])],
            ['label' => $product['title']],
        ]" />

        <div class="grid gap-10 lg:grid-cols-2 lg:gap-14">
            {{-- Foto (of het icoon van de categorie als er nog geen foto is) --}}
            <div class="relative flex aspect-[4/3] items-center justify-center overflow-hidden rounded-2xl border border-line bg-surface-2 text-ink-3">
                @if ($product['image'])
                    <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" class="absolute inset-0 size-full object-cover">
                @else
                    <x-icon :name="$product['icon']" class="size-28" />
                @endif
            </div>

            <div class="flex min-w-0 flex-col gap-5">
                <a href="{{ route('webshop', ['categorie' => $product['category_slug']]) }}" class="text-label w-fit text-ink-3 hover:text-ink">{{ $product['category'] }}</a>

                <h1 class="text-h1 text-ink">{{ $product['title'] }}</h1>

                <div class="flex flex-wrap items-center gap-4">
                    <p class="text-[34px] leading-10 font-extrabold tracking-[-0.01em] text-ink">{{ $product['price'] }}</p>
                    @if ($product['in_stock'])
                        <p class="text-body-sm flex items-center gap-1.5 rounded-full bg-ok-soft px-3 py-1 font-semibold text-ok">
                            <span class="size-2 rounded-full bg-ok"></span>
                            Op voorraad
                        </p>
                    @else
                        <p class="text-body-sm flex items-center gap-1.5 rounded-full bg-surface-2 px-3 py-1 font-semibold text-ink-3">
                            <span class="size-2 rounded-full bg-ink-3"></span>
                            Niet op voorraad
                        </p>
                    @endif
                </div>

                <p class="text-body text-ink-2">{{ $product['text'] }}</p>

                <div class="flex flex-wrap items-stretch gap-3 border-t border-line pt-5">
                    @if ($product['in_stock'])
                        {{-- Aantal + "In winkelwagen" (sessie, zie CartController) --}}
                        <form method="POST" action="{{ route('winkelwagen.store') }}" class="flex grow flex-wrap gap-3">
                            @csrf
                            <input type="hidden" name="product" value="{{ $product['slug'] }}">
                            <x-quantity id="product-aantal" :value="old('aantal', 1)" />
                            <x-button type="submit" class="grow">
                                <x-icon name="cart" class="size-5" />
                                In winkelwagen
                            </x-button>
                        </form>
                    @else
                        <x-button :href="Nav::quote(['product' => $product['title']])" class="grow">Product aanvragen</x-button>
                    @endif

                    {{-- Hartje: favoriet aan of uit (sessie, zie FavoriteController) --}}
                    <form method="POST" action="{{ route('favorieten.toggle', $product['slug']) }}">
                        @csrf
                        <button
                            type="submit"
                            class="flex size-12 items-center justify-center rounded-lg border {{ $isFavorite ? 'border-brand-ink text-brand-ink' : 'border-line text-ink hover:border-ink-3' }}"
                            aria-pressed="{{ $isFavorite ? 'true' : 'false' }}"
                            aria-label="{{ $isFavorite ? 'Verwijderen uit favorieten' : 'Toevoegen aan favorieten' }}"
                            title="{{ $isFavorite ? 'Verwijderen uit favorieten' : 'Toevoegen aan favorieten' }}"
                        >
                            <x-icon name="heart" class="size-5 {{ $isFavorite ? 'fill-current' : '' }}" />
                        </button>
                    </form>
                </div>

                @error('aantal')
                    <p class="text-body-sm flex items-start gap-1.5 text-brand-ink">
                        <x-icon name="alert" class="mt-0.5 size-4" />
                        {{ $message }}
                    </p>
                @enderror

                <ul class="text-body-sm flex flex-col gap-3 rounded-xl border border-line bg-surface p-5 text-ink">
                    <li class="flex items-center gap-3">
                        <x-icon name="shield" class="size-5 text-brand-ink" />
                        Dezelfde producten die wij zelf installeren
                    </li>
                    <li class="flex items-center gap-3">
                        <x-icon name="file" class="size-5 text-brand-ink" />
                        Betalen met iDEAL of bankoverschrijving
                    </li>
                    <li class="flex items-center gap-3">
                        <x-icon name="wrench" class="size-5 text-brand-ink" />
                        <span>Laten installeren? <a href="{{ Nav::quote(['product' => $product['title']]) }}" class="text-brand-ink hover:underline">Vraag een offerte aan</a></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
