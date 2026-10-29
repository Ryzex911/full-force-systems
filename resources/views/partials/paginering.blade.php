{{--
    Paginering in de huisstijl: genummerde knoppen, de huidige pagina rood.
    Gebruik: @include('partials.paginering', ['paginator' => $products])  (een LengthAwarePaginator)
    Bij maar één pagina wordt er niets getoond.
--}}
@if ($paginator->hasPages())
    <nav aria-label="Paginering" class="flex justify-center pt-2">
        <ul class="flex flex-wrap items-center gap-2">
            @foreach (range(1, $paginator->lastPage()) as $pagina)
                <li>
                    @if ($pagina === $paginator->currentPage())
                        <span class="text-body-sm relative flex size-9 items-center justify-center rounded-md bg-brand font-semibold text-white" aria-current="page">
                            <span class="sr-only">Pagina</span> {{ $pagina }}
                        </span>
                    @else
                        <a href="{{ $paginator->url($pagina) }}" class="text-body-sm relative flex size-9 items-center justify-center rounded-md border border-line text-ink hover:border-ink-3">
                            <span class="sr-only">Pagina</span> {{ $pagina }}
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
@endif
