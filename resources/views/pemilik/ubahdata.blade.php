@extends('layouts.pemilik')

@section('title', 'Ubah Data')

@section('content')

<div class="mt-10 mb-16">

    {{-- Judul --}}
    <h2 class="text-xl font-semibold text-center mb-10 font-inria">
        Ubah data properti
    </h2>

    <div class="grid grid-cols-2 gap-12">

        {{-- KIRI : GAMBAR --}}
        <div>
            <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994"
                 class="w-full h-64 object-cover mb-6">

            <div class="flex gap-6">
                <button class="bg-red-700 text-white px-6 py-2 text-sm">
                    Hapus Properti
                </button>

                <button class="bg-indigo-600 text-white px-6 py-2 text-sm">
                    Perbarui
                </button>
            </div>
        </div>



        {{-- KANAN : FORM --}}
        <div class="space-y-5 text-sm">

            {{-- Nama Properti --}}
            <div class="grid grid-cols-3 items-center gap-4">
                <label class="col-span-1">Nama Properti</label>
                <input type="text"
                    value="Rumah"
                    class="col-span-2 border border-gray-400 px-3 py-2 bg-white">
            </div>

            {{-- Lokasi --}}
            <div class="grid grid-cols-3 items-center gap-4">
                <label class="col-span-1">Lokasi</label>
                <input type="text"
                    value="Sleman, Yogyakarta"
                    class="col-span-2 border border-gray-400 px-3 py-2 bg-white">
            </div>

            {{-- Fasilitas --}}
            <div class="grid grid-cols-3 items-center gap-4">
                <label class="col-span-1">Fasilitas</label>
                <input type="text"
                    value="6 Kamar Tidur | 3 Kamar Mandi | Luas Rumah 1000m²"
                    class="col-span-2 border border-gray-400 px-3 py-2 bg-white">
            </div>

            {{-- Harga --}}
            <div class="grid grid-cols-3 items-center gap-4">
                <label class="col-span-1">Harga</label>
                <input type="text"
                    value="Rp 2.000.000.000"
                    class="col-span-2 border border-gray-400 px-3 py-2 bg-white">
            </div>

            {{-- Deskripsi --}}
            <div class="grid grid-cols-3 items-start gap-4">
                <label class="col-span-1 pt-2">Deskripsi</label>
                <textarea rows="4"
                    class="col-span-2 border border-gray-400 px-3 py-2 bg-white">
        Rumah ini dibangun dekat dengan universitas dan mall, dengan luas yang cukup besar untuk memiliki lokasi yang strategis, serta bebas dari banjir.
                </textarea>
            </div>

            {{-- Nomor WhatsApp --}}
            <div class="grid grid-cols-3 items-center gap-4">
                <label class="col-span-1">Nomor WhatsApp</label>
                <input type="text"
                    value="081231199444"
                    class="col-span-2 border border-gray-400 px-3 py-2 bg-white">
            </div>

            {{-- Tombol Simpan (sejajar dengan field) --}}
            <div class="grid grid-cols-3 gap-4 pt-3">
                <div></div>
                <button class="col-span-2 bg-indigo-600 text-white py-2 text-sm hover:bg-indigo-700 transition">
                    Simpan Perubahan
                </button>
            </div>

        </div>


    </div>

</div>

@endsection
