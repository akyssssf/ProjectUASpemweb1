<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Rekam Medis — Klinik Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #EEF2FF; }
        .clay { background: white; border-radius: 24px; box-shadow: 0 8px 0 0 #C7D2FE, 0 12px 32px rgba(99,102,241,0.10); border: 2px solid #E0E7FF; }
        .clay-dark { background: linear-gradient(135deg, #1E1B4B, #312E81); border-radius: 24px; box-shadow: 0 8px 0 #0F0A2E; border: 2px solid #4338CA; }
        .btn-clay { display: inline-block; padding: 12px 28px; border-radius: 16px; font-weight: 800; transition: all 0.15s ease; position: relative; top: 0; }
        .btn-clay:active { top: 3px; }
        .btn-primary { background: linear-gradient(135deg, #1E1B4B, #312E81); color: white; box-shadow: 0 6px 0 #0F0A2E; }
        .btn-primary:hover { transform: translateY(-1px); }
        .btn-white { background: white; color: #4F46E5; box-shadow: 0 5px 0 #C7D2FE; border: 2px solid #E0E7FF; }
        .textarea-soap { width: 100%; padding: 16px; border-radius: 16px; border: 2.5px solid #E0E7FF; background: #F8FAFF; font-size: 0.9rem; font-weight: 600; color: #1E1B4B; outline: none; transition: all 0.2s; resize: none; min-height: 120px; }
        .blob { position: absolute; border-radius: 50%; filter: blur(60px); opacity: 0.15; pointer-events: none; }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8 relative overflow-x-hidden">

    <div class="blob w-96 h-96 bg-indigo-400 -top-20 -left-20"></div>

    <div class="max-w-4xl mx-auto relative z-10">

        <!-- Header -->
        <div class="clay-dark p-6 mb-8 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-48 h-48 rounded-full" style="background:rgba(255,255,255,0.06);transform:translate(30%,-30%);"></div>
            <div class="relative z-10 flex justify-between items-start gap-4">
                <div>
                    <p class="text-indigo-300 text-xs font-black uppercase tracking-widest mb-1">Input Rekam Medis</p>
                    <h2 class="text-2xl font-black text-white">🩺 {{ $pasien->name }}</h2>
                    <p class="text-indigo-300 font-bold text-sm mt-1">Antrean #{{ $antrian->nomor_antrian }} · {{ $antrian->poli }}</p>
                </div>
                <a href="{{ route('dokter.dashboard') }}" class="btn-clay btn-white" style="padding:10px 20px;font-size:0.85rem;">← Batal</a>
            </div>
        </div>

        <div class="clay p-8">
            <form action="{{ route('rekam_medis.store') }}" method="POST">
                @csrf
                <input type="hidden" name="pasien_id" value="{{ $pasien->id }}">
                <input type="hidden" name="antrian_id" value="{{ $antrian->id }}">

                <p class="text-xs font-black text-indigo-400 uppercase tracking-widest mb-6">Format SOAP</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="flex items-center gap-2 text-sm font-black text-slate-700 mb-3">
                            <span class="w-8 h-8 rounded-xl flex items-center justify-center font-black text-white text-sm" style="background:linear-gradient(135deg,#6366F1,#4F46E5);box-shadow:0 3px 0 #3730A3;">S</span>
                            Subjective (Keluhan Pasien)
                        </label>
                        <textarea name="subjective" class="textarea-soap" style="border-color:#C7D2FE;" placeholder="Pasien mengeluh pusing sejak 2 hari yang lalu..." required></textarea>
                    </div>
                    <div>
                        <label class="flex items-center gap-2 text-sm font-black text-slate-700 mb-3">
                            <span class="w-8 h-8 rounded-xl flex items-center justify-center font-black text-white text-sm" style="background:linear-gradient(135deg,#10B981,#059669);box-shadow:0 3px 0 #047857;">O</span>
                            Objective (Hasil Pemeriksaan)
                        </label>
                        <textarea name="objective" class="textarea-soap" style="border-color:#A7F3D0;" placeholder="TD: 120/80, Nadi: 80x/mnt, Suhu: 36.5°C..." required></textarea>
                    </div>
                    <div>
                        <label class="flex items-center gap-2 text-sm font-black text-slate-700 mb-3">
                            <span class="w-8 h-8 rounded-xl flex items-center justify-center font-black text-white text-sm" style="background:linear-gradient(135deg,#F59E0B,#D97706);box-shadow:0 3px 0 #B45309;">A</span>
                            Assessment (Diagnosa)
                        </label>
                        <textarea name="assessment" class="textarea-soap" style="border-color:#FDE68A;" placeholder="Diagnosa medis berdasarkan pemeriksaan..." required></textarea>
                    </div>
                    <div>
                        <label class="flex items-center gap-2 text-sm font-black text-slate-700 mb-3">
                            <span class="w-8 h-8 rounded-xl flex items-center justify-center font-black text-white text-sm" style="background:linear-gradient(135deg,#8B5CF6,#7C3AED);box-shadow:0 3px 0 #5B21B6;">P</span>
                            Plan (Rencana Pengobatan)
                        </label>
                        <textarea name="plan" class="textarea-soap" style="border-color:#DDD6FE;" placeholder="Resep obat, tindakan lanjutan, edukasi pasien..." required></textarea>
                    </div>
                </div>

                <div class="mt-8 pt-6 flex justify-end" style="border-top:2px solid #EEF2FF;">
                    <button type="submit" class="btn-clay btn-primary text-base" style="padding:14px 36px;">
                        💾 Simpan Rekam Medis
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
