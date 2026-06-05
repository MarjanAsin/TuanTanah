@extends('layouts.admin')

@section('title', 'Detail Verifikasi')

@section('content')

<div class="max-w-6xl mx-auto mt-2 mb-16 px-4">

    <a href="{{ route('admin.verifikasi') }}"
       class="inline-flex items-center gap-2 mb-8 px-4 py-2
              bg-white border border-gray-200 rounded-full shadow-sm
              text-sm font-medium text-gray-700
              hover:bg-indigo-600 hover:text-white hover:shadow-md
              transition duration-300 font-inria">

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

    {{-- GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-14">

        {{-- LEFT --}}
        <div class="space-y-6">

            {{-- FOTO SLIDER --}}
            <div class="bg-white rounded-2xl shadow-sm p-4 overflow-hidden">

                @if($properti->fotos->count() > 0)

                    <div class="flex gap-4 overflow-x-auto pb-2 snap-x snap-mandatory scroll-smooth">

                        @foreach($properti->fotos as $foto)

                            <div class="flex-shrink-0 snap-center">

                                <img src="{{ asset('storage/' . $foto->path) }}"
                                     class="h-56 sm:h-64 w-[280px] sm:w-96
                                            object-cover rounded-xl shadow">

                            </div>

                        @endforeach

                    </div>
                    <p class="text-sm text-gray-500 font-inria p-4 text-center">
                        Diposting {{ $properti->created_at->diffForHumans() }}
                    </p>

                @else

                    <div class="h-64 flex items-center justify-center text-gray-400 font-inria">
                        Tidak ada foto
                    </div>

                @endif

            </div>

            <div class="bg-white rounded-2xl shadow-sm p-4 text-center">

                <div class="bg-white rounded-2xl shadow-sm p-4">

                    <p class="text-sm font-semibold mb-3 text-gray-800 font-inria">
                        Pembayaran
                    </p>

                    @if($properti->bukti_pembayaran)

                        <a href="{{ asset('storage/' . $properti->bukti_pembayaran) }}"
                        target="_blank">

                            <img src="{{ asset('storage/' . $properti->bukti_pembayaran) }}"
                                class="w-full h-72 object-contain rounded-lg border hover:opacity-90 transition">

                        </a>

                        <p class="text-xs text-gray-500 mt-2 font-inria">
                            Klik untuk memperbesar
                        </p>

                    @else

                        <div class="h-48 flex flex-col items-center justify-center
                                    bg-green-50 border border-green-200 rounded-xl">

                            <p class="text-green-700 font-semibold font-inria">
                                Upload Gratis Pertama
                            </p>

                            <p class="text-sm text-green-600 mt-1 font-inria">
                                Tidak memerlukan pembayaran
                            </p>

                        </div>

                    @endif

                </div>

            </div>

            <div class="space-y-4">

            {{-- BARIS ATAS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                {{-- VERIFIKASI --}}
                <form method="POST"
                    action="{{ route('admin.proses', [$properti->properti_id, 'setujui']) }}">

                    @csrf

                    <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700
                                text-white py-3 rounded-xl
                                text-sm font-semibold
                                transition duration-300 shadow-sm
                                cursor-pointer font-inria">

                        ✓ Verifikasi Properti

                    </button>

                </form>

                {{-- TOLAK PEMBAYARAN --}}
                <button type="button"
                        onclick="toggleAlasanPembayaran()"
                        class="w-full bg-orange-500 hover:bg-orange-600
                            text-white py-3 rounded-xl
                            text-sm font-semibold
                            transition duration-300 shadow-sm
                            cursor-pointer font-inria">

                    ✕ Tolak Pembayaran

                </button>

            </div>

            {{-- FORM TOLAK PEMBAYARAN --}}
            <form method="POST"
                action="{{ route('admin.proses', [$properti->properti_id, 'tolak-pembayaran']) }}">

                @csrf

                <div id="fieldAlasanPembayaran"
                    class="hidden space-y-3">

                    <textarea name="alasan_penolakan"
                            rows="4"
                            placeholder="Contoh: Bukti transfer tidak valid."
                            class="w-full border border-orange-300 rounded-xl
                                    px-4 py-3 text-sm font-inria
                                    focus:outline-none
                                    focus:ring-2 focus:ring-orange-500"></textarea>

                    <button type="submit"
                            class="w-full bg-orange-500 hover:bg-orange-700
                                text-white py-3 rounded-xl
                                text-sm font-semibold
                                cursor-pointer font-inria">

                        Konfirmasi Penolakan Pembayaran

                    </button>

                </div>

            </form>

            {{-- TOLAK PROPERTI --}}
            <button type="button"
                    onclick="toggleAlasanProperti()"
                    class="w-full bg-red-600 hover:bg-red-700
                        text-white py-3 rounded-xl
                        text-sm font-semibold
                        transition duration-300 shadow-sm
                        cursor-pointer font-inria">

                ✕ Tolak Properti

            </button>

            {{-- FORM TOLAK PROPERTI --}}
            <form method="POST"
                action="{{ route('admin.proses', [$properti->properti_id, 'tolak']) }}">

                @csrf

                <div id="fieldAlasanProperti"
                    class="hidden space-y-3">

                    <textarea name="alasan_penolakan"
                            rows="4"
                            placeholder="Contoh: Foto properti tidak sesuai."
                            class="w-full border border-red-300 rounded-xl
                                    px-4 py-3 text-sm font-inria
                                    focus:outline-none
                                    focus:ring-2 focus:ring-red-500"></textarea>

                    <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-800
                                text-white py-3 rounded-xl
                                text-sm font-semibold
                                cursor-pointer font-inria">

                        Konfirmasi Penolakan Properti

                    </button>

                </div>

            </form>

        </div>

        </div>

        {{-- RIGHT --}}
        <div class="space-y-6">

            <div class="bg-white rounded-2xl shadow-sm p-5 sm:p-6">
                @if(
                    $properti->status_pembayaran === 'valid'
                    && !$properti->bukti_pembayaran
                )

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold font-inria">
                        Gratis
                    </span>

                @elseif($properti->status_pembayaran === 'pending')

                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold font-inria">
                        Berbayar
                    </span>

                @endif

                <h3 class="text-lg sm:text-xl font-semibold mb-6 font-inria break-words">
                    {{ $properti->nama_properti }}
                </h3>

                <div class="space-y-4 text-sm">

                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">

                        <p class="font-semibold text-gray-700 mb-1 font-inria">
                            Lokasi
                        </p>

                        <p class="text-gray-600 break-words font-inria">
                            {{ $properti->lokasi }}
                        </p>

                    </div>

                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">

                        <h3 class="font-semibold text-gray-700 mb-4 font-inria">
                            Informasi Properti
                        </h3>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-sm">

                            <div class="p-3 rounded-xl bg-gray-50 font-inria">
                                <p class="text-gray-500 text-xs mb-1">
                                    Tipe Properti
                                </p>

                                <p class="font-semibold text-gray-700 break-words">
                                    {{ ucfirst($properti->tipe_properti ?? '-') }}
                                </p>
                            </div>

                            <div class="p-3 rounded-xl bg-gray-50 font-inria">
                                <p class="text-gray-500 text-xs mb-1">
                                    Luas Tanah
                                </p>

                                <p class="font-semibold text-gray-700">
                                    {{ $properti->luas_tanah ? $properti->luas_tanah . ' ' : '-' }}
                                </p>
                            </div>

                            <div class="p-3 rounded-xl bg-gray-50 font-inria">
                                <p class="text-gray-500 text-xs mb-1">
                                    Luas Bangunan
                                </p>

                                <p class="font-semibold text-gray-700">
                                    {{ $properti->luas_bangunan ? $properti->luas_bangunan . ' ' : '-' }}
                                </p>
                            </div>

                            <div class="p-3 rounded-xl bg-gray-50 font-inria">
                                <p class="text-gray-500 text-xs mb-1">
                                    Kamar Tidur
                                </p>

                                <p class="font-semibold text-gray-700">
                                    {{ $properti->jumlah_kamar ?? '-' }}
                                </p>
                            </div>

                            <div class="p-3 rounded-xl bg-gray-50 font-inria">
                                <p class="text-gray-500 text-xs mb-1">
                                    Kamar Mandi
                                </p>

                                <p class="font-semibold text-gray-700">
                                    {{ $properti->kamar_mandi ?? '-' }}
                                </p>
                            </div>

                            <div class="p-3 rounded-xl bg-gray-50 font-inria">
                                <p class="text-gray-500 text-xs mb-1">
                                    Daya Listrik
                                </p>

                                <p class="font-semibold text-gray-700">
                                    {{ $properti->daya_listrik ? $properti->daya_listrik . ' VA' : '-' }}
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="bg-white p-4 sm:p-5 rounded-xl border border-gray-200 shadow-sm">

                        <p class="font-semibold text-gray-700 mb-4 font-inria">
                            Fasilitas
                        </p>

                        @php
                            $icons = [
                                'AC' => '❄️',
                                'WiFi' => '📶',
                                'Garasi' => '🚗',
                                'Carport' => '🚘',
                                'CCTV' => '📹',
                                'Kolam Renang' => '🏊',
                                'Taman' => '🌳',
                                'PDAM' => '💧',
                                'Keamanan 24 Jam' => '🛡️',
                                'Mushola' => '🕌',
                                'Balkon' => '🏠',
                                'Gudang' => '📦',
                            ];
                        @endphp

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">

                            @foreach(explode(',', $properti->fasilitas ?? '') as $item)

                                @php
                                    $item = trim($item);
                                @endphp

                                @if($item)

                                    <div class="flex items-center gap-3
                                                p-3 rounded-xl
                                                bg-gray-50 border border-gray-100">

                                        <span class="text-lg">
                                            {{ $icons[$item] ?? '🏢' }}
                                        </span>

                                        <span class="text-sm text-gray-700 font-inria">
                                            {{ $item }}
                                        </span>

                                    </div>

                                @endif

                            @endforeach

                        </div>

                    </div>

                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">

                        <p class="font-semibold text-gray-700 mb-1 font-inria">
                            Harga
                        </p>

                        <p class="text-gray-800 font-semibold break-words font-inria text-lg">
                            Rp {{ number_format($properti->harga, 0, ',', '.') }}
                        </p>

                    </div>

                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">

                        <p class="font-semibold text-gray-700 mb-1 font-inria">
                            Biaya Upload
                        </p>

                        <p class="text-indigo-600 font-bold text-lg font-inria">
                            Rp 10.000
                        </p>

                    </div>

                    <div class="bg-white p-4 sm:p-5 rounded-xl border border-gray-200 shadow-sm">

                        <p class="font-semibold text-gray-700 mb-3 font-inria">
                            Deskripsi
                        </p>

                        <ul class="space-y-2">

                            @foreach(explode(',', $properti->deskripsi) as $item)

                                <li class="flex items-start gap-2 text-gray-600 font-inria">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>

                                    <span>{{ trim($item) }}</span>
                                </li>

                            @endforeach

                        </ul>

                    </div>

                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">

                        <p class="font-semibold text-gray-700 mb-1 font-inria">
                            Kontak WhatsApp
                        </p>

                        <p class="text-gray-600 break-all font-inria">
                            {{ $properti->user->nomor_whatsapp }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
function toggleAlasanPembayaran() {

    document
        .getElementById('fieldAlasanPembayaran')
        .classList
        .toggle('hidden');
}

function toggleAlasanProperti() {

    document
        .getElementById('fieldAlasanProperti')
        .classList
        .toggle('hidden');
}
</script>

@endsection
