@extends('layouts.pelanggan')

@section('title', 'Beranda')

@section('content')

{{-- HERO / BANNER --}}
<section class="relative h-[420px]">
    <img 
        src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c"
        class="w-full h-full object-cover"
        alt="Banner"
    >
    <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center px-6">
        <h1 class="text-5xl font-bold text-white font-inria mb-4">
            Temukan Properti Impian Anda
        </h1>
        <p class="text-gray-200 max-w-2xl">
            Platform terpercaya untuk menemukan rumah, tanah, dan properti terbaik 
            dengan proses aman dan transparan.
        </p>
    </div>
</section>



{{-- PROPERTI UNGGULAN --}}
<section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-6">
        
        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-bold font-inria">
                Daftar Properti Unggulan
            </h2>
            <a href="#" class="text-sm font-semibold text-gray-600 hover:text-black transition">
                Lihat Semua →
            </a>
        </div>


        {{-- Card Grid --}}
        <div class="grid md:grid-cols-3 gap-8">

            {{-- CARD 1 --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition duration-300">
                <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be"
                     class="w-full h-52 object-cover"
                     alt="Rumah 1">

                <div class="p-6 text-sm">
                    <h3 class="font-semibold text-lg mb-1">Rumah Minimalis Modern</h3>
                    <p class="text-gray-500">Sleman, Yogyakarta</p>
                    <p class="text-gray-500 mt-1">
                        3 Kamar Tidur | 2 Kamar Mandi | Luas 200m²
                    </p>
                    <p class="font-bold text-base mt-3">
                        Rp 1.000.000.000
                    </p>

                    <div class="text-right mt-4">
                        <a href="#" 
                           class="text-sm font-semibold text-[#151541] hover:underline">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            </div>


            {{-- CARD 2 --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition duration-300">
                <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994"
                     class="w-full h-52 object-cover"
                     alt="Rumah 2">

                <div class="p-6 text-sm">
                    <h3 class="font-semibold text-lg mb-1">Rumah Dua Lantai Elegan</h3>
                    <p class="text-gray-500">Bantul, Yogyakarta</p>
                    <p class="text-gray-500 mt-1">
                        3 Kamar Tidur | 3 Kamar Mandi | Luas 180m²
                    </p>
                    <p class="font-bold text-base mt-3">
                        Rp 2.000.000.000
                    </p>

                    <div class="text-right mt-4">
                        <a href="#" 
                           class="text-sm font-semibold text-[#151541] hover:underline">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            </div>


            {{-- CARD 3 --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition duration-300">
                <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d"
                     class="w-full h-52 object-cover"
                     alt="Rumah 3">

                <div class="p-6 text-sm">
                    <h3 class="font-semibold text-lg mb-1">Rumah Keluarga Nyaman</h3>
                    <p class="text-gray-500">Kota Yogyakarta</p>
                    <p class="text-gray-500 mt-1">
                        3 Kamar Tidur | 2 Kamar Mandi | Luas 250m²
                    </p>
                    <p class="font-bold text-base mt-3">
                        Rp 800.000.000
                    </p>

                    <div class="text-right mt-4">
                        <a href="#" 
                           class="text-sm font-semibold text-[#151541] hover:underline">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
