@php
    $oldFasilitas = $oldFasilitas ?? [];
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">

    @foreach([
        'AC',
        'WiFi',
        'Garasi',
        'Dapur',
        'CCTV',
        'Kolam Renang',
        'Taman',
        'PDAM',
        'Keamanan 24 Jam',
        'Mushola',
        'Balkon',
        'Gudang'
    ] as $fasilitas)

        <label
            class="flex items-center gap-3
                   p-3 rounded-xl
                   bg-white
                   border border-gray-200
                   hover:border-indigo-400
                   hover:bg-indigo-50
                   transition
                   cursor-pointer">

            <input
                type="checkbox"
                name="fasilitas[]"
                value="{{ $fasilitas }}"
                {{ in_array($fasilitas, $oldFasilitas) ? 'checked' : '' }}
                class="w-4 h-4 text-indigo-600 rounded">

            <span class="text-sm text-gray-700 font-inria">
                {{ $fasilitas }}
            </span>

        </label>

    @endforeach

</div>