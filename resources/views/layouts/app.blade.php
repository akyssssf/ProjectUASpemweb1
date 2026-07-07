<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Klinik Sehat</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; font-family: 'DM Sans', sans-serif; }
    body { background: #f0f4ff; min-height: 100vh; color: #1e293b; overflow-x: hidden; }

    /* Background */
    .bg-mesh { position: fixed; inset: 0; z-index: 0; pointer-events: none;
      background:
        radial-gradient(ellipse 60% 50% at 5% 10%, rgba(99,143,247,.13) 0%, transparent 60%),
        radial-gradient(ellipse 50% 60% at 95% 85%, rgba(52,211,153,.09) 0%, transparent 60%),
        radial-gradient(ellipse 80% 80% at 50% 50%, rgba(240,244,255,1) 0%, transparent 100%); }

    /* Blobs */
    .blob { position: fixed; border-radius: 50%; filter: blur(80px); pointer-events: none; z-index: 0; }
    .blob-1 { width: 500px; height: 500px; background: radial-gradient(circle,#bfdbfe,#93c5fd); opacity: .25; top: -120px; left: -120px; }
    .blob-2 { width: 350px; height: 350px; background: radial-gradient(circle,#a5f3fc,#67e8f9); opacity: .18; bottom: -80px; right: -80px; }

    /* Top Nav */
    .top-nav { background: linear-gradient(135deg, #0f2057, #1e3a8a, #0369a1);
      position: sticky; top: 0; z-index: 100;
      box-shadow: 0 4px 24px rgba(15,32,87,.35); }
    .nav-inner { max-width: 1200px; margin: 0 auto; padding: 0 20px; height: 64px;
      display: flex; align-items: center; justify-content: space-between; gap: 12px; }

    /* Clay Cards */
    .clay-card { background: #fff; border-radius: 24px;
      box-shadow: 8px 8px 24px rgba(99,149,210,.18), -2px -2px 8px rgba(255,255,255,.9),
        inset 3px 3px 8px rgba(255,255,255,.85), inset -3px -3px 8px rgba(180,210,245,.25);
      border: 1.5px solid rgba(255,255,255,.8); }

    /* Buttons */
    .clay-btn { border-radius: 16px; font-weight: 700; border: none; cursor: pointer;
      box-shadow: 5px 5px 14px rgba(59,130,246,.3), -1px -1px 5px rgba(255,255,255,.7),
        inset 2px 2px 5px rgba(255,255,255,.35), inset -2px -2px 5px rgba(37,99,235,.2);
      transition: all .2s ease; display: inline-block; text-decoration: none; }
    .clay-btn:hover { transform: translateY(-2px) scale(1.01); }
    .clay-btn:active { transform: translateY(0) scale(.98); }

    /* Inputs */
    .clay-input { background: #f1f8ff; border: 1.5px solid rgba(147,197,253,.55); border-radius: 14px;
      box-shadow: inset 2px 2px 5px rgba(180,210,245,.3), inset -2px -2px 5px rgba(255,255,255,.8);
      outline: none; width: 100%; padding: .75rem 1rem; font-size: .95rem; color: #1e293b;
      transition: border-color .2s, box-shadow .2s; }
    .clay-input:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.12), inset 2px 2px 5px rgba(180,210,245,.3); }

    /* Labels */
    .clay-label { display: block; font-size: .8rem; font-weight: 700; color: #374151; margin-bottom: 6px; }

    /* Badges */
    .badge { display: inline-block; padding: 3px 12px; border-radius: 999px; font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; }
    .badge-blue { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
    .badge-green { background: #f0fdf4; color: #16a34a; border: 1px solid #86efac; }
    .badge-amber { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
    .badge-red { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    .badge-admin { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
    .badge-dokter { background: #f0fdf4; color: #16a34a; border: 1px solid #86efac; }
    .badge-petugas { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }

    /* Select */
    .clay-select { background: #f1f8ff; border: 1.5px solid rgba(147,197,253,.55); border-radius: 14px;
      box-shadow: inset 2px 2px 5px rgba(180,210,245,.3); outline: none; width: 100%;
      padding: .75rem 1rem; font-size: .9rem; color: #1e293b; }

    /* Aliases lama supaya halaman lain tidak pecah */
    .btn-clay { border-radius: 16px; font-weight: 700; border: none; cursor: pointer;
      box-shadow: 5px 5px 14px rgba(59,130,246,.3), inset 2px 2px 5px rgba(255,255,255,.35);
      transition: all .2s ease; display: inline-block; text-decoration: none; }
    .btn-clay:hover { transform: translateY(-2px); }
    .btn-primary { background: linear-gradient(135deg,#1e3a8a,#2563eb); color: white;
      box-shadow: 5px 5px 14px rgba(37,99,235,.35); }
    .btn-white { background: white; color: #2563eb;
      box-shadow: 5px 5px 14px rgba(99,149,210,.2); border: 1.5px solid #bfdbfe; }
    .btn-green { background: linear-gradient(135deg,#16a34a,#10b981); color: white;
      box-shadow: 5px 5px 14px rgba(16,185,129,.3); }
    .btn-danger { background: linear-gradient(135deg,#dc2626,#ef4444); color: white;
      box-shadow: 5px 5px 14px rgba(239,68,68,.3); }
    .btn-amber { background: linear-gradient(135deg,#d97706,#f59e0b); color: white;
      box-shadow: 5px 5px 14px rgba(245,158,11,.3); }
    .input-clay { background: #f1f8ff; border: 1.5px solid rgba(147,197,253,.55); border-radius: 14px;
      box-shadow: inset 2px 2px 5px rgba(180,210,245,.3); outline: none; width: 100%;
      padding: .75rem 1rem; font-size: .95rem; color: #1e293b; transition: border-color .2s; }
    .input-clay:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.12); }
    .label-clay { display: block; font-size: .8rem; font-weight: 700; color: #1e3a8a; margin-bottom: 6px; text-transform: uppercase; letter-spacing: .05em; }
    .clay { background: white; border-radius: 24px;
      box-shadow: 8px 8px 24px rgba(99,149,210,.18), -2px -2px 8px rgba(255,255,255,.9),
        inset 3px 3px 8px rgba(255,255,255,.85), inset -3px -3px 8px rgba(180,210,245,.25);
      border: 1.5px solid rgba(255,255,255,.8); }
    .clay-blue { background: linear-gradient(135deg,#1e3a8a,#2563eb); border-radius: 20px;
      box-shadow: 5px 5px 14px rgba(37,99,235,.35); border: 2px solid #3b82f6; }
    .clay-dark { background: linear-gradient(135deg,#0f2057,#1e3a8a); border-radius: 24px;
      box-shadow: 8px 8px 24px rgba(15,32,87,.4); border: 2px solid #2563eb; }
    .clay-green { background: linear-gradient(135deg,#16a34a,#10b981); border-radius: 20px;
      box-shadow: 5px 5px 14px rgba(16,185,129,.3); }
    .clay-gold { background: linear-gradient(135deg,#d97706,#f59e0b); border-radius: 20px;
      box-shadow: 5px 5px 14px rgba(245,158,11,.3); }
    .clay-red { background: linear-gradient(135deg,#dc2626,#ef4444); border-radius: 20px;
      box-shadow: 5px 5px 14px rgba(239,68,68,.3); }
    .clay-soft { background: white; border-radius: 20px;
      box-shadow: 6px 6px 18px rgba(99,149,210,.15); border: 1.5px solid rgba(255,255,255,.8); }
  </style>
</head>
<body>
<div class="bg-mesh"></div>
<div class="blob blob-1"></div>
<div class="blob blob-2"></div>

{{-- TOP NAV --}}
<nav class="top-nav">
  <div class="nav-inner">
    <a href="/" class="flex items-center gap-3" style="text-decoration:none;">
      <img src="https://uns.ac.id/id/wp-content/uploads/2023/06/logo-uns-biru.png" alt="UNS"
        style="height:32px;object-fit:contain;filter:drop-shadow(0 2px 6px rgba(30,58,138,.3));"/>
      <div>
        <p style="font-family:'Sora',sans-serif;font-weight:800;color:white;font-size:.9rem;line-height:1.2;">Klinik Sehat</p>
        <p style="font-size:.62rem;color:rgba(147,197,253,.8);">Sistem Layanan Klinik Digital</p>
      </div>
    </a>

    <div class="flex items-center gap-3">
      <a href="{{ route('rating.index') }}"
        style="font-size:.78rem;font-weight:700;color:rgba(147,197,253,.9);text-decoration:none;
          padding:6px 12px;border-radius:10px;border:1px solid rgba(255,255,255,.18);
          background:rgba(255,255,255,.08);transition:.2s;"
        onmouseover="this.style.background='rgba(255,255,255,.18)'"
        onmouseout="this.style.background='rgba(255,255,255,.08)'">
        ⭐ Cari RS / Rating
      </a>
      @auth('pasien')
        <span style="font-size:.8rem;font-weight:700;color:rgba(255,255,255,.7);">
          Halo, {{ Auth::guard('pasien')->user()->name }} 👋
        </span>
        <form method="POST" action="/logout" class="inline">@csrf
          <button type="submit" class="clay-btn btn-danger" style="padding:8px 18px;font-size:.8rem;">Logout</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="clay-btn btn-white" style="padding:8px 18px;font-size:.82rem;">Masuk</a>
      @endauth
    </div>
  </div>
</nav>

<main class="relative z-10 max-w-6xl mx-auto px-4 py-8">

  @if (session('success'))
    <div class="clay-card mb-6 p-4 flex items-center gap-3" style="border-left:4px solid #16a34a;">
      <span class="text-2xl">✅</span>
      <span style="font-weight:700;color:#16a34a;">{{ session('success') }}</span>
    </div>
  @endif
  @if (session('error'))
    <div class="clay-card mb-6 p-4 flex items-center gap-3" style="border-left:4px solid #dc2626;">
      <span class="text-2xl">❌</span>
      <span style="font-weight:700;color:#dc2626;">{{ session('error') }}</span>
    </div>
  @endif
  @if ($errors->any())
    <div class="clay-card mb-6 p-4" style="border-left:4px solid #dc2626;">
      <div class="flex items-center gap-2 mb-2">
        <span class="text-xl">⚠️</span>
        <span style="font-weight:800;color:#dc2626;">Ada kesalahan:</span>
      </div>
      <ul style="list-style:disc;padding-left:20px;">
        @foreach ($errors->all() as $error)
          <li style="color:#dc2626;font-weight:600;font-size:.875rem;">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @yield('content')
</main>

</body>
</html>
