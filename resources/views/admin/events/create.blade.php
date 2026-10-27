@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 px-4 sm:px-6 lg:px-8 pb-16">
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('admin.dashboard') }}" class="text-slate-500 hover:text-slate-800">&larr; Kembali</a>
        <h1 class="text-2xl font-extrabold text-slate-900">Create Event</h1>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm border border-red-100">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-200">
        <form method="POST" action="{{ route('admin.events.store') }}" class="space-y-6" enctype="multipart/form-data">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Event Title</label>
                <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border border-slate-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Description</label>
                <textarea name="deskripsi" rows="4" class="w-full border border-slate-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>{{ old('deskripsi') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Location</label>
                <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="w-full border border-slate-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Start Date & Time</label>
                    <input type="datetime-local" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="w-full border border-slate-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">End Date & Time</label>
                    <input type="datetime-local" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" class="w-full border border-slate-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Quota (Peserta)</label>
                    <input type="number" name="kuota" value="{{ old('kuota') }}" class="w-full border border-slate-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required min="1">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Price (Rp)</label>
                    <input type="number" name="harga" value="{{ old('harga', 0) }}" class="w-full border border-slate-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required min="0">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Poster Upload (Opsional)</label>
                <input type="file" name="poster" accept="image/*" class="w-full border border-slate-300 px-4 py-2 rounded-lg bg-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-xs text-slate-500 mt-2">Format: JPG, PNG. Maksimal: 2MB.</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Status</label>
                <select name="status" class="w-full border border-slate-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Simpan Sementara)</option>
                    <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish (Tampilkan ke User)</option>
                </select>
            </div>

            <div class="flex gap-4 pt-4 border-t">
                <button type="submit" class="bg-blue-600 text-white font-bold px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors shadow-md">Save Event</button>
                <a href="{{ route('admin.dashboard') }}" class="bg-slate-100 text-slate-700 font-bold px-8 py-3 rounded-lg hover:bg-slate-200 transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection