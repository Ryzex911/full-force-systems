{{-- Foutpagina "sessie verlopen": een formulier stond te lang open. Uw invoer is helaas niet verstuurd. --}}
@extends('layouts.app')

@section('title', 'Sessie verlopen')

@section('content')
    @include('errors.melding', [
        'code' => 419,
        'kop' => 'De pagina stond te lang open',
        'tekst' => 'Om veiligheidsredenen is het formulier verlopen en is uw bericht niet verstuurd. Ga terug, ververs de pagina en verstuur het opnieuw.',
        'terug' => url()->previous(),
    ])
@endsection
