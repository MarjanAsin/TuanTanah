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

    <h2 class="text-2xl font-semibold text-center mb-8 text-gray-800 font-inria">
        Ubah Data Properti
    </h2>
    <div class="mb-6 p-4 rounded-xl bg-yellow-50 border border-yellow-200 text-yellow-700 text-sm text-center font-inria">
        Jika Anda mengubah data properti, properti akan ditinjau ulang oleh admin sebelum ditampilkan kembali.
    </div>

    <form method="POST"
          action="{{ route('pemilik.update', $properti->properti_id) }}"
          enctype="multipart/form-data"
          id="formEdit">

        @csrf
        @method('PUT')

        {{-- FOTO --}}
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm mb-10 max-w-4xl mx-auto">

            <label class="block text-sm font-semibold text-gray-700 mb-3 text-center font-inria">
                Foto Properti
            </label>

            <div class="mb-5 p-3 rounded-xl bg-yellow-100 text-yellow-700 text-xs text-center font-inria">
                Upload foto baru akan menghapus semua foto lama
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

            <input type="file"
                name="foto_properti[]"
                id="fotoInput"
                multiple
                class="hidden"
                accept="image/*">

            <button type="button"
                onclick="document.getElementById('fotoInput').click()"
                class="mt-4 w-full bg-indigo-600 hover:bg-indigo-700
                    text-white py-3 rounded-xl text-sm font-semibold shadow cursor-pointer font-inria">
                Perbarui Foto
            </button>

        </div>

        {{-- FORM --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-sm">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">Nama Properti</label>
                    <input type="text" name="nama_properti" placeholder="Contoh: Rumah Minimalis 2 Lantai di Yogyakarta"
                        value="{{ old('nama_properti', $properti->nama_properti) }}"
                        class="w-full h-11 border border-gray-200 rounded-lg px-4 text-sm
                                focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">
                    @error('nama_properti')
                        <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">Lokasi</label>
                    <input type="text" name="lokasi" placeholder="Contoh: Jl. ZA Pagar Alam, Yogyakarta"
                        value="{{ old('lokasi', $properti->lokasi) }}"
                        class="w-full h-11 border border-gray-200 rounded-lg px-4 text-sm
                                focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">
                    @error('lokasi')
                        <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ROW 1 --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                        Tipe Properti
                    </label>

                    <select name="tipe_properti" id="tipe"
                        class="w-full h-11 border border-gray-200 rounded-lg px-4 text-sm
                            focus:outline-none focus:ring-2 focus:ring-indigo-500 transition cursor-pointer font-inria">

                        <option value="">Pilih tipe</option>

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
                        <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                        Luas Tanah (m²)
                    </label>

                    <input type="text"
                        inputmode="numeric"
                        name="luas_tanah"
                        value="{{ old('luas_tanah', $properti->luas_tanah) }}"
                        placeholder="Contoh: 120"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="w-full h-11 border border-gray-200 rounded-lg px-4 text-sm
                            focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">

                    @error('luas_tanah')
                        <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                        Luas Bangunan (m²)
                    </label>

                    <input type="text"
                        inputmode="numeric"
                        name="luas_bangunan"
                        id="luas_bangunan"
                        value="{{ old('luas_bangunan', $properti->luas_bangunan) }}"
                        placeholder="Contoh: 90"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="w-full h-11 border border-gray-200 rounded-lg px-4 text-sm
                            focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">

                    <p class="text-xs text-gray-400 mt-1 hidden font-inria" id="lbInfo">
                        Tidak berlaku untuk tipe tanah
                    </p>

                    @error('luas_bangunan')
                        <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                        Kamar Tidur
                    </label>

                    <input type="text"
                        inputmode="numeric"
                        name="jumlah_kamar"
                        id="kamar_tidur"
                        value="{{ old('jumlah_kamar', $properti->jumlah_kamar) }}"
                        placeholder="Contoh: 3"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="w-full h-11 border border-gray-200 rounded-lg px-4 text-sm
                            focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">

                    <p class="text-xs text-gray-400 mt-1 hidden font-inria" id="ktInfo">
                        Tidak berlaku untuk tipe tanah
                    </p>

                    @error('jumlah_kamar')
                        <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                        Kamar Mandi
                    </label>

                    <input type="text"
                        inputmode="numeric"
                        name="kamar_mandi"
                        id="kamar_mandi"
                        value="{{ old('kamar_mandi', $properti->kamar_mandi) }}"
                        placeholder="Contoh: 2"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="w-full h-11 border border-gray-200 rounded-lg px-4 text-sm
                            focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">

                    <p class="text-xs text-gray-400 mt-1 hidden font-inria" id="kmInfo">
                        Tidak berlaku untuk tipe tanah
                    </p>

                    @error('kamar_mandi')
                        <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                        Daya Listrik (VA)
                    </label>

                    <input type="text"
                        inputmode="numeric"
                        name="daya_listrik"
                        id="daya_listrik"
                        value="{{ old('daya_listrik', $properti->daya_listrik) }}"
                        placeholder="Contoh: 2200"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="w-full h-11 border border-gray-200 rounded-lg px-4 text-sm
                            focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">

                    <p class="text-xs text-gray-400 mt-1 hidden font-inria" id="listrikInfo">
                        Tidak berlaku untuk tipe tanah
                    </p>

                    @error('daya_listrik')
                        <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">Harga</label>
                    <input type="text"
                            name="harga"
                            inputmode="numeric"
                            maxlength="15"
                            value="{{ old('harga', (int) $properti->harga) }}"
                            placeholder="Contoh: 750000000"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="w-full h-11 border border-gray-200 rounded-lg px-4 text-sm
                                focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">
                    @error('harga')
                        <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                    @enderror
                </div>

                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-3 font-inria">
                        Fasilitas
                    </label>

                    @php
                        $oldFasilitas = old(
                            'fasilitas',
                            $properti->fasilitas
                                ? array_map('trim', explode(',', $properti->fasilitas))
                                : []
                        );
                    @endphp

                    <div class="grid grid-cols-2 gap-3 text-sm">

                        <label class="flex items-center gap-2 cursor-pointer font-inria">
                            <input type="checkbox" name="fasilitas[]" value="AC"
                                {{ in_array('AC', $oldFasilitas) ? 'checked' : '' }}>
                            AC
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer font-inria">
                            <input type="checkbox" name="fasilitas[]" value="WiFi"
                                {{ in_array('WiFi', $oldFasilitas) ? 'checked' : '' }}>
                            WiFi
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer font-inria">
                            <input type="checkbox" name="fasilitas[]" value="Garasi"
                                {{ in_array('Garasi', $oldFasilitas) ? 'checked' : '' }}>
                            Garasi
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer font-inria">
                            <input type="checkbox" name="fasilitas[]" value="Carport"
                                {{ in_array('Carport', $oldFasilitas) ? 'checked' : '' }}>
                            Carport
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer font-inria">
                            <input type="checkbox" name="fasilitas[]" value="CCTV"
                                {{ in_array('CCTV', $oldFasilitas) ? 'checked' : '' }}>
                            CCTV
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer font-inria">
                            <input type="checkbox" name="fasilitas[]" value="Kolam Renang"
                                {{ in_array('Kolam Renang', $oldFasilitas) ? 'checked' : '' }}>
                            Kolam Renang
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer font-inria">
                            <input type="checkbox" name="fasilitas[]" value="Taman"
                                {{ in_array('Taman', $oldFasilitas) ? 'checked' : '' }}>
                            Taman
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer font-inria">
                            <input type="checkbox" name="fasilitas[]" value="PDAM"
                                {{ in_array('PDAM', $oldFasilitas) ? 'checked' : '' }}>
                            PDAM
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer font-inria">
                            <input type="checkbox" name="fasilitas[]" value="Keamanan 24 Jam"
                                {{ in_array('Keamanan 24 Jam', $oldFasilitas) ? 'checked' : '' }}>
                            Keamanan 24 Jam
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer font-inria">
                            <input type="checkbox" name="fasilitas[]" value="Mushola"
                                {{ in_array('Mushola', $oldFasilitas) ? 'checked' : '' }}>
                            Mushola
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer font-inria">
                            <input type="checkbox" name="fasilitas[]" value="Balkon"
                                {{ in_array('Balkon', $oldFasilitas) ? 'checked' : '' }}>
                            Balkon
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer font-inria">
                            <input type="checkbox" name="fasilitas[]" value="Gudang"
                                {{ in_array('Gudang', $oldFasilitas) ? 'checked' : '' }}>
                            Gudang
                        </label>

                    </div>

                    @error('fasilitas')
                        <p class="text-red-500 text-xs mt-2 font-inria">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="4"
                        maxlength="3000"
                        placeholder="Contoh: Dekat sekolah, Dekat pasar, Akses jalan 2 mobil, Air PDAM, SHM, Bebas banjir"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm
                            focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">{{ old('deskripsi', $properti->deskripsi) }}</textarea>

                    <p class="text-xs text-gray-400 mt-2 font-inria">
                        Pisahkan setiap poin menggunakan tanda koma (,)
                    </p>

                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-2 font-inria">
                            {{ $message }}
                        </p>
                    @enderror

                </div>
            </div>

            <button type="submit" id="btnSubmit"
                disabled
                class="mt-6 w-full bg-gray-300 cursor-not-allowed
                       text-white py-3 rounded-xl font-semibold transition font-inria ">
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

    const wa = document.getElementById('wa');
    const waError = document.getElementById('waError');

    const input = document.getElementById('fotoInput');
    const preview = document.getElementById('previewContainer');


    // GET DATA CLEAN
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


    // WA VALIDATION
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
