@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard Pasien</h1>
    <p class="text-gray-600 mt-2">Selamat datang! Silakan pilih layanan klinik yang Anda butuhkan hari ini.</p>
</div>

<!-- Grid Layanan -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <!-- Card Pendaftaran -->
    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-gray-100 flex flex-col items-center text-center">
        <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4">
            <!-- Icon placeholder -->
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Pendaftaran Pasien</h3>
        <p class="text-sm text-gray-500 mb-4 flex-grow">Daftar untuk pemeriksaan baru atau buat janji temu dengan dokter.</p>
        <button class="w-full bg-blue-50 text-blue-600 font-medium py-2 rounded-lg hover:bg-blue-100 transition">Daftar Sekarang</button>
    </div>

    <!-- Card Antrean -->
    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-gray-100 flex flex-col items-center text-center">
        <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Cek Antrean</h3>
        <p class="text-sm text-gray-500 mb-4 flex-grow">Pantau nomor antrean Anda saat ini secara real-time.</p>
        <button class="w-full bg-green-50 text-green-600 font-medium py-2 rounded-lg hover:bg-green-100 transition">Lihat Antrean</button>
    </div>

    <!-- Card Survei Kepuasan -->
    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-gray-100 flex flex-col items-center text-center">
        <div class="w-16 h-16 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Survei Kepuasan</h3>
        <p class="text-sm text-gray-500 mb-4 flex-grow">Bantu kami meningkatkan layanan dengan memberikan ulasan Anda.</p>
        <button class="w-full bg-yellow-50 text-yellow-700 font-medium py-2 rounded-lg hover:bg-yellow-100 transition">Isi Survei</button>
    </div>

</div>
@endsection