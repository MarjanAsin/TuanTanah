@extends('layouts.pemilik')

@section('title', 'Ubah Data')

@section('content')

<div class="mb-20 max-w-6xl mx-auto px-4">

    {{-- Tombol Kembali --}}
    <a href="{{ url()->previous() ?: route('pemilik.beranda') }}"
       class="inline-flex items-center gap-2 mb-8 px-5 py-2.5
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

    <h2 class="text-2xl font-semibold text-center mb-12 font-inria text-gray-800">
        Ubah Data Properti
    </h2>

    <form method="POST"
          action="{{ route('pemilik.update', $properti->properti_id) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-14">

            {{-- ======================
                KIRI (Preview Foto)
            ======================= --}}
            <div>

                <div class="overflow-hidden rounded-2xl shadow-md mb-6">
                    <img id="previewImage"
                         src="{{ asset('storage/' . $properti->foto_properti) }}"
                         class="w-full h-80 object-cover">
                </div>

                <input type="file"
                       name="foto_properti"
                       id="fotoInput"
                       class="hidden"
                       accept="image/*">

                <button type="button"
                        onclick="document.getElementById('fotoInput').click()"
                        class="bg-indigo-600 hover:bg-indigo-700
                               text-white px-6 py-2.5 rounded-xl
                               text-sm font-semibold shadow-md
                               hover:shadow-lg transition cursor-pointer">
                    Ubah Foto
                </button>

            </div>


            {{-- ======================
                KANAN (Form Field)
            ======================= --}}
            <div class="space-y-6 text-sm">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Properti
                    </label>
                    <input type="text" name="nama_properti"
                           value="{{ $properti->nama_properti }}"
                           class="w-full h-[44px] border border-gray-300 rounded-lg px-4
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Lokasi
                    </label>
                    <input type="text" name="lokasi"
                           value="{{ $properti->lokasi }}"
                           class="w-full h-[44px] border border-gray-300 rounded-lg px-4
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Fasilitas
                    </label>
                    <input type="text" name="fasilitas"
                           value="{{ $properti->fasilitas }}"
                           class="w-full h-[44px] border border-gray-300 rounded-lg px-4
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Harga
                    </label>
                    <input type="number" name="harga"
                           value="{{ $properti->harga }}"
                           class="w-full h-[44px] border border-gray-300 rounded-lg px-4
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" rows="4"
                              class="w-full border border-gray-300 rounded-lg px-4 py-3
                                     focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ $properti->deskripsi }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nomor WhatsApp
                    </label>
                    <input type="text" name="kontak_whatsapp"
                           value="{{ $properti->kontak_whatsapp }}"
                           class="w-full h-[44px] border border-gray-300 rounded-lg px-4
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                </div>

                <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700
                               text-white py-3 rounded-xl text-sm font-semibold
                               shadow-md hover:shadow-lg transition duration-300 cursor-pointer">
                    Simpan Perubahan
                </button>

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
    if (event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
});
</script>
