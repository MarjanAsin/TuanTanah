@extends('layouts.admin')

@section('title', 'Validasi Pembayaran')

@section('content')

<h2 class="text-lg font-semibold mb-6">
    Properti Menunggu Validasi Pembayaran
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

        <div class="text-right mt-3">
            <a href="{{ route('admin.detailpembayaran', $item->properti_id) }}"
               class="text-indigo-600 text-sm">
                Lihat Detail →
            </a>
        </div>
    </div>

</div>

@empty
<p class="text-gray-500">
    Tidak ada pembayaran yang perlu divalidasi.
</p>
@endforelse

</div>

@endsection
