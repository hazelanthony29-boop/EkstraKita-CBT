<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ekstrakurikuler;
use App\Models\Jadwal;
use App\Models\Pendaftaran;
use App\Models\User;

class EkstraKitaSeeder extends Seeder
{
    public function run(): void
    {
        $pembina = User::where('role', 'Pembina')->first();
        
        $teater = Ekstrakurikuler::create([
            'nama_ekskul' => 'Seni Teater',
            'kategori' => 'Seni & Budaya',
            'deskripsi' => 'Ekstrakurikuler Seni Teater.',
            'pembina_id' => $pembina->id,
        ]);

        $jadwal = Jadwal::create([
            'ekskul_id' => $teater->id,
            'nama_kegiatan' => 'Latihan Rutin Teater',
            'hari' => 'Rabu',
            'jam_mulai' => '16:00:00',
            'jam_selesai' => '17:30:00',
        ]);

        $students = User::where('role', 'Siswa')->where('email', '!=', 'siswa@ekstrakita.com')->get();
        
        foreach ($students as $student) {
            Pendaftaran::create([
                'siswa_id' => $student->id,
                'ekskul_id' => $teater->id,
                'status' => 'Diterima',
                'tanggal_daftar' => '2026-09-01',
            ]);
        }
    }
}
