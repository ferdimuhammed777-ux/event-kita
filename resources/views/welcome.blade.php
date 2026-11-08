@extends('layouts.app')

@section('content')
<div class="relative overflow-hidden pb-16">
    <!-- Dekorasi latar belakang -->
    <div class="pointer-events-none absolute inset-x-0 top-0 h-[560px] bg-gradient-to-b from-indigo-50 via-violet-50/70 to-transparent dark:from-slate-900 dark:via-slate-900 dark:to-transparent"></div>

    <!-- Hero Section -->
    <section class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 md:pt-14">
        <div class="relative bg-gradient-to-br from-indigo-600 via-violet-600 to-blue-700 rounded-[2rem] overflow-hidden shadow-2xl shadow-indigo-500/30">
            <!-- Pattern abstrak -->
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.35) 1px, transparent 0); background-size: 26px 26px;"></div>
            <!-- Blob dekorasi -->
            <div class="absolute -top-20 -right-16 w-72 h-72 bg-fuchsia-400/40 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-12 w-80 h-80 bg-cyan-300/30 rounded-full blur-3xl"></div>
            <div class="absolute top-1/3 left-1/2 w-56 h-56 bg-purple-300/20 rounded-full blur-3xl"></div>

            <div class="relative z-10 flex flex-col items-center justify-center text-center px-6 py-16 md:py-24 min-h-[360px] md:min-h-[440px]">
                <span class="inline-flex items-center gap-2 bg-white/15 border border-white/25 text-white text-xs font-semibold px-4 py-1.5 rounded-full backdrop-blur-sm mb-6">
                    ✨ Platform Event #1 di Indonesia
                </span>

                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-5 tracking-tight leading-tight">
                    Temukan
                    <span class="bg-gradient-to-r from-amber-300 via-yellow-200 to-orange-300 bg-clip-text text-transparent">Event Seru</span>
                    <br class="hidden md:block"> di Sekitarmu
                </h1>

                <p class="text-base md:text-lg text-indigo-100/90 mb-9 max-w-2xl mx-auto leading-relaxed">
                    Temukan pengalaman tak terlupakan. Daftar sekarang dan jadilah bagian dari event-event spektakuler di sekitarmu.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-3">
                    <a href="#upcoming" class="bg-white text-indigo-700 px-8 py-3.5 rounded-full font-bold shadow-xl hover:shadow-2xl hover:-translate-y-0.5 transition-all duration-200">
                        Jelajahi Event
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="bg-white/10 text-white border border-white/30 px-8 py-3.5 rounded-full font-bold backdrop-blur-sm hover:bg-white/20 transition-all duration-200">
                            Daftar Gratis
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="bg-white/10 text-white border border-white/30 px-8 py-3.5 rounded-full font-bold backdrop-blur-sm hover:bg-white/20 transition-all duration-200">
                            Dashboard Saya
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Events -->
    <section id="upcoming" class="relative max-w-7xl mx-auto mt-14 md:mt-20 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">Agenda</span>
                <h2 class="text-2xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-1">Upcoming Events</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1.5 text-sm md:text-base">Jangan lewatkan event terdekat kami.</p>
            </div>
            <a href="#upcoming" class="hidden sm:inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300">
                Lihat semua
                <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <!-- Grid Event -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @forelse($events as $event)
            <div class="group bg-white dark:bg-slate-800 rounded-2xl p-3 shadow-md shadow-slate-200/60 dark:shadow-black/20 border border-slate-100 dark:border-slate-700 flex flex-col hover:shadow-xl hover:shadow-indigo-500/10 hover:-translate-y-1 transition-all duration-300">
                <!-- Poster: tinggi tetap + object-cover agar tidak gepeng -->
                <div class="h-48 bg-slate-200 dark:bg-slate-700 rounded-xl mb-4 relative overflow-hidden">
                    @if($event->poster)
                        <img src="{{ asset('storage/' . $event->poster) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $event->judul }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-indigo-400 text-sm font-semibold bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-slate-700 dark:to-slate-700">No Image</div>
                    @endif

                    <!-- Badge kategori -->
                    <span class="absolute top-3 left-3 {{ $event->harga == 0 ? 'bg-emerald-500' : 'bg-gradient-to-r from-indigo-600 to-purple-600' }} text-white text-[11px] font-bold uppercase tracking-wide px-3 py-1.5 rounded-full shadow-lg">
                        {{ $event->harga == 0 ? 'Gratis' : 'Berbayar' }}
                    </span>
                </div>

                <h3 class="font-bold text-lg md:text-xl text-slate-900 dark:text-white mb-2 line-clamp-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $event->judul }}</h3>

                <div class="text-sm text-slate-500 dark:text-slate-400 space-y-1.5 mb-5 mt-auto">
                    <p class="flex items-center gap-2">
                        <span class="text-base">📅</span>
                        {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="text-base">📍</span>
                        {{ $event->lokasi }}
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="text-base">🎟️</span>
                        Rp {{ number_format($event->harga, 0, ',', '.') }}
                    </p>
                </div>

                <a href="{{ route('event.detail', $event->slug) }}" class="block text-center bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-300 font-bold py-2.5 rounded-xl hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 hover:text-white transition-all duration-200">
                    View Details
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-16 bg-white dark:bg-slate-800 rounded-2xl border border-dashed border-slate-200 dark:border-slate-700">
                <div class="text-4xl mb-3">🎫</div>
                <p class="text-slate-500 dark:text-slate-400 text-lg">Belum ada event yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </section>
</div>
@endsection
