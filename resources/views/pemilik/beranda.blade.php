@extends('layouts.pemilik')

@section('title', 'Beranda')

@section('content')

{{-- =========================
    STATISTIK
========================= --}}
<div class="flex gap-8 mb-12">

    {{-- Jumlah Properti --}}
    <div class="bg-gradient-to-br from-[#151541] to-indigo-800
                text-white p-6 rounded-2xl w-48 text-center
                shadow-md hover:shadow-xl transition duration-300">
        <h3 class="text-sm uppercase tracking-wide text-gray-200 mb-2">
            Jumlah Properti
        </h3>
        <p class="text-3xl font-bold">{{ $total }}</p>
    </div>

    {{-- Menunggu Pembayaran --}}
    <div class="bg-gradient-to-br from-[#151541] to-indigo-800
                text-white p-6 rounded-2xl w-48 text-center
                shadow-md hover:shadow-xl transition duration-300">
        <h3 class="text-sm uppercase tracking-wide text-gray-200 mb-2">
            Menunggu Pembayaran
        </h3>
        <p class="text-3xl font-bold">{{ $menungguPembayaran }}</p>
    </div>

    {{-- Status Properti --}}
    <div class="flex-1">

        <div class="bg-gradient-to-r from-[#151541] to-indigo-800
                    text-white p-4 rounded-t-2xl">
            <h3 class="text-base font-semibold">Status Properti</h3>
        </div>

        <div class="flex gap-6 bg-white p-6 rounded-b-2xl shadow-sm">

            <div class="flex-1 bg-indigo-50 text-indigo-700 px-6 py-5 rounded-xl text-center">
                <p class="text-xs uppercase tracking-wide font-bold">Menunggu</p>
                <p class="text-2xl font-bold mt-1">{{ $menunggu }}</p>
            </div>

            <div class="flex-1 bg-green-50 text-green-700 px-6 py-5 rounded-xl text-center">
                <p class="text-xs uppercase tracking-wide font-bold">Disetujui</p>
                <p class="text-2xl font-bold mt-1">{{ $disetujui }}</p>
            </div>

            <div class="flex-1 bg-red-50 text-red-600 px-6 py-5 rounded-xl text-center">
                <p class="text-xs uppercase tracking-wide font-bold">Ditolak</p>
                <p class="text-2xl font-bold mt-1">{{ $ditolak }}</p>
            </div>

        </div>
    </div>

</div>



{{-- =========================
    PROPERTI DISETUJUI
========================= --}}
<h2 class="text-xl font-semibold text-gray-800 mb-8">
    Properti yang sudah disetujui
</h2>

<div class="grid md:grid-cols-2 gap-10">

    @forelse($properti as $item)

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden relative
                hover:shadow-xl hover:-translate-y-1
                transition duration-300">

        {{-- Badge Properti Unggulan --}}
        @if($item->is_unggulan)
            <div class="absolute top-4 left-4
                        bg-gradient-to-r from-yellow-400 to-orange-500
                        text-white px-3 py-1 text-xs font-semibold
                        rounded-full shadow-md">
                ⭐ Properti Unggulan
            </div>
        @endif

        <div class="overflow-hidden">
            <img src="{{ asset('storage/' . $item->foto_properti) }}"
                 class="w-full h-52 object-cover hover:scale-105 transition duration-500">
        </div>

        <div class="p-5 text-sm">

            <h3 class="font-semibold text-gray-800 mb-1">
                {{ $item->nama_properti }}
            </h3>

            <p class="text-gray-500 text-xs mb-1">
                {{ $item->lokasi }}
            </p>

            <p class="text-gray-500 text-xs truncate">
                {{ $item->fasilitas }}
            </p>

            <p class="font-bold text-indigo-600 mt-3">
                Rp {{ number_format($item->harga, 0, ',', '.') }}
            </p>

            <div class="flex justify-end mt-4">
                <a href="{{ route('pemilik.edit', $item->properti_id) }}"
                   class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">
                    Ubah data →
                </a>
            </div>

        </div>
    </div>

    @empty
        <p class="text-gray-500 text-sm col-span-2 text-center">
            Belum ada properti yang disetujui.
        </p>
    @endforelse

</div>

@endsection
