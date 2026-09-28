<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HrAdminWorkflowTest extends TestCase
{
    public function test_unauthenticated_user_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_unauthenticated_user_cannot_download_private_cv(): void
    {
        $application = Application::first();
        if ($application) {
            $response = $this->get('/admin/applicants/' . $application->id . '/cv');
            $response->assertRedirect('/admin/login');
        }
    }

    public function test_hr_admin_can_login_and_access_dashboard(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@olympia.edu.my'],
            [
                'name' => 'HR Director',
                'password' => Hash::make('OlympiaAdmin2026!'),
                'role' => 'hr_admin',
                'department' => 'HR',
            ]
        );

        $loginResponse = $this->post('/admin/login', [
            'email' => 'admin@olympia.edu.my',
            'password' => 'OlympiaAdmin2026!',
        ]);

        $loginResponse->assertRedirect('/admin');
        $this->assertAuthenticatedAs($admin);

        $dashResponse = $this->actingAs($admin)->get('/admin');
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('Talent Acquisition Dashboard');
    }

    public function test_hr_admin_can_create_vacancy(): void
    {
        $admin = User::where('role', 'hr_admin')->first();

        $payload = [
            'title' => 'Assistant Registrar ' . rand(100, 999),
            'department' => 'Corporate Administration',
            'employment_type' => 'Full-Time',
            'location' => 'Petaling Jaya, Selangor',
            'summary' => 'Oversees student academic registry records and certifications.',
            'description' => 'Full detailed description of registrar role.',
            'responsibilities' => '• Maintain academic records&#10;• Coordinate convocation',
            'qualifications' => '• Degree in Administration or relevant field',
            'status' => 'published',
            'is_featured' => '1',
        ];

        $response = $this->actingAs($admin)->post('/admin/vacancies', $payload);
        $response->assertRedirect('/admin/vacancies');

        $this->assertDatabaseHas('job_vacancies', [
            'title' => $payload['title'],
            'department' => $payload['department'],
            'status' => 'published',
        ]);
    }

    public function test_hr_admin_can_update_application_status_and_audit_history_is_recorded(): void
    {
        $admin = User::where('role', 'hr_admin')->first();
        $application = Application::first();
        $this->assertNotNull($application);

        $response = $this->actingAs($admin)->patch('/admin/applicants/' . $application->id . '/status', [
            'status' => 'Shortlisted',
            'remarks' => 'Candidate shortlisted following qualifications review.',
            'notify_candidate' => '0',
        ]);

        $response->assertRedirect();
        $application->refresh();

        $this->assertEquals('Shortlisted', $application->status);

        $this->assertDatabaseHas('application_status_histories', [
            'application_id' => $application->id,
            'user_id' => $admin->id,
            'new_status' => 'Shortlisted',
            'remarks' => 'Candidate shortlisted following qualifications review.',
        ]);
    }

    public function test_hr_admin_can_download_candidate_cv(): void
    {
        $admin = User::where('role', 'hr_admin')->first();
        $application = Application::whereNotNull('cv_path')->first();
        $this->assertNotNull($application);

        // Ensure file exists in private storage disk
        Storage::disk('local')->put($application->cv_path, '%PDF-1.4 mock cv content');

        $response = $this->actingAs($admin)->get('/admin/applicants/' . $application->id . '/cv');
        $response->assertStatus(200);
        $response->assertHeader('content-disposition');
    }

    public function test_hr_admin_can_delete_withdrawn_application(): void
    {
        $admin = User::where('role', 'hr_admin')->first();
        $application = Application::create([
            'reference_number' => 'OEC-' . date('Y') . '-WD' . rand(1000, 9999),
            'full_name' => 'Withdrawn Candidate',
            'email' => 'withdrawn' . rand(100, 999) . '@example.com',
            'phone' => '+6012-9999999',
            'state' => 'Selangor',
            'highest_education' => 'Bachelor\'s Degree',
            'field_of_study' => 'Education',
            'institution' => 'University',
            'graduation_year' => '2024',
            'application_type' => 'Full-Time',
            'cv_path' => 'cvs/test_cv.pdf',
            'cv_original_name' => 'test_cv.pdf',
            'interest_reason' => 'Passionate about education.',
            'privacy_consent' => true,
            'status' => 'Withdrawn',
            'access_token' => 'dummytoken' . rand(10000, 99999),
        ]);

        $response = $this->actingAs($admin)->delete('/admin/applicants/' . $application->id);
        $response->assertRedirect('/admin/applicants');
        $this->assertDatabaseMissing('applications', ['id' => $application->id]);
    }

    public function test_hr_admin_cannot_delete_active_non_withdrawn_application(): void
    {
        $admin = User::where('role', 'hr_admin')->first();
        $application = Application::where('status', '!=', 'Withdrawn')->first();
        $this->assertNotNull($application);

        $response = $this->actingAs($admin)->delete('/admin/applicants/' . $application->id);
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('applications', ['id' => $application->id]);
    }
}
