<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Klinik Sehat</title>
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
        .btn-white { background: white; color: #1D4ED8; border: 1.5px solid #BFDBFE; box-shadow: 0 5px 0 #C7D2FE; }
        .input { width: 100%; background: #F8FBFF; border: 1.5px solid #CFE0FF; border-radius: 14px; outline: none; padding: 11px 14px; font-weight: 700; color: #334155; }
        .input:focus { border-color: #3B82F6; box-shadow: 0 0 0 3px rgba(59,130,246,.12); }
        .pill { display: inline-flex; align-items: center; gap: 7px; border-radius: 999px; padding: 6px 12px; font-size: .74rem; font-weight: 800; }
        .pill-blue { background: #EFF6FF; color: #2563EB; border: 1.5px solid #BFDBFE; }
        .pill-green { background: #ECFDF5; color: #059669; border: 1.5px solid #A7F3D0; }
        .pill-amber { background: #FFFBEB; color: #D97706; border: 1.5px solid #FDE68A; }
        .pill-red { background: #FEF2F2; color: #DC2626; border: 1.5px solid #FECACA; }
        h1, h2, h3 { font-family: 'Sora', sans-serif; letter-spacing: 0; }
        .pager-compact { display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
        .pager-meta { font-size: .86rem; font-weight: 800; color: #64748B; }
        .pager-actions { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .pager-btn { min-width: 42px; height: 40px; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.25rem; line-height: 1; font-weight: 900; text-decoration: none; border: 1.5px solid #BFDBFE; background: #fff; color: #2563EB; box-shadow: 0 4px 0 #DBEAFE; }
        .pager-btn.disabled { opacity: .45; pointer-events: none; }
        .pager-page { min-height: 40px; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; padding: 0 12px; font-size: .82rem; font-weight: 900; color: #1E293B; background: #F8FBFF; border: 1.5px solid #CFE0FF; white-space: nowrap; }
        @media (max-width: 768px) { .nav-inner { height: auto; flex-wrap: wrap; padding: 12px 16px; } .hero { border-radius: 22px; } }
    </style>
</head>
<body>
<div class="bg-mesh"></div>

<nav class="top-nav relative z-10">
    <div class="nav-inner">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 no-underline">
            <img src="https://uns.ac.id/id/wp-content/uploads/2023/06/logo-uns-biru.png" alt="UNS" class="h-9 object-contain" style="filter:drop-shadow(0 2px 8px rgba(255,255,255,.25))">
            <div>
                <p class="text-white font-black leading-tight">Klinik Sehat</p>
                <p class="text-blue-200 text-xs font-semibold">Portal Admin</p>
            </div>
        </a>
        <div class="flex items-center gap-3">
            <a href="/petugas/monitoring" class="btn btn-amber px-4 py-2.5">Buka Layar Monitoring</a>
            <a href="{{ route('staff.register') }}" class="btn btn-white px-4 py-2.5">Tambah Staf</a>
            <form action="{{ route('petugas.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-red px-5 py-3">Logout</button>
            </form>
        </div>
    </div>
</nav>

<main class="relative z-10 max-w-7xl mx-auto px-4 py-8 md:py-10">
    <section class="hero relative p-6 md:p-8 mb-8">
        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-[1.1fr_.9fr] gap-6 items-center">
            <div>
                <p class="text-blue-100 text-xs font-black uppercase tracking-widest mb-2">Dashboard Admin</p>
                <h1 class="text-3xl md:text-4xl font-black text-white leading-tight">Kelola Operasional Klinik</h1>
                <p class="text-blue-100 mt-3 text-base md:text-lg font-semibold">Ringkasan staff, pasien, fasilitas, dan antrean aktif dalam satu tempat.</p>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-white/95 rounded-2xl p-4">
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Admin</p>
                    <p class="text-3xl font-black text-blue-600 mt-1">{{ $summary['admin'] }}</p>
                </div>
                <div class="bg-white/95 rounded-2xl p-4">
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Dokter</p>
                    <p class="text-3xl font-black text-emerald-600 mt-1">{{ $summary['dokter'] }}</p>
                </div>
                <div class="bg-white/95 rounded-2xl p-4">
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Pasien</p>
                    <p class="text-3xl font-black text-violet-600 mt-1">{{ $summary['pasien'] }}</p>
                </div>
                <div class="bg-white/95 rounded-2xl p-4">
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Antrean Aktif</p>
                    <p class="text-3xl font-black text-amber-500 mt-1">{{ $summary['antrian_aktif'] }}</p>
                </div>
            </div>
        </div>
    </section>

    @if(session('success'))
        <div class="card mb-6 p-4 flex items-center gap-3" style="border-color:#A7F3D0;">
            <span class="pill pill-green">Berhasil</span>
            <span class="font-bold text-emerald-700">{{ session('success') }}</span>
        </div>
    @endif

    @if($summary['inactive_roles'] > 0)
        <div class="card mb-6 p-4 flex flex-wrap items-center justify-between gap-3" style="border-color:#FDE68A;">
            <div>
                <p class="font-black text-slate-800">Ada {{ $summary['inactive_roles'] }} staff dengan role lama.</p>
                <p class="text-sm text-slate-500 font-semibold">Role aktif sekarang hanya Admin dan Dokter. Edit staff lama untuk menyesuaikan.</p>
            </div>
            <span class="pill pill-amber">Perlu dirapikan</span>
        </div>
    @endif

    <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <div class="card overflow-hidden">
            <div class="p-5 md:p-6 border-b border-blue-50 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="text-lg font-black text-slate-800">Daftar Staff</h2>
                    <p class="text-sm text-slate-400 font-semibold">Hanya role yang aktif: admin dan dokter.</p>
                </div>
                <a href="{{ route('staff.register') }}" class="btn btn-blue px-4 py-2.5">Tambah</a>
            </div>

            <form method="GET" action="{{ route('admin.dashboard') }}" class="p-5 grid grid-cols-1 md:grid-cols-[1fr_150px_auto_auto] gap-3 border-b border-blue-50">
                <input type="text" name="staff_name" value="{{ request('staff_name') }}" placeholder="Cari nama staff..." class="input">
                <select name="staff_role" class="input">
                    <option value="">Semua Role</option>
                    <option value="admin" @selected(request('staff_role') === 'admin')>Admin</option>
                    <option value="dokter" @selected(request('staff_role') === 'dokter')>Dokter</option>
                </select>
                <button type="submit" class="btn btn-blue px-4 py-2.5">Cari</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-white px-4 py-2.5">Reset</a>
            </form>

            <div class="divide-y divide-blue-50">
                @forelse($allStaff as $staff)
                    <div class="p-5 grid grid-cols-1 md:grid-cols-[1fr_auto] gap-4 items-center hover:bg-blue-50/30">
                        <div>
                            <div class="flex flex-wrap items-center gap-2">
                                <p class="font-black text-slate-800">{{ $staff->name }}</p>
                                <span class="pill {{ $staff->role === 'admin' ? 'pill-blue' : ($staff->role === 'dokter' ? 'pill-green' : 'pill-amber') }}">{{ $staff->role }}</span>
                            </div>
                            <p class="text-sm text-slate-500 font-semibold mt-1">{{ $staff->email }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-amber px-4 py-2.5">Edit</a>
                            <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('Hapus staf ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-red px-4 py-2.5">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-10 text-center">
                        <p class="font-black text-slate-700">Tidak ada staff sesuai filter.</p>
                    </div>
                @endforelse
            </div>

            <div class="pager-compact p-5 border-t border-blue-50">
                <div class="pager-meta">
                    Menampilkan {{ $allStaff->firstItem() ?? 0 }}-{{ $allStaff->lastItem() ?? 0 }} dari {{ $allStaff->total() }} staff
                </div>
                <div class="pager-actions">
                    @if($allStaff->onFirstPage())
                        <span class="pager-btn disabled" aria-hidden="true">&lsaquo;</span>
                    @else
                        <a class="pager-btn" href="{{ $allStaff->previousPageUrl() }}" aria-label="Halaman staff sebelumnya">&lsaquo;</a>
                    @endif
                    <span class="pager-page">Hal {{ $allStaff->currentPage() }} / {{ $allStaff->lastPage() }}</span>
                    @if($allStaff->hasMorePages())
                        <a class="pager-btn" href="{{ $allStaff->nextPageUrl() }}" aria-label="Halaman staff berikutnya">&rsaquo;</a>
                    @else
                        <span class="pager-btn disabled" aria-hidden="true">&rsaquo;</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="card overflow-hidden">
            <div class="p-5 md:p-6 border-b border-blue-50 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="text-lg font-black text-slate-800">Daftar Pasien</h2>
                    <p class="text-sm text-slate-400 font-semibold">Data terbaru, ringkas, dan bisa difilter.</p>
                </div>
                <span class="pill pill-blue">{{ $summary['pasien'] }} pasien</span>
            </div>

            <form method="GET" action="{{ route('admin.dashboard') }}" class="p-5 grid grid-cols-1 md:grid-cols-[1fr_160px_auto_auto] gap-3 border-b border-blue-50">
                <input type="text" name="pasien_name" value="{{ request('pasien_name') }}" placeholder="Cari nama pasien..." class="input">
                <input type="text" name="pasien_nik" value="{{ request('pasien_nik') }}" placeholder="Cari NIK..." class="input">
                <button type="submit" class="btn btn-blue px-4 py-2.5">Cari</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-white px-4 py-2.5">Reset</a>
            </form>

            <div class="divide-y divide-blue-50">
                @forelse($allPasien as $pasien)
                    <div class="p-5 grid grid-cols-1 md:grid-cols-[1fr_auto] gap-4 items-center hover:bg-blue-50/30">
                        <div>
                            <p class="font-black text-slate-800">{{ $pasien->name }}</p>
                            <div class="mt-1 flex flex-wrap gap-2 text-sm font-semibold text-slate-500">
                                <span>{{ $pasien->email }}</span>
                                <span>•</span>
                                <span>NIK {{ $pasien->nik }}</span>
                            </div>
                            <div class="mt-2 flex flex-wrap gap-2">
                                <span class="pill pill-blue">{{ $pasien->no_hp ?? 'No HP kosong' }}</span>
                                <span class="pill pill-green">{{ $pasien->medical_records_count }} rekam medis</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-amber px-4 py-2.5">Edit</a>
                            <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" onsubmit="return confirm('Hapus pasien ini? Seluruh riwayat & rekam medisnya juga akan terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-red px-4 py-2.5">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-10 text-center">
                        <p class="font-black text-slate-700">Tidak ada pasien sesuai filter.</p>
                    </div>
                @endforelse
            </div>

            <div class="pager-compact p-5 border-t border-blue-50">
                <div class="pager-meta">
                    Menampilkan {{ $allPasien->firstItem() ?? 0 }}-{{ $allPasien->lastItem() ?? 0 }} dari {{ $allPasien->total() }} pasien
                </div>
                <div class="pager-actions">
                    @if($allPasien->onFirstPage())
                        <span class="pager-btn disabled" aria-hidden="true">&lsaquo;</span>
                    @else
                        <a class="pager-btn" href="{{ $allPasien->previousPageUrl() }}" aria-label="Halaman pasien sebelumnya">&lsaquo;</a>
                    @endif
                    <span class="pager-page">Hal {{ $allPasien->currentPage() }} / {{ $allPasien->lastPage() }}</span>
                    @if($allPasien->hasMorePages())
                        <a class="pager-btn" href="{{ $allPasien->nextPageUrl() }}" aria-label="Halaman pasien berikutnya">&rsaquo;</a>
                    @else
                        <span class="pager-btn disabled" aria-hidden="true">&rsaquo;</span>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>
