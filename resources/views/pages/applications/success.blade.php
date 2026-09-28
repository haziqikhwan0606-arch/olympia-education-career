@extends('layouts.app')

@section('title', 'Application Received | Olympia Education Career')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-3xl border border-slate-200 p-8 sm:p-12 text-center shadow-lg space-y-6">
            <!-- Icon -->
            <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-600 mx-auto border-4 border-emerald-100 shadow-xs">
                <i data-lucide="check" class="w-10 h-10 stroke-[2.5]"></i>
            </div>

            <!-- Header -->
            <div class="space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                    Application Confirmed
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                    Thank You, {{ $application->full_name }}!
                </h1>
                <p class="text-sm text-slate-600 max-w-lg mx-auto leading-relaxed">
                    Your application for the position of <strong class="text-slate-900">{{ $application->jobVacancy?->title ?? 'Position' }}</strong> has been securely logged in our recruitment management database.
                </p>
            </div>

            <!-- Reference Number Highlight Box -->
            <div class="p-6 bg-slate-900 rounded-2xl text-white max-w-md mx-auto space-y-2 relative overflow-hidden" x-data="{ copied: false }">
                <div class="text-xs uppercase tracking-wider text-slate-400 font-semibold">Your Application Reference Number</div>
                <div class="text-2xl sm:text-3xl font-black text-amber-400 tracking-wider">
                    {{ $application->reference_number }}
                </div>
                <p class="text-[11px] text-slate-400">
                    Please keep this reference code for tracking recruitment milestones.
                </p>

                <div class="pt-2">
                    <button type="button" @click="navigator.clipboard.writeText('{{ $application->reference_number }}'); copied = true; setTimeout(() => copied = false, 2500)"
                            class="px-3.5 py-1.5 bg-slate-800 hover:bg-slate-700 text-xs font-medium text-slate-200 rounded-lg transition-colors inline-flex items-center gap-1.5 border border-slate-700">
                        <i data-lucide="copy" class="w-3.5 h-3.5" x-show="!copied"></i>
                        <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-400" x-show="copied" x-cloak></i>
                        <span x-text="copied ? 'Copied to Clipboard!' : 'Copy Reference Code'"></span>
                    </button>
                </div>
            </div>

            <!-- Summary Details -->
            <div class="bg-slate-50 rounded-2xl p-6 text-xs text-left max-w-lg mx-auto border border-slate-200/80 space-y-3">
                <div class="flex justify-between py-1 border-b border-slate-200/60">
                    <span class="text-slate-500">Applicant:</span>
                    <span class="font-bold text-slate-900">{{ $application->full_name }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-200/60">
                    <span class="text-slate-500">Registered Email:</span>
                    <span class="font-bold text-slate-900">{{ $application->email }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-200/60">
                    <span class="text-slate-500">Department:</span>
                    <span class="font-bold text-slate-900">{{ $application->jobVacancy?->department ?? 'General' }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-200/60">
                    <span class="text-slate-500">Submission Timestamp:</span>
                    <span class="font-bold text-slate-900">{{ $application->created_at->format('d M Y, h:i A') }}</span>
                </div>
                <div class="flex justify-between py-1">
                    <span class="text-slate-500">Initial Status:</span>
                    <span class="font-bold text-blue-900 bg-blue-100 px-2 py-0.5 rounded">{{ $application->status }}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('tracking.show', ['ref' => $application->reference_number, 'token' => $application->access_token]) }}" class="w-full sm:w-auto px-8 py-3.5 bg-blue-900 hover:bg-blue-950 text-white font-bold text-xs rounded-xl shadow-xs transition-colors flex items-center justify-center gap-2">
                    <i data-lucide="compass" class="w-4 h-4 text-amber-400"></i>
                    <span>Track Status Live</span>
                </a>
                <a href="{{ route('careers.index') }}" class="w-full sm:w-auto px-6 py-3.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition-colors text-center">
                    Browse Other Opportunities
                </a>
            </div>
        </div>
    </div>
@endsection
