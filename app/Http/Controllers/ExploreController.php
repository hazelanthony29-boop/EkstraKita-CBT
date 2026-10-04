<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $query = Ekstrakurikuler::with('jadwals')->withCount('pendaftarans');

        // Optional filtering by category
        if ($request->has('kategori') && in_array($request->kategori, ['Ekstrakurikuler', 'Seni & Budaya'])) {
            $query->where('kategori', $request->kategori);
        }

        // Optional search
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_ekskul', 'like', '%' . $request->search . '%');
        }

        // Sorting
        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('nama_ekskul', $request->sort);
        } else {
            // Default sort
            $query->orderBy('nama_ekskul', 'asc');
        }

        $ekstrakurikulers = $query->get();

        // Calculate a nice summary for schedule string (e.g., "Senin & Kamis, 16.00")
        foreach ($ekstrakurikulers as $ekskul) {
            if ($ekskul->jadwals->count() > 0) {
                $days = $ekskul->jadwals->pluck('hari')->unique()->toArray();
                $dayStr = implode(' & ', $days);
                // get the earliest start time
                $time = \Carbon\Carbon::parse($ekskul->jadwals->first()->jam_mulai)->format('H.i');
                $ekskul->jadwal_summary = $dayStr . ', ' . $time;
            } else {
                $ekskul->jadwal_summary = 'Jadwal belum ditentukan';
            }
        }

        return view('siswa.explore', compact('ekstrakurikulers'));
    }
}
