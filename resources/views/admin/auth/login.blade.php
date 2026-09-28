<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950 antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HR Administrator Sign In | Olympia Education Career</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8 font-sans bg-pattern-grid">

    <div class="w-full max-w-md space-y-8">
        <!-- Logo Treatment -->
        <div class="text-center space-y-3">
            <a href="{{ route('home') }}" class="inline-block group" title="Return to Careers Portal">
                <img src="{{ asset('images/logo-white.png') }}" alt="Olympia Education Malaysia" class="h-12 w-auto mx-auto object-contain group-hover:scale-105 transition-transform duration-200">
            </a>
            <div>
                <h1 class="text-xl font-bold tracking-tight text-white">
                    OLYMPIA HR <span class="text-amber-400">PORTAL</span>
                </h1>
                <p class="text-xs text-slate-400 mt-1">
                    Olympia Education Malaysia &bull; Recruitment Administration
                </p>
            </div>
        </div>

        <!-- Login Form Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 sm:p-10 shadow-2xl space-y-6">
            @if ($errors->any())
                <div class="p-4 rounded-xl bg-rose-950/80 border border-rose-800/60 text-xs text-rose-300 space-y-1">
                    @foreach ($errors->all() as $err)
                        <div class="flex items-center gap-1.5 font-medium">
                            <i data-lucide="alert-circle" class="w-4 h-4 text-rose-400 shrink-0"></i>
                            <span>{{ $err }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            @if (session('info'))
                <div class="p-4 rounded-xl bg-blue-950/80 border border-blue-800/60 text-xs text-blue-300 flex items-center gap-2">
                    <i data-lucide="info" class="w-4 h-4 text-blue-400 shrink-0"></i>
                    <span>{{ session('info') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 rounded-xl bg-rose-950/80 border border-rose-800/60 text-xs text-rose-300 flex items-center gap-2">
                    <i data-lucide="alert-triangle" class="w-4 h-4 text-rose-400 shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.authenticate') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-300 uppercase mb-1">
                        Staff Email Address
                    </label>
                    <div class="relative">
                        <i data-lucide="mail" class="w-4 h-4 text-slate-500 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                        <input type="email" name="email" id="email" required value="{{ old('email', 'admin@olympia.edu.my') }}"
                               placeholder="admin@olympia.edu.my"
                               class="w-full bg-slate-950 border border-slate-700 rounded-xl pl-10 pr-4 py-2.5 text-sm text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-slate-300 uppercase mb-1">
                        Account Password
                    </label>
                    <div class="relative">
                        <i data-lucide="lock" class="w-4 h-4 text-slate-500 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                        <input type="password" name="password" id="password" required value="OlympiaAdmin2026!"
                               placeholder="••••••••••••"
                               class="w-full bg-slate-950 border border-slate-700 rounded-xl pl-10 pr-4 py-2.5 text-sm text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 text-slate-400 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded bg-slate-950 border-slate-700 text-amber-500 focus:ring-amber-500">
                        <span>Remember credentials</span>
                    </label>
                    <span class="text-slate-500 text-[11px]">Protected by CSRF & Rate Limit</span>
                </div>

                <button type="submit" class="w-full py-3 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm rounded-xl transition-all shadow-lg shadow-amber-500/20 flex items-center justify-center gap-2">
                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                    <span>Authenticate into HR Portal</span>
                </button>
            </form>

            <!-- Demonstration Credentials Helper Box for Evaluation -->
            <div class="p-4 bg-slate-950/80 rounded-2xl border border-slate-800 text-xs space-y-1.5 text-slate-400">
                <div class="font-bold text-amber-400 flex items-center gap-1.5">
                    <i data-lucide="key" class="w-3.5 h-3.5"></i>
                    <span>Demonstration HR Administrator Credentials:</span>
                </div>
                <div class="text-[11px] font-mono text-slate-300 space-y-0.5 pt-1">
                    <div><strong>Email:</strong> admin@olympia.edu.my</div>
                    <div><strong>Password:</strong> OlympiaAdmin2026!</div>
                </div>
                <div class="text-[10px] text-slate-500 pt-1 border-t border-slate-800">
                    Pre-seeded demo administrator for Industry Supervisor & Dato review.
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-white transition-colors flex items-center justify-center gap-1">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Return to Olympia Career Public Site</span>
            </a>
        </div>
    </div>

</body>
</html>
