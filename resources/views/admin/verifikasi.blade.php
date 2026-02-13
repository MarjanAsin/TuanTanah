@extends('layouts.admin')

@section('title', 'Verifikasi Properti')

@section('content')

<h2 class="text-lg font-semibold mb-8">
    Daftar Properti yang belum Diverifikasi
</h2>

<div class="grid grid-cols-3 gap-10">

    @forelse($properti as $item)

    <div class="bg-white p-4 shadow-sm">

        <img src="{{ asset('storage/' . $item->foto_properti) }}"
             class="w-full h-48 object-cover mb-3">

        <div class="text-xs">
            <h3 class="font-semibold">
                {{ $item->nama_properti }}
            </h3>

            <p>{{ $item->lokasi }}</p>
            <p>{{ $item->fasilitas }}</p>

            <p class="font-semibold mt-1">
                Rp {{ number_format($item->harga, 0, ',', '.') }}
            </p>

            <div class="text-right mt-2">
                <a href="{{ route('admin.detail', $item->properti_id) }}"
                   class="text-gray-600 hover:text-black">
                    Lihat Detail →
                </a>
            </div>
        </div>

    </div>

    @empty
        <p class="text-sm text-gray-500">
            Tidak ada properti yang perlu diverifikasi.
        </p>
    @endforelse

</div>


@endsection
