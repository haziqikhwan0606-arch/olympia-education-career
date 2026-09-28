<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\JobVacancy;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class OnlineApplicationTest extends TestCase
{
    public function test_candidate_can_submit_application_with_valid_pdf_cv(): void
    {
        Storage::fake('local');

        $job = JobVacancy::where('status', 'published')
            ->where(function ($q) {
                $q->whereNull('closing_date')->orWhere('closing_date', '>=', now()->toDateString());
            })->first();

        $this->assertNotNull($job, 'An open job vacancy must exist for testing.');

        $pdfFile = UploadedFile::fake()->create('candidate_resume.pdf', 300, 'application/pdf');

        $payload = [
            'full_name' => 'Faris Iskandar bin Roslan',
            'email' => 'faris.test' . time() . '@example.com',
            'phone' => '+60 19-876 5432',
            'state' => 'Selangor',
            'highest_education' => "Bachelor's Degree",
            'institution' => 'Universiti Teknologi MARA (UiTM)',
            'field_of_study' => 'Information Systems',
            'graduation_year' => '2023',
            'application_type' => 'Full-Time',
            'relevant_experience' => 'Hands on web application projects.',
            'cv_file' => $pdfFile,
            'interest_reason' => 'I am eager to contribute to educational leadership and technology transformation at Olympia Education.',
            'privacy_consent' => '1',
        ];

        $response = $this->post(route('applications.store', $job->slug), $payload);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        // Assert database persistence
        $application = Application::where('email', $payload['email'])->first();
        $this->assertNotNull($application);
        $this->assertEquals('Submitted', $application->status);
        $this->assertStringStartsWith('OEC-', $application->reference_number);

        // Assert storage in private disk
        Storage::disk('local')->assertExists($application->cv_path);
    }

    public function test_rejects_non_pdf_file_uploads(): void
    {
        $job = JobVacancy::open()->first();
        $this->assertNotNull($job);

        $txtFile = UploadedFile::fake()->create('malicious_script.exe', 100);

        $payload = [
            'full_name' => 'Malicious User',
            'email' => 'hacker@example.com',
            'phone' => '+60 12-345 6789',
            'state' => 'Selangor',
            'highest_education' => "Bachelor's Degree",
            'institution' => 'Unknown',
            'field_of_study' => 'IT',
            'graduation_year' => '2024',
            'application_type' => 'Full-Time',
            'cv_file' => $txtFile,
            'interest_reason' => 'Testing validation rejection against non-PDF uploads.',
            'privacy_consent' => '1',
        ];

        $response = $this->post(route('applications.store', $job->slug), $payload);
        $response->assertSessionHasErrors(['cv_file']);
    }

    public function test_cannot_apply_for_closed_vacancy(): void
    {
        $closedJob = JobVacancy::where('status', 'closed')->first();
        $this->assertNotNull($closedJob, 'A closed job must exist for testing.');

        $pdfFile = UploadedFile::fake()->create('resume.pdf', 200, 'application/pdf');

        $payload = [
            'full_name' => 'Late Candidate',
            'email' => 'late@example.com',
            'phone' => '+60 12-345 6789',
            'state' => 'Selangor',
            'highest_education' => "Bachelor's Degree",
            'institution' => 'University',
            'field_of_study' => 'Finance',
            'graduation_year' => '2023',
            'application_type' => 'Full-Time',
            'cv_file' => $pdfFile,
            'interest_reason' => 'Trying to submit to a closed job.',
            'privacy_consent' => '1',
        ];

        $response = $this->post(route('applications.store', $closedJob->slug), $payload);
        $response->assertRedirect(route('careers.show', $closedJob->slug));
    }
}
