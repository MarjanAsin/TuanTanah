@extends('layouts.pelanggan')

@section('title', 'Properti')

@section('content')

<div class="bg-gray-50">

    {{-- PROPERTI UNGGULAN --}}
    <section class="py-1">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-3xl font-bold font-inria text-gray-800 mb-5">
                Daftar Properti Unggulan
            </h2>

            <div class="grid md:grid-cols-3 gap-10">

                @forelse($unggulan as $item)

                <a href="{{ route('pelanggan.detail', $item->properti_id) }}"
                class="group block bg-white rounded-2xl shadow-sm overflow-hidden
                        hover:shadow-xl hover:-translate-y-1
                        transition duration-300">

                    {{-- IMAGE + BADGE --}}
                    <div class="relative overflow-hidden">
                        <img src="{{ $item->foto_properti ? asset('storage/' . $item->foto_properti) : asset('images/no-image.png') }}"
                            class="w-full h-44 object-cover
                                    group-hover:scale-105 transition duration-300">

                        <div class="absolute top-3 left-3 bg-gradient-to-r from-yellow-600 to-orange-400 text-white text-xs px-3 py-1 rounded-full shadow font-semibold">
                            ⭐ Properti Unggulan
                        </div>
                    </div>

                    <div class="p-5 text-sm">

                        <h3 class="font-semibold text-gray-800 mb-1 font-inria group-hover:text-indigo-600 transition">
                            {{ $item->nama_properti }}
                        </h3>

                        <p class="text-gray-500 text-xs mb-1">
                            {{ $item->lokasi }}
                        </p>

                        <p class="text-gray-500 text-xs truncate">
                            {{ implode(' • ', array_map('trim', explode(',', $item->fasilitas))) }}
                        </p>

                        <div class="flex justify-between items-center mt-4">
                            <p class="font-bold text-indigo-600">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </p>
                        </div>

                    </div>

                </a>

                @empty
                    <p class="text-gray-500 col-span-3 text-center font-inria">
                        Belum ada properti unggulan.
                    </p>
                @endforelse

            </div>
        </div>
    </section>


    <section class="py-7">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-3xl font-bold font-inria text-gray-800 mb-4">
                Daftar Properti
            </h2>

            <div class="grid md:grid-cols-3 gap-10">

                @forelse($properti as $item)

                <a href="{{ route('pelanggan.detail', $item->properti_id) }}"
                class="group block bg-white rounded-2xl shadow-sm overflow-hidden
                        hover:shadow-xl hover:-translate-y-1
                        transition duration-300">

                    {{-- IMAGE --}}
                    <div class="overflow-hidden">
                        <img src="{{ $item->foto_properti ? asset('storage/' . $item->foto_properti) : asset('images/no-image.png') }}"
                            class="w-full h-44 object-cover
                                    group-hover:scale-105 transition duration-300">
                    </div>

                    <div class="p-5 text-sm">

                        <h3 class="font-semibold text-gray-800 mb-1 font-inria group-hover:text-indigo-600 transition">
                            {{ $item->nama_properti }}
                        </h3>

                        <p class="text-gray-500 text-xs mb-1">
                            {{ $item->lokasi }}
                        </p>

                        <p class="text-gray-500 text-xs truncate">
                            {{ implode(' • ', array_map('trim', explode(',', $item->fasilitas))) }}
                        </p>

                        <div class="flex justify-between items-center mt-4">
                            <p class="font-bold text-indigo-600">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </p>
                        </div>

                    </div>

                </a>

                @empty
                    <p class="text-gray-500 col-span-3 text-center font-inria">
                        Belum ada properti tersedia.
                    </p>
                @endforelse

            </div>
        </div>
    </section>

</div>

@endsection
