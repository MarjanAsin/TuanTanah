@extends('layouts.pemilik')

@section('title', 'Ubah Data')

@section('content')

<div class="mb-20 max-w-5xl mx-auto px-4">

    {{-- BACK --}}
    <a href="{{ url()->previous() ?: route('pemilik.beranda') }}"
       class="inline-flex items-center gap-2 mb-6 px-5 py-2.5
              bg-white border border-gray-200 rounded-full shadow-sm
              text-sm text-gray-700
              hover:bg-indigo-600 hover:text-white transition">
        < Kembali
    </a>

    <h2 class="text-2xl font-semibold text-center mb-8 text-gray-800">
        Ubah Data Properti
    </h2>

    <form method="POST"
          action="{{ route('pemilik.update', $properti->properti_id) }}"
          enctype="multipart/form-data"
          id="formEdit">

        @csrf
        @method('PUT')

        {{-- ================= FOTO ================= --}}
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm mb-10 max-w-4xl mx-auto">

            <label class="block text-sm font-semibold text-gray-700 mb-3 text-center">
                Foto Properti
            </label>

            <div class="mb-5 p-3 rounded-xl bg-yellow-50 text-yellow-700 text-xs text-center">
                ⚠️ Upload foto baru akan menghapus semua foto lama
            </div>

            <div class="flex justify-center">

            <div id="previewContainer"
                class="flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth px-6 pb-4 max-w-3xl">

                @foreach($properti->fotos as $foto)
                    <div class="snap-center flex-shrink-0">
                        <img src="{{ asset('storage/' . $foto->path) }}"
                            class="h-56 w-96 object-cover rounded-2xl shadow-md">
                    </div>
                @endforeach

            </div>

        </div>

            {{-- INPUT --}}
            <input type="file"
                name="foto_properti[]"
                id="fotoInput"
                multiple
                class="hidden"
                accept="image/*">

            <button type="button"
                onclick="document.getElementById('fotoInput').click()"
                class="mt-4 w-full bg-indigo-600 hover:bg-indigo-700
                    text-white py-3 rounded-xl text-sm font-semibold shadow cursor-pointer">
                Ganti Foto
            </button>

        </div>

        {{-- ================= FORM ================= --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-sm">

                <div>
                    <label class="font-semibold">Nama Properti</label>
                    <input type="text" name="nama_properti"
                        value="{{ old('nama_properti', $properti->nama_properti) }}"
                        class="w-full h-11 border rounded-lg px-4">
                </div>

                <div>
                    <label class="font-semibold">Lokasi</label>
                    <input type="text" name="lokasi"
                        value="{{ old('lokasi', $properti->lokasi) }}"
                        class="w-full h-11 border rounded-lg px-4">
                </div>

                <div>
                    <label class="font-semibold">Tipe Properti</label>
                    <select name="tipe_properti" id="tipe"
                        class="w-full h-11 border rounded-lg px-4 cursor-pointer">
                        <option value="">Pilih tipe</option>
                        <option value="rumah" {{ old('tipe_properti', $properti->tipe_properti)=='rumah' ? 'selected' : '' }}>Rumah</option>
                        <option value="tanah" {{ old('tipe_properti', $properti->tipe_properti)=='tanah' ? 'selected' : '' }}>Tanah</option>
                        <option value="ruko" {{ old('tipe_properti', $properti->tipe_properti)=='ruko' ? 'selected' : '' }}>Ruko</option>
                        <option value="apartemen" {{ old('tipe_properti', $properti->tipe_properti)=='apartemen' ? 'selected' : '' }}>Apartemen</option>
                    </select>
                </div>

                {{-- KAMAR --}}
                <div>
                    <label class="font-semibold">Jumlah Kamar</label>
                    <input type="number" name="jumlah_kamar" id="kamar"
                        value="{{ old('jumlah_kamar', $properti->jumlah_kamar) }}"
                        class="w-full h-11 border rounded-lg px-4">
                    <p id="kamarInfo" class="text-xs text-gray-400 mt-1 hidden">
                        Tidak berlaku untuk tipe tanah
                    </p>
                </div>

                <div>
                    <label class="font-semibold">Luas Tanah</label>
                    <input type="number" name="luas_tanah"
                        value="{{ old('luas_tanah', $properti->luas_tanah) }}"
                        class="w-full h-11 border rounded-lg px-4">
                </div>

                <div>
                    <label class="font-semibold">Harga</label>
                    <input type="number" name="harga"
                        value="{{ old('harga', (int) $properti->harga) }}"
                        class="w-full h-11 border rounded-lg px-4">
                </div>

                <div class="md:col-span-2">
                    <label class="font-semibold">Fasilitas</label>
                    <input type="text" name="fasilitas"
                        value="{{ old('fasilitas', $properti->fasilitas) }}"
                        class="w-full h-11 border rounded-lg px-4">
                </div>

                <div class="md:col-span-2">
                    <label class="font-semibold">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full border rounded-lg px-4 py-3">{{ old('deskripsi', $properti->deskripsi) }}</textarea>
                </div>

                {{-- WHATSAPP --}}
                <div class="md:col-span-2">
                    <label class="font-semibold">WhatsApp</label>
                    <input type="text" name="kontak_whatsapp" id="wa"
                        value="{{ old('kontak_whatsapp', $properti->kontak_whatsapp) }}"
                        class="w-full h-11 border rounded-lg px-4">
                    <p id="waError" class="text-red-500 text-xs mt-1 hidden">
                        Nomor harus 11 - 15 digit angka
                    </p>
                </div>

            </div>

            <button type="submit" id="btnSubmit"
                disabled
                class="mt-6 w-full bg-gray-300 cursor-not-allowed
                       text-white py-3 rounded-xl font-semibold transition cursor-not-allowed">
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('formEdit');
    const btn = document.getElementById('btnSubmit');

    const tipe = document.getElementById('tipe');
    const kamar = document.getElementById('kamar');
    const kamarInfo = document.getElementById('kamarInfo');

    const wa = document.getElementById('wa');
    const waError = document.getElementById('waError');

    const input = document.getElementById('fotoInput');
    const preview = document.getElementById('previewContainer');


    // ================= GET DATA CLEAN =================
    function getFormData() {
        const data = {};

        form.querySelectorAll('input, textarea, select').forEach(el => {

            if (el.type === 'file') {
                data[el.name] = el.files.length;
            } else {
                data[el.name] = (el.value || '').trim();
            }

        });

        return JSON.stringify(data);
    }

    const initialData = getFormData();


    // ================= CHANGE DETECT =================
    function isChanged() {
        return getFormData() !== initialData;
    }


    // ================= UPDATE BUTTON =================
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


    // ================= SUBMIT =================
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


    // ================= FOTO PREVIEW =================
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


    // ================= TIPE TANAH =================
    function toggleKamar() {
        if (tipe.value === 'tanah') {
            kamar.value = '';
            kamar.disabled = true;

            kamar.classList.add('bg-gray-100','cursor-not-allowed');
            kamarInfo.classList.remove('hidden');
        } else {
            kamar.disabled = false;

            kamar.classList.remove('bg-gray-100','cursor-not-allowed');
            kamarInfo.classList.add('hidden');
        }
    }

    tipe.addEventListener('change', toggleKamar);
    toggleKamar();


    // ================= WA VALIDATION =================
    wa.addEventListener('input', function () {

        this.value = this.value.replace(/[^0-9]/g, '').slice(0,15);

        if (this.value.length > 0 && this.value.length < 11) {
            waError.classList.remove('hidden');
            this.classList.add('border-red-500');
        } else {
            waError.classList.add('hidden');
            this.classList.remove('border-red-500');
        }
    });

});
</script>
