<?php

namespace App\Http\Controllers;

use App\Support\Catalog;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WebshopController extends Controller
{
    /** Aantal producten per pagina. */
    private const PER_PAGE = 9;

    /** De keuzes in "Sorteer". De eerste is de standaard. */
    public const SORT_OPTIONS = [
        'populair' => 'Sorteer: populair',
        'prijs-laag' => 'Sorteer: prijs laag – hoog',
        'prijs-hoog' => 'Sorteer: prijs hoog – laag',
        'naam' => 'Sorteer: naam A – Z',
    ];

    /**
     * Toon de webshop (ontwerp: docs/ontwerp/05-webshop.png).
     *
     * Filteren gebeurt met een gewoon GET-formulier, dus de filters staan in de url, bijvoorbeeld:
     *   /webshop?categorie=recorders&zoek=camera&prijs_van=50&prijs_tot=300&voorraad=1&sorteer=prijs-laag
     * We filteren de VOORBEELDDATA uit App\Support\Catalog met een Laravel-collection. Later doet de database dit.
     */
    public function index(Request $request): View
    {
        $categories = Catalog::categories();
        $filters = $this->filters($request, $categories);

        $products = $this->sort($this->filter(collect(Catalog::products()), $filters), $filters['sorteer']);

        $page = max(1, (int) $request->query('pagina', 1));
        $paginator = new LengthAwarePaginator(
            $products->forPage($page, self::PER_PAGE)->values(),
            $products->count(),
            self::PER_PAGE,
            $page,
            ['path' => route('webshop'), 'pageName' => 'pagina'],
        );
        $paginator->appends($this->query($filters));

        return view('pages.webshop', [
            'products' => $paginator,
            'categories' => $categories,
            'filters' => $filters,
            'query' => $this->query($filters),
            'sortOptions' => self::SORT_OPTIONS,
            'hasFilters' => $this->query($filters) !== [],
        ]);
    }

    /**
     * Lees de filters uit de url. Wat niet klopt (onbekende categorie, tekst als prijs) negeren we gewoon.
     *
     * @return array{categorie: ?string, zoek: ?string, prijs_van: ?float, prijs_tot: ?float, voorraad: bool, aanbieding: bool, sorteer: string}
     */
    private function filters(Request $request, array $categories): array
    {
        $categorie = $request->query('categorie');
        $sorteer = $request->query('sorteer');
        $zoek = trim((string) $request->query('zoek', ''));

        $prijsVan = $this->amount($request->query('prijs_van'));
        $prijsTot = $this->amount($request->query('prijs_tot'));

        // "Van" groter dan "Tot"? Dan draaien we ze om, zodat de bezoeker toch resultaat ziet.
        if ($prijsVan !== null && $prijsTot !== null && $prijsVan > $prijsTot) {
            [$prijsVan, $prijsTot] = [$prijsTot, $prijsVan];
        }

        return [
            'categorie' => is_string($categorie) && isset($categories[$categorie]) ? $categorie : null,
            'zoek' => $zoek !== '' ? Str::limit($zoek, 100, '') : null,
            'prijs_van' => $prijsVan,
            'prijs_tot' => $prijsTot,
            'voorraad' => $request->boolean('voorraad'),
            'aanbieding' => $request->boolean('aanbieding'),
            'sorteer' => is_string($sorteer) && isset(self::SORT_OPTIONS[$sorteer]) ? $sorteer : array_key_first(self::SORT_OPTIONS),
        ];
    }

    /** Een prijs uit de url als getal, of null als het geen geldig bedrag is. "12,50" mag ook. */
    private function amount(mixed $waarde): ?float
    {
        if (! is_string($waarde) || trim($waarde) === '') {
            return null;
        }

        $waarde = str_replace(',', '.', trim($waarde));

        return is_numeric($waarde) && (float) $waarde >= 0 ? (float) $waarde : null;
    }

    private function filter(Collection $products, array $filters): Collection
    {
        return $products
            ->when($filters['categorie'], fn (Collection $c, string $categorie) => $c->where('category_slug', $categorie))
            ->when($filters['zoek'], fn (Collection $c, string $zoek) => $c->filter(
                fn (array $product) => Str::contains($product['title'].' '.$product['category'], $zoek, ignoreCase: true)
            ))
            ->when($filters['prijs_van'] !== null, fn (Collection $c) => $c->where('amount', '>=', $filters['prijs_van']))
            ->when($filters['prijs_tot'] !== null, fn (Collection $c) => $c->where('amount', '<=', $filters['prijs_tot']))
            ->when($filters['voorraad'], fn (Collection $c) => $c->where('in_stock', true))
            ->when($filters['aanbieding'], fn (Collection $c) => $c->where('offer', true));
    }

    private function sort(Collection $products, string $sorteer): Collection
    {
        $gesorteerd = match ($sorteer) {
            'prijs-laag' => $products->sortBy('amount'),
            'prijs-hoog' => $products->sortByDesc('amount'),
            'naam' => $products->sortBy('title', SORT_NATURAL | SORT_FLAG_CASE),
            default => $products, // populair = de volgorde in Catalog
        };

        return $gesorteerd->values();
    }

    /**
     * De actieve filters als url-parameters, zonder lege waarden en zonder de standaard-sortering.
     * Gebruikt voor de links van de categorieën en de paginering, zodat de andere filters blijven staan.
     */
    private function query(array $filters): array
    {
        return array_filter([
            'categorie' => $filters['categorie'],
            'zoek' => $filters['zoek'],
            'prijs_van' => $filters['prijs_van'] !== null ? $this->number($filters['prijs_van']) : null,
            'prijs_tot' => $filters['prijs_tot'] !== null ? $this->number($filters['prijs_tot']) : null,
            'voorraad' => $filters['voorraad'] ? 1 : null,
            'aanbieding' => $filters['aanbieding'] ? 1 : null,
            'sorteer' => $filters['sorteer'] !== array_key_first(self::SORT_OPTIONS) ? $filters['sorteer'] : null,
        ], fn ($waarde) => $waarde !== null);
    }

    /** 50.0 → "50", 12.5 → "12.5" (voor in de url en in het invoerveld). */
    private function number(float $getal): string
    {
        return rtrim(rtrim(number_format($getal, 2, '.', ''), '0'), '.');
    }
}
