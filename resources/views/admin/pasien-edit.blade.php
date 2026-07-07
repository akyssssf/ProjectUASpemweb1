<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pasien - Klinik Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700;800&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; font-family: 'DM Sans', sans-serif; }
        body { margin: 0; min-height: 100vh; background: #EEF5FF; color: #1E293B; }
        .bg-mesh { position: fixed; inset: 0; z-index: 0; pointer-events: none; background: radial-gradient(ellipse 46% 46% at 86% 88%, rgba(103,232,249,.22), transparent 65%), radial-gradient(ellipse 52% 50% at 8% 8%, rgba(96,165,250,.18), transparent 62%), linear-gradient(180deg,#F8FBFF 0%,#EEF5FF 100%); }
        .card { background: #fff; border: 1.5px solid rgba(255,255,255,.9); border-radius: 24px; box-shadow: 8px 8px 24px rgba(99,149,210,.16), inset 3px 3px 8px rgba(255,255,255,.85), inset -3px -3px 8px rgba(180,210,245,.22); }
        .btn { border: 0; border-radius: 16px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-weight: 800; text-decoration: none; transition: transform .15s ease; white-space: nowrap; }
        .btn:hover { transform: translateY(-1px); }
        .btn-blue { background: linear-gradient(135deg,#1D4ED8,#2563EB); color: white; box-shadow: 0 6px 0 #1E40AF; }
        .btn-white { background: white; color: #1D4ED8; border: 1.5px solid #BFDBFE; box-shadow: 0 5px 0 #C7D2FE; }
        .input { width: 100%; background: #F8FBFF; border: 1.5px solid #CFE0FF; border-radius: 14px; outline: none; padding: 12px 14px; font-weight: 700; color: #334155; }
        .input:focus { border-color: #3B82F6; box-shadow: 0 0 0 3px rgba(59,130,246,.12); }
        .label { display: block; margin-bottom: 7px; font-size: .78rem; font-weight: 900; color: #334155; text-transform: uppercase; letter-spacing: .05em; }
        h1, h2 { font-family: 'Sora', sans-serif; letter-spacing: 0; }
    </style>
</head>
<body>
<div class="bg-mesh"></div>

<main class="relative z-10 min-h-screen px-4 py-8 flex items-center justify-center">
    <div class="w-full max-w-2xl">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-white px-4 py-2.5 mb-5">Kembali ke Dashboard</a>

        <div class="card overflow-hidden">
            <div class="p-6 md:p-8 border-b border-blue-50">
                <p class="text-blue-500 text-xs font-black uppercase tracking-widest mb-2">Data Pasien</p>
                <h1 class="text-2xl md:text-3xl font-black text-slate-800">Edit Pasien</h1>
                <p class="text-slate-400 font-semibold mt-2">Perbarui data akun pasien tanpa menghapus riwayat kunjungan.</p>
            </div>

            @if ($errors->any())
                <div class="mx-6 md:mx-8 mt-6 p-4 rounded-2xl" style="background:#FEF2F2;border:1.5px solid #FECACA;">
                    <p class="font-black text-red-700 mb-2">Ada data yang perlu dicek:</p>
                    <ul class="text-sm text-red-600 font-semibold space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('pasien.update', $pasien->id) }}" class="p-6 md:p-8 space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="label">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $pasien->name) }}" class="input" required>
                    </div>
                    <div>
                        <label class="label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $pasien->email) }}" class="input" required>
                    </div>
                    <div>
                        <label class="label">NIK</label>
                        <input type="text" name="nik" value="{{ old('nik', $pasien->nik) }}" maxlength="16" class="input" required>
                    </div>
                    <div>
                        <label class="label">No HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $pasien->no_hp) }}" class="input">
                    </div>
                </div>

                <div>
                    <label class="label">Alamat</label>
                    <textarea name="alamat" rows="3" class="input" style="resize:vertical;">{{ old('alamat', $pasien->alamat) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 rounded-2xl" style="background:#F1F8FF;border:1.5px solid #CFE0FF;">
                    <div>
                        <label class="label">Password Baru</label>
                        <input type="password" name="password" class="input" placeholder="Kosongkan jika tidak diganti">
                    </div>
                    <div>
                        <label class="label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="input" placeholder="Ulangi password baru">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    <button type="submit" class="btn btn-blue px-5 py-3 flex-1">Simpan Perubahan</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-white px-5 py-3">Batal</a>
                </div>
            </form>
        </div>
    </div>
</main>
</body>
</html>
