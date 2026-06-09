@extends('layouts.pemilik')

@section('title', 'Ubah Data')

@section('content')

<div class="mb-20 max-w-5xl mx-auto px-4">

    <a href="{{ url()->previous() }}"
        class="inline-flex items-center gap-2 mb-8 px-5 py-2.5
                bg-white border border-gray-200 rounded-full shadow-sm
                text-sm font-medium text-gray-700
                hover:bg-indigo-600 hover:text-white hover:shadow-md
                transition duration-300 font-inria">

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

    <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800 font-inria">
        Ubah Data Properti
    </h2>

    {{-- STATUS --}}
    <div class="flex justify-center mb-4">

        @if($properti->status == 'ditolak')

            <span class="bg-red-100 text-red-600 text-sm px-4 py-2 rounded-full font-semibold font-inria">
                Properti Ditolak
            </span>

        @elseif($properti->status == 'menunggu')

            <span class="bg-yellow-100 text-yellow-700 text-sm px-4 py-2 rounded-full font-semibold font-inria">
                Menunggu Verifikasi Admin
            </span>

        @elseif($properti->status == 'disetujui')

            <span class="bg-green-100 text-green-700 text-sm px-4 py-2 rounded-full font-semibold font-inria">
                Properti Disetujui
            </span>

        @endif

    </div>

    @if($properti->status == 'ditolak' && $properti->alasan_penolakan)

        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">

            <p class="text-sm font-semibold text-red-600 mb-2 font-inria">
                Alasan Penolakan
            </p>

            <p class="text-sm text-red-700 font-inria">
                {{ $properti->alasan_penolakan }}
            </p>

            <p class="text-xs text-red-500 mt-3 font-inria">
                Silakan perbaiki data properti sesuai alasan di atas, kemudian simpan perubahan untuk mengajukan verifikasi ulang.
            </p>

        </div>

    @else

        <div class="mb-6 p-4 rounded-xl bg-yellow-50 border border-yellow-200">

            <p class="text-sm text-yellow-700 text-center font-inria">
                Jika Anda mengubah data properti, properti akan ditinjau ulang oleh admin sebelum ditampilkan kembali.
            </p>

        </div>

    @endif

    <form method="POST"
          action="{{ route('pemilik.update', $properti->properti_id) }}"
          enctype="multipart/form-data"
          id="formEdit">

        @csrf
        @method('PUT')

        <form id="formEdit">

            {{-- INFORMASI PROPERTI --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                        <x-hugeicons-home-01 class="w-5 h-5 text-indigo-600"/>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 font-inria">
                            Informasi Properti
                        </h3>

                        <p class="text-sm text-gray-500 font-inria">
                            Perbarui informasi dasar properti Anda
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
                            value="{{ old('nama_properti', $properti->nama_properti) }}"
                            placeholder="Contoh: Rumah Minimalis 2 Lantai di Yogyakarta"
                            class="w-full h-11 border border-gray-200 rounded-xl px-4 text-sm
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
                            id="tipe"
                            class="w-full h-11 border border-gray-200 rounded-xl px-4 text-sm
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500 transition cursor-pointer font-inria">

                            <option value="">Pilih tipe properti</option>

                            <option value="rumah"
                                {{ old('tipe_properti', $properti->tipe_properti) == 'rumah' ? 'selected' : '' }}>
                                Rumah
                            </option>

                            <option value="tanah"
                                {{ old('tipe_properti', $properti->tipe_properti) == 'tanah' ? 'selected' : '' }}>
                                Tanah
                            </option>

                            <option value="ruko"
                                {{ old('tipe_properti', $properti->tipe_properti) == 'ruko' ? 'selected' : '' }}>
                                Ruko
                            </option>

                            <option value="apartemen"
                                {{ old('tipe_properti', $properti->tipe_properti) == 'apartemen' ? 'selected' : '' }}>
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
                            value="{{ old('lokasi', $properti->lokasi) }}"
                            placeholder="Contoh: Jl. Malioboro No. 10, Yogyakarta"
                            class="w-full h-11 border border-gray-200 rounded-xl px-4 text-sm
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
                                value="{{ old('harga', (int) $properti->harga) }}"
                                placeholder="750000000"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                class="w-full h-11 border border-gray-200 rounded-xl
                                    pl-12 pr-4 text-sm
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

            {{-- SPESIFIKASI PROPERTI --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8 mt-6">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                        <x-hugeicons-building-02 class="w-5 h-5 text-indigo-600"/>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 font-inria">
                            Spesifikasi Properti
                        </h3>

                        <p class="text-sm text-gray-500 font-inria">
                            Perbarui informasi ukuran dan spesifikasi properti
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
                            value="{{ old('luas_tanah', $properti->luas_tanah) }}"
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
                            value="{{ old('luas_bangunan', $properti->luas_bangunan) }}"
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
                            value="{{ old('jumlah_kamar', $properti->jumlah_kamar) }}"
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
                            value="{{ old('kamar_mandi', $properti->kamar_mandi) }}"
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
                            value="{{ old('daya_listrik', $properti->daya_listrik) }}"
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

                </div>

            </div>

            {{-- FASILITAS --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8 mt-6">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                        <x-hugeicons-home-11 class="w-5 h-5 text-indigo-600"/>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 font-inria">
                            Fasilitas
                        </h3>

                        <p class="text-sm text-gray-500 font-inria">
                            Perbarui fasilitas yang tersedia pada properti
                        </p>
                    </div>

                </div>

                @php
                    $oldFasilitas = old(
                        'fasilitas',
                        $properti->fasilitas
                            ? array_map('trim', explode(',', $properti->fasilitas))
                            : []
                    );
                @endphp

                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-5">

                    @include('components.fasilitas-checkbox', compact('oldFasilitas'))

                </div>

                @error('fasilitas')
                    <p class="text-red-500 text-xs mt-3 font-inria">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- DESKRIPSI --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8 mt-6">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                        <x-hugeicons-note-01 class="w-5 h-5 text-indigo-600"/>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 font-inria">
                            Deskripsi Properti
                        </h3>

                        <p class="text-sm text-gray-500 font-inria">
                            Perbarui informasi dan keunggulan properti Anda
                        </p>
                    </div>

                </div>

                <textarea
                    name="deskripsi"
                    rows="6"
                    maxlength="3000"
                    placeholder="Contoh: Dekat sekolah, Dekat pasar, Akses jalan 2 mobil, Air PDAM, SHM, Bebas banjir"
                    class="w-full border border-gray-200 rounded-2xl px-4 py-4 text-sm
                        focus:outline-none focus:ring-2 focus:ring-indigo-500
                        focus:border-indigo-500 transition resize-none font-inria">{{ old('deskripsi', $properti->deskripsi) }}</textarea>

                <div class="mt-4 bg-gray-50 border border-gray-100 rounded-2xl p-4">

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

            {{-- FOTO --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8 mt-6">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                        <x-hugeicons-image-upload class="w-5 h-5 text-indigo-600"/>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 font-inria">
                            Foto Properti
                        </h3>

                        <p class="text-sm text-gray-500 font-inria">
                            Kelola foto yang ditampilkan pada properti
                        </p>
                    </div>

                </div>

                {{-- ALERT --}}
                <div class="mb-6 p-4 rounded-2xl bg-amber-50 border border-amber-200">

                    <p class="text-sm font-medium text-amber-700 font-inria">
                        Upload foto baru akan menghapus seluruh foto lama.
                    </p>

                    <p class="text-xs text-amber-600 mt-1 font-inria">
                        Pilih semua foto yang ingin digunakan sekaligus.
                    </p>

                </div>

                {{-- FOTO LAMA --}}
                <div class="mb-6">

                    <p class="text-sm font-semibold text-gray-700 mb-3 font-inria">
                        Foto Saat Ini
                    </p>

                    <div id="previewContainer"
                        class="flex gap-4 overflow-x-auto snap-x snap-mandatory pb-2">

                        @foreach($properti->fotos as $index => $foto)

                            <div class="snap-center flex-shrink-0 relative">

                                <img loading="lazy"
                                    src="{{ asset('storage/' . $foto->path) }}"
                                    class="h-56 w-96 object-cover rounded-2xl shadow-md">

                                <div class="absolute top-3 left-3
                                            bg-black/70 text-white
                                            text-xs px-2 py-1 rounded-lg font-inria">
                                    {{ $index + 1 }}
                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

                {{-- INPUT FOTO --}}
                <input
                    type="file"
                    name="foto_properti[]"
                    id="fotoInput"
                    multiple
                    accept="image/*"
                    class="hidden">

                <label
                    for="fotoInput"
                    class="flex flex-col items-center justify-center
                        border-2 border-dashed border-indigo-200
                        rounded-2xl p-8
                        bg-indigo-50/40
                        hover:bg-indigo-50
                        cursor-pointer transition">

                    <x-hugeicons-image-upload
                        class="w-12 h-12 text-indigo-600 mb-3"/>

                    <p class="font-semibold text-gray-700 font-inria">
                        Klik untuk memilih foto baru
                    </p>

                    <p class="text-sm text-gray-500 mt-1 font-inria">
                        JPG, JPEG, PNG • Maksimal 5 Foto
                    </p>

                </label>

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

                {{-- KETENTUAN --}}
                <div class="mt-5 bg-gray-50 rounded-2xl border border-gray-100 p-4">

                    <p class="text-sm font-semibold text-gray-700 mb-2 font-inria">
                        Ketentuan Upload
                    </p>

                    <ul class="space-y-1 text-xs text-gray-500 font-inria">
                        <li>• Format gambar JPG, JPEG, PNG</li>
                        <li>• Maksimal ukuran 5MB per foto</li>
                        <li>• Maksimal 5 foto</li>
                        <li>• Upload baru akan menggantikan seluruh foto lama</li>
                    </ul>

                </div>

            </div>

            {{-- SUBMIT --}}
            <div class="pt-8 border-t border-gray-100 mt-8">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div>

                        <p class="text-sm font-medium text-gray-700 font-inria">
                            Simpan Perubahan
                        </p>

                        <p class="text-xs text-gray-500 font-inria">
                            Perubahan akan dikirim untuk proses verifikasi ulang oleh admin.
                        </p>

                    </div>

                    <button
                        type="submit"
                        id="btnSubmit"
                        disabled
                        class="inline-flex items-center justify-center gap-2
                            px-8 py-3
                            bg-gray-300 cursor-not-allowed
                            text-white font-semibold
                            rounded-xl
                            transition duration-300
                            font-inria">

                        <x-hugeicons-edit-02 class="w-5 h-5"/>

                        Simpan Perubahan

                    </button>

                </div>

            </div>

        </form>

</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('formEdit');
    const btn = document.getElementById('btnSubmit');

    const tipe = document.getElementById('tipe');

    const input = document.getElementById('fotoInput');
    const preview = document.getElementById('previewContainer');


    // GET DATA CLEAN
    function getFormData() {
        const data = {};

        form.querySelectorAll('input, textarea, select').forEach(el => {

            if (el.type === 'file') {

                data[el.name] = el.files.length;

            } else if (el.type === 'checkbox') {

                if (!data[el.name]) {
                    data[el.name] = [];
                }

                if (el.checked) {
                    data[el.name].push(el.value);
                }

            } else {

                data[el.name] = (el.value || '').trim();

            }

        });

        return JSON.stringify(data);
    }

    const initialData = getFormData();


    // CHANGE DETECT
    function isChanged() {
        return getFormData() !== initialData;
    }


    // UPDATE BUTTON
    function updateBtn() {
        if (isChanged()) {
            btn.disabled = false;

            btn.classList.remove('bg-gray-300','cursor-not-allowed');
            btn.classList.add('bg-indigo-600','hover:bg-indigo-700','cursor-pointer');

        } else {
            btn.disabled = true;

            btn.classList.add('bg-gray-300','cursor-not-allowed');
            btn.classList.remove('bg-indigo-600','hover:bg-indigo-700','cursor-pointer');
        }
    }

    form.addEventListener('input', updateBtn);
    form.addEventListener('change', updateBtn);


    // SUBMIT
    form.addEventListener('submit', function (e) {

        if (!isChanged()) {
            e.preventDefault();
            return;
        }

        btn.innerText = "Menyimpan perubahan...";
        btn.disabled = true;

        btn.classList.add('bg-gray-400','cursor-not-allowed');
        btn.classList.remove('bg-indigo-600','hover:bg-indigo-700','cursor-pointer');
    });


    // FOTO PREVIEW
    if (input && preview) {
        input.addEventListener('change', function () {

            const files = Array.from(this.files);
            if (files.length === 0) return;

            preview.innerHTML = '';

            files.forEach((file, index) => {

                if (!file.type.startsWith('image/')) return;

                const reader = new FileReader();

                reader.onload = function (e) {

                    const wrapper = document.createElement('div');
                    wrapper.className = "snap-center flex-shrink-0 relative";

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = "h-56 w-96 object-cover rounded-2xl shadow-md";

                    const badge = document.createElement('div');
                    badge.innerText = index + 1;
                    badge.className = "absolute top-2 left-2 bg-black/60 text-white text-xs px-2 py-1 rounded";

                    wrapper.appendChild(img);
                    wrapper.appendChild(badge);

                    preview.appendChild(wrapper);
                };

                reader.readAsDataURL(file);
            });
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

});
</script>
