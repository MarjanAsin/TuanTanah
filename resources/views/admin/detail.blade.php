@extends('layouts.admin')

@section('title', 'Detail Verifikasi')

@section('content')

<div class="max-w-6xl mx-auto mt-10 mb-16">

    <div class="grid grid-cols-2 gap-12">

        {{-- KIRI --}}
        <div>
            <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994"
                 class="w-full h-72 object-cover mb-3">

            <p class="text-xs text-center text-gray-600 mb-6">
                Diposting pada 12.12.2025
            </p>

            <div class="flex justify-between">
                <button class="bg-red-700 text-white px-6 py-2 text-sm">
                    Tolak Properti
                </button>

                <button class="bg-green-600 text-white px-6 py-2 text-sm">
                    Verifikasi Properti
                </button>
            </div>
        </div>



        {{-- KANAN --}}
        <div class="space-y-4 text-sm">

            <h3 class="text-base font-semibold mb-2">Rumah</h3>

            <div class="bg-gray-100 p-4 border border-gray-300">
                <p class="font-semibold mb-1">Lokasi</p>
                <p>Sleman, Yogyakarta</p>
            </div>

            <div class="bg-gray-100 p-4 border border-gray-300">
                <p class="font-semibold mb-1">Fasilitas</p>
                <p>6 Kamar Tidur &nbsp;&nbsp; 3 Kamar Mandi &nbsp;&nbsp; Ukuran Rumah 1.000m²</p>
            </div>

            <div class="bg-gray-100 p-4 border border-gray-300">
                <p class="font-semibold mb-1">Harga</p>
                <p>Rp 2.000.000.000</p>
            </div>

            <div class="bg-gray-100 p-4 border border-gray-300">
                <p class="font-semibold mb-1">Deskripsi</p>
                <p>
                    Rumah ini dibangun dekat dengan universitas dan dekat dengan kota Yogyakarta, 
                    bangunan ini memiliki lokasi yang strategis, serta bebas dari banjir.
                </p>
            </div>

        </div>

    </div>

</div>

@endsection
