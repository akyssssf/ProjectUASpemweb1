<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter - Klinik Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        .soft { background: #F1F8FF; border: 1.5px solid #CFE0FF; border-radius: 18px; }
        .btn { border: 0; border-radius: 16px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-weight: 800; text-decoration: none; transition: transform .15s ease; }
        .btn:hover { transform: translateY(-1px); }
        .btn-blue { background: linear-gradient(135deg,#1D4ED8,#2563EB); color: white; box-shadow: 0 6px 0 #1E40AF; }
        .btn-red { background: linear-gradient(135deg,#EF4444,#DC2626); color: white; box-shadow: 0 6px 0 #B91C1C; }
        .btn-white { background: white; color: #1D4ED8; border: 1.5px solid #BFDBFE; box-shadow: 0 5px 0 #C7D2FE; }
        .pill { display: inline-flex; align-items: center; gap: 7px; border-radius: 999px; padding: 6px 12px; font-size: .74rem; font-weight: 800; }
        .pill-blue { background: #EFF6FF; color: #2563EB; border: 1.5px solid #BFDBFE; }
        .pill-green { background: #ECFDF5; color: #059669; border: 1.5px solid #A7F3D0; }
        .pill-amber { background: #FFFBEB; color: #D97706; border: 1.5px solid #FDE68A; }
        h1, h2, h3 { font-family: 'Sora', sans-serif; letter-spacing: 0; }
        @media (max-width: 768px) { .nav-inner { height: auto; min-height: 64px; flex-wrap: wrap; padding: 12px 16px; } .hero { border-radius: 22px; } }
    </style>
</head>
<body>
<div class="bg-mesh"></div>

<nav class="top-nav relative z-10">
    <div class="nav-inner">
        <a href="/petugas/dashboard-dokter" class="flex items-center gap-3 no-underline">
            <img src="https://uns.ac.id/id/wp-content/uploads/2023/06/logo-uns-biru.png" alt="UNS" class="h-9 object-contain" style="filter:drop-shadow(0 2px 8px rgba(255,255,255,.25))">
            <div>
                <p class="text-white font-black leading-tight">Klinik Sehat</p>
                <p class="text-blue-200 text-xs font-semibold">Portal Dokter</p>
            </div>
        </a>
        <div class="flex items-center gap-3">
            <span class="hidden sm:inline-flex pill" style="background:rgba(255,255,255,.12);color:#DBEAFE;border:1px solid rgba(255,255,255,.22);">
                {{ $staff->name }}
            </span>
            <form method="POST" action="{{ route('petugas.logout') }}">
                @csrf
                <button type="submit" class="btn btn-red px-5 py-3">Logout</button>
            </form>
        </div>
    </div>
</nav>

<main class="relative z-10 max-w-6xl mx-auto px-4 py-8 md:py-10">
    <section class="hero relative p-6 md:p-8 mb-8">
        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-[1.35fr_.65fr] gap-6 items-center">
            <div>
                <p class="text-blue-100 text-xs font-black uppercase tracking-widest mb-2">Dashboard Dokter</p>
                <h1 class="text-3xl md:text-4xl font-black text-white leading-tight">Halo, {{ $staff->name }}</h1>
                <p class="text-blue-100 mt-3 text-base md:text-lg font-semibold">Pantau pasien dipanggil, konteks poli, dan antrean hari ini dari satu layar.</p>
            </div>
            <div class="soft p-4 bg-white/95">
                <p class="text-xs font-black text-blue-500 uppercase tracking-widest mb-3">Penempatan Praktik</p>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-slate-400 font-bold">Rumah Sakit / Klinik</p>
                        <p class="font-black text-slate-800">{{ $profilDokter?->poli?->klinik?->nama ?? 'Belum terhubung ke data klinik' }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <p class="text-xs text-slate-400 font-bold">Poli</p>
                            <p class="font-black text-slate-800">{{ $profilDokter?->poli?->nama ?? 'Belum ada' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-bold">Tanggal</p>
                            <p class="font-black text-slate-800">{{ now()->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(session('success'))
        <div class="card mb-6 p-4 flex items-center gap-3" style="border-color:#A7F3D0;">
            <span class="text-2xl">OK</span>
            <span class="font-bold text-emerald-700">{{ session('success') }}</span>
        </div>
    @endif

    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="card p-5">
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Dipanggil</p>
            <p class="text-3xl font-black text-blue-600 mt-2">{{ $ringkasan['dipanggil'] }}</p>
        </div>
        <div class="card p-5">
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Menunggu</p>
            <p class="text-3xl font-black text-amber-500 mt-2">{{ $ringkasan['menunggu'] }}</p>
        </div>
        <div class="card p-5">
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Selesai</p>
            <p class="text-3xl font-black text-emerald-600 mt-2">{{ $ringkasan['selesai'] }}</p>
        </div>
        <div class="card p-5">
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Total Hari Ini</p>
            <p class="text-3xl font-black text-slate-800 mt-2">{{ $ringkasan['total_hari_ini'] }}</p>
        </div>
    </section>

    <section class="grid grid-cols-1 xl:grid-cols-[1.3fr_.7fr] gap-6">
        <div class="card overflow-hidden">
            <div class="px-5 md:px-7 py-5 flex flex-wrap items-center justify-between gap-3 border-b border-blue-50">
                <div>
                    <h2 class="text-lg font-black text-slate-800">Pasien Dipanggil</h2>
                    <p class="text-sm text-slate-400 font-semibold">Klik periksa saat pasien sudah masuk ruang dokter.</p>
                </div>
                <span class="pill pill-blue">{{ $antrianDipanggil->count() }} pasien</span>
            </div>

            <div class="divide-y divide-blue-50">
                @forelse($antrianDipanggil as $antrian)
                    <div class="p-5 md:p-6 grid grid-cols-1 md:grid-cols-[140px_1fr_auto] gap-4 items-center hover:bg-blue-50/30">
                        <div>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">No. Antrean</p>
                            <p class="text-4xl font-black text-blue-600">{{ $antrian->nomor_antrian }}</p>
                        </div>
                        <div>
                            <p class="text-xl font-black text-slate-800">{{ $antrian->pendaftaran->pasien->name ?? '-' }}</p>
                            <div class="mt-2 flex flex-wrap gap-2">
                                <span class="pill pill-blue">{{ $antrian->klinik }}</span>
                                <span class="pill pill-green">{{ $antrian->poli }}</span>
                                <span class="pill pill-amber">{{ $antrian->pendaftaran->jenis_pendaftaran ?? '-' }}</span>
                            </div>
                            @if($antrian->pendaftaran?->keluhan)
                                <p class="mt-3 text-sm text-slate-500 font-semibold">Keluhan: {{ $antrian->pendaftaran->keluhan }}</p>
                            @endif
                        </div>
                        <a href="{{ route('rekam_medis.create', $antrian->id) }}" class="btn btn-blue px-5 py-3">Periksa</a>
                    </div>
                @empty
                    <div class="py-16 px-6 text-center">
                        <div class="mx-auto mb-4 w-16 h-16 rounded-2xl flex items-center justify-center text-3xl" style="background:#ECFDF5;color:#059669;border:1.5px solid #A7F3D0;">OK</div>
                        <p class="text-slate-700 font-black">Belum ada pasien yang sedang dipanggil.</p>
                        <p class="text-slate-400 font-semibold mt-1">Pasien akan muncul di sini setelah petugas menekan tombol panggil.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <aside class="card p-5 md:p-6">
            <div class="flex items-center justify-between gap-3 mb-5">
                <div>
                    <h3 class="text-base font-black text-slate-800">Antrean Berikutnya</h3>
                    <p class="text-sm text-slate-400 font-semibold">Preview pasien yang masih menunggu.</p>
                </div>
                <span class="pill pill-amber">{{ $antrianMenunggu->count() }}</span>
            </div>
            <div class="space-y-3">
                @forelse($antrianMenunggu as $row)
                    <div class="soft p-4">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="font-black text-slate-800">{{ $row->nomor_antrian }} - {{ $row->pendaftaran->pasien->name ?? '-' }}</p>
                                <p class="text-xs font-bold text-slate-400 mt-1">{{ $row->poli }} • {{ $row->pendaftaran->jenis_pendaftaran ?? '-' }}</p>
                            </div>
                            <span class="pill pill-amber">Menunggu</span>
                        </div>
                    </div>
                @empty
                    <div class="soft p-5 text-center">
                        <p class="font-black text-slate-700">Tidak ada antrean menunggu untuk dokter ini.</p>
                    </div>
                @endforelse
            </div>
        </aside>
    </section>
</main>

<script>
    let reloadTimer = setInterval(() => { window.location.reload(); }, 15000);

    // Jeda auto-reload saat dokter mengklik tombol "Periksa" atau berinteraksi
    document.querySelectorAll('a, form, button').forEach(el => {
        el.addEventListener('click', () => {
            clearInterval(reloadTimer);
        });
        el.addEventListener('submit', () => {
            clearInterval(reloadTimer);
        });
    });
</script>
</body>
</html>
