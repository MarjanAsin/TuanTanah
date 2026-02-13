@extends('layouts.pemilik')

@section('title', 'Beranda')

@section('content')

{{-- =========================
    STATISTIK
========================= --}}
<div class="flex gap-8 mb-10">

    {{-- Jumlah Properti --}}
    <div class="bg-[#151541] text-white p-6 rounded-md w-48 text-center">
        <h3 class="text-lg mb-2">Jumlah Properti</h3>
        <p class="text-2xl font-semibold">{{ $total }}</p>
    </div>

    {{-- Status Properti --}}
    <div class="flex-1">
        <div class="bg-[#151541] text-white p-3 rounded-t-md">
            <h3 class="text-lg">Status Properti</h3>
        </div>

        <div class="flex gap-6 bg-white p-6 rounded-b-md shadow-sm">

            <div class="bg-[#151541] text-white px-8 py-4 rounded-md text-center">
                <p>Menunggu</p>
                <p class="text-xl font-semibold">{{ $menunggu }}</p>
            </div>

            <div class="bg-[#151541] text-white px-8 py-4 rounded-md text-center">
                <p>Disetujui</p>
                <p class="text-xl font-semibold">{{ $disetujui }}</p>
            </div>

            <div class="bg-[#151541] text-white px-8 py-4 rounded-md text-center">
                <p>Ditolak</p>
                <p class="text-xl font-semibold">{{ $ditolak }}</p>
            </div>

        </div>
    </div>

</div>



{{-- =========================
    PROPERTI DISETUJUI
========================= --}}
<h2 class="text-lg font-semibold mb-6">
    Properti yang sudah disetujui
</h2>

<div class="grid md:grid-cols-2 gap-10">

    @forelse($properti as $item)

    <div class="bg-white rounded-md shadow-sm overflow-hidden relative">

        {{-- Badge Properti Unggulan --}}
        @if($item->is_unggulan)
            <div class="absolute top-3 left-3
                        bg-gradient-to-r from-yellow-400 to-orange-500
                        text-white px-3 py-1 text-xs font-semibold rounded shadow-md">
                ⭐ Properti Unggulan
            </div>
        @endif

        <img src="{{ asset('storage/' . $item->foto_properti) }}"
             class="w-full h-48 object-cover">

        <div class="p-4 text-sm">

            <h3 class="font-semibold mb-1">
                {{ $item->nama_properti }}
            </h3>

            <p class="text-gray-500">
                {{ $item->lokasi }}
            </p>

            <p class="text-gray-500">
                {{ $item->fasilitas }}
            </p>

            <p class="font-semibold mt-2">
                Rp {{ number_format($item->harga, 0, ',', '.') }}
            </p>

            <div class="text-right mt-2">
                <a href="{{ route('pemilik.edit', $item->properti_id) }}"
                   class="text-sm text-gray-600 hover:text-black">
                    Ubah data →
                </a>
            </div>

        </div>
    </div>

    @empty
        <p class="text-gray-500 text-sm">
            Belum ada properti yang disetujui.
        </p>
    @endforelse

</div>

@endsection
