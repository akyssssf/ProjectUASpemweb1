<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cari RS & Rating — Klinik Sehat</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    *{box-sizing:border-box;margin:0;padding:0;}
    body{font-family:'DM Sans',sans-serif;background:#f0f4ff;min-height:100vh;color:#1e293b;overflow-x:hidden;}

    /* Background mesh */
    .bg-mesh{position:fixed;inset:0;z-index:0;pointer-events:none;
      background:
        radial-gradient(ellipse 60% 50% at 5% 10%,rgba(99,143,247,.14) 0%,transparent 60%),
        radial-gradient(ellipse 50% 60% at 95% 85%,rgba(52,211,153,.10) 0%,transparent 60%),
        radial-gradient(ellipse 80% 80% at 50% 50%,rgba(240,244,255,1) 0%,transparent 100%);}

    /* Blobs */
    .blob{position:fixed;border-radius:50%;filter:blur(80px);pointer-events:none;z-index:0;}
    .blob-1{width:500px;height:500px;background:radial-gradient(circle,#bfdbfe,#93c5fd);opacity:.3;top:-120px;left:-120px;}
    .blob-2{width:400px;height:400px;background:radial-gradient(circle,#a5f3fc,#67e8f9);opacity:.2;bottom:-80px;right:-80px;}

    /* Nav */
    .top-nav{background:linear-gradient(135deg,#0f2057,#1e3a8a,#0369a1);
      position:sticky;top:0;z-index:100;box-shadow:0 4px 24px rgba(15,32,87,.35);}
    .nav-inner{max-width:1200px;margin:0 auto;padding:0 20px;height:64px;
      display:flex;align-items:center;justify-content:space-between;gap:12px;}

    /* Clay Cards */
    .clay-card{background:#fff;border-radius:28px;
      box-shadow:8px 8px 24px rgba(99,149,210,.18),-2px -2px 8px rgba(255,255,255,.9),
        inset 3px 3px 8px rgba(255,255,255,.85),inset -3px -3px 8px rgba(180,210,245,.25);
      border:1.5px solid rgba(255,255,255,.8);}
    .clay-card-hover{transition:transform .25s ease,box-shadow .25s ease;cursor:pointer;}
    .clay-card-hover:hover{transform:translateY(-4px);
      box-shadow:12px 16px 32px rgba(99,149,210,.25),-2px -2px 10px rgba(255,255,255,.95),
        inset 3px 3px 8px rgba(255,255,255,.85),inset -3px -3px 8px rgba(180,210,245,.25);}
    .clay-card-hover.active-card{transform:translateY(-4px);
      box-shadow:0 0 0 3px #2563eb,12px 16px 32px rgba(37,99,235,.25);}

    /* Buttons */
    .clay-btn{border-radius:16px;font-weight:700;border:none;cursor:pointer;
      box-shadow:5px 5px 14px rgba(59,130,246,.3),-1px -1px 5px rgba(255,255,255,.7),
        inset 2px 2px 5px rgba(255,255,255,.35),inset -2px -2px 5px rgba(37,99,235,.2);
      transition:all .2s ease;}
    .clay-btn:hover{transform:translateY(-2px) scale(1.01);}
    .clay-btn:active{transform:translateY(0) scale(.98);}
    .clay-btn-sm{box-shadow:3px 3px 8px rgba(59,130,246,.25),-1px -1px 4px rgba(255,255,255,.6);}

    /* Hero */
    .hero-bg{background:linear-gradient(135deg,#0f2057 0%,#1e3a8a 45%,#1e40af 70%,#0369a1 100%);
      border-radius:28px;overflow:hidden;position:relative;
      box-shadow:8px 8px 32px rgba(15,32,87,.4),inset 3px 3px 12px rgba(255,255,255,.06);}
    .hero-bg::before{content:'';position:absolute;inset:0;
      background:radial-gradient(ellipse at 75% 25%,rgba(255,255,255,.07) 0%,transparent 55%),
        radial-gradient(ellipse at 20% 80%,rgba(56,189,248,.12) 0%,transparent 50%);
      pointer-events:none;}

    /* Stat pill */
    .stat-pill{background:rgba(255,255,255,.14);border:1.5px solid rgba(255,255,255,.22);
      border-radius:50px;padding:.4rem .9rem;backdrop-filter:blur(8px);}

    /* Rating stars */
    .star-filled{color:#f59e0b;}
    .star-empty{color:#e2e8f0;}

    /* Rating bar */
    .rating-bar-bg{background:#e2e8f0;border-radius:999px;overflow:hidden;height:8px;}
    .rating-bar-fill{height:100%;border-radius:999px;background:linear-gradient(90deg,#f59e0b,#fbbf24);}

    /* Poli badge */
    .poli-badge{display:inline-flex;align-items:center;gap:5px;
      background:#eff6ff;border:1.5px solid #bfdbfe;border-radius:10px;
      padding:5px 12px;font-size:.78rem;font-weight:600;color:#2563eb;
      transition:all .15s ease;cursor:pointer;}
    .poli-badge:hover,.poli-badge.active{background:#2563eb;color:#fff;border-color:#2563eb;}
    .poli-badge.best{background:#f0fdf4;border-color:#86efac;color:#16a34a;}
    .poli-badge.best:hover,.poli-badge.best.active{background:#16a34a;color:#fff;border-color:#16a34a;}

    /* Input */
    .clay-input{background:#f1f8ff;border:1.5px solid rgba(147,197,253,.55);border-radius:14px;
      box-shadow:inset 2px 2px 5px rgba(180,210,245,.3),inset -2px -2px 5px rgba(255,255,255,.8);
      outline:none;width:100%;padding:.7rem 1rem;font-size:.9rem;color:#1e293b;
      transition:border-color .2s,box-shadow .2s;font-family:'DM Sans',sans-serif;}
    .clay-input:focus{border-color:#3b82f6;box-shadow:0 0 0 3px rgba(59,130,246,.12),inset 2px 2px 5px rgba(180,210,245,.3);}

    /* Select */
    .clay-select{background:#f1f8ff;border:1.5px solid rgba(147,197,253,.55);border-radius:14px;
      box-shadow:inset 2px 2px 5px rgba(180,210,245,.3);
      outline:none;width:100%;padding:.7rem 1rem;font-size:.9rem;color:#1e293b;
      transition:border-color .2s;font-family:'DM Sans',sans-serif;appearance:none;}
    .clay-select:focus{border-color:#3b82f6;box-shadow:0 0 0 3px rgba(59,130,246,.12);}

    /* Detail panel */
    .detail-panel{display:none;}
    .detail-panel.open{display:block;}

    /* Animated badge */
    .badge-new{background:linear-gradient(135deg,#f59e0b,#fbbf24);color:#fff;
      border-radius:999px;padding:2px 8px;font-size:.65rem;font-weight:800;letter-spacing:.05em;}

    /* Search bar */
    .search-wrap{position:relative;}
    .search-wrap svg{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#94a3b8;pointer-events:none;}
    .search-wrap input{padding-left:42px;}

    /* Smooth transition */
    .fade-in{animation:fadeIn .3s ease;}
    @keyframes fadeIn{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}

    /* Mobile */
    @media(max-width:768px){
      .hero-bg{border-radius:20px;}
      .clay-card{border-radius:20px;}
      .desktop-only{display:none;}
    }
  </style>
</head>
<body class="overflow-x-hidden">
<div class="bg-mesh"></div>
<div class="blob blob-1"></div>
<div class="blob blob-2"></div>

{{-- NAVBAR --}}
<nav class="top-nav">
  <div class="nav-inner">
    <div class="flex items-center gap-3">
      <img src="https://uns.ac.id/id/wp-content/uploads/2023/06/logo-uns-biru.png" alt="UNS" class="h-9 object-contain" style="filter:drop-shadow(0 2px 6px rgba(30,58,138,.3))"/>
      <div>
        <p style="font-family:'Sora',sans-serif;font-weight:800;color:white;font-size:.9rem;">Klinik Sehat</p>
        <p style="font-size:.65rem;color:rgba(147,197,253,.85);">Sistem Layanan Klinik Digital</p>
      </div>
    </div>
    <div class="flex items-center gap-3">
      @auth('pasien')
        <a href="/dashboard" class="clay-btn clay-btn-sm bg-white text-blue-700 px-4 py-2 text-xs">Dashboard →</a>
        <form method="POST" action="/logout" class="inline">@csrf
          <button class="clay-btn clay-btn-sm bg-red-500 text-white px-4 py-2 text-xs">Logout</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="text-xs font-bold text-blue-200 hover:text-white transition-colors px-3 py-2 rounded-xl" style="border:1px solid rgba(255,255,255,.2);background:rgba(255,255,255,.08);">Masuk</a>
        <a href="/register" class="clay-btn clay-btn-sm px-4 py-2 text-xs text-white" style="background:linear-gradient(135deg,#3b82f6,#2563eb);">Daftar Gratis</a>
      @endauth
    </div>
  </div>
</nav>

<div class="relative z-10 max-w-6xl mx-auto px-4 py-8 space-y-6">

  {{-- HERO --}}
  <div class="hero-bg p-8 md:p-10">
    <div class="relative z-10">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
          <div class="inline-flex items-center gap-2 mb-4" style="background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);border-radius:999px;padding:.35rem .9rem;">
            <span class="w-2 h-2 rounded-full bg-emerald-400" style="animation:pulse 1.5s infinite;"></span>
            <span style="font-size:.72rem;font-weight:700;color:rgba(255,255,255,.85);letter-spacing:.05em;">SISTEM AKTIF · REAL-TIME</span>
          </div>
          <h1 style="font-family:'Sora',sans-serif;font-weight:800;font-size:2rem;color:white;line-height:1.2;" class="mb-3">
            Temukan Klinik &<br/>Poli Terbaik untuk Anda
          </h1>
          <p style="color:rgba(147,197,253,.9);font-size:.9rem;max-width:480px;line-height:1.7;">
            Bandingkan rating, baca ulasan pasien nyata, dan langsung daftar antrian — semua dari satu halaman ini.
          </p>
        </div>
        <div class="flex flex-wrap gap-3">
          <div class="stat-pill text-center">
            <div style="font-family:'Sora',sans-serif;font-weight:800;font-size:1.5rem;color:white;">{{ $kliniks->count() }}</div>
            <div style="font-size:.65rem;color:rgba(147,197,253,.8);font-weight:600;">RS / Klinik</div>
          </div>
          <div class="stat-pill text-center">
            <div style="font-family:'Sora',sans-serif;font-weight:800;font-size:1.5rem;color:#fbbf24;">
              {{ number_format($kliniks->avg('surveis_avg_rating') ?? 0, 1) }}
            </div>
            <div style="font-size:.65rem;color:rgba(147,197,253,.8);font-weight:600;">Avg Rating</div>
          </div>
          <div class="stat-pill text-center">
            <div style="font-family:'Sora',sans-serif;font-weight:800;font-size:1.5rem;color:white;">{{ $kliniks->sum('surveis_count') }}</div>
            <div style="font-size:.65rem;color:rgba(147,197,253,.8);font-weight:600;">Ulasan</div>
          </div>
        </div>
      </div>

      {{-- Search & Filter --}}
      <div class="mt-7 flex flex-col sm:flex-row gap-3">
        <div class="search-wrap flex-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          <input type="text" id="searchRS" class="clay-input" placeholder="Cari nama rumah sakit..." oninput="filterRS()">
        </div>
        <div class="relative">
          <select id="filterPoli" class="clay-select pr-8" onchange="filterRS()" style="min-width:180px;">
            <option value="">Semua Poli</option>
            @foreach($semuaPoli as $namaPoli)
              <option value="{{ $namaPoli }}" {{ request('poli') == $namaPoli ? 'selected' : '' }}>{{ $namaPoli }}</option>
            @endforeach
          </select>
        </div>
        <div class="relative">
          <select id="sortBy" class="clay-select pr-8" onchange="filterRS()" style="min-width:160px;">
            <option value="rating">Rating Tertinggi</option>
            <option value="ulasan">Ulasan Terbanyak</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  @if (session('success'))
  <div class="clay-card p-4 flex items-center gap-3" style="border-left:4px solid #16a34a;">
    <span class="text-2xl">✅</span><span class="font-bold text-green-700">{{ session('success') }}</span>
  </div>
  @endif

  {{-- GRID RS --}}
  <div id="rs-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    @forelse($kliniks as $klinik)
    <div class="clay-card clay-card-hover rs-card fade-in"
      data-nama="{{ strtolower($klinik->nama) }}"
      data-rating="{{ $klinik->surveis_avg_rating ?? 0 }}"
      data-ulasan="{{ $klinik->surveis_count }}"
      data-poli="{{ $klinik->polis->pluck('nama')->map(fn($n)=>strtolower($n))->implode(',') }}"
      onclick="bukaDetail({{ $klinik->id }}, this)">

      <div class="p-5">
        {{-- Header --}}
        <div class="flex justify-between items-start gap-3 mb-3">
          <div class="flex-1">
            <div class="flex items-center gap-2 mb-1">
              <span class="text-lg">🏥</span>
              <h3 style="font-family:'Sora',sans-serif;font-weight:700;font-size:.95rem;color:#1e293b;line-height:1.3;">{{ $klinik->nama }}</h3>
            </div>
          </div>
          <div class="flex-shrink-0 text-center" style="background:linear-gradient(135deg,#fffbeb,#fef3c7);border:1.5px solid #fde68a;border-radius:14px;padding:6px 10px;">
            <div style="font-family:'Sora',sans-serif;font-weight:800;font-size:1.1rem;color:#d97706;">
              {{ $klinik->surveis_avg_rating ? number_format($klinik->surveis_avg_rating, 1) : '—' }}
            </div>
            <div class="flex gap-0.5 justify-center mt-0.5">
              @for($i=1;$i<=5;$i++)
                <span style="font-size:.65rem;color:{{ $i<=round($klinik->surveis_avg_rating??0)?'#f59e0b':'#e2e8f0' }};">★</span>
              @endfor
            </div>
            <div style="font-size:.6rem;color:#92400e;font-weight:600;">{{ $klinik->surveis_count }} ulasan</div>
          </div>
        </div>

        {{-- Poli terbaik (max 4) --}}
        <div class="flex flex-wrap gap-1.5 mb-4">
          @foreach($klinik->polis->sortByDesc('surveis_avg_rating')->take(4) as $idx => $poli)
            <span class="poli-badge {{ $idx===0 && $poli->surveis_avg_rating ? 'best' : '' }}">
              @if($idx===0 && $poli->surveis_avg_rating) ⭐ @endif
              {{ $poli->nama }}
              @if($poli->surveis_avg_rating)
                <span style="opacity:.7;">{{ number_format($poli->surveis_avg_rating,1) }}</span>
              @endif
            </span>
          @endforeach
          @if($klinik->polis->count() > 4)
            <span class="poli-badge">+{{ $klinik->polis->count()-4 }} poli</span>
          @endif
        </div>

        {{-- CTA --}}
        <div class="flex gap-2">
          <button onclick="bukaDetail({{ $klinik->id }}, this.closest('.rs-card'));event.stopPropagation();"
            class="clay-btn clay-btn-sm flex-1 py-2.5 text-xs text-white"
            style="background:linear-gradient(135deg,#2563eb,#1d4ed8);">
            Lihat Detail & Rating →
          </button>
        </div>
      </div>
    </div>
    @empty
    <div class="col-span-3 clay-card p-16 text-center">
      <div class="text-5xl mb-3">🏥</div>
      <p class="text-slate-400 font-bold">Belum ada data klinik.</p>
    </div>
    @endforelse
  </div>

  {{-- PANEL DETAIL RS (muncul di bawah card yang diklik) --}}
  <div id="detail-panel" class="detail-panel">
    <div class="clay-card p-0 overflow-hidden" id="detail-content">
      <div class="flex items-center justify-center py-12">
        <div class="text-center text-slate-400">
          <div class="text-4xl mb-2">👆</div>
          <p class="font-bold">Klik rumah sakit di atas untuk lihat detail</p>
        </div>
      </div>
    </div>
  </div>

</div>

{{-- DATA RS UNTUK JS --}}
<script>
const klinikData = @json($klinikJson);

const isLoggedIn = @json(auth('pasien')->check());
const routeSurveiUmum = "{{ route('survei.umum') }}";
const routePendaftaran = "/pendaftaran";
const routeLogin = "{{ route('login') }}";
const routeRegister = "/register";
const csrfToken = "{{ csrf_token() }}";

// ── Filter & Sort RS ─────────────────────────────────────────────────
function filterRS() {
  const q    = document.getElementById('searchRS').value.toLowerCase();
  const poli = document.getElementById('filterPoli').value.toLowerCase();
  const sort = document.getElementById('sortBy').value;
  const cards = [...document.querySelectorAll('.rs-card')];

  cards.forEach(c => {
    const namaMatch = c.dataset.nama.includes(q);
    const poliMatch = !poli || c.dataset.poli.includes(poli);
    c.style.display = (namaMatch && poliMatch) ? '' : 'none';
  });

  // Sort
  const grid = document.getElementById('rs-grid');
  const visible = cards.filter(c => c.style.display !== 'none');
  visible.sort((a, b) => {
    if (sort === 'rating') return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating);
    return parseInt(b.dataset.ulasan) - parseInt(a.dataset.ulasan);
  });
  visible.forEach(c => grid.appendChild(c));
}

// ── Buka detail panel ────────────────────────────────────────────────
let activeCard = null;
let activeId   = null;

function bukaDetail(id, cardEl) {
  if (activeId === id) {
    // Toggle tutup
    document.getElementById('detail-panel').classList.remove('open');
    if (activeCard) activeCard.classList.remove('active-card');
    activeId = null; activeCard = null;
    return;
  }
  if (activeCard) activeCard.classList.remove('active-card');
  activeCard = cardEl.classList.contains('rs-card') ? cardEl : cardEl.closest('.rs-card');
  activeCard.classList.add('active-card');
  activeId = id;

  const klinik = klinikData.find(k => k.id === id);
  if (!klinik) return;

  renderDetail(klinik);
  const panel = document.getElementById('detail-panel');
  panel.classList.add('open');

  // Scroll ke panel
  setTimeout(() => panel.scrollIntoView({behavior:'smooth', block:'start'}), 100);
}

function starsHtml(rating, size='text-sm') {
  if (!rating) return '<span class="text-gray-300 text-xs">Belum ada</span>';
  let h = '';
  for (let i = 1; i <= 5; i++) h += `<span class="${size} ${i<=Math.round(rating)?'text-amber-400':'text-gray-200'}">★</span>`;
  return h;
}

function renderDetail(k) {
  const avgRating = k.rating ?? 0;
  const sortedPolis = [...k.polis].sort((a,b) => (b.rating??0)-(a.rating??0));
  const bestPoli = sortedPolis[0];

  // Poli options untuk form daftar
  const poliOptions = k.polis.map(p => `<option value="${p.nama}">${p.nama}${p.rating?' (★'+p.rating+')':''}</option>`).join('');

  const ulasanHtml = k.ulasanTerbaru.length
    ? k.ulasanTerbaru.map(u => `
        <div class="py-4 border-b border-gray-100 last:border-0">
          <div class="flex items-center justify-between mb-1">
            <div class="flex gap-0.5">${starsHtml(u.rating,'text-sm')}</div>
            <div class="flex gap-2 items-center">
              ${u.poli ? `<span style="font-size:.68rem;background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;border-radius:6px;padding:2px 8px;font-weight:600;">${u.poli}</span>` : ''}
              <span style="font-size:.65rem;color:#94a3b8;font-weight:600;">${u.tipe==='spesifik'?'Kunjungan':'Umum'}</span>
            </div>
          </div>
          <p style="font-size:.83rem;color:#475569;line-height:1.6;">"${u.komentar}"</p>
        </div>`).join('')
    : '<p class="text-gray-400 text-sm py-4 text-center">Belum ada ulasan dengan komentar.</p>';

  const poliRatingHtml = sortedPolis.map((p,i) => {
    const pct = p.rating ? (p.rating/5*100) : 0;
    return `
    <div class="flex items-center gap-3 py-2 ${i===0?'border-l-4 pl-3':'pl-7'}" style="${i===0?'border-color:#2563eb;':''}">
      <div class="flex-1 min-w-0">
        <div class="flex justify-between items-center mb-1">
          <span style="font-size:.82rem;font-weight:700;color:#1e293b;${i===0?'color:#2563eb;':''}">${i===0?'⭐ ':''}${p.nama}</span>
          <span style="font-size:.78rem;font-weight:800;color:#d97706;">${p.rating??'—'}</span>
        </div>
        <div class="rating-bar-bg"><div class="rating-bar-fill" style="width:${pct}%"></div></div>
        <span style="font-size:.65rem;color:#94a3b8;">${p.count} ulasan</span>
      </div>
    </div>`;
  }).join('');

  // Form survei umum
  const surveiFormHtml = `
    <form id="form-survei-umum" onsubmit="submitSurvei(event,${k.id})">
      <input type="hidden" name="klinik_id" value="${k.id}">
      <p style="font-size:.78rem;color:#64748b;margin-bottom:12px;">Nilai kesan umum klinik ini, tanpa perlu pernah berkunjung.</p>
      <div class="flex gap-2 mb-3" id="stars-umum" data-val="0">
        ${[1,2,3,4,5].map(i=>`
          <button type="button" class="star-btn text-3xl select-none transition-transform hover:scale-110"
            style="background:none;border:none;cursor:pointer;color:#e2e8f0;"
            onclick="setStar(${i})" onmouseover="hoverStar(${i})" onmouseout="resetStar()">★</button>
        `).join('')}
      </div>
      <input type="hidden" name="rating" id="rating-val" required>
      <textarea name="komentar" rows="2" class="clay-input mb-3" placeholder="Komentar (opsional)..." style="resize:none;font-size:.85rem;"></textarea>
      <button type="submit" class="clay-btn w-full py-2.5 text-sm text-white" style="background:linear-gradient(135deg,#2563eb,#1d4ed8);">
        Kirim Penilaian ⭐
      </button>
    </form>`;

  // Form daftar antrian
  const daftarFormHtml = isLoggedIn ? `
    <form id="form-daftar" onsubmit="submitDaftar(event)">
      <div class="space-y-3">
        <div>
          <label style="font-size:.75rem;font-weight:700;color:#374151;display:block;margin-bottom:4px;">Poli Tujuan</label>
          <select name="poli" id="daftar-poli" class="clay-select" onchange="updateDokter(${k.id})" required>
            <option value="">Pilih Poli</option>
            ${poliOptions}
          </select>
        </div>
        <div>
          <label style="font-size:.75rem;font-weight:700;color:#374151;display:block;margin-bottom:4px;">Dokter</label>
          <select name="dokter" id="daftar-dokter" class="clay-select" required disabled style="opacity:.6;">
            <option value="">Pilih Poli Dulu</option>
          </select>
        </div>
        <div>
          <label style="font-size:.75rem;font-weight:700;color:#374151;display:block;margin-bottom:4px;">Jenis</label>
          <select name="jenis_pendaftaran" class="clay-select" required>
            <option value="Umum">Umum</option>
            <option value="BPJS">BPJS</option>
          </select>
        </div>
        <div>
          <label style="font-size:.75rem;font-weight:700;color:#374151;display:block;margin-bottom:4px;">Tanggal Kunjungan</label>
          <input type="date" name="tanggal" class="clay-input" min="${new Date().toISOString().split('T')[0]}" required>
        </div>
        <div>
          <label style="font-size:.75rem;font-weight:700;color:#374151;display:block;margin-bottom:4px;">Keluhan</label>
          <input type="text" name="keluhan" class="clay-input" placeholder="Tuliskan keluhan singkat...">
        </div>
        <input type="hidden" name="klinik" value="${k.nama}">
        <button type="submit" class="clay-btn w-full py-3 text-sm font-bold text-white" style="background:linear-gradient(135deg,#10b981,#059669);box-shadow:5px 5px 14px rgba(16,185,129,.3),-1px -1px 5px rgba(255,255,255,.7);">
          🎫 Ambil Nomor Antrian
        </button>
      </div>
    </form>` : `
    <div class="text-center py-4">
      <div class="text-4xl mb-3">🔐</div>
      <p class="font-bold text-slate-700 mb-1">Login untuk Daftar Antrian</p>
      <p class="text-slate-400 text-sm mb-4">Masuk atau buat akun gratis untuk langsung ambil nomor antrian.</p>
      <div class="flex gap-3">
        <a href="${routeLogin}" class="clay-btn clay-btn-sm flex-1 py-2.5 text-sm text-white text-center" style="background:linear-gradient(135deg,#2563eb,#1d4ed8);">Masuk</a>
        <a href="${routeRegister}" class="clay-btn clay-btn-sm flex-1 py-2.5 text-sm text-white text-center" style="background:linear-gradient(135deg,#10b981,#059669);">Daftar Gratis</a>
      </div>
    </div>`;

  document.getElementById('detail-content').innerHTML = `
  <div style="background:linear-gradient(135deg,#0f2057,#1e3a8a,#0369a1);padding:20px 24px;display:flex;justify-content:space-between;align-items:center;gap:12px;">
    <div>
      <p style="color:rgba(147,197,253,.8);font-size:.7rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;margin-bottom:4px;">Detail Klinik</p>
      <h2 style="font-family:'Sora',sans-serif;font-weight:800;color:white;font-size:1.2rem;">${k.nama}</h2>
    </div>
    <div class="flex items-center gap-3">
      <div class="stat-pill text-center">
        <div style="font-family:'Sora',sans-serif;font-weight:800;font-size:1.4rem;color:#fbbf24;">${k.rating??'—'}</div>
        <div style="font-size:.6rem;color:rgba(147,197,253,.8);font-weight:600;">${k.count} ulasan</div>
      </div>
      <button onclick="tutupDetail()" style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);border-radius:10px;color:white;padding:8px 12px;cursor:pointer;font-weight:700;font-size:.8rem;">✕ Tutup</button>
    </div>
  </div>

  <div class="p-5 md:p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Kiri: Rating + Ulasan --}}
    <div class="lg:col-span-2 space-y-5">

      {{-- Rating per poli --}}
      <div>
        <h3 style="font-family:'Sora',sans-serif;font-weight:700;font-size:.9rem;color:#1e293b;margin-bottom:12px;">📊 Rating per Poli</h3>
        <div class="space-y-1">${poliRatingHtml}</div>
      </div>

      {{-- Ulasan --}}
      <div>
        <h3 style="font-family:'Sora',sans-serif;font-weight:700;font-size:.9rem;color:#1e293b;margin-bottom:8px;">💬 Ulasan Pasien</h3>
        <div>${ulasanHtml}</div>
      </div>
    </div>

    {{-- Kanan: Aksi --}}
    <div class="space-y-5">

      {{-- Daftar antrian --}}
      <div class="clay-card p-5">
        <div class="flex items-center gap-2 mb-4">
          <span style="background:linear-gradient(135deg,#10b981,#059669);border-radius:10px;padding:6px 8px;font-size:1rem;">🎫</span>
          <h3 style="font-family:'Sora',sans-serif;font-weight:700;font-size:.9rem;color:#1e293b;">Daftar Antrian</h3>
        </div>
        ${daftarFormHtml}
      </div>

      {{-- Survei umum --}}
      <div class="clay-card p-5">
        <div class="flex items-center gap-2 mb-4">
          <span style="background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:10px;padding:6px 8px;font-size:1rem;">⭐</span>
          <h3 style="font-family:'Sora',sans-serif;font-weight:700;font-size:.9rem;color:#1e293b;">Beri Penilaian</h3>
        </div>
        ${surveiFormHtml}
      </div>
    </div>
  </div>`;

  // Load dokter data jika login
  if (isLoggedIn) loadPoliDokter(k.id);
}

// ── Tutup detail ─────────────────────────────────────────────────────
function tutupDetail() {
  document.getElementById('detail-panel').classList.remove('open');
  if (activeCard) activeCard.classList.remove('active-card');
  activeId = null; activeCard = null;
}

// ── Star rating ──────────────────────────────────────────────────────
let currentStar = 0;
function setStar(val) {
  currentStar = val;
  document.getElementById('rating-val').value = val;
  updateStarDisplay(val, true);
}
function hoverStar(val) { updateStarDisplay(val, false); }
function resetStar() { updateStarDisplay(currentStar, false); }
function updateStarDisplay(val, permanent) {
  document.querySelectorAll('#stars-umum .star-btn').forEach((btn, idx) => {
    btn.style.color = idx < val ? '#f59e0b' : '#e2e8f0';
    btn.style.textShadow = idx < val ? '0 2px 6px rgba(245,158,11,.4)' : 'none';
    if(permanent) btn.style.transform = idx < val ? 'scale(1.1)' : 'scale(1)';
  });
}

// ── Load poli & dokter dinamis ────────────────────────────────────────
const klinikPoliDokterCache = {};
async function loadPoliDokter(klinikId) {
  // sudah ada di klinikData, tinggal ambil
}

function updateDokter(klinikId) {
  const poliNama = document.getElementById('daftar-poli').value;
  const dokterSel = document.getElementById('daftar-dokter');
  if (!poliNama) { dokterSel.disabled = true; dokterSel.style.opacity='.6'; dokterSel.innerHTML='<option>Pilih Poli Dulu</option>'; return; }

  fetch(`/api/dokter-by-poli?klinik_id=${klinikId}&poli=${encodeURIComponent(poliNama)}`)
    .then(r => r.json())
    .then(data => {
      dokterSel.disabled = false;
      dokterSel.style.opacity = '1';
      dokterSel.innerHTML = '<option value="">Pilih Dokter</option>' +
        data.map(d => `<option value="${d.nama}">${d.nama}</option>`).join('');
    })
    .catch(() => {
      dokterSel.disabled = false;
      dokterSel.style.opacity = '1';
      dokterSel.innerHTML = '<option value="">-- Dokter --</option>';
    });
}

// ── Submit survei umum ────────────────────────────────────────────────
async function submitSurvei(e, klinikId) {
  e.preventDefault();
  const form = e.target;
  if (!document.getElementById('rating-val').value) {
    Swal.fire({icon:'warning',title:'Pilih Rating',text:'Berikan bintang dulu sebelum mengirim!',confirmButtonColor:'#2563eb'}); return;
  }
  const fd = new FormData(form);
  fd.append('_token', csrfToken);
  const res = await fetch(routeSurveiUmum, {method:'POST', body:fd});
  if (res.ok || res.redirected) {
    Swal.fire({icon:'success',title:'Terima Kasih! ⭐',text:'Penilaian Anda telah dikirim.',confirmButtonColor:'#2563eb'})
      .then(() => location.reload());
  } else {
    Swal.fire({icon:'error',title:'Gagal',text:'Terjadi kesalahan. Coba lagi.',confirmButtonColor:'#2563eb'});
  }
}

// ── Submit daftar antrian ─────────────────────────────────────────────
async function submitDaftar(e) {
  e.preventDefault();
  const form = e.target;
  const jenis = form.jenis_pendaftaran.value;
  const endpoint = jenis === 'BPJS' ? '/pendaftaran/simpan-bpjs' : '/pendaftaran/simpan-umum';
  const fd = new FormData(form);
  fd.append('_token', csrfToken);

  const res = await fetch(endpoint, {method:'POST', body:fd, redirect:'follow'});
  if (res.ok || res.redirected) {
    Swal.fire({
      icon: 'success',
      title: '🎫 Antrian Berhasil Diambil!',
      text: 'Cek halaman Antrean untuk melihat nomor antrian Anda.',
      confirmButtonColor: '#2563eb',
      confirmButtonText: 'Lihat Antrean →'
    }).then(r => { if(r.isConfirmed) window.location='/antrean'; });
  } else {
    Swal.fire({icon:'error',title:'Gagal Daftar',text:'Pastikan semua data terisi. Coba lagi.',confirmButtonColor:'#2563eb'});
  }
}
</script>

<style>
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.5}}
</style>
</body>
</html>
