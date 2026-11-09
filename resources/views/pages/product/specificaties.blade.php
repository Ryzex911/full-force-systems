{{-- Tabel met specificaties ($product['specs']: naam => waarde). Gebruikt in de tabs Beschrijving en Specificaties. --}}
<dl class="overflow-hidden rounded-xl border border-line bg-surface">
    @foreach ($product['specs'] as $naam => $waarde)
        <div class="text-body-sm flex justify-between gap-6 px-5 py-3.5 {{ $loop->first ? '' : 'border-t border-line' }}">
            <dt class="text-ink-3">{{ $naam }}</dt>
            <dd class="text-right text-ink">{{ $waarde }}</dd>
        </div>
    @endforeach
</dl>
