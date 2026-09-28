<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50 antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Olympia Education Career | Build Your Future With Olympia')</title>
    <meta name="description" content="@yield('meta_description', 'Discover career and internship opportunities at Olympia Education Malaysia. Shape the future of higher education and professional learning.')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="flex min-h-full flex-col font-sans text-slate-800 bg-slate-50" x-data="{ mobileMenuOpen: false }">

    <!-- Top Announcement Bar -->
    <div class="bg-slate-900 text-slate-300 text-xs py-2 px-4 border-b border-slate-800">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-amber-500/20 text-amber-400 border border-amber-500/30">
                    Prototype Demo
                </span>
                <span>Olympia Education Malaysia &bull; Standalone Career & Recruitment Prototype</span>
            </div>
            <div class="flex items-center gap-4 text-slate-400">
                <a href="{{ route('tracking.index') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                    <i data-lucide="compass" class="w-3.5 h-3.5"></i>
                    <span>Track Application</span>
                </a>
                <span class="text-slate-700">|</span>
                <a href="{{ route('admin.login') }}" class="hover:text-white transition-colors flex items-center gap-1 text-[11px] font-medium text-slate-400">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5 text-amber-500"></i>
                    <span>HR Staff Portal</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand Logo / Treatment -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo.png') }}" alt="Olympia Education Malaysia" class="h-11 sm:h-12 w-auto object-contain transition-transform duration-200 group-hover:scale-105">
                    <span class="sr-only">OLYMPIA CAREER</span>
                    <span class="hidden sm:inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-amber-500/10 text-amber-700 border border-amber-500/20 uppercase tracking-wider">
                        Career Portal
                    </span>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                    <a href="{{ route('home') }}" class="transition-colors hover:text-blue-900 {{ request()->routeIs('home') ? 'text-blue-900 font-bold border-b-2 border-amber-500 pb-1' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('careers.index') }}" class="transition-colors hover:text-blue-900 {{ request()->routeIs('careers.*') && !request()->routeIs('internships') ? 'text-blue-900 font-bold border-b-2 border-amber-500 pb-1' : '' }}">
                        Find Jobs
                    </a>
                    <a href="{{ route('internships') }}" class="transition-colors hover:text-blue-900 {{ request()->routeIs('internships') ? 'text-blue-900 font-bold border-b-2 border-amber-500 pb-1' : '' }}">
                        Internships
                    </a>
                    <a href="{{ route('about') }}" class="transition-colors hover:text-blue-900 {{ request()->routeIs('about') ? 'text-blue-900 font-bold border-b-2 border-amber-500 pb-1' : '' }}">
                        About Us
                    </a>
                    <a href="{{ route('contact') }}" class="transition-colors hover:text-blue-900 {{ request()->routeIs('contact') ? 'text-blue-900 font-bold border-b-2 border-amber-500 pb-1' : '' }}">
                        Contact
                    </a>
                </nav>

                <!-- Header Actions -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('tracking.index') }}" class="px-4 py-2 text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors flex items-center gap-1.5 border border-slate-200">
                        <i data-lucide="search" class="w-3.5 h-3.5 text-slate-500"></i>
                        <span>Track Application</span>
                    </a>
                    <a href="{{ route('careers.index') }}" class="px-4 py-2 text-xs font-semibold text-white bg-blue-900 hover:bg-blue-950 rounded-lg shadow-sm hover:shadow transition-all flex items-center gap-1.5">
                        <span>Explore Roles</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-amber-400"></i>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="md:hidden p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none" aria-label="Toggle Navigation">
                    <i data-lucide="menu" class="w-6 h-6" x-show="!mobileMenuOpen"></i>
                    <i data-lucide="x" class="w-6 h-6" x-show="mobileMenuOpen" x-cloak></i>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileMenuOpen" x-cloak class="md:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-3">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-slate-800 hover:bg-slate-50">Home</a>
            <a href="{{ route('careers.index') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-slate-800 hover:bg-slate-50">Find Jobs</a>
            <a href="{{ route('internships') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-slate-800 hover:bg-slate-50">Internship Programs</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-slate-800 hover:bg-slate-50">About Olympia Education</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-slate-800 hover:bg-slate-50">Contact</a>
            <div class="pt-3 border-t border-slate-100 space-y-2">
                <a href="{{ route('tracking.index') }}" class="block w-full text-center px-4 py-2 text-xs font-semibold text-slate-700 bg-slate-100 rounded-lg">
                    Track Application Status
                </a>
                <a href="{{ route('admin.login') }}" class="block w-full text-center px-4 py-2 text-xs font-semibold text-blue-900 bg-blue-50 border border-blue-200 rounded-lg">
                    HR Staff Portal
                </a>
            </div>
        </div>
    </header>

    <!-- Global Toast / Flash Notifications -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 flex items-start gap-3 shadow-xs">
                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"></i>
                <div class="text-sm font-medium">{{ session('success') }}</div>
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-800 flex items-start gap-3 shadow-xs">
                <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 shrink-0 mt-0.5"></i>
                <div class="text-sm font-medium">{{ session('error') }}</div>
            </div>
        @endif

        @if (session('warning'))
            <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-800 flex items-start gap-3 shadow-xs">
                <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-600 shrink-0 mt-0.5"></i>
                <div class="text-sm font-medium">{{ session('warning') }}</div>
            </div>
        @endif

        @if (session('info'))
            <div class="rounded-xl border border-blue-200 bg-blue-50 p-4 text-blue-800 flex items-start gap-3 shadow-xs">
                <i data-lucide="info" class="w-5 h-5 text-blue-600 shrink-0 mt-0.5"></i>
                <div class="text-sm font-medium">{{ session('info') }}</div>
            </div>
        @endif
    </div>

    <!-- Main Content Area -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 border-t border-slate-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
                <!-- Brand Column -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                        <div class="bg-white p-2 rounded-xl inline-block shadow-sm">
                            <img src="{{ asset('images/logo.png') }}" alt="Olympia Education Malaysia" class="h-9 w-auto object-contain">
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-400">
                            Career Portal
                        </span>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed max-w-sm">
                        Discover Your Next Opportunity. Build Your Future With Olympia. Join a community dedicated to academic distinction, student transformation, and educational leadership across Malaysia.
                    </p>
                    <div class="pt-2 text-xs text-slate-400 flex items-center gap-2">
                        <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Campus Recruitment Portal (Standalone Prototype)</span>
                    </div>
                </div>

                <!-- Column 1: Recruitment -->
                <div class="space-y-3">
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-amber-400">Opportunities</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('careers.index', ['type' => 'Full-Time']) }}" class="hover:text-white transition-colors">Academic Careers</a></li>
                        <li><a href="{{ route('careers.index', ['type' => 'Full-Time']) }}" class="hover:text-white transition-colors">Professional Staff</a></li>
                        <li><a href="{{ route('internships') }}" class="hover:text-white transition-colors">Undergraduate Internships</a></li>
                        <li><a href="{{ route('careers.index', ['type' => 'Contract']) }}" class="hover:text-white transition-colors">Project & Contract Roles</a></li>
                    </ul>
                </div>

                <!-- Column 2: Candidate Hub -->
                <div class="space-y-3">
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-amber-400">Candidate Hub</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('tracking.index') }}" class="hover:text-white transition-colors">Application Tracker</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Why Work at Olympia</a></li>
                        <li><a href="{{ route('privacy.notice') }}" class="hover:text-white transition-colors">Applicant Privacy Notice</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Talent Team Inquiries</a></li>
                    </ul>
                </div>

                <!-- Column 3: Contact & Campus -->
                <div class="space-y-3">
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-amber-400">Headquarters</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Olympia Education Malaysia<br>
                        Petaling Jaya Campus / Corporate Offices<br>
                        Selangor Darul Ehsan, Malaysia
                    </p>
                    <p class="text-xs text-slate-400 pt-1">
                        <strong>Talent Acquisition:</strong><br>
                        careers-demo@olympia.edu.my
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-400 hover:text-amber-400 transition-colors">
                            <i data-lucide="lock" class="w-3 h-3"></i>
                            <span>HR Administrator Sign In</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Subfooter -->
            <div class="border-t border-slate-800 mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-4">
                <p>&copy; {{ date('Y') }} Olympia Education Malaysia. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('privacy.notice') }}" class="hover:text-white transition-colors">Candidate Privacy Policy</a>
                    <a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact Support</a>
                    <span class="text-slate-700">&bull;</span>
                    <span class="text-slate-400">Evaluation Prototype for Management Review</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
