@extends('layouts.admin')

@section('title', 'Detail Pembayaran')

@section('content')

<div class="max-w-4xl mx-auto mt-12">

    <div class="grid grid-cols-2 gap-10">

        {{-- KIRI --}}
        <div>
            <img src="{{ asset('storage/' . $properti->foto_properti) }}"
                 class="w-full h-72 object-cover mb-4">

            <p class="text-sm text-gray-600">
                Bukti Pembayaran:
            </p>

            <img src="{{ asset('storage/' . $properti->bukti_pembayaran) }}"
                 class="w-full h-60 object-cover border mt-2">
        </div>

        {{-- KANAN --}}
        <div class="space-y-4 text-sm">

            <h3 class="font-semibold text-base">
                {{ $properti->nama_properti }}
            </h3>

            <div class="bg-gray-100 p-4 border">
                <p><strong>Lokasi:</strong> {{ $properti->lokasi }}</p>
            </div>

            <div class="bg-gray-100 p-4 border">
                <p><strong>Fasilitas:</strong> {{ $properti->fasilitas }}</p>
            </div>

            <div class="bg-gray-100 p-4 border">
                <p><strong>Harga:</strong> Rp {{ number_format($properti->harga, 0, ',', '.') }}</p>
            </div>

            <form method="POST"
                action="{{ route('admin.validasi.pembayaran', $properti->properti_id) }}">
                @csrf
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 text-sm">
                    Validasi Pembayaran
                </button>
            </form>



        </div>

    </div>

</div>

@endsection
