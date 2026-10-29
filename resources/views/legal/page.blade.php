@php
    $page = config('legal.pages.' . $pageKey, []);
    $company = config('legal.company', []);
    $sections = $page['sections'] ?? [];

    $allPages = config('legal.pages', []);

    $keys = array_keys($allPages);

    $currentIndex = array_search($pageKey, $keys, true);

    $previousKey = $currentIndex !== false && $currentIndex > 0
        ? $keys[$currentIndex - 1]
        : null;

    $nextKey = $currentIndex !== false && $currentIndex < count($keys) - 1
        ? $keys[$currentIndex + 1]
        : null;
@endphp

@extends('layouts.legal')

@section('title', $page['title'] ?? 'Juridische informatie')

@section('description', $page['subtitle'] ?? '')

@section('breadcrumb', $page['title'] ?? 'Document')

@section('hero-title', $page['title'] ?? 'Juridische informatie')

@section('hero-description', $page['subtitle'] ?? '')


@section('content')

    <article class="legal-document-page">

        {{-- DOCUMENT HEADER --}}
        <div class="legal-document-header">

            <div class="eyebrow">
                <span></span>
                FULL FORCE SYSTEMS / JURIDISCH
            </div>

            <div class="document-title-row">

                <div>

                <span class="document-category">
                    JURIDISCHE INFORMATIE
                </span>

                    <h2>
                        {{ $page['title'] ?? 'Document' }}
                    </h2>

                </div>

                <div class="document-badge">
                    FFS
                </div>

            </div>


            <div class="document-metadata">

                <div>

                    <span>LAATST BIJGEWERKT</span>

                    <strong>
                        {{ config('legal.updated_at', 'Nog niet vastgesteld') }}
                    </strong>

                </div>

                <div>

                    <span>ORGANISATIE</span>

                    <strong>
                        Full Force Systems
                    </strong>

                </div>

                <div>

                    <span>ONDERDELEN</span>

                    <strong>
                        {{ count($sections) }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- INTRO --}}
        <div class="document-introduction">

            <div class="intro-accent"></div>

            <p>
                {{ $page['intro'] ?? '' }}
            </p>

        </div>


        {{-- TABLE OF CONTENTS --}}
        @if(count($sections) > 0)

            <nav class="document-toc"
                 aria-label="Inhoudsopgave">

                <div class="toc-header">

                    <h3>
                        Inhoudsopgave
                    </h3>

                    <span>
                    {{ count($sections) }} ONDERDELEN
                </span>

                </div>

                <div class="toc-grid">

                    @foreach($sections as $section)

                        <a href="#onderdeel-{{ $loop->iteration }}">

                        <span class="toc-number">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>

                            <span>
                            {{ preg_replace('/^\d+\.\s*/', '', $section['title']) }}
                        </span>

                            <span class="toc-arrow">
                            ↗
                        </span>

                        </a>

                    @endforeach

                </div>

            </nav>

        @endif


        {{-- DOCUMENT CONTENT --}}
        <div class="document-sections">

            @foreach($sections as $section)

                <section
                    class="legal-section"
                    id="onderdeel-{{ $loop->iteration }}"
                >

                    <div class="section-heading">

                    <span class="section-number">
                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                    </span>

                        <h3>
                            {{ preg_replace('/^\d+\.\s*/', '', $section['title']) }}
                        </h3>

                    </div>


                    <div class="section-body">

                        @foreach($section['paragraphs'] ?? [] as $paragraph)

                            <p>
                                {{ $paragraph }}
                            </p>

                        @endforeach


                        @if(!empty($section['bullets']))

                            <ul class="legal-list">

                                @foreach($section['bullets'] as $bullet)

                                    <li>
                                        {{ $bullet }}
                                    </li>

                                @endforeach

                            </ul>

                        @endif

                    </div>

                </section>

            @endforeach

        </div>


        {{-- COMPANY INFORMATION --}}
        <div class="company-information">

            <div class="eyebrow">
                <span></span>
                BEDRIJFSGEGEVENS
            </div>

            <h3>
                Informatie over de organisatie
            </h3>

            <p class="company-description">
                Hieronder staan de bedrijfsgegevens
                die bij deze juridische informatie horen.
            </p>


            <div class="company-grid">

                <div class="company-field">

                    <span>Handelsnaam</span>

                    <strong>
                        {{ $company['name'] ?? 'Full Force Systems' }}
                    </strong>

                </div>

                <div class="company-field">

                    <span>Juridische bedrijfsnaam</span>

                    <strong>
                        {{ $company['legal_name'] ?? 'Nog aan te leveren' }}
                    </strong>

                </div>

                <div class="company-field">

                    <span>E-mailadres</span>

                    <strong>
                        {{ $company['email'] ?? 'Nog aan te leveren' }}
                    </strong>

                </div>

                <div class="company-field">

                    <span>Telefoonnummer</span>

                    <strong>
                        {{ $company['phone'] ?? 'Nog aan te leveren' }}
                    </strong>

                </div>

                <div class="company-field">

                    <span>Vestigingsadres</span>

                    <strong>
                        {{ $company['address'] ?? 'Nog aan te leveren' }}
                    </strong>

                </div>

                <div class="company-field">

                    <span>Postcode en plaats</span>

                    <strong>
                        {{ $company['postal_code'] ?? '—' }}
                        {{ $company['city'] ?? '' }}
                    </strong>

                </div>

                <div class="company-field">

                    <span>KvK-nummer</span>

                    <strong>
                        {{ $company['kvk'] ?? 'Nog aan te leveren' }}
                    </strong>

                </div>

                <div class="company-field">

                    <span>Btw-identificatienummer</span>

                    <strong>
                        {{ $company['vat'] ?? 'Nog aan te leveren' }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- DOCUMENT NAVIGATION --}}
        <div class="document-navigation">

            <a href="{{ route('legal.index') }}"
               class="all-documents-link">

                ← Alle documenten

            </a>


            <div class="next-previous">

                @if($previousKey)

                    <a href="{{ route('legal.' . $previousKey) }}"
                       class="document-nav-link">

                        ← Vorige

                    </a>

                @endif


                @if($nextKey)

                    <a href="{{ route('legal.' . $nextKey) }}"
                       class="document-nav-link next">

                        Volgende document →

                    </a>

                @endif

            </div>

        </div>

    </article>

@endsection
