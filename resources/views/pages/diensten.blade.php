{{--
    Pagina Diensten. De secties staan in resources/views/pages/diensten/.
    De gegevens ($services, $audiences) komen uit ServiceController.
--}}
@extends('layouts.app')

@section('title', 'Diensten')
@section('description', 'Camerabewaking, alarmsystemen, toegangscontrole, video-intercom en onderhoud. Advies, installatie en service door Full Force Systems.')

@section('content')
    <x-page-header
        text="Van één camera tot een compleet systeem. Wij adviseren, installeren en onderhouden — met één aanspreekpunt."
        :crumbs="[['label' => 'Diensten']]"
    >
        Beveiligings&shy;techniek voor woning en bedrijf
    </x-page-header>

    @include('pages.diensten.lijst')
    @include('pages.diensten.voor-wie')
    @include('partials.werkwijze')
    @include('partials.cta')
@endsection
