@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-300 flex items-center justify-center px-4">

    <div class="bg-[#151541] w-full max-w-sm rounded-2xl shadow-2xl p-10 text-white">

        <h2 class="text-2xl font-semibold text-center mb-8 font-inria tracking-wide">
            Selamat Datang
        </h2>

        <form method="POST" action="{{ route('masuk') }}" class="space-y-5">
            @csrf

            <div>
                <label class="text-xs uppercase tracking-wide text-gray-300">
                    Email
                </label>

                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full mt-2 px-4 py-2.5 rounded-lg bg-white text-black text-sm
                           focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">

                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-xs uppercase tracking-wide text-gray-300">
                    Password
                </label>

                <input type="password" name="password"
                    class="w-full mt-2 px-4 py-2.5 rounded-lg bg-white text-black text-sm
                           focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">

                @error('password')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700
                           py-3 rounded-lg text-sm font-semibold
                           shadow-md hover:shadow-lg
                           transition duration-300 mt-3 cursor-pointer">
                Masuk
            </button>
        </form>

        <p class="text-xs text-gray-300 mt-6 text-center">
            Belum punya akun?
            <a href="{{ route('daftar') }}"
               class="text-white font-semibold hover:underline ml-1">
                Daftar
            </a>
        </p>

    </div>

</div>

@endsection
