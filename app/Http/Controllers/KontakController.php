<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class KontakController extends Controller
{
    public function kirim(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        Mail::raw(
            "Nama: {$data['nama']}\n" .
            "Email: {$data['email']}\n" .
            "Telepon: {$data['telepon']}\n\n" .
            "Pesan:\n{$data['pesan']}",
            function ($message) use ($data) {
                $message->to('info@tuantanah.com') // ganti dengan email tujuan
                        ->subject($data['subjek']);
            }
        );

        return back()->with('success', 'Pesan berhasil dikirim.');
    }
}
