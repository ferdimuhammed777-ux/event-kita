@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-140px)] px-4">
    <div class="w-full max-w-md bg-slate-900 rounded-2xl shadow-2xl overflow-hidden border border-slate-800">
        <div class="p-8">
            <div class="text-center mb-8">
                <div class="w-12 h-12 bg-blue-600 text-white flex items-center justify-center rounded-xl font-bold text-xl mx-auto mb-4 shadow-lg shadow-blue-500/50">
                    A
                </div>
                <h1 class="text-2xl font-extrabold text-white">Admin Portal</h1>
                <p class="text-sm text-slate-400 mt-1">Masuk untuk mengelola event.</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-500/10 text-red-400 p-4 rounded-lg mb-6 text-sm border border-red-500/20 text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.process') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-1">Username</label>
                    <input type="text" name="username" class="w-full bg-slate-800 border border-slate-700 text-white px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" placeholder="admin" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-1">Password</label>
                    <input type="password" name="password" class="w-full bg-slate-800 border border-slate-700 text-white px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" placeholder="••••••••" required>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-500 transition-colors shadow-lg shadow-blue-600/30 mt-2">
                    Login as Admin
                </button>
            </form>
            
            <p class="text-center text-sm text-slate-400 mt-6">
                Kembali ke user? <a href="{{ route('login') }}" class="text-blue-400 font-semibold hover:text-blue-300">Login User</a>
            </p>
        </div>
    </div>
</div>
@endsection