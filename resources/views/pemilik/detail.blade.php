@extends('layouts.pemilik')

@section('title', 'Detail Pembayaran')

@section('content')

<div class="max-w-xl mx-auto mb-20 px-4">

    {{-- Tombol Kembali --}}
    <a href="{{ route('pemilik.pembayaran') }}"
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

    <h2 class="text-2xl font-semibold text-center mb-4 text-gray-800">
        Detail Pembayaran
    </h2>

    <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">

        {{-- Informasi --}}
        <div class="space-y-3 text-sm">

            <div>
                <p class="text-gray-500">Properti</p>
                <p class="font-semibold text-gray-800">
                    {{ $properti->nama_properti }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Biaya Upload</p>
                <p class="text-indigo-600 font-bold text-lg">
                    Rp 50.000
                </p>
            </div>

            <div>
                <p class="text-gray-500">Transfer ke</p>
                <p class="font-medium text-gray-800">
                    BCA 123456789 <br>
                    a.n TuanTanah
                </p>
            </div>

        </div>

        {{-- Form Upload --}}
        <form method="POST"
              action="{{ route('pemilik.upload.bukti', $properti->properti_id) }}"
              enctype="multipart/form-data"
              class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2 my-4">
                    Upload Bukti Transfer
                </label>

                {{-- Hidden input --}}
                <input type="file"
                       name="bukti_pembayaran"
                       id="buktiInput"
                       class="hidden"
                       onchange="document.getElementById('namaBukti').innerText = this.files[0]?.name || 'Belum ada file dipilih'">

                {{-- Custom field --}}
                <label for="buktiInput"
                       class="flex items-center h-[44px] border rounded-lg px-4
                              cursor-pointer transition
                              {{ $errors->has('bukti_pembayaran')
                                  ? 'border-red-400 bg-red-50'
                                  : 'border-gray-200 bg-gray-50 hover:bg-gray-100' }}">

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

                    <span id="namaBukti"
                          class="text-sm text-gray-500 truncate">
                        Belum ada file dipilih
                    </span>

                </label>

                {{-- ERROR MESSAGE --}}
                <div class="h-4 mt-1">
                    @error('bukti_pembayaran')
                        <p class="text-red-500 text-xs">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700
                           text-white py-3 rounded-xl text-sm font-semibold
                           shadow-md hover:shadow-lg transition duration-300 cursor-pointer">
                Kirim Bukti
            </button>

        </form>

    </div>

</div>

@endsection
