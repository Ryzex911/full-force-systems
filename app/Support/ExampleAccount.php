<?php

namespace App\Support;

use App\Models\User;

/**
 * VOORBEELDDATA voor Mijn account: bestellingen, aanvragen en adressen (ontwerp 11).
 *
 * Er is nog geen database voor bestellingen, offerteaanvragen en adressen. Deze gegevens laten zien hoe de pagina's
 * eruitzien. Op elke accountpagina staat een melding dat het voorbeelden zijn.
 * Later komen ze uit de database (tabellen orders, quotes en addresses, gekoppeld aan de gebruiker).
 */
class ExampleAccount
{
    /** Statussen met de kleur van het label: brand (rood), ok (groen) of muted (grijs). */
    public const STATUS_COLORS = [
        'Verzonden' => 'brand',
        'In behandeling' => 'muted',
        'Afgerond' => 'ok',
        'Aangevraagd' => 'muted',
        'Offerte verstuurd' => 'brand',
        'Geaccepteerd' => 'ok',
    ];

    /**
     * @return array<int, array{number: string, product: string, date: string, amount: string, status: string}>
     */
    public static function orders(): array
    {
        return [
            ['number' => '#FFS-1026', 'product' => '4K IP-camera buiten', 'date' => '02-10-2026', 'amount' => Catalog::euro(199), 'status' => 'Verzonden'],
            ['number' => '#FFS-1022', 'product' => 'Netwerkkabel CAT6 50 m', 'date' => '24-09-2026', 'amount' => Catalog::euro(39), 'status' => 'In behandeling'],
            ['number' => '#FFS-1015', 'product' => 'Codeklavier met taglezer', 'date' => '11-09-2026', 'amount' => Catalog::euro(159), 'status' => 'Afgerond'],
        ];
    }

    /**
     * @return array<int, array{title: string, service: string, date: string, status: string}>
     */
    public static function quotes(): array
    {
        return [
            ['title' => 'Offerte camerabewaking', 'service' => 'Camerabewaking', 'date' => '28-09-2026', 'status' => 'Offerte verstuurd'],
            ['title' => 'Offerte alarmsysteem', 'service' => 'Alarmsystemen', 'date' => '14-08-2026', 'status' => 'Geaccepteerd'],
        ];
    }

    /**
     * Het voorbeeldadres krijgt de naam (en bedrijfsnaam) van de ingelogde gebruiker.
     *
     * @return array<int, array{label: string, name: string, lines: array<int, string>, default: bool}>
     */
    public static function addresses(User $user): array
    {
        return [
            [
                'label' => 'Standaardadres',
                'name' => $user->company_name ?: $user->name,
                'lines' => ['Voorbeeldstraat 12', '6500 AB Nijmegen'],
                'default' => true,
            ],
        ];
    }

    /** Tailwind-classes voor het statuslabel. */
    public static function statusClasses(string $status): string
    {
        return match (self::STATUS_COLORS[$status] ?? 'muted') {
            'brand' => 'bg-brand-soft text-brand-ink',
            'ok' => 'bg-ok-soft text-ok',
            default => 'bg-surface-2 text-ink-2',
        };
    }
}
