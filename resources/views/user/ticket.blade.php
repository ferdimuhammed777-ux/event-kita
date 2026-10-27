@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 px-4 pb-16">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900">E-Ticket Kamu</h1>
        <p class="text-slate-500 mt-1">Tunjukkan tiket ini kepada panitia saat hari-H.</p>
    </div>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-200 relative">
        <div class="bg-blue-600 p-8 text-white text-center">
            <h2 class="text-2xl font-bold mb-1">{{ $tiket->event->judul }}</h2>
            <p class="text-blue-100 text-sm">{{ \Carbon\Carbon::parse($tiket->event->tanggal_mulai)->format('l, d F Y') }}</p>
        </div>

        <div class="p-6 md:p-8">
            <div class="grid grid-cols-2 gap-6 mb-8">
                <div>
                    <p class="text-xs text-slate-400 font-semibold uppercase mb-1">Nama Peserta</p>
                    <p class="font-bold text-slate-900">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400 font-semibold uppercase mb-1">Status</p>
                    @if($tiket->status == 'pending')
                        <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold">MENUNGGU</span>
                    @elseif($tiket->status == 'diterima')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">TERVERIFIKASI</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">DITOLAK</span>
                    @endif
                </div>
                <div>
                    <p class="text-xs text-slate-400 font-semibold uppercase mb-1">Lokasi</p>
                    <p class="font-bold text-slate-900">{{ $tiket->event->lokasi }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400 font-semibold uppercase mb-1">Harga</p>
                    <p class="font-bold text-slate-900">{{ $tiket->event->harga == 0 ? 'Gratis' : 'Rp ' . number_format($tiket->event->harga, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="bg-slate-50 border-2 border-dashed border-slate-300 rounded-2xl p-6 text-center">
                <p class="text-sm text-slate-500 mb-2">Kode Registrasi</p>
                <p class="text-2xl md:text-4xl font-mono font-extrabold tracking-widest text-slate-800 break-all">{{ $tiket->kode_registrasi }}</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-8">
        <a href="{{ route('user.dashboard') }}" class="text-blue-600 font-semibold hover:underline">&larr; Kembali ke Dashboard</a>
    </div>
</div>
@endsection