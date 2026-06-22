<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Rekam Medis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 min-h-screen py-10 px-4">

    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800">Rekam Medis</h2>
                <p class="text-slate-500 font-medium mt-1">Input data medis untuk <span class="text-blue-600 font-bold">{{ $pasien->name }}</span></p>
            </div>
            <a href="{{ route('dokter.dashboard') }}" class="bg-white border border-slate-200 text-slate-600 px-6 py-3 rounded-2xl font-bold hover:bg-slate-50 transition-all shadow-sm flex items-center">
                <i class="fas fa-times mr-2"></i> Batal
            </a>
        </div>
        
        <form action="{{ route('rekam_medis.store') }}" method="POST" class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-slate-100">
            @csrf
            <input type="hidden" name="pasien_id" value="{{ $pasien->id }}">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <label class="flex items-center text-sm font-black uppercase text-slate-400 mb-3 tracking-widest">
                            <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-3">S</span> Subjective (Keluhan)
                        </label>
                        <textarea name="subjective" class="w-full bg-slate-50 border-0 rounded-3xl p-6 h-32 focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Pasien mengeluh pusing sejak 2 hari yang lalu..." required></textarea>
                    </div>
                    <div>
                        <label class="flex items-center text-sm font-black uppercase text-slate-400 mb-3 tracking-widest">
                            <span class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mr-3">O</span> Objective (Pemeriksaan)
                        </label>
                        <textarea name="objective" class="w-full bg-slate-50 border-0 rounded-3xl p-6 h-32 focus:ring-2 focus:ring-emerald-500 outline-none transition-all" placeholder="TD: 120/80, Nadi: 80x/mnt, Suhu: 36.5C..." required></textarea>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="flex items-center text-sm font-black uppercase text-slate-400 mb-3 tracking-widest">
                            <span class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center mr-3">A</span> Assessment (Diagnosa)
                        </label>
                        <textarea name="assessment" class="w-full bg-slate-50 border-0 rounded-3xl p-6 h-32 focus:ring-2 focus:ring-orange-500 outline-none transition-all" placeholder="Diagnosa medis..." required></textarea>
                    </div>
                    <div>
                        <label class="flex items-center text-sm font-black uppercase text-slate-400 mb-3 tracking-widest">
                            <span class="w-8 h-8 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center mr-3">P</span> Plan (Rencana)
                        </label>
                        <textarea name="plan" class="w-full bg-slate-50 border-0 rounded-3xl p-6 h-32 focus:ring-2 focus:ring-purple-500 outline-none transition-all" placeholder="Resep obat, tindakan, edukasi..." required></textarea>
                    </div>
                </div>
            </div>
            
            <div class="mt-10 border-t border-slate-50 pt-8 flex justify-end">
                <button type="submit" class="bg-slate-900 text-white px-10 py-4 rounded-2xl font-bold hover:bg-slate-800 transition-all shadow-xl shadow-slate-300 flex items-center">
                    <i class="fas fa-save mr-2"></i> Simpan Data Rekam Medis
                </button>
            </div>
        </form>
    </div>
</body>
</html>