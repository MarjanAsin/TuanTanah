@extends('layouts.pemilik')

@section('title', 'Upload Properti')

@section('content')

<div class="flex justify-center mb-20 px-4">

    <div class="w-full max-w-3xl">

        <h2 class="text-2xl font-semibold text-center mb-8 font-inria text-gray-800">
            Lengkapi form ini untuk mengupload properti
        </h2>

        {{-- INFO FREEMIUM --}}
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
                  id="formUpload"
                  enctype="multipart/form-data"
                  class="space-y-8">

                @csrf

                <div class="border-b border-gray-100 pb-8">

                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <x-hugeicons-home-01 class="w-5 h-5 text-indigo-600"/>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 font-inria">
                                Informasi Properti
                            </h3>

                            <p class="text-sm text-gray-500 font-inria">
                                Lengkapi informasi dasar properti Anda
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Nama Properti --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                                Nama Properti
                            </label>

                            <input
                                type="text"
                                name="nama_properti"
                                value="{{ old('nama_properti') }}"
                                placeholder="Contoh: Rumah Minimalis 2 Lantai di Yogyakarta"
                                class="w-full h-11 border border-gray-200 rounded-xl px-4 text-sm
                                    placeholder:text-gray-400
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    focus:border-indigo-500 transition font-inria">

                            @error('nama_properti')
                                <p class="text-red-500 text-xs mt-2 font-inria">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Tipe Properti --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                                Tipe Properti
                            </label>

                            <select
                                name="tipe_properti"
                                id="tipe_properti"
                                class="w-full h-11 border border-gray-200 rounded-xl px-4 text-sm
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    focus:border-indigo-500 transition cursor-pointer font-inria">

                                <option value="">Pilih tipe properti</option>

                                <option value="rumah"
                                    {{ old('tipe_properti') == 'rumah' ? 'selected' : '' }}>
                                    Rumah
                                </option>

                                <option value="tanah"
                                    {{ old('tipe_properti') == 'tanah' ? 'selected' : '' }}>
                                    Tanah
                                </option>

                                <option value="ruko"
                                    {{ old('tipe_properti') == 'ruko' ? 'selected' : '' }}>
                                    Ruko
                                </option>

                                <option value="apartemen"
                                    {{ old('tipe_properti') == 'apartemen' ? 'selected' : '' }}>
                                    Apartemen
                                </option>

                            </select>

                            @error('tipe_properti')
                                <p class="text-red-500 text-xs mt-2 font-inria">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Lokasi --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                                Lokasi
                            </label>

                            <input
                                type="text"
                                name="lokasi"
                                value="{{ old('lokasi') }}"
                                placeholder="Contoh: Jl. Malioboro No. 10, Yogyakarta"
                                class="w-full h-11 border border-gray-200 rounded-xl px-4 text-sm
                                    placeholder:text-gray-400
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    focus:border-indigo-500 transition font-inria">

                            @error('lokasi')
                                <p class="text-red-500 text-xs mt-2 font-inria">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Harga --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                                Harga
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-inria">
                                    Rp
                                </span>

                                <input
                                    type="text"
                                    name="harga"
                                    inputmode="numeric"
                                    maxlength="15"
                                    value="{{ old('harga') }}"
                                    placeholder="750000000"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    class="w-full h-11 border border-gray-200 rounded-xl pl-12 pr-4 text-sm
                                        placeholder:text-gray-400
                                        focus:outline-none focus:ring-2 focus:ring-indigo-500
                                        focus:border-indigo-500 transition font-inria">

                            </div>

                            @error('harga')
                                <p class="text-red-500 text-xs mt-2 font-inria">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                </div>

                <div class="border-b border-gray-100">

                    <div class="flex items-center gap-3 mb-6">

                        <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <x-hugeicons-building-02 class="w-5 h-5 text-indigo-600"/>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 font-inria">
                                Spesifikasi Properti
                            </h3>

                            <p class="text-sm text-gray-500 font-inria">
                                Informasi ukuran dan fasilitas utama properti
                            </p>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Luas Tanah --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                                Luas Tanah (m²)
                            </label>

                            <input
                                type="text"
                                inputmode="numeric"
                                name="luas_tanah"
                                value="{{ old('luas_tanah') }}"
                                placeholder="Contoh: 120"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                class="w-full h-11 border border-gray-200 rounded-xl px-4 text-sm
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    focus:border-indigo-500 transition font-inria">

                            @error('luas_tanah')
                                <p class="text-red-500 text-xs mt-2 font-inria">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Luas Bangunan --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                                Luas Bangunan (m²)
                            </label>

                            <input
                                type="text"
                                inputmode="numeric"
                                name="luas_bangunan"
                                id="luas_bangunan"
                                value="{{ old('luas_bangunan') }}"
                                placeholder="Contoh: 90"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                class="w-full h-11 border border-gray-200 rounded-xl px-4 text-sm
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    focus:border-indigo-500 transition font-inria">

                            <p class="text-xs text-gray-400 mt-1 hidden font-inria" id="lbInfo">
                                Tidak berlaku untuk tipe tanah
                            </p>

                            @error('luas_bangunan')
                                <p class="text-red-500 text-xs mt-2 font-inria">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Daya Listrik --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                                Daya Listrik (VA)
                            </label>

                            <input
                                type="text"
                                inputmode="numeric"
                                name="daya_listrik"
                                id="daya_listrik"
                                value="{{ old('daya_listrik') }}"
                                placeholder="Contoh: 2200"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                class="w-full h-11 border border-gray-200 rounded-xl px-4 text-sm
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    focus:border-indigo-500 transition font-inria">

                            <p class="text-xs text-gray-400 mt-1 hidden font-inria" id="listrikInfo">
                                Tidak berlaku untuk tipe tanah
                            </p>

                            @error('daya_listrik')
                                <p class="text-red-500 text-xs mt-2 font-inria">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Kamar Tidur --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                                Jumlah Kamar Tidur
                            </label>

                            <input
                                type="text"
                                inputmode="numeric"
                                name="jumlah_kamar"
                                id="kamar_tidur"
                                value="{{ old('jumlah_kamar') }}"
                                placeholder="Contoh: 3"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                class="w-full h-11 border border-gray-200 rounded-xl px-4 text-sm
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    focus:border-indigo-500 transition font-inria">

                            <p class="text-xs text-gray-400 mt-1 hidden font-inria" id="ktInfo">
                                Tidak berlaku untuk tipe tanah
                            </p>

                            @error('jumlah_kamar')
                                <p class="text-red-500 text-xs mt-2 font-inria">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Kamar Mandi --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                                Jumlah Kamar Mandi
                            </label>

                            <input
                                type="text"
                                inputmode="numeric"
                                name="kamar_mandi"
                                id="kamar_mandi"
                                value="{{ old('kamar_mandi') }}"
                                placeholder="Contoh: 2"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                class="w-full h-11 border border-gray-200 rounded-xl px-4 text-sm
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500
                                    focus:border-indigo-500 transition font-inria">

                            <p class="text-xs text-gray-400 mt-1 hidden font-inria" id="kmInfo">
                                Tidak berlaku untuk tipe tanah
                            </p>

                            @error('kamar_mandi')
                                <p class="text-red-500 text-xs mt-2 font-inria">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                </div>
                    
                <div class="border-b border-gray-100">

                    <div class="flex items-center gap-3 mb-6">

                        <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <x-hugeicons-home-11 class="w-5 h-5 text-indigo-600"/>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 font-inria">
                                Fasilitas
                            </h3>

                            <p class="text-sm text-gray-500 font-inria">
                                Pilih fasilitas yang tersedia pada properti
                            </p>
                        </div>

                    </div>

                    @php
                        $oldFasilitas = old('fasilitas', []);
                    @endphp

                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">

                        @include('components.fasilitas-checkbox', compact('oldFasilitas'))

                    </div>

                    @error('fasilitas')
                        <p class="text-red-500 text-xs mt-3 font-inria">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="border-b border-gray-100">

                    <div class="flex items-center gap-3 mb-6">

                        <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <x-hugeicons-image-upload class="w-5 h-5 text-indigo-600"/>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 font-inria">
                                Foto Properti
                            </h3>

                            <p class="text-sm text-gray-500 font-inria">
                                Unggah foto terbaik agar properti lebih menarik
                            </p>
                        </div>

                    </div>

                    <input
                        type="file"
                        name="foto_properti[]"
                        id="foto_properti"
                        accept=".jpg,.jpeg,.png"
                        multiple
                        class="hidden"
                        onchange="
                            let files = Array.from(this.files);
                            let text = files.length
                                ? files.length + ' foto dipilih'
                                : 'Belum ada foto dipilih';

                            document.getElementById('namaFotoProperti').innerText = text;
                        "
                    >

                    <label
                        for="foto_properti"
                        class="flex flex-col items-center justify-center
                            border-2 border-dashed border-indigo-200
                            rounded-2xl p-10
                            bg-indigo-50/40
                            hover:bg-indigo-50
                            cursor-pointer transition">

                        <x-hugeicons-image-upload
                            class="w-12 h-12 text-indigo-600 mb-3"/>

                        <p class="font-semibold text-gray-700 font-inria">
                            Klik untuk memilih foto
                        </p>

                        <p class="text-sm text-gray-500 mt-1 font-inria">
                            JPG, JPEG, PNG
                        </p>

                        <span
                            id="namaFotoProperti"
                            class="mt-4 text-xs text-indigo-600 font-medium font-inria">
                            Belum ada foto dipilih
                        </span>

                    </label>

                    <div
                        class="mt-5 bg-gray-50 border border-gray-100 rounded-xl p-4">

                        <p class="text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Ketentuan Upload
                        </p>

                        <ul class="space-y-1 text-xs text-gray-500 font-inria">

                            <li>• Format gambar JPG, JPEG, atau PNG</li>
                            <li>• Maksimal ukuran 5MB per foto</li>
                            <li>• Maksimal upload 5 foto</li>
                            <li>• Resolusi disarankan 1200 × 800 px</li>
                            <li>• Gunakan foto yang jelas dan terang</li>

                        </ul>

                    </div>

                    @error('foto_properti')
                        <p class="text-red-500 text-xs mt-3 font-inria">
                            {{ $message }}
                        </p>
                    @enderror

                    @error('foto_properti.*')
                        <p class="text-red-500 text-xs mt-3 font-inria">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div class="border-b border-gray-100">

                    <div class="flex items-center gap-3 mb-6">

                        <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <x-hugeicons-note-01 class="w-5 h-5 text-indigo-600"/>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 font-inria">
                                Deskripsi Properti
                            </h3>

                            <p class="text-sm text-gray-500 font-inria">
                                Jelaskan keunggulan dan informasi tambahan mengenai properti
                            </p>
                        </div>

                    </div>

                    <textarea
                        name="deskripsi"
                        rows="6"
                        maxlength="3000"
                        placeholder="Contoh: Dekat sekolah, Dekat pasar, Akses jalan 2 mobil, Sertifikat SHM, Lingkungan aman dan nyaman"
                        class="w-full border border-gray-200 rounded-2xl px-4 py-4 text-sm
                            placeholder:text-gray-400
                            focus:outline-none focus:ring-2 focus:ring-indigo-500
                            focus:border-indigo-500 transition resize-none font-inria">{{ old('deskripsi') }}</textarea>

                    <div class="mt-3 bg-gray-50 border border-gray-100 rounded-xl p-4">

                        <p class="text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Tips Menulis Deskripsi
                        </p>

                        <ul class="space-y-1 text-xs text-gray-500 font-inria">
                            <li>• Pisahkan setiap poin menggunakan tanda koma (,)</li>
                            <li>• Cantumkan akses jalan, sertifikat, dan lingkungan sekitar</li>
                            <li>• Jelaskan keunggulan utama properti</li>
                            <li>• Hindari informasi yang tidak relevan</li>
                        </ul>

                    </div>

                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-3 font-inria">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div class="flex justify-between items-center">

                    <p class="text-sm text-gray-500 font-inria">
                        Pastikan semua data sudah benar sebelum diunggah.
                    </p>

                    <button
                        type="submit"
                        id="btnUpload"
                        class="inline-flex items-center gap-2
                            px-8 py-3
                            bg-indigo-600 hover:bg-indigo-700
                            text-white font-semibold rounded-xl
                            shadow-md hover:shadow-lg
                            transition duration-300
                            cursor-pointer font-inria">

                        <x-hugeicons-upload-01 class="w-5 h-5"/>

                        Upload Properti

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ELEMENT
    const form = document.getElementById('formUpload');
    const btn = document.getElementById('btnUpload');

    const tipe = document.querySelector('[name="tipe_properti"]');

    const input = document.querySelector('input[name="foto_properti[]"]');
    const namaFoto = document.getElementById('namaFotoProperti');

    let filesArray = [];


    // SUBMIT BUTTON
    if (form && btn) {
        form.addEventListener('submit', function () {
            btn.disabled = true;
            btn.innerText = 'Sedang mengunggah...';
            btn.classList.add('opacity-70', 'cursor-not-allowed');
        });
    }


    // TIPE TANAH
    function togglePropertyFields() {

    const isTanah = tipe.value === 'tanah';

    const fields = [
        {
            input: document.getElementById('luas_bangunan'),
            info: document.getElementById('lbInfo')
        },
        {
            input: document.getElementById('daya_listrik'),
            info: document.getElementById('listrikInfo')
        },
        {
            input: document.getElementById('kamar_tidur'),
            info: document.getElementById('ktInfo')
        },
        {
            input: document.getElementById('kamar_mandi'),
            info: document.getElementById('kmInfo')
        }
    ];

    fields.forEach(field => {

        if (isTanah) {

            field.input.value = '';
            field.input.disabled = true;

            field.input.classList.add(
                'bg-gray-100',
                'cursor-not-allowed'
            );

            field.info.classList.remove('hidden');

        } else {

            field.input.disabled = false;

            field.input.classList.remove(
                'bg-gray-100',
                'cursor-not-allowed'
            );

            field.info.classList.add('hidden');
        }
    });
}

tipe.addEventListener('change', togglePropertyFields);
togglePropertyFields();


    // FOTO MULTI UPLOAD
    if (input) {
        input.addEventListener('change', function(e) {

            const newFiles = Array.from(e.target.files);

            // limit max 5
            if (filesArray.length + newFiles.length > 5) {
                alert('Maksimal 5 foto');
                input.value = '';
                return;
            }

            filesArray = filesArray.concat(newFiles);

            const dataTransfer = new DataTransfer();
            filesArray.forEach(file => dataTransfer.items.add(file));

            input.files = dataTransfer.files;

            if (namaFoto) {
                let names = filesArray.map(f => f.name).join(', ');
                namaFoto.innerText = names;
            }
        });
    }

});
</script>
