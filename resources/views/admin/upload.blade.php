@extends('layouts.admin')

@section('title', 'Upload Banner')

@section('content')

<div class="max-w-4xl mx-auto mt-12 mb-20">

    <h2 class="text-center text-base font-semibold mb-10 font-inria">
        Lengkapi form ini untuk mengupload Banner
    </h2>

    <form method="POST"
          action="{{ route('admin.banner.store') }}"
          enctype="multipart/form-data"
          class="space-y-8">

        @csrf

        <div class="grid grid-cols-3 gap-8 items-end">

            {{-- FOTO BANNER --}}
            <div>
                <label class="block text-xs mb-2">Foto Banner</label>
                <input type="file"
                       name="gambar_banner"
                       class="w-full border border-gray-400 px-3 py-2 bg-white text-xs">

                @error('gambar_banner')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- DIMULAI --}}
            <div>
                <label class="block text-xs mb-2">Dimulai</label>
                <input type="date"
                       name="tanggal_mulai"
                       class="w-full border border-gray-400 px-3 py-2 bg-white text-xs">

                @error('tanggal_mulai')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- BERAKHIR --}}
            <div>
                <label class="block text-xs mb-2">Berakhir</label>
                <input type="date"
                       name="tanggal_selesai"
                       class="w-full border border-gray-400 px-3 py-2 bg-white text-xs">

                @error('tanggal_selesai')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="pt-6">
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 text-xs hover:bg-indigo-700 transition">
                Upload Banner
            </button>
        </div>

    </form>

</div>

@endsection
