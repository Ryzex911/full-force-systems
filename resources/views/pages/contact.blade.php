{{--
    Pagina Contact en offerte. De secties staan in resources/views/pages/contact/.
    De gegevens ($services, $prefill) komen uit ContactController.
    Andere pagina's linken hierheen met Nav::quote(), eventueel met een vooraf ingevulde dienst, pakket of product.
--}}
@extends('layouts.app')

@section('title', 'Contact en offerte')
@section('description', 'Vraag vrijblijvend een offerte aan voor camerabewaking, alarm, toegangscontrole of video-intercom, of neem contact op met Full Force Systems in Nijmegen.')

@section('content')
    <x-page-header
        text="Vraag vrijblijvend een offerte aan of stel uw vraag. Wij nemen persoonlijk contact met u op."
        :crumbs="[['label' => 'Contact']]"
    >
        Contact en offerte
    </x-page-header>

    <section class="py-12 lg:py-20">
        <div class="wrap grid gap-8 lg:grid-cols-[1fr_380px] lg:items-start lg:gap-12">
            @include('pages.contact.formulier')
            @include('pages.contact.gegevens')
        </div>
    </section>
@endsection
