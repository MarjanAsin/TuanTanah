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
        <form method="POST"
            action="{{ route('pemilik.store') }}"
            enctype="multipart/form-data"
            class="space-y-6">

            @csrf

            <div class="grid grid-cols-2 gap-8">
                <div>
                    <label class="text-sm">Nama Properti</label>
                    <input type="text" name="nama_properti"
                        class="w-full border px-3 py-2 text-sm mt-1 bg-white">
                </div>

                <div>
                    <label class="text-sm">Fasilitas</label>
                    <input type="text" name="fasilitas"
                        class="w-full border px-3 py-2 text-sm mt-1 bg-white">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8">
                <div>
                    <label class="text-sm">Foto Properti</label>
                    <input type="file" name="foto_properti"
                        class="w-full border px-3 py-2 text-sm mt-1 bg-white">
                </div>

                <div>
                    <label class="text-sm">Lokasi</label>
                    <input type="text" name="lokasi"
                        class="w-full border px-3 py-2 text-sm mt-1 bg-white">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8">
                <div>
                    <label class="text-sm">Harga</label>
                    <input type="number" name="harga"
                        class="w-full border px-3 py-2 text-sm mt-1 bg-white">
                </div>

                <div>
                    <label class="text-sm">Nomor WhatsApp</label>
                    <input type="text" name="kontak_whatsapp"
                        class="w-full border px-3 py-2 text-sm mt-1 bg-white">
                </div>
            </div>

            <div>
                <label class="text-sm">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                    class="w-full border px-3 py-2 text-sm mt-1 bg-white"></textarea>
            </div>

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
