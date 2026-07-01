<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Sehat — Layanan Kesehatan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #EEF2FF; overflow-x: hidden; }
        .clay { background: white; border-radius: 28px; box-shadow: 0 8px 0 0 #C7D2FE, 0 12px 32px rgba(99,102,241,0.10); border: 2px solid #E0E7FF; }
        .clay-blue { background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%); border-radius: 28px; box-shadow: 0 8px 0 0 #3730A3, 0 12px 32px rgba(99,102,241,0.30); border: 2px solid #818CF8; }
        .clay-dark { background: linear-gradient(135deg, #1E1B4B 0%, #312E81 100%); border-radius: 28px; box-shadow: 0 8px 0 0 #0F0A2E, 0 12px 32px rgba(30,27,75,0.40); border: 2px solid #4338CA; }
        .clay-green { background: linear-gradient(135deg, #10B981 0%, #059669 100%); border-radius: 28px; box-shadow: 0 8px 0 0 #047857, 0 12px 32px rgba(16,185,129,0.25); }
        .clay-amber { background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); border-radius: 28px; box-shadow: 0 8px 0 0 #B45309, 0 12px 32px rgba(245,158,11,0.25); }
        .clay-violet { background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%); border-radius: 28px; box-shadow: 0 8px 0 0 #5B21B6, 0 12px 32px rgba(139,92,246,0.25); }
        .btn-clay { display: inline-block; padding: 14px 32px; border-radius: 18px; font-weight: 800; transition: all 0.15s ease; position: relative; top: 0; }
        .btn-clay:active { top: 4px; }
        .btn-primary { background: linear-gradient(135deg, #6366F1, #4F46E5); color: white; box-shadow: 0 6px 0 0 #3730A3, 0 8px 20px rgba(99,102,241,0.30); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 0 0 #3730A3, 0 12px 24px rgba(99,102,241,0.35); }
        .btn-white { background: white; color: #4F46E5; box-shadow: 0 6px 0 0 #C7D2FE; border: 2.5px solid #E0E7FF; }
        .btn-white:hover { transform: translateY(-2px); box-shadow: 0 10px 0 0 #C7D2FE; }
        .blob { position: absolute; border-radius: 50%; filter: blur(70px); opacity: 0.18; pointer-events: none; }
        .icon-wrap { width: 56px; height: 56px; border-radius: 18px; display: flex; align-items: center; justify-content: center; }
        .float { animation: float 4s ease-in-out infinite; }
        .float-2 { animation: float 5s ease-in-out infinite 1s; }
        .float-3 { animation: float 6s ease-in-out infinite 2s; }
        @keyframes float { 0%,100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
        .section-tag { display: inline-block; background: #EEF2FF; color: #4F46E5; border: 2px solid #C7D2FE; border-radius: 99px; padding: 6px 18px; font-size: 0.75rem; font-weight: 800; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 16px; }
        .stat-card { text-align: center; }
        .poli-chip { background: white; border-radius: 16px; padding: 12px 20px; box-shadow: 0 4px 0 0 #C7D2FE, 0 8px 16px rgba(99,102,241,0.08); border: 2px solid #E0E7FF; display: inline-flex; align-items: center; gap: 10px; font-weight: 700; color: #4F46E5; font-size: 0.9rem; }
    </style>
</head>
<body>

<!-- Background blobs -->
<div class="fixed inset-0 overflow-hidden pointer-events-none">
    <div class="blob w-[500px] h-[500px] bg-indigo-400 -top-40 -left-40"></div>
    <div class="blob w-96 h-96 bg-blue-300 top-1/2 -right-32"></div>
    <div class="blob w-80 h-80 bg-violet-400 bottom-10 left-1/3"></div>
</div>

<!-- NAVBAR -->
<nav class="relative z-50 sticky top-0 px-4 pt-4">
    <div class="clay max-w-7xl mx-auto px-6 py-4 flex justify-between items-center" style="border-radius:20px;">
        <div class="flex items-center gap-3">
            <div class="clay-blue w-9 h-9 flex items-center justify-center" style="border-radius:12px;box-shadow:0 4px 0 #3730A3;">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </div>
            <span class="font-black text-lg text-indigo-700">Klinik Sehat</span>
        </div>
        <div class="hidden md:flex items-center gap-6">
            <a href="#fitur" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">Fitur</a>
            <a href="#poli" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">Layanan</a>
            <a href="#cara" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">Cara Pakai</a>
            <a href="{{ route('rating.index') }}" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">⭐ Rating RS</a>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('petugas.login') }}" class="hidden sm:block text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors">Akses Petugas</a>
            <a href="{{ route('login') }}" class="btn-clay btn-white" style="padding:10px 22px;font-size:0.85rem;">Masuk</a>
            <a href="/register" class="btn-clay btn-primary" style="padding:10px 22px;font-size:0.85rem;">Daftar</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="relative z-10 max-w-7xl mx-auto px-4 pt-12 pb-8">
    <div class="clay-dark p-10 md:p-16 relative overflow-hidden">
        <!-- Decorative circles -->
        <div class="absolute top-0 right-0 w-80 h-80 rounded-full" style="background:rgba(99,102,241,0.2);transform:translate(30%,-30%);"></div>
        <div class="absolute bottom-0 left-1/2 w-64 h-64 rounded-full" style="background:rgba(139,92,246,0.15);transform:translate(-50%,40%);"></div>

        <div class="relative grid md:grid-cols-2 gap-10 items-center">
            <div>
                <div class="inline-flex items-center gap-2 bg-white/10 text-white/80 border border-white/20 rounded-full px-4 py-2 text-xs font-bold uppercase tracking-widest mb-6">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    Sistem Klinik Digital Aktif
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-white leading-tight mb-5">
                    Layanan Kesehatan<br>
                    <span class="text-transparent bg-clip-text" style="background:linear-gradient(90deg,#A5B4FC,#C4B5FD);">Terbaik & Cepat</span>
                </h1>
                <p class="text-indigo-200 text-lg leading-relaxed mb-8 max-w-lg">
                    Daftar periksa, pantau antrean secara real-time, dan berikan penilaian layanan dengan mudah melalui sistem digital Klinik Sehat.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="/register" class="btn-clay btn-primary text-base">Daftar Sekarang →</a>
                    <a href="#cara" class="btn-clay btn-white text-base">Pelajari Cara Pakai</a>
                </div>
            </div>

            <!-- Stats di hero -->
            <div class="grid grid-cols-2 gap-4">
                <div class="clay float p-6 text-center" style="border-radius:24px;">
                    <div class="text-4xl font-black text-indigo-600 mb-1">500+</div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Pasien Terdaftar</div>
                </div>
                <div class="clay-green float-2 p-6 text-center">
                    <div class="text-4xl font-black text-white mb-1">4.8</div>
                    <div class="text-xs font-bold text-emerald-100 uppercase tracking-wide">Rating Layanan</div>
                </div>
                <div class="clay-violet float-3 p-6 text-center">
                    <div class="text-4xl font-black text-white mb-1">24/7</div>
                    <div class="text-xs font-bold text-violet-100 uppercase tracking-wide">Sistem Aktif</div>
                </div>
                <div class="clay float p-6 text-center" style="border-radius:24px;">
                    <div class="text-4xl font-black text-indigo-600 mb-1">3</div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Klinik Tersedia</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FITUR UTAMA -->
<section id="fitur" class="relative z-10 max-w-7xl mx-auto px-4 py-12">
    <div class="text-center mb-10">
        <div class="section-tag">✨ Fitur Unggulan</div>
        <h2 class="text-3xl md:text-4xl font-black text-slate-800">Semua yang Kamu Butuhkan</h2>
        <p class="text-slate-500 mt-3 max-w-xl mx-auto">Satu platform, lengkap untuk pasien dan petugas klinik.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="clay p-8 hover:-translate-y-1 transition-transform duration-200">
            <div class="icon-wrap clay-blue mb-5" style="box-shadow:0 4px 0 #3730A3;">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-800 mb-3">Pendaftaran Online</h3>
            <p class="text-slate-500 leading-relaxed">Daftar BPJS maupun umum dari mana saja, kapan saja. Tidak perlu antre panjang di loket.</p>
            <div class="mt-5 flex gap-2">
                <span class="badge badge-blue">BPJS</span>
                <span class="badge badge-blue">Non-BPJS</span>
            </div>
        </div>

        <div class="clay p-8 hover:-translate-y-1 transition-transform duration-200">
            <div class="icon-wrap clay-green mb-5" style="box-shadow:0 4px 0 #047857;">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-800 mb-3">Antrean Real-Time</h3>
            <p class="text-slate-500 leading-relaxed">Pantau nomor antrean dan estimasi waktu tunggu secara langsung. Ada notifikasi suara saat dipanggil.</p>
            <div class="mt-5 flex gap-2">
                <span class="badge badge-green">Live Update</span>
                <span class="badge badge-green">Suara</span>
            </div>
        </div>

        <div class="clay p-8 hover:-translate-y-1 transition-transform duration-200">
            <div class="icon-wrap clay-amber mb-5" style="box-shadow:0 4px 0 #B45309;">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-800 mb-3">Rating & Survei</h3>
            <p class="text-slate-500 leading-relaxed">Nilai layanan setelah kunjungan atau berikan rating umum untuk RS favorit. Temukan klinik terbaik di sekitarmu.</p>
            <div class="mt-5 flex gap-2">
                <span class="badge badge-amber">Per Kunjungan</span>
                <span class="badge badge-amber">Publik</span>
            </div>
        </div>

        <div class="clay p-8 hover:-translate-y-1 transition-transform duration-200">
            <div class="icon-wrap clay-violet mb-5" style="box-shadow:0 4px 0 #5B21B6;">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-800 mb-3">Rekam Medis</h3>
            <p class="text-slate-500 leading-relaxed">Dokter input rekam medis SOAP langsung setelah pemeriksaan. Tersimpan aman dan terstruktur.</p>
            <div class="mt-5 flex gap-2">
                <span class="badge badge-blue">SOAP</span>
                <span class="badge badge-blue">Terenkripsi</span>
            </div>
        </div>

        <div class="clay p-8 hover:-translate-y-1 transition-transform duration-200">
            <div class="icon-wrap clay-blue mb-5" style="box-shadow:0 4px 0 #3730A3;">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-800 mb-3">Kelola Staff & Pasien</h3>
            <p class="text-slate-500 leading-relaxed">Admin dapat mengelola akun dokter, petugas, dan data pasien dari satu dashboard yang lengkap.</p>
            <div class="mt-5 flex gap-2">
                <span class="badge badge-blue">Admin</span>
                <span class="badge badge-blue">Dokter</span>
                <span class="badge badge-blue">Petugas</span>
            </div>
        </div>

        <div class="clay p-8 hover:-translate-y-1 transition-transform duration-200">
            <div class="icon-wrap clay-green mb-5" style="box-shadow:0 4px 0 #047857;">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-800 mb-3">Dukungan BPJS</h3>
            <p class="text-slate-500 leading-relaxed">Pendaftaran BPJS lengkap dengan input faskes asal dan jenis rujukan. Terintegrasi penuh di sistem.</p>
            <div class="mt-5 flex gap-2">
                <span class="badge badge-green">Faskes I</span>
                <span class="badge badge-green">Rujukan</span>
            </div>
        </div>
    </div>
</section>

<!-- LAYANAN POLI -->
<section id="poli" class="relative z-10 max-w-7xl mx-auto px-4 py-12">
    <div class="clay-blue p-10 md:p-12 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 rounded-full" style="background:rgba(255,255,255,0.08);transform:translate(30%,-30%);"></div>
        <div class="text-center mb-10 relative z-10">
            <div class="inline-block bg-white/15 text-white border border-white/25 rounded-full px-4 py-2 text-xs font-bold uppercase tracking-widest mb-4">🏥 Layanan Poli</div>
            <h2 class="text-3xl md:text-4xl font-black text-white">Tersedia Berbagai Poli</h2>
            <p class="text-indigo-200 mt-3">Pilih poli sesuai kebutuhanmu saat pendaftaran</p>
        </div>
        <div class="relative z-10 flex flex-wrap justify-center gap-4">
            @php
                $polis = [
                    ['icon'=>'🦷','nama'=>'Poli Gigi'],['icon'=>'👶','nama'=>'Poli Anak'],
                    ['icon'=>'🫀','nama'=>'Poli Jantung'],['icon'=>'🧠','nama'=>'Poli Saraf'],
                    ['icon'=>'👁️','nama'=>'Poli Mata'],['icon'=>'🦴','nama'=>'Poli Ortopedi'],
                    ['icon'=>'🫁','nama'=>'Poli Paru'],['icon'=>'🩺','nama'=>'Poli Umum'],
                    ['icon'=>'🧪','nama'=>'Lab & Farmasi'],
                ];
            @endphp
            @foreach($polis as $poli)
                <div class="poli-chip">
                    <span class="text-xl">{{ $poli['icon'] }}</span>
                    {{ $poli['nama'] }}
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CARA PAKAI -->
<section id="cara" class="relative z-10 max-w-7xl mx-auto px-4 py-12">
    <div class="text-center mb-10">
        <div class="section-tag">📋 Cara Pakai</div>
        <h2 class="text-3xl md:text-4xl font-black text-slate-800">Mudah dalam 4 Langkah</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
        <!-- Line connector (desktop) -->
        <div class="hidden md:block absolute top-10 left-[12.5%] right-[12.5%] h-0.5 bg-gradient-to-r from-indigo-200 via-indigo-400 to-indigo-200" style="z-index:0;"></div>
        @php
            $steps = [
                ['no'=>'1','icon'=>'👤','title'=>'Buat Akun','desc'=>'Daftar dengan NIK, email, dan nomor HP kamu.','color'=>'clay-blue','shadow'=>'#3730A3'],
                ['no'=>'2','icon'=>'📝','title'=>'Daftar Periksa','desc'=>'Pilih klinik, poli, dan dokter yang kamu inginkan.','color'=>'clay-green','shadow'=>'#047857'],
                ['no'=>'3','icon'=>'⏰','title'=>'Pantau Antrean','desc'=>'Lihat nomor antrean dan estimasi waktu secara real-time.','color'=>'clay-violet','shadow'=>'#5B21B6'],
                ['no'=>'4','icon'=>'⭐','title'=>'Beri Penilaian','desc'=>'Nilai layanan setelah kunjungan selesai.','color'=>'clay-amber','shadow'=>'#B45309'],
            ];
        @endphp
        @foreach($steps as $step)
        <div class="relative z-10 clay p-6 text-center">
            <div class="{{ $step['color'] }} w-14 h-14 flex items-center justify-center mx-auto mb-4 text-2xl" style="border-radius:18px;box-shadow:0 5px 0 {{ $step['shadow'] }};">{{ $step['icon'] }}</div>
            <div class="text-xs font-black text-indigo-400 uppercase tracking-widest mb-1">Langkah {{ $step['no'] }}</div>
            <h3 class="text-lg font-black text-slate-800 mb-2">{{ $step['title'] }}</h3>
            <p class="text-sm text-slate-500">{{ $step['desc'] }}</p>
        </div>
        @endforeach
    </div>
</section>

<!-- TESTIMONI -->
<section class="relative z-10 max-w-7xl mx-auto px-4 py-12">
    <div class="text-center mb-10">
        <div class="section-tag">💬 Testimoni</div>
        <h2 class="text-3xl md:text-4xl font-black text-slate-800">Kata Mereka</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @php $testimonials = [
            ['nama'=>'Budi Santoso','peran'=>'Mahasiswa','bintang'=>5,'pesan'=>'Sistem antreannya sangat membantu! Tidak perlu nunggu lama di klinik, bisa pantau dari HP.'],
            ['nama'=>'Dr. Sari Wulandari','peran'=>'Dokter','bintang'=>5,'pesan'=>'Input rekam medis jadi jauh lebih efisien. Dashboard-nya clean dan mudah digunakan.'],
            ['nama'=>'Agus Prayogo','peran'=>'Karyawan UNS','bintang'=>4,'pesan'=>'Pendaftaran BPJS online sangat memudahkan. Tidak perlu repot datang pagi-pagi ke klinik.'],
        ]; @endphp
        @foreach($testimonials as $t)
        <div class="clay p-6">
            <div class="flex gap-1 mb-4">
                @for($i=0;$i<$t['bintang'];$i++)<span class="text-amber-400 text-xl">★</span>@endfor
                @for($i=$t['bintang'];$i<5;$i++)<span class="text-slate-200 text-xl">★</span>@endfor
            </div>
            <p class="text-slate-600 leading-relaxed mb-5 italic">"{{ $t['pesan'] }}"</p>
            <div class="flex items-center gap-3">
                <div class="clay-blue w-10 h-10 flex items-center justify-center font-black text-white" style="border-radius:12px;box-shadow:0 3px 0 #3730A3;font-size:1.1rem;">{{ substr($t['nama'],0,1) }}</div>
                <div>
                    <div class="font-black text-slate-800 text-sm">{{ $t['nama'] }}</div>
                    <div class="text-xs text-slate-400 font-bold">{{ $t['peran'] }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- CTA FINAL -->
<section class="relative z-10 max-w-7xl mx-auto px-4 py-8 pb-16">
    <div class="clay-dark p-12 text-center relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="blob w-64 h-64 bg-indigo-400 -top-20 -left-10"></div>
            <div class="blob w-48 h-48 bg-violet-400 -bottom-10 -right-10"></div>
        </div>
        <div class="relative z-10">
            <div class="text-5xl mb-4">🏥</div>
            <h2 class="text-3xl md:text-4xl font-black text-white mb-4">Siap Mulai?</h2>
            <p class="text-indigo-200 text-lg mb-8 max-w-md mx-auto">Daftar sekarang dan rasakan kemudahan layanan kesehatan digital Klinik Sehat.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="/register" class="btn-clay btn-primary text-lg">Daftar Gratis Sekarang →</a>
                <a href="{{ route('rating.index') }}" class="btn-clay btn-white text-lg">Lihat Rating Klinik</a>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="relative z-10 text-center py-8 text-slate-400 text-sm font-medium">
    <div class="flex items-center justify-center gap-2 mb-2">
        <div class="clay-blue w-6 h-6 flex items-center justify-center" style="border-radius:8px;box-shadow:0 3px 0 #3730A3;">
            <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        </div>
        <span>Klinik Sehat</span>
    </div>
    &copy; {{ date('Y') }} Sistem Manajemen Klinik Sehat — Tim semogasehatselalu
</footer>

</body>
</html>
