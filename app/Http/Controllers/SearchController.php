<?php

namespace App\Http\Controllers;

use App\Support\Catalog;
use App\Support\Nav;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Zoeken op de hele site: /zoeken?q=camera
 *
 * We zoeken in de producten, diensten, pakketten en projecten (VOORBEELDDATA uit Catalog en config/site.php).
 * Een resultaat telt mee als ALLE woorden van de zoekopdracht erin voorkomen, dus "camera buiten" vindt "4K IP-camera buiten".
 * Later, met de database, kan dit met een zoekopdracht in de database.
 */
class SearchController extends Controller
{
    public function __invoke(Request $request): View
    {
        $zoekterm = Str::limit(trim((string) $request->query('q', '')), 100, '');
        $woorden = $zoekterm === '' ? [] : preg_split('/\s+/', $zoekterm);

        $groepen = $woorden ? $this->search($woorden) : [];

        return view('pages.zoeken', [
            'q' => $zoekterm,
            'groups' => $groepen,
            'total' => array_sum(array_map(fn (array $groep) => count($groep['items']), $groepen)),
            'suggestions' => ['Camera', 'Alarm', 'Recorder', 'Intercom', 'Toegangscontrole', 'Onderhoud'],
        ]);
    }

    /**
     * Alle resultaten per soort. Soorten zonder resultaat laten we weg.
     *
     * @param  array<int, string>  $woorden
     * @return array<string, array{title: string, items: array<int, array<string, mixed>>}>
     */
    private function search(array $woorden): array
    {
        $past = fn (string $tekst) => collect($woorden)->every(fn (string $woord) => Str::contains($tekst, $woord, ignoreCase: true));

        $producten = collect(Catalog::products())
            ->filter(fn (array $p) => $past($p['title'].' '.$p['category'].' '.$p['text'].' '.implode(' ', $p['features'])))
            ->values()->all();

        $diensten = collect(config('site.services'))
            ->filter(fn (array $d) => $past($d['title'].' '.$d['text'].' '.implode(' ', $d['points'])))
            ->map(fn (array $d) => [
                'icon' => $d['icon'],
                'label' => 'Dienst',
                'title' => $d['title'],
                'text' => $d['text'],
                'url' => route('diensten.show', $d['slug']),
            ])->values()->all();

        $pakketten = collect(Catalog::packages())
            ->filter(fn (array $p) => $past('pakket '.$p['name'].' '.$p['text'].' '.implode(' ', $p['features'])))
            ->map(fn (array $p) => [
                'icon' => 'shield',
                'label' => 'Pakket · '.$p['price'],
                'title' => 'Pakket '.$p['name'],
                'text' => $p['text'].' '.implode(', ', $p['features']).'.',
                'url' => route('pakketten'),
            ])->values()->all();

        $projecten = collect(Catalog::projects())
            ->filter(fn (array $p) => $past($p['title'].' '.$p['tag'].' '.$p['location'].' '.$p['type'].' '.$p['text']))
            ->map(fn (array $p) => [
                'icon' => 'building',
                'label' => 'Project · '.$p['location'],
                'title' => $p['title'],
                'text' => $p['text'] ?? $p['tag'],
                'url' => Nav::page('projecten.show', ['slug' => $p['slug']]) ?? route('projecten'),
            ])->values()->all();

        return array_filter([
            'producten' => ['title' => 'Producten', 'items' => $producten],
            'diensten' => ['title' => 'Diensten', 'items' => $diensten],
            'pakketten' => ['title' => 'Pakketten', 'items' => $pakketten],
            'projecten' => ['title' => 'Projecten', 'items' => $projecten],
        ], fn (array $groep) => $groep['items'] !== []);
    }
}
