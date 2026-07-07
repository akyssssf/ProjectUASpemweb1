@extends('layouts.app')

@section('content')
<div class="mb-8">
    <div class="clay-blue p-6 md:p-8 relative overflow-hidden" style="border-radius:24px;">
        <div class="absolute right-0 top-0 w-48 h-48 rounded-full" style="background:rgba(255,255,255,0.08);transform:translate(30%,-30%);"></div>
        <div class="relative z-10 flex items-center justify-between gap-4">
            <div>
                <p class="text-indigo-200 font-bold text-sm uppercase tracking-widest mb-1">Dashboard Pasien</p>
                <h1 class="text-2xl md:text-3xl font-black text-white">Halo, {{ Auth::guard('pasien')->user()->name }}! 👋</h1>
                <p class="text-indigo-200 mt-1">Silakan pilih layanan yang Anda butuhkan hari ini.</p>
            </div>
            <div class="hidden md:block text-6xl">🏥</div>
        </div>
    </div>
</div>

@if(isset($antreanAktif) && $antreanAktif)
<div class="mb-8 animate-pulse-slow">
    <div class="clay p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-6" style="border:2px solid #3B82F6; box-shadow: 0 10px 30px rgba(59,130,246,0.2);">
        <div>
            <div class="inline-block bg-blue-100 text-blue-700 text-xs font-black uppercase tracking-widest px-3 py-1 rounded-full mb-3">Tiket Antrean Anda</div>
            <h2 class="text-3xl md:text-4xl font-black text-slate-800">{{ $antreanAktif->nomor_antrian }}</h2>
            <p class="text-slate-500 font-bold mt-2">{{ $antreanAktif->klinik }} — {{ $antreanAktif->poli }}</p>
        </div>
        <div class="text-center md:text-right w-full md:w-auto">
            <div class="inline-block px-5 py-3 rounded-2xl font-black {{ $antreanAktif->status == 'dipanggil' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }} mb-3 w-full md:w-auto">
                {{ $antreanAktif->status == 'dipanggil' ? '📢 Sedang Dipanggil' : '⏳ Menunggu Panggilan' }}
            </div>
            <a href="/antrean" class="btn-clay btn-primary w-full text-center block" style="padding:10px;">Lihat Live Monitoring →</a>
        </div>
    </div>
</div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

    <a href="/pendaftaran" class="clay p-6 flex flex-col items-center text-center hover:-translate-y-1 transition-transform duration-200 group">
        <div class="clay-blue w-16 h-16 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform" style="border-radius:20px;box-shadow:0 5px 0 #3730A3;">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        <h3 class="text-base font-black text-slate-800 mb-1">Pendaftaran</h3>
        <p class="text-xs text-slate-500 mb-4 flex-grow">Daftar BPJS atau umum untuk pemeriksaan baru.</p>
        <span class="btn-clay btn-primary w-full text-center text-sm" style="padding:10px;">Daftar Sekarang</span>
    </a>

    <a href="/antrean" onclick="try{window.speechSynthesis.speak(new SpeechSynthesisUtterance(''))}catch(e){}" class="clay p-6 flex flex-col items-center text-center hover:-translate-y-1 transition-transform duration-200 group">
        <div class="clay-green w-16 h-16 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform" style="border-radius:20px;box-shadow:0 5px 0 #047857;">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="text-base font-black text-slate-800 mb-1">Cek Antrean</h3>
        <p class="text-xs text-slate-500 mb-4 flex-grow">Pantau nomor antrean real-time dengan notifikasi suara.</p>
        <span class="btn-clay btn-green w-full text-center text-sm" style="padding:10px;">Lihat Antrean</span>
    </a>

    <a href="{{ route('rating.index') }}" class="clay p-6 flex flex-col items-center text-center hover:-translate-y-1 transition-transform duration-200 group">
        <div class="clay-amber w-16 h-16 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform" style="border-radius:20px;box-shadow:0 5px 0 #B45309;">
            <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.6l2.78 5.63 6.22.91-4.5 4.38 1.06 6.2L12 16.79l-5.56 2.93 1.06-6.2L3 9.14l6.22-.91L12 2.6z"/></svg>
        </div>
        <h3 class="text-base font-black text-slate-800 mb-1">Survei & Rating</h3>
        <p class="text-xs text-slate-500 mb-4 flex-grow">Cari RS terbaik. Survei muncul di Riwayat setelah kunjungan selesai.</p>
        <span class="btn-clay btn-clay w-full text-center text-sm btn-primary" style="padding:10px;background:linear-gradient(135deg,#F59E0B,#D97706);box-shadow:0 4px 0 #B45309;">Cari RS & Rating</span>
    </a>

    <a href="{{ route('pendaftaran.riwayat') }}" class="clay p-6 flex flex-col items-center text-center hover:-translate-y-1 transition-transform duration-200 group">
        <div class="clay-violet w-16 h-16 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform" style="border-radius:20px;background:linear-gradient(135deg,#8B5CF6,#7C3AED);box-shadow:0 5px 0 #5B21B6;">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <h3 class="text-base font-black text-slate-800 mb-1">Riwayat</h3>
        <p class="text-xs text-slate-500 mb-4 flex-grow">Lihat riwayat kunjungan dan status pendaftaran kamu.</p>
        <span class="btn-clay w-full text-center text-sm" style="padding:10px;background:linear-gradient(135deg,#8B5CF6,#7C3AED);color:white;box-shadow:0 4px 0 #5B21B6;">Lihat Riwayat</span>
    </a>

</div>
@endsection
