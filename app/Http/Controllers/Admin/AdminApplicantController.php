<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApplicationStatusUpdatedMail;
use App\Mail\InterviewScheduledMail;
use App\Mail\RecruitmentOutcomeMail;
use App\Models\Application;
use App\Models\ApplicationStatusHistory;
use App\Models\Interview;
use App\Models\JobVacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminApplicantController extends Controller
{
    public function index(Request $request): View
    {
        $query = Application::with('jobVacancy');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('reference_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('institution', 'like', "%{$search}%");
            });
        }

        if ($request->filled('job_id')) {
            $query->where('job_vacancy_id', $request->input('job_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('type')) {
            $query->where('application_type', $request->input('type'));
        }

        $sort = $request->input('sort', 'newest');
        if ($sort === 'oldest') {
            $query->oldest('created_at');
        } elseif ($sort === 'name') {
            $query->orderBy('full_name', 'asc');
        } else {
            $query->latest('created_at');
        }

        $applications = $query->paginate(15)->withQueryString();

        $vacancies = JobVacancy::orderBy('title')->get(['id', 'title']);
        $statuses = [
            'Submitted',
            'Under Review',
            'Shortlisted',
            'Interview / Assessment',
            'Offered',
            'Rejected',
            'Withdrawn'
        ];

        return view('admin.applicants.index', compact('applications', 'vacancies', 'statuses'));
    }

    public function show(int $id): View
    {
        $application = Application::with([
            'jobVacancy',
            'statusHistories.user',
            'interviews.interviewer'
        ])->findOrFail($id);

        $statuses = [
            'Submitted',
            'Under Review',
            'Shortlisted',
            'Interview / Assessment',
            'Offered',
            'Rejected',
            'Withdrawn'
        ];

        return view('admin.applicants.show', compact('application', 'statuses'));
    }

    public function downloadCv(int $id): StreamedResponse|RedirectResponse
    {
        $application = Application::findOrFail($id);

        if (!$application->cv_path || !Storage::disk('local')->exists($application->cv_path)) {
            return back()->with('error', 'The requested CV file could not be found in secure storage.');
        }

        return Storage::disk('local')->download(
            $application->cv_path,
            $application->cv_original_name ?? 'Candidate_CV_' . $application->reference_number . '.pdf'
        );
    }

    public function downloadCoverLetter(int $id): StreamedResponse|RedirectResponse
    {
        $application = Application::findOrFail($id);

        if (!$application->cover_letter_path || !Storage::disk('local')->exists($application->cover_letter_path)) {
            return back()->with('error', 'The requested cover letter could not be found in secure storage.');
        }

        return Storage::disk('local')->download(
            $application->cover_letter_path,
            $application->cover_letter_original_name ?? 'Cover_Letter_' . $application->reference_number . '.pdf'
        );
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $application = Application::with('jobVacancy')->findOrFail($id);

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:Submitted,Under Review,Shortlisted,Interview / Assessment,Offered,Rejected,Withdrawn'],
            'remarks' => ['nullable', 'string', 'max:1000'],
            'notify_candidate' => ['nullable', 'boolean'],
        ]);

        $previousStatus = $application->status;
        $newStatus = $validated['status'];

        if ($previousStatus === $newStatus && empty($validated['remarks'])) {
            return back()->with('info', 'No status changes were requested.');
        }

        $application->update([
            'status' => $newStatus,
            'status_updated_at' => now(),
        ]);

        // Audit History
        ApplicationStatusHistory::create([
            'application_id' => $application->id,
            'user_id' => Auth::id(),
            'previous_status' => $previousStatus,
            'new_status' => $newStatus,
            'remarks' => $validated['remarks'] ?? 'Status changed by ' . Auth::user()->name . '.',
        ]);

        // Optional notification dispatch
        if ($request->boolean('notify_candidate')) {
            try {
                if (in_array($newStatus, ['Offered', 'Rejected'])) {
                    $outcomeType = $newStatus === 'Offered' ? 'offered' : 'rejected';
                    Mail::to($application->email)->send(new RecruitmentOutcomeMail(
                        $application,
                        $outcomeType,
                        $validated['remarks'] ?? null
                    ));
                } else {
                    Mail::to($application->email)->send(new ApplicationStatusUpdatedMail(
                        $application,
                        $previousStatus,
                        $validated['remarks'] ?? null
                    ));
                }
            } catch (\Throwable $e) {
                Log::warning('Email notification failed to dispatch: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Application status updated to "' . $newStatus . '" and logged in audit history.');
    }

    public function updateNotes(Request $request, int $id): RedirectResponse
    {
        $application = Application::findOrFail($id);

        $validated = $request->validate([
            'internal_notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $application->update([
            'internal_notes' => $validated['internal_notes'],
        ]);

        return back()->with('success', 'Internal recruitment notes updated successfully.');
    }

    public function scheduleInterview(Request $request, int $id): RedirectResponse
    {
        $application = Application::with('jobVacancy')->findOrFail($id);

        $validated = $request->validate([
            'scheduled_at' => ['required', 'date', 'after:now'],
            'location_type' => ['required', 'in:Online Video Call,In-Person (HQ),Phone Interview'],
            'meeting_link_or_venue' => ['required', 'string', 'max:255'],
            'interviewer_names' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'send_invitation' => ['nullable', 'boolean'],
        ]);

        $interview = Interview::create([
            'application_id' => $application->id,
            'user_id' => Auth::id(),
            'scheduled_at' => $validated['scheduled_at'],
            'location_type' => $validated['location_type'],
            'meeting_link_or_venue' => $validated['meeting_link_or_venue'],
            'interviewer_names' => $validated['interviewer_names'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'Scheduled',
        ]);

        // Auto-advance application status if not already in interview stage
        if ($application->status !== 'Interview / Assessment') {
            $prev = $application->status;
            $application->update([
                'status' => 'Interview / Assessment',
                'status_updated_at' => now(),
            ]);

            ApplicationStatusHistory::create([
                'application_id' => $application->id,
                'user_id' => Auth::id(),
                'previous_status' => $prev,
                'new_status' => 'Interview / Assessment',
                'remarks' => 'Interview scheduled for ' . date('d M Y, h:i A', strtotime($validated['scheduled_at'])),
            ]);
        }

        // Email invitation to candidate
        if ($request->boolean('send_invitation')) {
            try {
                Mail::to($application->email)->send(new InterviewScheduledMail($application, $interview));
            } catch (\Throwable $e) {
                Log::warning('Interview invitation email failed: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Interview session scheduled successfully and logged.');
    }
}
