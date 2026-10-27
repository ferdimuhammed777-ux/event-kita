@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row gap-8">
    
    <!-- Sidebar Admin -->
    <div class="w-full md:w-64">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <h2 class="text-lg font-extrabold text-slate-900 mb-6 border-b pb-4">Admin Panel</h2>
            <nav class="space-y-2 text-sm font-medium text-slate-600">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-blue-700 bg-blue-50 font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.events.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Event
                </a>
                <a href="{{ route('admin.pendaftar') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Verifikasi Pendaftar
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="pt-4 mt-4 border-t">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="w-full md:w-3/4">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-6">Dashboard Admin</h1>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 border border-green-200 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <p class="text-sm font-semibold text-slate-500 mb-1">Total Events</p>
                <h3 class="text-4xl font-extrabold text-blue-600">{{ $totalEvents }}</h3>
            </div>
            <!-- Placeholder Stat Lainnya -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <p class="text-sm font-semibold text-slate-500 mb-1">Total Registrations</p>
                <h3 class="text-4xl font-extrabold text-slate-800">0</h3>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <p class="text-sm font-semibold text-slate-500 mb-1">Pending Approvals</p>
                <h3 class="text-4xl font-extrabold text-amber-500">0</h3>
            </div>
        </div>

        <!-- Recent Events Table -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-200 bg-slate-50/50 flex justify-between items-center">
                <h2 class="text-xl font-bold text-slate-800">Event Terbaru</h2>
                <a href="{{ route('admin.events.create') }}" class="text-sm bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">+ Buat Baru</a>
            </div>
            <table class="w-full text-left border-collapse">
                <thead class="text-slate-500 text-xs uppercase tracking-wider font-semibold bg-white">
                    <tr>
                        <th class="p-5 border-b">Judul Event</th>
                        <th class="p-5 border-b">Tanggal</th>
                        <th class="p-5 border-b">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($events as $event)
                    <tr class="hover:bg-slate-50">
                        <td class="p-5 font-bold text-slate-800">{{ $event->judul }}</td>
                        <td class="p-5 text-sm text-slate-600">{{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}</td>
                        <td class="p-5">
                            @if($event->status == 'publish')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">PUBLISHED</span>
                            @else
                                <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-xs font-bold">DRAFT</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="p-5 text-center text-slate-500">Belum ada event.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection