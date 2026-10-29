{{--
    Pagina Projecten (ontwerp: Figma "Projecten"). De delen staan in resources/views/pages/projecten/.
    De gegevens komen uit ProjectController: $filters (diensten), $dienst (gekozen filter), $featured (uitgelicht) en $projects.
--}}
@extends('layouts.app')

@section('title', 'Projecten')
@section('description', 'Een greep uit de camera- en alarmsystemen die Full Force Systems heeft opgeleverd in Gelderland, Brabant en Limburg.')

@section('content')
    <x-page-header
        text="Een greep uit wat wij hebben opgeleverd. Wij tonen alleen projecten waarvoor de klant toestemming gaf."
        :crumbs="[['label' => 'Projecten']]"
    >
        Projecten
    </x-page-header>

    <section class="py-12 lg:py-16">
        <div class="wrap flex flex-col gap-8">
            @include('pages.projecten.filters')
            @include('pages.projecten.overzicht')
        </div>
    </section>

    @include('partials.cta', ['ctaFoto' => 'images/voorbeeld/kantoor.jpg'])
@endsection
