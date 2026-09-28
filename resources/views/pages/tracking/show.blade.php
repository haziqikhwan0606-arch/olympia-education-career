@extends('layouts.app')

@section('title', 'Status: ' . $application->reference_number . ' | Olympia Education Career')

@section('content')
    <!-- Top Header -->
    <div class="bg-slate-900 text-white py-12 border-b border-slate-800">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-400 bg-slate-800 px-3 py-1 rounded-md border border-slate-700">
                            Reference: {{ $application->reference_number }}
                        </span>
                        <span class="text-xs text-slate-400">
                            Submitted on {{ $application->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-extrabold text-white">
                        {{ $application->jobVacancy?->title ?? 'Recruitment Application' }}
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-300">
                        Candidate: <strong>{{ $application->full_name }}</strong> &bull;
                        Department: {{ $application->jobVacancy?->department ?? 'General' }}
                    </p>
                </div>

                <div class="shrink-0">
                    <div class="px-5 py-3 rounded-2xl border text-sm font-bold flex items-center gap-2 {{ $application->status_badge_class }}">
                        <span class="w-2.5 h-2.5 rounded-full bg-current animate-pulse"></span>
                        <span>{{ $application->status }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tracking Details Container -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">
        <!-- Recruitment Progression Timeline Card -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 sm:p-10 shadow-sm space-y-8">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Application Progression Status</h2>
                <p class="text-xs text-slate-500 mt-1">
                    Last status update: <strong>{{ $application->status_updated_at ? $application->status_updated_at->format('d F Y, h:i A') : $application->updated_at->format('d F Y, h:i A') }}</strong>
                </p>
            </div>

            @php
                $statusOrder = [
                    'Submitted' => 1,
                    'Under Review' => 2,
                    'Shortlisted' => 3,
                    'Interview / Assessment' => 4,
                    'Offered' => 5,
                    'Rejected' => 5,
                    'Withdrawn' => -1,
                ];

                $currentStep = $statusOrder[$application->status] ?? 1;
            @endphp

            @if ($application->status === 'Withdrawn')
                <div class="p-6 bg-slate-100 rounded-2xl border border-slate-200 text-center space-y-2">
                    <i data-lucide="slash" class="w-8 h-8 text-slate-400 mx-auto"></i>
                    <h3 class="text-sm font-bold text-slate-800">Application Voluntarily Withdrawn</h3>
                    <p class="text-xs text-slate-500 max-w-md mx-auto">
                        This application has been marked as withdrawn upon candidate request. We thank you for your initial interest in Olympia Education.
                    </p>
                </div>
            @else
                <!-- Visual Stepper Bar -->
                <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
                    <!-- Step 1: Submitted -->
                    <div class="p-4 rounded-2xl border transition-all {{ $currentStep >= 1 ? 'bg-blue-50/60 border-blue-200' : 'bg-slate-50 border-slate-200 opacity-60' }}">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold {{ $currentStep >= 1 ? 'bg-blue-900 text-white' : 'bg-slate-200 text-slate-600' }}">
                                @if($currentStep > 1) <i data-lucide="check" class="w-3.5 h-3.5"></i> @else 1 @endif
                            </div>
                            <span class="text-xs font-bold text-slate-900">Submitted</span>
                        </div>
                        <p class="text-[11px] text-slate-500">Materials logged in candidate database.</p>
                    </div>

                    <!-- Step 2: Under Review -->
                    <div class="p-4 rounded-2xl border transition-all {{ $currentStep >= 2 ? 'bg-amber-50/60 border-amber-200' : 'bg-slate-50 border-slate-200 opacity-60' }}">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold {{ $currentStep >= 2 ? 'bg-amber-500 text-slate-950' : 'bg-slate-200 text-slate-600' }}">
                                @if($currentStep > 2) <i data-lucide="check" class="w-3.5 h-3.5"></i> @else 2 @endif
                            </div>
                            <span class="text-xs font-bold text-slate-900">Under Review</span>
                        </div>
                        <p class="text-[11px] text-slate-500">Recruiter evaluating profile & qualifications.</p>
                    </div>

                    <!-- Step 3: Shortlisted -->
                    <div class="p-4 rounded-2xl border transition-all {{ $currentStep >= 3 ? 'bg-indigo-50/60 border-indigo-200' : 'bg-slate-50 border-slate-200 opacity-60' }}">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold {{ $currentStep >= 3 ? 'bg-indigo-600 text-white' : 'bg-slate-200 text-slate-600' }}">
                                @if($currentStep > 3) <i data-lucide="check" class="w-3.5 h-3.5"></i> @else 3 @endif
                            </div>
                            <span class="text-xs font-bold text-slate-900">Shortlisted</span>
                        </div>
                        <p class="text-[11px] text-slate-500">Advanced to hiring department review pool.</p>
                    </div>

                    <!-- Step 4: Interview / Assessment -->
                    <div class="p-4 rounded-2xl border transition-all {{ $currentStep >= 4 ? 'bg-purple-50/60 border-purple-200' : 'bg-slate-50 border-slate-200 opacity-60' }}">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold {{ $currentStep >= 4 ? 'bg-purple-600 text-white' : 'bg-slate-200 text-slate-600' }}">
                                @if($currentStep > 4) <i data-lucide="check" class="w-3.5 h-3.5"></i> @else 4 @endif
                            </div>
                            <span class="text-xs font-bold text-slate-900">Interview</span>
                        </div>
                        <p class="text-[11px] text-slate-500">Discussion or technical evaluation panel.</p>
                    </div>

                    <!-- Step 5: Final Outcome -->
                    <div class="p-4 rounded-2xl border transition-all
                        @if($application->status === 'Offered') bg-emerald-50/60 border-emerald-200
                        @elseif($application->status === 'Rejected') bg-rose-50/60 border-rose-200
                        @else bg-slate-50 border-slate-200 opacity-60 @endif">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold
                                @if($application->status === 'Offered') bg-emerald-600 text-white
                                @elseif($application->status === 'Rejected') bg-rose-600 text-white
                                @else bg-slate-200 text-slate-600 @endif">
                                5
                            </div>
                            <span class="text-xs font-bold text-slate-900">
                                @if($application->status === 'Offered') Offered
                                @elseif($application->status === 'Rejected') Concluded
                                @else Decision @endif
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-500">
                            @if($application->status === 'Offered') Placement offer extended.
                            @elseif($application->status === 'Rejected') Review finalized.
                            @else Final determination. @endif
                        </p>
                    </div>
                </div>
            @endif

            <!-- Detailed Stage Information Callout -->
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                <div class="text-xs font-bold uppercase tracking-wider text-slate-500">Current Stage Overview</div>
                <div class="text-base font-bold text-slate-900">
                    {{ $stages[$application->status]['title'] ?? $application->status }}
                </div>
                <p class="text-xs text-slate-600 leading-relaxed">
                    {{ $stages[$application->status]['description'] ?? 'Your application is currently active in our recruitment pipeline.' }}
                </p>
            </div>
        </div>

        <!-- Scheduled Interview Notification Box (if available) -->
        @if ($application->interviews->count() > 0)
            @php $latestInterview = $application->interviews->last(); @endphp
            <div class="bg-gradient-to-br from-purple-900 to-indigo-950 text-white rounded-3xl p-8 shadow-md space-y-4">
                <div class="flex items-center justify-between border-b border-purple-800/80 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-500/20 text-purple-300 flex items-center justify-center">
                            <i data-lucide="calendar" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="text-xs uppercase font-semibold text-purple-300">Upcoming Recruitment Event</div>
                            <h3 class="text-lg font-bold text-white">Interview Session Scheduled</h3>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-purple-500/20 text-purple-200 border border-purple-400/30 rounded-full text-xs font-semibold">
                        {{ $latestInterview->status }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-2 text-xs">
                    <div>
                        <span class="text-purple-300 block mb-1">Date & Time:</span>
                        <span class="font-bold text-white text-sm">{{ $latestInterview->scheduled_at->format('d M Y (D), h:i A') }}</span>
                    </div>

                    <div>
                        <span class="text-purple-300 block mb-1">Session Format:</span>
                        <span class="font-bold text-white text-sm">{{ $latestInterview->location_type }}</span>
                    </div>

                    <div>
                        <span class="text-purple-300 block mb-1">Interview Panel:</span>
                        <span class="font-semibold text-white">{{ $latestInterview->interviewer_names }}</span>
                    </div>
                </div>

                <div class="p-4 bg-purple-950/60 rounded-xl border border-purple-800/40 text-xs text-purple-200 space-y-1">
                    <span class="font-bold text-white">Meeting Venue / Video Link:</span>
                    <p class="font-mono text-amber-300 break-all select-all">{{ $latestInterview->meeting_link_or_venue }}</p>
                    @if ($latestInterview->notes)
                        <div class="pt-2 text-[11px] text-purple-300 border-t border-purple-900">
                            <strong>Candidate Preparation Note:</strong> {{ $latestInterview->notes }}
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Application Summary Card -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-xs space-y-6">
            <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">
                Submitted Application Summary
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs">
                <div class="space-y-1">
                    <span class="text-slate-500">Applicant Full Name:</span>
                    <div class="font-bold text-slate-900">{{ $application->full_name }}</div>
                </div>

                <div class="space-y-1">
                    <span class="text-slate-500">Registered Email:</span>
                    <div class="font-bold text-slate-900">{{ $application->email }}</div>
                </div>

                <div class="space-y-1">
                    <span class="text-slate-500">Contact Number:</span>
                    <div class="font-bold text-slate-900">{{ $application->phone }}</div>
                </div>

                <div class="space-y-1">
                    <span class="text-slate-500">Malaysian State:</span>
                    <div class="font-bold text-slate-900">{{ $application->state }}</div>
                </div>

                <div class="space-y-1">
                    <span class="text-slate-500">Highest Education:</span>
                    <div class="font-bold text-slate-900">{{ $application->highest_education }} ({{ $application->institution }})</div>
                </div>

                <div class="space-y-1">
                    <span class="text-slate-500">Field of Study:</span>
                    <div class="font-bold text-slate-900">{{ $application->field_of_study }} (Grad: {{ $application->graduation_year }})</div>
                </div>

                <div class="space-y-1">
                    <span class="text-slate-500">Application Type:</span>
                    <div class="font-bold text-slate-900">{{ $application->application_type }}</div>
                </div>

                <div class="space-y-1">
                    <span class="text-slate-500">Uploaded Resume:</span>
                    <div class="font-semibold text-blue-900 flex items-center gap-1.5">
                        <i data-lucide="file-check" class="w-4 h-4 text-emerald-600"></i>
                        <span>{{ $application->cv_original_name ?? 'Candidate_CV.pdf' }} (Securely Stored)</span>
                    </div>
                </div>
            </div>

            <!-- Candidate Withdrawal Action (if active) -->
            @if (!in_array($application->status, ['Offered', 'Rejected', 'Withdrawn']))
                <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-slate-500">
                        Need to withdraw this application? You can withdraw your submission at any point before an offer is made.
                    </p>

                    <form action="{{ route('tracking.withdraw') }}" method="POST" onsubmit="return confirm('Are you sure you wish to withdraw your application for this position? This action cannot be reversed.')">
                        @csrf
                        <input type="hidden" name="reference_number" value="{{ $application->reference_number }}">
                        <input type="hidden" name="token" value="{{ $application->access_token }}">
                        <button type="submit" class="px-4 py-2 text-xs font-semibold text-rose-700 bg-rose-50 hover:bg-rose-100 rounded-xl border border-rose-200 transition-colors">
                            Withdraw Application
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
