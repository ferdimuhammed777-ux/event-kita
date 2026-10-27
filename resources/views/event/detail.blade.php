@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 px-4 sm:px-6 lg:px-8 pb-16">
    <!-- Breadcrumb / Back -->
    <a href="{{ route('home') }}" class="text-slate-500 hover:text-slate-800 text-sm font-medium mb-6 inline-flex items-center gap-2">
        &larr; Kembali ke Daftar Event
    </a>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="flex flex-col md:flex-row">
            
            <!-- Kiri: Gambar -->
            <div class="w-full md:w-1/2 bg-slate-100 relative min-h-[300px]">
                @if($event->poster)
                    <img src="{{ asset('storage/' . $event->poster) }}" class="absolute inset-0 w-full h-full object-cover" alt="{{ $event->judul }}">
                @else
                    <div class="absolute inset-0 flex items-center justify-center text-slate-400">No Image</div>
                @endif
            </div>

            <!-- Kanan: Detail -->
            <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900 mb-2">{{ $event->judul }}</h1>
                    <p class="text-blue-600 font-bold text-lg mb-6">
                        {{ $event->harga == 0 ? 'Gratis' : 'Rp ' . number_format($event->harga, 0, ',', '.') }}
                    </p>

                    <div class="space-y-4 mb-8 text-slate-700">
                        <div class="flex items-start gap-4">
                            <span class="text-2xl">📅</span>
                            <div>
                                <p class="font-semibold text-slate-900">Tanggal & Waktu</p>
                                <p class="text-sm">{{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('l, d F Y - H:i') }} WIB</p>
                                <p class="text-sm text-slate-500">Selesai: {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d F Y - H:i') }} WIB</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="text-2xl">📍</span>
                            <div>
                                <p class="font-semibold text-slate-900">Lokasi</p>
                                <p class="text-sm">{{ $event->lokasi }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="text-2xl">👥</span>
                            <div>
                                <p class="font-semibold text-slate-900">Kuota Tersedia</p>
                                <p class="text-sm">{{ $event->kuota }} Peserta</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-slate-200 pt-6 mb-8">
                        <h3 class="font-bold text-slate-900 mb-2">Tentang Event</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">{{ $event->deskripsi }}</p>
                    </div>
                </div>

                <!-- Tombol Pendaftaran -->
                <div>
                    @if($sudahDaftar)
                        <div class="bg-green-50 text-green-700 p-4 rounded-xl text-center border border-green-200">
                            <p class="font-bold">✅ Kamu sudah terdaftar di event ini.</p>
                            <a href="{{ route('user.dashboard') }}" class="text-sm underline mt-1 block hover:text-green-800">Lihat Tiketmu di Dashboard</a>
                        </div>
                    @else
                        <form method="POST" action="{{ route('event.daftar', $event->id) }}">
                            @csrf
                            <button type="submit" class="w-full bg-slate-900 text-white font-bold py-4 rounded-xl hover:bg-slate-800 transition-colors shadow-lg shadow-slate-900/20 text-lg">
                                Daftar Sekarang
                            </button>
                        </form>
                        <p class="text-center text-xs text-slate-400 mt-3">Pastikan kamu sudah login sebelum mendaftar.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection