{{--
    Vergelijkingstabel ($comparison en $packages uit PackageController).
    Waarde true = vinkje, false = streepje, tekst = die tekst (zie App\Support\Catalog::comparison()).
    Op mobiel scrollt alleen de tabel opzij (overflow-x-auto), niet de hele pagina.
--}}
<section class="pt-4 pb-16 lg:pb-24">
    <div class="wrap flex flex-col gap-10">
        <x-section-heading label="Vergelijken" title="Wat zit er in elk pakket?" />

        {{-- relative: zo blijven de onzichtbare voorleesteksten (sr-only) binnen dit scrollblok en wordt de pagina niet breder --}}
        <div class="card relative overflow-x-auto">
            <table class="w-full min-w-[560px] border-collapse text-left">
                <caption class="sr-only">Vergelijking van de pakketten {{ implode(', ', array_column($packages, 'name')) }}</caption>
                <thead class="bg-surface-2">
                    <tr>
                        <th scope="col" class="text-body-sm px-5 py-4 font-semibold text-ink">Onderdeel</th>
                        @foreach ($packages as $pakket)
                            <th scope="col" class="text-body-sm w-[18%] px-5 py-4 text-center font-semibold text-ink">{{ $pakket['name'] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comparison as $rij)
                        <tr class="border-t border-line">
                            <th scope="row" class="text-body-sm px-5 py-4 font-normal text-ink">{{ $rij['label'] }}</th>
                            @foreach ($rij['values'] as $waarde)
                                <td class="text-body-sm px-5 py-4 text-center">
                                    @if ($waarde === true)
                                        <x-icon name="check" class="mx-auto size-5 text-brand-ink" />
                                        <span class="sr-only">Ja</span>
                                    @elseif ($waarde === false)
                                        <span class="text-ink-3" aria-hidden="true">–</span>
                                        <span class="sr-only">Nee</span>
                                    @else
                                        <span class="{{ is_numeric($waarde) ? 'text-ink' : 'text-ink-3' }}">{{ $waarde }}</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
