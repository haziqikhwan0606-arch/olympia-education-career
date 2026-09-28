@extends('layouts.admin')

@section('page_title', 'Applicant Management')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Recruitment Candidate Pool</h2>
                <p class="text-xs text-slate-500">Screen submissions, download verified candidate CVs, and track recruitment progress.</p>
            </div>
            <div class="text-xs font-semibold text-slate-500">
                Total Candidates: <span class="text-slate-900 font-bold">{{ $applications->total() }}</span>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 shadow-2xs">
            <form action="{{ route('admin.applicants.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 text-xs">
                <!-- Search -->
                <div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Candidate name, ref, or email..."
                           class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                </div>

                <!-- Vacancy Filter -->
                <div>
                    <select name="job_id" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                        <option value="">All Vacancies</option>
                        @foreach ($vacancies as $v)
                            <option value="{{ $v->id }}" {{ request('job_id') == $v->id ? 'selected' : '' }}>{{ $v->title }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <select name="status" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                        <option value="">All Statuses</option>
                        @foreach ($statuses as $st)
                            <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort -->
                <div>
                    <select name="sort" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest Submitted</option>
                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Candidate Name (A-Z)</option>
                    </select>
                </div>

                <!-- Submit & Reset -->
                <div class="flex items-center gap-2">
                    <button type="submit" class="flex-1 py-2 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl text-xs transition-colors">
                        Filter Pool
                    </button>
                    @if (request()->hasAny(['search', 'job_id', 'status', 'type', 'sort']))
                        <a href="{{ route('admin.applicants.index') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs transition-colors">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Applicants Table -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50/90 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-200">
                        <tr>
                            <th class="py-3 px-3 w-28">Reference</th>
                            <th class="py-3 px-3">Candidate</th>
                            <th class="py-3 px-3">Position Applied</th>
                            <th class="py-3 px-3">Education</th>
                            <th class="py-3 px-3 w-28">Status</th>
                            <th class="py-3 px-3 w-24">Submitted</th>
                            <th class="py-3 px-3 text-right w-28">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($applications as $app)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <!-- Reference -->
                                <td class="py-2.5 px-3">
                                    <div class="font-mono font-bold text-xs text-amber-700 tracking-tight whitespace-nowrap">{{ $app->reference_number }}</div>
                                    <div class="text-[10px] text-slate-400 font-medium">{{ $app->application_type }}</div>
                                </td>

                                <!-- Candidate Info -->
                                <td class="py-2.5 px-3">
                                    <div class="font-semibold text-slate-900 leading-tight">{{ $app->full_name }}</div>
                                    <div class="text-[11px] text-slate-500 truncate max-w-[190px]" title="{{ $app->email }}">{{ $app->email }}</div>
                                    <div class="text-[10px] text-slate-400 leading-tight">{{ $app->phone }} &bull; {{ $app->state }}</div>
                                </td>

                                <!-- Vacancy Applied -->
                                <td class="py-2.5 px-3">
                                    <div class="font-medium text-slate-800 leading-snug line-clamp-1 max-w-[190px]" title="{{ $app->jobVacancy?->title ?? 'General Position' }}">
                                        {{ $app->jobVacancy?->title ?? 'General Position' }}
                                    </div>
                                    <div class="text-[10px] text-slate-400">{{ $app->jobVacancy?->department ?? 'General' }}</div>
                                </td>

                                <!-- Education -->
                                <td class="py-2.5 px-3">
                                    <div class="font-medium text-slate-800 leading-tight">{{ $app->highest_education }}</div>
                                    <div class="text-[10px] text-slate-500 truncate max-w-[180px]" title="{{ $app->field_of_study }} ({{ $app->institution }})">
                                        {{ $app->field_of_study ?: $app->institution }}
                                    </div>
                                </td>

                                <!-- Status Badge -->
                                <td class="py-2.5 px-3 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $app->status_badge_class }}">
                                        {{ $app->status }}
                                    </span>
                                </td>

                                <!-- Submission Date -->
                                <td class="py-2.5 px-3 whitespace-nowrap text-slate-500">
                                    <div class="text-xs text-slate-700">{{ $app->created_at->format('d M Y') }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $app->created_at->format('h:i A') }}</div>
                                </td>

                                <!-- Actions -->
                                <td class="py-2.5 px-3 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <!-- Secure CV Download -->
                                        @if ($app->cv_path)
                                            <a href="{{ route('admin.applicants.download_cv', $app->id) }}" title="Download CV (PDF)"
                                               class="p-1.5 text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors border border-blue-200 shrink-0">
                                                <i data-lucide="file-down" class="w-3.5 h-3.5"></i>
                                            </a>
                                        @endif

                                        <!-- Review Details -->
                                        <a href="{{ route('admin.applicants.show', $app->id) }}" title="Review Candidate"
                                           class="px-2.5 py-1.5 bg-blue-900 hover:bg-blue-950 text-white font-semibold rounded-lg text-xs transition-colors flex items-center gap-1 shrink-0">
                                            <span>Review</span>
                                            <i data-lucide="chevron-right" class="w-3 h-3"></i>
                                        </a>

                                        <!-- Delete Withdrawn Application -->
                                        @if (strtolower($app->status) === 'withdrawn')
                                            <form action="{{ route('admin.applicants.destroy', $app->id) }}" method="POST" class="inline" onsubmit="return confirm('Permanently delete withdrawn application {{ $app->reference_number }} ({{ $app->full_name }})?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Delete Withdrawn Application"
                                                        class="p-1.5 text-rose-700 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors border border-rose-200 shrink-0">
                                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    No candidate applications found matching the selected filters.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
@endsection
