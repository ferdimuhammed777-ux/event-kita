@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row gap-8">
    
    <!-- Sidebar Admin (Sama seperti dashboard) -->
    <div class="w-full md:w-64">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <h2 class="text-lg font-extrabold text-slate-900 mb-6 border-b pb-4">Admin Panel</h2>
            <nav class="space-y-2 text-sm font-medium text-slate-600">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-50 transition-colors">Dashboard</a>
                <a href="{{ route('admin.events.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-50 transition-colors">Tambah Event</a>
                <a href="{{ route('admin.pendaftar') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-blue-700 bg-blue-50 font-bold">Verifikasi Pendaftar</a>
                <form method="POST" action="{{ route('admin.logout') }}" class="pt-4 mt-4 border-t">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors">Logout</button>
                </form>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="w-full md:w-3/4">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-6">Verifikasi Pendaftar</h1>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 border border-green-200 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="text-slate-500 text-xs uppercase tracking-wider font-semibold bg-slate-50">
                    <tr>
                        <th class="p-4 border-b">Nama Peserta</th>
                        <th class="p-4 border-b">Event</th>
                        <th class="p-4 border-b">Status</th>
                        <th class="p-4 border-b text-center">Aksi (Verifikasi)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pendaftars as $p)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4">
                            <div class="font-bold text-slate-800">{{ $p->user->name ?? 'User Dihapus' }}</div>
                            <div class="text-xs text-slate-500">{{ $p->kode_registrasi }}</div>
                        </td>
                        <td class="p-4 text-sm text-slate-700">{{ $p->event->judul ?? 'Event Dihapus' }}</td>
                        <td class="p-4">
                            @if($p->status == 'pending')
                                <span class="bg-amber-100 text-amber-700 px-2 py-1 rounded text-xs font-bold">PENDING</span>
                            @elseif($p->status == 'diterima')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">ACCEPTED</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold">REJECTED</span>
                            @endif
                        </td>
                        <td class="p-4 text-center">
                            @if($p->status == 'pending')
                            <!-- Form Verifikasi -->
                            <form method="POST" action="{{ route('admin.pendaftar.verifikasi', $p->id) }}" class="flex items-center justify-center gap-2">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="status" value="diterima" class="bg-green-500 text-white px-3 py-1.5 rounded text-xs font-bold hover:bg-green-600">Terima</button>
                                <button type="submit" name="status" value="ditolak" class="bg-red-500 text-white px-3 py-1.5 rounded text-xs font-bold hover:bg-red-600">Tolak</button>
                            </form>
                            @else
                            <span class="text-slate-400 text-xs italic">Sudah diverifikasi</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-8 text-center text-slate-500">Belum ada pendaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection