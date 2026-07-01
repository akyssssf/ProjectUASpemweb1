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
        body { background: #EEF2FF; }
        .clay { background: white; border-radius: 28px; box-shadow: 0 8px 0 0 #C7D2FE, 0 12px 32px rgba(99,102,241,0.10); border: 2px solid #E0E7FF; }
        .clay-blue { background: linear-gradient(135deg, #6366F1, #4F46E5); border-radius: 20px; box-shadow: 0 6px 0 #3730A3; border: 2px solid #818CF8; }
        .clay-dark { background: linear-gradient(135deg, #1E1B4B, #312E81); border-radius: 28px; box-shadow: 0 8px 0 #0F0A2E; border: 2px solid #4338CA; }
        .blob { position: absolute; border-radius: 50%; filter: blur(70px); opacity: 0.18; pointer-events: none; }
        .input-clay { width: 100%; padding: 14px 18px; border-radius: 16px; border: 2.5px solid #E0E7FF; background: #F8FAFF; font-size: 0.95rem; font-weight: 600; color: #1E1B4B; outline: none; transition: all 0.2s; box-shadow: inset 0 3px 0 rgba(99,102,241,0.06); }
        .input-clay:focus { border-color: #6366F1; background: white; box-shadow: 0 0 0 4px rgba(99,102,241,0.12); }
        .label-clay { display: block; font-size: 0.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: #4F46E5; margin-bottom: 8px; }
        .btn-clay { display: inline-block; padding: 14px 28px; border-radius: 18px; font-weight: 800; transition: all 0.15s ease; position: relative; top: 0; cursor: pointer; border: none; }
        .btn-clay:active { top: 4px; }
        .btn-primary { background: linear-gradient(135deg, #6366F1, #4F46E5); color: white; box-shadow: 0 6px 0 #3730A3, 0 8px 20px rgba(99,102,241,0.30); }
        .btn-primary:hover { transform: translateY(-2px); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <div class="blob w-96 h-96 bg-indigo-400 -top-20 -left-20"></div>
    <div class="blob w-80 h-80 bg-violet-400 bottom-10 -right-20"></div>

    <div class="relative z-10 w-full max-w-md">
        <div class="text-center mb-8">
            <div class="clay-dark w-20 h-20 flex items-center justify-center mx-auto mb-4 text-4xl">🏥</div>
            <h1 class="text-3xl font-black text-slate-800">Portal Petugas</h1>
            <p class="text-slate-500 mt-1 font-medium">Masuk untuk akses panel kontrol</p>
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

            <div class="mt-6 pt-5 border-t-2 border-indigo-50 text-center">
                <a href="/" class="text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors">← Kembali ke Beranda</a>
            </div>
        </div>

        <div class="clay mt-4 p-4 text-center" style="border-radius:16px;">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Info Akun Default</p>
            <p class="text-sm font-bold text-indigo-600 mt-1">admin@klinik.com · password: 123456</p>
            <p class="text-xs text-slate-400 mt-1">Dokter: [nama-dokter]@klinik.com · password: dokter123</p>
        </div>
    </div>

</body>
</html>
