<?php

namespace Tests\Feature;

use App\Support\Catalog;
use Tests\TestCase;

class ProjectDetailPageTest extends TestCase
{
    public function test_every_project_has_a_working_page(): void
    {
        foreach (Catalog::projects() as $project) {
            $this->get(route('projecten.show', $project['slug']))
                ->assertOk()
                ->assertSee($project['title'])
                ->assertSee('Geleverde diensten');
        }
    }

    public function test_real_project_shows_its_services_and_other_projects(): void
    {
        $this->get(route('projecten.show', 'tax-administraties'))
            ->assertSee('Beuningen (GLD)')
            ->assertSee('href="'.route('diensten.show', 'camerabewaking').'"', false)
            ->assertSee('href="'.route('diensten.show', 'alarmsystemen').'"', false)
            ->assertSee('Ander werk van ons')
            ->assertSee('href="'.route('projecten.show', 'winkelpand').'"', false);
    }

    public function test_projects_page_links_to_the_project_pages(): void
    {
        $this->get(route('projecten'))
            ->assertSee('Bekijk project')
            ->assertSee('href="'.route('projecten.show', 'tax-administraties').'"', false)
            ->assertSee('href="'.route('projecten.show', 'woonhuis').'"', false);
    }

    public function test_unknown_project_gives_a_404_page(): void
    {
        $this->get(route('projecten.show', 'bestaat-niet'))->assertNotFound();
    }
}
