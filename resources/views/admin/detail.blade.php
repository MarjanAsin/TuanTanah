@extends('layouts.admin')

@section('title', 'Detail Verifikasi')

@section('content')

<div class="max-w-6xl mx-auto mt-2 mb-16">

    {{-- Back Button --}}
    <a href="{{ route('admin.verifikasi') }}"
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

    <div class="grid md:grid-cols-2 gap-14">

        {{-- ================= LEFT ================= --}}
        <div class="space-y-6">

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <img src="{{ asset('storage/' . $properti->foto_properti) }}"
                     class="w-full h-72 object-cover">
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-4 text-center">
                <p class="text-xs text-gray-500">
                    Diposting pada
                    {{ \Carbon\Carbon::parse($properti->created_at)->format('d.m.Y') }}
                </p>
            </div>

            <div class="flex justify-between gap-4">

                {{-- Tolak --}}
                <form method="POST"
                      action="{{ route('admin.proses', [$properti->properti_id, 'tolak']) }}"
                      class="w-1/2">
                    @csrf
                    <button
                        class="w-full bg-red-600 hover:bg-red-700
                               text-white py-3 rounded-xl
                               text-sm font-semibold
                               transition duration-300 shadow-sm cursor-pointer">
                        Tolak Properti
                    </button>
                </form>

                {{-- Setujui --}}
                <form method="POST"
                      action="{{ route('admin.proses', [$properti->properti_id, 'setujui']) }}"
                      class="w-1/2">
                    @csrf
                    <button
                        class="w-full bg-green-600 hover:bg-green-700
                               text-white py-3 rounded-xl
                               text-sm font-semibold
                               transition duration-300 shadow-sm cursor-pointer">
                        Verifikasi Properti
                    </button>
                </form>

            </div>

        </div>


        {{-- ================= RIGHT ================= --}}
        <div class="space-y-6">

            <div class="bg-white rounded-2xl shadow-sm p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">
                        {{ $properti->nama_properti }}
                    </h3>
                </div>

                <div class="space-y-4 text-sm">

                    <div class="bg-white p-4 rounded-xl border border-gray-300 shadow-sm">
                        <p class="font-medium text-gray-700 mb-1">Lokasi</p>
                        <p class="text-gray-600">{{ $properti->lokasi }}</p>
                    </div>

                    <div class="bg-white p-4 rounded-xl border border-gray-300 shadow-sm">
                        <p class="font-medium text-gray-700 mb-1">Fasilitas</p>
                        <p class="text-gray-600">{{ $properti->fasilitas }}</p>
                    </div>

                    <div class="bg-white p-4 rounded-xl border border-gray-300 shadow-sm">
                        <p class="font-medium text-gray-700 mb-1">Harga</p>
                        <p class="text-gray-800 font-semibold">
                            Rp {{ number_format($properti->harga, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="bg-white p-4 rounded-xl border border-gray-300 shadow-sm">
                        <p class="font-medium text-gray-700 mb-1">Deskripsi</p>
                        <p class="text-gray-600">{{ $properti->deskripsi }}</p>
                    </div>

                    <div class="bg-white p-4 rounded-xl border border-gray-300 shadow-sm">
                        <p class="font-medium text-gray-700 mb-1">Kontak WhatsApp</p>
                        <p class="text-gray-600">{{ $properti->kontak_whatsapp }}</p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
