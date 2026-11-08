@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 px-4 sm:px-6 lg:px-8 pb-16 flex flex-col md:flex-row gap-8">

    <!-- Sidebar User -->
    <div class="w-full md:w-1/4">
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 transition-colors duration-300">
            <div class="flex items-center gap-4 mb-8 pb-6 border-b border-slate-100 dark:border-slate-700">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-500/30">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <h2 class="font-bold text-slate-900 dark:text-white truncate">{{ Auth::user()->name }}</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <nav class="space-y-1.5 text-slate-600 dark:text-slate-300 text-sm font-medium">
                <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">My Registrations</a>
                <!-- Menu Profile Aktif -->
                <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 font-bold">My Profile</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-red-50 dark:hover:bg-red-500/10 text-slate-600 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400 transition-colors text-left mt-2">Logout</button>
                </form>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="w-full md:w-3/4">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-6">My Profile</h1>

        @if(session('success'))
            <div class="bg-green-50 dark:bg-emerald-500/10 text-green-700 dark:text-emerald-400 p-4 rounded-xl mb-6 border border-green-200 dark:border-emerald-500/20 font-medium">{{ session('success') }}</div>
        @endif

        <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm p-6 md:p-8 max-w-2xl transition-colors duration-300">
            <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all" required>
                    @error('name') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Email Address (Tidak dapat diubah)</label>
                    <input type="email" value="{{ Auth::user()->email }}" class="w-full border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-900/60 text-slate-500 dark:text-slate-400 px-4 py-2.5 rounded-lg cursor-not-allowed" readonly>
                </div>

                <div class="pt-4 border-t border-slate-100 dark:border-slate-700">
                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">Kosongkan bagian ini jika tidak ingin mengganti password.</p>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Password Baru</label>
                            <input type="password" name="password" class="w-full border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                            @error('password') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="w-full border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold px-6 py-2.5 rounded-lg hover:shadow-lg hover:shadow-indigo-500/40 transition-all shadow-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
