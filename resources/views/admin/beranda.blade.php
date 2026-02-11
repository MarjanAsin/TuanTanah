@extends('layouts.admin')

@section('title', 'Beranda Admin')

@section('content')

{{-- Statistik --}}
<div class="grid grid-cols-3 gap-8 mb-10">

    <div class="bg-[#151541] text-white p-6">
        <h3 class="text-sm mb-2">Jumlah Properti</h3>
        <p class="text-2xl font-semibold">3</p>
    </div>

    <div class="bg-[#151541] text-white p-6">
        <h3 class="text-sm mb-2">Jumlah Pemilik Properti</h3>
        <p class="text-2xl font-semibold">3</p>
    </div>

    <div class="bg-[#151541] text-white p-6">
        <h3 class="text-sm mb-2">Jumlah Properti menunggu verifikasi</h3>
        <p class="text-2xl font-semibold">3</p>
    </div>

</div>



{{-- Tandai Properti Unggulan --}}
<div class="bg-white p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-base font-semibold">Tandai Properti Unggulan</h2>

        <button class="bg-indigo-600 text-white px-6 py-2 text-sm">
            Simpan
        </button>
    </div>

    <div class="grid grid-cols-3 gap-8">

        {{-- CARD 1 --}}
        <div>
            <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be"
                 class="w-full h-44 object-cover mb-3">

            <div class="text-xs">
                <h3 class="font-semibold">Rumah 1</h3>
                <p>Lokasi</p>
                <p>3 Kamar Tidur | 2 Kamar Mandi | Luas Rumah 300m²</p>
                <p class="font-semibold mt-1">Rp 1.000.000.000</p>

                <div class="flex items-center gap-2 mt-2">
                    <label>Tandai</label>
                    <input type="checkbox">
                </div>
            </div>
        </div>

        {{-- CARD 2 --}}
        <div>
            <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994"
                 class="w-full h-44 object-cover mb-3">

            <div class="text-xs">
                <h3 class="font-semibold">Rumah 2</h3>
                <p>Lokasi</p>
                <p>3 Kamar Tidur | 2 Kamar Mandi | Luas Rumah 180m²</p>
                <p class="font-semibold mt-1">Rp 2.000.000.000</p>

                <div class="flex items-center gap-2 mt-2">
                    <label>Tandai</label>
                    <input type="checkbox">
                </div>
            </div>
        </div>

        {{-- CARD 3 --}}
        <div>
            <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d"
                 class="w-full h-44 object-cover mb-3">

            <div class="text-xs">
                <h3 class="font-semibold">Rumah 3</h3>
                <p>Lokasi</p>
                <p>3 Kamar Tidur | 2 Kamar Mandi | Luas Rumah 250m²</p>
                <p class="font-semibold mt-1">Rp 800.000.000</p>

                <div class="flex items-center gap-2 mt-2">
                    <label>Tandai</label>
                    <input type="checkbox">
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
