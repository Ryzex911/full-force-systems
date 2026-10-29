<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Controleert alle links op alle pagina's, zoals een bezoeker ze zou aanklikken:
 *  - geen dode links (href="#" of leeg);
 *  - elke interne link geeft een werkende pagina (status 200);
 *  - een link met #anker springt naar een blok dat echt op die pagina staat (id="anker").
 *
 * Nieuwe pagina gemaakt? Zet de routenaam in $pages hieronder.
 */
class LinksTest extends TestCase
{
    /** @var array<int, string> routenamen van alle pagina's die een bezoeker kan openen */
    private array $pages = ['home', 'diensten', 'pakketten', 'over-ons', 'contact'];

    /** @var array<string, string> eerder opgehaalde pagina's (url → html), zodat we elke pagina maar één keer laden */
    private array $cache = [];

    public function test_every_link_on_every_page_works(): void
    {
        foreach ($this->pages as $page) {
            $url = route($page);

            foreach ($this->links($this->html($url)) as $href) {
                $this->assertNotSame('', trim($href), "Lege link op {$url}");
                $this->assertNotSame('#', $href, "Dode link (#) op {$url}");

                if (str_starts_with($href, 'tel:') || str_starts_with($href, 'mailto:')) {
                    continue;
                }

                $this->assertLinkWorks($href, $url);
            }
        }
    }

    public function test_unknown_page_shows_the_404_page(): void
    {
        $response = $this->get('/deze-pagina-bestaat-niet');

        $response->assertNotFound();
        $response->assertSee('Deze pagina bestaat niet (meer)');
        $response->assertSee('href="'.route('contact').'"', false);
    }

    /** Volg één link: de pagina moet bestaan en het #anker moet op die pagina staan. */
    private function assertLinkWorks(string $href, string $from): void
    {
        $doel = str_starts_with($href, '#') ? $from.$href : $href;
        $this->assertStringStartsWith(url('/'), $doel, "Link naar een andere website op {$from}: {$href}");

        [$adres, $anker] = array_pad(explode('#', $doel, 2), 2, null);
        $html = $this->html($adres);

        if ($anker) {
            $this->assertStringContainsString('id="'.$anker.'"', $html, "Anker #{$anker} bestaat niet op {$adres} (link op {$from})");
        }
    }

    private function html(string $url): string
    {
        if (! isset($this->cache[$url])) {
            $response = $this->get($url);
            $response->assertOk();
            $this->cache[$url] = $response->getContent();
        }

        return $this->cache[$url];
    }

    /** @return array<int, string> alle href's van <a>-elementen */
    private function links(string $html): array
    {
        preg_match_all('/<a\b[^>]*\bhref="([^"]*)"/', $html, $matches);

        return array_unique(array_map('html_entity_decode', $matches[1]));
    }
}
