@extends('layouts.app')

@section('title', 'Contact Talent Acquisition | Olympia Education Career')
@section('meta_description', 'Get in touch with the Olympia Education Malaysia recruitment and HR talent team.')

@section('content')
    <div class="bg-slate-900 text-white py-16 border-b border-slate-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-3">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-400">Get In Touch</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white">
                Contact Talent Acquisition
            </h1>
            <p class="text-sm text-slate-300 leading-relaxed">
                Have questions regarding faculty opportunities, university internship partnerships, or your existing application? Reach out to our HR department.
            </p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Office Address Card -->
            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-2xs space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-900 flex items-center justify-center">
                    <i data-lucide="building" class="w-6 h-6"></i>
                </div>
                <h2 class="text-lg font-bold text-slate-900">Campus Headquarters</h2>
                <div class="text-xs text-slate-600 leading-relaxed space-y-1">
                    <p class="font-bold text-slate-800">Olympia Education Malaysia</p>
                    <p>Wisma Olympia / Corporate & Campus Operations</p>
                    <p>Petaling Jaya Campus, Selangor Darul Ehsan</p>
                    <p>Malaysia</p>
                </div>
            </div>

            <!-- Email & Operating Hours -->
            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-2xs space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <i data-lucide="mail" class="w-6 h-6"></i>
                </div>
                <h2 class="text-lg font-bold text-slate-900">Talent & HR Contacts</h2>
                <div class="text-xs text-slate-600 leading-relaxed space-y-2">
                    <div>
                        <span class="text-slate-400 block">General Recruitment:</span>
                        <span class="font-semibold text-slate-800">careers-demo@olympia.edu.my</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Internship Placement Coordination:</span>
                        <span class="font-semibold text-slate-800">internships-demo@olympia.edu.my</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Operating Hours:</span>
                        <span class="text-slate-700">Monday &ndash; Friday, 9:00 AM &ndash; 6:00 PM (MYT)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Help Card -->
        <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200/80 flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="space-y-1 text-center sm:text-left">
                <h3 class="text-base font-bold text-slate-900">Already applied for a vacancy?</h3>
                <p class="text-xs text-slate-500">You can track your application status without needing to contact HR directly.</p>
            </div>
            <a href="{{ route('tracking.index') }}" class="px-5 py-2.5 bg-blue-900 hover:bg-blue-950 text-white font-semibold text-xs rounded-xl shadow-xs transition-colors shrink-0 flex items-center gap-1.5">
                <i data-lucide="compass" class="w-3.5 h-3.5 text-amber-400"></i>
                <span>Open Application Tracker</span>
            </a>
        </div>
    </div>
@endsection
