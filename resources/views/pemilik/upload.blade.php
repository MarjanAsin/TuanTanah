@extends('layouts.pemilik')

@section('title', 'Upload Properti')

@section('content')

<div class="flex justify-center mt-12 mb-16">

    <div class="w-full max-w-3xl">

        {{-- Judul --}}
        <h2 class="text-xl font-semibold text-center mb-10 font-inria">
            Lengkapi form ini untuk mengupload properti
        </h2>

        {{-- Form --}}
        <form class="space-y-6">

            {{-- Baris 1 --}}
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <label class="text-sm">Nama Properti</label>
                    <input type="text"
                        class="w-full border border-gray-400 px-3 py-2 text-sm mt-1 bg-white">
                </div>

                <div>
                    <label class="text-sm">Fasilitas</label>
                    <input type="text"
                        class="w-full border border-gray-400 px-3 py-2 text-sm mt-1 bg-white">
                </div>
            </div>

            {{-- Baris 2 --}}
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <label class="text-sm">Foto Properti</label>
                    <input type="file"
                        class="w-full border border-gray-400 px-3 py-2 text-sm mt-1 bg-white">
                </div>

                <div>
                    <label class="text-sm">Lokasi</label>
                    <input type="text"
                        class="w-full border border-gray-400 px-3 py-2 text-sm mt-1 bg-white">
                </div>
            </div>

            {{-- Baris 3 --}}
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <label class="text-sm">Harga</label>
                    <input type="text"
                        class="w-full border border-gray-400 px-3 py-2 text-sm mt-1 bg-white">
                </div>

                <div>
                    <label class="text-sm">Nomor WhatsApp</label>
                    <input type="text"
                        class="w-full border border-gray-400 px-3 py-2 text-sm mt-1 bg-white">
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="text-sm">Deskripsi</label>
                <textarea rows="4"
                    class="w-full border border-gray-400 px-3 py-2 text-sm mt-1 bg-white"></textarea>
            </div>

            {{-- Tombol --}}
            <div class="pt-2">
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-sm text-sm font-semibold hover:bg-indigo-700 transition">
                    Upload Properti
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
