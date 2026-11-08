@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 px-4 sm:px-6 lg:px-8 pb-16 flex flex-col md:flex-row gap-8">

    <!-- Sidebar User -->
    <aside class="w-full md:w-1/4">
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 md:sticky md:top-24 transition-colors duration-300">
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
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    My Registrations
                </a>
                <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    My Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-red-50 dark:hover:bg-red-500/10 text-slate-600 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400 transition-colors text-left mt-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="w-full md:w-3/4">
        <div class="mb-6">
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">Area Saya</span>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Dashboard</h1>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 p-4 rounded-xl mb-6 border border-emerald-200 dark:border-emerald-500/20 font-medium flex items-center gap-2">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm overflow-hidden transition-colors duration-300">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <h2 class="text-xl font-bold text-slate-800 dark:text-white">My Registered Events</h2>
                <span class="hidden sm:inline-flex text-xs font-semibold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 px-3 py-1 rounded-full">
                    {{ $registrasis->count() ?? 0 }} Event
                </span>
            </div>
            <!-- overflow-x-auto agar tabel bisa di-scroll di HP -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[600px]">
                    <thead class="bg-slate-50 dark:bg-slate-900/60 text-slate-500 dark:text-slate-400 text-xs uppercase tracking-wider font-semibold">
                        <tr>
                            <th class="p-5 border-b border-slate-100 dark:border-slate-700">Event Name</th>
                            <th class="p-5 border-b border-slate-100 dark:border-slate-700">Reg Code</th>
                            <th class="p-5 border-b border-slate-100 dark:border-slate-700">Status</th>
                            <th class="p-5 border-b border-slate-100 dark:border-slate-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($registrasis as $reg)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/40 transition-colors">
                            <td class="p-5">
                                <div class="font-bold text-slate-900 dark:text-white">{{ $reg->event->judul ?? 'Event Dihapus' }}</div>
                            </td>
                            <td class="p-5">
                                <span class="bg-slate-100 dark:bg-slate-900 text-slate-700 dark:text-slate-300 font-mono text-sm px-2.5 py-1 rounded-md border border-slate-200 dark:border-slate-600">{{ $reg->kode_registrasi }}</span>
                            </td>
                            <td class="p-5">
                                @if($reg->status == 'pending')
                                    <span class="bg-amber-400 text-amber-950 px-3 py-1 rounded-full text-xs font-extrabold shadow-sm shadow-amber-500/30">PENDING</span>
                                @elseif($reg->status == 'diterima')
                                    <span class="bg-emerald-500 text-white px-3 py-1 rounded-full text-xs font-extrabold shadow-sm shadow-emerald-500/30">ACCEPTED</span>
                                @else
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-extrabold shadow-sm shadow-red-500/30">REJECTED</span>
                                @endif
                            </td>
                            <td class="p-5">
                                <a href="{{ route('user.ticket', $reg->kode_registrasi) }}" class="inline-block bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-200 px-4 py-1.5 rounded-lg text-sm font-medium hover:bg-indigo-50 dark:hover:bg-slate-600 hover:border-indigo-300 dark:hover:border-indigo-500 hover:text-indigo-700 dark:hover:text-white transition-colors">View Ticket</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center text-slate-500 dark:text-slate-400">
                                <div class="text-4xl mb-2">🎫</div>
                                Belum ada event yang didaftarkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
