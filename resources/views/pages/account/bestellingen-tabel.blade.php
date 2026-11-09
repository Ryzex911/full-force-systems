{{--
    Tabel met bestellingen ($orders). Gebruikt op het dashboard en op Mijn bestellingen.
    Op mobiel wordt elke bestelling een blokje onder elkaar (de kopregel verdwijnt).
--}}
<div class="relative overflow-hidden">
    <table class="text-body-sm w-full text-left">
        <thead class="hidden bg-surface-2 text-ink-2 md:table-header-group">
            <tr>
                <th scope="col" class="px-6 py-3.5 font-medium">Bestelling</th>
                <th scope="col" class="px-6 py-3.5 font-medium">Product</th>
                <th scope="col" class="px-6 py-3.5 font-medium">Datum</th>
                <th scope="col" class="px-6 py-3.5 font-medium">Bedrag</th>
                <th scope="col" class="px-6 py-3.5 font-medium">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-line border-t border-line">
            @foreach ($orders as $bestelling)
                <tr class="grid grid-cols-2 gap-x-4 gap-y-1 px-5 py-4 md:table-row md:p-0">
                    <td class="font-semibold text-ink md:px-6 md:py-4">{{ $bestelling['number'] }}</td>
                    <td class="col-span-2 row-start-2 text-ink-2 md:px-6 md:py-4">{{ $bestelling['product'] }}</td>
                    <td class="row-start-3 whitespace-nowrap text-ink-3 md:px-6 md:py-4 md:text-ink-2"><span class="md:hidden">Besteld op </span>{{ $bestelling['date'] }}</td>
                    <td class="row-start-3 text-right text-ink md:px-6 md:py-4 md:text-left">{{ $bestelling['amount'] }}</td>
                    <td class="col-start-2 row-start-1 text-right md:px-6 md:py-4 md:text-left"><x-status :status="$bestelling['status']" /></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
