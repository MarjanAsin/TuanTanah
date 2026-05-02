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

        // Belum upload bukti
        $menungguPembayaran = Properti::where('user_id', $userId)
            ->where('status_pembayaran', 'pending')
            ->whereNull('bukti_pembayaran')
            ->count();

        // Sudah upload bukti (menunggu validasi admin)
        $sudahBayar = Properti::where('user_id', $userId)
            ->where('status_pembayaran', 'pending')
            ->whereNotNull('bukti_pembayaran')
            ->count();

        $menunggu = Properti::where('user_id', $userId)
            ->where('status', 'menunggu')
            ->count();

        $disetujui = Properti::where('user_id', $userId)
            ->where('status', 'disetujui')
            ->count();

        $ditolak = Properti::where('user_id', $userId)
            ->where(function($q){
                $q->where('status', 'ditolak')
                  ->orWhere('status_pembayaran', 'ditolak');
            })
            ->count();

        $properti = Properti::where('user_id', $userId)
            ->where('status', 'disetujui')
            ->latest()
            ->get();

        return view('pemilik.beranda', compact(
            'total',
            'sudahBayar',
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
            'nama_properti' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'fasilitas' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'kontak_whatsapp' => 'required|digits_between:10,15',
            'foto_properti' => 'nullable|image|mimes:jpg,jpeg,png|max:5120'
        ], [
            'nama_properti.required' => 'Nama properti wajib diisi.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'fasilitas.required' => 'Fasilitas wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'kontak_whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'kontak_whatsapp.digits_between' => 'Nomor WhatsApp harus 10–15 digit.',
            'foto_properti.image' => 'File harus berupa gambar.',
            'foto_properti.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'foto_properti.max' => 'Ukuran gambar maksimal 5MB.'
        ]);

        if ($request->hasFile('foto_properti')) {
            if ($properti->foto_properti) {
                Storage::disk('public')->delete($properti->foto_properti);
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


    public function store(Request $request)
    {
        $userId = Auth::id();

        // 🔥 FIX: hanya hitung properti yang sudah valid (sudah bayar / gratis berhasil)
        $jumlahProperti = Properti::where('user_id', $userId)
            ->where('status_pembayaran', 'valid')
            ->count();

        $request->validate([
            'nama_properti' => 'required|string|max:255',
            'fasilitas' => 'required|string|max:255',
            'foto_properti' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'lokasi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'kontak_whatsapp' => 'required|digits_between:10,15',
            'deskripsi' => 'required|string',
        ], [
            'nama_properti.required' => 'Nama properti wajib diisi.',
            'fasilitas.required' => 'Fasilitas wajib diisi.',
            'foto_properti.required' => 'Foto properti wajib diupload.',
            'foto_properti.image' => 'File harus berupa gambar.',
            'foto_properti.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'foto_properti.max' => 'Ukuran gambar maksimal 5MB.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'kontak_whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'kontak_whatsapp.digits_between' => 'Nomor WhatsApp harus 10–15 digit.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
        ]);

        $path = $request->file('foto_properti')
            ->store('properti', 'public');

        // 🔥 FREEMIUM LOGIC
        $statusPembayaran = $jumlahProperti >= 1 ? 'pending' : 'valid';

        $properti = Properti::create([
            'user_id' => $userId,
            'nama_properti' => $request->nama_properti,
            'fasilitas' => $request->fasilitas,
            'foto_properti' => $path,
            'lokasi' => $request->lokasi,
            'harga' => $request->harga,
            'kontak_whatsapp' => $request->kontak_whatsapp,
            'deskripsi' => $request->deskripsi,
            'status' => 'menunggu',
            'status_pembayaran' => $statusPembayaran,
            'is_unggulan' => 0,
        ]);

        // 🔥 Kalau perlu bayar
        if ($statusPembayaran === 'pending') {
            return redirect()->route('pemilik.detail', $properti->properti_id)
                ->with('info', 'Silakan lakukan pembayaran untuk melanjutkan.');
        }

        // 🔥 Kalau gratis
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
            ->where(function($q){
                $q->where('status', 'ditolak')
                  ->orWhere('status_pembayaran', 'ditolak');
            })
            ->latest()
            ->get();

        return view('pemilik.riwayat', compact('menunggu', 'ditolak'));
    }


    // ======================================
    // INDEX PEMBAYARAN
    // ======================================
    public function pembayaran()
    {
        $properti = Properti::where('user_id', Auth::id())
            ->where(function ($query) {

                // BELUM BAYAR
                $query->where(function ($q) {
                    $q->where('status_pembayaran', 'pending')
                    ->whereNull('bukti_pembayaran');
                })

                // 🔥 DITOLAK (BIAR BISA UPLOAD ULANG)
                ->orWhere('status_pembayaran', 'ditolak');

            })
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
            ->where('user_id', Auth::id())
            ->whereIn('status_pembayaran', ['pending', 'ditolak']) // 🔥 FIX
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
            ->whereIn('status_pembayaran', ['pending','ditolak'])
            ->firstOrFail();

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'bukti_pembayaran.required' => 'Bukti pembayaran wajib diupload.',
            'bukti_pembayaran.image' => 'File harus berupa gambar.',
            'bukti_pembayaran.mimes' => 'Format harus JPG, JPEG, atau PNG.',
            'bukti_pembayaran.max' => 'Ukuran maksimal 2MB.'
        ]);

        if ($properti->bukti_pembayaran) {
            Storage::disk('public')->delete($properti->bukti_pembayaran);
        }

        $path = $request->file('bukti_pembayaran')
            ->store('bukti', 'public');

        $properti->update([
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'pending'
        ]);

        return redirect()->route('pemilik.beranda')
            ->with('success', 'Bukti pembayaran berhasil dikirim.');
    }
}
