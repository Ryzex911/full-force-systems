{{--
    Label met de status van een bestelling of aanvraag, bijvoorbeeld "Verzonden".
    Gebruik: <x-status status="Verzonden" />   De kleuren staan in App\Support\ExampleAccount::STATUS_COLORS.
--}}
@use('App\Support\ExampleAccount')
@props(['status'])

<span {{ $attributes->merge(['class' => 'text-body-sm inline-flex rounded-full px-3 py-1 font-semibold whitespace-nowrap '.ExampleAccount::statusClasses($status)]) }}>{{ $status }}</span>
