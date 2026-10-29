<?php

namespace App\Http\Controllers;

use App\Support\Catalog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Toon de pagina Projecten, eventueel gefilterd op dienst: /projecten?dienst=camerabewaking
     *
     * De projecten zijn (deels) VOORBEELDDATA uit App\Support\Catalog::projects().
     * Het uitgelichte project staat groot bovenaan; de rest staat eronder in een raster.
     */
    public function __invoke(Request $request): View
    {
        // De filterknoppen: alle diensten waar een installatie bij hoort (dus zonder onderhoud)
        $filters = collect(config('site.services'))
            ->reject(fn (array $service) => $service['slug'] === 'onderhoud-service')
            ->pluck('title', 'slug');

        $dienst = $request->query('dienst');
        $dienst = is_string($dienst) && $filters->has($dienst) ? $dienst : null;

        $projects = collect(Catalog::projects())
            ->when($dienst, fn ($c) => $c->filter(fn (array $project) => in_array($dienst, $project['services'], true)))
            ->values();

        $featured = $projects->firstWhere('featured', true);

        return view('pages.projecten', [
            'filters' => $filters,
            'dienst' => $dienst,
            'featured' => $featured,
            'projects' => $projects->reject(fn (array $project) => $project === $featured)->values(),
        ]);
    }
}
