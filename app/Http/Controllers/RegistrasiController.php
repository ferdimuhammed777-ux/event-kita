<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registrasi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegistrasiController extends Controller
{
    // ==========================================
    // FITUR UNTUK USER (PESERTA)
    // ==========================================

    // 1. Menampilkan Dashboard User (Riwayat Pendaftaran)
    public function index()
    {
        $registrasis = Registrasi::with('event')
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();
                        
        return view('user.dashboard', compact('registrasis'));
    }

    // 2. Proses Mendaftar Event
    public function store(Request $request, $event_id)
    {
        // Cek apakah user sudah pernah daftar di event ini
        $sudahDaftar = Registrasi::where('user_id', Auth::id())
                        ->where('event_id', $event_id)
                        ->exists();

        if ($sudahDaftar) {
            return back()->with('error', 'Kamu sudah mendaftar di event ini!');
        }

        // Buat kode registrasi unik (misal: EVT-ABCD1234)
        $kodeRegistrasi = 'EVT-' . strtoupper(Str::random(8));

        Registrasi::create([
            'user_id' => Auth::id(),
            'event_id' => $event_id,
            'kode_registrasi' => $kodeRegistrasi,
            'status' => 'pending',
            'tanggal_daftar' => now(),
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Berhasil mendaftar event! Silakan cek tiketmu.');
    }

    // 3. Menampilkan Halaman E-Tiket User
    public function showTicket($kode_registrasi)
    {
        $tiket = Registrasi::with('event')
                    ->where('kode_registrasi', $kode_registrasi)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        return view('user.ticket', compact('tiket'));
    }


    // ==========================================
    // FITUR UNTUK ADMIN (PENYELENGGARA)
    // ==========================================

    // 4. Menampilkan Daftar Pendaftar (Untuk Verifikasi)
    public function adminPendaftar()
    {
        $pendaftars = Registrasi::with(['user', 'event'])->latest()->get();
        return view('admin.pendaftar', compact('pendaftars'));
    }

    // 5. Memproses Terima/Tolak Pendaftaran
    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'catatan' => 'nullable|string'
        ]);

        $registrasi = Registrasi::findOrFail($id);
        $registrasi->update([
            'status' => $request->status,
            'catatan' => $request->catatan
        ]);

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }
}