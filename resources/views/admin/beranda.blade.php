@extends('layouts.admin')

@section('title', 'Beranda Admin')

@section('content')

{{-- Statistik --}}
<div class="grid grid-cols-3 gap-8 mb-10">

    <div class="bg-[#151541] text-white p-6">
        <h3 class="text-sm mb-2">Jumlah Properti</h3>
        <p class="text-2xl font-semibold">{{ $totalProperti }}</p>
    </div>

    <div class="bg-[#151541] text-white p-6">
        <h3 class="text-sm mb-2">Jumlah Pemilik Properti</h3>
        <p class="text-2xl font-semibold">{{ $totalPemilik }}</p>
    </div>

    <div class="bg-[#151541] text-white p-6">
        <h3 class="text-sm mb-2">Jumlah Properti menunggu verifikasi</h3>
        <p class="text-2xl font-semibold">{{ $menunggu }}</p>
    </div>

</div>



{{-- Tandai Properti Unggulan --}}
<div class="bg-white p-6">

    <form method="POST" action="{{ route('admin.unggulan') }}">
        @csrf

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-base font-semibold">
                Tandai Properti Unggulan
            </h2>

            <button class="bg-indigo-600 text-white px-6 py-2 text-sm">
                Simpan
            </button>
        </div>

        <div class="grid grid-cols-3 gap-8">

            @forelse($properti as $item)

            <div>
                <img src="{{ asset('storage/' . $item->foto_properti) }}"
                     class="w-full h-44 object-cover mb-3">

                <div class="text-xs">
                    <h3 class="font-semibold">
                        {{ $item->nama_properti }}
                    </h3>

                    <p>{{ $item->lokasi }}</p>
                    <p>{{ $item->fasilitas }}</p>

                    <p class="font-semibold mt-1">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </p>

                    <div class="flex items-center gap-2 mt-2">
                        <label>Tandai</label>
                        <input type="checkbox"
                               name="properti[]"
                               value="{{ $item->properti_id }}"
                               {{ $item->is_unggulan ? 'checked' : '' }}>
                    </div>
                </div>
            </div>

            @empty
                <p class="text-sm text-gray-500">
                    Tidak ada properti yang disetujui.
                </p>
            @endforelse

        </div>

    </form>

</div>


@endsection
