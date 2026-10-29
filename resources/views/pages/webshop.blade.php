{{--
    Pagina Webshop (ontwerp: docs/ontwerp/05-webshop.png). De delen staan in resources/views/pages/webshop/.
    De gegevens komen uit WebshopController: $products (één pagina producten), $categories, $filters, $query, $sortOptions.

    Eén GET-formulier om de filters én de producten heen: zoeken, prijs, vinkjes en sorteren komen zo in de url.
    De categorieën zijn gewone links. Met JavaScript wordt het formulier meteen verstuurd bij een wijziging (app.js, data-auto-filter);
    zonder JavaScript gebruikt de bezoeker de knop "Filters toepassen".
--}}
@extends('layouts.app')

@section('title', 'Webshop')
@section('description', "Camera's, recorders, alarmsystemen, toegangscontrole, intercom en accessoires: de beveiligingsproducten die Full Force Systems zelf ook installeert.")

@section('content')
    <x-page-header
        text="Beveiligingsproducten die wij zelf ook installeren. Particulier of zakelijk: dezelfde producten en prijzen."
        :crumbs="[['label' => 'Webshop']]"
    >
        Webshop
    </x-page-header>

    <section class="py-10 lg:py-16">
        <form method="GET" action="{{ route('webshop') }}" class="wrap grid gap-8 lg:grid-cols-[264px_1fr] lg:gap-7" data-auto-filter role="search" aria-label="Producten zoeken en filteren">
            {{-- De gekozen categorie blijft bewaard als je zoekt of sorteert --}}
            @if ($filters['categorie'])
                <input type="hidden" name="categorie" value="{{ $filters['categorie'] }}">
            @endif

            @include('pages.webshop.filters')
            @include('pages.webshop.producten')
        </form>
    </section>
@endsection
