{{--
    Pagina Over ons. De secties staan in resources/views/pages/over-ons/.
    De teksten ($history, $mission, $strengths, $partners) komen uit AboutController en het wensenformulier.
    Bewust zonder medewerkers en klantreviews: dat wil de opdrachtgever niet op de site.
--}}
@extends('layouts.app')

@section('title', 'Over ons')
@section('description', 'Full Force Systems is het technische onderdeel van Full Force Security: camera-, alarm- en toegangscontrolesystemen met persoonlijk advies in Gelderland, Brabant en Limburg.')

@section('content')
    <x-page-header
        text="Fysieke beveiliging en beveiligingstechniek uit één hand: van advies en installatie tot beheer en ondersteuning."
        :crumbs="[['label' => 'Over ons']]"
    >
        Over Full Force Systems
    </x-page-header>

    @include('pages.over-ons.verhaal')
    @include('pages.over-ons.sterke-punten')
    @include('partials.werkwijze')
    @include('partials.partners', ['partners' => $partners])
    @include('partials.cta')
@endsection
