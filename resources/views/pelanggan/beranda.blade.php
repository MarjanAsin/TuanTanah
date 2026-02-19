@extends('layouts.pelanggan')

@section('title', 'Beranda')

@section('content')

<section class="relative h-[360px] overflow-hidden">

    @if($banner && $banner->gambar_banner)

        {{-- BANNER DARI ADMIN --}}
        <div class="relative w-full h-full">

            <img
                src="{{ asset('storage/' . $banner->gambar_banner) }}"
                class="w-full h-full object-cover"
                alt="Banner">

            {{-- Overlay Soft --}}
            <div class="absolute inset-0 bg-black/30"></div>

        </div>

    @else

        {{-- HERO DEFAULT --}}
        <div class="relative w-full h-full bg-gradient-to-r from-[#151541] via-indigo-700 to-[#151541] flex items-center justify-center text-center px-6 overflow-hidden">

            {{-- Decorative Glow --}}
            <div class="absolute w-64 h-64 bg-indigo-500 opacity-30 rounded-full blur-3xl -top-10 -left-10"></div>
            <div class="absolute w-64 h-64 bg-blue-400 opacity-20 rounded-full blur-3xl -bottom-10 -right-10"></div>

            <div class="relative z-10 max-w-2xl text-white">

                <h1 class="text-4xl md:text-5xl font-bold font-inria mb-4">
                    Temukan Properti Impian Anda
                </h1>

                <p class="text-gray-200 text-base md:text-lg">
                    Platform terpercaya untuk menemukan rumah, tanah, dan properti terbaik
                    dengan proses aman dan transparan.
                </p>

            </div>

        </div>

    @endif

</section>



{{-- CTA IKLAN / PASANG BANNER --}}
<section class="py-14 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        <div class="relative bg-gradient-to-r from-[#151541] to-indigo-700
                    rounded-3xl px-10 py-12 text-white shadow-xl overflow-hidden">

            {{-- Decorative Glow --}}
            <div class="absolute -top-10 -right-10 w-64 h-64 bg-indigo-400 opacity-20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-blue-400 opacity-20 rounded-full blur-3xl"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">

                <div class="max-w-xl">
                    <h2 class="text-2xl md:text-3xl font-bold font-inria mb-3">
                        Ingin Properti Anda Lebih Dilirik?
                    </h2>

                    <p class="text-gray-200 text-sm md:text-base">
                        Pasang banner promosi atau jadikan properti Anda sebagai
                        <span class="font-semibold text-white">Properti Unggulan</span>
                        agar tampil di halaman utama dan menjangkau lebih banyak calon pembeli.
                    </p>
                </div>

                @php
                    $pesan = urlencode("Halo Admin TuanTanah, saya ingin memasang banner atau menjadikan properti saya sebagai Properti Unggulan. Mohon informasi lebih lanjut.");
                @endphp

                <a href="https://wa.me/6281234567890?text={{ $pesan }}"
                   target="_blank"
                   class="inline-flex items-center gap-3 bg-green-500 hover:bg-green-600
                          px-6 py-3 rounded-xl text-white font-semibold text-sm
                          shadow-md hover:shadow-xl transition duration-300 whitespace-nowrap">

                    {{-- Icon WhatsApp --}}
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 32 32"
                         class="w-5 h-5 fill-white">
                        <path d="M16 .396C7.164.396 0 7.56 0 16.396c0 2.89.756 5.714 2.188 8.2L.24 31.76l7.343-1.92A15.932 15.932 0 0016 32c8.836 0 16-7.164 16-16.004C32 7.56 24.836.396 16 .396zm0 29.25a13.17 13.17 0 01-6.704-1.842l-.48-.285-4.355 1.137 1.16-4.245-.313-.5A13.123 13.123 0 012.83 16.396C2.83 8.964 8.568 3.226 16 3.226c7.432 0 13.17 5.738 13.17 13.17 0 7.432-5.738 13.17-13.17 13.17zm7.207-9.905c-.395-.198-2.336-1.152-2.698-1.282-.362-.13-.626-.198-.89.198-.263.395-1.02 1.282-1.25 1.547-.23.263-.46.296-.856.098-.395-.198-1.668-.615-3.177-1.962-1.174-1.047-1.966-2.34-2.196-2.736-.23-.395-.024-.608.174-.805.178-.177.395-.46.593-.69.198-.23.263-.395.395-.658.13-.263.065-.493-.033-.69-.098-.198-.89-2.14-1.217-2.93-.32-.77-.645-.666-.89-.678-.23-.01-.493-.013-.756-.013-.263 0-.69.098-1.052.493-.362.395-1.38 1.347-1.38 3.285 0 1.938 1.412 3.81 1.608 4.075.198.263 2.78 4.245 6.737 5.954.942.406 1.677.648 2.25.83.945.3 1.805.258 2.485.157.758-.113 2.336-.955 2.667-1.878.33-.923.33-1.715.23-1.878-.098-.165-.362-.263-.758-.46z"/>
                    </svg>

                    Hubungi Sekarang
                </a>

            </div>
        </div>

    </div>
</section>


{{-- PROPERTI UNGGULAN --}}
<section class="bg-gray-50 py-10">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold font-inria text-gray-800">
                Daftar Properti Unggulan
            </h2>

            <a href="{{ route('pelanggan.properti') }}"
               class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition">
                Lihat Semua →
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">

            @forelse($properti as $item)

                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 hover:-translate-y-1">

                    <div class="overflow-hidden">
                        <img src="{{ asset('storage/' . $item->foto_properti) }}"
                             class="w-full h-52 object-cover hover:scale-105 transition duration-300">
                    </div>

                    <div class="p-6 text-sm">

                        <h3 class="font-semibold text-lg text-gray-800 mb-1">
                            {{ $item->nama_properti }}
                        </h3>

                        <p class="text-gray-500 text-xs mb-1">
                            {{ $item->lokasi }}
                        </p>

                        <p class="text-gray-500 text-xs truncate">
                            {{ $item->fasilitas }}
                        </p>

                        <p class="font-bold text-indigo-600 text-base mt-4">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </p>

                        <div class="flex justify-end mt-5">
                            <a href="{{ route('pelanggan.detail', $item->properti_id) }}"
                               class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">
                                Lihat Detail →
                            </a>
                        </div>

                    </div>

                </div>

            @empty
                <p class="text-gray-500 text-sm col-span-3 text-center">
                    Belum ada properti unggulan.
                </p>
            @endforelse

        </div>

    </div>
</section>

@endsection
