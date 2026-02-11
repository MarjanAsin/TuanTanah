@extends('layouts.pelanggan')

@section('title', 'Detail Properti')

@section('content')

<div class="max-w-6xl mx-auto mt-10 mb-16">

    <div class="grid grid-cols-2 gap-14">

        {{-- KIRI --}}
        <div>
            <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994"
                 class="w-full h-72 object-cover mb-3">

            <p class="text-xs text-right text-gray-600 mb-6">
                Diposting pada 12.12.2025
            </p>

            <a href="https://wa.me/6281234567890"
            target="_blank"
            class="w-full flex items-center justify-center gap-2 bg-green-600 text-white py-2 text-sm hover:bg-green-700 transition">

                {{-- Icon WhatsApp --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 32 32"
                    class="w-5 h-5 fill-white">
                    <path d="M16 .396C7.164.396 0 7.56 0 16.396c0 2.89.756 5.714 2.188 8.2L.24 31.76l7.343-1.92A15.932 15.932 0 0016 32c8.836 0 16-7.164 16-16.004C32 7.56 24.836.396 16 .396zm0 29.25a13.17 13.17 0 01-6.704-1.842l-.48-.285-4.355 1.137 1.16-4.245-.313-.5A13.123 13.123 0 012.83 16.396C2.83 8.964 8.568 3.226 16 3.226c7.432 0 13.17 5.738 13.17 13.17 0 7.432-5.738 13.17-13.17 13.17zm7.207-9.905c-.395-.198-2.336-1.152-2.698-1.282-.362-.13-.626-.198-.89.198-.263.395-1.02 1.282-1.25 1.547-.23.263-.46.296-.856.098-.395-.198-1.668-.615-3.177-1.962-1.174-1.047-1.966-2.34-2.196-2.736-.23-.395-.024-.608.174-.805.178-.177.395-.46.593-.69.198-.23.263-.395.395-.658.13-.263.065-.493-.033-.69-.098-.198-.89-2.14-1.217-2.93-.32-.77-.645-.666-.89-.678-.23-.01-.493-.013-.756-.013-.263 0-.69.098-1.052.493-.362.395-1.38 1.347-1.38 3.285 0 1.938 1.412 3.81 1.608 4.075.198.263 2.78 4.245 6.737 5.954.942.406 1.677.648 2.25.83.945.3 1.805.258 2.485.157.758-.113 2.336-.955 2.667-1.878.33-.923.33-1.715.23-1.878-.098-.165-.362-.263-.758-.46z"/>
                </svg>

                Hubungi Pemilik Properti
            </a>

        </div>



        {{-- KANAN --}}
        <div class="space-y-4 text-sm">

            <h3 class="text-base font-semibold mb-2">Rumah</h3>

            <div class="bg-gray-100 p-4 border border-gray-300">
                <p class="font-semibold mb-1">Lokasi</p>
                <p>Sleman, Yogyakarta</p>
            </div>

            <div class="bg-gray-100 p-4 border border-gray-300">
                <p class="font-semibold mb-1">Fasilitas</p>
                <p>
                    6 Kamar Tidur &nbsp;&nbsp;
                    3 Kamar Mandi &nbsp;&nbsp;
                    Ukuran Rumah 1.000m²
                </p>
            </div>

            <div class="bg-gray-100 p-4 border border-gray-300">
                <p class="font-semibold mb-1">Harga</p>
                <p>Rp 2.000.000.000</p>
            </div>

            <div class="bg-gray-100 p-4 border border-gray-300">
                <p class="font-semibold mb-1">Deskripsi</p>
                <p>
                    Rumah ini dibangun dekat dengan universitas dan dekat dengan kota Yogyakarta, 
                    bangunan ini memiliki lokasi yang strategis, serta bebas dari banjir.
                </p>
            </div>

        </div>

    </div>

</div>

@endsection
