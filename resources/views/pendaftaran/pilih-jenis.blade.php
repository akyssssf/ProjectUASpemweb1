@extends('layouts.app')

@section('content')
<div class="min-h-screen py-10 px-4 bg-gray-50">
    <div class="max-w-4xl mx-auto">
        <div class="mb-10 text-center">
            <h2 class="text-4xl font-extrabold text-gray-800">Pilih Jenis Layanan</h2>
            <p class="text-gray-600 mt-2 text-lg">Silakan pilih kategori pendaftaran sesuai dengan status kepesertaan Anda.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <a href="/pendaftaran/form?jenis=bpjs" class="bg-white p-8 rounded-3xl border-2 border-blue-100 shadow-xl shadow-blue-50/50 hover:shadow-2xl hover:border-blue-500 transition-all text-center group">
                <div class="w-20 h-20 bg-blue-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 text-4xl shadow-lg shadow-blue-200">📋</div>
                <h3 class="text-2xl font-bold mb-3 text-gray-900">BPJS Kesehatan</h3>
                <p class="text-gray-600 mb-8">Gunakan kartu BPJS untuk klaim layanan kesehatan Anda secara mudah dan terintegrasi.</p>
                <span class="inline-block bg-blue-600 text-white font-bold py-3 px-8 rounded-full group-hover:bg-blue-700 transition-colors shadow-lg">Pilih BPJS</span>
            </a>

            <a href="/pendaftaran/form?jenis=umum" class="bg-white p-8 rounded-3xl border-2 border-emerald-100 shadow-xl shadow-emerald-50/50 hover:shadow-2xl hover:border-emerald-500 transition-all text-center group">
                <div class="w-20 h-20 bg-emerald-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 text-4xl shadow-lg shadow-emerald-200">🏥</div>
                <h3 class="text-2xl font-bold mb-3 text-gray-900">Non-BPJS (Umum)</h3>
                <p class="text-gray-600 mb-8">Layanan kesehatan mandiri bagi pasien tanpa menggunakan asuransi BPJS.</p>
                <span class="inline-block bg-emerald-600 text-white font-bold py-3 px-8 rounded-full group-hover:bg-emerald-700 transition-colors shadow-lg">Pilih Umum</span>
            </a>
        </div>

        <div class="mt-12 text-center">
        <a href="/dashboard" class="inline-flex items-center justify-center bg-gray-800 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:bg-gray-900 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Dashboard
        </a>
    </div>
    </div>
</div>
@endsection