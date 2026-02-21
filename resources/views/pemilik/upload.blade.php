@extends('layouts.pemilik')

@section('title', 'Upload Properti')

@section('content')

<div class="flex justify-center mb-20 px-4">

    <div class="w-full max-w-3xl">

        {{-- Judul --}}
        <h2 class="text-2xl font-semibold text-center mb-8 font-inria text-gray-800">
            Lengkapi form ini untuk mengupload properti
        </h2>

        {{-- ================= INFO FREEMIUM MODERN ================= --}}
        <div class="mb-10 relative overflow-hidden rounded-2xl
                    bg-gradient-to-r from-indigo-600 via-indigo-700 to-indigo-800
                    text-white p-6 shadow-xl">

            <div class="absolute -top-12 -right-12 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>

            <div class="relative">

                <span class="inline-block text-xs uppercase tracking-widest
                             bg-white/20 px-3 py-1 rounded-full mb-3 font-semibold">
                    Freemium
                </span>

                <h3 class="text-lg font-semibold mb-1 font-inria">
                    Upload Pertama Gratis
                </h3>

                <p class="text-sm text-indigo-100 leading-relaxed font-inria">
                    Properti pertama Anda dapat diupload tanpa biaya.
                    Untuk upload berikutnya akan mengikuti kebijakan biaya platform.
                </p>

            </div>
        </div>


        {{-- Card Form --}}
        <div class="bg-white rounded-2xl shadow-sm p-8">

            <form method="POST"
                  action="{{ route('pemilik.store') }}"
                  enctype="multipart/form-data"
                  class="space-y-8">

                @csrf

                {{-- ROW 1 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Nama Properti
                        </label>
                        <input type="text" name="nama_properti"
                            value="{{ old('nama_properti') }}"
                            placeholder="Contoh: Rumah Minimalis 2 Lantai di Yogyakarta"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                   placeholder:text-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                        @error('nama_properti')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Fasilitas
                        </label>
                        <input type="text" name="fasilitas"
                            value="{{ old('fasilitas') }}"
                            placeholder="Contoh: 3 Kamar Tidur, 2 Kamar Mandi, Garasi"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                   placeholder:text-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                        @error('fasilitas')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                {{-- ROW 2 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Foto Properti
                        </label>

                        <input type="file"
                               name="foto_properti"
                               id="foto_properti"
                               accept=".jpg,.jpeg,.png,.webp"
                               class="hidden"
                               onchange="document.getElementById('namaFotoProperti').innerText = this.files[0]?.name || 'Belum ada file dipilih'">

                        <label for="foto_properti"
                               class="flex items-center h-[42px] border border-gray-200 rounded-lg bg-gray-50 px-4
                                      cursor-pointer hover:bg-gray-100 transition">

                            <svg class="w-4 h-4 text-gray-400 mr-2"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M7 3h6l5 5v13a1 1 0 01-1 1H7a1 1 0 01-1-1V4a1 1 0 011-1z"/>
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M13 3v5h5"/>
                            </svg>

                            <span id="namaFotoProperti"
                                  class="text-sm text-gray-500 truncate">
                                Belum ada file dipilih
                            </span>

                        </label>

                        <p class="text-xs text-gray-500 mt-2">
                            Format: JPG, PNG, WEBP • Maks. 5MB • Disarankan 1200×800 px
                        </p>

                        @error('foto_properti')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Lokasi
                        </label>
                        <input type="text" name="lokasi"
                            value="{{ old('lokasi') }}"
                            placeholder="Contoh: Jl. ZA Pagar Alam, Yogyakarta"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                   placeholder:text-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                        @error('lokasi')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                {{-- ROW 3 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Harga
                        </label>
                        <input type="number" name="harga"
                            value="{{ old('harga') }}"
                            placeholder="Contoh: 750000000"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                   placeholder:text-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                        <p class="text-xs text-gray-500 mt-1">
                            Masukkan tanpa titik atau koma
                        </p>
                        @error('harga')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Nomor WhatsApp
                        </label>
                        <input type="text"
                            name="kontak_whatsapp"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            maxlength="15"
                            placeholder="Contoh: 081234567890"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                    placeholder:text-gray-400
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                            value="{{ old('kontak_whatsapp') }}">
                        <p class="text-xs text-gray-500 mt-1">
                            Gunakan format 08xxxxxxxxxx
                        </p>
                        @error('kontak_whatsapp')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                {{-- DESKRIPSI --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" rows="4"
                        placeholder="Jelaskan detail properti seperti luas tanah, kondisi bangunan, akses jalan, lingkungan sekitar, dll."
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm
                               placeholder:text-gray-400
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700
                               text-white py-3 rounded-xl text-sm font-semibold
                               shadow-md hover:shadow-lg
                               transition duration-300 cursor-pointer font-inria">
                        Upload Properti
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection
