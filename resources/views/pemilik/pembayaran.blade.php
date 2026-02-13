@extends('layouts.pemilik')

@section('title', 'Pembayaran')

@section('content')

<h2 class="text-lg font-semibold mb-6">
    Properti Belum Dibayar
</h2>

<div class="grid md:grid-cols-2 gap-8">

@forelse($properti as $item)

<div class="bg-white rounded-md shadow-sm overflow-hidden">

    <img src="{{ asset('storage/' . $item->foto_properti) }}"
         class="w-full h-48 object-cover">

    <div class="p-4 text-sm">
        <h3 class="font-semibold">
            {{ $item->nama_properti }}
        </h3>

        <p class="text-gray-500">
            {{ $item->lokasi }}
        </p>

        <p class="font-semibold mt-2">
            Rp {{ number_format($item->harga, 0, ',', '.') }}
        </p>

        <p class="text-red-600 text-xs mt-2">
            Status: Menunggu Pembayaran
        </p>

        <div class="text-right mt-3">
            <a href="{{ route('pemilik.detail', $item->properti_id) }}"
               class="text-indigo-600 text-sm">
                Detail →
            </a>
        </div>
    </div>

</div>

@empty
<p class="text-gray-500 text-sm">
    Tidak ada properti yang perlu dibayar.
</p>
@endforelse

</div>

@endsection
