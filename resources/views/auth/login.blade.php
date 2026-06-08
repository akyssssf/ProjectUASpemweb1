@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Login Pasien</h2>
        
        <form method="POST" action="/login">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" placeholder="Masukkan email Anda" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors">
                Masuk
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun? <a href="/register" class="text-blue-600 hover:text-blue-700 font-semibold hover:underline">Daftar di sini</a>
        </p>
    </div>
</div>
@endsection