@extends('layouts.admin')

@section('title', 'Beranda Admin')

@section('content')

{{-- STATISTIK --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">

    {{-- Properti Aktif --}}
    <div class="bg-gradient-to-br from-[#151541] to-indigo-800 text-white rounded-2xl p-6 shadow-md hover:shadow-xl transition duration-300">

        <p class="text-xs uppercase tracking-wider text-indigo-200 font-semibold font-inria">
            Properti Aktif
        </p>

        <div class="flex items-end justify-between mt-4">

            <h3 class="text-4xl font-bold font-inria">
                {{ $totalAktif }}
            </h3>

            <span class="text-4xl opacity-20">
                🏠
            </span>

        </div>

    </div>

    {{-- Pemilik Properti --}}
    <div class="bg-gradient-to-br from-[#151541] to-indigo-800 text-white rounded-2xl p-6 shadow-md hover:shadow-xl transition duration-300">

        <p class="text-xs uppercase tracking-wider text-indigo-200 font-semibold font-inria">
            Pemilik Properti
        </p>

        <div class="flex items-end justify-between mt-4">

            <h3 class="text-4xl font-bold font-inria">
                {{ $totalPemilik }}
            </h3>

            <span class="text-4xl opacity-15">
                👤
            </span>

        </div>

    </div>

    {{-- Menunggu Verifikasi --}}
    <div class="bg-gradient-to-br from-[#151541] to-indigo-800 text-white rounded-2xl p-6 shadow-md hover:shadow-xl transition duration-300">

        <p class="text-xs uppercase tracking-wider text-indigo-200 font-semibold font-inria">
            Menunggu Verifikasi
        </p>

        <div class="flex items-end justify-between mt-4">

            <h3 class="text-4xl font-bold font-inria">
                {{ $menunggu }}
            </h3>

            <span class="text-4xl opacity-20">
                ⏳
            </span>

        </div>

    </div>

</div>



{{-- TANDAI PROPERTI UNGGULAN --}}
<div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg border border-gray-100">

    <form method="POST" action="{{ route('admin.unggulan') }}">
        @csrf

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">

            <h2 class="text-lg font-semibold text-gray-800 font-inria">
                Tandai Properti Unggulan
            </h2>

            <button
                class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700
                       text-white px-6 py-2.5 rounded-lg text-sm
                       font-bold shadow-md transition duration-200
                       cursor-pointer font-inria">
                Simpan
            </button>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($properti as $item)

            <div class="bg-gray-50 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-300">

                <div class="overflow-hidden">
                    @php
                        $foto = $item->fotos->first();
                    @endphp
                    <img loading="lazy" src="{{ $foto ? asset('storage/' . $foto->path) : asset('images/no-image.png') }}"
                        class="w-full h-44 object-cover hover:scale-105 transition duration-300">
                </div>

                <div class="p-4 text-sm">

                    <h3 class="font-semibold text-gray-800 mb-1 font-inria">
                        {{ $item->nama_properti }}
                    </h3>

                    <p class="text-gray-500 text-xs mb-1 font-inria">
                        {{ $item->lokasi }}
                    </p>

                    <p class="text-gray-500 text-xs truncate font-inria">
                        {{ implode(' • ', array_map('trim', explode(',', $item->fasilitas))) }}
                    </p>

                    <p class="font-bold text-indigo-600 mb-3 font-inria text-lg">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </p>

                    <div class="flex items-center justify-between border-t pt-3">
                        <span class="text-xs text-gray-600 font-inria">
                            Tandai Unggulan
                        </span>

                        <input type="checkbox"
                               name="properti[]"
                               value="{{ $item->properti_id }}"
                               class="w-4 h-4 text-indigo-600 rounded focus:ring-indigo-500 cursor-pointer"
                               {{ $item->is_unggulan ? 'checked' : '' }}>
                    </div>

                </div>
            </div>

            @empty
                <p class="text-gray-500 col-span-full text-center font-inria">
                    Belum ada properti yang disetujui.
                </p>
            @endforelse

        </div>
        
        @if($properti->hasPages())
            <div class="mt-10 border-gray-100 flex justify-center font-inria">
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm px-2 py-2">
                    {{ $properti->onEachSide(1)->links() }}
                </div>
            </div>
        @endif

    </form>

</div>

@endsection
