@extends('layouts.admin')

@section('page_title', 'Create New Vacancy')

@section('content')
    <div class="max-w-4xl space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Post a Vacancy</h2>
                <p class="text-xs text-slate-500">Add an academic, professional, or internship position to the recruitment database.</p>
            </div>
            <a href="{{ route('admin.vacancies.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">
                &larr; Back to Vacancies
            </a>
        </div>

        @if ($errors->any())
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-xs text-rose-700 space-y-1">
                @foreach ($errors->all() as $err)
                    <div class="flex items-center gap-1.5 font-medium">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 shrink-0"></i>
                        <span>{{ $err }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.vacancies.store') }}" method="POST" class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-2xs space-y-6">
            @csrf

            <!-- Title & Department -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label for="title" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                        Job / Vacancy Title <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" required value="{{ old('title') }}"
                           placeholder="e.g. Senior Lecturer in Information Technology"
                           class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                </div>

                <div>
                    <label for="department" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                        Department / Faculty <span class="text-rose-500">*</span>
                    </label>
                    <select name="department" id="department" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                        @foreach ($departments as $dept)
                            <option value="{{ $dept }}" {{ old('department') === $dept ? 'selected' : '' }}>{{ $dept }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="employment_type" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                        Employment Type <span class="text-rose-500">*</span>
                    </label>
                    <select name="employment_type" id="employment_type" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                        @foreach ($types as $t)
                            <option value="{{ $t }}" {{ old('employment_type') === $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="location" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                        Campus Location <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="location" id="location" required value="{{ old('location', 'Petaling Jaya, Selangor') }}"
                           class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                </div>

                <div>
                    <label for="salary_range" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                        Salary / Allowance Range (Optional)
                    </label>
                    <input type="text" name="salary_range" id="salary_range" value="{{ old('salary_range') }}"
                           placeholder="e.g. RM 4,500 - RM 6,500 or RM 1,000 Allowance"
                           class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                </div>
            </div>

            <!-- Internship Specific Parameters -->
            <div class="p-5 bg-amber-50/60 rounded-2xl border border-amber-200 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2 text-xs font-bold text-amber-900 uppercase">
                    Internship Placement Configurations (If applicable)
                </div>
                <div>
                    <label for="internship_duration" class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">
                        Internship Duration
                    </label>
                    <input type="text" name="internship_duration" id="internship_duration" value="{{ old('internship_duration') }}"
                           placeholder="e.g. 3 - 6 Months"
                           class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900">
                </div>
                <div>
                    <label for="internship_start_date" class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">
                        Target Intake Start Date
                    </label>
                    <input type="date" name="internship_start_date" id="internship_start_date" value="{{ old('internship_start_date') }}"
                           class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-900">
                </div>
            </div>

            <!-- Short Summary -->
            <div>
                <label for="summary" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                    Short Summary (Displays in cards and previews)
                </label>
                <textarea name="summary" id="summary" rows="2"
                          placeholder="Brief 1-2 sentence overview of the role..."
                          class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">{{ old('summary') }}</textarea>
            </div>

            <!-- Full Job Description -->
            <div>
                <label for="description" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                    Full Job Overview / About Role <span class="text-rose-500">*</span>
                </label>
                <textarea name="description" id="description" rows="5" required
                          placeholder="Detailed introduction to the role and departmental objectives..."
                          class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">{{ old('description') }}</textarea>
            </div>

            <!-- Responsibilities -->
            <div>
                <label for="responsibilities" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                    Key Responsibilities <span class="text-rose-500">*</span>
                </label>
                <textarea name="responsibilities" id="responsibilities" rows="5" required
                          placeholder="• Duty 1&#10;• Duty 2&#10;• Duty 3"
                          class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">{{ old('responsibilities') }}</textarea>
            </div>

            <!-- Qualifications -->
            <div>
                <label for="qualifications" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                    Qualifications & Prerequisites <span class="text-rose-500">*</span>
                </label>
                <textarea name="qualifications" id="qualifications" rows="5" required
                          placeholder="• Educational degree&#10;• Professional experience&#10;• Key technical or teaching competencies"
                          class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">{{ old('qualifications') }}</textarea>
            </div>

            <!-- Departmental Requirements (Optional) -->
            <div>
                <label for="requirements" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                    Additional Departmental Requirements (Optional)
                </label>
                <textarea name="requirements" id="requirements" rows="3"
                          placeholder="Specific university letter prerequisites, portfolio links, or licensing..."
                          class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">{{ old('requirements') }}</textarea>
            </div>

            <!-- Dates, Status & Featuring -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 pt-2 border-t border-slate-100">
                <div>
                    <label for="closing_date" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                        Application Closing Date
                    </label>
                    <input type="date" name="closing_date" id="closing_date" value="{{ old('closing_date') }}"
                           class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                </div>

                <div>
                    <label for="status" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                        Publication Status <span class="text-rose-500">*</span>
                    </label>
                    <select name="status" id="status" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                        <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>Published (Active)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                        <option value="closed" {{ old('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <div class="flex items-center pt-6">
                    <label class="flex items-center gap-2 cursor-pointer text-xs font-semibold text-slate-800">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                               class="w-4 h-4 rounded text-blue-900 focus:ring-blue-900 border-slate-300">
                        <span>Feature on Career Homepage</span>
                    </label>
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.vacancies.index') }}" class="px-5 py-2.5 text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 bg-blue-900 hover:bg-blue-950 text-white font-semibold text-xs rounded-xl shadow-xs transition-colors flex items-center gap-1.5">
                    <i data-lucide="check" class="w-4 h-4 text-amber-400"></i>
                    <span>Save & Create Vacancy</span>
                </button>
            </div>
        </form>
    </div>
@endsection
