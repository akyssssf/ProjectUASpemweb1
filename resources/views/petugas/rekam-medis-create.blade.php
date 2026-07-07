<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Rekam Medis — Klinik Sehat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700;800&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; font-family: 'DM Sans', sans-serif; }
        body { margin: 0; min-height: 100vh; background: #EEF5FF; color: #1E293B; overflow-x: hidden; }
        .bg-mesh { position: fixed; inset: 0; z-index: 0; pointer-events: none; background: radial-gradient(ellipse 42% 46% at 86% 88%, rgba(103,232,249,.22), transparent 65%), radial-gradient(ellipse 52% 50% at 8% 8%, rgba(96,165,250,.18), transparent 62%), linear-gradient(180deg,#F8FBFF 0%,#EEF5FF 100%); }
        .top-nav { background: linear-gradient(135deg,#172E7A,#2349A8,#0875A6); box-shadow: 0 12px 32px rgba(30,58,138,.24); }
        .nav-inner { max-width: 1200px; margin: 0 auto; height: 64px; padding: 0 20px; display: flex; align-items: center; justify-content: space-between; gap: 16px; }
        .hero { background: linear-gradient(135deg,#2546A3,#2563EB); border: 2px solid #3B82F6; border-radius: 28px; box-shadow: 0 10px 0 #1D4ED8, 0 22px 46px rgba(37,99,235,.25); overflow: hidden; }
        .hero::after { content: ''; position: absolute; width: 260px; height: 260px; right: -42px; top: -70px; border-radius: 999px; background: rgba(255,255,255,.11); }
        .card { background: #fff; border: 1.5px solid rgba(255,255,255,.9); border-radius: 24px; box-shadow: 8px 8px 24px rgba(99,149,210,.16), inset 3px 3px 8px rgba(255,255,255,.85), inset -3px -3px 8px rgba(180,210,245,.22); }
        .btn { border: 0; border-radius: 16px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-weight: 800; text-decoration: none; transition: transform .15s ease; }
        .btn:hover { transform: translateY(-1px); }
        .btn-blue { background: linear-gradient(135deg,#1D4ED8,#2563EB); color: white; box-shadow: 0 6px 0 #1E40AF; }
        .btn-white { background: white; color: #1D4ED8; border: 1.5px solid #BFDBFE; box-shadow: 0 5px 0 #C7D2FE; }
        
        .textarea-soap { width: 100%; padding: 16px; border-radius: 16px; border: 2px solid #E2E8F0; background: #F8FAFC; font-size: 0.95rem; font-weight: 600; color: #1E293B; outline: none; transition: all 0.2s; resize: none; min-height: 120px; }
        .textarea-soap:focus { border-color: #3B82F6; box-shadow: 0 0 0 3px rgba(59,130,246,.12); background: #fff; }
        h1, h2, h3 { font-family: 'Sora', sans-serif; letter-spacing: 0; }
        
        .icon-box { width: 36px; height: 36px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 900; color: white; font-size: 1rem; }
        .icon-box.s { background: linear-gradient(135deg,#6366F1,#4F46E5); box-shadow: 0 3px 0 #3730A3; }
        .icon-box.o { background: linear-gradient(135deg,#10B981,#059669); box-shadow: 0 3px 0 #047857; }
        .icon-box.a { background: linear-gradient(135deg,#F59E0B,#D97706); box-shadow: 0 3px 0 #B45309; }
        .icon-box.p { background: linear-gradient(135deg,#8B5CF6,#7C3AED); box-shadow: 0 3px 0 #5B21B6; }

        @media (max-width: 768px) { .nav-inner { height: auto; min-height: 64px; flex-wrap: wrap; padding: 12px 16px; } .hero { border-radius: 22px; } }
    </style>
</head>
<body>
<div class="bg-mesh"></div>

<nav class="top-nav relative z-10">
    <div class="nav-inner">
        <a href="{{ route('dokter.dashboard') }}" class="flex items-center gap-3 no-underline">
            <img src="https://uns.ac.id/id/wp-content/uploads/2023/06/logo-uns-biru.png" alt="UNS" class="h-9 object-contain" style="filter:drop-shadow(0 2px 8px rgba(255,255,255,.25))">
            <div>
                <p class="text-white font-black leading-tight">Klinik Sehat</p>
                <p class="text-blue-200 text-xs font-semibold">Portal Dokter</p>
            </div>
        </a>
        <div class="flex items-center gap-3">
            <span class="hidden sm:inline-flex" style="background:rgba(255,255,255,.12);color:#DBEAFE;border:1px solid rgba(255,255,255,.22); border-radius:999px; padding:6px 12px; font-size:.74rem; font-weight:800;">
                {{ Auth::guard('staff')->user()->name }}
            </span>
        </div>
    </div>
</nav>

<main class="relative z-10 max-w-4xl mx-auto px-4 py-8 md:py-10">
    <!-- Header -->
    <section class="hero relative p-6 md:p-8 mb-8 flex justify-between items-start gap-4">
        <div class="relative z-10">
            <p class="text-blue-100 text-xs font-black uppercase tracking-widest mb-1">Input Rekam Medis</p>
            <h1 class="text-3xl md:text-4xl font-black text-white leading-tight mb-2">🩺 {{ $pasien->name }}</h1>
            <p class="text-blue-100 font-bold text-sm md:text-base">Antrean #{{ $antrian->nomor_antrian }} · {{ $antrian->poli }}</p>
        </div>
        <a href="{{ route('dokter.dashboard') }}" class="btn btn-white px-5 py-3 relative z-10 hidden md:inline-flex">← Batal</a>
    </section>

    <!-- Mobile Batal Button -->
    <div class="mb-6 md:hidden">
        <a href="{{ route('dokter.dashboard') }}" class="btn btn-white px-5 py-3 w-full">← Batal</a>
    </div>

    <!-- Form SOAP -->
    <div class="card p-6 md:p-8">
        <form action="{{ route('rekam_medis.store') }}" method="POST">
            @csrf
            <input type="hidden" name="antrian_id" value="{{ $antrian->id }}">

            <p class="text-xs font-black text-blue-500 uppercase tracking-widest mb-6">Format SOAP</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Subjective -->
                <div>
                    <label class="flex items-center gap-3 text-sm font-black text-slate-700 mb-3">
                        <span class="icon-box s">S</span>
                        Subjective (Keluhan Pasien)
                    </label>
                    <textarea name="subjective" class="textarea-soap focus:border-indigo-500 focus:ring-indigo-500" placeholder="Pasien mengeluh pusing sejak 2 hari yang lalu..." required></textarea>
                </div>

                <!-- Objective -->
                <div>
                    <label class="flex items-center gap-3 text-sm font-black text-slate-700 mb-3">
                        <span class="icon-box o">O</span>
                        Objective (Hasil Pemeriksaan)
                    </label>
                    <textarea name="objective" class="textarea-soap focus:border-emerald-500 focus:ring-emerald-500" placeholder="TD: 120/80, Nadi: 80x/mnt, Suhu: 36.5°C..." required></textarea>
                </div>

                <!-- Assessment -->
                <div>
                    <label class="flex items-center gap-3 text-sm font-black text-slate-700 mb-3">
                        <span class="icon-box a">A</span>
                        Assessment (Diagnosa)
                    </label>
                    <textarea name="assessment" class="textarea-soap focus:border-amber-500 focus:ring-amber-500" placeholder="Diagnosa medis berdasarkan pemeriksaan..." required></textarea>
                </div>

                <!-- Plan -->
                <div>
                    <label class="flex items-center gap-3 text-sm font-black text-slate-700 mb-3">
                        <span class="icon-box p">P</span>
                        Plan (Rencana Pengobatan)
                    </label>
                    <textarea name="plan" class="textarea-soap focus:border-purple-500 focus:ring-purple-500" placeholder="Resep obat, tindakan lanjutan, edukasi pasien..." required></textarea>
                </div>
            </div>

            <div class="mt-8 pt-6 flex justify-end" style="border-top: 2px solid #F1F5F9;">
                <button type="submit" class="btn btn-blue text-base" style="padding: 16px 40px; font-size: 1.05rem;">
                    💾 Simpan Rekam Medis
                </button>
            </div>
        </form>
    </div>
</main>
</body>
</html>
