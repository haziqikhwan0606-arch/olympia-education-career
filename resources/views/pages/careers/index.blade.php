@extends('layouts.app')

@section('title', 'Explore Careers | Olympia Education Career')
@section('meta_description', 'Discover current job openings and career vacancies at Olympia Education Malaysia. Apply online today.')

@section('content')
    <!-- Page Header Banner -->
    <div class="bg-slate-900 text-white py-14 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-400">Careers at Olympia</span>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white">
                    Explore Vacancies & Opportunities
                </h1>
                <p class="text-sm text-slate-300 leading-relaxed">
                    Search and filter academic faculty positions, administrative appointments, and internship openings across Olympia Education Malaysia.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content & Filters Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Search & Filter Controls Card -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 mb-8 shadow-xs">
            <form action="{{ route('careers.index') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Keyword Search -->
                    <div class="lg:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Keywords</label>
                        <div class="relative">
                            <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Title, skills, or keywords..."
                                   class="w-full bg-slate-50 border border-slate-300 rounded-xl pl-10 pr-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Department -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Department</label>
                        <select name="department" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                            <option value="">All Departments</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept }}" {{ request('department') === $dept ? 'selected' : '' }}>
                                    {{ $dept }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Employment Type -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Type</label>
                        <select name="type" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                            <option value="">All Types</option>
                            @foreach ($types as $type)
                                <option value="{{ $type }}" {{ request('type') === $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Sort By</label>
                        <select name="sort" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest Published</option>
                            <option value="closing_soon" {{ request('sort') === 'closing_soon' ? 'selected' : '' }}>Closing Soon</option>
                            <option value="title" {{ request('sort') === 'title' ? 'selected' : '' }}>Job Title (A-Z)</option>
                        </select>
                    </div>
                </div>

                <!-- Secondary Row: Status & Actions -->
                <div class="pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3 text-xs">
                    <div class="flex items-center gap-4">
                        <label class="font-bold text-slate-700 uppercase">Status:</label>
                        <label class="inline-flex items-center gap-1.5 cursor-pointer text-slate-700">
                            <input type="radio" name="status" value="" {{ !request('status') ? 'checked' : '' }} class="text-blue-900 focus:ring-blue-900">
                            <span>Open Only</span>
                        </label>
                        <label class="inline-flex items-center gap-1.5 cursor-pointer text-slate-700">
                            <input type="radio" name="status" value="all" {{ request('status') === 'all' ? 'checked' : '' }} class="text-blue-900 focus:ring-blue-900">
                            <span>All (Including Closed)</span>
                        </label>
                    </div>

                    <div class="flex items-center gap-2">
                        @if (request()->hasAny(['search', 'department', 'type', 'sort', 'status']))
                            <a href="{{ route('careers.index') }}" class="px-4 py-2 text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                                Reset Filters
                            </a>
                        @endif
                        <button type="submit" class="px-5 py-2 bg-blue-900 hover:bg-blue-950 text-white font-semibold rounded-xl text-xs transition-colors shadow-2xs flex items-center gap-1.5">
                            <i data-lucide="filter" class="w-3.5 h-3.5"></i>
                            <span>Apply Filters</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Results Counter -->
        <div class="flex items-center justify-between mb-6 text-xs text-slate-500">
            <div>
                Showing <span class="font-bold text-slate-900">{{ $vacancies->firstItem() ?? 0 }}</span>
                to <span class="font-bold text-slate-900">{{ $vacancies->lastItem() ?? 0 }}</span>
                of <span class="font-bold text-slate-900">{{ $vacancies->total() }}</span> vacancies
            </div>
            @if(request('status') === 'all')
                <div class="inline-flex items-center gap-1.5 text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                    <i data-lucide="info" class="w-3 h-3"></i>
                    <span>Including archived & closed listings</span>
                </div>
            @endif
        </div>

        <!-- Vacancies List -->
        @if ($vacancies->count() > 0)
            <div class="space-y-4">
                @foreach ($vacancies as $job)
                    <div class="bg-white rounded-2xl border {{ $job->isOpen() ? 'border-slate-200 hover:border-blue-300' : 'border-slate-200 bg-slate-50/60 opacity-90' }} p-6 transition-all duration-200 shadow-2xs hover:shadow-md flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <!-- Job Information -->
                        <div class="space-y-2 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-600 bg-slate-100 px-2.5 py-0.5 rounded-md">
                                    {{ $job->department }}
                                </span>

                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    @if($job->employment_type === 'Internship') bg-amber-50 text-amber-700 border border-amber-200
                                    @elseif($job->employment_type === 'Full-Time') bg-blue-50 text-blue-700 border border-blue-200
                                    @elseif($job->employment_type === 'Part-Time') bg-emerald-50 text-emerald-700 border border-emerald-200
                                    @else bg-purple-50 text-purple-700 border border-purple-200 @endif">
                                    {{ $job->employment_type }}
                                </span>

                                @if (!$job->isOpen())
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">
                                        <i data-lucide="lock" class="w-3 h-3"></i>
                                        <span>Applications Closed</span>
                                    </span>
                                @elseif ($job->days_left !== null && $job->days_left <= 7)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 border border-amber-200">
                                        <i data-lucide="clock" class="w-3 h-3 text-amber-600"></i>
                                        <span>Closing in {{ $job->days_left }} {{ Str::plural('day', $job->days_left) }}</span>
                                    </span>
                                @endif
                            </div>

                            <h2 class="text-xl font-bold text-slate-900 hover:text-blue-900 transition-colors">
                                <a href="{{ route('careers.show', $job->slug) }}">
                                    {{ $job->title }}
                                </a>
                            </h2>

                            <p class="text-xs text-slate-600 line-clamp-2 max-w-3xl leading-relaxed">
                                {{ $job->summary ?? Str::limit(strip_tags($job->description), 140) }}
                            </p>

                            <!-- Meta Chips -->
                            <div class="flex flex-wrap items-center gap-4 pt-1 text-xs text-slate-500">
                                <div class="flex items-center gap-1.5">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-400"></i>
                                    <span>{{ $job->location }}</span>
                                </div>

                                @if ($job->salary_range)
                                    <div class="flex items-center gap-1.5">
                                        <i data-lucide="banknote" class="w-3.5 h-3.5 text-slate-400"></i>
                                        <span class="font-medium text-slate-700">{{ $job->salary_range }}</span>
                                    </div>
                                @endif

                                @if ($job->internship_duration)
                                    <div class="flex items-center gap-1.5 text-amber-700 font-medium">
                                        <i data-lucide="hourglass" class="w-3.5 h-3.5 text-amber-500"></i>
                                        <span>Duration: {{ $job->internship_duration }}</span>
                                    </div>
                                @endif

                                @if ($job->closing_date)
                                    <div class="flex items-center gap-1.5 text-slate-500">
                                        <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i>
                                        <span>Closing: {{ $job->closing_date->format('d M Y') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="shrink-0 flex items-center md:flex-col justify-end gap-2.5">
                            @if ($job->isOpen())
                                <a href="{{ route('applications.create', $job->slug) }}" class="w-full sm:w-auto px-5 py-2.5 bg-blue-900 hover:bg-blue-950 text-white font-semibold text-xs rounded-xl transition-all shadow-xs flex items-center justify-center gap-1.5">
                                    <span>Apply Online</span>
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-amber-400"></i>
                                </a>
                            @else
                                <span class="w-full sm:w-auto px-4 py-2 bg-slate-200 text-slate-500 font-medium text-xs rounded-xl flex items-center justify-center cursor-not-allowed">
                                    Closed
                                </span>
                            @endif

                            <a href="{{ route('careers.show', $job->slug) }}" class="w-full sm:w-auto px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition-colors text-center">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-8">
                {{ $vacancies->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center max-w-xl mx-auto my-6">
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-4 border border-amber-200">
                    <i data-lucide="search-x" class="w-7 h-7"></i>
                </div>
                <h3 class="text-base font-bold text-slate-800">No Matching Vacancies Found</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                    We could not find any active vacancies matching your current filter criteria. Try adjusting your search keywords or resetting filters.
                </p>
                <div class="mt-6">
                    <a href="{{ route('careers.index') }}" class="px-4 py-2 text-xs font-semibold text-blue-900 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors border border-blue-200">
                        Clear All Filters
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
