@extends('layouts.admin')

@section('title', 'Detail Pembayaran')

@section('content')

<div class="max-w-4xl mx-auto mt-6">

    {{-- BACK --}}
    <a href="{{ route('admin.pembayaran') }}"
       class="inline-flex items-center gap-2 mb-6 px-4 py-2
              bg-white border border-gray-200 rounded-full shadow-sm
              text-sm text-gray-700 hover:bg-indigo-600 hover:text-white transition">
        ← Kembali
    </a>

    <div class="grid md:grid-cols-2 gap-6">

        {{-- ================= LEFT (BUKTI) ================= --}}
        <div class="bg-white rounded-xl shadow-sm p-4">

            <p class="text-sm font-semibold mb-3 text-gray-800 font-inria">
                Bukti Pembayaran
            </p>

            <a href="{{ asset('storage/' . $properti->bukti_pembayaran) }}" target="_blank">
                <img src="{{ asset('storage/' . $properti->bukti_pembayaran) }}"
                     class="w-full h-72 object-contain rounded-lg border hover:opacity-90 transition">
            </a>

            <p class="text-xs text-gray-500 mt-2">
                Klik untuk memperbesar
            </p>

        </div>

        {{-- ================= RIGHT ================= --}}
        <div class="space-y-4">

            <div class="bg-white rounded-xl shadow-sm p-5">

                {{-- PROPERTI MINI --}}
                <div class="flex items-center gap-3 mb-3">
                    <img src="{{ asset('storage/' . $properti->foto_properti) }}"
                         class="w-14 h-14 object-cover rounded-lg border">

                    <div>
                        <p class="text-xs text-gray-500">Properti</p>
                        <p class="font-semibold text-gray-800">
                            {{ $properti->nama_properti }}
                        </p>
                    </div>
                </div>

                {{-- STATUS (PINDAH KE SINI) --}}
                <div class="mb-4">
                    <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full font-semibold">
                        Menunggu Validasi
                    </span>
                </div>

                {{-- BIAYA --}}
                <div>
                    <p class="text-gray-400 text-sm">Biaya Upload</p>
                    <p class="text-2xl font-bold text-indigo-600">
                        Rp 10.000
                    </p>
                </div>

            </div>

            {{-- ACTION --}}
            <div class="bg-white rounded-xl shadow-sm p-5 space-y-3">

                <form method="POST"
                      action="{{ route('admin.validasi.pembayaran', $properti->properti_id) }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700
                               text-white py-3 rounded-lg text-sm font-semibold cursor-pointer">
                        Validasi Pembayaran
                    </button>
                </form>

                <form method="POST"
                    action="{{ route('admin.tolak.pembayaran', $properti->properti_id) }}"
                    class="space-y-3">
                    @csrf

                    <textarea name="alasan"
                        placeholder="Masukkan alasan penolakan..."
                        required
                        class="w-full border border-gray-300 rounded-lg p-3 text-sm
                            focus:ring-2 focus:ring-red-400 outline-none"></textarea>

                    <button type="submit"
                        class="w-full bg-red-500 hover:bg-red-600
                            text-white py-3 rounded-lg text-sm font-semibold cursor-pointer">
                        Tolak Pembayaran
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>

@endsection
