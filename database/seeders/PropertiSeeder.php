<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Properti;
use App\Models\User;

class PropertiSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role', 'pemilik')->first();

        if (!$user) {
            $user = User::factory()->create([
                'role' => 'pemilik'
            ]);
        }

        // ===============================
        // 10 DISSETUJUI - UNGGULAN
        // ===============================
        for ($i = 1; $i <= 10; $i++) {
            Properti::create([
                'user_id' => $user->id,
                'nama_properti' => "Disetujui Unggulan $i",
                'fasilitas' => '3 Kamar Tidur | 2 Kamar Mandi | 120m²',
                'foto_properti' => 'properti/default.jpg',
                'lokasi' => 'Sleman, Yogyakarta',
                'harga' => rand(300000000, 2000000000),
                'kontak_whatsapp' => '081234567890',
                'deskripsi' => 'Properti unggulan dengan lokasi strategis.',
                'status' => 'disetujui',
                'is_unggulan' => 1,
                'bukti_pembayaran' => null,
            ]);
        }

        // ===============================
        // 10 DISSETUJUI - BIASA
        // ===============================
        for ($i = 1; $i <= 10; $i++) {
            Properti::create([
                'user_id' => $user->id,
                'nama_properti' => "Disetujui Biasa $i",
                'fasilitas' => '3 Kamar Tidur | 2 Kamar Mandi | 120m²',
                'foto_properti' => 'properti/default.jpg',
                'lokasi' => 'Sleman, Yogyakarta',
                'harga' => rand(300000000, 2000000000),
                'kontak_whatsapp' => '081234567890',
                'deskripsi' => 'Properti biasa dengan harga terjangkau.',
                'status' => 'disetujui',
                'is_unggulan' => 0,
                'bukti_pembayaran' => null,
            ]);
        }

        // ===============================
        // STATUS LAIN (masing-masing 10)
        // ===============================
        $statuses = ['menunggu', 'ditolak', 'menunggu_pembayaran'];

        foreach ($statuses as $status) {
            for ($i = 1; $i <= 10; $i++) {
                Properti::create([
                    'user_id' => $user->id,
                    'nama_properti' => ucfirst($status) . " Properti $i",
                    'fasilitas' => '3 Kamar Tidur | 2 Kamar Mandi | 120m²',
                    'foto_properti' => 'properti/default.jpg',
                    'lokasi' => 'Sleman, Yogyakarta',
                    'harga' => rand(300000000, 2000000000),
                    'kontak_whatsapp' => '081234567890',
                    'deskripsi' => 'Properti dengan status ' . $status,
                    'status' => $status,
                    'is_unggulan' => 0,
                    'bukti_pembayaran' => $status === 'menunggu_pembayaran'
                        ? 'bukti/default.jpg'
                        : null,
                ]);
            }
        }
    }
}
