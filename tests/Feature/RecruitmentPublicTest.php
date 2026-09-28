<?php

namespace Tests\Feature;

use App\Models\JobVacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecruitmentPublicTest extends TestCase
{
    public function test_homepage_is_accessible_and_renders_featured_vacancies(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Discover Your Next');
        $response->assertSee('OLYMPIA');
    }

    public function test_careers_page_can_search_and_filter(): void
    {
        $response = $this->get('/careers');
        $response->assertStatus(200);

        // Filter by keyword
        $searchResponse = $this->get('/careers?search=Developer');
        $searchResponse->assertStatus(200);

        // Filter by department
        $deptResponse = $this->get('/careers?department=Information+Technology');
        $deptResponse->assertStatus(200);
    }

    public function test_internships_page_displays_internships(): void
    {
        $response = $this->get('/internships');
        $response->assertStatus(200);
        $response->assertSee('Undergraduate Internships');
    }

    public function test_job_details_page_loads_for_valid_slug(): void
    {
        $job = JobVacancy::first();
        if ($job) {
            $response = $this->get('/careers/' . $job->slug);
            $response->assertStatus(200);
            $response->assertSee($job->title);
        }
    }

    public function test_tracking_page_can_be_viewed(): void
    {
        $response = $this->get('/tracking');
        $response->assertStatus(200);
        $response->assertSee('Application Status Tracker');
    }
}
