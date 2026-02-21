@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-300 flex items-center justify-center px-4">

    <div class="bg-[#151541] w-full max-w-sm rounded-2xl shadow-2xl p-10 text-white">

        {{-- Judul --}}
        <h2 class="text-2xl font-semibold text-center mb-8 font-inria tracking-wide">
            Buat Akun
        </h2>

        {{-- Form --}}
        <form method="POST" action="{{ route('daftar') }}" class="space-y-5">
        @csrf

        {{-- Nama --}}
        <div>
            <label class="text-xs uppercase tracking-wide text-gray-300 font-inria">
                Nama
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   placeholder="Masukkan nama lengkap"
                   class="w-full mt-2 px-4 py-2.5 rounded-lg bg-white text-black text-sm
                          placeholder:text-gray-400
                          focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            @error('name')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="text-xs uppercase tracking-wide text-gray-300 font-inria">
                Email
            </label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="Masukkan alamat email aktif"
                   class="w-full mt-2 px-4 py-2.5 rounded-lg bg-white text-black text-sm
                          placeholder:text-gray-400
                          focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            @error('email')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label class="text-xs uppercase tracking-wide text-gray-300 font-inria">
                Password
            </label>
            <input type="password"
                   name="password"
                   placeholder="Masukkan password"
                   class="w-full mt-2 px-4 py-2.5 rounded-lg bg-white text-black text-sm
                          placeholder:text-gray-400
                          focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            @error('password')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <label class="text-xs uppercase tracking-wide text-gray-300 font-inria">
                Konfirmasi Password
            </label>
            <input type="password"
                   name="password_confirmation"
                   placeholder="Ulangi password"
                   class="w-full mt-2 px-4 py-2.5 rounded-lg bg-white text-black text-sm
                          placeholder:text-gray-400
                          focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700
                       py-3 rounded-lg text-sm font-semibold
                       shadow-md hover:shadow-lg
                       transition duration-300 mt-3 cursor-pointer font-inria">
            Buat Akun
        </button>

    </form>

        {{-- Link Login --}}
        <p class="text-xs text-gray-300 mt-6 text-center font-inria">
            Sudah punya akun?
            <a href="{{ route('masuk') }}"
               class="text-white font-semibold hover:underline ml-1">
                Masuk di sini
            </a>
        </p>

    </div>

</div>

@endsection
