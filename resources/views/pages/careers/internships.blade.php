@extends('layouts.app')

@section('title', 'Undergraduate Internships | Olympia Education Career')
@section('meta_description', 'Explore university-approved undergraduate internship programs across IT, marketing, and campus administration at Olympia Education Malaysia.')

@section('content')
    <!-- Internship Hero Banner -->
    <div class="bg-gradient-to-r from-slate-950 via-slate-900 to-blue-950 text-white py-16 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black bg-amber-500 text-slate-950">
                        <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                        <span>University Internship Programs</span>
                    </span>
                    <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                        Launch Your Professional Career with <span class="text-amber-400">Olympia</span>
                    </h1>
                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-normal">
                        Bridge academic theory with real-world industry practice. Gain direct mentorship from educators and senior engineers, build portfolio projects, and earn accredited university internship credits.
                    </p>
                    <div class="flex flex-wrap items-center gap-4 text-xs font-semibold text-slate-300 pt-2">
                        <span class="flex items-center gap-1.5 text-amber-400">
                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                            <span>Monthly Stipend / Allowance</span>
                        </span>
                        <span class="flex items-center gap-1.5 text-emerald-400">
                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                            <span>University Accreditation Approved</span>
                        </span>
                        <span class="flex items-center gap-1.5 text-blue-400">
                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                            <span>Direct Mentor Pairing</span>
                        </span>
                    </div>
                </div>

                <div class="lg:col-span-5 relative">
                    <div class="rounded-3xl overflow-hidden shadow-2xl border-2 border-slate-700 group">
                        <img src="{{ asset('images/internship-lab.jpg') }}" alt="Olympia Education Student Interns Collaborating in Computing Lab"
                             class="w-full h-64 sm:h-72 object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute bottom-3 left-3 bg-slate-950/80 backdrop-blur-md text-amber-400 text-[11px] font-bold px-3 py-1 rounded-full border border-slate-700">
                            Student Lab & Creative Computing Placement
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Listings -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-900">Current Internship Placements</h2>
                <p class="text-xs text-slate-500 mt-1">
                    Requirements are tailored to each faculty placement. Please verify with your university internship coordinator.
                </p>
            </div>

            <!-- Department Filter -->
            <form action="{{ route('internships') }}" method="GET" class="flex items-center gap-3">
                <select name="department" onchange="this.form.submit()" class="bg-white border border-slate-300 rounded-xl px-4 py-2 text-xs font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-900">
                    <option value="">All Departments</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept }}" {{ request('department') === $dept ? 'selected' : '' }}>
                            {{ $dept }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        @if ($internships->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($internships as $intern)
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 flex flex-col justify-between hover:shadow-lg transition-all duration-200 hover:border-amber-400 group">
                        <div class="space-y-4">
                            <!-- Top tags -->
                            <div class="flex items-center justify-between gap-2">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-600 bg-slate-100 px-2.5 py-1 rounded-md">
                                    {{ $intern->department }}
                                </span>
                                <span class="text-xs font-bold text-amber-700 bg-amber-50 px-3 py-1 rounded-full border border-amber-200">
                                    {{ $intern->internship_duration ?? '3 - 6 Months' }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-amber-600 transition-colors">
                                <a href="{{ route('careers.show', $intern->slug) }}">
                                    {{ $intern->title }}
                                </a>
                            </h3>

                            <p class="text-xs text-slate-600 leading-relaxed line-clamp-3">
                                {{ $intern->summary ?? Str::limit(strip_tags($intern->description), 140) }}
                            </p>

                            <!-- Key Specifications -->
                            <div class="bg-slate-50 rounded-xl p-4 space-y-2 text-xs text-slate-700 border border-slate-100">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500">Location:</span>
                                    <span class="font-semibold text-slate-800">{{ $intern->location }}</span>
                                </div>

                                @if ($intern->salary_range)
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-500">Monthly Allowance:</span>
                                        <span class="font-bold text-emerald-700">{{ $intern->salary_range }}</span>
                                    </div>
                                @endif

                                @if ($intern->internship_start_date)
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-500">Expected Intake:</span>
                                        <span class="font-semibold text-blue-900">{{ $intern->internship_start_date->format('F Y') }}</span>
                                    </div>
                                @endif

                                @if ($intern->closing_date)
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-500">Application Deadline:</span>
                                        <span class="font-semibold text-amber-700">{{ $intern->closing_date->format('d M Y') }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Requirements Preview -->
                            @if ($intern->requirements)
                                <div class="text-xs text-slate-600 pt-1">
                                    <span class="font-bold text-slate-700">Placement Note:</span>
                                    <span class="text-slate-500">{{ Str::limit(strip_tags($intern->requirements), 90) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between gap-3">
                            <a href="{{ route('careers.show', $intern->slug) }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">
                                Full Curriculum Details
                            </a>
                            <a href="{{ route('applications.create', $intern->slug) }}" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs rounded-xl transition-all shadow-xs flex items-center gap-1.5">
                                <span>Apply for Placement</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $internships->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center max-w-lg mx-auto">
                <i data-lucide="graduation-cap" class="w-12 h-12 text-slate-400 mx-auto mb-3"></i>
                <h3 class="text-base font-bold text-slate-800">No Current Internship Vacancies</h3>
                <p class="text-xs text-slate-500 mt-1">Please check back soon for our next university intake round.</p>
            </div>
        @endif
    </div>
@endsection
