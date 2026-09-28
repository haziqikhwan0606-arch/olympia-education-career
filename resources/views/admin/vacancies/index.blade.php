@extends('layouts.admin')

@section('page_title', 'Vacancy Management')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Institutional Vacancies</h2>
                <p class="text-xs text-slate-500">Manage published job openings, drafts, closing dates, and candidate pools.</p>
            </div>
            <a href="{{ route('admin.vacancies.create') }}" class="px-5 py-2.5 bg-blue-900 hover:bg-blue-950 text-white font-semibold text-xs rounded-xl shadow-xs transition-colors flex items-center gap-1.5 self-start sm:self-auto">
                <i data-lucide="plus" class="w-4 h-4 text-amber-400"></i>
                <span>Create New Vacancy</span>
            </a>
        </div>

        <!-- Filter Controls -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 shadow-2xs">
            <form action="{{ route('admin.vacancies.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 text-xs">
                <!-- Search -->
                <div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title or location..."
                           class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                </div>

                <!-- Status Filter -->
                <div>
                    <select name="status" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                        <option value="">All Statuses</option>
                        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published (Active)</option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <!-- Department Filter -->
                <div>
                    <select name="department" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                        <option value="">All Departments</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept }}" {{ request('department') === $dept ? 'selected' : '' }}>{{ $dept }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit & Reset -->
                <div class="flex items-center gap-2">
                    <button type="submit" class="flex-1 py-2 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl text-xs transition-colors">
                        Filter
                    </button>
                    @if (request()->hasAny(['search', 'status', 'department', 'type']))
                        <a href="{{ route('admin.vacancies.index') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs transition-colors">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Vacancies Table -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-2xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-200">
                        <tr>
                            <th class="py-3.5 px-4">Vacancy Title & Department</th>
                            <th class="py-3.5 px-4">Type</th>
                            <th class="py-3.5 px-4">Location</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4">Closing Date</th>
                            <th class="py-3.5 px-4">Applicants</th>
                            <th class="py-3.5 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($vacancies as $job)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <!-- Title -->
                                <td class="py-4 px-4 font-semibold text-slate-900">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('careers.show', $job->slug) }}" target="_blank" class="hover:text-blue-900 hover:underline">
                                            {{ $job->title }}
                                        </a>
                                        @if ($job->is_featured)
                                            <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded border border-amber-200">Featured</span>
                                        @endif
                                    </div>
                                    <div class="text-[11px] text-slate-400 font-normal mt-0.5">{{ $job->department }}</div>
                                </td>

                                <!-- Type -->
                                <td class="py-4 px-4 text-slate-700">
                                    {{ $job->employment_type }}
                                </td>

                                <!-- Location -->
                                <td class="py-4 px-4 text-slate-600">
                                    {{ $job->location }}
                                </td>

                                <!-- Status -->
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold
                                        @if($job->status === 'published' && $job->isOpen()) bg-emerald-50 text-emerald-700 border border-emerald-200
                                        @elseif($job->status === 'draft') bg-slate-100 text-slate-600 border border-slate-200
                                        @else bg-rose-50 text-rose-700 border border-rose-200 @endif">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                        <span>{{ ucfirst($job->status) }}</span>
                                    </span>
                                </td>

                                <!-- Closing Date -->
                                <td class="py-4 px-4 text-slate-600">
                                    @if ($job->closing_date)
                                        <div>{{ $job->closing_date->format('d M Y') }}</div>
                                        @if ($job->isOpen() && $job->days_left !== null)
                                            <div class="text-[10px] text-amber-600 font-medium">{{ $job->days_left }} days left</div>
                                        @endif
                                    @else
                                        <span class="text-slate-400">&mdash;</span>
                                    @endif
                                </td>

                                <!-- Applicants count -->
                                <td class="py-4 px-4">
                                    <a href="{{ route('admin.applicants.index', ['job_id' => $job->id]) }}" class="inline-flex items-center gap-1 font-bold text-blue-900 bg-blue-50 hover:bg-blue-100 px-2.5 py-1 rounded-lg border border-blue-200 transition-colors">
                                        <i data-lucide="users" class="w-3.5 h-3.5"></i>
                                        <span>{{ $job->applications_count }}</span>
                                    </a>
                                </td>

                                <!-- Actions -->
                                <td class="py-4 px-4 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <!-- Quick Status Toggle -->
                                        <form action="{{ route('admin.vacancies.status', $job->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            @if ($job->status === 'published')
                                                <input type="hidden" name="status" value="closed">
                                                <button type="submit" title="Close Vacancy" class="p-1.5 text-slate-400 hover:text-amber-600 hover:bg-slate-100 rounded-lg transition-colors">
                                                    <i data-lucide="lock" class="w-4 h-4"></i>
                                                </button>
                                            @else
                                                <input type="hidden" name="status" value="published">
                                                <button type="submit" title="Publish / Reopen Vacancy" class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-slate-100 rounded-lg transition-colors">
                                                    <i data-lucide="unlock" class="w-4 h-4"></i>
                                                </button>
                                            @endif
                                        </form>

                                        <!-- Edit -->
                                        <a href="{{ route('admin.vacancies.edit', $job->id) }}" title="Edit Vacancy" class="p-1.5 text-slate-400 hover:text-blue-900 hover:bg-slate-100 rounded-lg transition-colors">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>

                                        <!-- Delete (Soft Delete) -->
                                        <form action="{{ route('admin.vacancies.destroy', $job->id) }}" method="POST" class="inline" onsubmit="return confirm('Archive this vacancy? Applicant records will be safely preserved.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Archive Vacancy" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-100 rounded-lg transition-colors">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    No vacancies found matching criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $vacancies->links() }}
            </div>
        </div>
    </div>
@endsection
