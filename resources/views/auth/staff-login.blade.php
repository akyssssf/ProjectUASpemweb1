<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas — Klinik Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #E8ECFF; }
        .clay { background: white; border-radius: 28px; box-shadow: 0 8px 0 0 #B3C0E8, 0 12px 32px rgba(0,0,128,0.10); border: 2px solid #D0DAFF; }
        .clay-dark { background: linear-gradient(135deg, #00003D, #000080); border-radius: 28px; box-shadow: 0 8px 0 #000028; border: 2px solid #0000B0; }
        .clay-gold { background: linear-gradient(135deg, #FED800, #F9A825); border-radius: 16px; box-shadow: 0 5px 0 #C8860A; border: 2px solid #FFE57F; }
        .blob { position: absolute; border-radius: 50%; filter: blur(70px); opacity: 0.15; pointer-events: none; }
        .input-clay { width: 100%; padding: 14px 18px; border-radius: 16px; border: 2.5px solid #D0DAFF; background: #F0F3FF; font-size: 0.95rem; font-weight: 600; color: #00003D; outline: none; transition: all 0.2s; }
        .input-clay:focus { border-color: #1A237E; background: white; box-shadow: 0 0 0 4px rgba(0,0,128,0.10); }
        .label-clay { display: block; font-size: 0.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: #1A237E; margin-bottom: 8px; }
        .btn-clay { display: inline-block; padding: 14px 28px; border-radius: 18px; font-weight: 800; transition: all 0.15s ease; position: relative; top: 0; cursor: pointer; border: none; }
        .btn-clay:active { top: 4px; }
        .btn-primary { background: linear-gradient(135deg, #1A237E, #0000CD); color: white; box-shadow: 0 6px 0 #00005A, 0 8px 20px rgba(0,0,128,0.25); }
        .btn-primary:hover { transform: translateY(-2px); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <div class="blob w-96 h-96 bg-blue-900 -top-20 -left-20"></div>
    <div class="blob w-72 h-72 bg-blue-700 bottom-10 -right-20"></div>
    <div class="blob w-40 h-40" style="background:#FED800;bottom:20%;left:10%;"></div>

    <div class="relative z-10 w-full max-w-md">

        <div class="text-center mb-8">
            <div class="clay-dark w-20 h-20 flex items-center justify-center mx-auto mb-4 text-4xl">🏥</div>
            <h1 class="text-3xl font-black text-slate-800">Portal Petugas</h1>
            <p class="text-slate-500 mt-1 font-medium">Masuk untuk akses panel kontrol</p>
        </div>

        {{-- Akun demo --}}
        <div class="clay-gold mb-5 p-4">
            <p class="text-xs font-black uppercase tracking-widest mb-3 text-yellow-900">🎯 Akun Demo Petugas</p>
            <div class="space-y-2 text-xs font-bold text-yellow-900">
                <div class="flex justify-between items-center bg-white/50 rounded-xl p-2.5">
                    <span>👑 Admin</span>
                    <span class="font-black">admin@klinik.com / 123456</span>
                </div>
                <div class="flex justify-between items-center bg-white/50 rounded-xl p-2.5">
                    <span>👨‍⚕️ Dokter (contoh)</span>
                    <span class="font-black">dr-andi-susanto@klinik.com</span>
                </div>
                <div class="text-[10px] text-yellow-800 mt-1 text-center">Password semua dokter: <span class="font-black">dokter123</span></div>
            </div>
        </div>

        <div class="clay p-8">
            @if ($errors->any())
                <div class="mb-5 p-4 rounded-2xl text-red-700 font-bold text-sm flex items-center gap-2" style="background:#FEF2F2;border:2px solid #FECACA;">
                    <span>⚠️</span> {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('petugas.login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="label-clay">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="input-clay" placeholder="staff@klinik.com" required>
                </div>
                <div>
                    <label class="label-clay">Password</label>
                    <input type="password" name="password" class="input-clay" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-clay btn-primary w-full text-center text-base" style="padding:14px;">
                    Masuk ke Panel →
                </button>
            </form>

            <div class="mt-6 pt-5 border-t-2 border-blue-50 text-center">
                <a href="/" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>
