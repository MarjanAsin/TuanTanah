@extends('layouts.pemilik')

@section('title', 'Ubah Data')

@section('content')

<div class="mb-20 max-w-6xl mx-auto px-4">

    {{-- Tombol Kembali --}}
    <a href="{{ url()->previous() ?: route('pemilik.beranda') }}"
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

    <h2 class="text-xl sm:text-2xl font-semibold text-center mb-8 sm:mb-12 font-inria text-gray-800">
        Ubah Data Properti
    </h2>

    <form method="POST"
          action="{{ route('pemilik.update', $properti->properti_id) }}"
          enctype="multipart/form-data"
          id="formEdit">

        @csrf
        @method('PUT')

        {{-- GRID RESPONSIVE --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14">

            {{-- ================= LEFT ================= --}}
            <div>

                <div class="overflow-hidden rounded-2xl shadow-md mb-6">
                    <img id="previewImage"
                         src="{{ asset('storage/' . $properti->foto_properti) }}"
                         class="w-full h-64 sm:h-80 object-cover">
                </div>

                <input type="file"
                       name="foto_properti"
                       id="fotoInput"
                       class="hidden"
                       accept="image/*">

                @error('foto_properti')
                    <p class="text-red-500 text-xs mb-4">
                        {{ $message }}
                    </p>
                @enderror

                <button type="button"
                        onclick="document.getElementById('fotoInput').click()"
                        class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700
                               text-white px-6 py-2.5 rounded-xl
                               text-sm font-semibold shadow-md
                               hover:shadow-lg transition cursor-pointer font-inria">
                    Ubah Foto
                </button>

            </div>

            {{-- ================= RIGHT ================= --}}
            <div class="space-y-5 sm:space-y-6 text-sm">

                {{-- Nama --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2 font-inria">
                        Nama Properti
                    </label>
                    <input type="text" name="nama_properti"
                           value="{{ old('nama_properti', $properti->nama_properti) }}"
                           class="w-full h-[44px] border border-gray-300 rounded-lg px-4
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">

                    @error('nama_properti')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2 font-inria">
                        Lokasi
                    </label>
                    <input type="text" name="lokasi"
                           value="{{ old('lokasi', $properti->lokasi) }}"
                           class="w-full h-[44px] border border-gray-300 rounded-lg px-4
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">

                    @error('lokasi')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Fasilitas --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2 font-inria">
                        Fasilitas
                    </label>
                    <input type="text" name="fasilitas"
                           value="{{ old('fasilitas', $properti->fasilitas) }}"
                           class="w-full h-[44px] border border-gray-300 rounded-lg px-4
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">

                    @error('fasilitas')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2 font-inria">
                        Harga
                    </label>
                    <input type="number" name="harga"
                           value="{{ old('harga', $properti->harga) }}"
                           class="w-full h-[44px] border border-gray-300 rounded-lg px-4
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">

                    @error('harga')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2 font-inria">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" rows="4"
                              class="w-full border border-gray-300 rounded-lg px-4 py-3
                                     focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('deskripsi', $properti->deskripsi) }}</textarea>

                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nomor WhatsApp --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2 font-inria">
                        Nomor WhatsApp
                    </label>
                    <input type="tel"
                           name="kontak_whatsapp"
                           maxlength="15"
                           value="{{ old('kontak_whatsapp', $properti->kontak_whatsapp) }}"
                           inputmode="numeric"
                           pattern="[0-9]*"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,15)"
                           class="w-full h-[44px] border border-gray-300 rounded-lg px-4
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">

                    @error('kontak_whatsapp')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Button --}}
                <button type="submit"
                        id="btnSubmit"
                        disabled
                        class="w-full bg-indigo-600 hover:bg-indigo-700
                               text-white py-3 rounded-xl text-sm font-semibold
                               shadow-md hover:shadow-lg transition duration-300
                               opacity-50 cursor-not-allowed font-inria">
                    Simpan Perubahan
                </button>

            </div>

        </div>

    </form>

</div>

@endsection
