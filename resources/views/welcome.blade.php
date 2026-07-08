<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Klinik Sehat — Layanan Kesehatan Digital</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800;900&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    *{box-sizing:border-box;margin:0;padding:0;}
    body{font-family:'DM Sans',sans-serif;background:#f0f4ff;overflow-x:hidden;color:#1e293b;}
    .blob{position:fixed;border-radius:50%;filter:blur(80px);pointer-events:none;z-index:0;}
    .blob-1{width:500px;height:500px;background:radial-gradient(circle,#bfdbfe,#93c5fd);opacity:.25;top:-120px;left:-120px;}
    .blob-2{width:400px;height:400px;background:radial-gradient(circle,#a5f3fc,#67e8f9);opacity:.18;bottom:-80px;right:-80px;}
    .top-nav{background:linear-gradient(135deg,#0f2057,#1e3a8a,#0369a1);position:sticky;top:0;z-index:100;box-shadow:0 4px 24px rgba(15,32,87,.35);}
    .nav-inner{max-width:1200px;margin:0 auto;padding:0 20px;height:64px;display:flex;align-items:center;justify-content:space-between;gap:12px;}
    .clay-card{background:#fff;border-radius:24px;box-shadow:8px 8px 24px rgba(99,149,210,.18),-2px -2px 8px rgba(255,255,255,.9),inset 3px 3px 8px rgba(255,255,255,.85),inset -3px -3px 8px rgba(180,210,245,.25);border:1.5px solid rgba(255,255,255,.8);}
    .clay-btn{border-radius:16px;font-weight:700;border:none;cursor:pointer;box-shadow:5px 5px 14px rgba(59,130,246,.3),-1px -1px 5px rgba(255,255,255,.7),inset 2px 2px 5px rgba(255,255,255,.35),inset -2px -2px 5px rgba(37,99,235,.2);transition:all .2s ease;display:inline-block;text-decoration:none;}
    .clay-btn:hover{transform:translateY(-2px) scale(1.01);}
    .btn-primary{background:linear-gradient(135deg,#1e3a8a,#2563eb);color:white;box-shadow:5px 5px 14px rgba(37,99,235,.35);}
    .btn-white{background:white;color:#2563eb;box-shadow:5px 5px 14px rgba(99,149,210,.2);border:1.5px solid #bfdbfe;}
    .btn-green{background:linear-gradient(135deg,#16a34a,#10b981);color:white;box-shadow:5px 5px 14px rgba(16,185,129,.3);}
    .hero-bg{background:linear-gradient(135deg,#0f2057 0%,#1e3a8a 45%,#1e40af 70%,#0369a1 100%);border-radius:28px;overflow:hidden;position:relative;box-shadow:8px 8px 32px rgba(15,32,87,.4),inset 3px 3px 12px rgba(255,255,255,.06);}
    .hero-bg::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 75% 25%,rgba(255,255,255,.07) 0%,transparent 55%),radial-gradient(ellipse at 20% 80%,rgba(56,189,248,.12) 0%,transparent 50%);pointer-events:none;}
    .hero-bg::after{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.045) 1px,transparent 1px);background-size:42px 42px;mask-image:linear-gradient(90deg,rgba(0,0,0,.68),transparent 72%);pointer-events:none;}
    .hero-shell{padding:2rem;}
    .hero-content{position:relative;}
    .hero-content::after{content:'';position:absolute;width:150px;height:150px;right:4%;bottom:-12%;border-radius:999px;background:radial-gradient(circle,rgba(103,232,249,.28),transparent 64%);filter:blur(4px);pointer-events:none;}
    .hero-title{font-family:'Sora',sans-serif;font-weight:900;font-size:clamp(2.3rem,4.4vw,4.2rem);color:white;line-height:1.05;margin-bottom:18px;letter-spacing:0;}
    .hero-title-accent{display:inline-block;background:linear-gradient(90deg,#93c5fd 0%,#c4b5fd 50%,#67e8f9 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent;}
    .hero-copy{color:rgba(191,219,254,.9);font-size:1rem;line-height:1.8;max-width:500px;margin-bottom:30px;}
    .hero-kicker{display:inline-flex;align-items:center;gap:10px;margin-bottom:22px;background:rgba(255,255,255,.12);border:1.5px solid rgba(255,255,255,.22);border-radius:999px;padding:.45rem 1rem;box-shadow:inset 0 1px 0 rgba(255,255,255,.16);}
    .hero-kicker-dot{width:9px;height:9px;border-radius:50%;background:#34d399;animation:pulse 1.5s infinite;display:inline-block;box-shadow:0 0 0 5px rgba(52,211,153,.14);}
    .hero-kicker-text{font-size:.74rem;font-weight:800;color:rgba(255,255,255,.88);letter-spacing:.06em;}
    .hero-stat-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px;}
    .hero-stat{min-height:132px;border-radius:22px;padding:24px 18px;text-align:center;display:flex;flex-direction:column;align-items:center;justify-content:center;}
    .hero-stat-white{background:rgba(255,255,255,.96);border:1.5px solid rgba(255,255,255,.85);box-shadow:0 10px 30px rgba(15,32,87,.18),inset 3px 3px 8px rgba(255,255,255,.9),inset -3px -3px 8px rgba(180,210,245,.25);}
    .hero-stat-green{background:linear-gradient(135deg,#16a34a,#10b981);box-shadow:0 12px 28px rgba(16,185,129,.28);}
    .hero-stat-purple{background:linear-gradient(135deg,#8b5cf6,#6d28d9);box-shadow:0 12px 28px rgba(109,40,217,.28);}
    .hero-stat-number{font-family:'Sora',sans-serif;font-weight:900;font-size:2.25rem;line-height:1;color:#2563eb;margin-bottom:12px;}
    .hero-stat-label{font-size:.72rem;font-weight:900;color:#64748b;text-transform:uppercase;letter-spacing:.06em;}
    .hero-stat-dark .hero-stat-number,.hero-stat-dark .hero-stat-label{color:white;}
    .hero-stat-dark .hero-stat-label{opacity:.82;}
    .hero-live-row{display:flex;flex-wrap:wrap;gap:10px;margin:22px 0 30px;}
    .hero-live-chip{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.10);border:1.5px solid rgba(255,255,255,.18);border-radius:14px;padding:9px 13px;color:#DBEAFE;font-size:.78rem;font-weight:800;backdrop-filter:blur(8px);}
    .hero-live-chip svg{width:16px;height:16px;color:#67E8F9;stroke-width:2.4;}
    .hero-stat{position:relative;overflow:hidden;transition:transform .22s ease,box-shadow .22s ease;}
    .hero-stat::after{content:'';position:absolute;width:90px;height:90px;right:-24px;top:-24px;border-radius:999px;background:rgba(255,255,255,.16);}
    .hero-stat:hover{transform:translateY(-5px);}
    .hero-stat-mini{margin-top:10px;font-size:.68rem;font-weight:800;color:#64748b;background:#EFF6FF;border:1px solid #BFDBFE;border-radius:999px;padding:4px 10px;}
    .hero-stat-dark .hero-stat-mini{color:rgba(255,255,255,.82);background:rgba(255,255,255,.16);border-color:rgba(255,255,255,.24);}
    .stat-pill{background:rgba(255,255,255,.14);border:1.5px solid rgba(255,255,255,.22);border-radius:50px;padding:.5rem 1rem;backdrop-filter:blur(8px);}
    .section-tag{display:inline-flex;align-items:center;gap:6px;background:#eff6ff;border:1.5px solid #bfdbfe;border-radius:999px;padding:5px 16px;font-size:.72rem;font-weight:800;color:#2563eb;letter-spacing:.05em;text-transform:uppercase;margin-bottom:12px;}
    .icon-wrap{width:58px;height:58px;border-radius:18px;display:flex;align-items:center;justify-content:center;color:white;}
    .icon-wrap svg{width:29px;height:29px;stroke-width:2.35;stroke:currentColor;fill:none;stroke-linecap:round;stroke-linejoin:round;}
    .feature-card{position:relative;overflow:hidden;min-height:245px;}
    .feature-card::after{content:'';position:absolute;width:130px;height:130px;right:-52px;top:-52px;border-radius:999px;background:radial-gradient(circle,rgba(59,130,246,.12),transparent 68%);pointer-events:none;}
    .feature-card:hover .icon-wrap{transform:translateY(-2px) scale(1.03);}
    .feature-card .icon-wrap{transition:transform .2s ease;}
    .feature-cta{display:inline-flex;align-items:center;gap:7px;margin-top:14px;font-size:.78rem;font-weight:900;color:#2563eb;}
    .float{animation:float 4s ease-in-out infinite;}
    .float-2{animation:float 5s ease-in-out infinite 1s;}
    .float-3{animation:float 6s ease-in-out infinite 2s;}
    @keyframes float{0%,100%{transform:translateY(0);}50%{transform:translateY(-8px);}}
    @keyframes pulse{0%,100%{opacity:1;}50%{opacity:.5;}}
    @media(max-width:768px){
      .nav-inner{height:auto;min-height:64px;flex-wrap:wrap;padding:12px 16px;}
      .hero-shell{padding:1.5rem;}
      .hero-stat-grid{grid-template-columns:1fr 1fr;gap:12px;}
      .hero-stat{min-height:104px;padding:18px 12px;}
      .hero-stat-number{font-size:1.8rem;}
      .hero-copy{font-size:.94rem;}
      .hero-live-row{margin:16px 0 24px;}
    }
  </style>
</head>
<body>
<div class="blob blob-1"></div>
<div class="blob blob-2"></div>

{{-- NAVBAR --}}
<nav class="top-nav">
  <div class="nav-inner">
    <a href="/" class="flex items-center gap-3" style="text-decoration:none;">
      <img src="https://uns.ac.id/id/wp-content/uploads/2023/06/logo-uns-biru.png" alt="UNS" style="height:34px;object-fit:contain;filter:drop-shadow(0 2px 6px rgba(30,58,138,.3));"/>
      <div>
        <p style="font-family:'Sora',sans-serif;font-weight:800;color:white;font-size:.95rem;">Klinik Sehat</p>
        <p style="font-size:.62rem;color:rgba(147,197,253,.8);">Sistem Layanan Klinik Digital</p>
      </div>
    </a>
    <div class="hidden md:flex items-center gap-6">
      <a href="#fitur" style="font-size:.85rem;font-weight:600;color:rgba(255,255,255,.8);text-decoration:none;">Fitur</a>
      <a href="#layanan" style="font-size:.85rem;font-weight:600;color:rgba(255,255,255,.8);text-decoration:none;">Layanan</a>
      <a href="#cara" style="font-size:.85rem;font-weight:600;color:rgba(255,255,255,.8);text-decoration:none;">Cara Pakai</a>
      <a href="{{ route('rating.index') }}" style="font-size:.85rem;font-weight:600;color:rgba(255,255,255,.8);text-decoration:none;">⭐ Rating RS</a>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ route('petugas.login') }}" style="font-size:.78rem;font-weight:700;color:rgba(147,197,253,.85);text-decoration:none;padding:6px 12px;border-radius:10px;border:1px solid rgba(255,255,255,.18);background:rgba(255,255,255,.08);">Akses Petugas</a>
      <a href="{{ route('login') }}" class="clay-btn btn-white" style="padding:8px 18px;font-size:.82rem;">Masuk</a>
      <a href="/register" class="clay-btn btn-primary" style="padding:8px 18px;font-size:.82rem;">Daftar</a>
    </div>
  </div>
</nav>

<div class="relative z-10 max-w-6xl mx-auto px-4 space-y-10 py-8">

  {{-- HERO --}}
  <div class="hero-bg hero-shell">
    <div class="relative z-10 hero-content grid md:grid-cols-[1.1fr_1fr] gap-10 items-center">
      <div>
        <h1 class="hero-title" style="font-size:clamp(2rem,3.8vw,3.5rem); margin-bottom:12px;">
          Layanan Kesehatan<br>
          <span class="hero-title-accent">Terbaik & Cepat</span>
        </h1>
        <p class="hero-copy" style="margin-bottom:24px;">
          Daftar periksa, pantau antrean secara real-time, dan berikan penilaian layanan dengan mudah melalui sistem digital Klinik Sehat.
        </p>
        <div class="flex flex-wrap gap-3">
          <a href="/register" class="clay-btn btn-primary" style="padding:12px 28px;font-size:.95rem;">Daftar Sekarang →</a>
          <a href="#cara" class="clay-btn btn-white" style="padding:12px 28px;font-size:.95rem;">Cara Pakai</a>
        </div>
      </div>
      <div class="hero-stat-grid">
        <div class="hero-stat hero-stat-white float" style="min-height:100px;">
          <div class="hero-stat-number">500+</div>
          <div class="hero-stat-label">Pasien</div>
        </div>
        <div class="hero-stat hero-stat-green hero-stat-dark float-2" style="min-height:100px;">
          <div class="hero-stat-number">4.8</div>
          <div class="hero-stat-label">Rating</div>
        </div>
        <div class="hero-stat hero-stat-purple hero-stat-dark float-3" style="min-height:100px;">
          <div class="hero-stat-number">24/7</div>
          <div class="hero-stat-label">Aktif</div>
        </div>
        <div class="hero-stat hero-stat-white float" style="min-height:100px;">
          <div class="hero-stat-number">14</div>
          <div class="hero-stat-label">RS Madiun</div>
        </div>
      </div>
    </div>
  </div>

  {{-- FITUR UNGGULAN --}}
  <section id="fitur">
    <div class="text-center mb-8">
      <div class="section-tag">✨ Fitur Unggulan</div>
      <h2 style="font-family:'Sora',sans-serif;font-weight:800;font-size:1.8rem;color:#1e293b;">Semua yang Kamu Butuhkan</h2>
      <p style="color:#64748b;margin-top:8px;">Satu platform lengkap untuk pasien dan petugas klinik.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
      @php $fitur = [
        ['icon'=>'clipboard','bg'=>'linear-gradient(135deg,#1e3a8a,#2563eb)','shadow'=>'rgba(37,99,235,.35)','title'=>'Pendaftaran Online','desc'=>'Daftar BPJS maupun umum dari mana saja. Tidak perlu antre di loket.','tags'=>['BPJS','Non-BPJS']],
        ['icon'=>'clock','bg'=>'linear-gradient(135deg,#16a34a,#10b981)','shadow'=>'rgba(16,185,129,.3)','title'=>'Antrean Real-Time','desc'=>'Pantau nomor antrean dan estimasi waktu tunggu. Notifikasi suara saat dipanggil.','tags'=>['Live','Suara']],
        ['icon'=>'star','bg'=>'linear-gradient(135deg,#d97706,#f59e0b)','shadow'=>'rgba(245,158,11,.3)','title'=>'Rating & Survei','desc'=>'Nilai layanan setelah kunjungan. Temukan klinik terbaik di Karesidenan Madiun.','tags'=>['Per Kunjungan','Publik']],
        ['icon'=>'medical','bg'=>'linear-gradient(135deg,#7c3aed,#6d28d9)','shadow'=>'rgba(109,40,217,.3)','title'=>'Rekam Medis SOAP','desc'=>'Dokter input rekam medis terstruktur. Tersimpan aman dan mudah diakses.','tags'=>['SOAP','Aman']],
        ['icon'=>'users','bg'=>'linear-gradient(135deg,#0891b2,#0284c7)','shadow'=>'rgba(2,132,199,.3)','title'=>'Kelola Staff & Pasien','desc'=>'Admin kelola akun dokter, petugas, dan data pasien dari satu dashboard.','tags'=>['Admin','Dokter']],
        ['icon'=>'hospital','bg'=>'linear-gradient(135deg,#0f2057,#1e3a8a)','shadow'=>'rgba(15,32,87,.35)','title'=>'14 RS Madiun','desc'=>'Mencakup RSUD dan RS swasta se-Karesidenan Madiun. Data nyata dan akurat.','tags'=>['Madiun','Karesidenan']],
      ]; @endphp
      @foreach($fitur as $f)
      <div class="clay-card feature-card p-6 hover:-translate-y-1 transition-transform duration-200">
        <div class="icon-wrap mb-4" style="background:{{ $f['bg'] }};box-shadow:4px 4px 10px {{ $f['shadow'] }};">
          @switch($f['icon'])
            @case('clipboard')
              <svg viewBox="0 0 24 24"><path d="M9 5h6"/><path d="M9 3h6a2 2 0 0 1 2 2v1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1V5a2 2 0 0 1 2-2Z"/><path d="M8 12h8"/><path d="M8 16h5"/></svg>
              @break
            @case('clock')
              <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
              @break
            @case('star')
              <svg viewBox="0 0 24 24"><path d="m12 3 2.7 5.5 6.1.9-4.4 4.3 1 6.1L12 16.9l-5.4 2.9 1-6.1-4.4-4.3 6.1-.9L12 3z"/></svg>
              @break
            @case('medical')
              <svg viewBox="0 0 24 24"><path d="M8 7V4h8v3"/><path d="M6 21h12a2 2 0 0 0 2-2v-9H4v9a2 2 0 0 0 2 2Z"/><path d="M10 14h4"/><path d="M12 12v4"/></svg>
              @break
            @case('users')
              <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              @break
            @default
              <svg viewBox="0 0 24 24"><path d="M3 21h18"/><path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/><path d="M9 21v-6h6v6"/><path d="M9 7h.01"/><path d="M15 7h.01"/><path d="M9 11h.01"/><path d="M15 11h.01"/></svg>
          @endswitch
        </div>
        <h3 style="font-family:'Sora',sans-serif;font-weight:700;font-size:1rem;color:#1e293b;margin-bottom:8px;">{{ $f['title'] }}</h3>
        <p style="color:#64748b;font-size:.875rem;line-height:1.6;margin-bottom:12px;">{{ $f['desc'] }}</p>
        <div class="flex flex-wrap gap-2">
          @foreach($f['tags'] as $tag)
            <span style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:999px;padding:3px 10px;font-size:.68rem;font-weight:700;color:#2563eb;">{{ $tag }}</span>
          @endforeach
        </div>
        <span class="feature-cta">Lihat detail <span>→</span></span>
      </div>
      @endforeach
    </div>
  </section>

  {{-- LAYANAN POLI --}}
  <section id="layanan">
    <div class="hero-bg p-8 md:p-10">
      <div class="relative z-10 text-center mb-8">
        <div class="inline-block mb-4" style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);border-radius:999px;padding:5px 16px;font-size:.72rem;font-weight:800;color:white;text-transform:uppercase;letter-spacing:.05em;">🏥 Layanan Poli</div>
        <h2 style="font-family:'Sora',sans-serif;font-weight:800;font-size:1.8rem;color:white;">Tersedia Berbagai Poli</h2>
        <p style="color:rgba(147,197,253,.9);margin-top:8px;">Pilih poli sesuai kebutuhan saat pendaftaran</p>
      </div>
      <div class="relative z-10 flex flex-wrap justify-center gap-3">
        @php $polis=[['🦷','Poli Gigi'],['👶','Poli Anak'],['🫀','Poli Jantung'],['🧠','Poli Saraf'],['👁️','Poli Mata'],['🦴','Poli Ortopedi'],['🫁','Poli Paru'],['🩺','Poli Umum'],['🧪','Lab & Farmasi'],['🤰','Poli Kandungan'],['🦿','Poli Bedah'],['🧬','Poli Penyakit Dalam']]; @endphp
        @foreach($polis as [$icon,$nama])
          <div style="background:rgba(255,255,255,.14);border:1.5px solid rgba(255,255,255,.22);border-radius:14px;padding:10px 18px;display:inline-flex;align-items:center;gap:8px;font-weight:700;color:white;font-size:.85rem;backdrop-filter:blur(8px);">
            <span style="font-size:1.2rem;">{{ $icon }}</span> {{ $nama }}
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- CARA PAKAI --}}
  <section id="cara">
    <div class="text-center mb-8">
      <div class="section-tag">📋 Cara Pakai</div>
      <h2 style="font-family:'Sora',sans-serif;font-weight:800;font-size:1.8rem;color:#1e293b;">Mudah dalam 4 Langkah</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
      @php $steps=[
        ['1','👤','Buat Akun','Daftar dengan NIK, email, dan nomor HP kamu.','#1e3a8a'],
        ['2','📝','Daftar Periksa','Pilih RS, poli, dan dokter — atau lihat rating dulu.','#16a34a'],
        ['3','⏰','Pantau Antrean','Lihat nomor antrean dan estimasi waktu real-time.','#7c3aed'],
        ['4','⭐','Beri Penilaian','Nilai layanan setelah kunjungan selesai.','#d97706'],
      ]; @endphp
      @foreach($steps as [$no,$icon,$title,$desc,$color])
      <div class="clay-card p-6 text-center">
        <div style="width:52px;height:52px;border-radius:16px;background:{{ $color }};display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:1.5rem;box-shadow:4px 4px 10px rgba(0,0,0,.15);">{{ $icon }}</div>
        <div style="font-size:.65rem;font-weight:800;color:#94a3b8;text-transform:uppercase;letter-spacing:.08em;margin-bottom:4px;">Langkah {{ $no }}</div>
        <h3 style="font-family:'Sora',sans-serif;font-weight:700;color:#1e293b;margin-bottom:6px;">{{ $title }}</h3>
        <p style="font-size:.83rem;color:#64748b;line-height:1.6;">{{ $desc }}</p>
      </div>
      @endforeach
    </div>
  </section>

  {{-- TESTIMONI --}}
  <section>
    <div class="text-center mb-8">
      <div class="section-tag">💬 Testimoni</div>
      <h2 style="font-family:'Sora',sans-serif;font-weight:800;font-size:1.8rem;color:#1e293b;">Kata Mereka</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
      @php $testi=[
        ['Budi Santoso','Mahasiswa UNS',5,'Sistem antreannya sangat membantu! Tidak perlu nunggu lama di klinik, bisa pantau dari HP.'],
        ['dr. Andi Susanto','Dokter RSUD Soedono',5,'Input rekam medis jadi jauh lebih efisien. Dashboard clean dan mudah digunakan.'],
        ['Siti Rahayu','Karyawan UNS',4,'Pendaftaran BPJS online sangat memudahkan. Bisa pilih poli terbaik dari rating dulu.'],
      ]; @endphp
      @foreach($testi as [$nama,$peran,$bintang,$pesan])
      <div class="clay-card p-6">
        <div class="flex gap-0.5 mb-4">
          @for($i=1;$i<=5;$i++) <span style="font-size:1.1rem;color:{{ $i<=$bintang?'#f59e0b':'#e2e8f0' }};">★</span> @endfor
        </div>
        <p style="color:#475569;line-height:1.7;font-size:.875rem;font-style:italic;margin-bottom:16px;">"{{ $pesan }}"</p>
        <div class="flex items-center gap-3">
          <div style="width:38px;height:38px;border-radius:12px;background:linear-gradient(135deg,#1e3a8a,#2563eb);display:flex;align-items:center;justify-content:center;font-weight:800;color:white;font-size:.9rem;">{{ substr($nama,0,1) }}</div>
          <div>
            <div style="font-weight:800;color:#1e293b;font-size:.875rem;">{{ $nama }}</div>
            <div style="font-size:.72rem;color:#94a3b8;font-weight:600;">{{ $peran }}</div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </section>

  {{-- DATA BPS --}}
  <section id="statistik-bps">
    <div class="text-center mb-8">
      <div class="section-tag">📊 Data BPS Indonesia</div>
      <h2 style="font-family:'Sora',sans-serif;font-weight:800;font-size:1.8rem;color:#1e293b;">Statistik Fasilitas Kesehatan Nasional</h2>
      <p style="color:#64748b;margin-top:8px;">Data resmi dari <span style="font-weight:800;color:#1e3a8a;">Badan Pusat Statistik (BPS)</span>, diambil secara real-time.</p>
    </div>

    <div id="bps-loading" style="display:none;" class="clay-card p-10 text-center">
      <div style="display:flex;align-items:center;justify-content:center;gap:12px;color:#2563eb;">
        <svg style="animation:spin 1s linear infinite;width:22px;height:22px;" fill="none" viewBox="0 0 24 24">
          <circle style="opacity:.25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path style="opacity:.75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
        </svg>
        <span style="font-weight:700;">Mengambil data dari API BPS...</span>
      </div>
    </div>

    <div id="bps-error" style="display:none;" class="clay-card p-8 text-center">
      <div style="font-size:2rem;margin-bottom:8px;">⚠️</div>
      <p style="font-weight:700;color:#dc2626;">Gagal mengambil data dari API BPS.</p>
      <p style="color:#94a3b8;font-size:.85rem;margin-top:4px;">Coba refresh halaman atau kunjungi <a href="https://www.bps.go.id" target="_blank" style="color:#2563eb;">bps.go.id</a></p>
    </div>

    <div id="bps-data">
      <div id="bps-cards" style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px;margin-bottom:20px;" class="md:grid-cols-4"></div>
      <div class="clay-card" style="overflow:hidden;">
        <div style="padding:20px 28px;border-bottom:1.5px solid #e0f2fe;">
          <h3 style="font-family:'Sora',sans-serif;font-weight:700;color:#1e293b;">🗺️ Data Fasilitas Kesehatan per Provinsi</h3>
          <p id="bps-source-label" style="font-size:.72rem;color:#94a3b8;font-weight:600;margin-top:2px;">Sumber: webapi.bps.go.id</p>
        </div>
        <div style="overflow-x:auto;">
          <table style="width:100%;text-align:left;font-size:.85rem;border-collapse:collapse;">
            <thead>
              <tr id="bps-thead-row" style="background:#f0f9ff;">
                <th style="padding:12px 20px;font-size:.68rem;font-weight:800;color:#0369a1;text-transform:uppercase;letter-spacing:.05em;">Provinsi</th>
              </tr>
            </thead>
            <tbody id="bps-table-body"></tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <style>
    @keyframes spin { to { transform: rotate(360deg); } }
    #bps-cards > div { border-radius: 20px; padding: 20px; text-align: center; }
  </style>

  <script>
  const BPS_DATA = {
    tahun: '2023', source: 'BPS RI, Statistik Indonesia 2023',
    kolom: [
      { key:'rsUmum',   nama:'RS Umum'         },
      { key:'rsKhusus', nama:'RS Khusus'        },
      { key:'pkmRI',    nama:'Puskesmas RI'     },
      { key:'pkmNonRI', nama:'Puskesmas Non-RI' },
    ],
    rows: [
      { label:'Aceh',                  rsUmum:24,  rsKhusus:14,  pkmRI:118, pkmNonRI:223 },
      { label:'Sumatera Utara',        rsUmum:87,  rsKhusus:97,  pkmRI:220, pkmNonRI:362 },
      { label:'Sumatera Barat',        rsUmum:27,  rsKhusus:9,   pkmRI:101, pkmNonRI:157 },
      { label:'Riau',                  rsUmum:33,  rsKhusus:13,  pkmRI:74,  pkmNonRI:163 },
      { label:'Jambi',                 rsUmum:20,  rsKhusus:3,   pkmRI:75,  pkmNonRI:122 },
      { label:'Sumatera Selatan',      rsUmum:33,  rsKhusus:13,  pkmRI:101, pkmNonRI:226 },
      { label:'Bengkulu',              rsUmum:12,  rsKhusus:2,   pkmRI:57,  pkmNonRI:124 },
      { label:'Lampung',               rsUmum:23,  rsKhusus:10,  pkmRI:91,  pkmNonRI:218 },
      { label:'DKI Jakarta',           rsUmum:81,  rsKhusus:169, pkmRI:44,  pkmNonRI:300 },
      { label:'Jawa Barat',            rsUmum:117, rsKhusus:83,  pkmRI:279, pkmNonRI:804 },
      { label:'Jawa Tengah',           rsUmum:99,  rsKhusus:61,  pkmRI:347, pkmNonRI:531 },
      { label:'DI Yogyakarta',         rsUmum:28,  rsKhusus:27,  pkmRI:36,  pkmNonRI:85  },
      { label:'Jawa Timur',            rsUmum:122, rsKhusus:72,  pkmRI:443, pkmNonRI:526, hl:true },
      { label:'Bali',                  rsUmum:21,  rsKhusus:14,  pkmRI:42,  pkmNonRI:78  },
      { label:'Nusa Tenggara Barat',   rsUmum:14,  rsKhusus:4,   pkmRI:76,  pkmNonRI:99  },
      { label:'Nusa Tenggara Timur',   rsUmum:16,  rsKhusus:2,   pkmRI:148, pkmNonRI:272 },
      { label:'Kalimantan Barat',      rsUmum:22,  rsKhusus:4,   pkmRI:79,  pkmNonRI:157 },
      { label:'Kalimantan Tengah',     rsUmum:15,  rsKhusus:2,   pkmRI:77,  pkmNonRI:157 },
      { label:'Kalimantan Selatan',    rsUmum:22,  rsKhusus:11,  pkmRI:80,  pkmNonRI:157 },
      { label:'Kalimantan Timur',      rsUmum:23,  rsKhusus:9,   pkmRI:69,  pkmNonRI:124 },
      { label:'Sulawesi Utara',        rsUmum:18,  rsKhusus:6,   pkmRI:74,  pkmNonRI:111 },
      { label:'Sulawesi Tengah',       rsUmum:13,  rsKhusus:2,   pkmRI:87,  pkmNonRI:140 },
      { label:'Sulawesi Selatan',      rsUmum:56,  rsKhusus:24,  pkmRI:179, pkmNonRI:295 },
      { label:'Maluku',                rsUmum:12,  rsKhusus:1,   pkmRI:72,  pkmNonRI:124 },
      { label:'Papua',                 rsUmum:12,  rsKhusus:2,   pkmRI:150, pkmNonRI:340 },
    ]
  };

  function renderBPS() {
    const elCards  = document.getElementById('bps-cards');
    const elTbody  = document.getElementById('bps-table-body');
    const elSource = document.getElementById('bps-source-label');
    const elThead  = document.getElementById('bps-thead-row');
    const { kolom, rows, tahun, source } = BPS_DATA;
    elSource.textContent = 'Sumber: ' + source + ' (data statis ' + tahun + ')';
    const sum = k => rows.reduce((a, r) => a + (r[k] || 0), 0);
    const cardMeta = [
      { icon:'🏥', bg:'linear-gradient(135deg,#0f2057,#1e3a8a)', sh:'rgba(15,32,87,.4)'   },
      { icon:'🏨', bg:'linear-gradient(135deg,#0369a1,#0ea5e9)', sh:'rgba(3,105,161,.35)' },
      { icon:'🩺', bg:'linear-gradient(135deg,#16a34a,#10b981)', sh:'rgba(16,185,129,.3)' },
      { icon:'🏪', bg:'linear-gradient(135deg,#d97706,#f59e0b)', sh:'rgba(245,158,11,.3)' },
    ];
    elCards.style.gridTemplateColumns = 'repeat(4,1fr)';
    elCards.innerHTML = kolom.slice(0,4).map(function(k, i) {
      const m = cardMeta[i];
      const val = sum(k.key).toLocaleString('id-ID');
      return '<div style="background:' + m.bg + ';box-shadow:5px 5px 14px ' + m.sh + ';">'
           + '<div style="font-size:2rem;margin-bottom:8px;">' + m.icon + '</div>'
           + '<div style="font-family:Sora,sans-serif;font-weight:900;font-size:1.8rem;color:white;margin-bottom:4px;">' + val + '</div>'
           + '<div style="font-size:.68rem;font-weight:800;color:rgba(255,255,255,.8);text-transform:uppercase;letter-spacing:.05em;">' + k.nama + '</div>'
           + '<div style="font-size:.6rem;color:rgba(255,255,255,.55);margin-top:3px;">Indonesia ' + tahun + '</div>'
           + '</div>';
    }).join('');
    if (elThead) {
      elThead.innerHTML = '<th style="padding:10px 20px;font-size:.68rem;font-weight:800;color:#0369a1;text-transform:uppercase;letter-spacing:.05em;">Provinsi</th>'
        + kolom.map(k => '<th style="padding:10px 20px;font-size:.68rem;font-weight:800;color:#0369a1;text-transform:uppercase;letter-spacing:.05em;text-align:center;">' + k.nama + '</th>').join('');
    }
    elTbody.innerHTML = rows.map(function(r) {
      const hl    = r.hl ? 'background:#eff6ff;' : '';
      const pin   = r.hl ? '📍 ' : '';
      const badge = r.hl ? '<span style="margin-left:6px;font-size:.65rem;font-weight:800;color:#1e3a8a;background:#dbeafe;padding:2px 8px;border-radius:999px;">Jawa Timur</span>' : '';
      const cols  = kolom.map(k => '<td style="padding:10px 20px;text-align:center;font-weight:700;color:#475569;">' + r[k.key] + '</td>').join('');
      return '<tr style="border-bottom:1.5px solid #e0f2fe;' + hl + '">'
           + '<td style="padding:10px 20px;font-weight:800;color:#1e293b;">' + pin + r.label + badge + '</td>'
           + cols + '</tr>';
    }).join('');
    document.getElementById('bps-loading').style.display = 'none';
    document.getElementById('bps-data').style.display    = 'block';
  }
  renderBPS();
  </script>

  {{-- CTA --}}
  <section>
    <div class="hero-bg p-10 md:p-14 text-center relative">
      <div class="relative z-10">
        <div style="font-size:3rem;margin-bottom:12px;">🏥</div>
        <h2 style="font-family:'Sora',sans-serif;font-weight:800;font-size:2rem;color:white;margin-bottom:12px;">Siap Mulai?</h2>
        <p style="color:rgba(147,197,253,.9);font-size:.95rem;max-width:400px;margin:0 auto 24px;line-height:1.7;">Daftar sekarang dan rasakan kemudahan layanan kesehatan digital di Karesidenan Madiun.</p>
        <div class="flex flex-wrap justify-center gap-4">
          <a href="/register" class="clay-btn btn-primary" style="padding:12px 32px;font-size:1rem;">Daftar Gratis Sekarang →</a>
          <a href="{{ route('rating.index') }}" class="clay-btn btn-white" style="padding:12px 32px;font-size:1rem;">Lihat Rating RS</a>
        </div>
      </div>
    </div>
  </section>

</div>

{{-- FOOTER --}}
<footer class="relative z-10 text-center py-8" style="color:#94a3b8;font-size:.82rem;">
  <div class="flex items-center justify-center gap-2 mb-2">
    <img src="https://uns.ac.id/id/wp-content/uploads/2023/06/logo-uns-biru.png" alt="UNS" style="height:20px;opacity:.5;"/>
    <span>Klinik Sehat — Sistem Manajemen Klinik Digital</span>
  </div>
  &copy; {{ date('Y') }} Tim semogasehatselalu · Sekolah Vokasi UNS
</footer>

</body>
</html>
