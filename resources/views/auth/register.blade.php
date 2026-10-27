@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-140px)] px-4 py-8">
    <div class="flex w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-100 flex-row-reverse">
        
        <!-- Kanan: Ilustrasi (Dibalik agar beda dengan login) -->
        <div class="hidden md:flex w-1/2 bg-gradient-to-br from-indigo-600 to-blue-800 p-10 flex-col justify-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="relative z-10 text-white">
                <h2 class="text-3xl font-bold mb-4">Mulai Petualanganmu!</h2>
                <p class="text-indigo-100 mb-8 leading-relaxed">Buat akun gratis dan dapatkan akses ke berbagai event eksklusif di sekitarmu.</p>
                <div class="w-full h-48 bg-white/10 rounded-xl border border-white/20 flex items-center justify-center backdrop-blur-sm">
                    <span class="text-white/50 text-sm">[ Ilustrasi Placeholder ]</span>
                </div>
            </div>
        </div>

        <!-- Kiri: Form Register -->
        <div class="w-full md:w-1/2 p-8 md:p-12">
            <div class="mb-6 text-center md:text-left">
                <h1 class="text-2xl font-extrabold text-slate-900">Create Account</h1>
                <p class="text-sm text-slate-500 mt-1">Lengkapi data dirimu di bawah ini.</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 text-sm border border-red-100">
                    <ul class="list-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('/register') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" class="w-full border border-slate-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Email Address</label>
                    <input type="email" name="email" class="w-full border border-slate-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                        <input type="password" name="password" class="w-full border border-slate-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Konfirmasi</label>
                        <input type="password" name="password_confirmation" class="w-full border border-slate-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition-colors shadow-md mt-4">
                    Daftar Akun
                </button>
            </form>
            
            <p class="text-center text-sm text-slate-500 mt-6">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Login di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection