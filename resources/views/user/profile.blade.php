@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 px-4 sm:px-6 lg:px-8 pb-16 flex flex-col md:flex-row gap-8">
    
    <!-- Sidebar User -->
    <div class="w-full md:w-1/4">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div class="flex items-center gap-4 mb-8 pb-6 border-b border-slate-100">
                <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <h2 class="font-bold text-slate-900 truncate">{{ Auth::user()->name }}</h2>
                    <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <nav class="space-y-2 text-slate-600 text-sm font-medium">
                <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-50 transition-colors">My Registrations</a>
                <!-- Menu Profile Aktif -->
                <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-blue-700 bg-blue-50 font-bold">My Profile</a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-red-50 text-slate-600 hover:text-red-600 transition-colors text-left mt-2">Logout</button>
                </form>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="w-full md:w-3/4">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-6">My Profile</h1>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 border border-green-200 font-medium">{{ session('success') }}</div>
        @endif

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 md:p-8 max-w-2xl">
            <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full border border-slate-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Email Address (Tidak dapat diubah)</label>
                    <input type="email" value="{{ Auth::user()->email }}" class="w-full border border-slate-200 bg-slate-50 text-slate-500 px-4 py-2.5 rounded-lg cursor-not-allowed" readonly>
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <p class="text-sm text-slate-500 mb-4">Kosongkan bagian ini jika tidak ingin mengganti password.</p>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Password Baru</label>
                            <input type="password" name="password" class="w-full border border-slate-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="w-full border border-slate-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="bg-blue-600 text-white font-bold px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors shadow-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection