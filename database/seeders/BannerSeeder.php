<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;
use Illuminate\Support\Carbon;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        Banner::create([
            'gambar_banner' => 'banner1.jpg',
            'tanggal_mulai' => Carbon::now()->subDays(1),
            'tanggal_selesai' => Carbon::now()->addDays(30),
        ]);
    }
}
