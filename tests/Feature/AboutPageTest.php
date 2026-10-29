<?php

namespace Tests\Feature;

use Tests\TestCase;

class AboutPageTest extends TestCase
{
    public function test_about_page_shows_story_mission_strengths_and_all_partners(): void
    {
        $response = $this->get(route('over-ons'));

        $response->assertOk();
        $response->assertSeeInOrder([
            'Over Full Force Systems',
            'Ons verhaal',
            'Onze missie',
            'Waarom klanten voor ons kiezen',
            'In vier stappen geregeld',
            'Wij werken samen met',
        ]);
        $response->assertSee('Geen onnodig ingewikkelde systemen of overbodige kosten');

        foreach (config('site.partners') as $partner) {
            $response->assertSee($partner);
        }

        foreach (config('site.regions') as $regio) {
            $response->assertSee($regio);
        }
    }

    public function test_menu_marks_about_as_the_current_page(): void
    {
        $this->get(route('over-ons'))
            ->assertSee('href="'.route('over-ons').'"', false)
            ->assertSee('aria-current="page"', false);
    }
}
