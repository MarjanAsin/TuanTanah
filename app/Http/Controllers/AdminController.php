<?php

namespace App\Http\Controllers;

use App\Models\Properti;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Banner;

class AdminController extends Controller
{
    public function beranda()
    {
        $totalPemilik = User::where('role', 'pemilik')->count();

        $menunggu = Properti::where('status', 'menunggu')
            ->where(function ($query) {

                $query->where('status_pembayaran', 'valid')

                    ->orWhere(function ($q) {

                        $q->where('status_pembayaran', 'pending')
                            ->whereNotNull('bukti_pembayaran');

                    });

            })
            ->count();

        $totalAktif = Properti::where('status_pembayaran', 'valid')
            ->where('status', 'disetujui')
            ->count();

        //  LIST PROPERTI (YANG SUDAH SIAP TAMPIL)
        $properti = Properti::with('fotos')
            ->where('status_pembayaran', 'valid')
            ->where('status', 'disetujui')
            ->latest()
            ->get();

        return view('admin.beranda', compact(
            'totalPemilik',
            'totalAktif',
            'menunggu',
            'properti'
        ));
    }

    public function unggulan(Request $request)
    {
        Properti::where('status', 'disetujui')
            ->where('status_pembayaran', 'valid')
            ->update(['is_unggulan' => 0]);

        if ($request->properti) {
            Properti::whereIn('properti_id', $request->properti)
                ->where('status', 'disetujui')
                ->where('status_pembayaran', 'valid')
                ->update(['is_unggulan' => 1]);
        }

        return back()->with('success', 'Properti unggulan berhasil diperbarui.');
    }

    // LIST VERIFIKASI PROPERTI
    public function verifikasi()
    {
        $properti = Properti::with('fotos')
            ->where('status', 'menunggu')
            ->where(function ($query) {

                $query->where('status_pembayaran', 'valid')

                    ->orWhere(function ($q) {

                        $q->where('status_pembayaran', 'pending')
                            ->whereNotNull('bukti_pembayaran');

                    });

            })
            ->latest()
            ->get();

        return view('admin.verifikasi', compact('properti'));
    }

    // DETAIL PROPERTI
    public function detail($id)
    {
        $properti = Properti::with(['fotos', 'user'])
            ->where('properti_id', $id)
            ->where('status', 'menunggu')
            ->where(function ($query) {

                $query->where('status_pembayaran', 'valid')

                    ->orWhere(function ($q) {

                        $q->where('status_pembayaran', 'pending')
                            ->whereNotNull('bukti_pembayaran');

                    });

            })
            ->firstOrFail();

        return view('admin.detail', compact('properti'));
    }

    public function verifikasiProses(Request $request, $id, $aksi)
    {
        $properti = Properti::where('properti_id', $id)
            ->where('status', 'menunggu')
            ->firstOrFail();

        if ($aksi === 'setujui') {

            $properti->update([
                'status' => 'disetujui',
                'status_pembayaran' => 'valid',
                'alasan_penolakan' => null
            ]);
        }

        if ($aksi === 'tolak-pembayaran') {

            if ($properti->status_pembayaran === 'valid') {

                return back()->with(
                    'error',
                    'Pembayaran yang sudah valid tidak dapat ditolak kembali.'
                );
            }

            $request->validate([
                'alasan_penolakan' => 'required|string'
            ], [
                'alasan_penolakan.required' => 'Alasan penolakan pembayaran wajib diisi.',
                'alasan_penolakan.string' => 'Alasan penolakan harus berupa teks.'
            ]);

            $properti->update([
                'status' => 'menunggu',
                'status_pembayaran' => 'ditolak',
                'alasan_penolakan' => $request->alasan_penolakan
            ]);
        }

        if ($aksi === 'tolak') {

            $request->validate([
                'alasan_penolakan' => 'required|string'
            ], [
                'alasan_penolakan.required' => 'Alasan penolakan properti wajib diisi.',
                'alasan_penolakan.string' => 'Alasan penolakan harus berupa teks.'
            ]);

            $properti->update([
                'status' => 'ditolak',
                'alasan_penolakan' => $request->alasan_penolakan
            ]);
        }

        return redirect()->route('admin.verifikasi')
            ->with('success', 'Status properti berhasil diperbarui.');
    }

    public function uploadBannerForm()
    {
        return view('admin.upload');
    }

    // STORE BANNER
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

}
