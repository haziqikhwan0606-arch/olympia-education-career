@extends('layouts.app')

@section('title', $vacancy->title . ' | Olympia Education Career')
@section('meta_description', Str::limit(strip_tags($vacancy->description), 150))

@section('content')
    <!-- Top Breadcrumbs -->
    <div class="bg-slate-100 border-b border-slate-200 py-3 text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-blue-900">Home</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
            <a href="{{ route('careers.index') }}" class="hover:text-blue-900">Careers</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
            <span class="text-slate-900 font-medium truncate max-w-md">{{ $vacancy->title }}</span>
        </div>
    </div>

    <!-- Job Header Card -->
    <div class="bg-slate-900 text-white py-12 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="space-y-3 max-w-3xl">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-400 bg-slate-800 px-3 py-1 rounded-md border border-slate-700">
                            {{ $vacancy->department }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                            @if($vacancy->employment_type === 'Internship') bg-amber-500/20 text-amber-300 border border-amber-500/30
                            @elseif($vacancy->employment_type === 'Full-Time') bg-blue-500/20 text-blue-300 border border-blue-500/30
                            @else bg-purple-500/20 text-purple-300 border border-purple-500/30 @endif">
                            {{ $vacancy->employment_type }}
                        </span>

                        @if (!$vacancy->isOpen())
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-rose-500/20 text-rose-300 border border-rose-500/30">
                                <i data-lucide="lock" class="w-3 h-3"></i>
                                <span>Vacancy Closed</span>
                            </span>
                        @endif
                    </div>

                    <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white">
                        {{ $vacancy->title }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-6 text-xs text-slate-300 pt-1">
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="map-pin" class="w-4 h-4 text-amber-400"></i>
                            <span>{{ $vacancy->location }}</span>
                        </div>
                        @if ($vacancy->salary_range)
                            <div class="flex items-center gap-1.5">
                                <i data-lucide="banknote" class="w-4 h-4 text-emerald-400"></i>
                                <span class="font-medium text-emerald-300">{{ $vacancy->salary_range }}</span>
                            </div>
                        @endif
                        @if ($vacancy->published_at)
                            <div class="flex items-center gap-1.5">
                                <i data-lucide="clock" class="w-4 h-4 text-slate-400"></i>
                                <span>Published: {{ $vacancy->published_at->format('d M Y') }}</span>
                            </div>
                        @endif
                        @if ($vacancy->closing_date)
                            <div class="flex items-center gap-1.5 text-amber-300">
                                <i data-lucide="calendar" class="w-4 h-4 text-amber-400"></i>
                                <span>Closing Date: {{ $vacancy->closing_date->format('d M Y') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- CTA Column -->
                <div class="shrink-0 flex flex-col sm:flex-row items-center gap-3">
                    @if ($vacancy->isOpen())
                        <a href="{{ route('applications.create', $vacancy->slug) }}" class="w-full sm:w-auto px-8 py-3.5 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm rounded-xl transition-all shadow-lg shadow-amber-500/20 flex items-center justify-center gap-2">
                            <span>Apply for This Role</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    @else
                        <div class="p-3 bg-rose-950/60 border border-rose-800/40 rounded-xl text-xs text-rose-300 flex items-center gap-2">
                            <i data-lucide="alert-circle" class="w-4 h-4 text-rose-400"></i>
                            <span>This position has closed and is no longer accepting new submissions.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content & Sidebar Layout -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- Left: Job Details Content -->
            <div class="lg:col-span-8 space-y-10">
                <!-- Overview -->
                <section class="bg-white rounded-2xl border border-slate-200 p-8 shadow-2xs space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i data-lucide="file-text" class="w-5 h-5 text-blue-900"></i>
                        <span>About the Role</span>
                    </h2>
                    <div class="text-sm text-slate-700 leading-relaxed space-y-4 whitespace-pre-line">
                        {{ $vacancy->description }}
                    </div>
                </section>

                <!-- Responsibilities -->
                <section class="bg-white rounded-2xl border border-slate-200 p-8 shadow-2xs space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i data-lucide="check-square" class="w-5 h-5 text-emerald-600"></i>
                        <span>Key Responsibilities</span>
                    </h2>
                    <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                        {{ $vacancy->responsibilities }}
                    </div>
                </section>

                <!-- Qualifications -->
                <section class="bg-white rounded-2xl border border-slate-200 p-8 shadow-2xs space-y-4">
                    <h2 class="text-xl font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i data-lucide="graduation-cap" class="w-5 h-5 text-amber-500"></i>
                        <span>Qualifications & Prerequisites</span>
                    </h2>
                    <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                        {{ $vacancy->qualifications }}
                    </div>
                </section>

                <!-- Additional Requirements (if specified) -->
                @if ($vacancy->requirements)
                    <section class="bg-white rounded-2xl border border-slate-200 p-8 shadow-2xs space-y-4">
                        <h2 class="text-xl font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                            <i data-lucide="list-plus" class="w-5 h-5 text-purple-600"></i>
                            <span>Departmental Requirements</span>
                        </h2>
                        <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                            {{ $vacancy->requirements }}
                        </div>
                    </section>
                @endif

                <!-- Application Instructions -->
                <section class="bg-blue-50/50 rounded-2xl border border-blue-200 p-8 space-y-3">
                    <h2 class="text-lg font-bold text-blue-950 flex items-center gap-2">
                        <i data-lucide="help-circle" class="w-5 h-5 text-blue-800"></i>
                        <span>Application Instructions</span>
                    </h2>
                    <p class="text-xs text-blue-900 leading-relaxed">
                        To submit your application, please click the <strong>Apply for This Role</strong> button. You will be prompted to fill out your academic and professional profile and attach your Curriculum Vitae (PDF format, maximum 5MB). Upon successful submission, you will receive a unique Application Reference Code (e.g. <code>OEC-2026-XXXXX</code>) to monitor the progress of your application.
                    </p>
                    @if ($vacancy->isOpen())
                        <div class="pt-2">
                            <a href="{{ route('applications.create', $vacancy->slug) }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-blue-900 hover:bg-blue-950 text-white font-semibold text-xs rounded-xl shadow-xs transition-colors">
                                <span>Proceed to Online Application</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-amber-400"></i>
                            </a>
                        </div>
                    @endif
                </section>
            </div>

            <!-- Right Sidebar: Summary Box & Related Roles -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Vacancy Summary Card -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs space-y-4 sticky top-28">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 border-b border-slate-100 pb-3">
                        Vacancy Summary
                    </h3>

                    <div class="space-y-3 text-xs">
                        <div class="flex items-start justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-500">Employment Type:</span>
                            <span class="font-bold text-slate-900 text-right">{{ $vacancy->employment_type }}</span>
                        </div>
                        <div class="flex items-start justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-500">Department:</span>
                            <span class="font-bold text-slate-900 text-right">{{ $vacancy->department }}</span>
                        </div>
                        <div class="flex items-start justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-500">Location:</span>
                            <span class="font-bold text-slate-900 text-right">{{ $vacancy->location }}</span>
                        </div>

                        @if ($vacancy->internship_duration)
                            <div class="flex items-start justify-between py-1 border-b border-slate-50">
                                <span class="text-slate-500">Internship Duration:</span>
                                <span class="font-bold text-amber-700 text-right">{{ $vacancy->internship_duration }}</span>
                            </div>
                        @endif

                        @if ($vacancy->internship_start_date)
                            <div class="flex items-start justify-between py-1 border-b border-slate-50">
                                <span class="text-slate-500">Expected Intake:</span>
                                <span class="font-bold text-slate-900 text-right">{{ $vacancy->internship_start_date->format('d M Y') }}</span>
                            </div>
                        @endif

                        @if ($vacancy->salary_range)
                            <div class="flex items-start justify-between py-1 border-b border-slate-50">
                                <span class="text-slate-500">Salary / Allowance:</span>
                                <span class="font-bold text-emerald-700 text-right">{{ $vacancy->salary_range }}</span>
                            </div>
                        @endif

                        <div class="flex items-start justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-500">Application Deadline:</span>
                            <span class="font-bold text-slate-900 text-right">
                                {{ $vacancy->closing_date ? $vacancy->closing_date->format('d M Y') : 'Open Until Filled' }}
                            </span>
                        </div>

                        <div class="flex items-start justify-between py-1">
                            <span class="text-slate-500">Status:</span>
                            @if ($vacancy->isOpen())
                                <span class="font-bold text-emerald-600 flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <span>Accepting Applications</span>
                                </span>
                            @else
                                <span class="font-bold text-rose-600 flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                    <span>Closed</span>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        @if ($vacancy->isOpen())
                            <a href="{{ route('applications.create', $vacancy->slug) }}" class="w-full px-5 py-3 bg-blue-900 hover:bg-blue-950 text-white font-bold text-xs rounded-xl shadow-xs transition-colors flex items-center justify-center gap-2">
                                <span>Apply Now</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-amber-400"></i>
                            </a>
                        @else
                            <button disabled class="w-full px-5 py-3 bg-slate-200 text-slate-500 font-medium text-xs rounded-xl cursor-not-allowed">
                                Vacancy Closed
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Related Vacancies Card -->
                @if ($relatedJobs->count() > 0)
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs space-y-4">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700">Similar Opportunities</h3>
                        <div class="space-y-3">
                            @foreach ($relatedJobs as $rel)
                                <a href="{{ route('careers.show', $rel->slug) }}" class="block p-3 rounded-xl hover:bg-slate-50 border border-transparent hover:border-slate-200 transition-all">
                                    <div class="text-xs font-bold text-slate-900 hover:text-blue-900">{{ $rel->title }}</div>
                                    <div class="text-[11px] text-slate-500 flex items-center gap-2 mt-1">
                                        <span>{{ $rel->department }}</span>
                                        <span>&bull;</span>
                                        <span class="text-amber-700 font-semibold">{{ $rel->employment_type }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
