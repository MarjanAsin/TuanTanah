<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Properti;
use App\Models\PropertiFoto;
use Illuminate\Support\Facades\Hash;

class PropertiSeeder extends Seeder
{
    public function run(): void
    {
        // ================= USER =================
        $user = User::create([
            'name' => 'Pemilik Demo',
            'email' => 'a@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        $data = [

            // ================= SUDAH BAYAR (MENUNGGU VERIFIKASI) =================
            ['nama' => 'Rumah Menunggu Pembayaran', 'status' => 'menunggu', 'bayar' => 'pending'],
            ['nama' => 'Tanah Menunggu Pembayaran', 'status' => 'menunggu', 'bayar' => 'pending'],
            ['nama' => 'Ruko Menunggu Pembayaran', 'status' => 'menunggu', 'bayar' => 'pending'],

            // ================= LOLOS PEMBAYARAN (MASUK ADMIN PROPERTI) =================
            ['nama' => 'Rumah Siap Diverifikasi', 'status' => 'menunggu', 'bayar' => 'valid'],
            ['nama' => 'Apartemen Siap Diverifikasi', 'status' => 'menunggu', 'bayar' => 'valid'],
            ['nama' => 'Tanah Siap Diverifikasi', 'status' => 'menunggu', 'bayar' => 'valid'],

            // ================= SUDAH DISETUJUI =================
            ['nama' => 'Rumah Disetujui', 'status' => 'disetujui', 'bayar' => 'valid'],
            ['nama' => 'Apartemen Disetujui', 'status' => 'disetujui', 'bayar' => 'valid'],
            ['nama' => 'Tanah Disetujui', 'status' => 'disetujui', 'bayar' => 'valid'],

            // ================= DITOLAK PROPERTI =================
            ['nama' => 'Rumah Ditolak', 'status' => 'ditolak', 'bayar' => 'valid', 'tolak' => 'Foto tidak jelas'],
            ['nama' => 'Tanah Ditolak', 'status' => 'ditolak', 'bayar' => 'valid', 'tolak' => 'Data tidak lengkap'],
            ['nama' => 'Ruko Ditolak', 'status' => 'ditolak', 'bayar' => 'valid', 'tolak' => 'Deskripsi tidak sesuai'],

            // ================= DITOLAK PEMBAYARAN =================
            ['nama' => 'Rumah Pembayaran Ditolak', 'status' => 'menunggu', 'bayar' => 'ditolak', 'tolak_bayar' => 'Bukti tidak valid'],
            ['nama' => 'Tanah Pembayaran Ditolak', 'status' => 'menunggu', 'bayar' => 'ditolak', 'tolak_bayar' => 'Nominal kurang'],
            ['nama' => 'Ruko Pembayaran Ditolak', 'status' => 'menunggu', 'bayar' => 'ditolak', 'tolak_bayar' => 'Transfer gagal'],

        ];

        foreach ($data as $item) {

            $properti = Properti::create([
                'user_id' => $user->id,
                'nama_properti' => $item['nama'],
                'harga' => rand(200000000, 900000000),
                'lokasi' => ['Jakarta','Bogor','Depok','Bekasi'][rand(0,3)],
                'deskripsi' => 'Properti strategis dan nyaman untuk keluarga.',
                'fasilitas' => 'AC,Wifi,Parkir',
                'kontak_whatsapp' => '081234567890',
                'status' => $item['status'],
                'status_pembayaran' => $item['bayar'],
                'is_unggulan' => rand(0,1),
                'tipe_properti' => ['rumah','tanah','ruko','apartemen'][rand(0,3)],
                'luas_tanah' => rand(50, 200),
                'jumlah_kamar' => rand(1, 5),
                'bukti_pembayaran' => $item['bayar'] == 'pending' ? 'dummy/bukti.jpg' : null,
                'alasan_penolakan' => $item['tolak'] ?? null,
                'alasan_penolakan_pembayaran' => $item['tolak_bayar'] ?? null,
            ]);

            // ================= FOTO =================
            for ($i = 1; $i <= 3; $i++) {
                PropertiFoto::create([
                    'properti_id' => $properti->properti_id,
                    'path' => 'dummy/properti' . $i . '.jpg'
                ]);
            }
        }
    }
}
