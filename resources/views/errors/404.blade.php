{{-- Foutpagina "niet gevonden". Laravel toont deze pagina vanzelf bij een onbekend adres. --}}
@extends('layouts.app')

@section('title', 'Pagina niet gevonden')

@section('content')
    @include('errors.melding', [
        'code' => 404,
        'kop' => 'Deze pagina bestaat niet (meer)',
        'tekst' => 'Misschien is het adres verkeerd getypt of is de pagina verplaatst. Kies hieronder waar u heen wilt, of neem contact met ons op.',
    ])
@endsection
