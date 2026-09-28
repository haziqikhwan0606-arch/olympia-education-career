@extends('layouts.app')

@section('title', 'Olympia Education Career | Discover Your Next Opportunity')
@section('meta_description', 'Explore career and internship opportunities with Olympia Education Malaysia. Shape academic excellence and future talent.')

@section('content')
    <!-- Hero Section -->
    <section class="bg-slate-950 text-white py-16 sm:py-20 border-b border-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                <!-- Hero Left: Content & Search -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 border border-slate-800 text-xs text-slate-300">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        <span>Now Hiring &bull; Academic &bull; Professional &bull; Internships</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                        Discover Your Next <br class="hidden sm:inline">
                        <span class="text-amber-400">Opportunity.</span>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-300 leading-relaxed max-w-xl mx-auto lg:mx-0">
                        Build your future with Olympia Education Malaysia. Join a community of educators, innovators, and professionals shaping higher education.
                    </p>

                    <!-- Search Bar -->
                    <form action="{{ route('careers.index') }}" method="GET" class="pt-2 max-w-xl mx-auto lg:mx-0">
                        <div class="p-1.5 bg-white rounded-2xl shadow-lg flex flex-col sm:flex-row gap-2 border border-slate-200">
                            <div class="flex-1 relative flex items-center pl-3">
                                <i data-lucide="search" class="w-4 h-4 text-slate-400"></i>
                                <input type="text" name="search" placeholder="Search by job title, skill, or keyword..."
                                       class="w-full bg-transparent border-0 text-slate-900 placeholder-slate-400 text-sm focus:ring-0 focus:outline-none pl-2 py-2">
                            </div>
                            <button type="submit" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-semibold text-xs rounded-xl transition-colors flex items-center justify-center gap-1.5 shrink-0">
                                <span>Find Jobs</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-amber-400"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Quick Links & Actions -->
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-1 text-xs">
                        <div class="text-slate-400">
                            <span class="text-slate-500 font-medium">Popular:</span>
                            <a href="{{ route('careers.index', ['search' => 'Lecturer']) }}" class="text-slate-300 hover:text-white underline ml-1">Lecturer</a>,
                            <a href="{{ route('careers.index', ['search' => 'Executive']) }}" class="text-slate-300 hover:text-white underline ml-1">Executive</a>,
                            <a href="{{ route('internships') }}" class="text-slate-300 hover:text-white underline ml-1">Internships</a>
                        </div>
                        <span class="hidden sm:inline text-slate-700">&bull;</span>
                        <a href="{{ route('careers.index') }}" class="text-amber-400 hover:text-amber-300 font-semibold flex items-center gap-1">
                            <span>Browse All Vacancies</span>
                            <i data-lucide="arrow-right" class="w-3 h-3"></i>
                        </a>
                    </div>
                </div>

                <!-- Hero Right: Campus Visual -->
                <div class="lg:col-span-5">
                    <div class="relative rounded-2xl overflow-hidden shadow-xl border border-slate-800 bg-slate-900 group">
                        <img src="{{ asset('images/campus-hero.jpg') }}" alt="Olympia Education Campus Life"
                             class="w-full h-72 sm:h-84 object-cover object-center group-hover:scale-102 transition-transform duration-500">
                        
                        <!-- Minimal Bottom Glass Bar -->
                        <div class="absolute bottom-3 left-3 right-3 p-3 rounded-xl bg-slate-950/85 backdrop-blur-md border border-slate-800 text-xs text-white flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                <span class="font-medium text-slate-200">Petaling Jaya Campus</span>
                            </div>
                            <span class="font-bold text-amber-400">{{ \App\Models\JobVacancy::open()->count() }} Openings</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Metrics Bar -->
    <div class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100">
                <div class="pt-2 md:pt-0">
                    <div class="text-2xl font-bold text-slate-900">{{ \App\Models\JobVacancy::open()->count() }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">Active Vacancies</div>
                </div>
                <div class="pt-2 md:pt-0">
                    <div class="text-2xl font-bold text-slate-900">{{ $typeCounts['Internship'] ?? 0 }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">Internship Placements</div>
                </div>
                <div class="pt-2 md:pt-0">
                    <div class="text-2xl font-bold text-slate-900">4</div>
                    <div class="text-xs text-slate-500 mt-0.5">Academic Faculties</div>
                </div>
                <div class="pt-2 md:pt-0">
                    <div class="text-2xl font-bold text-slate-900">100%</div>
                    <div class="text-xs text-slate-500 mt-0.5">Online Status Tracking</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Career Categories -->
    <section class="py-14 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Pathways</span>
                    <h2 class="text-2xl font-bold text-slate-900 mt-1">Explore Opportunity Types</h2>
                </div>
                <p class="text-xs text-slate-500 max-w-sm mt-1 sm:mt-0">
                    Discover flexible roles across academic faculties, corporate administration, and student attachments.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Full-Time -->
                <a href="{{ route('careers.index', ['type' => 'Full-Time']) }}" class="p-5 rounded-xl bg-white hover:bg-slate-50 border border-slate-200 transition-colors shadow-2xs group">
                    <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center mb-3 group-hover:bg-slate-900 group-hover:text-amber-400 transition-colors">
                        <i data-lucide="briefcase" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Full-Time</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Academic faculty, department leads, and corporate administrative appointments.
                    </p>
                    <div class="mt-3 text-xs font-semibold text-slate-700 flex items-center justify-between">
                        <span>{{ $typeCounts['Full-Time'] ?? 0 }} Available</span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                    </div>
                </a>

                <!-- Internship -->
                <a href="{{ route('internships') }}" class="p-5 rounded-xl bg-white hover:bg-slate-50 border border-slate-200 transition-colors shadow-2xs group">
                    <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center mb-3 group-hover:bg-slate-900 group-hover:text-amber-400 transition-colors">
                        <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Internships</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Accredited undergraduate attachments and structured mentorship programs.
                    </p>
                    <div class="mt-3 text-xs font-semibold text-slate-700 flex items-center justify-between">
                        <span>{{ $typeCounts['Internship'] ?? 0 }} Placements</span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                    </div>
                </a>

                <!-- Part-Time -->
                <a href="{{ route('careers.index', ['type' => 'Part-Time']) }}" class="p-5 rounded-xl bg-white hover:bg-slate-50 border border-slate-200 transition-colors shadow-2xs group">
                    <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center mb-3 group-hover:bg-slate-900 group-hover:text-amber-400 transition-colors">
                        <i data-lucide="clock" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Part-Time</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Adjunct lecturing, teaching assistants, and flexible campus coordination.
                    </p>
                    <div class="mt-3 text-xs font-semibold text-slate-700 flex items-center justify-between">
                        <span>{{ $typeCounts['Part-Time'] ?? 0 }} Roles</span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                    </div>
                </a>

                <!-- Contract -->
                <a href="{{ route('careers.index', ['type' => 'Contract']) }}" class="p-5 rounded-xl bg-white hover:bg-slate-50 border border-slate-200 transition-colors shadow-2xs group">
                    <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center mb-3 group-hover:bg-slate-900 group-hover:text-amber-400 transition-colors">
                        <i data-lucide="file-badge" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Contract</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Specialized institutional initiatives, curriculum projects, and research grants.
                    </p>
                    <div class="mt-3 text-xs font-semibold text-slate-700 flex items-center justify-between">
                        <span>{{ $typeCounts['Contract'] ?? 0 }} Roles</span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Opportunities Section -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Active Recruitment</span>
                    <h2 class="text-3xl font-extrabold text-slate-900 mt-1">Featured Opportunities</h2>
                    <p class="text-sm text-slate-500 mt-1">Currently open vacancies actively accepting candidate submissions.</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('careers.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-900 hover:text-amber-600 transition-colors">
                        <span>View All {{ \App\Models\JobVacancy::open()->count() }} Open Vacancies</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            <!-- Job Cards Grid -->
            @if ($featuredJobs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($featuredJobs as $job)
                        <div class="bg-white rounded-2xl border border-slate-200 p-6 flex flex-col justify-between hover:shadow-md transition-shadow group">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span class="text-[11px] font-semibold text-slate-500 bg-slate-100 px-2.5 py-0.5 rounded-md">
                                        {{ $job->department }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($job->employment_type === 'Internship') bg-amber-50 text-amber-700
                                        @elseif($job->employment_type === 'Full-Time') bg-blue-50 text-blue-700
                                        @elseif($job->employment_type === 'Part-Time') bg-emerald-50 text-emerald-700
                                        @else bg-purple-50 text-purple-700 @endif">
                                        {{ $job->employment_type }}
                                    </span>
                                </div>

                                <h3 class="text-base font-bold text-slate-900 group-hover:text-blue-900 transition-colors line-clamp-1">
                                    <a href="{{ route('careers.show', $job->slug) }}">
                                        {{ $job->title }}
                                    </a>
                                </h3>

                                <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">
                                    {{ $job->summary ?? Str::limit(strip_tags($job->description), 110) }}
                                </p>

                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                                    <div class="flex items-center gap-1.5 truncate">
                                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-400 shrink-0"></i>
                                        <span class="truncate">{{ $job->location }}</span>
                                    </div>
                                    @if ($job->closing_date)
                                        <span class="text-[11px] text-amber-700 font-medium">Closes {{ $job->closing_date->format('d M') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between gap-3">
                                <a href="{{ route('careers.show', $job->slug) }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">
                                    View Details
                                </a>
                                <a href="{{ route('applications.create', $job->slug) }}" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white font-semibold text-xs rounded-xl transition-colors flex items-center gap-1.5">
                                    <span>Apply</span>
                                    <i data-lucide="arrow-right" class="w-3 h-3 text-amber-400"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center max-w-lg mx-auto">
                    <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="briefcase" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-800">No Current Open Vacancies</h3>
                    <p class="text-xs text-slate-500 mt-1">Check back soon or submit a general inquiry via our contact portal.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Why Olympia Education Section -->
    <section class="py-16 bg-white border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-6 rounded-2xl overflow-hidden border border-slate-200 bg-slate-100">
                    <img src="{{ asset('images/academic-team.jpg') }}" alt="Olympia Academic Leadership"
                         class="w-full h-80 sm:h-96 object-cover object-center">
                </div>
                <div class="lg:col-span-6 space-y-5">
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Why Join Olympia</span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">
                            A Collaborative Culture Built on Academic Distinction
                        </h2>
                    </div>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        At Olympia Education Malaysia, our faculty members, academic coordinators, and corporate staff work closely to deliver modern curricula, student empowerment, and accredited higher education.
                    </p>
                    <div class="space-y-3 pt-1">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="check" class="w-3.5 h-3.5"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-slate-900">Pedagogical Mentorship & Support</h4>
                                <p class="text-xs text-slate-500">Classroom technology, research opportunities, and professional development.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="check" class="w-3.5 h-3.5"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-slate-900">Industry-Aligned Programs</h4>
                                <p class="text-xs text-slate-500">Collaborating with corporate leaders to equip students for evolving job markets.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="check" class="w-3.5 h-3.5"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-slate-900">Structured Career Progression</h4>
                                <p class="text-xs text-slate-500">Clear pathways for lecturing promotions, tenure, and administrative appointments.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Transparent Hiring Journey (5 Steps) -->
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-12">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Candidate Experience</span>
                <h2 class="text-2xl font-bold text-slate-900 mt-1">Our Transparent Hiring Journey</h2>
                <p class="text-xs text-slate-500 mt-1.5">
                    Clear milestones from application submission to onboarding.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Step 1 -->
                <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-2xs">
                    <div class="text-xs font-bold text-amber-600 mb-2">Step 01</div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">Discover</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Explore open faculty, administrative, or internship openings.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-2xs">
                    <div class="text-xs font-bold text-amber-600 mb-2">Step 02</div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">Apply Online</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Submit candidate details, upload PDF resume, and get a reference code.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-2xs">
                    <div class="text-xs font-bold text-amber-600 mb-2">Step 03</div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">HR Review</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Hiring managers and HR assess qualifications against criteria.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-2xs">
                    <div class="text-xs font-bold text-amber-600 mb-2">Step 04</div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">Interview</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Shortlisted candidates meet the academic panel on campus or online.
                    </p>
                </div>

                <!-- Step 5 -->
                <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-2xs">
                    <div class="text-xs font-bold text-amber-600 mb-2">Step 05</div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">Outcome</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Appointment offer extended with comprehensive onboarding guidelines.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tracking Callout Banner -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="rounded-3xl bg-slate-950 text-white p-8 sm:p-10 border border-slate-800 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl">
            <div class="space-y-1.5 text-center md:text-left">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-400">Application Tracking</span>
                <h3 class="text-xl sm:text-2xl font-bold text-white">Already applied for a role?</h3>
                <p class="text-xs sm:text-sm text-slate-400 max-w-lg">
                    Track your recruitment progress, interview schedule, and status milestones live using your reference code.
                </p>
            </div>
            <a href="{{ route('tracking.index') }}" class="px-6 py-3 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs rounded-xl transition-colors shadow-sm shrink-0 flex items-center gap-2">
                <i data-lucide="compass" class="w-4 h-4"></i>
                <span>Track Your Application</span>
            </a>
        </div>
    </div>
@endsection
