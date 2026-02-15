@extends('layouts.admin')

@section('title', 'Pembayaran')

@section('content')

<h2 class="text-2xl font-semibold text-gray-800 mb-10">
    Daftar Properti Menunggu Validasi Pembayaran
</h2>

<div class="grid md:grid-cols-3 gap-8">

@forelse($properti as $item)

<div class="bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1
            transition duration-300 overflow-hidden border border-gray-100 relative">

    {{-- Badge Status --}}
    <div class="absolute top-4 left-4
                bg-yellow-100 text-yellow-700
                text-xs font-semibold px-3 py-1 rounded-full">
        Menunggu Validasi
    </div>

    <div class="overflow-hidden">
        <img src="{{ asset('storage/' . $item->foto_properti) }}"
             class="w-full h-52 object-cover hover:scale-105 transition duration-500">
    </div>

    <div class="p-6 text-sm">

        <h3 class="font-semibold text-gray-800 mb-1">
            {{ $item->nama_properti }}
        </h3>

        <p class="text-gray-500 text-xs mb-3">
            {{ $item->lokasi }}
        </p>

        <p class="font-bold text-indigo-600 text-base mb-5">
            Rp {{ number_format($item->harga, 0, ',', '.') }}
        </p>

        <div class="flex justify-end border-t border-gray-100">
            <a href="{{ route('admin.detailpembayaran', $item->properti_id) }}"
               class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">
                Lihat Detail →
            </a>
        </div>

    </div>

</div>

@empty
<p class="text-gray-500 col-span-3 text-center">
    Tidak ada pembayaran yang perlu divalidasi.
</p>
@endforelse

</div>

@endsection
