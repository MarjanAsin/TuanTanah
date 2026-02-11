@extends('layouts.pemilik')

@section('title', 'Beranda')

@section('content')

{{-- STATISTIK --}}
<div class="flex gap-8 mb-10">

    {{-- Jumlah Properti --}}
    <div class="bg-[#151541] text-white p-6 rounded-md w-48 text-center">
        <h3 class="text-lg mb-2">Jumlah Properti</h3>
        <p class="text-2xl font-semibold">3</p>
    </div>

    {{-- Status Properti --}}
    <div class="flex-1">
        <div class="bg-[#151541] text-white p-3 rounded-t-md">
            <h3 class="text-lg">Status Properti</h3>
        </div>

        <div class="flex gap-6 bg-white p-6 rounded-b-md shadow-sm">

            <div class="bg-[#151541] text-white px-8 py-4 rounded-md text-center">
                <p>Menunggu</p>
                <p class="text-xl font-semibold">1</p>
            </div>

            <div class="bg-[#151541] text-white px-8 py-4 rounded-md text-center">
                <p>Disetujui</p>
                <p class="text-xl font-semibold">2</p>
            </div>

            <div class="bg-[#151541] text-white px-8 py-4 rounded-md text-center">
                <p>Ditolak</p>
                <p class="text-xl font-semibold">0</p>
            </div>

        </div>
    </div>

</div>



{{-- PROPERTI DISETUJUI --}}
<h2 class="text-lg font-semibold mb-6">
    Properti yang sudah disetujui
</h2>

<div class="grid md:grid-cols-2 gap-10">

    {{-- CARD 1 --}}
    <div class="bg-white rounded-md shadow-sm overflow-hidden">
        <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be"
             class="w-full h-48 object-cover">

        <div class="p-4 text-sm">
            <h3 class="font-semibold mb-1">Rumah 1</h3>
            <p class="text-gray-500">Lokasi</p>
            <p class="text-gray-500">
                3 Kamar Tidur | 2 Kamar Mandi | Luas Rumah 300m²
            </p>
            <p class="font-semibold mt-2">
                Rp 1.000.000.000
            </p>

            <div class="text-right mt-2">
                <a href="#" class="text-sm text-gray-600 hover:text-black">
                    Ubah data →
                </a>
            </div>
        </div>
    </div>


    {{-- CARD 2 --}}
    <div class="bg-white rounded-md shadow-sm overflow-hidden">
        <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994"
             class="w-full h-48 object-cover">

        <div class="p-4 text-sm">
            <h3 class="font-semibold mb-1">Rumah 2</h3>
            <p class="text-gray-500">Lokasi</p>
            <p class="text-gray-500">
                3 Kamar Tidur | 2 Kamar Mandi | Luas Rumah 300m²
            </p>
            <p class="font-semibold mt-2">
                Rp 2.000.000.000
            </p>

            <div class="text-right mt-2">
                <a href="#" class="text-sm text-gray-600 hover:text-black">
                    Ubah data →
                </a>
            </div>
        </div>
    </div>

</div>

@endsection
