@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-140px)] px-4 py-8">
    <div class="flex w-full max-w-5xl bg-white dark:bg-slate-800 rounded-3xl shadow-2xl shadow-indigo-500/10 overflow-hidden border border-slate-100 dark:border-slate-700 flex-row-reverse transition-colors duration-300">

        <!-- Kanan: Ilustrasi (dibalik agar beda dengan login) -->
        <div class="hidden md:flex md:w-1/2 relative overflow-hidden bg-gradient-to-br from-purple-700 via-indigo-700 to-blue-700 p-10 flex-col justify-between">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.4) 1px, transparent 0); background-size: 24px 24px;"></div>
            <div class="absolute -top-16 -left-16 w-64 h-64 bg-blue-400/40 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -right-16 w-72 h-72 bg-fuchsia-400/30 rounded-full blur-3xl"></div>

            <div class="relative z-10">
                <div class="w-12 h-12 bg-white/15 border border-white/25 rounded-2xl flex items-center justify-center text-white text-xl backdrop-blur-sm">
                    🚀
                </div>
            </div>

            <div class="relative z-10 text-white">
                <h2 class="text-3xl font-extrabold mb-4 leading-tight">Mulai<br>Petualanganmu!</h2>
                <p class="text-indigo-100/90 mb-8 leading-relaxed">Buat akun gratis dan dapatkan akses ke berbagai event eksklusif di sekitarmu.</p>
                <div class="w-full h-44 bg-white/10 rounded-2xl border border-white/20 flex flex-col items-center justify-center backdrop-blur-sm gap-2">
                    <span class="text-3xl">🎉</span>
                    <span class="text-white/70 text-sm">Ratusan event menantimu</span>
                </div>
            </div>

            <div class="relative z-10 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-white/80"></span>
                <span class="w-2 h-2 rounded-full bg-white/40"></span>
                <span class="w-2 h-2 rounded-full bg-white/20"></span>
            </div>
        </div>

        <!-- Kiri: Form Register -->
        <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
            <div class="mb-6 text-center md:text-left">
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white">Create Account</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1.5">Lengkapi data dirimu di bawah ini.</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 p-4 rounded-xl mb-6 text-sm border border-red-100 dark:border-red-500/20">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('/register') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" class="w-full border border-slate-200 dark:border-slate-600 bg-slate-50/60 dark:bg-slate-900/60 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 px-4 py-3 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-900 transition-all outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Email Address</label>
                    <input type="email" name="email" class="w-full border border-slate-200 dark:border-slate-600 bg-slate-50/60 dark:bg-slate-900/60 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 px-4 py-3 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-900 transition-all outline-none" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Password</label>
                        <input type="password" name="password" class="w-full border border-slate-200 dark:border-slate-600 bg-slate-50/60 dark:bg-slate-900/60 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 px-4 py-3 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-900 transition-all outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Konfirmasi</label>
                        <input type="password" name="password_confirmation" class="w-full border border-slate-200 dark:border-slate-600 bg-slate-50/60 dark:bg-slate-900/60 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 px-4 py-3 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-900 transition-all outline-none" required>
                    </div>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold py-3.5 rounded-xl hover:shadow-lg hover:shadow-indigo-500/40 hover:-translate-y-0.5 transition-all duration-200 shadow-md mt-4">
                    Daftar Akun
                </button>
            </form>

            <p class="text-center text-sm text-slate-500 dark:text-slate-400 mt-6">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 font-semibold hover:underline">Login di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
