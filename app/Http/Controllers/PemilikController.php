<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Properti;
use App\Models\PropertiFoto;

class PemilikController extends Controller
{
    // ======================================
    // BERANDA
    // ======================================
    public function beranda()
    {
        $userId = Auth::id();

        // 🔥 TOTAL (hanya yang sudah valid pembayaran)
        $total = Properti::where('user_id', $userId)
            ->where('status_pembayaran', 'valid')
            ->count();

        // 🔥 BELUM BAYAR + DITOLAK PEMBAYARAN
        $menungguPembayaran = Properti::where('user_id', $userId)
            ->where(function($q){
                $q->where(function ($sub) {
                    $sub->where('status_pembayaran', 'pending')
                        ->whereNull('bukti_pembayaran');
                })
                ->orWhere('status_pembayaran', 'ditolak'); // 🔥 MASUK SINI
            })
            ->count();

        // 🔥 SUDAH BAYAR (MENUNGGU VALIDASI)
        $sudahBayar = Properti::where('user_id', $userId)
            ->where('status_pembayaran', 'pending')
            ->whereNotNull('bukti_pembayaran')
            ->count();

        // 🔥 MENUNGGU VERIFIKASI ADMIN (SETELAH VALID)
        $menunggu = Properti::where('user_id', $userId)
            ->where('status_pembayaran', 'valid')
            ->where('status', 'menunggu')
            ->count();

        // 🔥 DISETUJUI
        $disetujui = Properti::where('user_id', $userId)
            ->where('status_pembayaran', 'valid')
            ->where('status', 'disetujui')
            ->count();

        // 🔥 DITOLAK (HANYA VERIFIKASI PROPERTI)
        $ditolak = Properti::where('user_id', $userId)
            ->where('status_pembayaran', 'valid') // 🔥 WAJIB
            ->where('status', 'ditolak')
            ->count();

        // 🔥 LIST PROPERTI (YANG SUDAH SIAP TAMPIL)
        $properti = Properti::with('fotos')
            ->where('user_id', $userId)
            ->where('status_pembayaran', 'valid')
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
        $properti = Properti::with('fotos')
            ->where('properti_id', $id)
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
            'tipe_properti' => 'required|in:rumah,tanah,ruko,apartemen',
            'luas_tanah' => 'nullable|numeric|min:0',
            'jumlah_kamar' => 'nullable|integer|min:0',

            // 🔥 MULTI FOTO
            'foto_properti' => 'nullable|array|max:5',
            'foto_properti.*' => 'image|mimes:jpg,jpeg,png|max:5120'
        ], [
            'nama_properti.required' => 'Nama properti wajib diisi.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'fasilitas.required' => 'Fasilitas wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'kontak_whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'kontak_whatsapp.digits_between' => 'Nomor WhatsApp harus 10–15 digit.',

            'tipe_properti.required' => 'Tipe wajib diisi.',

            'foto_properti.*.image' => 'File harus berupa gambar.',
            'foto_properti.*.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'foto_properti.*.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        // 🔥 UPDATE DATA
        $properti->update([
            'nama_properti' => $request->nama_properti,
            'lokasi' => $request->lokasi,
            'fasilitas' => $request->fasilitas,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'kontak_whatsapp' => $request->kontak_whatsapp,
            'tipe_properti' => $request->tipe_properti,
            'luas_tanah' => $request->luas_tanah,
            'jumlah_kamar' => $request->jumlah_kamar,
            'status' => 'menunggu',
        ]);

        // 🔥 UPDATE FOTO (kalau ada upload baru)
        if ($request->hasFile('foto_properti')) {

            // hapus semua foto lama
            foreach ($properti->fotos as $foto) {
                Storage::disk('public')->delete($foto->path);
                $foto->delete();
            }

            // simpan foto baru
            foreach ($request->file('foto_properti') as $file) {

                $path = $file->store('properti', 'public');

                PropertiFoto::create([
                    'properti_id' => $properti->properti_id,
                    'path' => $path
                ]);
            }
        }

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

        $jumlahProperti = Properti::where('user_id', $userId)
            ->where('status_pembayaran', 'valid')
            ->count();

        $request->validate([
            'nama_properti' => 'required|string|max:255',
            'fasilitas' => 'required|string|max:255',
            'foto_properti' => 'required|array|max:5',
            'foto_properti.*' => 'image|mimes:jpg,jpeg,png|max:5120',
            'lokasi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'kontak_whatsapp' => 'required|digits_between:10,15',
            'tipe_properti' => 'required|in:rumah,tanah,ruko,apartemen',
            'luas_tanah' => 'nullable|numeric|min:0',
            'jumlah_kamar' => 'nullable|integer|min:0',
            'deskripsi' => 'required|string',
        ], [
            'nama_properti.required' => 'Nama properti wajib diisi.',
            'fasilitas.required' => 'Fasilitas wajib diisi.',

            'foto_properti.required' => 'Minimal satu foto properti harus diupload.',
            'foto_properti.*.image' => 'File harus berupa gambar.',
            'foto_properti.*.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'foto_properti.*.max' => 'Ukuran gambar maksimal 5MB.',

            'lokasi.required' => 'Lokasi wajib diisi.',

            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',

            'tipe_properti.required' => 'Tipe wajib diisi.',

            'kontak_whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'kontak_whatsapp.digits_between' => 'Nomor WhatsApp harus 10–15 digit.',

            'deskripsi.required' => 'Deskripsi wajib diisi.',
        ]);

        // 🔥 FREEMIUM LOGIC
        $statusPembayaran = $jumlahProperti >= 1 ? 'pending' : 'valid';

        // 🔥 BUAT PROPERTI
        $properti = Properti::create([
            'user_id' => $userId,
            'nama_properti' => $request->nama_properti,
            'fasilitas' => $request->fasilitas,
            'lokasi' => $request->lokasi,
            'harga' => $request->harga,
            'kontak_whatsapp' => $request->kontak_whatsapp,
            'deskripsi' => $request->deskripsi,
            'status' => 'menunggu',
            'status_pembayaran' => $statusPembayaran,
            'is_unggulan' => 0,
            'tipe_properti' => $request->tipe_properti,
            'luas_tanah' => $request->luas_tanah,
            'jumlah_kamar' => $request->jumlah_kamar,
        ]);

        // 🔥 SIMPAN FOTO
        if ($request->hasFile('foto_properti')) {
            foreach ($request->file('foto_properti') as $file) {

                $path = $file->store('properti', 'public');

                \App\Models\PropertiFoto::create([
                    'properti_id' => $properti->properti_id,
                    'path' => $path
                ]);
            }
        }

        // 🔥 REDIRECT
        if ($statusPembayaran === 'pending') {
            return redirect()->route('pemilik.detail', $properti->properti_id)
                ->with('info', 'Silakan lakukan pembayaran untuk melanjutkan.');
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

        // 🔥 MENUNGGU VERIFIKASI (SUDAH VALID PEMBAYARAN)
        $menunggu = Properti::with('fotos')
            ->where('user_id', $userId)
            ->where('status_pembayaran', 'valid')
            ->where('status', 'menunggu')
            ->latest()
            ->get();

        // 🔥 DITOLAK OLEH ADMIN (BUKAN PEMBAYARAN)
        $ditolak = Properti::with('fotos')
            ->where('user_id', $userId)
            ->where('status_pembayaran', 'valid') // 🔥 penting
            ->where('status', 'ditolak') // 🔥 hanya ditolak properti
            ->latest()
            ->get();

        return view('pemilik.riwayat', compact('menunggu', 'ditolak'));
    }


    // ======================================
    // INDEX PEMBAYARAN
    // ======================================
    public function pembayaran()
    {
        $properti = Properti::with('fotos')
            ->where('user_id', Auth::id())
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
        $properti = Properti::with('fotos') // 🔥 INI WAJIB
            ->where('properti_id', $id)
            ->where('user_id', Auth::id())
            ->whereIn('status_pembayaran', ['pending', 'ditolak'])
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
