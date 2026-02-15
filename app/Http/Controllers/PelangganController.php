<?php

namespace App\Http\Controllers;

use App\Models\Properti;
use App\Models\Banner;
use Illuminate\Support\Carbon;

class PelangganController extends Controller
{
    // ===============================
    // BERANDA
    // ===============================
    public function beranda()
    {
        // Banner aktif (hanya 1)
        $banner = Banner::whereDate('tanggal_mulai', '<=', Carbon::today())
                        ->whereDate('tanggal_selesai', '>=', Carbon::today())
                        ->latest()
                        ->first();

        // Properti unggulan
        $properti = Properti::where('status', 'disetujui')
                            ->where('is_unggulan', 1)
                            ->latest()
                            ->get();

        return view('pelanggan.beranda', compact('banner', 'properti'));
    }


    // ===============================
    // HALAMAN SEMUA PROPERTI
    // ===============================
    public function properti()
    {
        // Properti unggulan
        $unggulan = Properti::where('status', 'disetujui')
                            ->where('is_unggulan', 1)
                            ->latest()
                            ->get();

        // Semua properti (kecuali unggulan supaya tidak dobel)
        $properti = Properti::where('status', 'disetujui')
                            ->where('is_unggulan', 0)
                            ->latest()
                            ->get();

        return view('pelanggan.properti', compact('unggulan', 'properti'));
    }


    // ===============================
    // DETAIL PROPERTI
    // ===============================
    public function detail($id)
    {
        $properti = Properti::where('properti_id', $id)
                            ->where('status', 'disetujui')
                            ->firstOrFail();

        return view('pelanggan.detail', compact('properti'));
    }


    // ===============================
    // KONTAK
    // ===============================
    public function kontak()
    {
        return view('pelanggan.kontak');
    }
}
