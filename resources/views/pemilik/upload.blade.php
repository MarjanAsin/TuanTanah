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

                {{-- ROW 1 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Nama Properti
                        </label>
                        <input type="text" name="nama_properti"
                            value="{{ old('nama_properti') }}"
                            placeholder="Contoh: Rumah Minimalis 2 Lantai di Yogyakarta"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                   placeholder:text-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">
                        @error('nama_properti')
                            <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3 font-inria">
                            Fasilitas
                        </label>

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            @php
                                $oldFasilitas = old('fasilitas', []);
                            @endphp

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

                </div>


                {{-- ROW 2 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Foto Properti
                        </label>

                        <input type="file"
                               name="foto_properti[]"
                               id="foto_properti"
                               accept=".jpg,.jpeg,.png"
                               class="hidden"
                               onchange="
                                let names = Array.from(this.files).map(f => f.name).join(', ');
                                document.getElementById('namaFotoProperti').innerText = names || 'Belum ada file dipilih';
                                " multiple>

                        <label for="foto_properti"
                               class="flex items-center h-[42px] border border-gray-200 rounded-lg bg-gray-50 px-4
                                      cursor-pointer hover:bg-gray-100 transition">

                            <svg class="w-4 h-4 text-gray-400 mr-2"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M7 3h6l5 5v13a1 1 0 01-1 1H7a1 1 0 01-1-1V4a1 1 0 011-1z"/>
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M13 3v5h5"/>
                            </svg>

                            <span id="namaFotoProperti"
                                  class="text-sm text-gray-500 truncate font-inria">
                                Belum ada file dipilih
                            </span>

                        </label>

                        <div class="mt-2 text-xs text-gray-500 space-y-1">

                            <p class="font-bold text-gray-600 font-inria">Ketentuan Upload:</p>

                            <ul class="list-disc pl-4 space-y-0.5 font-inria">
                                <li>Format: JPG, PNG, JPEG</li>
                                <li>Maksimal ukuran: 5MB per file</li>
                                <li>Resolusi disarankan: 1200 × 800 px</li>
                                <li>Maksimal 5 foto</li>
                            </ul>

                        </div>

                        @error('foto_properti')
                            <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                        @enderror

                        @error('foto_properti.*')
                            <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Lokasi
                        </label>
                        <input type="text" name="lokasi"
                            value="{{ old('lokasi') }}"
                            placeholder="Contoh: Jl. ZA Pagar Alam, Yogyakarta"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                   placeholder:text-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">
                        @error('lokasi')
                            <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                {{-- ROW 3 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Harga
                        </label>
                        <input type="text"
                            name="harga"
                            inputmode="numeric"
                            maxlength="15"
                            value="{{ old('harga') }}"
                            placeholder="Contoh: 750000000"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                    placeholder:text-gray-400
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">
                        @error('harga')
                            <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- ROW 4 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Tipe Properti
                        </label>

                        <select name="tipe_properti"
                            id="tipe_properti"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                focus:outline-none focus:ring-2 focus:ring-indigo-500 transition cursor-pointer font-inria">

                            <option value="">Pilih tipe</option>
                            <option value="rumah" {{ old('tipe_properti') == 'rumah' ? 'selected' : '' }}>Rumah</option>
                            <option value="tanah" {{ old('tipe_properti') == 'tanah' ? 'selected' : '' }}>Tanah</option>
                            <option value="ruko" {{ old('tipe_properti') == 'ruko' ? 'selected' : '' }}>Ruko</option>
                            <option value="apartemen" {{ old('tipe_properti') == 'apartemen' ? 'selected' : '' }}>Apartemen</option>
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
                            value="{{ old('luas_tanah') }}"
                            placeholder="Contoh: 120"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">
                        @error('luas_tanah')
                            <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- ROW 5 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Luas Bangunan (m²)
                        </label>

                        <input type="text"
                            inputmode="numeric"
                            name="luas_bangunan"
                            id="luas_bangunan"
                            value="{{ old('luas_bangunan') }}"
                            placeholder="Contoh: 90"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
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
                            Daya Listrik (VA)
                        </label>

                        <input type="text"
                            inputmode="numeric"
                            name="daya_listrik"
                            id="daya_listrik"
                            value="{{ old('daya_listrik') }}"
                            placeholder="Contoh: 2200"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">

                        <p class="text-xs text-gray-400 mt-1 hidden font-inria" id="listrikInfo">
                            Tidak berlaku untuk tipe tanah
                        </p>
                        @error('daya_listrik')
                            <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- ROW 6 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                            Jumlah Kamar Tidur
                        </label>

                        <input type="text"
                            inputmode="numeric"
                            name="jumlah_kamar"
                            id="kamar_tidur"
                            value="{{ old('jumlah_kamar') }}"
                            placeholder="Contoh: 3"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
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
                            Jumlah Kamar Mandi
                        </label>

                        <input type="text"
                            inputmode="numeric"
                            name="kamar_mandi"
                            id="kamar_mandi"
                            value="{{ old('kamar_mandi') }}"
                            placeholder="Contoh: 2"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full h-[42px] border border-gray-200 rounded-lg px-4 text-sm
                                focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">

                        <p class="text-xs text-gray-400 mt-1 hidden font-inria" id="kmInfo">
                            Tidak berlaku untuk tipe tanah
                        </p>
                        @error('kamar_mandi')
                            <p class="text-red-500 text-xs mt-2 font-inria">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 font-inria">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="5"
                        maxlength="3000"
                        placeholder="Contoh: Dekat sekolah, Dekat pasar, Akses jalan 2 mobil, PDAM, SHM"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm
                            placeholder:text-gray-400
                            focus:outline-none focus:ring-2 focus:ring-indigo-500 transition font-inria">{{ old('deskripsi') }}</textarea>

                    <p class="text-xs text-gray-400 mt-2 font-inria">
                        Pisahkan setiap poin menggunakan tanda koma (,)
                    </p>

                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-2 font-inria">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" id="btnUpload"
                        class="w-full bg-indigo-600 hover:bg-indigo-700
                               text-white py-3 rounded-xl text-sm font-semibold
                               shadow-md hover:shadow-lg
                               transition duration-300 cursor-pointer font-inria">
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
