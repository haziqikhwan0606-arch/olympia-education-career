<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-100 antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'HR Admin Portal | Olympia Education Career')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full font-sans text-slate-800" x-data="{ sidebarOpen: false }">

    <div class="min-h-full flex flex-col lg:flex-row">
        <!-- Mobile Sidebar Backdrop -->
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-xs lg:hidden"></div>

        <!-- Sidebar Navigation -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-950 text-white flex flex-col transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shrink-0 border-r border-slate-800/80">

            <!-- Sidebar Header / Branding -->
            <div class="h-20 px-6 flex items-center justify-between border-b border-slate-800/80 bg-slate-950">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-slate-950 font-black text-lg shadow-md shadow-amber-500/20">
                        O
                    </div>
                    <div>
                        <div class="font-bold text-base tracking-tight text-white leading-tight">
                            OLYMPIA <span class="text-amber-400">HR</span>
                        </div>
                        <div class="text-[11px] uppercase tracking-wider font-semibold text-slate-400">
                            Recruitment Portal
                        </div>
                    </div>
                </a>

                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white p-1 rounded-md">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Current HR Staff Identity Info -->
            <div class="p-4 mx-4 mt-4 rounded-xl bg-slate-900/80 border border-slate-800/80">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-blue-900/80 border border-blue-500/30 flex items-center justify-center text-amber-400 font-bold text-sm shrink-0">
                        {{ substr(auth()->user()->name ?? 'HR', 0, 1) }}
                    </div>
                    <div class="truncate">
                        <div class="text-xs font-semibold text-slate-200 truncate">{{ auth()->user()->name }}</div>
                        <div class="text-[11px] text-amber-400/90 font-medium capitalize">{{ str_replace('_', ' ', auth()->user()->role) }}</div>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                <div class="px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    Recruitment Control
                </div>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Dashboard Overview</span>
                </a>

                <a href="{{ route('admin.vacancies.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.vacancies.*') ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="briefcase" class="w-4 h-4"></i>
                        <span>Vacancy Management</span>
                    </div>
                    <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ request()->routeIs('admin.vacancies.*') ? 'bg-slate-950/20 text-slate-900' : 'bg-slate-800 text-slate-300' }}">
                        {{ \App\Models\JobVacancy::count() }}
                    </span>
                </a>

                <a href="{{ route('admin.applicants.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.applicants.*') ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        <span>Applicant Management</span>
                    </div>
                    @php
                        $pendingCount = \App\Models\Application::where('status', 'Submitted')->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ request()->routeIs('admin.applicants.*') ? 'bg-rose-900 text-white' : 'bg-rose-500 text-white' }}">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </a>

                <div class="pt-6 px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    Quick Actions & Portal
                </div>

                <a href="{{ route('admin.vacancies.create') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-900 hover:text-white transition-all">
                    <i data-lucide="plus-circle" class="w-4 h-4 text-emerald-400"></i>
                    <span>Post New Vacancy</span>
                </a>

                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-900 hover:text-white transition-all">
                    <i data-lucide="external-link" class="w-4 h-4 text-blue-400"></i>
                    <span>View Public Website</span>
                </a>
            </nav>

            <!-- Sidebar Footer / Logout -->
            <div class="p-4 border-t border-slate-800/80 bg-slate-950">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-semibold text-rose-300 bg-rose-950/40 hover:bg-rose-900/50 border border-rose-800/30 transition-colors">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span>Sign Out of HR Portal</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Column -->
        <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
            <!-- Admin Top Bar -->
            <header class="h-20 bg-white border-b border-slate-200/80 px-6 sm:px-8 flex items-center justify-between sticky top-0 z-30 shadow-xs">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div>
                        <h1 class="text-lg font-bold text-slate-900">@yield('page_title', 'HR Dashboard')</h1>
                        <p class="text-xs text-slate-500">Olympia Education Malaysia &bull; Recruitment Administration</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>System Active (MySQL)</span>
                    </span>

                    <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors border border-slate-200">
                        <i data-lucide="globe" class="w-3.5 h-3.5"></i>
                        <span>Live Portal</span>
                    </a>
                </div>
            </header>

            <!-- Admin Alerts -->
            <div class="px-6 sm:px-8 pt-6">
                @if (session('success'))
                    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 flex items-start gap-3 shadow-xs">
                        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"></i>
                        <div class="text-sm font-medium">{{ session('success') }}</div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-800 flex items-start gap-3 shadow-xs">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 shrink-0 mt-0.5"></i>
                        <div class="text-sm font-medium">{{ session('error') }}</div>
                    </div>
                @endif

                @if (session('info'))
                    <div class="mb-6 rounded-xl border border-blue-200 bg-blue-50 p-4 text-blue-800 flex items-start gap-3 shadow-xs">
                        <i data-lucide="info" class="w-5 h-5 text-blue-600 shrink-0 mt-0.5"></i>
                        <div class="text-sm font-medium">{{ session('info') }}</div>
                    </div>
                @endif
            </div>

            <!-- Page Content -->
            <main class="flex-1 px-6 sm:px-8 pb-16">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
