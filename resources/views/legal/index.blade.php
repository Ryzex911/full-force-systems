@extends('layouts.legal')

@section('title', 'Juridische informatie')

@section('breadcrumb', 'Overzicht')

@section('hero-title', 'Juridische informatie')

@section('hero-description', 'Alle informatie over onze voorwaarden, privacy, verzending, garantie en dienstverlening op één centrale plek.')


@section('content')

    <div class="overview-page">

        {{-- INTRO --}}
        <div class="overview-header">

            <div class="eyebrow">
                <span></span>
                TRANSPARANTIE & VERTROUWEN
            </div>

            <h2>
                Duidelijke afspraken.
                <span>Geen verrassingen.</span>
            </h2>

            <p>
                Bij Full Force Systems vinden we het belangrijk
                dat je precies weet waar je aan toe bent.

                Daarom hebben we alle informatie over onze
                voorwaarden, privacy en dienstverlening
                overzichtelijk op één plek verzameld.
            </p>

        </div>


        {{-- STATISTICS --}}
        <div class="legal-stats">

            <div class="stat-item">

                <strong>07</strong>

                <span>
                Juridische documenten
            </span>

            </div>

            <div class="stat-item">

                <strong>01</strong>

                <span>
                Centraal overzicht
            </span>

            </div>

            <div class="stat-item">

                <strong>100%</strong>

                <span>
                Transparantie als doel
            </span>

            </div>

        </div>


        {{-- DOCUMENTS HEADING --}}
        <div class="documents-heading">

            <div>

                <div class="eyebrow">
                    <span></span>
                    DOCUMENTATIE
                </div>

                <h3>
                    Alle documenten
                </h3>

            </div>

            <span class="document-count">
            {{ count(config('legal.pages', [])) }} DOCUMENTEN
        </span>

        </div>


        {{-- DOCUMENT CARDS --}}
        <div class="documents-grid">

            @foreach(config('legal.pages', []) as $key => $page)

                <a href="{{ route('legal.' . $key) }}"
                   class="document-card">

                    <div class="document-card-top">

                    <span class="document-index">
                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                    </span>

                        <span class="document-card-arrow">
                        ↗
                    </span>

                    </div>


                    <div class="document-card-body">

                        <div class="card-icon">

                            @switch($key)

                                @case('privacy')
                                    ♢
                                    @break

                                @case('terms')
                                    §
                                    @break

                                @case('cookies')
                                    ◉
                                    @break

                                @case('returns')
                                    ↩
                                    @break

                                @case('shipping')
                                    ↗
                                    @break

                                @case('warranty')
                                    ✓
                                    @break

                                @case('complaints')
                                    !
                                    @break

                                @default
                                    ◈

                            @endswitch

                        </div>

                        <h4>
                            {{ $page['title'] }}
                        </h4>

                        <p>
                            {{ $page['subtitle'] }}
                        </p>

                    </div>


                    <div class="document-card-footer">

                    <span>
                        BEKIJK DOCUMENT
                    </span>

                        <span>
                        →
                    </span>

                    </div>

                </a>

            @endforeach

        </div>


        {{-- INFORMATION PANEL --}}
        <div class="information-panel">

            <div class="information-symbol">
                ✓
            </div>

            <div class="information-content">

                <div class="eyebrow">
                    <span></span>
                    ONZE BELOFTE
                </div>

                <h3>
                    Duidelijkheid staat voorop.
                </h3>

                <p>
                    We willen onze klanten duidelijk informeren
                    over hun rechten, verplichtingen en de
                    manier waarop wij met gegevens omgaan.

                    Heb je vragen over een document?
                    Neem dan contact met ons op.
                </p>

            </div>

        </div>

    </div>

@endsection
