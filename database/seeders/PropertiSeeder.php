<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Properti;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PropertiSeeder extends Seeder
{
    public function run(): void
    {
        // Buat pemilik kalau belum ada
        $pemilik = User::firstOrCreate(
            ['email' => 'pemilik1@gmail.com'],
            [
                'name' => 'Pemilik 1',
                'password' => Hash::make('pemilik1'),
                'role' => 'pemilik'
            ]
        );

        Properti::create([
            'user_id' => $pemilik->id,
            'nama_properti' => 'Rumah Minimalis Modern',
            'harga' => 1000000000,
            'lokasi' => 'Sleman, Yogyakarta',
            'deskripsi' => 'Rumah nyaman dekat kampus dan pusat kota.',
            'fasilitas' => '3 Kamar Tidur | 2 Kamar Mandi | 200m²',
            'kontak_whatsapp' => '081234567890',
            'foto_properti' => 'properti1.jpg',
            'status' => 'disetujui',
            'is_unggulan' => 1
        ]);

        Properti::create([
            'user_id' => $pemilik->id,
            'nama_properti' => 'Rumah Dua Lantai Elegan',
            'harga' => 2000000000,
            'lokasi' => 'Bantul, Yogyakarta',
            'deskripsi' => 'Rumah mewah dengan lokasi strategis.',
            'fasilitas' => '4 Kamar Tidur | 3 Kamar Mandi | 350m²',
            'kontak_whatsapp' => '081234567891',
            'foto_properti' => 'properti2.jpg',
            'status' => 'disetujui',
            'is_unggulan' => 1
        ]);

        Properti::create([
            'user_id' => $pemilik->id,
            'nama_properti' => 'Rumah Keluarga Nyaman',
            'harga' => 800000000,
            'lokasi' => 'Kota Yogyakarta',
            'deskripsi' => 'Cocok untuk keluarga kecil.',
            'fasilitas' => '3 Kamar Tidur | 2 Kamar Mandi | 180m²',
            'kontak_whatsapp' => '081234567892',
            'foto_properti' => 'properti3.jpg',
            'status' => 'disetujui',
            'is_unggulan' => 0
        ]);

        Properti::create([
            'user_id' => $pemilik->id,
            'nama_properti' => 'Rumah Asri Dekat Sawah',
            'harga' => 950000000,
            'lokasi' => 'Sleman',
            'deskripsi' => 'Lingkungan tenang dan asri.',
            'fasilitas' => '2 Kamar Tidur | 1 Kamar Mandi | 150m²',
            'kontak_whatsapp' => '081234567893',
            'foto_properti' => 'properti4.jpg',
            'status' => 'disetujui',
            'is_unggulan' => 0
        ]);
    }
}
