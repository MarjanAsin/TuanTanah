@extends('layouts.pemilik')

@section('title', 'Beranda')

@section('content')
<div class="flex flex-col lg:flex-row gap-8 mb-12">

    <div class="flex-1">

        <div class="bg-gradient-to-r from-[#151541] to-indigo-800
                    text-white p-4 rounded-t-2xl">
            <h3 class="text-base font-semibold text-center lg:text-left font-inria">
                Status Properti
            </h3>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5
                    gap-4 bg-white p-4 sm:p-6
                    rounded-b-2xl shadow-sm">

            <div class="bg-gradient-to-br from-[#151541] to-indigo-800
                        text-white px-4 py-4 rounded-xl text-center">
                <p class="text-[10px] sm:text-xs uppercase tracking-wide font-bold text-indigo-200">
                    Total Properti
                </p>
                <p class="text-xl sm:text-2xl font-bold mt-1 font-inria">
                    {{ $total }}
                </p>
            </div>

            <div class="bg-red-100 text-red-500 px-4 py-4 rounded-xl text-center">
                <p class="text-[10px] sm:text-xs uppercase tracking-wide font-bold">
                    Belum Dibayar
                </p>
                <p class="text-xl sm:text-2xl font-bold mt-1 font-inria">
                    {{ $menungguPembayaran }}
                </p>
            </div>

            <div class="bg-indigo-100 text-indigo-700 px-4 py-4 rounded-xl text-center">
                <p class="text-[10px] sm:text-xs uppercase tracking-wide font-bold">
                    Menunggu
                </p>
                <p class="text-xl sm:text-2xl font-bold mt-1 font-inria">
                    {{ $menunggu }}
                </p>
            </div>

            <div class="bg-green-100 text-green-700 px-4 py-4 rounded-xl text-center">
                <p class="text-[10px] sm:text-xs uppercase tracking-wide font-bold">
                    Disetujui
                </p>
                <p class="text-xl sm:text-2xl font-bold mt-1 font-inria">
                    {{ $disetujui }}
                </p>
            </div>

            <div class="bg-red-100 text-red-700 px-4 py-4 rounded-xl text-center">
                <p class="text-[10px] sm:text-xs uppercase tracking-wide font-bold">
                    Ditolak
                </p>
                <p class="text-xl sm:text-2xl font-bold mt-1 font-inria">
                    {{ $ditolak }}
                </p>
            </div>

        </div>

    </div>

</div>


<h2 class="text-xl font-semibold text-gray-800 mb-8 font-inria">
    Properti yang sudah disetujui
</h2>

<div class="grid md:grid-cols-3 gap-8">

@forelse($properti as $item)

<a href="{{ route('pemilik.edit', $item->properti_id) }}"
   class="group block bg-white rounded-2xl shadow-sm overflow-hidden relative
          hover:shadow-xl hover:-translate-y-1
          transition duration-300 cursor-pointer">

    {{-- Badge Properti Unggulan --}}
    @if($item->is_unggulan)
        <div class="absolute top-4 left-4
                    bg-gradient-to-r from-yellow-600 to-orange-400
                    text-white px-3 py-1 text-xs font-semibold
                    rounded-full shadow-md font-inria z-10">
            ⭐ Properti Unggulan
        </div>
    @endif

    @php
        $foto = $item->fotos->first();
    @endphp

    <div class="overflow-hidden">
        <img loading="lazy" src="{{ $foto ? asset('storage/' . $foto->path) : asset('images/no-image.png') }}"
            class="w-full h-52 object-cover group-hover:scale-105 transition duration-500">
    </div>
    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur text-gray-700 text-xs px-3 py-1 rounded-full shadow font-bold font-inria">
        {{ ucfirst($item->tipe_properti ?? 'properti') }}
    </div>

    <div class="p-5 text-sm">

        <h3 class="font-semibold text-gray-800 mb-1 font-inria">
            {{ $item->nama_properti }}
        </h3>

        <p class="text-gray-500 text-xs mb-1 font-inria">
            {{ $item->lokasi }}
        </p>

        <p class="text-gray-500 text-xs truncate font-inria">
            {{ implode(' • ', array_map('trim', explode(',', $item->fasilitas))) }}
        </p>

        <p class="font-bold text-indigo-600 mt-3 font-inria text-lg">
            Rp {{ number_format($item->harga, 0, ',', '.') }}
        </p>

        <p class="text-xs text-gray-400 mt-3 font-inria">
            Klik untuk mengubah data
        </p>

    </div>

</a>

@empty
    <p class="text-gray-500 col-span-3 text-center font-inria">
        Belum ada properti yang disetujui.
    </p>
@endforelse

</div>

@if($properti->hasPages())
    <div class="mt-10 border-gray-100 flex justify-center font-inria">

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm px-2 py-2">
            {{ $properti->onEachSide(1)->links() }}
        </div>

    </div>
@endif

@endsection
