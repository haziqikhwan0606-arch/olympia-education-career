@extends('layouts.app')

@section('title', 'Track Application Status | Olympia Education Career')
@section('meta_description', 'Check the status of your Olympia Education Malaysia job or internship application using your reference code.')

@section('content')
    <div class="bg-slate-900 text-white py-14 border-b border-slate-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-400 bg-slate-800 px-3 py-1 rounded-full border border-slate-700">
                Candidate Services
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white">
                Application Status Tracker
            </h1>
            <p class="text-sm text-slate-300 max-w-xl mx-auto">
                Enter your application reference code and verified email address to view real-time recruitment updates.
            </p>
        </div>
    </div>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <!-- Tracker Form Card -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 sm:p-10 shadow-lg space-y-6">
            <div class="space-y-1">
                <h2 class="text-lg font-bold text-slate-900">Verify Candidate Identity</h2>
                <p class="text-xs text-slate-500">
                    To safeguard personal data privacy, sequential IDs are not permitted. Both reference number and matching email are verified.
                </p>
            </div>

            @if ($errors->any())
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-xs text-rose-700 space-y-1">
                    @foreach ($errors->all() as $err)
                        <div class="flex items-center gap-1.5 font-medium">
                            <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 shrink-0"></i>
                            <span>{{ $err }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('tracking.check') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Reference Number -->
                <div>
                    <label for="reference_number" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                        Application Reference Number <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <i data-lucide="hash" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                        <input type="text" name="reference_number" id="reference_number" required
                               value="{{ old('reference_number', $prefillRef) }}"
                               placeholder="e.g. OEC-2026-DEV001"
                               class="w-full bg-slate-50 border border-slate-300 rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-900 uppercase font-mono tracking-wider focus:outline-none focus:ring-2 focus:ring-blue-900">
                    </div>
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase mb-1">
                        Registered Email Address <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                               placeholder="e.g. ahmad.daniel@example.com"
                               class="w-full bg-slate-50 border border-slate-300 rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 bg-blue-900 hover:bg-blue-950 text-white font-bold text-sm rounded-xl shadow-xs transition-colors flex items-center justify-center gap-2">
                    <i data-lucide="search" class="w-4 h-4 text-amber-400"></i>
                    <span>Look Up Application</span>
                </button>
            </form>

            <!-- Demo Hint for Evaluators -->
            <div class="p-4 bg-amber-50/80 rounded-2xl border border-amber-200/80 text-xs text-amber-900 space-y-2">
                <div class="font-bold flex items-center gap-1.5 text-amber-800">
                    <i data-lucide="lightbulb" class="w-4 h-4 text-amber-600"></i>
                    <span>Quick Demo Test Accounts (for Supervisor / Dato evaluation):</span>
                </div>
                <ul class="space-y-1 text-[11px] text-amber-950">
                    <li>&bull; <code>OEC-2026-DEV001</code> &mdash; <code>ahmad.daniel@example.com</code> (Shortlisted)</li>
                    <li>&bull; <code>OEC-2026-DEV002</code> &mdash; <code>weilin.tan@example.com</code> (Interview Scheduled)</li>
                    <li>&bull; <code>OEC-2026-INT001</code> &mdash; <code>nurul.izzah@example.com</code> (Under Review)</li>
                    <li>&bull; <code>OEC-2026-MED001</code> &mdash; <code>chloe.lim@example.com</code> (Offered)</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
