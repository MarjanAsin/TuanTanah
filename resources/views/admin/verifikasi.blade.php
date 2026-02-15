@extends('layouts.admin')

@section('title', 'Verifikasi Properti')

@section('content')

<h2 class="text-xl font-semibold text-gray-800 mb-8">
    Daftar Properti yang Belum Diverifikasi
</h2>

<div class="grid grid-cols-3 gap-10">

    @forelse($properti as $item)

    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition duration-300 border border-gray-100">

        <div class="overflow-hidden">
            <img src="{{ asset('storage/' . $item->foto_properti) }}"
                 class="w-full h-48 object-cover hover:scale-105 transition duration-300">
        </div>

        <div class="p-5 text-sm">

            <h3 class="font-semibold text-gray-800 mb-1">
                {{ $item->nama_properti }}
            </h3>

            <p class="text-gray-500 text-xs mb-1">
                {{ $item->lokasi }}
            </p>

            <p class="text-gray-500 text-xs mb-2 truncate">
                {{ $item->fasilitas }}
            </p>

            <p class="font-bold text-indigo-600 mb-4">
                Rp {{ number_format($item->harga, 0, ',', '.') }}
            </p>

            <div class="flex justify-end">
                <a href="{{ route('admin.detail', $item->properti_id) }}"
                   class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">
                    Lihat Detail →
                </a>
            </div>

        </div>

    </div>

    @empty
        <p class="text-sm text-gray-500 col-span-3 text-center">
            Tidak ada properti yang perlu diverifikasi.
        </p>
    @endforelse

</div>

@endsection
