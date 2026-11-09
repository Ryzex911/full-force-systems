{{--
    Kruimelpad: Home / Webshop / Camera's / 4K IP-camera buiten
    "Home" staat altijd vooraan. Een kruimel met 'url' is een link; de laatste is de huidige pagina.
    Gebruik: <x-breadcrumbs :crumbs="[['label' => 'Webshop', 'url' => route('webshop')], ['label' => 'Product']]" />
    x-page-header gebruikt dit component ook.
--}}
@props(['crumbs' => []])

<nav aria-label="Kruimelpad" {{ $attributes }}>
    <ol class="text-body-sm flex flex-wrap items-center gap-2 text-ink-3">
        <li>
            <a href="{{ route('home') }}" class="hover:text-ink">Home</a>
        </li>
        @foreach ($crumbs as $crumb)
            <li aria-hidden="true">/</li>
            <li>
                @if (! empty($crumb['url']))
                    <a href="{{ $crumb['url'] }}" class="hover:text-ink">{{ $crumb['label'] }}</a>
                @else
                    <span class="text-ink-2" aria-current="page">{{ $crumb['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
