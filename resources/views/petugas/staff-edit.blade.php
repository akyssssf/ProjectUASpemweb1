<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staf - Klinik Sehat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; font-family: 'DM Sans', sans-serif; }
        body { margin: 0; min-height: 100vh; background: #EEF5FF; color: #1E293B; }
        .bg-mesh { position: fixed; inset: 0; z-index: 0; pointer-events: none; background: radial-gradient(ellipse 42% 46% at 86% 88%, rgba(103,232,249,.22), transparent 65%), radial-gradient(ellipse 52% 50% at 8% 8%, rgba(96,165,250,.18), transparent 62%), linear-gradient(180deg,#F8FBFF 0%,#EEF5FF 100%); }
        .card { background: #fff; border: 1.5px solid rgba(255,255,255,.9); border-radius: 24px; box-shadow: 8px 8px 24px rgba(99,149,210,.16), inset 3px 3px 8px rgba(255,255,255,.85), inset -3px -3px 8px rgba(180,210,245,.22); }
        .input { width: 100%; background: #F8FBFF; border: 1.5px solid #CFE0FF; border-radius: 14px; outline: none; padding: 12px 14px; font-weight: 700; color: #334155; }
        .input:focus { border-color: #3B82F6; box-shadow: 0 0 0 3px rgba(59,130,246,.12); }
        .btn { border: 0; border-radius: 16px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-weight: 800; text-decoration: none; transition: transform .15s ease; }
        .btn:hover { transform: translateY(-1px); }
        .btn-blue { background: linear-gradient(135deg,#1D4ED8,#2563EB); color: white; box-shadow: 0 6px 0 #1E40AF; }
        .btn-white { background: white; color: #1D4ED8; border: 1.5px solid #BFDBFE; box-shadow: 0 5px 0 #C7D2FE; }
        h1, h2 { font-family: 'Sora', sans-serif; letter-spacing: 0; }
    </style>
</head>
<body>
<div class="bg-mesh"></div>
<main class="relative z-10 min-h-screen flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-xl">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-white px-4 py-2.5 mb-5">Kembali ke Dashboard</a>

        <section class="card overflow-hidden">
            <div class="p-6 md:p-8" style="background:linear-gradient(135deg,#2546A3,#2563EB);">
                <p class="text-blue-100 text-xs font-black uppercase tracking-widest mb-2">Manajemen Staff</p>
                <h1 class="text-2xl md:text-3xl font-black text-white">Edit Staf</h1>
                <p class="text-blue-100 mt-2 font-semibold">Pastikan role sesuai dashboard yang tersedia.</p>
            </div>

            <form action="{{ route('staff.update', $staff->id) }}" method="POST" class="p-6 md:p-8 space-y-5">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="rounded-2xl p-4 font-bold text-red-700" style="background:#FEF2F2;border:1.5px solid #FECACA;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $staff->name) }}" class="input" required>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $staff->email) }}" class="input" required>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Role</label>
                    <select name="role" class="input" required>
                        <option value="admin" @selected(old('role', $staff->role) === 'admin')>Admin</option>
                        <option value="dokter" @selected(old('role', $staff->role) === 'dokter')>Dokter</option>
                    </select>
                    @if(!in_array($staff->role, ['admin', 'dokter']))
                        <p class="text-xs text-amber-600 font-bold mt-2">Role lama "{{ $staff->role }}" akan diganti ke role aktif saat disimpan.</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-blue w-full py-3.5">Update Data</button>
            </form>
        </section>
    </div>
</main>
</body>
</html>
