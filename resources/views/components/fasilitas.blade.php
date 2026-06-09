<div class="grid grid-cols-2 sm:grid-cols-3 gap-3">

    @foreach(explode(',', $fasilitas ?? '') as $item)

        @php
            $item = trim($item);
        @endphp

        @if($item)

            <div class="flex items-center gap-3
                        p-3 rounded-xl
                        bg-gray-50 border border-gray-100">

                @switch($item)

                    @case('AC')
                        <x-hugeicons-smart-ac class="w-5 h-5 text-indigo-600"/>
                        @break

                    @case('WiFi')
                        <x-hugeicons-wifi class="w-5 h-5 text-indigo-600"/>
                        @break

                    @case('Garasi')
                        <x-hugeicons-garage class="w-5 h-5 text-indigo-600"/>
                        @break

                    @case('CCTV')
                        <x-hugeicons-cctv-camera class="w-5 h-5 text-indigo-600"/>
                        @break

                    @case('Kolam Renang')
                        <x-hugeicons-swimming class="w-5 h-5 text-indigo-600"/>
                        @break

                    @case('Taman')
                        <x-hugeicons-plant-02 class="w-5 h-5 text-indigo-600"/>
                        @break

                    @case('PDAM')
                        <x-hugeicons-water-pump class="w-5 h-5 text-indigo-600"/>
                        @break

                    @case('Keamanan 24 Jam')
                        <x-hugeicons-security-check class="w-5 h-5 text-indigo-600"/>
                        @break

                    @case('Mushola')
                        <x-hugeicons-mosque-01 class="w-5 h-5 text-indigo-600"/>
                        @break

                    @case('Balkon')
                        <x-hugeicons-terrace class="w-5 h-5 text-indigo-600"/>
                        @break

                    @case('Dapur')
                        <x-hugeicons-kitchen-utensils class="w-5 h-5 text-indigo-600"/>
                        @break

                    @case('Gudang')
                        <x-hugeicons-warehouse class="w-5 h-5 text-indigo-600"/>
                        @break

                    @default
                        <x-hugeicons-home-01 class="w-5 h-5 text-indigo-600"/>

                @endswitch

                <span class="text-sm text-gray-700 font-inria">
                    {{ $item }}
                </span>

            </div>

        @endif

    @endforeach

</div>