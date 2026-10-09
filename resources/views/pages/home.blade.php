{{--
    Homepage. Elke sectie staat in een eigen bestand in resources/views/pages/home/,
    zodat je met twee mensen tegelijk aan verschillende secties kunt werken.
    De gegevens ($usps, $packages, ...) komen uit HomeController.
--}}
@extends('layouts.app')

@section('title', 'Camera- en alarmsystemen voor woning en bedrijf')

@section('content')
    @include('pages.home.hero')
    @include('pages.home.usps')
    @include('pages.home.diensten')
    @include('pages.home.pakketten')
    @include('pages.home.werkwijze')
    @include('pages.home.projecten')
    @include('pages.home.webshop')
    @include('pages.home.partners')
    @include('partials.cta')
@endsection
