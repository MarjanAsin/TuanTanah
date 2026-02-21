@extends('layouts.pemilik')

@section('title', 'Riwayat Properti')

@section('content')

<div class="bg-gray-50 pb-16">

    {{-- =========================
        MENUNGGU VERIFIKASI
    ========================= --}}
    <section class="pt-8">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-2xl font-semibold font-inria text-gray-800 mb-8">
                Menunggu Verifikasi
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse($menunggu as $item)

                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1
                            transition duration-300 overflow-hidden border border-gray-100 relative">

                    {{-- Badge --}}
                    <div class="absolute top-4 left-4
                                bg-yellow-100 text-yellow-700
                                text-xs font-semibold px-3 py-1 rounded-full">
                        Menunggu
                    </div>

                    <div class="overflow-hidden">
                        <img src="{{ asset('storage/' . $item->foto_properti) }}"
                             class="w-full h-52 object-cover hover:scale-105 transition duration-500"
                             alt="Properti">
                    </div>

                    <div class="p-5 text-sm">

                        <h3 class="font-semibold text-gray-800 mb-1 font-inria">
                            {{ $item->nama_properti }}
                        </h3>

                        <p class="text-gray-500 text-xs mb-1">
                            {{ $item->lokasi }}
                        </p>

                        <p class="text-gray-500 text-xs truncate">
                            {{ $item->fasilitas }}
                        </p>

                        <div class="flex justify-between items-center mt-4">
                            <p class="font-bold text-indigo-600">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </p>

                            <a href="{{ route('pemilik.edit', $item->properti_id) }}"
                               class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">
                                Ubah Data →
                            </a>
                        </div>
                    </div>

                </div>

                @empty
                    <p class="col-span-3 text-gray-500 text-sm text-center font-inria">
                        Tidak ada properti yang sedang menunggu verifikasi.
                    </p>
                @endforelse

            </div>
        </div>
    </section>



    {{-- =========================
    DITOLAK
    ========================= --}}
    <section class="pt-12">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-2xl font-semibold font-inria text-gray-800 mb-8">
                Ditolak
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse($ditolak as $item)

                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1
                            transition duration-300 overflow-hidden border border-red-100 relative">

                    {{-- Badge --}}
                    <div class="absolute top-4 left-4
                                bg-red-100 text-red-600
                                text-xs font-semibold px-3 py-1 rounded-full">
                        Ditolak
                    </div>

                    <div class="overflow-hidden">
                        <img src="{{ asset('storage/' . $item->foto_properti) }}"
                            class="w-full h-52 object-cover hover:scale-105 transition duration-500"
                            alt="Properti">
                    </div>

                    <div class="p-5 text-sm">

                        <h3 class="font-semibold text-gray-800 mb-1 font-inria">
                            {{ $item->nama_properti }}
                        </h3>

                        <p class="text-gray-500 text-xs mb-1">
                            {{ $item->lokasi }}
                        </p>

                        <p class="text-gray-500 text-xs truncate">
                            {{ $item->fasilitas }}
                        </p>

                        <div class="flex justify-between items-center mt-4 pt-3 border-t border-gray-100">
                            <p class="font-bold text-indigo-600">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </p>

                            <a href="{{ route('pemilik.edit', $item->properti_id) }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">
                                Ubah Data →
                            </a>
                        </div>

                        {{-- ================= ALASAN PENOLAKAN ================= --}}
                        @if($item->alasan_penolakan)
                            <div class="mt-4 bg-red-50 border border-red-200 rounded-xl p-3">
                                <p class="text-xs font-semibold text-red-600 mb-1 font-inria">
                                    Alasan Penolakan:
                                </p>
                                <p class="text-xs text-red-700 leading-relaxed font-inria">
                                    {{ $item->alasan_penolakan }}
                                </p>
                            </div>
                        @else
                            <p class="text-red-600 text-xs mt-3 font-inria">
                                Properti ini ditolak oleh admin.
                            </p>
                        @endif

                    </div>

                </div>

                @empty
                    <p class="col-span-3 text-gray-500 text-sm text-center font-inria">
                        Tidak ada properti yang ditolak.
                    </p>
                @endforelse

            </div>
        </div>
    </section>

</div>

@endsection
