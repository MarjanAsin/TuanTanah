<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Properti;

class PemilikController extends Controller
{
    public function beranda()
    {
        $userId = Auth::id();

        // Total properti
        $total = Properti::where('user_id', $userId)->count();

        // Status
        $menunggu = Properti::where('user_id', $userId)
                            ->where('status', 'menunggu')
                            ->count();

        $disetujui = Properti::where('user_id', $userId)
                            ->where('status', 'disetujui')
                            ->count();

        $ditolak = Properti::where('user_id', $userId)
                            ->where('status', 'ditolak')
                            ->count();

        // Properti disetujui
        $properti = Properti::where('user_id', $userId)
                            ->where('status', 'disetujui')
                            ->latest()
                            ->get();

        return view('pemilik.beranda', compact(
            'total',
            'menunggu',
            'disetujui',
            'ditolak',
            'properti'
        ));
    }
    public function edit($id)
    {
        $properti = Properti::where('properti_id', $id)
                            ->where('user_id', Auth::id())
                            ->firstOrFail();

        return view('pemilik.ubahdata', compact('properti'));
    }

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

    public function upload()
    {
        return view('pemilik.upload');
    }

    public function store(Request $request)
    {
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

        \App\Models\Properti::create([
            'user_id' => Auth::id(),
            'nama_properti' => $request->nama_properti,
            'fasilitas' => $request->fasilitas,
            'foto_properti' => $path,
            'lokasi' => $request->lokasi,
            'harga' => $request->harga,
            'kontak_whatsapp' => $request->kontak_whatsapp,
            'deskripsi' => $request->deskripsi,
            'status' => 'menunggu',
            'is_unggulan' => 0,
        ]);

        return redirect()->route('pemilik.beranda')
            ->with('success', 'Properti berhasil diupload dan menunggu verifikasi admin.');
    }

    public function riwayat()
    {
        $userId = Auth::id();

        $menunggu = \App\Models\Properti::where('user_id', $userId)
                        ->where('status', 'menunggu')
                        ->latest()
                        ->get();

        $ditolak = \App\Models\Properti::where('user_id', $userId)
                        ->where('status', 'ditolak')
                        ->latest()
                        ->get();

        return view('pemilik.riwayat', compact('menunggu', 'ditolak'));
    }




}
