<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Petugas — Klinik Sehat</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    *{box-sizing:border-box;margin:0;padding:0;font-family:'DM Sans',sans-serif;}
    body{background:#f0f4ff;min-height:100vh;display:flex;flex-direction:column;overflow-x:hidden;}
    .blob{position:fixed;border-radius:50%;filter:blur(80px);pointer-events:none;z-index:0;}
    .blob-1{width:500px;height:500px;background:radial-gradient(circle,#bfdbfe,#93c5fd);opacity:.25;top:-120px;left:-120px;}
    .blob-2{width:350px;height:350px;background:radial-gradient(circle,#a5f3fc,#67e8f9);opacity:.18;bottom:-80px;right:-80px;}
    .top-nav{background:linear-gradient(135deg,#0f2057,#1e3a8a,#0369a1);position:sticky;top:0;z-index:100;box-shadow:0 4px 24px rgba(15,32,87,.35);}
    .nav-inner{max-width:1200px;margin:0 auto;padding:0 20px;height:64px;display:flex;align-items:center;justify-content:space-between;}
    .clay-card{background:#fff;border-radius:24px;box-shadow:8px 8px 24px rgba(99,149,210,.18),-2px -2px 8px rgba(255,255,255,.9),inset 3px 3px 8px rgba(255,255,255,.85),inset -3px -3px 8px rgba(180,210,245,.25);border:1.5px solid rgba(255,255,255,.8);}
    .clay-input{background:#f1f8ff;border:1.5px solid rgba(147,197,253,.55);border-radius:14px;box-shadow:inset 2px 2px 5px rgba(180,210,245,.3),inset -2px -2px 5px rgba(255,255,255,.8);outline:none;width:100%;padding:.75rem 1rem;font-size:.95rem;color:#1e293b;transition:border-color .2s;}
    .clay-input:focus{border-color:#3b82f6;box-shadow:0 0 0 3px rgba(59,130,246,.12),inset 2px 2px 5px rgba(180,210,245,.3);}
    .clay-label{display:block;font-size:.78rem;font-weight:700;color:#374151;margin-bottom:6px;text-transform:uppercase;letter-spacing:.05em;}
    .clay-btn{border-radius:14px;font-weight:700;border:none;cursor:pointer;transition:all .2s ease;display:inline-block;text-decoration:none;padding:.8rem 1.5rem;font-size:.95rem;}
    .clay-btn:hover{transform:translateY(-2px);}
    .btn-primary{background:linear-gradient(135deg,#1e3a8a,#2563eb);color:white;box-shadow:5px 5px 14px rgba(37,99,235,.35);}
    .stat-pill{background:rgba(255,255,255,.14);border:1.5px solid rgba(255,255,255,.22);border-radius:50px;padding:.4rem .9rem;backdrop-filter:blur(8px);}
  </style>
</head>
<body>
<div class="blob blob-1"></div>
<div class="blob blob-2"></div>

<nav class="top-nav">
  <div class="nav-inner">
    <a href="/" class="flex items-center gap-3" style="text-decoration:none;">
      <img src="https://uns.ac.id/id/wp-content/uploads/2023/06/logo-uns-biru.png" alt="UNS" style="height:32px;object-fit:contain;filter:drop-shadow(0 2px 6px rgba(30,58,138,.3));"/>
      <div>
        <p style="font-family:'Sora',sans-serif;font-weight:800;color:white;font-size:.9rem;">Klinik Sehat</p>
        <p style="font-size:.62rem;color:rgba(147,197,253,.8);">Sistem Layanan Klinik Digital</p>
      </div>
    </a>
    <a href="/" style="font-size:.78rem;font-weight:700;color:rgba(147,197,253,.9);text-decoration:none;padding:6px 14px;border-radius:10px;border:1px solid rgba(255,255,255,.2);background:rgba(255,255,255,.08);">← Kembali ke Beranda</a>
  </div>
</nav>

<div class="relative z-10 flex-1 flex items-center justify-center p-6">
  <div class="w-full max-w-md">

    {{-- Header --}}
    <div class="text-center mb-8">
      <div style="background:linear-gradient(135deg,#0f2057,#1e3a8a);width:72px;height:72px;border-radius:22px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:0 8px 24px rgba(15,32,87,.4);font-size:2rem;">🏥</div>
      <h1 style="font-family:'Sora',sans-serif;font-weight:800;font-size:1.6rem;color:#1e293b;">Portal Petugas</h1>
      <p style="color:#64748b;font-size:.9rem;margin-top:4px;">Masuk untuk akses panel kontrol klinik</p>
    </div>

    {{-- Akun Demo --}}
    <div class="clay-card mb-5 p-4" style="border-left:4px solid #f59e0b;">
      <p style="font-size:.72rem;font-weight:800;color:#d97706;text-transform:uppercase;letter-spacing:.05em;margin-bottom:10px;">🎯 Akun Demo Petugas</p>
      <div style="space-y:8px;">
        <div style="display:flex;justify-content:space-between;align-items:center;background:#fffbeb;border-radius:10px;padding:8px 12px;margin-bottom:6px;">
          <span style="font-size:.78rem;font-weight:600;color:#92400e;">👑 Admin</span>
          <span style="font-size:.78rem;font-weight:800;color:#1e293b;">admin@klinik.com / 123456</span>
        </div>
        <div style="display:flex;justify-content:space-between;align-items:center;background:#fffbeb;border-radius:10px;padding:8px 12px;margin-bottom:6px;">
          <span style="font-size:.78rem;font-weight:600;color:#92400e;">👨‍⚕️ Dokter</span>
          <span style="font-size:.78rem;font-weight:800;color:#1e293b;">dr-andi-susanto@klinik.com</span>
        </div>
        <p style="font-size:.7rem;color:#92400e;text-align:center;">Password semua dokter: <strong>dokter123</strong></p>
      </div>
    </div>

    {{-- Form Login --}}
    <div class="clay-card p-7">
      @if ($errors->any())
        <div style="background:#fef2f2;border:1.5px solid #fecaca;border-radius:12px;padding:12px 16px;margin-bottom:18px;display:flex;align-items:center;gap:8px;">
          <span>⚠️</span>
          <span style="font-weight:700;color:#dc2626;font-size:.875rem;">{{ $errors->first() }}</span>
        </div>
      @endif

      <form method="POST" action="{{ route('petugas.login') }}">
        @csrf
        <div style="margin-bottom:16px;">
          <label class="clay-label">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" class="clay-input" placeholder="staff@klinik.com" required>
        </div>
        <div style="margin-bottom:20px;">
          <label class="clay-label">Password</label>
          <input type="password" name="password" class="clay-input" placeholder="••••••••" required>
        </div>
        <button type="submit" class="clay-btn btn-primary" style="width:100%;text-align:center;">
          Masuk ke Panel →
        </button>
      </form>
    </div>

  </div>
</div>
</body>
</html>