<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ekstrakurikuler;
use App\Models\Jadwal;
use App\Models\User;

class ExploreDataSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada pembina untuk relasi (optional but good)
        $pembina = User::where('role', 'Pembina')->first();
        $pembinaId = $pembina ? $pembina->id : null;

        $ekskuls = [
            'Futsal', 'Basket', 'Volly', 'Sepak Bola', 'Badminton', 'Tenis Meja', 'Catur', 'Taekwondo'
        ];

        $seni = [
            'Seni Suara', 'Seni Musik Modern', 'Seni Teater', 'Seni Lukis', 'Seni Tari', 'Angklung', 'Gamelan'
        ];

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        // Create Ekstrakurikuler
        foreach ($ekskuls as $index => $nama) {
            $e = Ekstrakurikuler::firstOrCreate(
                ['nama_ekskul' => $nama],
                [
                    'kategori' => 'Ekstrakurikuler',
                    'deskripsi' => 'Kegiatan ekstrakurikuler ' . $nama,
                    'pembina_id' => $pembinaId,
                    'logo' => 'https://picsum.photos/seed/' . md5($nama) . '/600/400'
                ]
            );

            // Create jadwal if none exists
            if ($e->jadwals()->count() == 0) {
                $hari1 = $days[$index % 6];
                $hari2 = $days[($index + 2) % 6];
                
                Jadwal::create([
                    'ekskul_id' => $e->id,
                    'nama_kegiatan' => 'Latihan Rutin ' . $nama,
                    'hari' => $hari1,
                    'jam_mulai' => '15:30:00',
                    'jam_selesai' => '17:30:00',
                ]);
                
                Jadwal::create([
                    'ekskul_id' => $e->id,
                    'nama_kegiatan' => 'Latihan Fisik ' . $nama,
                    'hari' => $hari2,
                    'jam_mulai' => '16:00:00',
                    'jam_selesai' => '18:00:00',
                ]);
            }
        }

        // Create Seni & Budaya
        foreach ($seni as $index => $nama) {
            $e = Ekstrakurikuler::firstOrCreate(
                ['nama_ekskul' => $nama],
                [
                    'kategori' => 'Seni & Budaya',
                    'deskripsi' => 'Kegiatan seni dan budaya ' . $nama,
                    'pembina_id' => $pembinaId,
                    'logo' => 'https://picsum.photos/seed/' . md5($nama) . '/600/400'
                ]
            );

            // Create jadwal if none exists
            if ($e->jadwals()->count() == 0) {
                $hari1 = $days[($index + 1) % 6];
                
                Jadwal::create([
                    'ekskul_id' => $e->id,
                    'nama_kegiatan' => 'Latihan ' . $nama,
                    'hari' => $hari1,
                    'jam_mulai' => '16:00:00',
                    'jam_selesai' => '18:00:00',
                ]);
            }
        }
    }
}
