@extends('layouts.pelanggan')

@section('title', 'Properti')

@section('content')

<div class="bg-white">

    {{-- PROPERTI UNGGULAN --}}
    <section class="py-3">
        <div class="max-w-7xl mx-auto px-6">
            
            <h2 class="text-2xl font-semibold font-inria mb-6">
                Daftar Properti unggulan
            </h2>

            <div class="grid md:grid-cols-3 gap-10">

                {{-- CARD --}}
                @for ($i = 1; $i <= 3; $i++)
                <div class="bg-white rounded-md shadow-sm overflow-hidden hover:shadow-md transition duration-200">

                    <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be"
                         class="w-full h-44 object-cover"
                         alt="Rumah">

                    <div class="p-4 text-xs">
                        <h3 class="font-semibold mb-1">Rumah {{ $i }}</h3>
                        <p class="text-gray-500">Lokasi</p>
                        <p class="text-gray-500">
                            3 Kamar Tidur | 2 Kamar Mandi | Luas Rumah 300m²
                        </p>

                        <div class="flex justify-between items-center mt-2">
                            <p class="font-semibold">
                                Rp 1.000.000.000
                            </p>
                            <a href="#" class="text-gray-600 hover:text-black">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>

                </div>
                @endfor

            </div>
        </div>
    </section>


    {{-- DAFTAR PROPERTI --}}
    <section class="py-4">
        <div class="max-w-7xl mx-auto px-6">
            
            <h2 class="text-2xl font-semibold font-inria mb-6">
                Daftar Properti
            </h2>

            <div class="grid md:grid-cols-3 gap-10">

                {{-- CARD --}}
                @for ($i = 1; $i <= 3; $i++)
                <div class="bg-white rounded-md shadow-sm overflow-hidden hover:shadow-md transition duration-200">

                    <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be"
                         class="w-full h-44 object-cover"
                         alt="Rumah">

                    <div class="p-4 text-xs">
                        <h3 class="font-semibold mb-1">Rumah {{ $i }}</h3>
                        <p class="text-gray-500">Lokasi</p>
                        <p class="text-gray-500">
                            3 Kamar Tidur | 2 Kamar Mandi | Luas Rumah 300m²
                        </p>

                        <div class="flex justify-between items-center mt-2">
                            <p class="font-semibold">
                                Rp 1.000.000.000
                            </p>
                            <a href="#" class="text-gray-600 hover:text-black">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>

                </div>
                @endfor

            </div>
        </div>
    </section>

</div>

@endsection
