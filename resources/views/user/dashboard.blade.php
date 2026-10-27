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
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-blue-700 bg-blue-50 font-bold">My Registrations</a>
                <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-50 transition-colors">My Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-red-50 text-slate-600 hover:text-red-600 transition-colors text-left mt-2">Logout</button>
                </form>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="w-full md:w-3/4">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-6">Dashboard</h1>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 border border-green-200 font-medium">{{ session('success') }}</div>
        @endif

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-200 bg-slate-50">
                <h2 class="text-xl font-bold text-slate-800">My Registered Events</h2>
            </div>
            <!-- overflow-x-auto agar tabel bisa di-scroll di HP -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[600px]">
                    <thead class="text-slate-500 text-xs uppercase font-semibold">
                        <tr>
                            <th class="p-5 border-b">Event Name</th>
                            <th class="p-5 border-b">Reg Code</th>
                            <th class="p-5 border-b">Status</th>
                            <th class="p-5 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($registrasis as $reg)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="p-5">
                                <div class="font-bold text-slate-900">{{ $reg->event->judul ?? 'Event Dihapus' }}</div>
                            </td>
                            <td class="p-5">
                                <span class="bg-slate-100 text-slate-700 font-mono text-sm px-2.5 py-1 rounded-md border border-slate-200">{{ $reg->kode_registrasi }}</span>
                            </td>
                            <td class="p-5">
                                @if($reg->status == 'pending')
                                    <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold">PENDING</span>
                                @elseif($reg->status == 'diterima')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">ACCEPTED</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">REJECTED</span>
                                @endif
                            </td>
                            <td class="p-5">
                                <a href="{{ route('user.ticket', $reg->kode_registrasi) }}" class="inline-block bg-white border border-slate-300 text-slate-700 px-4 py-1.5 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors">View Ticket</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="p-8 text-center text-slate-500">Belum ada event yang didaftarkan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection