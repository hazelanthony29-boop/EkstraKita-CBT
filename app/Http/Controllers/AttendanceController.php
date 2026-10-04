<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ekstrakurikuler;
use App\Models\Pendaftaran;
use App\Models\Jadwal;
use App\Models\Absensi;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(Request $request): View
    {
        $pembina = Auth::user();
        
        // Get all extracurriculars managed by this pembina
        $ekskuls = Ekstrakurikuler::where('pembina_id', $pembina->id)->get();
        
        // Defaults
        $selectedEkskulId = $request->input('ekskul_id', $ekskuls->first()->id ?? null);
        $selectedDate = $request->input('date', date('Y-m-d'));

        $students = collect();
        $existingAbsensi = [];
        $jadwal = null;
        
        if ($selectedEkskulId) {
            // Get students enrolled in this extracurricular
            $pendaftarans = Pendaftaran::where('ekskul_id', $selectedEkskulId)
                                ->where('status', 'Diterima')
                                ->get();
                                
            $studentIds = $pendaftarans->pluck('siswa_id');
            $students = \App\Models\User::whereIn('id', $studentIds)->get();

            // For simplicity, we grab the first schedule of this extracurricular
            $jadwal = Jadwal::where('ekskul_id', $selectedEkskulId)->first();

            if ($jadwal) {
                // Get existing attendance for this date
                $absensi = Absensi::where('jadwal_id', $jadwal->id)
                                  ->where('tanggal_absen', $selectedDate)
                                  ->get();
                $existingAbsensi = $absensi->keyBy('siswa_id')->map->status->toArray();
            }
        }

        return view('attendance.index', compact('ekskuls', 'selectedEkskulId', 'selectedDate', 'students', 'existingAbsensi', 'jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ekskul_id' => 'required|exists:ekstrakurikuler,id',
            'date' => 'required|date',
            'attendance' => 'required|array'
        ]);

        $jadwal = Jadwal::where('ekskul_id', $request->ekskul_id)->first();

        if (!$jadwal) {
            return back()->with('error', 'Tidak ada jadwal untuk ekstrakurikuler ini.');
        }

        foreach ($request->attendance as $siswa_id => $status) {
            if ($status) {
                Absensi::updateOrCreate(
                    [
                        'jadwal_id' => $jadwal->id,
                        'siswa_id' => $siswa_id,
                        'tanggal_absen' => $request->date,
                    ],
                    [
                        'status' => $status,
                    ]
                );
            }
        }

        return back()->with('success', 'Absensi berhasil disimpan!');
    }
}
