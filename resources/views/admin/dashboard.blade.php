@extends('layouts.admin')

@section('page_title', 'Recruitment Overview')

@section('content')
    <div class="space-y-8">
        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-slate-950 via-slate-900 to-blue-950 rounded-3xl p-6 sm:p-8 text-white shadow-md relative overflow-hidden border border-slate-800">
            <div class="max-w-2xl space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-400">Recruitment Operations</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white">
                    Talent Acquisition Dashboard
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    Live candidate pipeline, vacancy publication statuses, and interview schedules for Olympia Education Malaysia.
                </p>
            </div>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('admin.vacancies.create') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs rounded-xl shadow-xs transition-colors flex items-center gap-1.5">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                    <span>Post New Vacancy</span>
                </a>
                <a href="{{ route('admin.applicants.index') }}" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 font-semibold text-xs rounded-xl transition-colors border border-slate-700 flex items-center gap-1.5">
                    <i data-lucide="users" class="w-4 h-4 text-blue-400"></i>
                    <span>Review Candidate Pool</span>
                </a>
            </div>
        </div>

        <!-- 5 Database-Driven Core Metrics -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Active Vacancies -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-2xs space-y-2">
                <div class="flex items-center justify-between text-slate-500 text-xs font-semibold">
                    <span>Active Vacancies</span>
                    <i data-lucide="briefcase" class="w-4 h-4 text-blue-600"></i>
                </div>
                <div class="text-3xl font-extrabold text-slate-900">{{ $totalActiveVacancies }}</div>
                <div class="text-[11px] text-slate-400 font-medium">{{ $totalVacancies }} total in database</div>
            </div>

            <!-- Total Applications -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-2xs space-y-2">
                <div class="flex items-center justify-between text-slate-500 text-xs font-semibold">
                    <span>Total Applications</span>
                    <i data-lucide="inbox" class="w-4 h-4 text-indigo-600"></i>
                </div>
                <div class="text-3xl font-extrabold text-slate-900">{{ $totalApplications }}</div>
                <div class="text-[11px] text-slate-400 font-medium">Logged candidates</div>
            </div>

            <!-- Awaiting Initial Review (Submitted) -->
            <div class="bg-white rounded-2xl border border-amber-200 p-5 shadow-2xs space-y-2 bg-amber-50/20">
                <div class="flex items-center justify-between text-amber-800 text-xs font-semibold">
                    <span>Awaiting Review</span>
                    <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
                </div>
                <div class="text-3xl font-extrabold text-amber-700">{{ $awaitingReviewCount }}</div>
                <div class="text-[11px] text-amber-600 font-medium">New submissions pending</div>
            </div>

            <!-- Shortlisted Candidates -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-2xs space-y-2">
                <div class="flex items-center justify-between text-slate-500 text-xs font-semibold">
                    <span>Shortlisted</span>
                    <i data-lucide="user-check" class="w-4 h-4 text-purple-600"></i>
                </div>
                <div class="text-3xl font-extrabold text-purple-700">{{ $shortlistedCount }}</div>
                <div class="text-[11px] text-slate-400 font-medium">Qualified for interviews</div>
            </div>

            <!-- Upcoming Interviews Recorded -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-2xs space-y-2">
                <div class="flex items-center justify-between text-slate-500 text-xs font-semibold">
                    <span>Scheduled Sessions</span>
                    <i data-lucide="calendar" class="w-4 h-4 text-emerald-600"></i>
                </div>
                <div class="text-3xl font-extrabold text-emerald-700">{{ $upcomingInterviews->count() }}</div>
                <div class="text-[11px] text-slate-400 font-medium">Active upcoming panels</div>
            </div>
        </div>

        <!-- Two Column Section: Recent Applications & Upcoming Interviews -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Recent Applications Table -->
            <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-2xs space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Recent Candidate Applications</h3>
                        <p class="text-xs text-slate-500">Latest applicants received across active vacancies.</p>
                    </div>
                    <a href="{{ route('admin.applicants.index') }}" class="text-xs font-bold text-blue-900 hover:text-amber-600 transition-colors flex items-center gap-1">
                        <span>View All ({{ $totalApplications }})</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>

                @if ($recentApplications->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-semibold border-y border-slate-100">
                                <tr>
                                    <th class="py-3 px-3">Ref</th>
                                    <th class="py-3 px-3">Candidate</th>
                                    <th class="py-3 px-3">Vacancy Applied</th>
                                    <th class="py-3 px-3">Status</th>
                                    <th class="py-3 px-3 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($recentApplications as $app)
                                    <tr class="hover:bg-slate-50/80 transition-colors">
                                        <td class="py-3 px-3 font-mono font-bold text-amber-700">
                                            {{ $app->reference_number }}
                                        </td>
                                        <td class="py-3 px-3 font-semibold text-slate-900">
                                            {{ $app->full_name }}
                                            <div class="text-[11px] text-slate-400 font-normal">{{ $app->email }}</div>
                                        </td>
                                        <td class="py-3 px-3 text-slate-700">
                                            {{ $app->jobVacancy?->title ?? 'General' }}
                                            <div class="text-[11px] text-slate-400">{{ $app->application_type }}</div>
                                        </td>
                                        <td class="py-3 px-3">
                                            <span class="inline-flex px-2 py-0.5 rounded-full text-[11px] font-bold border {{ $app->status_badge_class }}">
                                                {{ $app->status }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-3 text-right">
                                            <a href="{{ route('admin.applicants.show', $app->id) }}" class="px-3 py-1.5 bg-blue-900 hover:bg-blue-950 text-white font-semibold rounded-lg text-[11px] transition-colors inline-block">
                                                Review
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-xs text-slate-500">
                        No candidate applications recorded yet.
                    </div>
                @endif
            </div>

            <!-- Upcoming Interviews Sidebar Card -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-2xs space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="calendar" class="w-4 h-4 text-emerald-600"></i>
                            <span>Upcoming Interviews</span>
                        </h3>
                        <span class="text-xs text-slate-400 font-medium">{{ $upcomingInterviews->count() }}</span>
                    </div>

                    @if ($upcomingInterviews->count() > 0)
                        <div class="space-y-3">
                            @foreach ($upcomingInterviews as $item)
                                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold text-slate-900">{{ $item->application?->full_name }}</span>
                                        <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                                            {{ $item->status }}
                                        </span>
                                    </div>
                                    <div class="text-[11px] text-slate-600">
                                        <strong>Position:</strong> {{ $item->application?->jobVacancy?->title ?? 'N/A' }}
                                    </div>
                                    <div class="text-[11px] text-amber-700 font-semibold flex items-center gap-1.5">
                                        <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                        <span>{{ $item->scheduled_at->format('d M, h:i A') }} ({{ $item->location_type }})</span>
                                    </div>
                                    <div class="pt-1 text-[11px] text-slate-500 border-t border-slate-200/60 flex justify-between items-center">
                                        <span>Panel: {{ Str::limit($item->interviewer_names, 22) }}</span>
                                        <a href="{{ route('admin.applicants.show', $item->application_id) }}" class="text-blue-900 font-bold hover:underline">
                                            Open &rarr;
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-6 text-center text-xs text-slate-500 bg-slate-50 rounded-2xl">
                            No upcoming interview sessions scheduled.
                        </div>
                    @endif
                </div>

                <!-- Department Vacancy Breakdown -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-2xs space-y-4">
                    <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3">
                        Vacancies By Department
                    </h3>
                    <div class="space-y-2 text-xs">
                        @foreach ($departmentStats as $dept)
                            <div class="flex items-center justify-between py-1.5 border-b border-slate-50">
                                <span class="text-slate-600">{{ $dept->department }}</span>
                                <span class="font-bold text-slate-900 bg-slate-100 px-2 py-0.5 rounded">
                                    {{ $dept->total }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
