<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Kontrol Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen p-4 md:p-8">

    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-800 tracking-tight">Panel Petugas</h1>
                <p class="text-slate-500 mt-1">Sistem Manajemen Antrean Digital — <span class="font-semibold text-emerald-600">{{ now()->translatedFormat('d F Y') }}</span></p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="/display" target="_blank" class="bg-blue-600 text-white px-5 py-3 rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 flex items-center">
                    <i class="fas fa-desktop mr-2"></i> Buka Display
                </a>
                <form method="POST" action="/petugas/logout">
                    @csrf
                    <button type="submit" class="group bg-white text-red-500 px-5 py-3 rounded-2xl border border-red-100 font-bold hover:bg-red-500 hover:text-white transition-all duration-300 shadow-sm flex items-center">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100">
                    <div class="p-8 border-b border-slate-50 bg-white flex justify-between items-center">
                        <h2 class="text-xl font-bold text-slate-800 flex items-center">
                            <span class="w-2 h-8 bg-emerald-500 rounded-full mr-4"></span>
                            Antrean Berjalan
                        </h2>
                        <span class="bg-emerald-50 text-emerald-600 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest">
                            {{ $antrianAktif->count() }} Aktif
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-slate-50/50 text-slate-400 text-[10px] uppercase tracking-[0.2em]">
                                    <th class="px-8 py-4 font-bold">No. Antrean</th>
                                    <th class="px-8 py-4 font-bold">Informasi Pasien</th>
                                    <th class="px-8 py-4 font-bold">Layanan Poli</th>
                                    <th class="px-8 py-4 text-center font-bold">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($antrianAktif as $row)
                                <tr class="group hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-6">
                                        <span class="text-4xl font-black tracking-tighter {{ $row->status == 'dipanggil' ? 'text-orange-500' : 'text-emerald-600' }}">
                                            {{ $row->nomor_antrian }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="font-bold text-slate-700 text-lg">{{ $row->pendaftaran->pasien->name ?? '-' }}</div>
                                        @if($row->status == 'dipanggil')
                                            <span class="flex items-center text-[10px] text-orange-500 font-black uppercase mt-1 animate-pulse">
                                                <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-2"></span>
                                                Sedang Dipanggil
                                            </span>
                                        @else
                                            <span class="text-[10px] text-slate-400 font-bold uppercase mt-1">Status: Menunggu</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="bg-slate-100 text-slate-600 px-4 py-1.5 rounded-xl text-xs font-bold uppercase tracking-wide">
                                            {{ $row->poli }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        @if($row->status == 'menunggu')
                                            <a href="/petugas/monitoring/panggil/{{ $row->id }}" class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-emerald-100 hover:-translate-y-1">
                                                PANGGIL
                                            </a>
                                        @else
                                            <a href="/petugas/monitoring/selesai/{{ $row->id }}" class="inline-block bg-slate-800 hover:bg-black text-white px-8 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-slate-200 hover:-translate-y-1">
                                                SELESAI
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-24 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-check-circle text-slate-200 text-6xl mb-4"></i>
                                            <p class="text-slate-400 font-medium">Semua antrean telah terlayani.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100">
                    <div class="p-8 border-b border-slate-50 bg-blue-600">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-history mr-3 opacity-70"></i> Riwayat Selesai
                        </h2>
                    </div>
                    <div class="overflow-y-auto max-h-[500px] custom-scrollbar">
                        @forelse ($riwayatSelesai as $row)
                        <div class="p-6 hover:bg-slate-50 transition-colors border-b border-slate-50">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xl font-black text-slate-300">#{{ $row->nomor_antrian }}</span>
                                <span class="text-[10px] bg-blue-50 text-blue-500 px-3 py-1 rounded-full font-bold uppercase">
                                    {{ $row->updated_at->format('H:i') }}
                                </span>
                            </div>
                            <div class="font-bold text-slate-700">{{ $row->pendaftaran->pasien->name ?? '-' }}</div>
                            <div class="text-[10px] text-slate-400 font-bold uppercase mt-1 tracking-wider">
                                {{ $row->poli }} • Selesai
                            </div>
                        </div>
                        @empty
                        <div class="p-16 text-center text-slate-400 italic text-sm">Belum ada riwayat hari ini.</div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-emerald-600 rounded-[2rem] p-8 text-white shadow-xl shadow-emerald-200/50 relative overflow-hidden group">
                    <i class="fas fa-clinic-medical absolute -right-4 -bottom-4 text-8xl opacity-10 group-hover:scale-110 transition-transform"></i>
                    <h3 class="font-bold text-lg mb-2 leading-tight">Saran Penggunaan</h3>
                    <p class="text-emerald-100 text-xs leading-relaxed opacity-80">
                        Pastikan layar display pasien aktif untuk memunculkan suara panggilan otomatis.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-refresh halaman tiap 5 detik biar data antrean ter-update
        setInterval(() => { window.location.reload(); }, 5000);
    </script>
</body>
</html>