<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Properti;

class PemilikController extends Controller
{
    // ======================================
    // BERANDA
    // ======================================
    public function beranda()
    {
        $userId = Auth::id();

        $total = Properti::where('user_id', $userId)->count();

        $menungguPembayaran = Properti::where('user_id', $userId)
                              ->where('status', 'menunggu_pembayaran')
                              ->count();

        $menunggu = Properti::where('user_id', $userId)
                            ->where('status', 'menunggu')
                            ->count();

        $disetujui = Properti::where('user_id', $userId)
                            ->where('status', 'disetujui')
                            ->count();

        $ditolak = Properti::where('user_id', $userId)
                            ->where('status', 'ditolak')
                            ->count();

        $properti = Properti::where('user_id', $userId)
                            ->where('status', 'disetujui')
                            ->latest()
                            ->get();

        return view('pemilik.beranda', compact(
            'total',
            'menungguPembayaran',
            'menunggu',
            'disetujui',
            'ditolak',
            'properti'
        ));
    }

    // ======================================
    // EDIT
    // ======================================
    public function edit($id)
    {
        $properti = Properti::where('properti_id', $id)
                            ->where('user_id', Auth::id())
                            ->firstOrFail();

        return view('pemilik.ubahdata', compact('properti'));
    }

    // ======================================
    // UPDATE
    // ======================================
    public function update(Request $request, $id)
    {
        $properti = Properti::where('properti_id', $id)
                            ->where('user_id', Auth::id())
                            ->firstOrFail();

        $request->validate([
            'nama_properti' => 'required',
            'lokasi' => 'required',
            'fasilitas' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'kontak_whatsapp' => 'required',
            'foto_properti' => 'nullable|image'
        ]);

        if ($request->hasFile('foto_properti')) {

            if ($properti->foto_properti) {
                Storage::delete('public/' . $properti->foto_properti);
            }

            $path = $request->file('foto_properti')
                            ->store('properti', 'public');

            $properti->foto_properti = $path;
        }

        $properti->update([
            'nama_properti' => $request->nama_properti,
            'lokasi' => $request->lokasi,
            'fasilitas' => $request->fasilitas,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'kontak_whatsapp' => $request->kontak_whatsapp,
            'status' => 'menunggu',
        ]);

        return redirect()->route('pemilik.beranda')
                         ->with('success', 'Properti berhasil diperbarui.');
    }

    // ======================================
    // FORM UPLOAD
    // ======================================
    public function upload()
    {
        return view('pemilik.upload');
    }

    // ======================================
    // STORE (Upload Properti)
    // ======================================
    public function store(Request $request)
    {
        $userId = Auth::id();

        $jumlahProperti = Properti::where('user_id', $userId)->count();

        $request->validate([
            'nama_properti' => 'required',
            'fasilitas' => 'required',
            'foto_properti' => 'required|image',
            'lokasi' => 'required',
            'harga' => 'required|numeric',
            'kontak_whatsapp' => 'required',
            'deskripsi' => 'required',
        ]);

        $path = $request->file('foto_properti')
                        ->store('properti', 'public');

        // Upload pertama gratis
        $status = $jumlahProperti >= 1
                    ? 'menunggu_pembayaran'
                    : 'menunggu';

        $properti = Properti::create([
            'user_id' => $userId,
            'nama_properti' => $request->nama_properti,
            'fasilitas' => $request->fasilitas,
            'foto_properti' => $path,
            'lokasi' => $request->lokasi,
            'harga' => $request->harga,
            'kontak_whatsapp' => $request->kontak_whatsapp,
            'deskripsi' => $request->deskripsi,
            'status' => $status,
            'is_unggulan' => 0,
        ]);

        // Kalau harus bayar → ke halaman detail pembayaran
        if ($status == 'menunggu_pembayaran') {
            return redirect()->route('pemilik.detail', $properti->properti_id);
        }

        return redirect()->route('pemilik.beranda')
            ->with('success', 'Properti pertama berhasil diupload secara gratis.');
    }

    // ======================================
    // RIWAYAT
    // ======================================
    public function riwayat()
    {
        $userId = Auth::id();

        $menunggu = Properti::where('user_id', $userId)
                            ->where('status', 'menunggu')
                            ->latest()
                            ->get();

        $ditolak = Properti::where('user_id', $userId)
                            ->where('status', 'ditolak')
                            ->latest()
                            ->get();

        return view('pemilik.riwayat', compact('menunggu', 'ditolak'));
    }

    // ======================================
    // INDEX PEMBAYARAN
    // ======================================
    public function pembayaran()
    {
        $properti = Properti::where('user_id', auth()->id())
                            ->where('status', 'menunggu_pembayaran')
                            ->latest()
                            ->get();

        return view('pemilik.pembayaran', compact('properti'));
    }

    // ======================================
    // DETAIL PEMBAYARAN
    // ======================================
    public function pembayaranDetail($id)
    {
        $properti = Properti::where('properti_id', $id)
                            ->where('user_id', auth()->id())
                            ->firstOrFail();

        return view('pemilik.detail', compact('properti'));
    }

    // ======================================
    // UPLOAD BUKTI
    // ======================================
    public function uploadBukti(Request $request, $id)
    {
        $properti = Properti::where('properti_id', $id)
                            ->where('user_id', Auth::id())
                            ->firstOrFail();

        $request->validate([
            'bukti_pembayaran' => 'required|image'
        ]);

        $path = $request->file('bukti_pembayaran')
                        ->store('bukti', 'public');

        $properti->update([
            'bukti_pembayaran' => $path
        ]);

        return redirect()->route('pemilik.beranda')
            ->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu validasi admin.');
    }
}
