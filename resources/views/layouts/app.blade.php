<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EventKita</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased min-h-screen flex flex-col">
    
    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-blue-600 text-white flex items-center justify-center rounded-lg font-bold text-lg shadow-md">
                        EK
                    </div>
                    <a href="/" class="text-xl font-extrabold text-slate-900 tracking-tight">EventKita</a>
                </div>
                
                <!-- Menu -->
                <div class="flex items-center gap-4 sm:gap-6 text-sm font-medium text-slate-600">
                    <a href="/" class="hover:text-blue-600 transition-colors hidden sm:block">Home</a>
                    <a href="#" class="hover:text-blue-600 transition-colors hidden sm:block">Events</a>
                    
                    @auth
                        <a href="{{ route('user.dashboard') }}" class="text-blue-600 font-semibold hover:text-blue-700">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-slate-500 hover:text-red-500 transition-colors">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-700 hover:text-blue-600 transition-colors">Log in</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 shadow-sm transition-all">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-auto w-full">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-slate-500 text-sm">&copy; 2026 EventKita. All rights reserved.</p>
            <div class="flex gap-4 text-slate-400 text-sm">
                <a href="#" class="hover:text-blue-600">Privacy Policy</a>
                <a href="#" class="hover:text-blue-600">Terms of Service</a>
            </div>
        </div>
    </footer>
</body>
</html>