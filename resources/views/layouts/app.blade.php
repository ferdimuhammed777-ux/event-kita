<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="transition-colors duration-300 dark:bg-slate-900">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EventKita</title>

    <!-- Terapkan tema sedini mungkin agar tidak terjadi flash -->
    <script>
        (function () {
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative bg-gradient-to-br from-blue-50 via-indigo-50 to-violet-100 dark:from-slate-900 dark:via-slate-900 dark:to-slate-800 font-sans text-slate-800 dark:text-slate-100 antialiased min-h-screen flex flex-col transition-colors duration-300">

    <!-- Pola background dekoratif -->
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 bg-grid-pattern"></div>

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 w-full bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-200/70 dark:border-slate-700/60 shadow-[0_6px_24px_-16px_rgba(79,70,229,0.45)] transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2.5">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 via-violet-500 to-purple-600 text-white flex items-center justify-center rounded-xl font-extrabold text-lg shadow-lg shadow-indigo-500/30">
                        EK
                    </div>
                    <a href="/" class="text-xl font-extrabold tracking-tight bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 bg-clip-text text-transparent">EventKita</a>
                </div>

                <!-- Menu -->
                <div class="flex items-center gap-2 sm:gap-4 text-sm font-medium text-slate-600 dark:text-slate-300">
                    <a href="/" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors hidden sm:block">Home</a>
                    <a href="/#upcoming" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors hidden sm:block">Events</a>

                    @auth
                        <a href="{{ route('user.dashboard') }}" class="text-indigo-600 dark:text-indigo-400 font-semibold hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-slate-500 dark:text-slate-400 hover:text-red-500 dark:hover:text-red-400 transition-colors">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-700 dark:text-slate-200 font-semibold hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Log in</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-5 py-2.5 rounded-xl font-semibold shadow-lg shadow-indigo-500/30 hover:shadow-xl hover:shadow-indigo-500/40 hover:-translate-y-0.5 transition-all duration-200">
                            Register
                        </a>
                    @endauth

                    <!-- Toggle Dark Mode -->
                    <button id="theme-toggle" type="button" aria-label="Toggle dark mode"
                        class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white text-slate-600 hover:text-indigo-600 hover:border-indigo-300 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-700 dark:hover:text-amber-300 dark:hover:border-amber-400/50 shadow-sm transition-all duration-200">
                        <!-- Ikon Bulan (tampil di light mode) -->
                        <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <!-- Ikon Matahari (tampil di dark mode) -->
                        <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="relative z-10 flex-grow w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="relative z-10 bg-slate-900 dark:bg-slate-950 mt-auto w-full border-t border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 text-white flex items-center justify-center rounded-lg font-bold text-sm shadow-lg shadow-indigo-500/30">
                    EK
                </div>
                <span class="text-white font-bold tracking-tight">EventKita</span>
            </div>
            <p class="text-slate-400 text-sm">&copy; 2026 EventKita. All rights reserved.</p>
            <div class="flex gap-6 text-slate-400 text-sm">
                <a href="#" class="hover:text-indigo-400 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-indigo-400 transition-colors">Terms of Service</a>
            </div>
        </div>
    </footer>
</body>
</html>
