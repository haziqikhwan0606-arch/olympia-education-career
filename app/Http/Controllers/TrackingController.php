<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationStatusHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TrackingController extends Controller
{
    public function index(Request $request): View
    {
        $prefillRef = $request->query('ref');
        return view('pages.tracking.index', compact('prefillRef'));
    }

    public function check(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'reference_number' => ['required', 'string'],
            'email' => ['required', 'email'],
        ], [
            'reference_number.required' => 'Please provide your application reference number (e.g., OEC-2026-XXXXX).',
            'email.required' => 'Please provide the email address used during submission.',
        ]);

        $application = Application::where('reference_number', trim($validated['reference_number']))
            ->where('email', Str::lower(trim($validated['email'])))
            ->first();

        if (!$application) {
            return back()->withInput()->withErrors([
                'reference_number' => 'No active application found matching that reference number and email address. Please double-check your records.',
            ]);
        }

        // Store verification in session for 60 minutes
        session()->put('verified_tracking_' . $application->reference_number, true);

        return redirect()->route('tracking.show', [
            'ref' => $application->reference_number,
            'token' => $application->access_token,
        ]);
    }

    public function show(Request $request): View|RedirectResponse
    {
        $ref = $request->query('ref');
        $token = $request->query('token');

        if (!$ref) {
            return redirect()->route('tracking.index');
        }

        $query = Application::with(['jobVacancy', 'interviews' => function ($q) {
            $q->whereIn('status', ['Scheduled', 'Rescheduled']);
        }])->where('reference_number', $ref);

        // Security verification: must have correct token OR session verification
        if ($token) {
            $query->where('access_token', $token);
        } else {
            $hasSession = session()->get('verified_tracking_' . $ref);
            if (!$hasSession) {
                return redirect()->route('tracking.index', ['ref' => $ref])
                    ->with('warning', 'Please enter your registered email address to verify your identity and view application details.');
            }
        }

        $application = $query->first();

        if (!$application) {
            return redirect()->route('tracking.index')
                ->withErrors(['reference_number' => 'Invalid or expired tracking link. Please enter your credentials to search again.']);
        }

        // Progression stages
        $stages = [
            'Submitted' => [
                'title' => 'Application Submitted',
                'description' => 'Your profile and application materials have been safely received by our talent database.',
                'step' => 1,
            ],
            'Under Review' => [
                'title' => 'Under Review',
                'description' => 'Our HR recruiters and departmental hiring managers are actively screening your qualifications.',
                'step' => 2,
            ],
            'Shortlisted' => [
                'title' => 'Candidate Shortlisted',
                'description' => 'Your background meets our key criteria and you have advanced to the interview evaluation pool.',
                'step' => 3,
            ],
            'Interview / Assessment' => [
                'title' => 'Interview / Assessment',
                'description' => 'An interview or skills evaluation session is being arranged or conducted with the hiring panel.',
                'step' => 4,
            ],
            'Offered' => [
                'title' => 'Offer Extended',
                'description' => 'A formal offer of appointment or internship placement has been issued to you.',
                'step' => 5,
            ],
            'Rejected' => [
                'title' => 'Application Concluded',
                'description' => 'Our review has concluded. While this role will not progress, we encourage you to apply for future openings.',
                'step' => 5,
            ],
            'Withdrawn' => [
                'title' => 'Application Withdrawn',
                'description' => 'This application was withdrawn upon candidate request.',
                'step' => 0,
            ],
        ];

        return view('pages.tracking.show', compact('application', 'stages'));
    }

    public function withdraw(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'reference_number' => ['required', 'string'],
            'token' => ['required', 'string'],
        ]);

        $application = Application::where('reference_number', $validated['reference_number'])
            ->where('access_token', $validated['token'])
            ->firstOrFail();

        if (in_array($application->status, ['Offered', 'Rejected', 'Withdrawn'])) {
            return back()->with('error', 'This application can no longer be withdrawn in its current state.');
        }

        $prevStatus = $application->status;
        $application->update([
            'status' => 'Withdrawn',
            'status_updated_at' => now(),
        ]);

        ApplicationStatusHistory::create([
            'application_id' => $application->id,
            'user_id' => null,
            'previous_status' => $prevStatus,
            'new_status' => 'Withdrawn',
            'remarks' => 'Application voluntarily withdrawn by candidate.',
        ]);

        return back()->with('success', 'Your application has been marked as Withdrawn.');
    }
}
