@extends('layouts.pelanggan')

@section('title', $properti->nama_properti)

@section('content')

<div class="max-w-6xl mx-auto mt-4 mb-20 px-4">

    {{-- BACK BUTTON --}}
    <a href="{{ url()->previous() ?: route('pelanggan.beranda') }}"
       class="inline-flex items-center gap-2 mb-6 sm:mb-8 px-5 py-2.5
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


    {{-- GRID RESPONSIVE --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-14">

        {{-- ================= LEFT SIDE ================= --}}
        <div>

            {{-- FOTO --}}
            <div class="mb-4">

                @if(str_contains($properti->foto_properti, ','))
                    {{-- MULTI FOTO (SLIDER) --}}
                    <div class="relative overflow-hidden rounded-2xl shadow-md">

                        <div id="slider" class="flex transition-transform duration-500">

                            @foreach(explode(',', $properti->foto_properti) as $foto)
                                <img src="{{ asset('storage/' . trim($foto)) }}"
                                    class="w-full h-64 sm:h-80 object-cover flex-shrink-0">
                            @endforeach

                        </div>

                        {{-- BUTTON --}}
                        <button onclick="prevSlide()"
                            class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/70 px-2 py-1 rounded">
                            ‹
                        </button>

                        <button onclick="nextSlide()"
                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/70 px-2 py-1 rounded">
                            ›
                        </button>

                    </div>

                @else
                    {{-- SINGLE FOTO --}}
                    <img src="{{ asset('storage/' . $properti->foto_properti) }}"
                        class="w-full h-64 sm:h-80 object-cover rounded-2xl shadow-md">
                @endif

            </div>

            {{-- TANGGAL --}}
            <p class="text-xs text-right text-gray-500 mb-6 font-inria">
                Diposting {{ $properti->created_at->diffForHumans() }}
            </p>

            {{-- WHATSAPP BUTTON --}}
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $properti->kontak_whatsapp) }}"
               target="_blank"
               class="w-full flex items-center justify-center gap-3
                      bg-green-600 hover:bg-green-700
                      active:scale-95
                      text-white py-3.5 sm:py-4
                      rounded-2xl
                      text-sm sm:text-base font-semibold
                      shadow-lg hover:shadow-xl
                      transition duration-300 font-inria">

                {{-- Icon WhatsApp --}}
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 32 32"
                        class="w-5 h-5 fill-white">
                        <path d="M16 .396C7.164.396 0 7.56 0 16.396c0 2.89.756 5.714 2.188 8.2L.24 31.76l7.343-1.92A15.932 15.932 0 0016 32c8.836 0 16-7.164 16-16.004C32 7.56 24.836.396 16 .396zm0 29.25a13.17 13.17 0 01-6.704-1.842l-.48-.285-4.355 1.137 1.16-4.245-.313-.5A13.123 13.123 0 012.83 16.396C2.83 8.964 8.568 3.226 16 3.226c7.432 0 13.17 5.738 13.17 13.17 0 7.432-5.738 13.17-13.17 13.17zm7.207-9.905c-.395-.198-2.336-1.152-2.698-1.282-.362-.13-.626-.198-.89.198-.263.395-1.02 1.282-1.25 1.547-.23.263-.46.296-.856.098-.395-.198-1.668-.615-3.177-1.962-1.174-1.047-1.966-2.34-2.196-2.736-.23-.395-.024-.608.174-.805.178-.177.395-.46.593-.69.198-.23.263-.395.395-.658.13-.263.065-.493-.033-.69-.098-.198-.89-2.14-1.217-2.93-.32-.77-.645-.666-.89-.678-.23-.01-.493-.013-.756-.013-.263 0-.69.098-1.052.493-.362.395-1.38 1.347-1.38 3.285 0 1.938 1.412 3.81 1.608 4.075.198.263 2.78 4.245 6.737 5.954.942.406 1.677.648 2.25.83.945.3 1.805.258 2.485.157.758-.113 2.336-.955 2.667-1.878.33-.923.33-1.715.23-1.878-.098-.165-.362-.263-.758-.46z"/>
                    </svg>

                Hubungi Pemilik Properti
            </a>

        </div>


        {{-- ================= RIGHT SIDE ================= --}}
        <div class="space-y-6 text-sm">

            {{-- NAMA + HARGA (DIGABUNG) --}}
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-500
                        text-white p-6 rounded-2xl shadow-lg">

                <h3 class="text-xl font-semibold font-inria mb-2">
                    {{ $properti->nama_properti }}
                </h3>

                <p class="text-sm opacity-80 mb-2">
                    {{ $properti->lokasi }}
                </p>

                <p class="text-2xl font-bold">
                    Rp {{ number_format($properti->harga, 0, ',', '.') }}
                </p>
            </div>

            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                <p class="font-semibold text-gray-700 mb-3 font-inria">
                    Informasi Properti
                </p>

                <div class="grid grid-cols-2 gap-4 text-sm">

                    <div>
                        <p class="text-gray-400">Tipe</p>
                        <p class="font-semibold text-gray-700">
                            {{ $properti->tipe_properti ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-400">Luas Tanah</p>
                        <p class="font-semibold text-gray-700">
                            {{ $properti->luas_tanah ?? '-' }} m²
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-400">Kamar</p>
                        <p class="font-semibold text-gray-700">
                            {{ $properti->jumlah_kamar ?? '-' }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- FASILITAS --}}
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                <p class="font-semibold text-gray-700 mb-3 font-inria">
                    Fasilitas
                </p>

                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $properti->fasilitas) as $item)
                        @if(trim($item) !== '')
                            <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full">
                                {{ trim($item) }}
                            </span>
                        @endif
                    @endforeach
                </div>
            </div>


            {{-- DESKRIPSI --}}
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                <p class="font-semibold text-gray-700 mb-2 font-inria">
                    Deskripsi
                </p>

                <p class="text-gray-600  leading-tight break-words">{{ $properti->deskripsi }}</p>
            </div>

            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                <p class="font-semibold text-gray-700 mb-3 font-inria">
                    Lokasi di Peta
                </p>

                <iframe
                    src="https://www.google.com/maps?q={{ urlencode($properti->lokasi) }}&output=embed"
                    class="w-full h-64 rounded-xl border"
                    loading="lazy">
                </iframe>
            </div>

        </div>

            </div>

        </div>

@endsection

<script>
let index = 0;
const slider = document.getElementById('slider');

function showSlide(i) {
    if (!slider) return;
    const total = slider.children.length;
    index = (i + total) % total;
    slider.style.transform = `translateX(-${index * 100}%)`;
}

function nextSlide() {
    showSlide(index + 1);
}

function prevSlide() {
    showSlide(index - 1);
}
</script>
