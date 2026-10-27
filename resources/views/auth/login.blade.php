@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-140px)] px-4">
    <div class="flex w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-100">
        
        <!-- Kiri: Ilustrasi -->
        <div class="hidden md:flex w-1/2 bg-gradient-to-br from-blue-600 to-indigo-800 p-10 flex-col justify-center relative overflow-hidden">
            <!-- Dekorasi Background -->
            <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            
            <div class="relative z-10 text-white">
                <h2 class="text-3xl font-bold mb-4">Selamat Datang Kembali!</h2>
                <p class="text-blue-100 mb-8 leading-relaxed">Masuk untuk melihat tiket event kamu, mengelola jadwal, dan menemukan event seru lainnya.</p>
                <div class="w-full h-48 bg-white/10 rounded-xl border border-white/20 flex items-center justify-center backdrop-blur-sm">
                    <span class="text-white/50 text-sm">[ Ilustrasi Placeholder ]</span>
                </div>
            </div>
        </div>

        <!-- Kanan: Form Login -->
        <div class="w-full md:w-1/2 p-8 md:p-12">
            <div class="mb-8 text-center md:text-left">
                <h1 class="text-2xl font-extrabold text-slate-900">Login User</h1>
                <p class="text-sm text-slate-500 mt-1">Masukkan email dan password akunmu.</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 text-sm border border-red-100 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Email Address</label>
                    <input type="email" name="email" class="w-full border border-slate-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none" placeholder="nama@email.com" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" class="w-full border border-slate-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none" placeholder="••••••••" required>
                </div>
                <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3 rounded-lg hover:bg-slate-800 transition-colors shadow-md mt-2">
                    Sign In
                </button>
            </form>
            
            <p class="text-center text-sm text-slate-500 mt-8">
                Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection