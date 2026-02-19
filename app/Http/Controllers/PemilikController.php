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

        $sudahBayar = Properti::where('user_id', $userId)
            ->where('status', 'menunggu_verifikasi_pembayaran')
            ->count();


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

            // Nama Properti
            'nama_properti.required' => 'Nama properti wajib diisi.',
            'nama_properti.max' => 'Nama properti maksimal 255 karakter.',

            // Lokasi
            'lokasi.required' => 'Lokasi wajib diisi.',
            'lokasi.max' => 'Lokasi maksimal 255 karakter.',

            // Fasilitas
            'fasilitas.required' => 'Fasilitas wajib diisi.',
            'fasilitas.max' => 'Fasilitas maksimal 255 karakter.',

            // Harga
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',

            // Deskripsi
            'deskripsi.required' => 'Deskripsi wajib diisi.',

            // WhatsApp
            'kontak_whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'kontak_whatsapp.digits_between' => 'Nomor WhatsApp harus terdiri dari 10 sampai 15 digit angka.',

            // Foto
            'foto_properti.image' => 'File harus berupa gambar.',
            'foto_properti.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'foto_properti.max' => 'Ukuran gambar maksimal 5MB.',
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

    // ======================================
    // STORE (Upload Properti)
    // ======================================
    public function store(Request $request)
    {
        $userId = Auth::id();

        $jumlahProperti = Properti::where('user_id', $userId)->count();

        $request->validate([
            'nama_properti' => 'required|string|max:255',
            'fasilitas' => 'required|string|max:255',
            'foto_properti' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'lokasi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'kontak_whatsapp' => [
                                    'required',
                                    'regex:/^[0-9]+$/',
                                    'min:10',
                                    'max:15'
                                ],
            'deskripsi' => 'required|string',
        ], [

            // Nama Properti
            'nama_properti.required' => 'Nama properti wajib diisi.',
            'nama_properti.max' => 'Nama properti maksimal 255 karakter.',

            // Fasilitas
            'fasilitas.required' => 'Fasilitas wajib diisi.',
            'fasilitas.max' => 'Fasilitas maksimal 255 karakter.',

            // Foto
            'foto_properti.required' => 'Foto properti wajib diisi.',
            'foto_properti.image' => 'File harus berupa gambar.',
            'foto_properti.mimes' => 'Format gambar harus JPG, JPEG atau PNG.',
            'foto_properti.max' => 'Ukuran gambar maksimal 5MB.',

            // Lokasi
            'lokasi.required' => 'Lokasi wajib diisi.',
            'lokasi.max' => 'Lokasi maksimal 255 karakter.',

            // Harga
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',

            // WhatsApp
            'kontak_whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'kontak_whatsapp.max' => 'Nomor WhatsApp maksimal 20 digit.',
            'kontak_whatsapp.min' => 'Nomor WhatsApp minimal 11 digit.',

            // Deskripsi
            'deskripsi.required' => 'Deskripsi wajib diisi.',
        ]);


        $path = $request->file('foto_properti')
            ->store('properti', 'public');

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

        if ($status === 'menunggu_pembayaran') {
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
        $properti = Properti::where('user_id', Auth::id())
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
            ->where('user_id', Auth::id())
            ->where('status', 'menunggu_pembayaran')
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
            ->where('status', 'menunggu_pembayaran')
            ->firstOrFail();

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'bukti_pembayaran.required' => 'Bukti pembayaran wajib diisi.',
            'bukti_pembayaran.image'    => 'File harus berupa gambar.',
            'bukti_pembayaran.mimes'    => 'Format file harus JPG, JPEG, atau PNG.',
            'bukti_pembayaran.max'      => 'Ukuran file maksimal 2 MB.',
        ]);


        if ($properti->bukti_pembayaran) {
            Storage::disk('public')->delete($properti->bukti_pembayaran);
        }

        $path = $request->file('bukti_pembayaran')
            ->store('bukti', 'public');

        $properti->update([
            'bukti_pembayaran' => $path,
            'status' => 'menunggu_verifikasi_pembayaran'
        ]);


        return redirect()->route('pemilik.beranda')
            ->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu validasi admin.');
    }
}
