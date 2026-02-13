@extends('layouts.pemilik')

@section('title', 'Detail Pembayaran')

@section('content')

<div class="max-w-xl mx-auto mt-16">

    <h2 class="text-xl font-semibold mb-6 text-center">
        Detail Pembayaran
    </h2>

    <div class="bg-white p-6 shadow">

        <p class="mb-4">
            Properti:
            <strong>{{ $properti->nama_properti }}</strong>
        </p>

        <p class="mb-4">
            Biaya Upload:
            <strong>Rp 50.000</strong>
        </p>

        <p class="mb-4">
            Transfer ke:
            <br>
            BCA 123456789
            <br>
            a.n TuanTanah
        </p>

        <form method="POST"
              action="{{ route('pemilik.upload.bukti', $properti->properti_id) }}"
              enctype="multipart/form-data">
            @csrf

            <label class="block mb-2 text-sm">Upload Bukti Transfer</label>
            <input type="file" name="bukti_pembayaran"
                   class="w-full border p-2 mb-4">

            <button class="w-full bg-indigo-600 text-white py-2">
                Kirim Bukti & Kembali ke Dashboard
            </button>

        </form>

    </div>

</div>

@endsection
