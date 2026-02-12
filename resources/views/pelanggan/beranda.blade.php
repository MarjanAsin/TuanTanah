@extends('layouts.pelanggan')

@section('title', 'Beranda')

@section('content')

<section class="relative h-[420px] overflow-hidden">

    @if($banner && $banner->gambar_banner)
        <img
            src="{{ asset('storage/' . $banner->gambar_banner) }}"
            class="w-full h-full object-cover"
            alt="Banner">
    @else
        {{-- Background Modern --}}
        <div class="w-full h-full bg-gradient-to-r from-[#151541] via-indigo-700 to-[#151541]
                    flex flex-col items-center justify-center text-center px-6 relative">

            {{-- Decorative blur circle --}}
            <div class="absolute w-72 h-72 bg-indigo-500 opacity-30 rounded-full blur-3xl top-10 left-10"></div>
            <div class="absolute w-72 h-72 bg-blue-400 opacity-20 rounded-full blur-3xl bottom-10 right-10"></div>

            <div class="relative z-10 max-w-3xl">
                <h1 class="text-5xl font-bold text-white font-inria mb-4 leading-tight">
                    Temukan Properti Impian Anda
                </h1>

                <p class="text-gray-200 mb-6">
                    Platform terpercaya untuk menemukan rumah, tanah, dan properti terbaik
                    dengan proses aman dan transparan.
                </p>
            </div>

        </div>
    @endif

</section>




{{-- PROPERTI UNGGULAN --}}
<section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-bold font-inria">
                Daftar Properti Unggulan
            </h2>

            <a href="{{ route('pelanggan.properti') }}"
               class="text-sm font-semibold text-gray-600 hover:text-black transition">
                Lihat Semua →
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">

            @forelse($properti as $item)

                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition duration-300">

                    <img src="{{ asset('storage/' . $item->foto_properti) }}"
                         class="w-full h-52 object-cover">

                    <div class="p-6 text-sm">
                        <h3 class="font-semibold text-lg mb-1">
                            {{ $item->nama_properti }}
                        </h3>

                        <p class="text-gray-500">
                            {{ $item->lokasi }}
                        </p>

                        <p class="text-gray-500 mt-1">
                            {{ $item->fasilitas }}
                        </p>

                        <p class="font-bold text-base mt-3">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </p>

                        <div class="text-right mt-4">
                            <a href="{{ route('pelanggan.detail', $item->properti_id) }}"
                               class="text-sm font-semibold text-[#151541] hover:underline">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>

                </div>

            @empty
                <p class="text-gray-500 text-sm">
                    Belum ada properti unggulan.
                </p>
            @endforelse

        </div>

    </div>
</section>


@endsection
