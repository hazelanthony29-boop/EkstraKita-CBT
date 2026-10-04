<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        
        // Cek jika siswa belum isi rombel/nis, opsional redirect ke profile
        
        // Ambil semua ekstrakurikuler untuk opsi dropdown
        $ekskuls = Ekstrakurikuler::orderBy('nama_ekskul')->get();

        return view('siswa.pendaftaran', compact('user', 'ekskuls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ekskul_id' => 'required|exists:ekstrakurikuler,id',
            'persetujuan' => 'accepted'
        ]);

        $user = auth()->user();

        // Update rombel jika diinput dan belum ada
        if ($request->filled('rombel') && !$user->rombel) {
            $user->update(['rombel' => $request->rombel]);
        }

        // Check jika sudah daftar di ekskul yang sama
        $exists = Pendaftaran::where('siswa_id', $user->id)
                    ->where('ekskul_id', $request->ekskul_id)
                    ->exists();

        if ($exists) {
            return back()->withErrors(['ekskul_id' => 'Kamu sudah mendaftar di kegiatan ini.']);
        }

        Pendaftaran::create([
            'siswa_id' => $user->id,
            'ekskul_id' => $request->ekskul_id,
            'tanggal_daftar' => now()->toDateString(),
            'status' => 'Aktif'
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Berhasil mendaftar kegiatan!');
    }
}
