{{--
    Icoon uit het Figma-ontwerp.
    Gebruik: <x-icon name="camera" class="size-6" />
    De kleur volgt de tekstkleur (text-...), de grootte geef je mee met size-...
--}}
@props(['name'])

@php
    $icons = [
        'camera' => '<rect x="2" y="7" width="13" height="10" rx="2"/><path d="M15 10.5l6-3v9l-6-3"/>',
        'alarm' => '<path d="M6 16v-5a6 6 0 0 1 12 0v5l2 2H4l2-2z"/><path d="M10 21h4"/>',
        'lock' => '<rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/>',
        'intercom' => '<rect x="6" y="3" width="12" height="18" rx="2"/><circle cx="12" cy="9" r="2.5"/><path d="M10 16h4"/>',
        'wrench' => '<path d="M20 7.2a4.5 4.5 0 0 1-6.1 4.1L6.2 19 4 16.8l7.7-7.7A4.5 4.5 0 0 1 16.8 4l-2.6 2.6 2.2 2.2L19 6.2c.6.3 1 .6 1 1z"/>',
        'shield' => '<path d="M12 3l8 3v6c0 4.5-3.2 7.8-8 9-4.8-1.2-8-4.5-8-9V6l8-3z"/><path d="M9 12l2 2 4-4"/>',
        'check' => '<path d="M5 12.5l4.5 4.5L19 7.5"/>',
        'arrow' => '<path d="M5 12h14"/><path d="M13 6l6 6-6 6"/>',
        'cart' => '<path d="M3 4h2.5l2.2 10.5h10.3l2-7.5H7"/><circle cx="9.5" cy="19" r="1.5"/><circle cx="17" cy="19" r="1.5"/>',
        'user' => '<circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"/>',
        'users' => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c0-3.5 2.9-6 6.5-6s6.5 2.500 6.500 6"/><path d="M16 4.800a3.500 3.500 0 0 1 0 6.400"/><path d="M18 14.500c2.100.800 3.500 2.800 3.500 5.500"/>',
        'search' => '<circle cx="11" cy="11" r="6.5"/><path d="M16 16l4.500 4.500"/>',
        'pin' => '<path d="M12 21s7-6.200 7-11.500a7 7 0 0 0-14 0C5 14.800 12 21 12 21z"/><circle cx="12" cy="9.500" r="2.500"/>',
        'phone' => '<path d="M6 3h3l2 5-2.500 1.500a11 11 0 0 0 6 6L16 13l5 2v3a2 2 0 0 1-2 2A16 16 0 0 1 4 5a2 2 0 0 1 2-2z"/>',
        'mail' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>',
        'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'recorder' => '<rect x="3" y="7" width="18" height="10" rx="2"/><path d="M7 12h.01"/><path d="M11 12h6"/>',
        'cable' => '<path d="M9 3v5"/><path d="M15 3v5"/><path d="M6 8h12v3a6 6 0 0 1-12 0V8z"/><path d="M12 17v4"/>',
        'heart' => '<path d="M12 20s-7-4.400-7-10a4 4 0 0 1 7-2.500A4 4 0 0 1 19 10c0 5.600-7 10-7 10z"/>',
        'home' => '<path d="M4 11l8-7 8 7v9H4z"/><path d="M10 20v-6h4v6"/>',
        'building' => '<rect x="5" y="3" width="14" height="18" rx="1"/><path d="M9 8h2"/><path d="M13 8h2"/><path d="M9 12h2"/><path d="M13 12h2"/><path d="M10 21v-4h4v4"/>',
        'menu' => '<path d="M4 7h16"/><path d="M4 12h16"/><path d="M4 17h16"/>',
        'close' => '<path d="M6 6l12 12"/><path d="M18 6L6 18"/>',
        'sun' => '<circle cx="12" cy="12" r="4"/><path d="M12 3v2"/><path d="M12 19v2"/><path d="M3 12h2"/><path d="M19 12h2"/><path d="M5.600 5.600l1.400 1.400"/><path d="M17 17l1.400 1.400"/><path d="M5.600 18.400L7 17"/><path d="M17 7l1.400-1.400"/>',
        'moon' => '<path d="M20 14.500A8 8 0 0 1 9.500 4a8 8 0 1 0 10.500 10.500z"/>',
    ];
@endphp

<svg {{ $attributes->merge(['class' => 'shrink-0']) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $icons[$name] ?? '' !!}</svg>
