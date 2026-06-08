@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard Pasien</h1>
    <p class="text-gray-500 mt-1">Selamat datang! Silakan pilih layanan klinik yang Anda butuhkan hari ini.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 p-6 border border-gray-100 flex flex-col items-center text-center group">
        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Pendaftaran Pasien</h3>
        <p class="text-sm text-gray-500 mb-6 flex-grow">Daftar untuk pemeriksaan baru atau buat janji temu dengan dokter.</p>
        <button class="w-full bg-blue-600 text-white font-medium py-2.5 rounded-lg hover:bg-blue-700 transition-colors">Daftar Sekarang</button>
    </div>

    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 p-6 border border-gray-100 flex flex-col items-center text-center group">
        <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Cek Antrean</h3>
        <p class="text-sm text-gray-500 mb-6 flex-grow">Pantau nomor antrean Anda saat ini secara real-time.</p>
        <button class="w-full bg-emerald-500 text-white font-medium py-2.5 rounded-lg hover:bg-emerald-600 transition-colors">Lihat Antrean</button>
    </div>

    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 p-6 border border-gray-100 flex flex-col items-center text-center group">
        <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Survei Kepuasan</h3>
        <p class="text-sm text-gray-500 mb-6 flex-grow">Bantu kami meningkatkan layanan dengan memberikan ulasan Anda.</p>
        <button class="w-full bg-amber-500 text-white font-medium py-2.5 rounded-lg hover:bg-amber-600 transition-colors">Isi Survei</button>
    </div>

</div>
@endsection