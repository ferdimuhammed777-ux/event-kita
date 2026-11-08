@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 px-4 pb-16">
    <div class="text-center mb-8">
        <span class="text-xs font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">EventKita</span>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">E-Ticket Kamu</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-1">Tunjukkan tiket ini kepada panitia saat hari-H.</p>
    </div>

    <div class="relative bg-white dark:bg-slate-800 rounded-3xl shadow-2xl shadow-indigo-500/10 border border-slate-200 dark:border-slate-700 overflow-hidden transition-colors duration-300">

        <!-- Header Tiket -->
        <div class="relative bg-gradient-to-br from-indigo-600 via-violet-600 to-purple-700 p-8 text-white text-center overflow-hidden">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.4) 1px, transparent 0); background-size: 22px 22px;"></div>
            <div class="absolute -top-12 -right-10 w-40 h-40 bg-fuchsia-400/40 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-16 -left-10 w-48 h-48 bg-blue-400/30 rounded-full blur-3xl"></div>

            <div class="relative z-10">
                <span class="inline-flex items-center gap-1.5 bg-white/15 border border-white/25 text-white text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-full backdrop-blur-sm mb-4">
                    Official E-Ticket
                </span>
                <h2 class="text-2xl font-extrabold mb-1">{{ $tiket->event->judul }}</h2>
                <p class="text-indigo-100 text-sm">{{ \Carbon\Carbon::parse($tiket->event->tanggal_mulai)->format('l, d F Y') }}</p>
            </div>
        </div>

        <!-- Garis putus-putus dengan potongan melengkung -->
        <div class="relative">
            <div class="absolute -left-3 top-1/2 -translate-y-1/2 w-6 h-6 rounded-full bg-blue-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700"></div>
            <div class="absolute -right-3 top-1/2 -translate-y-1/2 w-6 h-6 rounded-full bg-blue-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700"></div>
            <div class="border-t-2 border-dashed border-slate-200 dark:border-slate-600 mx-4"></div>
        </div>

        <!-- Body Tiket -->
        <div class="p-6 md:p-8">
            <div class="grid grid-cols-2 gap-6 mb-8">
                <div>
                    <p class="text-xs text-slate-400 dark:text-slate-500 font-semibold uppercase tracking-wide mb-1">Nama Peserta</p>
                    <p class="font-bold text-slate-900 dark:text-white">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400 dark:text-slate-500 font-semibold uppercase tracking-wide mb-1">Status</p>
                    @if($tiket->status == 'pending')
                        <span class="inline-block bg-amber-400 text-amber-950 px-3 py-1 rounded-full text-xs font-extrabold shadow-sm shadow-amber-500/30">MENUNGGU</span>
                    @elseif($tiket->status == 'diterima')
                        <span class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-xs font-extrabold shadow-sm shadow-emerald-500/30">TERVERIFIKASI</span>
                    @else
                        <span class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-xs font-extrabold shadow-sm shadow-red-500/30">DITOLAK</span>
                    @endif
                </div>
                <div>
                    <p class="text-xs text-slate-400 dark:text-slate-500 font-semibold uppercase tracking-wide mb-1">Lokasi</p>
                    <p class="font-bold text-slate-900 dark:text-white">{{ $tiket->event->lokasi }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400 dark:text-slate-500 font-semibold uppercase tracking-wide mb-1">Harga</p>
                    <p class="font-bold text-slate-900 dark:text-white">{{ $tiket->event->harga == 0 ? 'Gratis' : 'Rp ' . number_format($tiket->event->harga, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Kode Registrasi -->
            <div class="relative bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-slate-900 dark:to-slate-900 border-2 border-dashed border-indigo-300 dark:border-indigo-500/50 rounded-2xl p-6 text-center">
                <p class="text-xs text-indigo-500 dark:text-indigo-400 font-bold uppercase tracking-widest mb-2">Kode Registrasi</p>
                <p class="text-2xl md:text-4xl font-mono font-extrabold tracking-widest text-indigo-700 dark:text-indigo-300 break-all">{{ $tiket->kode_registrasi }}</p>

                <!-- Barcode dekoratif -->
                <div class="flex items-end justify-center gap-1 mt-5 h-10 opacity-70">
                    <span class="w-1 h-10 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                    <span class="w-0.5 h-7 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                    <span class="w-1.5 h-10 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                    <span class="w-0.5 h-8 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                    <span class="w-1 h-6 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                    <span class="w-0.5 h-10 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                    <span class="w-1.5 h-8 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                    <span class="w-1 h-10 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                    <span class="w-0.5 h-6 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                    <span class="w-1.5 h-9 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                    <span class="w-0.5 h-10 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                    <span class="w-1 h-7 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                    <span class="w-0.5 h-10 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                    <span class="w-1.5 h-8 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                    <span class="w-1 h-10 bg-indigo-800 dark:bg-indigo-300 rounded-sm"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-8">
        <a href="{{ route('user.dashboard') }}" class="inline-flex items-center gap-2 text-indigo-600 dark:text-indigo-400 font-semibold hover:text-indigo-700 dark:hover:text-indigo-300 hover:underline">
            <span aria-hidden="true">&larr;</span> Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
