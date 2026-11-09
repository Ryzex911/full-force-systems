{{--
    Productpagina, bijvoorbeeld /webshop/4k-ip-camera-buiten (ontwerp 06, productdetail).
    De secties staan in resources/views/pages/product/.
    De gegevens komen uit WebshopController@show: $product, $related (vaak samen gekocht) en $isFavorite.
--}}
@extends('layouts.app')

@section('title', $product['title'])
@section('description', $product['text'])

@section('content')
    @include('pages.product.kopen')
    @include('pages.product.info')
    @include('pages.product.installeren')
    @include('pages.product.samen')
@endsection
