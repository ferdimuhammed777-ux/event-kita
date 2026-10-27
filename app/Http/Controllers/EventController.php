<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function dashboard()
    {
        $admin = Auth::guard('admin')->user();
        
        // Ambil statistik sederhana untuk dashboard
        $totalEvents = Event::where('admin_id', $admin->id)->count();
        
        // Ambil 5 event terbaru buatan admin ini
        $events = Event::where('admin_id', $admin->id)->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalEvents', 'events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kuota' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:draft,publish',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Tambahkan validasi gambar
        ]);

        // Logika Upload Gambar
        $posterPath = null;
        if ($request->hasFile('poster')) {
            // Simpan gambar ke folder storage/app/public/posters
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        Event::create([
            'admin_id' => Auth::guard('admin')->id(),
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . Str::random(5),
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kuota' => $request->kuota,
            'harga' => $request->harga,
            'poster' => $posterPath, // Simpan path-nya ke database
            'status' => $request->status,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Event berhasil dibuat!');
    }

    public function index()
    {
        // Hanya ambil event yang statusnya 'publish', urutkan dari yang terbaru
        $events = Event::where('status', 'publish')->latest()->get();
        return view('welcome', compact('events'));
    }

    // 2. Menampilkan Detail Event (untuk halaman pendaftaran)
    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        
        // Cek apakah user yang login sudah mendaftar event ini
        $sudahDaftar = false;
        if (Auth::check()) {
            $sudahDaftar = \App\Models\Registrasi::where('user_id', Auth::id())
                            ->where('event_id', $event->id)
                            ->exists();
        }

        return view('event.detail', compact('event', 'sudahDaftar'));
    }
}