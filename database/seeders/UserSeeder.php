<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin EkstraKita',
            'email' => 'admin@ekstrakita.com',
            'password' => Hash::make('password'),
            'role' => 'Admin',
            'nip_nis' => 'ADMIN001'
        ]);

        User::create([
            'name' => 'Pembina Ekskul',
            'email' => 'pembina@ekstrakita.com',
            'password' => Hash::make('password'),
            'role' => 'Pembina',
            'nip_nis' => '123456789'
        ]);

        User::create([
            'name' => 'Siswa Example',
            'email' => 'siswa@ekstrakita.com',
            'password' => Hash::make('password'),
            'role' => 'Siswa',
            'nip_nis' => '987654321',
            'rombel' => 'PPLG XI-4',
        ]);

        User::create([
            'name' => 'Alya Putri Ramadhani',
            'email' => 'alya@ekstrakita.com',
            'password' => Hash::make('password'),
            'role' => 'Siswa',
            'nip_nis' => '12610000',
            'rombel' => 'DKV X-1',
        ]);

        User::create([
            'name' => 'Bagas Aditya Pratama',
            'email' => 'bagas@ekstrakita.com',
            'password' => Hash::make('password'),
            'role' => 'Siswa',
            'nip_nis' => '12610001',
            'rombel' => 'TJKT X-3',
        ]);

        User::create([
            'name' => 'Citra Lestari',
            'email' => 'citra@ekstrakita.com',
            'password' => Hash::make('password'),
            'role' => 'Siswa',
            'nip_nis' => '12510989',
            'rombel' => 'KLN XI-2',
        ]);
    }
}
