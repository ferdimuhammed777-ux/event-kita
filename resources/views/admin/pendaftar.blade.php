@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row gap-8">

    <!-- Sidebar Admin (sama seperti dashboard) -->
    <aside class="w-full md:w-64">
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 md:sticky md:top-24 transition-colors duration-300">
            <div class="flex items-center gap-2.5 mb-6 border-b border-slate-100 dark:border-slate-700 pb-4">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 text-white flex items-center justify-center rounded-lg font-bold text-sm shadow-lg shadow-indigo-500/30">
                    EK
                </div>
                <h2 class="text-lg font-extrabold text-slate-900 dark:text-white">Admin Panel</h2>
            </div>
            <nav class="space-y-1.5 text-sm font-medium text-slate-600 dark:text-slate-300">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Dashboard</a>
                <a href="{{ route('admin.events.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Tambah Event</a>
                <a href="{{ route('admin.pendaftar') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 font-bold">Verifikasi Pendaftar</a>
                <form method="POST" action="{{ route('admin.logout') }}" class="pt-4 mt-4 border-t border-slate-100 dark:border-slate-700">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2.5 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-xl transition-colors">Logout</button>
                </form>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="w-full md:w-3/4">
        <div class="mb-6">
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">Manajemen</span>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Verifikasi Pendaftar</h1>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 p-4 rounded-xl mb-6 border border-emerald-200 dark:border-emerald-500/20 font-medium flex items-center gap-2">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm overflow-hidden transition-colors duration-300">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[640px]">
                    <thead class="bg-slate-50 dark:bg-slate-900/60 text-slate-500 dark:text-slate-400 text-xs uppercase tracking-wider font-semibold">
                        <tr>
                            <th class="p-4 border-b border-slate-100 dark:border-slate-700">Nama Peserta</th>
                            <th class="p-4 border-b border-slate-100 dark:border-slate-700">Event</th>
                            <th class="p-4 border-b border-slate-100 dark:border-slate-700">Status</th>
                            <th class="p-4 border-b border-slate-100 dark:border-slate-700 text-center">Aksi (Verifikasi)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($pendaftars as $p)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/40 transition-colors">
                            <td class="p-4">
                                <div class="font-bold text-slate-800 dark:text-white">{{ $p->user->name ?? 'User Dihapus' }}</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400 font-mono mt-0.5">{{ $p->kode_registrasi }}</div>
                            </td>
                            <td class="p-4 text-sm text-slate-700 dark:text-slate-300">{{ $p->event->judul ?? 'Event Dihapus' }}</td>
                            <td class="p-4">
                                @if($p->status == 'pending')
                                    <span class="bg-amber-400 text-amber-950 px-3 py-1 rounded-full text-xs font-extrabold shadow-sm shadow-amber-500/30">PENDING</span>
                                @elseif($p->status == 'diterima')
                                    <span class="bg-emerald-500 text-white px-3 py-1 rounded-full text-xs font-extrabold shadow-sm shadow-emerald-500/30">ACCEPTED</span>
                                @else
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-extrabold shadow-sm shadow-red-500/30">REJECTED</span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                @if($p->status == 'pending')
                                <!-- Form Verifikasi -->
                                <form method="POST" action="{{ route('admin.pendaftar.verifikasi', $p->id) }}" class="flex items-center justify-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="status" value="diterima" class="bg-emerald-500 text-white px-3.5 py-1.5 rounded-lg text-xs font-bold shadow-md shadow-emerald-500/30 hover:bg-emerald-600 hover:shadow-lg hover:shadow-emerald-500/40 transition-all">
                                        Terima
                                    </button>
                                    <button type="submit" name="status" value="ditolak" class="bg-red-500 text-white px-3.5 py-1.5 rounded-lg text-xs font-bold shadow-md shadow-red-500/30 hover:bg-red-600 hover:shadow-lg hover:shadow-red-500/40 transition-all">
                                        Tolak
                                    </button>
                                </form>
                                @else
                                <span class="text-slate-400 dark:text-slate-500 text-xs italic">Sudah diverifikasi</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center text-slate-500 dark:text-slate-400">Belum ada pendaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
