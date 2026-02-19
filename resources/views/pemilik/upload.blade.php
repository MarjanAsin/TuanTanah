@extends('layouts.pemilik')

@section('title', 'Upload Properti')

@section('content')

<div class="flex justify-center mb-20 px-4">

    <div class="w-full max-w-3xl">

        {{-- Judul --}}
        <h2 class="text-2xl font-semibold text-center mb-12 font-inria text-gray-800">
            Lengkapi form ini untuk mengupload properti
        </h2>

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
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Properti
                        </label>
                        <input type="text" name="nama_properti"
                            value="{{ old('nama_properti') }}"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">

                        @error('nama_properti')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Fasilitas
                        </label>
                        <input type="text" name="fasilitas"
                            value="{{ old('fasilitas') }}"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">

                        @error('fasilitas')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                {{-- ROW 2 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    {{-- FOTO PROPERTI --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Foto Properti
                        </label>

                        <input type="file"
                               name="foto_properti"
                               id="foto_properti"
                               accept="image/*"
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

                        @error('foto_properti')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- LOKASI --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Lokasi
                        </label>
                        <input type="text" name="lokasi"
                            value="{{ old('lokasi') }}"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">

                        @error('lokasi')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                {{-- ROW 3 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Harga
                        </label>
                        <input type="number" name="harga"
                            value="{{ old('harga') }}"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">

                        @error('harga')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nomor WhatsApp
                        </label>

                        <input type="text"
                            name="kontak_whatsapp"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            maxlength="15"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                            value="{{ old('kontak_whatsapp') }}">

                        @error('kontak_whatsapp')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                {{-- DESKRIPSI --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm
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
                               transition duration-300 cursor-pointer">
                        Upload Properti
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection
