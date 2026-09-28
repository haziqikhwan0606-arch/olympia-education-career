@extends('layouts.admin')

@section('page_title', 'Applicant: ' . $application->full_name)

@section('content')
    <div class="space-y-8">
        <!-- Top Bar Navigation & Quick Status -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.applicants.index') }}" class="text-xs font-semibold text-slate-500 hover:text-slate-900 flex items-center gap-1 mb-1">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    <span>Back to Candidate Pool</span>
                </a>
                <div class="flex items-center gap-3">
                    <h2 class="text-2xl font-black text-slate-900">{{ $application->full_name }}</h2>
                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold border {{ $application->status_badge_class }}">
                        {{ $application->status }}
                    </span>
                </div>
                <div class="text-xs text-slate-500 mt-0.5">
                    Reference: <strong class="font-mono text-amber-700">{{ $application->reference_number }}</strong> &bull;
                    Submitted on {{ $application->created_at->format('d M Y, h:i A') }}
                </div>
            </div>

            <!-- CV Download Button (Auth Protected) -->
            <div class="flex items-center gap-3">
                @if ($application->cv_path)
                    <a href="{{ route('admin.applicants.download_cv', $application->id) }}" class="px-4 py-2.5 bg-blue-900 hover:bg-blue-950 text-white font-semibold text-xs rounded-xl shadow-xs transition-colors flex items-center gap-2">
                        <i data-lucide="file-down" class="w-4 h-4 text-amber-400"></i>
                        <span>Download Resume (PDF)</span>
                    </a>
                @endif
                @if ($application->cover_letter_path)
                    <a href="{{ route('admin.applicants.download_cover_letter', $application->id) }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition-colors flex items-center gap-1.5 border border-slate-200">
                        <i data-lucide="file-text" class="w-4 h-4 text-slate-500"></i>
                        <span>Cover Letter</span>
                    </a>
                @endif
                @if (strtolower($application->status) === 'withdrawn')
                    <form action="{{ route('admin.applicants.destroy', $application->id) }}" method="POST" class="inline" onsubmit="return confirm('Permanently delete withdrawn application {{ $application->reference_number }} ({{ $application->full_name }})?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold text-xs rounded-xl transition-colors flex items-center gap-1.5 border border-rose-200 shadow-xs">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                            <span>Delete Application</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column: Candidate Dossier -->
            <div class="lg:col-span-8 space-y-8">
                <!-- 1. Position Applied For -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-2xs space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Position Applied</h3>
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                            <div class="text-lg font-bold text-slate-900">
                                {{ $application->jobVacancy?->title ?? 'General Application' }}
                            </div>
                            <div class="text-xs text-slate-500">
                                Department: {{ $application->jobVacancy?->department ?? 'General' }} &bull;
                                Type: <strong>{{ $application->application_type }}</strong> &bull;
                                Location: {{ $application->jobVacancy?->location ?? 'Campus HQ' }}
                            </div>
                        </div>
                        @if ($application->jobVacancy)
                            <a href="{{ route('careers.show', $application->jobVacancy->slug) }}" target="_blank" class="text-xs font-semibold text-blue-900 hover:underline flex items-center gap-1">
                                <span>View Public Job Page</span>
                                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- 2. Personal Information & Education -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-2xs space-y-6">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i data-lucide="user" class="w-4 h-4 text-blue-900"></i>
                        <span>Candidate Profile & Academic Background</span>
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs">
                        <div>
                            <span class="text-slate-400 block mb-0.5">Full Name:</span>
                            <span class="font-bold text-slate-900 text-sm">{{ $application->full_name }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block mb-0.5">Email Address:</span>
                            <span class="font-bold text-slate-900 select-all">{{ $application->email }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block mb-0.5">Phone / WhatsApp:</span>
                            <span class="font-bold text-slate-900">{{ $application->phone }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block mb-0.5">State / Location:</span>
                            <span class="font-bold text-slate-900">{{ $application->state }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block mb-0.5">Highest Qualification:</span>
                            <span class="font-bold text-slate-900">{{ $application->highest_education }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block mb-0.5">Institution:</span>
                            <span class="font-bold text-slate-900">{{ $application->institution }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block mb-0.5">Field of Study:</span>
                            <span class="font-bold text-slate-900">{{ $application->field_of_study }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block mb-0.5">Graduation Year:</span>
                            <span class="font-bold text-slate-900">{{ $application->graduation_year }}</span>
                        </div>
                    </div>

                    <!-- Internship Specific Specs (if applicable) -->
                    @if ($application->application_type === 'Internship' || $application->internship_start_date)
                        <div class="p-4 bg-amber-50/70 rounded-2xl border border-amber-200 text-xs space-y-2">
                            <span class="font-bold text-amber-900 uppercase">Internship Placement Details</span>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                                <div>
                                    <span class="text-amber-800">Start Date:</span>
                                    <div class="font-semibold text-slate-900">{{ $application->internship_start_date ? $application->internship_start_date->format('d M Y') : 'Flexible' }}</div>
                                </div>
                                <div>
                                    <span class="text-amber-800">End Date:</span>
                                    <div class="font-semibold text-slate-900">{{ $application->internship_end_date ? $application->internship_end_date->format('d M Y') : 'Flexible' }}</div>
                                </div>
                                <div>
                                    <span class="text-amber-800">Required Duration:</span>
                                    <div class="font-semibold text-slate-900">{{ $application->university_internship_duration ?? 'Not Specified' }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- 3. Relevant Experience & Interest Statement -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-2xs space-y-6">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i data-lucide="file-text" class="w-4 h-4 text-emerald-600"></i>
                        <span>Experience & Candidate Statement</span>
                    </h3>

                    @if ($application->relevant_experience)
                        <div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Relevant Experience Summary</h4>
                            <div class="p-4 bg-slate-50 rounded-2xl text-xs text-slate-700 leading-relaxed whitespace-pre-line border border-slate-100">
                                {{ $application->relevant_experience }}
                            </div>
                        </div>
                    @endif

                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Why Interested in Olympia Education</h4>
                        <div class="p-4 bg-slate-50 rounded-2xl text-xs text-slate-700 leading-relaxed whitespace-pre-line border border-slate-100">
                            {{ $application->interest_reason }}
                        </div>
                    </div>
                </div>

                <!-- 4. Status History Audit Log -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-2xs space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="history" class="w-4 h-4 text-amber-600"></i>
                            <span>Application Status Audit History</span>
                        </h3>
                        <span class="text-xs text-slate-400 font-medium">{{ $application->statusHistories->count() }} events logged</span>
                    </div>

                    <div class="space-y-3">
                        @forelse ($application->statusHistories as $history)
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="text-slate-500 font-semibold">{{ $history->previous_status }}</span>
                                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-slate-400"></i>
                                        <span class="font-bold text-slate-900 bg-white px-2 py-0.5 rounded border border-slate-200">{{ $history->new_status }}</span>
                                    </div>
                                    @if ($history->remarks)
                                        <p class="text-slate-600 text-[11px] leading-relaxed">{{ $history->remarks }}</p>
                                    @endif
                                </div>
                                <div class="text-right shrink-0 text-[11px] text-slate-400">
                                    <div>{{ $history->created_at->format('d M Y, h:i A') }}</div>
                                    <div class="font-medium text-slate-600">{{ $history->user?->name ?? 'Candidate / System' }}</div>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 text-center py-4">No historical status modifications recorded.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column: Administrative Recruitment Actions -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Action 1: Status Progression Form -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-2xs space-y-4">
                    <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i data-lucide="sliders" class="w-4 h-4 text-blue-900"></i>
                        <span>Update Recruitment Status</span>
                    </h3>

                    <form action="{{ route('admin.applicants.update_status', $application->id) }}" method="POST" class="space-y-4 text-xs">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="status" class="block font-bold text-slate-700 uppercase mb-1">New Status</label>
                            <select name="status" id="status" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                                @foreach ($statuses as $st)
                                    <option value="{{ $st }}" {{ $application->status === $st ? 'selected' : '' }}>{{ $st }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="remarks" class="block font-bold text-slate-700 uppercase mb-1">Audit Remarks / Justification</label>
                            <textarea name="remarks" id="remarks" rows="2" placeholder="Reason for status change..."
                                      class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900"></textarea>
                        </div>

                        <div>
                            <label class="flex items-center gap-2 cursor-pointer font-semibold text-slate-700">
                                <input type="checkbox" name="notify_candidate" value="1" checked class="w-4 h-4 rounded text-blue-900 focus:ring-blue-900 border-slate-300">
                                <span>Send email update to candidate</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full py-2.5 bg-blue-900 hover:bg-blue-950 text-white font-bold rounded-xl text-xs transition-colors shadow-xs">
                            Apply Status Update
                        </button>
                    </form>
                </div>

                <!-- Action 2: Schedule Interview Session -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-2xs space-y-4">
                    <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i data-lucide="calendar-plus" class="w-4 h-4 text-purple-600"></i>
                        <span>Schedule Interview Session</span>
                    </h3>

                    <form action="{{ route('admin.applicants.schedule_interview', $application->id) }}" method="POST" class="space-y-4 text-xs">
                        @csrf

                        <div>
                            <label for="scheduled_at" class="block font-bold text-slate-700 uppercase mb-1">Date & Time <span class="text-rose-500">*</span></label>
                            <input type="datetime-local" name="scheduled_at" id="scheduled_at" required
                                   class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                        </div>

                        <div>
                            <label for="location_type" class="block font-bold text-slate-700 uppercase mb-1">Session Format <span class="text-rose-500">*</span></label>
                            <select name="location_type" id="location_type" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                                <option value="Online Video Call">Online Video Call (Google Meet / Zoom)</option>
                                <option value="In-Person (HQ)">In-Person (Campus Headquarters)</option>
                                <option value="Phone Interview">Phone Interview</option>
                            </select>
                        </div>

                        <div>
                            <label for="meeting_link_or_venue" class="block font-bold text-slate-700 uppercase mb-1">Link or Venue <span class="text-rose-500">*</span></label>
                            <input type="text" name="meeting_link_or_venue" id="meeting_link_or_venue" required
                                   placeholder="https://meet.google.com/xyz or Room 402, Level 4"
                                   class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                        </div>

                        <div>
                            <label for="interviewer_names" class="block font-bold text-slate-700 uppercase mb-1">Panel Members <span class="text-rose-500">*</span></label>
                            <input type="text" name="interviewer_names" id="interviewer_names" required
                                   value="Talent Acquisition & Department Head"
                                   class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                        </div>

                        <div>
                            <label for="notes" class="block font-bold text-slate-700 uppercase mb-1">Instructions for Candidate</label>
                            <textarea name="notes" id="notes" rows="2" placeholder="Preparation notes, portfolio review instructions..."
                                      class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900"></textarea>
                        </div>

                        <div>
                            <label class="flex items-center gap-2 cursor-pointer font-semibold text-slate-700">
                                <input type="checkbox" name="send_invitation" value="1" checked class="w-4 h-4 rounded text-blue-900 focus:ring-blue-900 border-slate-300">
                                <span>Send interview invitation email</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full py-2.5 bg-purple-700 hover:bg-purple-800 text-white font-bold rounded-xl text-xs transition-colors shadow-xs">
                            Confirm & Log Interview
                        </button>
                    </form>
                </div>

                <!-- Action 3: Internal HR Confidential Notes -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-2xs space-y-4">
                    <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i data-lucide="lock" class="w-4 h-4 text-amber-500"></i>
                        <span>Confidential HR Notes</span>
                    </h3>
                    <p class="text-[11px] text-slate-400">
                        Visible strictly to authenticated HR personnel. Never disclosed on candidate tracking views.
                    </p>

                    <form action="{{ route('admin.applicants.update_notes', $application->id) }}" method="POST" class="space-y-3 text-xs">
                        @csrf
                        @method('PATCH')

                        <textarea name="internal_notes" rows="4" placeholder="Enter private reviewer remarks, salary expectations, interview impressions..."
                                  class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">{{ old('internal_notes', $application->internal_notes) }}</textarea>

                        <button type="submit" class="w-full py-2 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl text-xs transition-colors">
                            Save Internal Notes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
