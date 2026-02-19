<?php

namespace App\Http\Controllers;

use App\Models\Properti;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Banner;

class AdminController extends Controller
{
    // ======================================
    // BERANDA
    // ======================================
    public function beranda()
    {
        $totalProperti = Properti::count();

        $totalPemilik = User::where('role', 'pemilik')->count();

        $menunggu = Properti::where('status', 'menunggu')->count();

        $totalAktif = Properti::where('status', 'disetujui')->count();

        $menungguPembayaran = Properti::where('status', 'menunggu_verifikasi_pembayaran')
            ->whereNotNull('bukti_pembayaran')
            ->count();

        $properti = Properti::where('status', 'disetujui')
            ->latest()
            ->get();

        return view('admin.beranda', compact(
            'totalProperti',
            'totalPemilik',
            'totalAktif',
            'menunggu',
            'menungguPembayaran',
            'properti'
        ));
    }

    // ======================================
    // UNGGULAN
    // ======================================
    public function unggulan(Request $request)
    {
        Properti::where('status', 'disetujui')
            ->update(['is_unggulan' => 0]);

        if ($request->properti) {
            Properti::whereIn('properti_id', $request->properti)
                ->where('status', 'disetujui')
                ->update(['is_unggulan' => 1]);
        }

        return back()->with('success', 'Properti unggulan berhasil diperbarui.');
    }

    // ======================================
    // LIST VERIFIKASI PROPERTI
    // ======================================
    public function verifikasi()
    {
        $properti = Properti::where('status', 'menunggu')
            ->latest()
            ->get();

        return view('admin.verifikasi', compact('properti'));
    }

    // ======================================
    // DETAIL PROPERTI
    // ======================================
    public function detail($id)
    {
        $properti = Properti::where('properti_id', $id)
            ->firstOrFail();

        return view('admin.detail', compact('properti'));
    }

    // ======================================
    // PROSES VERIFIKASI PROPERTI
    // ======================================
    public function verifikasiProses(Request $request, $id, $aksi)
    {
        $properti = Properti::where('properti_id', $id)
            ->where('status', 'menunggu')
            ->firstOrFail();

        if ($aksi === 'setujui') {
            $properti->update([
                'status' => 'disetujui',
                'alasan_penolakan' => null
            ]);
        }

        if ($aksi === 'tolak') {

            $request->validate([
                'alasan_penolakan' => 'required|string'
            ]);

            $properti->update([
                'status' => 'ditolak',
                'is_unggulan' => 0,
                'alasan_penolakan' => $request->alasan_penolakan
            ]);
        }

        return redirect()->route('admin.verifikasi')
            ->with('success', 'Status properti berhasil diperbarui.');
    }

    // ======================================
    // FORM UPLOAD BANNER
    // ======================================
    public function uploadBannerForm()
    {
        return view('admin.upload');
    }

    // ======================================
    // STORE BANNER
    // ======================================
    public function uploadBanner(Request $request)
    {
        $request->validate([
            'gambar_banner' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ], [
            'gambar_banner.required' => 'Gambar banner wajib diisi.',
            'gambar_banner.image' => 'File harus berupa gambar.',
            'gambar_banner.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'gambar_banner.max' => 'Ukuran gambar maksimal 5MB.',

            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_mulai.date' => 'Format tanggal mulai tidak valid.',

            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.date' => 'Format tanggal selesai tidak valid.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
        ]);


        $path = $request->file('gambar_banner')
            ->store('banner', 'public');

        Banner::create([
            'gambar_banner' => $path,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('admin.beranda')
            ->with('success', 'Banner berhasil diupload.');
    }

    // ======================================
    // LIST PEMBAYARAN (SUDAH UPLOAD BUKTI)
    // ======================================
    public function pembayaran()
    {
        $properti = Properti::where('status', 'menunggu_verifikasi_pembayaran')
            ->whereNotNull('bukti_pembayaran')
            ->latest()
            ->get();

        return view('admin.pembayaran', compact('properti'));
    }

    // ======================================
    // DETAIL PEMBAYARAN
    // ======================================
    public function detailPembayaran($id)
    {
        $properti = Properti::where('properti_id', $id)
            ->where('status', 'menunggu_verifikasi_pembayaran')
            ->whereNotNull('bukti_pembayaran')
            ->firstOrFail();

        return view('admin.detailpembayaran', compact('properti'));
    }

    // ======================================
    // VALIDASI PEMBAYARAN
    // ======================================
    public function validasiPembayaran($id)
    {
        $properti = Properti::where('properti_id', $id)
            ->where('status', 'menunggu_verifikasi_pembayaran')
            ->whereNotNull('bukti_pembayaran')
            ->firstOrFail();

        $properti->update([
            'status' => 'menunggu'
        ]);

        return redirect()->route('admin.pembayaran')
            ->with('success', 'Pembayaran berhasil divalidasi.');
    }
}
