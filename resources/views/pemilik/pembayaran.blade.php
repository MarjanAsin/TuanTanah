@extends('layouts.pemilik')

@section('title', 'Pembayaran')

@section('content')

<div class="max-w-7xl mx-auto px-4">

    <h2 class="text-2xl font-semibold text-gray-800 mb-10 font-inria">
        Daftar Properti Belum Dibayar
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse($properti as $item)

    <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1
                transition duration-300 overflow-hidden border border-gray-100 relative">

        {{-- Image --}}
        <div class="overflow-hidden">
            <img src="{{ asset('storage/' . $item->foto_properti) }}"
                 class="w-full h-52 object-cover hover:scale-105 transition duration-500">
        </div>

        {{-- Content --}}
        <div class="p-6 text-sm">

            <h3 class="font-semibold text-gray-800 mb-1 font-inria">
                {{ $item->nama_properti }}
            </h3>

            <p class="text-gray-500 text-xs mb-3">
                {{ $item->lokasi }}
            </p>

            <p class="font-bold text-indigo-600 text-base mb-5">
                Rp {{ number_format($item->harga, 0, ',', '.') }}
            </p>

            {{-- ================= ACTION ================= --}}
            <div class="flex justify-end">
                <a href="{{ route('pemilik.detail', $item->properti_id) }}"
                   class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">
                    Bayar →
                </a>
            </div>

        </div>

    </div>

    @empty
        <p class="col-span-3 text-gray-500 text-center font-inria">
            Tidak ada properti yang perlu dibayar.
        </p>
    @endforelse

    </div>

</div>

@endsection
