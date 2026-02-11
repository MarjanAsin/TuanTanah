@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')

<div class="min-h-screen bg-gray-200 flex items-center justify-center">

    <div class="bg-[#151541] w-full max-w-sm rounded-md shadow-lg p-8 text-white">

        <h2 class="text-xl font-semibold text-center mb-6 font-inria">
            Selamat Datang
        </h2>

        <form class="space-y-4">

            <div>
                <label class="text-sm">Email</label>
                <input type="email"
                       class="w-full mt-1 px-3 py-2 rounded bg-gray-100 text-black text-sm focus:outline-none">
            </div>

            <div>
                <label class="text-sm">Password</label>
                <input type="password"
                       class="w-full mt-1 px-3 py-2 rounded bg-gray-100 text-black text-sm focus:outline-none">
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 transition py-2 rounded text-sm font-semibold mt-2">
                Masuk
            </button>

        </form>

        <p class="text-xs text-gray-300 mt-4">
            Belum punya akun?
        </p>

    </div>

</div>

@endsection
