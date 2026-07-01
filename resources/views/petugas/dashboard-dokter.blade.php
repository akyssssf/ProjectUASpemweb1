<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter — Klinik Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #EEF2FF; }
        .clay { background: white; border-radius: 24px; box-shadow: 0 8px 0 0 #C7D2FE, 0 12px 32px rgba(99,102,241,0.10); border: 2px solid #E0E7FF; }
        .clay-blue { background: linear-gradient(135deg, #6366F1, #4F46E5); border-radius: 24px; box-shadow: 0 8px 0 #3730A3; border: 2px solid #818CF8; }
        .clay-dark { background: linear-gradient(135deg, #1E1B4B, #312E81); border-radius: 24px; box-shadow: 0 8px 0 #0F0A2E; border: 2px solid #4338CA; }
        .btn-clay { display: inline-block; padding: 10px 24px; border-radius: 14px; font-weight: 800; transition: all 0.15s ease; position: relative; top: 0; }
        .btn-clay:active { top: 3px; }
        .btn-primary { background: linear-gradient(135deg, #6366F1, #4F46E5); color: white; box-shadow: 0 5px 0 #3730A3; }
        .btn-primary:hover { transform: translateY(-1px); }
        .btn-danger { background: linear-gradient(135deg, #EF4444, #DC2626); color: white; box-shadow: 0 5px 0 #B91C1C; }
        .blob { position: absolute; border-radius: 50%; filter: blur(60px); opacity: 0.15; pointer-events: none; }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8 relative overflow-x-hidden">

    <div class="blob w-96 h-96 bg-indigo-400 -top-20 -left-20"></div>
    <div class="blob w-72 h-72 bg-violet-300 bottom-0 right-0"></div>

    <div class="max-w-5xl mx-auto relative z-10">

        <!-- Header -->
        <div class="clay-dark p-6 md:p-8 mb-8 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-56 h-56 rounded-full" style="background:rgba(255,255,255,0.06);transform:translate(30%,-30%);"></div>
            <div class="relative z-10 flex justify-between items-center gap-5">
                <div>
                    <p class="text-indigo-300 text-xs font-black uppercase tracking-widest mb-1">Portal Dokter</p>
                    <h1 class="text-2xl md:text-3xl font-black text-white">Dashboard Dokter 👨‍⚕️</h1>
                    <p class="text-indigo-300 mt-1 font-medium">Antrean pasien yang dipanggil hari ini</p>
                </div>
                <form method="POST" action="{{ route('petugas.logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="btn-clay btn-danger">Logout</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="clay mb-6 p-4 flex items-center gap-3" style="border-color:#A7F3D0;box-shadow:0 6px 0 #A7F3D0;">
                <span class="text-2xl">✅</span>
                <span class="font-bold text-emerald-700">{{ session('success') }}</span>
            </div>
        @endif

        <div class="clay overflow-hidden">
            <div class="px-8 py-6 flex items-center justify-between" style="border-bottom:2px solid #EEF2FF;">
                <h2 class="text-lg font-black text-slate-800">📢 Pasien Dipanggil</h2>
                <span class="text-xs font-black px-4 py-2 rounded-full" style="background:#EEF2FF;color:#4F46E5;border:1.5px solid #C7D2FE;">
                    {{ $antrianDipanggil->count() }} pasien
                </span>
            </div>

            <table class="w-full text-left">
                <thead>
                    <tr style="background:#F8FAFF;border-bottom:2px solid #EEF2FF;">
                        <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest">No. Antrean</th>
                        <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest">Nama Pasien</th>
                        <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest">Poli</th>
                        <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($antrianDipanggil as $antrian)
                    <tr style="border-bottom:2px solid #EEF2FF;" class="hover:bg-indigo-50/40 transition-colors">
                        <td class="px-6 py-5">
                            <span class="text-4xl font-black text-indigo-600">{{ $antrian->nomor_antrian }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="font-black text-slate-800">{{ $antrian->pendaftaran->pasien->name ?? '—' }}</div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="text-xs font-black px-3 py-1.5 rounded-xl" style="background:#EEF2FF;color:#4F46E5;">{{ $antrian->poli }}</span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <a href="{{ route('rekam_medis.create', $antrian->id) }}" class="btn-clay btn-primary">
                                🩺 Periksa Sekarang
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-16 text-center">
                            <div class="text-5xl mb-3">✅</div>
                            <p class="text-slate-400 font-bold">Tidak ada pasien yang dipanggil saat ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        setInterval(() => { window.location.reload(); }, 8000);
    </script>
</body>
</html>
