{{-- Foutpagina "te veel verzoeken": het offerteformulier is vaker dan 5 keer per minuut verstuurd (zie routes/web.php). --}}
@extends('layouts.app')

@section('title', 'Even geduld')

@section('content')
    @include('errors.melding', [
        'code' => 429,
        'kop' => 'Even geduld, alstublieft',
        'tekst' => 'Er zijn in korte tijd te veel berichten verstuurd. Wacht een minuut en probeer het daarna opnieuw.',
        'terug' => url()->previous(),
    ])
@endsection
