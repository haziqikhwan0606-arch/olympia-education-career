@extends('layouts.app')

@section('title', 'Apply for ' . $vacancy->title . ' | Olympia Education Career')

@section('content')
    <!-- Top Header Banner -->
    <div class="bg-slate-900 text-white py-12 border-b border-slate-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-xs text-amber-400 font-semibold uppercase tracking-wider">
                    <span>Recruitment Application</span>
                    <span>&bull;</span>
                    <span>{{ $vacancy->department }}</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white">
                    {{ $vacancy->title }}
                </h1>
                <p class="text-xs sm:text-sm text-slate-300">
                    {{ $vacancy->employment_type }} &bull; {{ $vacancy->location }}
                    @if($vacancy->salary_range) &bull; {{ $vacancy->salary_range }} @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Application Form Container -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Validation Error Callout -->
        @if ($errors->any())
            <div class="mb-8 rounded-2xl border border-rose-200 bg-rose-50 p-6 shadow-xs">
                <div class="flex items-start gap-3">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 shrink-0 mt-0.5"></i>
                    <div>
                        <h3 class="text-sm font-bold text-rose-900">Please correct the following errors before submitting:</h3>
                        <ul class="mt-2 list-disc list-inside text-xs text-rose-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('applications.store', $vacancy->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- SECTION 1: Personal Information -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-2xs space-y-6">
                <div class="border-b border-slate-100 pb-4">
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-blue-900 text-amber-400 flex items-center justify-center text-xs font-black">1</span>
                        <span>Personal Information</span>
                    </h2>
                    <p class="text-xs text-slate-500 mt-1">Provide your primary contact and location details.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Full Name -->
                    <div class="sm:col-span-2">
                        <label for="full_name" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                            Full Name (as per IC / Passport) <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="full_name" id="full_name" required value="{{ old('full_name') }}"
                               placeholder="e.g. Nur Aisyah binti Muhammad"
                               class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                            Email Address <span class="text-rose-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                               placeholder="e.g. aisyah@example.com"
                               class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                        <p class="text-[11px] text-slate-400 mt-1">Application confirmation & updates will be sent here.</p>
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                            Contact Phone / WhatsApp <span class="text-rose-500">*</span>
                        </label>
                        <input type="tel" name="phone" id="phone" required value="{{ old('phone') }}"
                               placeholder="e.g. +60 12-345 6789"
                               class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                    </div>

                    <!-- Malaysian State -->
                    <div class="sm:col-span-2">
                        <label for="state" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                            Current State / Location in Malaysia <span class="text-rose-500">*</span>
                        </label>
                        <select name="state" id="state" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                            <option value="">Select State</option>
                            @foreach ($states as $st)
                                <option value="{{ $st }}" {{ old('state') === $st ? 'selected' : '' }}>
                                    {{ $st }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: Academic & Educational Background -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-2xs space-y-6">
                <div class="border-b border-slate-100 pb-4">
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-blue-900 text-amber-400 flex items-center justify-center text-xs font-black">2</span>
                        <span>Academic Background</span>
                    </h2>
                    <p class="text-xs text-slate-500 mt-1">Your highest attained or currently pursued qualification.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Highest Education -->
                    <div>
                        <label for="highest_education" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                            Highest Qualification <span class="text-rose-500">*</span>
                        </label>
                        <select name="highest_education" id="highest_education" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                            <option value="">Select Level</option>
                            @foreach ($educationLevels as $lvl)
                                <option value="{{ $lvl }}" {{ old('highest_education') === $lvl ? 'selected' : '' }}>
                                    {{ $lvl }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Graduation Year -->
                    <div>
                        <label for="graduation_year" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                            Graduation Year (Actual / Expected) <span class="text-rose-500">*</span>
                        </label>
                        <input type="number" name="graduation_year" id="graduation_year" required
                               min="1970" max="{{ date('Y') + 6 }}"
                               value="{{ old('graduation_year', date('Y')) }}"
                               placeholder="e.g. 2024"
                               class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                    </div>

                    <!-- Institution -->
                    <div>
                        <label for="institution" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                            Institution / College / University <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="institution" id="institution" required value="{{ old('institution') }}"
                               placeholder="e.g. Universiti Malaya, Taylor's, Olympia"
                               class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                    </div>

                    <!-- Course / Field of Study -->
                    <div>
                        <label for="field_of_study" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                            Course / Discipline of Study <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="field_of_study" id="field_of_study" required value="{{ old('field_of_study') }}"
                               placeholder="e.g. Computer Science, Business Management"
                               class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                    </div>
                </div>
            </div>

            <!-- SECTION 3: Employment / Internship Details -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-2xs space-y-6">
                <div class="border-b border-slate-100 pb-4">
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-blue-900 text-amber-400 flex items-center justify-center text-xs font-black">3</span>
                        <span>Employment & Internship Specifics</span>
                    </h2>
                    <p class="text-xs text-slate-500 mt-1">Specify your target placement parameters.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Application Type -->
                    <div>
                        <label for="application_type" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                            Application Type <span class="text-rose-500">*</span>
                        </label>
                        <select name="application_type" id="application_type" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                            <option value="Full-Time" {{ old('application_type', $vacancy->employment_type) === 'Full-Time' ? 'selected' : '' }}>Full-Time Employment</option>
                            <option value="Internship" {{ old('application_type', $vacancy->employment_type) === 'Internship' ? 'selected' : '' }}>Undergraduate Internship</option>
                            <option value="Part-Time" {{ old('application_type', $vacancy->employment_type) === 'Part-Time' ? 'selected' : '' }}>Part-Time / Adjunct</option>
                            <option value="Contract" {{ old('application_type', $vacancy->employment_type) === 'Contract' ? 'selected' : '' }}>Fixed-Term Contract</option>
                        </select>
                    </div>

                    <!-- Relevant Experience Summary -->
                    <div class="sm:col-span-2">
                        <label for="relevant_experience" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                            Summary of Relevant Experience / Projects (Optional)
                        </label>
                        <textarea name="relevant_experience" id="relevant_experience" rows="3"
                                  placeholder="Briefly highlight relevant past employment, internships, co-curricular leadership, or notable academic projects..."
                                  class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">{{ old('relevant_experience') }}</textarea>
                    </div>

                    <!-- Internship Specific Fields (Highlighted) -->
                    <div class="sm:col-span-2 p-5 bg-amber-50/60 rounded-xl border border-amber-200 space-y-4">
                        <div class="flex items-center gap-2 text-xs font-bold uppercase text-amber-900">
                            <i data-lucide="info" class="w-4 h-4 text-amber-600"></i>
                            <span>If Applying for an Internship Placement:</span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="internship_start_date" class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">
                                    Preferred Start Date
                                </label>
                                <input type="date" name="internship_start_date" id="internship_start_date"
                                       value="{{ old('internship_start_date', $vacancy->internship_start_date?->format('Y-m-d')) }}"
                                       class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800">
                            </div>
                            <div>
                                <label for="internship_end_date" class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">
                                    Preferred End Date
                                </label>
                                <input type="date" name="internship_end_date" id="internship_end_date"
                                       value="{{ old('internship_end_date') }}"
                                       class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800">
                            </div>
                            <div>
                                <label for="university_internship_duration" class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">
                                    University Duration Requirement
                                </label>
                                <input type="text" name="university_internship_duration" id="university_internship_duration"
                                       value="{{ old('university_internship_duration', $vacancy->internship_duration) }}"
                                       placeholder="e.g. 12 Weeks / 6 Months"
                                       class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 4: Document Uploads (CV & Cover Letter) -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-2xs space-y-6">
                <div class="border-b border-slate-100 pb-4">
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-blue-900 text-amber-400 flex items-center justify-center text-xs font-black">4</span>
                        <span>Candidate Documents</span>
                    </h2>
                    <p class="text-xs text-slate-500 mt-1">
                        Files are encrypted and stored in private storage accessible strictly by authorized Olympia HR personnel.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- CV / Resume Upload -->
                    <div class="p-5 rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50/50 space-y-2">
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-800 uppercase">
                            <i data-lucide="file-text" class="w-4 h-4 text-blue-900"></i>
                            <span>Curriculum Vitae (CV) / Resume <span class="text-rose-500">*</span></span>
                        </div>
                        <p class="text-[11px] text-slate-500">PDF format only. Maximum file size: 5MB.</p>
                        <input type="file" name="cv_file" id="cv_file" required accept=".pdf,application/pdf"
                               class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-900 file:text-white hover:file:bg-blue-950 file:cursor-pointer">
                    </div>

                    <!-- Cover Letter (Optional) -->
                    <div class="p-5 rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50/50 space-y-2">
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-800 uppercase">
                            <i data-lucide="file-edit" class="w-4 h-4 text-slate-500"></i>
                            <span>Cover Letter (Optional)</span>
                        </div>
                        <p class="text-[11px] text-slate-500">PDF format only. Maximum file size: 5MB.</p>
                        <input type="file" name="cover_letter_file" id="cover_letter_file" accept=".pdf,application/pdf"
                               class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 file:cursor-pointer">
                    </div>
                </div>
            </div>

            <!-- SECTION 5: Candidate Statement & Consent -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-2xs space-y-6">
                <div class="border-b border-slate-100 pb-4">
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-blue-900 text-amber-400 flex items-center justify-center text-xs font-black">5</span>
                        <span>Statement & Consent</span>
                    </h2>
                </div>

                <!-- Why Olympia -->
                <div>
                    <label for="interest_reason" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                        Why are you interested in this opportunity at Olympia Education? <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="interest_reason" id="interest_reason" rows="4" required
                              placeholder="Describe your motivations, aspirations, and what value you hope to bring to Olympia Education..."
                              class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">{{ old('interest_reason') }}</textarea>
                </div>

                <!-- Consent Checkbox -->
                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="privacy_consent" id="privacy_consent" value="1" required
                               {{ old('privacy_consent') ? 'checked' : '' }}
                               class="mt-1 w-4 h-4 rounded text-blue-900 focus:ring-blue-900 border-slate-300">
                        <span class="text-xs text-slate-700 leading-relaxed">
                            I declare that the information provided in this recruitment application is accurate and complete to the best of my knowledge. I have read and acknowledge the
                            <a href="{{ route('privacy.notice') }}" target="_blank" class="text-blue-900 underline font-semibold hover:text-amber-600">Applicant Privacy Notice</a>,
                            and agree to the confidential processing of my personal data for candidate evaluation purposes by Olympia Education Malaysia.
                            <span class="text-rose-500 font-bold">*</span>
                        </span>
                    </label>
                </div>
            </div>

            <!-- Submit Button & Disclaimer -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                <a href="{{ route('careers.show', $vacancy->slug) }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">
                    &larr; Back to Vacancy Details
                </a>

                <button type="submit" class="w-full sm:w-auto px-10 py-3.5 bg-blue-900 hover:bg-blue-950 text-white font-bold text-sm rounded-xl shadow-md transition-all flex items-center justify-center gap-2">
                    <span>Submit Application</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 text-amber-400"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
