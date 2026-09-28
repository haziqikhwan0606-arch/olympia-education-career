<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationSubmittedMail;
use App\Models\Application;
use App\Models\ApplicationStatusHistory;
use App\Models\JobVacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function create(string $slug): View|RedirectResponse
    {
        $vacancy = JobVacancy::where('slug', $slug)->firstOrFail();

        if (!$vacancy->isOpen()) {
            return redirect()->route('careers.show', $vacancy->slug)
                ->with('error', 'This position is currently closed and no longer accepting new applications.');
        }

        $states = [
            'Selangor',
            'Kuala Lumpur',
            'Putrajaya',
            'Johor',
            'Penang',
            'Perak',
            'Kedah',
            'Pahang',
            'Negeri Sembilan',
            'Melaka',
            'Kelantan',
            'Terengganu',
            'Perlis',
            'Sabah',
            'Sarawak',
            'Labuan',
        ];

        $educationLevels = [
            "Doctorate / PhD",
            "Master's Degree",
            "Postgraduate Diploma / Professional Certificate",
            "Bachelor's Degree",
            "Advanced Diploma / Higher National Diploma",
            "Diploma",
            "STPM / Matriculation / Foundation / Pre-U",
            "SPM / O-Level / High School Equivalent",
        ];

        return view('pages.applications.apply', compact('vacancy', 'states', 'educationLevels'));
    }

    public function store(Request $request, string $slug): RedirectResponse
    {
        $vacancy = JobVacancy::where('slug', $slug)->firstOrFail();

        if (!$vacancy->isOpen()) {
            return redirect()->route('careers.show', $vacancy->slug)
                ->with('error', 'This position is currently closed and cannot accept new submissions.');
        }

        // Validate
        $validated = $request->validate([
            // Personal
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'string', 'max:30'],
            'state' => ['required', 'string', 'max:100'],

            // Education
            'highest_education' => ['required', 'string', 'max:100'],
            'institution' => ['required', 'string', 'max:150'],
            'field_of_study' => ['required', 'string', 'max:150'],
            'graduation_year' => ['required', 'digits:4', 'integer', 'between:1970,' . (date('Y') + 6)],

            // Employment / Internship
            'application_type' => ['required', 'string', 'in:Full-Time,Internship,Part-Time,Contract'],
            'relevant_experience' => ['nullable', 'string', 'max:3000'],
            'internship_start_date' => ['nullable', 'date'],
            'internship_end_date' => ['nullable', 'date', 'after_or_equal:internship_start_date'],
            'university_internship_duration' => ['nullable', 'string', 'max:100'],

            // Documents (max 5MB, PDF only)
            'cv_file' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            'cover_letter_file' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],

            // Questions & Consent
            'interest_reason' => ['required', 'string', 'min:20', 'max:3000'],
            'privacy_consent' => ['accepted'],
        ], [
            'cv_file.required' => 'Please upload your Curriculum Vitae (CV) / resume in PDF format.',
            'cv_file.mimes' => 'The CV must be a valid PDF document.',
            'cv_file.max' => 'The CV file size must not exceed 5MB.',
            'cover_letter_file.mimes' => 'The cover letter must be a valid PDF document.',
            'cover_letter_file.max' => 'The cover letter file size must not exceed 5MB.',
            'privacy_consent.accepted' => 'You must acknowledge and consent to the applicant privacy notice to proceed.',
        ]);

        // Prevent immediate duplicate submission for the same job and email within 30 days
        $existing = Application::where('job_vacancy_id', $vacancy->id)
            ->where('email', Str::lower($validated['email']))
            ->where('created_at', '>=', now()->subDays(30))
            ->first();

        if ($existing) {
            return back()->withInput()->withErrors([
                'email' => 'An application for this vacancy with this email address has already been submitted under reference ' . $existing->reference_number . '. You can track your existing application anytime.',
            ]);
        }

        DB::beginTransaction();
        try {
            // Upload CV securely into private disk storage
            $cvPath = $request->file('cv_file')->store('cvs', 'local');
            $cvOriginalName = $request->file('cv_file')->getClientOriginalName();

            // Optional Cover Letter
            $coverLetterPath = null;
            $coverLetterOriginalName = null;
            if ($request->hasFile('cover_letter_file')) {
                $coverLetterPath = $request->file('cover_letter_file')->store('cover_letters', 'local');
                $coverLetterOriginalName = $request->file('cover_letter_file')->getClientOriginalName();
            }

            // Generate clean reference number: OEC-2026-XXXXX
            $refNumber = 'OEC-' . date('Y') . '-' . strtoupper(Str::random(6));
            while (Application::where('reference_number', $refNumber)->exists()) {
                $refNumber = 'OEC-' . date('Y') . '-' . strtoupper(Str::random(6));
            }

            $application = Application::create([
                'job_vacancy_id' => $vacancy->id,
                'reference_number' => $refNumber,
                'access_token' => Str::random(40),
                'full_name' => $validated['full_name'],
                'email' => Str::lower($validated['email']),
                'phone' => $validated['phone'],
                'state' => $validated['state'],
                'highest_education' => $validated['highest_education'],
                'institution' => $validated['institution'],
                'field_of_study' => $validated['field_of_study'],
                'graduation_year' => $validated['graduation_year'],
                'application_type' => $validated['application_type'],
                'relevant_experience' => $validated['relevant_experience'] ?? null,
                'internship_start_date' => $validated['internship_start_date'] ?? null,
                'internship_end_date' => $validated['internship_end_date'] ?? null,
                'university_internship_duration' => $validated['university_internship_duration'] ?? null,
                'cv_path' => $cvPath,
                'cv_original_name' => $cvOriginalName,
                'cover_letter_path' => $coverLetterPath,
                'cover_letter_original_name' => $coverLetterOriginalName,
                'interest_reason' => $validated['interest_reason'],
                'privacy_consent' => true,
                'status' => 'Submitted',
                'status_updated_at' => now(),
            ]);

            // Audit history
            ApplicationStatusHistory::create([
                'application_id' => $application->id,
                'user_id' => null,
                'previous_status' => 'None',
                'new_status' => 'Submitted',
                'remarks' => 'Online application submitted successfully via Olympia Career portal.',
            ]);

            DB::commit();

            // Attempt email sending gracefully
            try {
                Mail::to($application->email)->send(new ApplicationSubmittedMail($application));
            } catch (\Throwable $e) {
                Log::warning('Application confirmation email could not be dispatched: ' . $e->getMessage());
            }

            return redirect()->route('applications.success', ['ref' => $application->reference_number])
                ->with('just_submitted', true);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Application submission failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Unable to process your application at this time. Please check your inputs and try again.');
        }
    }

    public function success(Request $request): View|RedirectResponse
    {
        $ref = $request->query('ref');
        if (!$ref) {
            return redirect()->route('home');
        }

        $application = Application::with('jobVacancy')->where('reference_number', $ref)->firstOrFail();

        return view('pages.applications.success', compact('application'));
    }
}
