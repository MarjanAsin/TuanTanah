@extends('layouts.pemilik')

@section('title', 'Riwayat Properti')

@section('content')

<div class="bg-white">

    {{-- Menunggu Verifikasi --}}
    <section class="py-3">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-2xl font-semibold font-inria mb-6">
                Menunggu Verifikasi
            </h2>

            <div class="grid md:grid-cols-3 gap-10">

                @forelse($menunggu as $item)

                <div class="bg-white rounded-md shadow-sm overflow-hidden hover:shadow-md transition duration-200">

                    <img src="{{ asset('storage/' . $item->foto_properti) }}"
                        class="w-full h-44 object-cover"
                        alt="Properti">

                    <div class="p-4 text-xs">
                        <h3 class="font-semibold mb-1">
                            {{ $item->nama_properti }}
                        </h3>

                        <p class="text-gray-500">
                            {{ $item->lokasi }}
                        </p>

                        <p class="text-gray-500">
                            {{ $item->fasilitas }}
                        </p>

                        <div class="flex justify-between items-center mt-2">
                            <p class="font-semibold">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </p>

                            <a href="{{ route('pemilik.edit', $item->properti_id) }}"
                            class="text-gray-600 hover:text-black">
                                Ubah data →
                            </a>
                        </div>
                    </div>

                </div>

                @empty
                    <p class="text-gray-500 text-sm">
                        Tidak ada properti yang sedang menunggu verifikasi.
                    </p>
                @endforelse

            </div>

        </div>
    </section>


    {{-- Ditolak --}}
    <section class="py-4">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-2xl font-semibold font-inria mb-6">
                Ditolak
            </h2>

            <div class="grid md:grid-cols-3 gap-10">

                @forelse($ditolak as $item)

                <div class="bg-white rounded-md shadow-sm overflow-hidden hover:shadow-md transition duration-200 border border-red-300">

                    <img src="{{ asset('storage/' . $item->foto_properti) }}"
                        class="w-full h-44 object-cover"
                        alt="Properti">

                    <div class="p-4 text-xs">
                        <h3 class="font-semibold mb-1">
                            {{ $item->nama_properti }}
                        </h3>

                        <p class="text-gray-500">
                            {{ $item->lokasi }}
                        </p>

                        <p class="text-gray-500">
                            {{ $item->fasilitas }}
                        </p>

                        <div class="flex justify-between items-center mt-2">
                            <p class="font-semibold">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </p>

                            <a href="{{ route('pemilik.edit', $item->properti_id) }}"
                            class="text-gray-600 hover:text-black">
                                Ubah data →
                            </a>
                        </div>

                        <p class="text-red-600 mt-2">
                            Properti ini ditolak oleh admin.
                        </p>
                    </div>

                </div>

                @empty
                    <p class="text-gray-500 text-sm">
                        Tidak ada properti yang ditolak.
                    </p>
                @endforelse

            </div>

        </div>
    </section>

</div>

@endsection
