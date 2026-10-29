{{--
    Pagina Pakketten (ontwerp: docs/ontwerp/04-pakketten.png). De secties staan in resources/views/pages/pakketten/.
    De gegevens ($packages, $comparison) komen uit PackageController en zijn nog voorbeelddata.
--}}
@extends('layouts.app')

@section('title', 'Pakketten')
@section('description', 'Kant-en-klare beveiligingspakketten voor uw woning, met vaste prijs inclusief installatie en uitleg. Camera, alarm en video-intercom.')

@section('content')
    <x-page-header
        text="Vaste prijs, inclusief installatie en uitleg. Liever iets anders? Wij passen elk pakket aan."
        :crumbs="[['label' => 'Pakketten']]"
    >
        Kies het pakket dat bij uw woning past
    </x-page-header>

    @include('pages.pakketten.kaarten')
    @include('pages.pakketten.vergelijken')

    @include('partials.cta', [
        'ctaTitel' => 'Zakelijk? Wij maken een voorstel op maat',
        'ctaTekst' => 'Elk pand is anders. Na een bezoek op locatie ontvangt u een voorstel met een heldere vanaf-prijs.',
        'ctaFoto' => 'images/voorbeeld/kantoor.jpg',
        'ctaOfferte' => ['klant' => 'zakelijk'],
    ])

    @include('partials.werkwijze')
@endsection
