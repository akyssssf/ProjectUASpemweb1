<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Petugas — Klinik Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #EEF2FF; }
        .clay { background: white; border-radius: 24px; box-shadow: 0 8px 0 0 #C7D2FE, 0 12px 32px rgba(99,102,241,0.10); border: 2px solid #E0E7FF; }
        .clay-blue { background: linear-gradient(135deg, #6366F1, #4F46E5); border-radius: 20px; box-shadow: 0 6px 0 #3730A3; border: 2px solid #818CF8; }
        .clay-dark { background: linear-gradient(135deg, #1E1B4B, #312E81); border-radius: 24px; box-shadow: 0 8px 0 #0F0A2E; border: 2px solid #4338CA; }
        .clay-green { background: linear-gradient(135deg, #10B981, #059669); border-radius: 20px; box-shadow: 0 6px 0 #047857; }
        .clay-amber { background: linear-gradient(135deg, #F59E0B, #D97706); border-radius: 20px; box-shadow: 0 6px 0 #B45309; }
        .btn-clay { display: inline-block; padding: 10px 24px; border-radius: 14px; font-weight: 800; font-size: 0.85rem; transition: all 0.15s ease; position: relative; top: 0; cursor: pointer; }
        .btn-clay:active { top: 3px; }
        .btn-green { background: linear-gradient(135deg, #10B981, #059669); color: white; box-shadow: 0 5px 0 #047857; }
        .btn-green:hover { transform: translateY(-1px); }
        .btn-slate { background: linear-gradient(135deg, #475569, #334155); color: white; box-shadow: 0 5px 0 #1E293B; }
        .btn-slate:hover { transform: translateY(-1px); }
        .btn-danger { background: linear-gradient(135deg, #EF4444, #DC2626); color: white; box-shadow: 0 5px 0 #B91C1C; }
        .btn-white { background: white; color: #4F46E5; box-shadow: 0 5px 0 #C7D2FE; border: 2px solid #E0E7FF; }
        .badge-menunggu { background: #FFFBEB; color: #D97706; border: 1.5px solid #FDE68A; border-radius: 99px; padding: 4px 12px; font-size: 0.7rem; font-weight: 800; }
        .badge-dipanggil { background: #EEF2FF; color: #4F46E5; border: 1.5px solid #C7D2FE; border-radius: 99px; padding: 4px 12px; font-size: 0.7rem; font-weight: 800; animation: pulse 1.5s infinite; }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.7} }
        .blob { position: absolute; border-radius: 50%; filter: blur(60px); opacity: 0.15; pointer-events: none; }
        .scrollbar::-webkit-scrollbar { width: 4px; }
        .scrollbar::-webkit-scrollbar-thumb { background: #C7D2FE; border-radius: 99px; }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8 relative overflow-x-hidden">

    <div class="blob w-96 h-96 bg-indigo-400 -top-20 -left-20"></div>
    <div class="blob w-72 h-72 bg-blue-300 top-1/2 -right-20"></div>

    <div class="max-w-7xl mx-auto relative z-10">

        <!-- Header -->
        <div class="clay-dark p-6 md:p-8 mb-8 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-64 h-64 rounded-full" style="background:rgba(255,255,255,0.06);transform:translate(30%,-30%);"></div>
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-5">
                <div>
                    <p class="text-indigo-300 text-xs font-black uppercase tracking-widest mb-1">Panel Kontrol</p>
                    <h1 class="text-3xl font-black text-white">Manajemen Antrean 🏥</h1>
                    <p class="text-indigo-300 mt-1 font-medium">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="/display" target="_blank" class="btn-clay btn-white">📺 Buka Display</a>
                    <form method="POST" action="/petugas/logout" class="inline">
                        @csrf
                        <button type="submit" class="btn-clay btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Antrean Berjalan -->
            <div class="lg:col-span-2">
                <div class="clay overflow-hidden">
                    <div class="px-8 py-6 flex justify-between items-center" style="border-bottom:2px solid #EEF2FF;">
                        <h2 class="text-lg font-black text-slate-800">⚡ Antrean Berjalan</h2>
                        <span class="text-xs font-black px-4 py-2 rounded-full" style="background:#ECFDF5;color:#059669;border:1.5px solid #A7F3D0;">
                            {{ $antrianAktif->count() }} Aktif
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr style="background:#F8FAFF;border-bottom:2px solid #EEF2FF;">
                                    <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest">No.</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest">Pasien</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest">Poli</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($antrianAktif as $row)
                                <tr style="border-bottom:2px solid #EEF2FF;" class="hover:bg-indigo-50/40 transition-colors">
                                    <td class="px-6 py-5">
                                        <span class="text-4xl font-black {{ $row->status == 'dipanggil' ? 'text-indigo-600' : 'text-slate-300' }}">
                                            {{ $row->nomor_antrian }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="font-black text-slate-800">{{ $row->pendaftaran->pasien->name ?? '—' }}</div>
                                        @if($row->status == 'dipanggil')
                                            <span class="badge-dipanggil mt-1 inline-block">📢 Dipanggil</span>
                                        @else
                                            <span class="badge-menunggu mt-1 inline-block">⏳ Menunggu</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-xs font-black px-3 py-1.5 rounded-xl" style="background:#EEF2FF;color:#4F46E5;">{{ $row->poli }}</span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @if($row->status == 'menunggu')
                                            <a href="/petugas/monitoring/panggil/{{ $row->id }}" class="btn-clay btn-green">PANGGIL</a>
                                        @else
                                            <a href="/petugas/monitoring/selesai/{{ $row->id }}" class="btn-clay btn-slate">SELESAI</a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-16 text-center">
                                        <div class="text-5xl mb-3">✅</div>
                                        <p class="text-slate-400 font-bold">Semua antrean telah terlayani.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar: Riwayat + Info -->
            <div class="space-y-6">

                <!-- Riwayat Selesai -->
                <div class="clay overflow-hidden">
                    <div class="clay-blue px-6 py-4 flex items-center gap-2">
                        <span class="text-white font-black">📋 Riwayat Selesai</span>
                    </div>
                    <div class="overflow-y-auto max-h-80 scrollbar">
                        @forelse ($riwayatSelesai as $row)
                        <div class="px-6 py-4 hover:bg-indigo-50/40 transition-colors" style="border-bottom:2px solid #EEF2FF;">
                            <div class="flex justify-between items-start">
                                <span class="text-2xl font-black text-slate-200">#{{ $row->nomor_antrian }}</span>
                                <span class="text-[10px] font-black px-2 py-1 rounded-lg" style="background:#EEF2FF;color:#6366F1;">{{ $row->updated_at->format('H:i') }}</span>
                            </div>
                            <div class="font-black text-slate-700 text-sm mt-1">{{ $row->pendaftaran->pasien->name ?? '—' }}</div>
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">{{ $row->poli }}</div>
                        </div>
                        @empty
                        <div class="py-10 text-center text-slate-400 text-sm font-bold">Belum ada riwayat hari ini.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Tips -->
                <div class="clay-blue p-6 text-center">
                    <div class="text-3xl mb-2">💡</div>
                    <p class="text-white font-black text-sm mb-1">Saran Penggunaan</p>
                    <p class="text-indigo-200 text-xs">Aktifkan layar display pasien agar notifikasi suara panggilan berfungsi otomatis.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        setInterval(() => { window.location.reload(); }, 5000);
    </script>
</body>
</html>
