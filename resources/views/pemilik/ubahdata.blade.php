@extends('layouts.pemilik')

@section('title', 'Ubah Data')

@section('content')

<div class="mt-10 mb-16">

    <h2 class="text-xl font-semibold text-center mb-10 font-inria">
        Ubah data properti
    </h2>

    <form method="POST" action="{{ route('pemilik.update', $properti->properti_id) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-12">

            {{-- KIRI --}}
            <div>

                {{-- Preview Foto --}}
                <img id="previewImage"
                    src="{{ asset('storage/' . $properti->foto_properti) }}"
                    class="w-full h-64 object-cover mb-6">

                {{-- Input File Hidden --}}
                <input type="file"
                    name="foto_properti"
                    id="fotoInput"
                    class="hidden"
                    accept="image/*">

                {{-- Tombol Ubah Foto --}}
                <button type="button"
                    onclick="document.getElementById('fotoInput').click()"
                    class="bg-indigo-600 text-white px-5 py-2 text-sm">
                    Ubah Foto
                </button>

            </div>



            {{-- KANAN --}}
            <div>

                <form method="POST"
                    action="{{ route('pemilik.update', $properti->properti_id) }}"
                    enctype="multipart/form-data">


                    @csrf
                    @method('PUT')

                    <div class="space-y-5 text-sm">

                        <div class="grid grid-cols-3 items-center gap-4">
                            <label>Nama Properti</label>
                            <input type="text" name="nama_properti"
                                value="{{ $properti->nama_properti }}"
                                class="col-span-2 border px-3 py-2">
                        </div>

                        <div class="grid grid-cols-3 items-center gap-4">
                            <label>Lokasi</label>
                            <input type="text" name="lokasi"
                                value="{{ $properti->lokasi }}"
                                class="col-span-2 border px-3 py-2">
                        </div>

                        <div class="grid grid-cols-3 items-center gap-4">
                            <label>Fasilitas</label>
                            <input type="text" name="fasilitas"
                                value="{{ $properti->fasilitas }}"
                                class="col-span-2 border px-3 py-2">
                        </div>

                        <div class="grid grid-cols-3 items-center gap-4">
                            <label>Harga</label>
                            <input type="number" name="harga"
                                value="{{ $properti->harga }}"
                                class="col-span-2 border px-3 py-2">
                        </div>

                        <div class="grid grid-cols-3 items-start gap-4">
                            <label class="pt-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="4"
                                    class="col-span-2 border px-3 py-2">{{ $properti->deskripsi }}</textarea>
                        </div>

                        <div class="grid grid-cols-3 items-center gap-4">
                            <label>Nomor WhatsApp</label>
                            <input type="text" name="kontak_whatsapp"
                                value="{{ $properti->kontak_whatsapp }}"
                                class="col-span-2 border px-3 py-2">
                        </div>

                        {{-- TOMBOL SIMPAN PERUBAHAN --}}
                        <div class="grid grid-cols-3 gap-4 pt-4">
                            <div></div>
                            <button type="submit"
                                class="col-span-2 bg-indigo-600 text-white py-2 text-sm hover:bg-indigo-700 transition">
                                Simpan Perubahan
                            </button>
                        </div>

                    </div>

                </form>

            </div>


        </div>

    </form>

</div>

@endsection

<script>
document.getElementById('fotoInput').addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('previewImage').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
});
</script>

