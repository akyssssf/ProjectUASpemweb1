<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 p-8">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-800 tracking-tight">Dashboard Dokter</h1>
                <p class="text-slate-500">Antrean Pasien yang Dipanggil Hari Ini</p>
            </div>
            
            <form method="POST" action="{{ route('petugas.logout') }}">
                @csrf
                <button type="submit" class="bg-white text-red-500 px-6 py-3 rounded-2xl border border-red-100 font-bold hover:bg-red-500 hover:text-white transition-all shadow-sm flex items-center">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-emerald-500 text-white p-4 rounded-2xl mb-6 font-bold shadow-lg">{{ session('success') }}</div>
        @endif
        
        <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50">
                    <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em]">
                        <th class="p-8">No. Antrean</th>
                        <th class="p-8">Nama Pasien</th>
                        <th class="p-8">Poli</th>
                        <th class="p-8 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($antrianDipanggil as $antrian)
                    <tr>
                        <td class="p-8 font-black text-2xl text-slate-700">{{ $antrian->nomor_antrian }}</td>
                        <td class="p-8 font-bold text-slate-700">{{ $antrian->pendaftaran->pasien->name ?? '-' }}</td>
                        <td class="p-8 text-slate-600">{{ $antrian->poli }}</td>
                        <td class="p-8 text-center">
                            <a href="{{ route('rekam_medis.create', $antrian->id) }}" class="bg-blue-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-blue-700 transition-all">
                                Periksa Sekarang
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-16 text-center text-slate-400 font-bold">
                            <i class="fas fa-user-check text-4xl mb-4 block opacity-50"></i>
                            Tidak ada pasien yang dipanggil saat ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>