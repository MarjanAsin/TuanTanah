@extends('layouts.pelanggan')

@section('title', 'Kontak')

@section('content')

<div class="bg-gray-200 py-12">

    <div class="max-w-7xl mx-auto px-6">

        {{-- JUDUL --}}
        <h2 class="text-2xl font-semibold font-inria text-center mb-10">
            Informasi kontak kami
        </h2>

        {{-- BOX INFORMASI --}}
        <div class="grid md:grid-cols-4 gap-6 mb-16">

            <div class="bg-[#151541] text-white rounded-md p-6 text-center">
                <h3 class="font-semibold mb-2">Nomor Telpon</h3>
                <p class="text-sm">+62 812-3456-7890</p>
            </div>

            <div class="bg-[#151541] text-white rounded-md p-6 text-center">
                <h3 class="font-semibold mb-2">Email</h3>
                <p class="text-sm">info@tuantanah.com</p>
            </div>

            <div class="bg-[#151541] text-white rounded-md p-6 text-center">
                <h3 class="font-semibold mb-2">Alamat</h3>
                <p class="text-sm">
                    Jl. Kaliurang KM 12 No. 34, Sleman, Yogyakarta 56789
                </p>
            </div>

            <div class="bg-[#151541] text-white rounded-md p-6 text-center">
                <h3 class="font-semibold mb-2">Jam Operasional</h3>
                <p class="text-sm">Senin – Sabtu, 09.00 – 17.00 WIB</p>
            </div>

        </div>



        {{-- FORM & KONTAK CEPAT --}}
        <div class="grid md:grid-cols-2 gap-16">

            {{-- FORM KONTAK --}}
            <div>
                <h3 class="text-lg font-semibold font-inria mb-2">
                    Ada Pertanyaan? Hubungi Kami
                </h3>
                <p class="text-sm text-gray-600 mb-6">
                    Isi form di bawah ini dan kami akan merespon dalam waktu singkat.
                </p>

                <form class="space-y-4">

                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" placeholder="Nama Lengkap"
                               class="border border-gray-300 rounded-md px-3 py-2 text-sm w-full">
                        <input type="email" placeholder="Email"
                               class="border border-gray-300 rounded-md px-3 py-2 text-sm w-full">
                    </div>

                    <input type="text" placeholder="Nomor Telpon"
                           class="border border-gray-300 rounded-md px-3 py-2 text-sm w-full">

                    <input type="text" placeholder="Subjek"
                           class="border border-gray-300 rounded-md px-3 py-2 text-sm w-full">

                    <textarea rows="4" placeholder="Tulis pesan anda disini..."
                              class="border border-gray-300 rounded-md px-3 py-2 text-sm w-full"></textarea>

                    <button type="submit"
                            class="bg-[#151541] text-white px-4 py-2 rounded-md text-sm w-full hover:opacity-90 transition">
                        Kirim Pesan
                    </button>

                </form>
            </div>



            {{-- KONTAK CEPAT --}}
            <div>
                <h3 class="text-lg font-semibold font-inria mb-6">
                    Kontak Cepat
                </h3>

                <a href="https://wa.me/6281234567890"
                target="_blank"
                class="flex items-center justify-center gap-2 bg-green-500 text-white py-3 rounded-md text-sm font-semibold hover:bg-green-600 transition">

                    {{-- Icon WhatsApp --}}
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 0 32 32" 
                        class="w-5 h-5 fill-white">
                        <path d="M16 .396C7.164.396 0 7.56 0 16.396c0 2.89.756 5.714 2.188 8.2L.24 31.76l7.343-1.92A15.932 15.932 0 0016 32c8.836 0 16-7.164 16-16.004C32 7.56 24.836.396 16 .396zm0 29.25a13.17 13.17 0 01-6.704-1.842l-.48-.285-4.355 1.137 1.16-4.245-.313-.5A13.123 13.123 0 012.83 16.396C2.83 8.964 8.568 3.226 16 3.226c7.432 0 13.17 5.738 13.17 13.17 0 7.432-5.738 13.17-13.17 13.17zm7.207-9.905c-.395-.198-2.336-1.152-2.698-1.282-.362-.13-.626-.198-.89.198-.263.395-1.02 1.282-1.25 1.547-.23.263-.46.296-.856.098-.395-.198-1.668-.615-3.177-1.962-1.174-1.047-1.966-2.34-2.196-2.736-.23-.395-.024-.608.174-.805.178-.177.395-.46.593-.69.198-.23.263-.395.395-.658.13-.263.065-.493-.033-.69-.098-.198-.89-2.14-1.217-2.93-.32-.77-.645-.666-.89-.678-.23-.01-.493-.013-.756-.013-.263 0-.69.098-1.052.493-.362.395-1.38 1.347-1.38 3.285 0 1.938 1.412 3.81 1.608 4.075.198.263 2.78 4.245 6.737 5.954.942.406 1.677.648 2.25.83.945.3 1.805.258 2.485.157.758-.113 2.336-.955 2.667-1.878.33-.923.33-1.715.23-1.878-.098-.165-.362-.263-.758-.46z"/>
                    </svg>

                    Chat WhatsApp
                </a>

            </div>

        </div>

    </div>

</div>

@endsection
