@extends('layouts.admin')

@section('title', 'Detail Verifikasi')

@section('content')

<div class="max-w-6xl mx-auto mt-10 mb-16">

    <div class="grid grid-cols-2 gap-12">

        {{-- KIRI --}}
        <div>

            <img src="{{ asset('storage/' . $properti->foto_properti) }}"
                 class="w-full h-72 object-cover mb-3">

            <p class="text-xs text-center text-gray-600 mb-6">
                Diposting pada
                {{ \Carbon\Carbon::parse($properti->created_at)->format('d.m.Y') }}
            </p>

            <div class="flex justify-between">

                {{-- Tolak --}}
                <form method="POST"
                      action="{{ route('admin.proses', [$properti->properti_id, 'tolak']) }}">
                    @csrf
                    <button class="bg-red-700 text-white px-6 py-2 text-sm hover:bg-red-800 transition">
                        Tolak Properti
                    </button>
                </form>

                {{-- Setujui --}}
                <form method="POST"
                      action="{{ route('admin.proses', [$properti->properti_id, 'setujui']) }}">
                    @csrf
                    <button class="bg-green-600 text-white px-6 py-2 text-sm hover:bg-green-700 transition">
                        Verifikasi Properti
                    </button>
                </form>

            </div>

        </div>



        {{-- KANAN --}}
        <div class="space-y-4 text-sm">

            <h3 class="text-base font-semibold mb-2">
                {{ $properti->nama_properti }}
            </h3>

            <div class="bg-gray-100 p-4 border border-gray-300">
                <p class="font-semibold mb-1">Lokasi</p>
                <p>{{ $properti->lokasi }}</p>
            </div>

            <div class="bg-gray-100 p-4 border border-gray-300">
                <p class="font-semibold mb-1">Fasilitas</p>
                <p>{{ $properti->fasilitas }}</p>
            </div>

            <div class="bg-gray-100 p-4 border border-gray-300">
                <p class="font-semibold mb-1">Harga</p>
                <p>Rp {{ number_format($properti->harga, 0, ',', '.') }}</p>
            </div>

            <div class="bg-gray-100 p-4 border border-gray-300">
                <p class="font-semibold mb-1">Deskripsi</p>
                <p>{{ $properti->deskripsi }}</p>
            </div>

            <div class="bg-gray-100 p-4 border border-gray-300">
                <p class="font-semibold mb-1">Kontak WhatsApp</p>
                <p>{{ $properti->kontak_whatsapp }}</p>
            </div>

        </div>

    </div>

</div>

@endsection
