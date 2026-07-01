<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — Klinik Sehat</title>
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
        .clay-violet { background: linear-gradient(135deg, #8B5CF6, #7C3AED); border-radius: 20px; box-shadow: 0 6px 0 #5B21B6; }
        .btn-clay { display: inline-block; padding: 10px 22px; border-radius: 14px; font-weight: 800; font-size: 0.85rem; transition: all 0.15s ease; position: relative; top: 0; cursor: pointer; text-decoration: none; }
        .btn-clay:active { top: 3px; }
        .btn-primary { background: linear-gradient(135deg, #6366F1, #4F46E5); color: white; box-shadow: 0 5px 0 #3730A3; }
        .btn-amber { background: linear-gradient(135deg, #F59E0B, #D97706); color: white; box-shadow: 0 5px 0 #B45309; }
        .btn-danger { background: linear-gradient(135deg, #EF4444, #DC2626); color: white; box-shadow: 0 5px 0 #B91C1C; }
        .btn-white { background: white; color: #4F46E5; box-shadow: 0 5px 0 #C7D2FE; border: 2px solid #E0E7FF; }
        .btn-clay:hover { transform: translateY(-1px); }
        .blob { position: absolute; border-radius: 50%; filter: blur(60px); opacity: 0.15; pointer-events: none; }
        .badge { display: inline-block; padding: 3px 12px; border-radius: 99px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; }
        .badge-admin { background: #EEF2FF; color: #4F46E5; border: 1.5px solid #C7D2FE; }
        .badge-dokter { background: #ECFDF5; color: #059669; border: 1.5px solid #A7F3D0; }
        .badge-petugas { background: #FFFBEB; color: #D97706; border: 1.5px solid #FDE68A; }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8 relative overflow-x-hidden">

    <div class="blob w-96 h-96 bg-indigo-400 -top-20 -left-20"></div>
    <div class="blob w-72 h-72 bg-violet-300 bottom-0 right-0"></div>

    <div class="max-w-7xl mx-auto relative z-10">

        <!-- Header -->
        <div class="clay-dark p-6 md:p-8 mb-8 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-64 h-64 rounded-full" style="background:rgba(255,255,255,0.06);transform:translate(30%,-30%);"></div>
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-5">
                <div>
                    <p class="text-indigo-300 text-xs font-black uppercase tracking-widest mb-1">Portal Admin</p>
                    <h1 class="text-2xl md:text-3xl font-black text-white">Dashboard Admin 🛡️</h1>
                    <p class="text-indigo-300 mt-1 font-medium">Kelola staff dan data pasien klinik</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('staff.register') }}" class="btn-clay btn-primary">+ Tambah Staf</a>
                    <form action="{{ route('petugas.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-clay btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="clay mb-6 p-4 flex items-center gap-3" style="border-color:#A7F3D0;box-shadow:0 6px 0 #A7F3D0;">
                <span class="text-2xl">✅</span>
                <span class="font-bold text-emerald-700">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Stat Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-8">
            @foreach($stats as $stat)
            <div class="clay p-6 text-center">
                <div class="text-3xl font-black text-indigo-600 mb-1">{{ $stat->total }}</div>
                <div class="text-xs font-black text-slate-400 uppercase tracking-widest">{{ $stat->role }}</div>
            </div>
            @endforeach
            <div class="clay p-6 text-center">
                <div class="text-3xl font-black text-indigo-600 mb-1">{{ $allPasien->count() }}</div>
                <div class="text-xs font-black text-slate-400 uppercase tracking-widest">Pasien</div>
            </div>
        </div>

        <!-- Tabel Staff -->
        <div class="clay overflow-hidden mb-8">
            <div class="px-8 py-5 flex items-center justify-between" style="border-bottom:2px solid #EEF2FF;">
                <h2 class="text-lg font-black text-slate-800">👥 Daftar Staff</h2>
                <a href="{{ route('staff.register') }}" class="btn-clay btn-primary" style="padding:8px 18px;font-size:0.8rem;">+ Tambah</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr style="background:#F8FAFF;border-bottom:2px solid #EEF2FF;">
                            <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest">Nama</th>
                            <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest">Email</th>
                            <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest">Role</th>
                            <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allStaff as $staff)
                        <tr style="border-bottom:2px solid #EEF2FF;" class="hover:bg-indigo-50/30 transition-colors">
                            <td class="px-6 py-4 font-black text-slate-800">{{ $staff->name }}</td>
                            <td class="px-6 py-4 text-slate-500 font-medium text-sm">{{ $staff->email }}</td>
                            <td class="px-6 py-4">
                                <span class="badge badge-{{ $staff->role }}">{{ $staff->role }}</span>
                            </td>
                            <td class="px-6 py-4 text-center flex justify-center gap-2">
                                <a href="{{ route('staff.edit', $staff->id) }}" class="btn-clay btn-amber" style="padding:7px 16px;font-size:0.75rem;">Edit</a>
                                <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('Hapus staf ini?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-clay btn-danger" style="padding:7px 16px;font-size:0.75rem;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Pasien -->
        <div class="clay overflow-hidden">
            <div class="px-8 py-5 flex items-center justify-between" style="border-bottom:2px solid #EEF2FF;">
                <h2 class="text-lg font-black text-slate-800">🧑‍🤝‍🧑 Daftar Pasien</h2>
                <span class="text-xs font-black px-4 py-2 rounded-full" style="background:#EEF2FF;color:#4F46E5;border:1.5px solid #C7D2FE;">{{ $allPasien->count() }} terdaftar</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr style="background:#F8FAFF;border-bottom:2px solid #EEF2FF;">
                            <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest">Nama</th>
                            <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest">Email</th>
                            <th class="px-6 py-4 text-[10px] font-black text-indigo-300 uppercase tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allPasien as $pasien)
                        <tr style="border-bottom:2px solid #EEF2FF;" class="hover:bg-indigo-50/30 transition-colors">
                            <td class="px-6 py-4 font-black text-slate-800">{{ $pasien->name }}</td>
                            <td class="px-6 py-4 text-slate-500 font-medium text-sm">{{ $pasien->email }}</td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus pasien ini? Seluruh riwayat & rekam medisnya juga akan terhapus.')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-clay btn-danger" style="padding:7px 16px;font-size:0.75rem;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
