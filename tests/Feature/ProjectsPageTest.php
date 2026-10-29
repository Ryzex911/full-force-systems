<?php

namespace Tests\Feature;

use App\Support\Catalog;
use Tests\TestCase;

class ProjectsPageTest extends TestCase
{
    public function test_projects_page_shows_featured_project_and_the_others(): void
    {
        $response = $this->get(route('projecten'));

        $response->assertOk();
        $response->assertSeeInOrder(['Projecten', 'Alle', 'Uitgelicht', 'Tax administraties', 'Winkelpand (voorbeeld)', 'Woonhuis (voorbeeld)', 'Uw project hier?']);
        $response->assertSee('Beuningen (GLD)');
        $response->assertSee('Twee projecten zijn voorbeelden');

        foreach (Catalog::projects() as $project) {
            $response->assertSee($project['image']);
        }
    }

    public function test_filter_shows_only_projects_for_that_service(): void
    {
        $this->get(route('projecten', ['dienst' => 'alarmsystemen']))
            ->assertSee('Tax administraties')
            ->assertSee('Woonhuis (voorbeeld)')
            ->assertDontSee('Winkelpand (voorbeeld)');
    }

    public function test_filter_without_projects_shows_a_message(): void
    {
        $this->get(route('projecten', ['dienst' => 'video-intercom']))
            ->assertOk()
            ->assertSee('Nog geen projecten voor deze dienst')
            ->assertSee('href="'.e(route('contact', ['dienst' => 'video-intercom'])).'#offerteformulier"', false);
    }

    public function test_unknown_filter_is_ignored(): void
    {
        $this->get(route('projecten', ['dienst' => 'bestaat-niet']))
            ->assertOk()
            ->assertSee('Winkelpand (voorbeeld)');
    }

    public function test_menu_and_homepage_link_to_the_projects_page(): void
    {
        $this->get(route('projecten'))
            ->assertSee('href="'.route('projecten').'"', false)
            ->assertSee('aria-current="page"', false);

        $this->get(route('home'))
            ->assertSee('Alle projecten')
            ->assertSee('href="'.route('projecten').'"', false);
    }
}
