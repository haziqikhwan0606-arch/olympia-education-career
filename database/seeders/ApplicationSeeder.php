<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\ApplicationStatusHistory;
use App\Models\Interview;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'hr_admin')->first();
        $devJob = JobVacancy::where('slug', 'senior-full-stack-web-developer')->first();
        $internJob = JobVacancy::where('slug', 'software-development-edtech-intern')->first();
        $admissionsJob = JobVacancy::where('slug', 'student-experience-admissions-officer')->first();
        $mediaIntern = JobVacancy::where('slug', 'digital-media-content-creator-intern')->first();

        $candidates = [
            [
                'job_vacancy_id' => $devJob?->id,
                'reference_number' => 'OEC-2026-DEV001',
                'access_token' => 'tok_' . Str::random(32),
                'full_name' => 'Ahmad Daniel bin Farhan',
                'email' => 'ahmad.daniel@example.com',
                'phone' => '+60 12-345 6789',
                'state' => 'Selangor',
                'highest_education' => "Bachelor's Degree",
                'institution' => 'Universiti Malaya (UM)',
                'field_of_study' => 'Software Engineering',
                'graduation_year' => '2022',
                'application_type' => 'Full-Time',
                'relevant_experience' => '3+ years building SaaS web applications using Laravel, MySQL, Vue.js and Docker.',
                'internship_start_date' => null,
                'internship_end_date' => null,
                'university_internship_duration' => null,
                'cv_path' => 'cvs/sample-cv.pdf',
                'cv_original_name' => 'Ahmad_Daniel_CV_2026.pdf',
                'cover_letter_path' => null,
                'cover_letter_original_name' => null,
                'interest_reason' => 'Passionate about shaping modern digital education infrastructure in Malaysia and mentoring upcoming tech talents.',
                'privacy_consent' => true,
                'status' => 'Shortlisted',
                'internal_notes' => 'Strong technical background with solid Laravel framework proficiency. Recommended for technical panel round.',
                'status_updated_at' => now()->subDays(2),
            ],
            [
                'job_vacancy_id' => $devJob?->id,
                'reference_number' => 'OEC-2026-DEV002',
                'access_token' => 'tok_' . Str::random(32),
                'full_name' => 'Tan Wei Lin',
                'email' => 'weilin.tan@example.com',
                'phone' => '+60 16-789 1234',
                'state' => 'Kuala Lumpur',
                'highest_education' => "Bachelor's Degree",
                'institution' => 'Asia Pacific University (APU)',
                'field_of_study' => 'Computer Science (Cloud Computing)',
                'graduation_year' => '2023',
                'application_type' => 'Full-Time',
                'relevant_experience' => '2 years in backend API engineering and database scaling.',
                'internship_start_date' => null,
                'internship_end_date' => null,
                'university_internship_duration' => null,
                'cv_path' => 'cvs/sample-cv.pdf',
                'cv_original_name' => 'WeiLin_Tan_Resume.pdf',
                'cover_letter_path' => null,
                'cover_letter_original_name' => null,
                'interest_reason' => 'Eager to contribute to Olympia Education’s digital transformation projects.',
                'privacy_consent' => true,
                'status' => 'Interview / Assessment',
                'internal_notes' => 'Panel interview scheduled for next Tuesday.',
                'status_updated_at' => now()->subDays(1),
            ],
            [
                'job_vacancy_id' => $internJob?->id,
                'reference_number' => 'OEC-2026-INT001',
                'access_token' => 'tok_' . Str::random(32),
                'full_name' => 'Nurul Izzah binti Zulkifli',
                'email' => 'nurul.izzah@example.com',
                'phone' => '+60 17-234 5678',
                'state' => 'Selangor',
                'highest_education' => 'Diploma',
                'institution' => 'Politeknik Sultan Salahuddin Abdul Aziz Shah',
                'field_of_study' => 'Information Technology (Digital Technology)',
                'graduation_year' => '2026',
                'application_type' => 'Internship',
                'relevant_experience' => 'Built academic project portals using PHP and Bootstrap. Active in college coding club.',
                'internship_start_date' => now()->addWeeks(2)->toDateString(),
                'internship_end_date' => now()->addMonths(6)->toDateString(),
                'university_internship_duration' => '24 Weeks (6 Months)',
                'cv_path' => 'cvs/sample-cv.pdf',
                'cv_original_name' => 'Nurul_Izzah_Resume.pdf',
                'cover_letter_path' => null,
                'cover_letter_original_name' => null,
                'interest_reason' => 'Looking to gain practical industry exposure in web engineering and learn directly from experienced senior mentors.',
                'privacy_consent' => true,
                'status' => 'Under Review',
                'internal_notes' => 'Resume and college verification letter verified. Meets all prerequisite criteria.',
                'status_updated_at' => now()->subDays(3),
            ],
            [
                'job_vacancy_id' => $admissionsJob?->id,
                'reference_number' => 'OEC-2026-ADM001',
                'access_token' => 'tok_' . Str::random(32),
                'full_name' => 'Suresh Kumar a/l Rajan',
                'email' => 'suresh.kumar@example.com',
                'phone' => '+60 11-1234 5678',
                'state' => 'Kuala Lumpur',
                'highest_education' => "Bachelor's Degree",
                'institution' => 'Universiti Kebangsaan Malaysia (UKM)',
                'field_of_study' => 'Corporate Communications',
                'graduation_year' => '2021',
                'application_type' => 'Full-Time',
                'relevant_experience' => '3 years in higher education student counseling and outreach campaigns.',
                'internship_start_date' => null,
                'internship_end_date' => null,
                'university_internship_duration' => null,
                'cv_path' => 'cvs/sample-cv.pdf',
                'cv_original_name' => 'Suresh_Kumar_CV.pdf',
                'cover_letter_path' => null,
                'cover_letter_original_name' => null,
                'interest_reason' => 'Passionate about guiding Malaysian youth through their career choices and higher education aspirations.',
                'privacy_consent' => true,
                'status' => 'Submitted',
                'internal_notes' => 'New application received yesterday. Needs initial HR screening.',
                'status_updated_at' => now()->subHours(18),
            ],
            [
                'job_vacancy_id' => $mediaIntern?->id,
                'reference_number' => 'OEC-2026-MED001',
                'access_token' => 'tok_' . Str::random(32),
                'full_name' => 'Chloe Lim Mei Ling',
                'email' => 'chloe.lim@example.com',
                'phone' => '+60 14-888 9999',
                'state' => 'Penang',
                'highest_education' => "Bachelor's Degree",
                'institution' => 'Taylor’s University',
                'field_of_study' => 'Creative Media & Graphic Design',
                'graduation_year' => '2026',
                'application_type' => 'Internship',
                'relevant_experience' => 'Managed TikTok account for college student union with over 20K followers. Proficient in Premiere Pro and Figma.',
                'internship_start_date' => now()->addWeeks(3)->toDateString(),
                'internship_end_date' => now()->addMonths(4)->toDateString(),
                'university_internship_duration' => '16 Weeks',
                'cv_path' => 'cvs/sample-cv.pdf',
                'cv_original_name' => 'Chloe_Lim_Portfolio_Resume.pdf',
                'cover_letter_path' => null,
                'cover_letter_original_name' => null,
                'interest_reason' => 'Excited to create youthful, inspiring educational content for Olympia Education’s social channels.',
                'privacy_consent' => true,
                'status' => 'Offered',
                'internal_notes' => 'Exceptional creative portfolio. Internship offer letter issued.',
                'status_updated_at' => now()->subDays(4),
            ],
        ];

        foreach ($candidates as $cand) {
            $app = Application::updateOrCreate(
                ['reference_number' => $cand['reference_number']],
                $cand
            );

            // Audit history
            ApplicationStatusHistory::firstOrCreate(
                [
                    'application_id' => $app->id,
                    'new_status' => 'Submitted',
                ],
                [
                    'previous_status' => 'None',
                    'user_id' => null,
                    'remarks' => 'Online application submitted via Olympia Career portal.',
                    'created_at' => now()->subDays(5),
                ]
            );

            if ($app->status !== 'Submitted') {
                ApplicationStatusHistory::firstOrCreate(
                    [
                        'application_id' => $app->id,
                        'new_status' => $app->status,
                    ],
                    [
                        'previous_status' => 'Submitted',
                        'user_id' => $admin?->id,
                        'remarks' => $app->internal_notes ?? 'Application progressed by HR team.',
                        'created_at' => $app->status_updated_at ?? now(),
                    ]
                );
            }

            // If interview status, create an interview schedule record
            if ($app->status === 'Interview / Assessment') {
                Interview::updateOrCreate(
                    ['application_id' => $app->id],
                    [
                        'user_id' => $admin?->id,
                        'scheduled_at' => now()->addDays(3)->setHour(14)->setMinute(30),
                        'location_type' => 'Online Video Call',
                        'meeting_link_or_venue' => 'https://meet.google.com/oec-tech-interview',
                        'interviewer_names' => 'HR Panel & Head of IT Department',
                        'notes' => 'Technical evaluation: architecture questions, live coding problem solving, and culture alignment discussion.',
                        'status' => 'Scheduled',
                    ]
                );
            }
        }
    }
}
