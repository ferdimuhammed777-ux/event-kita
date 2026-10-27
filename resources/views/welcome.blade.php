@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-8 px-4 sm:px-6 lg:px-8 pb-16">
    
    <!-- Hero Section -->
    <div class="relative bg-slate-900 rounded-3xl overflow-hidden shadow-xl mb-12">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-indigo-900"></div>
        <div class="relative z-10 flex flex-col items-center justify-center min-h-[300px] md:min-h-[400px] text-center px-4 py-12">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">Discover Amazing Events</h1>
            <p class="text-base md:text-lg text-slate-300 mb-8 max-w-2xl mx-auto">Temukan pengalaman tak terlupakan. Daftar sekarang dan jadilah bagian dari event-event spektakuler di sekitarmu.</p>
            <a href="#upcoming" class="bg-white text-slate-900 px-8 py-3 rounded-full font-bold shadow-lg hover:bg-blue-50 transition-transform duration-200">
                Browse All Events
            </a>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div id="upcoming" class="mb-8">
        <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Upcoming Events</h2>
        <p class="text-slate-500 mt-1 text-sm md:text-base">Jangan lewatkan event terdekat kami.</p>
    </div>

    <!-- Grid Event -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @forelse($events as $event)
        <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl transition-shadow duration-300 border border-slate-100 flex flex-col">
            <!-- Gambar diset tinggi tetap (h-48) dan object-cover agar tidak melar -->
            <div class="h-48 bg-slate-200 rounded-xl mb-4 relative overflow-hidden">
                @if($event->poster)
                    <img src="{{ asset('storage/' . $event->poster) }}" class="w-full h-full object-cover" alt="{{ $event->judul }}">
                @else
                    <div class="w-full h-full flex items-center justify-center text-slate-400 text-sm">No Image</div>
                @endif
            </div>
            <h3 class="font-bold text-lg md:text-xl text-slate-900 mb-1 line-clamp-1">{{ $event->judul }}</h3>
            <div class="text-sm text-slate-500 space-y-1 mb-5 mt-auto">
                <p class="flex items-center gap-2">📅 {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}</p>
                <p class="flex items-center gap-2">📍 {{ $event->lokasi }}</p>
                <p class="flex items-center gap-2">🎟️ Rp {{ number_format($event->harga, 0, ',', '.') }}</p>
            </div>
            <a href="{{ route('event.detail', $event->slug) }}" class="block text-center bg-blue-50 text-blue-700 font-bold py-2.5 rounded-xl hover:bg-blue-600 hover:text-white transition-colors mt-auto">View Details</a>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <p class="text-slate-500 text-lg">Belum ada event yang tersedia saat ini.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection