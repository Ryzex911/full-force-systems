{{--
    Gegevens wijzigen (/profile), binnen Mijn account.
    De formulieren komen van Laravel Breeze (ProfileController en Auth\PasswordController); de opmaak is in de huisstijl.
    Drie blokken: gegevens (#gegevens), wachtwoord (#wachtwoord) en account verwijderen (#verwijderen).
--}}
@extends('layouts.account')

@section('title', 'Gegevens')

@section('account')
    @include('profile.partials.update-profile-information-form')
    @include('profile.partials.update-password-form')
    @include('profile.partials.delete-user-form')
@endsection
