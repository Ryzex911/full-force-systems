<?php

namespace App\Http\Controllers;

use App\Support\Catalog;
use Illuminate\View\View;

class PackageController extends Controller
{
    /**
     * Toon de pagina Pakketten (ontwerp: docs/ontwerp/04-pakketten.png).
     * De pakketten en de vergelijkingstabel zijn VOORBEELDDATA uit App\Support\Catalog.
     */
    public function __invoke(): View
    {
        return view('pages.pakketten', [
            'packages' => Catalog::packages(),
            'comparison' => Catalog::comparison(),
        ]);
    }
}
