@extends('layouts.app')

@section('title', 'About Us | Olympia Education Career')
@section('meta_description', 'Learn about Olympia Education Malaysia, our pedagogical mission, educational culture, and commitment to student empowerment.')

@section('content')
    <div class="bg-slate-900 text-white py-16 border-b border-slate-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-3">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-400">About Olympia Education</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white">
                Empowering Minds, Shaping Futures
            </h1>
            <p class="text-sm text-slate-300 leading-relaxed">
                Dedicated to academic distinction, innovative higher learning, and industry-aligned undergraduate training across Malaysia.
            </p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
        <!-- Prototype Notice -->
        <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 text-xs text-amber-900 flex items-start gap-3">
            <i data-lucide="info" class="w-5 h-5 text-amber-600 shrink-0 mt-0.5"></i>
            <div>
                <strong class="font-bold">Prototype Demonstration Notice:</strong>
                <p class="mt-0.5 leading-relaxed text-amber-950">
                    This career portal is a standalone prototype developed for presentation and review by Olympia Education's Industry Supervisor and Management. Descriptive text is illustrative of general higher education career themes.
                </p>
            </div>
        </div>

        <section class="space-y-4">
            <h2 class="text-2xl font-bold text-slate-900">Our Institutional Purpose</h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                Olympia Education Malaysia operates with the vision of providing accessible, high-caliber tertiary education and professional pathways. By combining rigorous academic curricula with hands-on corporate partnerships, Olympia equips students with practical capabilities to thrive in dynamic global economies.
            </p>
            <p class="text-sm text-slate-600 leading-relaxed">
                Behind every successful graduate is an extraordinary team of lecturers, student advisors, academic coordinators, and administrative professionals who make education purposeful and inspiring.
            </p>
        </section>

        <!-- Campus & Faculty Imagery Showcase -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="rounded-3xl overflow-hidden border border-slate-200 shadow-sm bg-white group">
                <div class="h-60 overflow-hidden relative">
                    <img src="{{ asset('images/campus-hero.jpg') }}" alt="Olympia Education Campus Atrium" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute bottom-3 left-3 bg-slate-950/80 backdrop-blur-md text-amber-400 text-[11px] font-bold px-2.5 py-1 rounded-full">
                        Modern Campus Facilities
                    </span>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-slate-900 text-sm">Dynamic Higher Education Environment</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">State-of-the-art interactive auditoriums, collaborative learning lounges, and research facilities across Malaysia.</p>
                </div>
            </div>

            <div class="rounded-3xl overflow-hidden border border-slate-200 shadow-sm bg-white group">
                <div class="h-60 overflow-hidden relative">
                    <img src="{{ asset('images/academic-team.jpg') }}" alt="Olympia Academic Leadership & Faculty" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute bottom-3 left-3 bg-slate-950/80 backdrop-blur-md text-amber-400 text-[11px] font-bold px-2.5 py-1 rounded-full">
                        Academic Excellence
                    </span>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-slate-900 text-sm">Collaborative Faculty & Leadership</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">Passionate educators, researchers, and mentors shaping the next generation of professional talent.</p>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-3">
                <div class="w-10 h-10 rounded-xl bg-blue-900 text-amber-400 flex items-center justify-center font-bold">
                    <i data-lucide="compass" class="w-5 h-5"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900">Academic Leadership</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Supporting our faculty members with digital classroom resources, research initiatives, and progressive curriculum development.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-3">
                <div class="w-10 h-10 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center font-bold">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900">Student Centricity</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Fostering an inclusive, caring campus environment where learners receive personalized academic advising and career counseling.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-2xs space-y-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900">Integrity & Quality</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Complying with Malaysian national education standards (MQA) and maintaining transparency across all institutional operations.
                </p>
            </div>
        </section>

        <section class="p-8 rounded-3xl bg-slate-900 text-white flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-1 text-center md:text-left">
                <h3 class="text-lg font-bold text-white">Ready to Shape the Future of Learning?</h3>
                <p class="text-xs text-slate-300">Discover full-time academic, corporate, and internship openings.</p>
            </div>
            <a href="{{ route('careers.index') }}" class="px-6 py-3 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs rounded-xl shadow-xs transition-colors shrink-0">
                Explore Current Vacancies
            </a>
        </section>
    </div>
@endsection
