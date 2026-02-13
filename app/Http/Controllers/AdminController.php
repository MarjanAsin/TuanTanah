<?php

namespace App\Http\Controllers;

use App\Models\Properti;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Banner;

class AdminController extends Controller
{
    public function beranda()
    {
        $totalProperti = Properti::count();

        $totalPemilik = User::where('role', 'pemilik')->count();

        $menunggu = Properti::where('status', 'menunggu')->count();

        $properti = Properti::where('status', 'disetujui')
                            ->latest()
                            ->get();

        return view('admin.beranda', compact(
            'totalProperti',
            'totalPemilik',
            'menunggu',
            'properti'
        ));
    }

    public function unggulan(Request $request)
    {
        Properti::query()->update(['is_unggulan' => 0]);

        if ($request->properti) {
            Properti::whereIn('properti_id', $request->properti)
                    ->update(['is_unggulan' => 1]);
        }

        return back()->with('success', 'Properti unggulan berhasil diperbarui.');
    }

    public function verifikasi()
    {
        $properti = \App\Models\Properti::where('status', 'menunggu')
                        ->latest()
                        ->get();

        return view('admin.verifikasi', compact('properti'));
    }

    public function detail($id)
    {
        $properti = \App\Models\Properti::where('properti_id', $id)
                        ->firstOrFail();

        return view('admin.detail', compact('properti'));
    }


    public function verifikasiProses($id, $aksi)
    {
        $properti = \App\Models\Properti::findOrFail($id);

        if ($aksi === 'setujui') {
            $properti->status = 'disetujui';
        }

        if ($aksi === 'tolak') {
            $properti->status = 'ditolak';
            $properti->is_unggulan = 0;
        }

        $properti->save();

        return redirect()->route('admin.verifikasi')
                        ->with('success', 'Status properti berhasil diperbarui.');
    }


    public function uploadBannerForm()
    {
        return view('admin.upload');
    }

    public function uploadBanner(Request $request)
    {
        $request->validate([
            'gambar_banner' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
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
