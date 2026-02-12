@extends('layouts.pelanggan')

@section('title', 'Properti')

@section('content')

<div class="bg-white">

    {{-- PROPERTI UNGGULAN --}}
    <section class="py-6">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-2xl font-semibold font-inria mb-6">
                Daftar Properti Unggulan
            </h2>

            <div class="grid md:grid-cols-3 gap-10">

                @forelse($unggulan as $item)
                <div class="bg-white rounded-md shadow-sm overflow-hidden hover:shadow-md transition duration-200">

                    <img src="{{ asset('storage/' . $item->foto_properti) }}"
                         class="w-full h-44 object-cover">

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

                            <a href="{{ route('pelanggan.detail', $item->properti_id) }}"
                               class="text-gray-600 hover:text-black">
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


    {{-- SEMUA PROPERTI --}}
    <section class="py-6">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-2xl font-semibold font-inria mb-6">
                Daftar Properti
            </h2>

            <div class="grid md:grid-cols-3 gap-10">

                @forelse($properti as $item)
                <div class="bg-white rounded-md shadow-sm overflow-hidden hover:shadow-md transition duration-200">

                    <img src="{{ asset('storage/' . $item->foto_properti) }}"
                         class="w-full h-44 object-cover">

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

                            <a href="{{ route('pelanggan.detail', $item->properti_id) }}"
                               class="text-gray-600 hover:text-black">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>

                </div>
                @empty
                    <p class="text-gray-500 text-sm">
                        Belum ada properti tersedia.
                    </p>
                @endforelse

            </div>
        </div>
    </section>

</div>

@endsection
