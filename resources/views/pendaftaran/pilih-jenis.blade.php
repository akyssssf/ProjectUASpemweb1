@extends('layouts.app')

@section('content')
<div class="mb-8 text-center">
    <h2 class="text-3xl font-black text-slate-800">Pilih Jenis Layanan 🏥</h2>
    <p class="text-slate-500 mt-2">Pilih kategori pendaftaran sesuai dengan status kepesertaan Anda.</p>
</div>

<div class="max-w-2xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <a href="/pendaftaran/form?jenis=bpjs" class="clay p-8 text-center hover:-translate-y-2 transition-transform duration-200 group">
            <div class="clay-blue w-20 h-20 flex items-center justify-center mx-auto mb-5 text-4xl group-hover:scale-110 transition-transform" style="border-radius:24px;box-shadow:0 6px 0 #3730A3;">📋</div>
            <h3 class="text-xl font-black text-slate-800 mb-3">BPJS Kesehatan</h3>
            <p class="text-slate-500 text-sm mb-6 leading-relaxed">Gunakan kartu BPJS untuk klaim layanan kesehatan Anda secara mudah dan terintegrasi.</p>
            <span class="btn-clay btn-primary w-full text-center block" style="padding:12px;">Pilih BPJS</span>
        </a>

        <a href="/pendaftaran/form?jenis=umum" class="clay p-8 text-center hover:-translate-y-2 transition-transform duration-200 group">
            <div class="clay-green w-20 h-20 flex items-center justify-center mx-auto mb-5 text-4xl group-hover:scale-110 transition-transform" style="border-radius:24px;box-shadow:0 6px 0 #047857;">🩺</div>
            <h3 class="text-xl font-black text-slate-800 mb-3">Non-BPJS (Umum)</h3>
            <p class="text-slate-500 text-sm mb-6 leading-relaxed">Layanan kesehatan mandiri bagi pasien tanpa menggunakan asuransi BPJS.</p>
            <span class="btn-clay btn-green w-full text-center block" style="padding:12px;">Pilih Umum</span>
        </a>
    </div>

    <div class="text-center">
        <a href="/dashboard" class="btn-clay btn-white" style="padding:12px 28px;">← Kembali ke Dashboard</a>
    </div>
</div>
@endsection
