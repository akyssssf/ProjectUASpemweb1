<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Petugas — Klinik Sehat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700;800&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; font-family: 'DM Sans', sans-serif; }
        body { margin: 0; min-height: 100vh; background: #EEF5FF; color: #1E293B; overflow-x: hidden; }
        .bg-mesh { position: fixed; inset: 0; z-index: 0; pointer-events: none; background: radial-gradient(ellipse 42% 46% at 86% 88%, rgba(103,232,249,.22), transparent 65%), radial-gradient(ellipse 52% 50% at 8% 8%, rgba(96,165,250,.18), transparent 62%), linear-gradient(180deg,#F8FBFF 0%,#EEF5FF 100%); }
        .top-nav { background: linear-gradient(135deg,#172E7A,#2349A8,#0875A6); box-shadow: 0 12px 32px rgba(30,58,138,.24); }
        .nav-inner { max-width: 1240px; margin: 0 auto; min-height: 64px; padding: 0 20px; display: flex; align-items: center; justify-content: space-between; gap: 16px; }
        .hero { background: linear-gradient(135deg,#2546A3,#2563EB); border: 2px solid #3B82F6; border-radius: 28px; box-shadow: 0 10px 0 #1D4ED8, 0 22px 46px rgba(37,99,235,.25); overflow: hidden; }
        .hero::after { content: ''; position: absolute; width: 280px; height: 280px; right: -44px; top: -86px; border-radius: 999px; background: rgba(255,255,255,.11); }
        .card { background: #fff; border: 1.5px solid rgba(255,255,255,.9); border-radius: 24px; box-shadow: 8px 8px 24px rgba(99,149,210,.16), inset 3px 3px 8px rgba(255,255,255,.85), inset -3px -3px 8px rgba(180,210,245,.22); }
        .soft { background: #F1F8FF; border: 1.5px solid #CFE0FF; border-radius: 16px; }
        .btn { border: 0; border-radius: 16px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-weight: 800; text-decoration: none; transition: transform .15s ease; white-space: nowrap; }
        .btn:hover { transform: translateY(-1px); }
        .btn-blue { background: linear-gradient(135deg,#1D4ED8,#2563EB); color: white; box-shadow: 0 6px 0 #1E40AF; }
        .btn-red { background: linear-gradient(135deg,#EF4444,#DC2626); color: white; box-shadow: 0 6px 0 #B91C1C; }
        .btn-amber { background: linear-gradient(135deg,#F59E0B,#D97706); color: white; box-shadow: 0 6px 0 #B45309; }
        .btn-green { background: linear-gradient(135deg,#10B981,#059669); color: white; box-shadow: 0 6px 0 #047857; }
        .btn-slate { background: linear-gradient(135deg,#475569,#334155); color: white; box-shadow: 0 6px 0 #1E293B; }
        .btn-white { background: white; color: #1D4ED8; border: 1.5px solid #BFDBFE; box-shadow: 0 5px 0 #C7D2FE; }
        .input { width: 100%; background: #F8FBFF; border: 1.5px solid #CFE0FF; border-radius: 14px; outline: none; padding: 11px 14px; font-weight: 700; color: #334155; }
        .input:focus { border-color: #3B82F6; box-shadow: 0 0 0 3px rgba(59,130,246,.12); }
        .pill { display: inline-flex; align-items: center; gap: 7px; border-radius: 999px; padding: 6px 12px; font-size: .74rem; font-weight: 800; }
        .pill-blue { background: #EFF6FF; color: #2563EB; border: 1.5px solid #BFDBFE; }
        .pill-green { background: #ECFDF5; color: #059669; border: 1.5px solid #A7F3D0; }
        .pill-amber { background: #FFFBEB; color: #D97706; border: 1.5px solid #FDE68A; }
        .pill-red { background: #FEF2F2; color: #DC2626; border: 1.5px solid #FECACA; }
        h1, h2, h3 { font-family: 'Sora', sans-serif; letter-spacing: 0; }
        
        .badge-dipanggil { background: #EEF2FF; color: #4F46E5; border: 1.5px solid #C7D2FE; border-radius: 99px; padding: 4px 12px; font-size: 0.7rem; font-weight: 800; animation: pulse 1.5s infinite; }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.7} }
        .scrollbar::-webkit-scrollbar { width: 4px; }
        .scrollbar::-webkit-scrollbar-thumb { background: #C7D2FE; border-radius: 99px; }
        
        @media (max-width: 768px) { .nav-inner { height: auto; flex-wrap: wrap; padding: 12px 16px; } .hero { border-radius: 22px; } }
    </style>
</head>
<body>
<div class="bg-mesh"></div>

<nav class="top-nav relative z-10">
    <div class="nav-inner">
        <a href="#" class="flex items-center gap-3 no-underline">
            <img src="https://uns.ac.id/id/wp-content/uploads/2023/06/logo-uns-biru.png" alt="UNS" class="h-9 object-contain" style="filter:drop-shadow(0 2px 8px rgba(255,255,255,.25))">
            <div>
                <p class="text-white font-black leading-tight">Klinik Sehat</p>
                <p class="text-blue-200 text-xs font-semibold">Panel Kontrol</p>
            </div>
        </a>
        <div class="flex items-center gap-3">
            @if(Auth::guard('staff')->user()->role === 'admin')
            <a href="/petugas/dashboard" class="btn btn-white px-4 py-2.5">Kembali ke Admin</a>
            @endif
            <form action="{{ route('petugas.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-red px-5 py-3">Logout</button>
            </form>
        </div>
    </div>
</nav>

<main class="relative z-10 max-w-7xl mx-auto px-4 py-8 md:py-10">
    <section class="hero relative p-6 md:p-8 mb-8">
        <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div>
                <p class="text-blue-100 text-xs font-black uppercase tracking-widest mb-2">Panel Kontrol</p>
                <h1 class="text-3xl md:text-4xl font-black text-white leading-tight">Manajemen Antrean 🏥</h1>
                <p class="text-blue-100 mt-3 text-base md:text-lg font-semibold">{{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
        </div>
    </section>

    @if(session('success'))
        <div class="card mb-6 p-4 flex items-center gap-3" style="border-color:#A7F3D0;">
            <span class="pill pill-green">Berhasil</span>
            <span class="font-bold text-emerald-700">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="card mb-6 p-4 flex items-center gap-3" style="border-color:#FECACA;">
            <span class="pill pill-red">Gagal</span>
            <span class="font-bold text-red-700">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Ringkasan Semua Antrian Aktif -->
    @if (!$klinikDipilih && $ringkasanAktif->count() > 0)
    <div class="card mb-6 p-5" style="border-color:#FDE68A;">
        <p class="text-xs font-black text-amber-500 uppercase tracking-widest mb-3">
            🔎 Ringkasan Semua Antrian Aktif Hari Ini (untuk testing cepat)
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($ringkasanAktif as $r)
            <a href="/petugas/monitoring?klinik={{ urlencode($r['klinik']) }}&poli={{ urlencode($r['poli']) }}"
               class="soft p-4 block hover:-translate-y-1 transition-transform no-underline">
                <div class="flex justify-between items-start mb-2">
                    <span class="font-black text-slate-800 text-sm">{{ $r['klinik'] }}</span>
                    <span class="pill pill-green">{{ $r['jumlah'] }} antri</span>
                </div>
                <div class="text-xs text-slate-500 font-bold mb-3">{{ $r['poli'] }}</div>
                <div class="text-3xl font-black {{ $r['status'] == 'dipanggil' ? 'text-blue-600' : 'text-amber-500' }}">
                    {{ $r['nomor_dipanggil'] }}
                    <span class="text-[10px] font-bold text-slate-400 block mt-1">
                        {{ $r['status'] == 'dipanggil' ? '(sedang dipanggil)' : '(harus dipanggil)' }}
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Filter Klinik & Poli -->
    <div class="card mb-6 overflow-hidden">
        <form method="GET" action="/petugas/monitoring" class="p-5 flex flex-wrap items-end gap-4 bg-white" id="form-filter">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Klinik / Rumah Sakit</label>
                <select name="klinik" id="filter-klinik" onchange="updateFilterPoli()" class="input">
                    <option value="">Semua Klinik</option>
                    @foreach ($kliniks as $k)
                        <option value="{{ $k->nama }}" {{ $klinikDipilih == $k->nama ? 'selected' : '' }}>{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Poli</label>
                <select name="poli" id="filter-poli" class="input">
                    <option value="">Semua Poli</option>
                    @if ($klinikDipilih)
                        @foreach ($kliniks->firstWhere('nama', $klinikDipilih)?->polis ?? [] as $p)
                            <option value="{{ $p->nama }}" {{ $poliDipilih == $p->nama ? 'selected' : '' }}>{{ $p->nama }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <button type="submit" class="btn btn-green px-5 py-3">🔍 Terapkan Filter</button>
            @if ($klinikDipilih || $poliDipilih)
                <a href="/petugas/monitoring" class="btn btn-slate px-4 py-3">✕ Reset</a>
            @endif
        </form>
        @if ($klinikDipilih)
        <div class="px-5 py-3 bg-blue-50/50 border-t border-blue-50 flex items-center justify-between">
            <span class="text-sm font-bold text-slate-500">
                Menampilkan: <span class="text-blue-600 font-black">{{ $klinikDipilih }}</span>@if($poliDipilih) — <span class="text-blue-600 font-black">{{ $poliDipilih }}</span>@endif
            </span>
        </div>
        @endif
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- Antrean Berjalan -->
        <div class="xl:col-span-2">
            <div class="card overflow-hidden">
                <div class="p-5 border-b border-blue-50 flex justify-between items-center bg-white">
                    <h2 class="text-lg font-black text-slate-800">⚡ Antrean Berjalan</h2>
                    <span class="pill pill-green">{{ $antrianAktif->count() }} Aktif</span>
                </div>

                <div class="overflow-x-auto bg-white">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-blue-50/30 border-b border-blue-50">
                                <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">No.</th>
                                <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Pasien</th>
                                <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Klinik / Poli</th>
                                <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Dokter</th>
                                <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-50">
                            @forelse ($antrianAktif as $row)
                            <tr class="hover:bg-blue-50/20 transition-colors">
                                <td class="px-6 py-5">
                                    <span class="text-3xl font-black {{ $row->status == 'dipanggil' ? 'text-blue-600' : 'text-slate-300' }}">
                                        {{ $row->nomor_antrian }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="font-black text-slate-800">{{ $row->pendaftaran->pasien->name ?? '—' }}</div>
                                    @if($row->status == 'dipanggil')
                                        <div class="mt-2"><span class="badge-dipanggil">📢 Dipanggil</span></div>
                                    @else
                                        <div class="mt-2"><span class="pill pill-amber">⏳ Menunggu</span></div>
                                    @endif
                                </td>
                                <td class="px-6 py-5">
                                    <div class="text-sm font-black text-blue-600 mb-1">{{ $row->klinik }}</div>
                                    <div class="text-xs text-slate-500 font-bold uppercase tracking-wide">{{ $row->poli }}</div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="text-sm font-bold text-slate-600">{{ $row->pendaftaran->dokter ?? '—' }}</div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    @if($row->status == 'menunggu')
                                        <form method="POST" action="{{ route('monitoring.panggil', $row->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="btn btn-green px-4 py-2.5">PANGGIL</button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('monitoring.selesai', $row->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="btn btn-slate px-4 py-2.5">SELESAI</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-16 text-center">
                                    <div class="text-5xl mb-3">✅</div>
                                    <p class="text-slate-400 font-bold">
                                        @if ($klinikDipilih)
                                            Tidak ada antrean aktif untuk filter ini.
                                        @else
                                            Semua antrean telah terlayani.
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar: Riwayat -->
        <div>
            <div class="card overflow-hidden h-full flex flex-col">
                <div class="p-5 border-b border-blue-50 bg-blue-50/50">
                    <span class="text-blue-700 font-black text-lg">📋 Riwayat Selesai</span>
                </div>
                <div class="overflow-y-auto flex-1 p-0 scrollbar bg-white" style="max-height: 500px;">
                    <div class="divide-y divide-blue-50">
                        @forelse ($riwayatSelesai as $row)
                        <div class="p-5 hover:bg-blue-50/20 transition-colors">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-2xl font-black text-slate-300">#{{ $row->nomor_antrian }}</span>
                                <span class="pill pill-blue">{{ $row->updated_at->format('H:i') }}</span>
                            </div>
                            <div class="font-black text-slate-800 mb-1">{{ $row->pendaftaran->pasien->name ?? '—' }}</div>
                            <div class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">{{ $row->klinik }} — {{ $row->poli }}</div>
                            <div class="text-xs text-slate-400 font-bold">Dokter: {{ $row->pendaftaran->dokter ?? '—' }}</div>
                        </div>
                        @empty
                        <div class="py-12 px-6 text-center text-slate-400 text-sm font-bold">Belum ada riwayat hari ini.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    const dataKliniks = @json($kliniks->mapWithKeys(fn($k) => [$k->nama => $k->polis->pluck('nama')]));

    function updateFilterPoli() {
        const klinik = document.getElementById('filter-klinik').value;
        const poliSelect = document.getElementById('filter-poli');
        poliSelect.innerHTML = '<option value="">Semua Poli</option>';
        if (klinik && dataKliniks[klinik]) {
            dataKliniks[klinik].forEach(nama => {
                poliSelect.innerHTML += `<option value="${nama}">${nama}</option>`;
            });
        }
    }

    let reloadTimer = null;
    function mulaiAutoReload() {
        if (reloadTimer) clearInterval(reloadTimer);
        // Refresh tiap 5 detik (sekarang sudah aman dari bug bentrok)
        reloadTimer = setInterval(() => { window.location.reload(); }, 5000);
    }
    function jedaAutoReload() {
        if (reloadTimer) clearInterval(reloadTimer);
        reloadTimer = null;
    }

    // Jeda auto-reload saat filter diubah
    const filterKlinik = document.getElementById('filter-klinik');
    const filterPoli = document.getElementById('filter-poli');
    [filterKlinik, filterPoli].forEach(el => {
        el.addEventListener('focus', jedaAutoReload);
        el.addEventListener('change', jedaAutoReload);
        el.addEventListener('blur', () => setTimeout(mulaiAutoReload, 8000));
    });

    // KUNCI: Jeda auto-reload saat tombol ditekan!
    // Jika timer meledak berbarengan saat form disubmit, browser akan membatalkan request Panggil
    // sehingga terkesan lola/tidak merespon.
    document.querySelectorAll('form').forEach(f => {
        f.addEventListener('submit', jedaAutoReload);
    });

    mulaiAutoReload();
</script>
</body>
</html>
