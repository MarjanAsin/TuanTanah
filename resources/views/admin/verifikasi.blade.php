@extends('layouts.admin')

@section('title', 'Verifikasi Properti')

@section('content')

<h2 class="text-lg font-semibold mb-8">
    Daftar Properti yang belum Diverifikasi
</h2>

<div class="grid grid-cols-3 gap-10">

    {{-- CARD 1 --}}
    <div class="bg-white p-4">
        <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be"
             class="w-full h-48 object-cover mb-3">

        <div class="text-xs">
            <h3 class="font-semibold">Rumah 1</h3>
            <p>Lokasi</p>
            <p>3 Kamar Tidur | 2 Kamar Mandi | Luas Rumah 300m²</p>
            <p class="font-semibold mt-1">Rp 1.000.000.000</p>

            <div class="text-right mt-2">
                <a href="#" class="text-gray-600 hover:text-black">
                    Lihat Detail →
                </a>
            </div>
        </div>
    </div>


    {{-- CARD 2 --}}
    <div class="bg-white p-4">
        <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994"
             class="w-full h-48 object-cover mb-3">

        <div class="text-xs">
            <h3 class="font-semibold">Rumah 2</h3>
            <p>Lokasi</p>
            <p>6 Kamar Tidur | 3 Kamar Mandi | Luas Rumah 1000m²</p>
            <p class="font-semibold mt-1">Rp 2.000.000.000</p>

            <div class="text-right mt-2">
                <a href="#" class="text-gray-600 hover:text-black">
                    Lihat Detail →
                </a>
            </div>
        </div>
    </div>


    {{-- CARD 3 --}}
    <div class="bg-white p-4">
        <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d"
             class="w-full h-48 object-cover mb-3">

        <div class="text-xs">
            <h3 class="font-semibold">Rumah 3</h3>
            <p>Lokasi</p>
            <p>3 Kamar Tidur | 2 Kamar Mandi | Luas Rumah 250m²</p>
            <p class="font-semibold mt-1">Rp 800.000.000</p>

            <div class="text-right mt-2">
                <a href="#" class="text-gray-600 hover:text-black">
                    Lihat Detail →
                </a>
            </div>
        </div>
    </div>


    {{-- Tambah baris kedua jika perlu --}}
    {{-- Copy card di atas jika ingin 6 seperti screenshot --}}

</div>

@endsection
