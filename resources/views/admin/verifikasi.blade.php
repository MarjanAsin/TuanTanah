@extends('layouts.admin')

@section('title', 'Verifikasi Properti')

@section('content')

<h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-6 sm:mb-8 font-inria">
    Daftar Properti yang Belum Diverifikasi
</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">

    @forelse($properti as $item)

    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition duration-300 border border-gray-100">

        <div class="overflow-hidden">
            <img src="{{ asset('storage/' . $item->foto_properti) }}"
                 class="w-full h-44 sm:h-48 object-cover hover:scale-105 transition duration-300">
        </div>

        <div class="p-4 sm:p-5 text-sm">

            <h3 class="font-semibold text-gray-800 mb-1 font-inria">
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
        <p class="text-sm text-gray-500 col-span-full text-center font-inria">
            Tidak ada properti yang perlu diverifikasi.
        </p>
    @endforelse

</div>

@endsection
