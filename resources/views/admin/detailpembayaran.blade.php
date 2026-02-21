@extends('layouts.admin')

@section('title', 'Detail Pembayaran')

@section('content')

<div class="max-w-5xl mx-auto mt-4">

    {{-- Back Button --}}
    <a href="{{ route('admin.pembayaran') }}"
       class="inline-flex items-center gap-2 mb-8 px-4 py-2
              bg-white border border-gray-200 rounded-full shadow-sm
              text-sm font-medium text-gray-700
              hover:bg-indigo-600 hover:text-white hover:shadow-md
              transition duration-300">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-4 h-4"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor"
             stroke-width="2">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15 19l-7-7 7-7" />
        </svg>

        Kembali
    </a>

    <div class="grid md:grid-cols-2 gap-12">

        {{-- ================= LEFT ================= --}}
        <div class="space-y-6">

            {{-- Foto Properti --}}
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <img src="{{ asset('storage/' . $properti->foto_properti) }}"
                     class="w-full h-72 object-cover">
            </div>

            {{-- Bukti Pembayaran --}}
            <div class="bg-white rounded-xl shadow-sm p-4">
                <p class="text-sm font-semibold mb-3 text-gray-700 font-inria">
                    Bukti Pembayaran
                </p>

                <a href="{{ asset('storage/' . $properti->bukti_pembayaran) }}"
                   target="_blank"
                   class="block">
                    <img src="{{ asset('storage/' . $properti->bukti_pembayaran) }}"
                         class="w-full h-60 object-cover rounded-lg border hover:opacity-90 transition">
                </a>

                <p class="text-xs text-gray-500 mt-2">
                    Klik gambar untuk memperbesar.
                </p>
            </div>

        </div>


        {{-- ================= RIGHT ================= --}}
        <div class="space-y-6">

            <div class="bg-white rounded-xl shadow-sm p-6">

                <h3 class="text-lg font-semibold mb-6 font-inria">
                    {{ $properti->nama_properti }}
                </h3>

                <div class="space-y-4 text-sm">

                    <div class="bg-gray-50 p-4 rounded-lg border">
                        <p class="font-semibold text-gray-700 mb-1 font-inria">Lokasi</p>
                        <p class="text-gray-600">{{ $properti->lokasi }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg border">
                        <p class="font-semibold text-gray-700 mb-1 font-inria">Fasilitas</p>
                        <p class="text-gray-600">{{ $properti->fasilitas }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg border">
                        <p class="font-semibold text-gray-700 mb-1 font-inria">Harga</p>
                        <p class="text-gray-800 font-semibold">
                            Rp {{ number_format($properti->harga, 0, ',', '.') }}
                        </p>
                    </div>

                </div>

                {{-- Action Button --}}
                <div class="mt-8">
                    <form method="POST"
                          action="{{ route('admin.validasi.pembayaran', $properti->properti_id) }}">
                        @csrf

                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700
                                   text-white py-3 rounded-lg
                                   text-sm font-semibold
                                   transition duration-300 shadow-sm cursor-pointer font-inria">
                            Validasi Pembayaran
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection
