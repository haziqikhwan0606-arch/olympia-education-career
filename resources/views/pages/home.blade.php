@extends('layouts.app')

@section('title', 'Olympia Education Career | Discover Your Next Opportunity')
@section('meta_description', 'Explore career and internship opportunities with Olympia Education Malaysia. Shape academic excellence and future talent.')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white overflow-hidden py-24 sm:py-32">
        <!-- Subtle Grid Pattern & Ambient Glow -->
        <div class="absolute inset-0 bg-pattern-grid opacity-30"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Hero Left: Text & CTAs -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3">
                        <div class="bg-white px-3 py-1.5 rounded-xl shadow-sm border border-slate-200 inline-flex items-center">
                            <img src="{{ asset('images/logo.png') }}" alt="Olympia Education Malaysia" class="h-7 w-auto object-contain">
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-800/90 border border-slate-700/80 text-xs font-semibold text-amber-400">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Talent Acquisition &bull; Malaysia</span>
                        </div>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                        Discover Your Next <br class="hidden sm:inline">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-amber-300 to-orange-400">
                            Opportunity.
                        </span>
                    </h1>

                    <p class="text-lg sm:text-xl text-slate-300 leading-relaxed max-w-2xl mx-auto lg:mx-0 font-normal">
                        Build your future with Olympia Education Malaysia. Join a progressive community of educators, innovators, and academic professionals shaping Malaysia's next generation of graduates.
                    </p>

                    <!-- Interactive Quick Search Bar -->
                    <form action="{{ route('careers.index') }}" method="GET" class="pt-4 max-w-xl mx-auto lg:mx-0">
                        <div class="p-2 bg-slate-900/90 backdrop-blur-md rounded-2xl border border-slate-700/80 shadow-2xl flex flex-col sm:flex-row gap-2">
                            <div class="flex-1 relative flex items-center pl-3">
                                <i data-lucide="search" class="w-5 h-5 text-slate-400"></i>
                                <input type="text" name="search" placeholder="Job title, skill, or keyword..."
                                       class="w-full bg-transparent border-0 text-white placeholder-slate-400 text-sm focus:ring-0 focus:outline-none pl-2 py-2">
                            </div>
                            <button type="submit" class="px-6 py-3 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm rounded-xl transition-all shadow-md shadow-amber-500/20 flex items-center justify-center gap-2">
                                <span>Search</span>
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </form>

                    <!-- CTAs -->
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="{{ route('careers.index') }}" class="px-6 py-3.5 rounded-xl bg-blue-700 hover:bg-blue-600 text-white font-semibold text-sm transition-all shadow-lg shadow-blue-900/30 flex items-center gap-2 border border-blue-500/30">
                            <i data-lucide="briefcase" class="w-4 h-4"></i>
                            <span>Explore All Vacancies</span>
                        </a>
                        <a href="{{ route('internships') }}" class="px-6 py-3.5 rounded-xl bg-slate-800/80 hover:bg-slate-700 text-slate-200 font-semibold text-sm transition-all border border-slate-700 flex items-center gap-2">
                            <i data-lucide="graduation-cap" class="w-4 h-4 text-amber-400"></i>
                            <span>Undergraduate Internships</span>
                        </a>
                    </div>
                </div>

                <!-- Hero Right: Real Campus Visual & Highlights -->
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-lg lg:max-w-none">
                        <!-- Campus Photo Frame with Glow & Glass Badges -->
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl border-2 border-slate-700/60 group">
                            <img src="{{ asset('images/campus-hero.jpg') }}" alt="Olympia Education Campus Life & Collaboration"
                                 class="w-full h-80 sm:h-96 object-cover object-center group-hover:scale-105 transition-transform duration-700">

                            <!-- Gradient Vignette -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>

                            <!-- Top Floating Badge -->
                            <div class="absolute top-4 left-4 right-4 flex items-center justify-between pointer-events-none">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-900/80 backdrop-blur-md text-[11px] font-bold text-amber-400 border border-slate-700/80 shadow-md">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                    <span>Petaling Jaya Campus &bull; Malaysia</span>
                                </span>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-blue-950/80 backdrop-blur-md text-[11px] font-semibold text-blue-300 border border-blue-800/60 shadow-md">
                                    <i data-lucide="shield-check" class="w-3.5 h-3.5 text-amber-400"></i>
                                    <span>Private CV Storage</span>
                                </span>
                            </div>

                            <!-- Bottom Overlay Card with Live Metrics -->
                            <div class="absolute bottom-4 left-4 right-4 p-4 rounded-2xl bg-slate-900/90 backdrop-blur-md border border-slate-700/80 shadow-xl space-y-3">
                                <div class="flex items-center justify-between text-xs border-b border-slate-700/60 pb-2">
                                    <span class="font-bold text-white uppercase tracking-wider text-[11px]">Olympia Career Snapshot</span>
                                    <span class="text-amber-400 font-semibold">{{ \App\Models\JobVacancy::open()->count() }} Openings</span>
                                </div>
                                <div class="grid grid-cols-3 gap-2 text-center">
                                    <div class="p-2 rounded-xl bg-slate-950/60 border border-slate-800">
                                        <div class="text-base font-extrabold text-amber-400">{{ \App\Models\JobVacancy::open()->count() }}</div>
                                        <div class="text-[10px] text-slate-400">Vacancies</div>
                                    </div>
                                    <div class="p-2 rounded-xl bg-slate-950/60 border border-slate-800">
                                        <div class="text-base font-extrabold text-blue-400">{{ $typeCounts['Internship'] ?? 0 }}</div>
                                        <div class="text-[10px] text-slate-400">Internships</div>
                                    </div>
                                    <div class="p-2 rounded-xl bg-slate-950/60 border border-slate-800">
                                        <div class="text-base font-extrabold text-emerald-400">100%</div>
                                        <div class="text-[10px] text-slate-400">Trackable</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Career Categories -->
    <section class="py-16 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Career Pathways</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">Explore Opportunity Types</h2>
                </div>
                <p class="text-sm text-slate-500 max-w-md mt-2 md:mt-0">
                    Find the career arrangement that matches your aspirations, from leadership lecturing roles to structured student internships.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Full-Time -->
                <a href="{{ route('careers.index', ['type' => 'Full-Time']) }}" class="group p-6 rounded-2xl bg-slate-50 hover:bg-blue-50/50 border border-slate-200/80 hover:border-blue-200 transition-all duration-200 shadow-2xs hover:shadow-md">
                    <div class="w-12 h-12 rounded-xl bg-blue-900 text-amber-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="briefcase" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-900">Full-Time Careers</h3>
                    <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">
                        Academic faculty, corporate specialists, and campus management roles.
                    </p>
                    <div class="mt-4 flex items-center justify-between text-xs font-semibold text-blue-900">
                        <span>{{ $typeCounts['Full-Time'] ?? 0 }} Available</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>

                <!-- Internship -->
                <a href="{{ route('internships') }}" class="group p-6 rounded-2xl bg-slate-50 hover:bg-amber-50/50 border border-slate-200/80 hover:border-amber-200 transition-all duration-200 shadow-2xs hover:shadow-md">
                    <div class="w-12 h-12 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-amber-700">Undergraduate Internships</h3>
                    <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">
                        Structured university-accredited training programs across faculties.
                    </p>
                    <div class="mt-4 flex items-center justify-between text-xs font-semibold text-amber-700">
                        <span>{{ $typeCounts['Internship'] ?? 0 }} Placements</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>

                <!-- Part-Time -->
                <a href="{{ route('careers.index', ['type' => 'Part-Time']) }}" class="group p-6 rounded-2xl bg-slate-50 hover:bg-emerald-50/50 border border-slate-200/80 hover:border-emerald-200 transition-all duration-200 shadow-2xs hover:shadow-md">
                    <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="clock" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-700">Part-Time & Adjunct</h3>
                    <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">
                        Flexible guest lecturing, tutoring, and campus event coordination.
                    </p>
                    <div class="mt-4 flex items-center justify-between text-xs font-semibold text-emerald-700">
                        <span>{{ $typeCounts['Part-Time'] ?? 0 }} Positions</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>

                <!-- Contract -->
                <a href="{{ route('careers.index', ['type' => 'Contract']) }}" class="group p-6 rounded-2xl bg-slate-50 hover:bg-purple-50/50 border border-slate-200/80 hover:border-purple-200 transition-all duration-200 shadow-2xs hover:shadow-md">
                    <div class="w-12 h-12 rounded-xl bg-purple-600 text-white flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="file-badge" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-purple-700">Project & Contract</h3>
                    <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">
                        Specialized institutional initiatives, EdTech rollouts, and research.
                    </p>
                    <div class="mt-4 flex items-center justify-between text-xs font-semibold text-purple-700">
                        <span>{{ $typeCounts['Contract'] ?? 0 }} Roles</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
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
                        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 flex flex-col justify-between hover:shadow-lg transition-all duration-200 group hover:border-blue-300">
                            <div>
                                <!-- Department and Type Badges -->
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2.5 py-1 rounded-md">
                                        {{ $job->department }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                        @if($job->employment_type === 'Internship') bg-amber-50 text-amber-700 border border-amber-200
                                        @elseif($job->employment_type === 'Full-Time') bg-blue-50 text-blue-700 border border-blue-200
                                        @elseif($job->employment_type === 'Part-Time') bg-emerald-50 text-emerald-700 border border-emerald-200
                                        @else bg-purple-50 text-purple-700 border border-purple-200 @endif">
                                        {{ $job->employment_type }}
                                    </span>
                                </div>

                                <!-- Job Title -->
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-900 transition-colors line-clamp-2">
                                    <a href="{{ route('careers.show', $job->slug) }}">
                                        {{ $job->title }}
                                    </a>
                                </h3>

                                <!-- Summary -->
                                <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">
                                    {{ $job->summary ?? Str::limit(strip_tags($job->description), 110) }}
                                </p>

                                <!-- Meta Info -->
                                <div class="mt-4 pt-4 border-t border-slate-100 space-y-2 text-xs text-slate-600">
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-400 shrink-0"></i>
                                        <span class="truncate">{{ $job->location }}</span>
                                    </div>

                                    @if ($job->salary_range)
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="banknote" class="w-3.5 h-3.5 text-slate-400 shrink-0"></i>
                                            <span class="font-medium text-slate-700">{{ $job->salary_range }}</span>
                                        </div>
                                    @endif

                                    @if ($job->closing_date)
                                        <div class="flex items-center gap-2 text-amber-700">
                                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-amber-500 shrink-0"></i>
                                            <span>Closes: {{ $job->closing_date->format('d M Y') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Action -->
                            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between gap-3">
                                <a href="{{ route('careers.show', $job->slug) }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">
                                    Details
                                </a>
                                <a href="{{ route('applications.create', $job->slug) }}" class="px-4 py-2 bg-blue-900 hover:bg-blue-950 text-white font-semibold text-xs rounded-xl transition-colors flex items-center gap-1.5 shadow-2xs">
                                    <span>Apply Now</span>
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-amber-400"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
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

    <!-- Why Olympia Education Section (Curated general themes, sample content clearly labeled) -->
    <section class="py-20 bg-white border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Why Olympia Education</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-1">Cultivating Academic Excellence & Growth</h2>
                <p class="text-sm text-slate-500 mt-2">
                    Empowering our staff and student interns with collaborative environments, continuous learning opportunities, and purpose-driven work.
                </p>
                <div class="inline-flex items-center gap-1.5 text-[11px] text-slate-400 bg-slate-100 px-3 py-1 rounded-full mt-3">
                    <i data-lucide="info" class="w-3 h-3 text-slate-400"></i>
                    <span>Demonstration themes for institutional management review</span>
                </div>
            </div>

            <!-- Culture & Team Visual Feature -->
            <div class="mt-12 rounded-3xl overflow-hidden border border-slate-200/90 shadow-md bg-white grid grid-cols-1 lg:grid-cols-12 items-center">
                <div class="lg:col-span-7 h-72 sm:h-80 lg:h-96 relative overflow-hidden group">
                    <img src="{{ asset('images/academic-team.jpg') }}" alt="Olympia Education Academic Committee and Faculty Collaboration"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute bottom-3 left-3 bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-semibold px-3 py-1 rounded-full border border-slate-700">
                        Academic Strategy & Curriculum Committee Session
                    </div>
                </div>
                <div class="lg:col-span-5 p-8 sm:p-10 space-y-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Educational Leadership</span>
                    <h3 class="text-2xl font-extrabold text-slate-900 leading-tight">
                        A Culture Built on Mentorship & Collegiality
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        At Olympia Education, faculty members, researchers, and professional administrators collaborate daily across faculties to modernize course delivery, student support, and academic quality assurance.
                    </p>
                    <div class="pt-2 flex items-center gap-4 text-xs font-semibold text-blue-900">
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600"></i>
                            <span>Pedagogical Mentorship</span>
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600"></i>
                            <span>Industry Linkages</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Application Process Section (5 Steps) -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Candidate Journey</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-1">Our Transparent Hiring Process</h2>
                <p class="text-sm text-slate-500 mt-2">
                    Simple, respectful, and trackable every step of the way from initial submission to final placement.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 relative">
                <!-- Step 1 -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 relative flex flex-col">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 text-amber-400 font-bold flex items-center justify-center text-sm mb-4">
                        01
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">Discover Opportunity</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Browse active vacancies or internship positions that align with your background and goals.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 relative flex flex-col">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 text-amber-400 font-bold flex items-center justify-center text-sm mb-4">
                        02
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">Submit Application</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Fill in candidate details, upload your PDF resume, and receive your unique reference code.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 relative flex flex-col">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 text-amber-400 font-bold flex items-center justify-center text-sm mb-4">
                        03
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">Application Review</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        HR team and hiring managers evaluate credentials against position prerequisites.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 relative flex flex-col">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 text-amber-400 font-bold flex items-center justify-center text-sm mb-4">
                        04
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">Interview / Assessment</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Shortlisted candidates participate in video or on-campus interviews with the panel.
                    </p>
                </div>

                <!-- Step 5 -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 relative flex flex-col">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 text-amber-400 font-bold flex items-center justify-center text-sm mb-4">
                        05
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">Recruitment Outcome</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Formal offer of appointment or constructive candidate feedback is delivered.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tracking Callout Banner -->
    <section class="py-16 bg-gradient-to-r from-blue-950 via-slate-900 to-blue-950 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="space-y-2 text-center md:text-left">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-400">Already Submitted?</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white">Track Your Application Live</h2>
                <p class="text-xs sm:text-sm text-slate-300 max-w-xl">
                    Check your recruitment status, interview notices, and HR milestones at any time using your reference number.
                </p>
            </div>
            <a href="{{ route('tracking.index') }}" class="px-6 py-3.5 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm rounded-xl transition-all shadow-lg shadow-amber-500/20 shrink-0 flex items-center gap-2">
                <i data-lucide="compass" class="w-4 h-4"></i>
                <span>Open Application Tracker</span>
            </a>
        </div>
    </section>
@endsection
