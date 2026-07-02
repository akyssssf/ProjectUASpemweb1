@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('rating.index') }}" class="btn-clay btn-white" style="padding:10px 20px;font-size:0.85rem;">← Kembali</a>
    <div>
        <h2 class="text-2xl font-black text-slate-800">{{ $klinik->nama }}</h2>
        <p class="text-slate-500 font-medium mt-0.5">{{ $klinik->surveis_count }} ulasan dari pasien</p>
    </div>
</div>

@if (session('success'))
    <div class="clay mb-6 p-4 flex items-center gap-3" style="border-color:#A7F3D0;box-shadow:0 6px 0 #A7F3D0;">
        <span class="text-2xl">✅</span><span class="font-bold text-emerald-700">{{ session('success') }}</span>
    </div>
@endif
@if (session('error'))
    <div class="clay mb-6 p-4 flex items-center gap-3" style="border-color:#FECACA;box-shadow:0 6px 0 #FECACA;">
        <span class="text-2xl">❌</span><span class="font-bold text-red-700">{{ session('error') }}</span>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 space-y-6">

        <!-- Rating overview -->
        <div class="clay-blue p-8 relative overflow-hidden" style="background:linear-gradient(135deg,#1A237E,#0000CD);border-radius:24px;box-shadow:0 8px 0 #00005A;border:2px solid #3949AB;">
            <div class="absolute right-0 top-0 w-48 h-48 rounded-full" style="background:rgba(255,255,255,0.08);transform:translate(30%,-30%);"></div>
            <div class="relative z-10 flex items-center justify-between gap-6">
                <div>
                    <p class="text-blue-300 text-xs font-black uppercase tracking-widest mb-2">Rating Keseluruhan</p>
                    <div class="text-7xl font-black text-white leading-none mb-2">
                        {{ $klinik->surveis_avg_rating ? number_format($klinik->surveis_avg_rating, 1) : '—' }}
                    </div>
                    <div class="flex gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            @if($klinik->surveis_avg_rating && $i <= round($klinik->surveis_avg_rating))
                                <span class="text-amber-300 text-xl">★</span>
                            @else
                                <span class="text-white/20 text-xl">★</span>
                            @endif
                        @endfor
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black text-white">{{ $klinik->surveis_count }}</div>
                    <div class="text-blue-300 text-xs font-black uppercase tracking-wide mt-1">Total Ulasan</div>
                </div>
            </div>
        </div>

        <!-- Rating per poli -->
        <div class="clay p-6">
            <h3 class="font-black text-slate-800 mb-4">📊 Rating per Poli</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @foreach($klinik->polis as $poli)
                <div class="p-4 text-center" style="background:#E8ECFF;border-radius:16px;border:2px solid #D0DAFF;">
                    <div class="text-xs font-black text-blue-800 uppercase tracking-wide mb-2">{{ $poli->nama }}</div>
                    @if($poli->surveis_avg_rating)
                        <div class="text-2xl font-black text-amber-500">★ {{ number_format($poli->surveis_avg_rating, 1) }}</div>
                        <div class="text-xs text-slate-400 font-bold mt-1">{{ $poli->surveis_count }} ulasan</div>
                    @else
                        <div class="text-slate-300 font-black text-sm">Belum ada rating</div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <!-- Ulasan terbaru -->
        <div class="clay overflow-hidden">
            <div class="px-6 py-5" style="border-bottom:2px solid #E8ECFF;">
                <h3 class="font-black text-slate-800">💬 Ulasan Terbaru</h3>
            </div>
            <div class="divide-y-2 divide-blue-50">
                @forelse($ulasanTerbaru as $ulasan)
                <div class="px-6 py-5">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= $ulasan->rating ? 'text-amber-400' : 'text-slate-200' }} text-lg">★</span>
                            @endfor
                        </div>
                        <div class="flex items-center gap-2">
                            @if($ulasan->poli)
                                <span class="text-[10px] font-black px-2 py-1 rounded-lg" style="background:#E8ECFF;color:#0000CD;">{{ $ulasan->poli->nama }}</span>
                            @endif
                            <span class="text-[10px] font-bold text-slate-400">{{ $ulasan->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <p class="text-sm text-slate-600 font-medium leading-relaxed">{{ $ulasan->komentar }}</p>
                </div>
                @empty
                <div class="py-12 text-center">
                    <div class="text-4xl mb-2">💬</div>
                    <p class="text-slate-400 font-bold text-sm">Belum ada ulasan dengan komentar.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Sidebar: Form survei umum -->
    <div class="space-y-6">
        <div class="clay p-6">
            <h3 class="font-black text-slate-800 mb-1">⭐ Beri Penilaian Umum</h3>
            <p class="text-xs text-slate-400 font-bold mb-5 leading-relaxed">Kesan umum terhadap klinik ini, tidak perlu pernah berkunjung.</p>

            <form method="POST" action="{{ route('survei.umum') }}">
                @csrf
                <input type="hidden" name="klinik_id" value="{{ $klinik->id }}">

                <label class="label-clay mb-3">Rating</label>

<!-- Star Rating Component -->
<div class="star-rating flex gap-2 mb-5" id="stars-umum" data-value="0">
    <button type="button" data-val="1" onclick="setRating('umum',1)" onmouseover="hoverStar('umum',1)" onmouseout="resetStar('umum')" class="star-btn text-4xl select-none cursor-pointer bg-transparent border-none p-0 transition-transform hover:scale-110" style="color:#e2e8f0;">★</button>
    <button type="button" data-val="2" onclick="setRating('umum',2)" onmouseover="hoverStar('umum',2)" onmouseout="resetStar('umum')" class="star-btn text-4xl select-none cursor-pointer bg-transparent border-none p-0 transition-transform hover:scale-110" style="color:#e2e8f0;">★</button>
    <button type="button" data-val="3" onclick="setRating('umum',3)" onmouseover="hoverStar('umum',3)" onmouseout="resetStar('umum')" class="star-btn text-4xl select-none cursor-pointer bg-transparent border-none p-0 transition-transform hover:scale-110" style="color:#e2e8f0;">★</button>
    <button type="button" data-val="4" onclick="setRating('umum',4)" onmouseover="hoverStar('umum',4)" onmouseout="resetStar('umum')" class="star-btn text-4xl select-none cursor-pointer bg-transparent border-none p-0 transition-transform hover:scale-110" style="color:#e2e8f0;">★</button>
    <button type="button" data-val="5" onclick="setRating('umum',5)" onmouseover="hoverStar('umum',5)" onmouseout="resetStar('umum')" class="star-btn text-4xl select-none cursor-pointer bg-transparent border-none p-0 transition-transform hover:scale-110" style="color:#e2e8f0;">★</button>
</div>
<input type="hidden" name="rating" id="rating-input-umum" required>


                <label class="label-clay mb-2">Komentar (opsional)</label>
                <textarea name="komentar" rows="4" placeholder="Ceritakan pengalaman atau kesan kamu..." class="input-clay mb-5"></textarea>

                <button type="submit" class="btn-clay btn-primary w-full text-center" style="padding:12px;">
                    Kirim Penilaian →
                </button>
            </form>
        </div>

        <!-- Info klinik -->
        <div class="clay-blue p-6 text-center" style="background:linear-gradient(135deg,#00003D,#000080);border-radius:24px;box-shadow:0 6px 0 #000028;border:2px solid #0000B0;">
            <div class="text-4xl mb-3">🏥</div>
            <h4 class="font-black text-white text-sm mb-1">{{ $klinik->nama }}</h4>
            <p class="text-blue-600 text-xs font-bold">{{ $klinik->polis->count() }} poli tersedia</p>
        </div>
    </div>
</div>

<style>
    .clay-blue { background: linear-gradient(135deg, #1A237E, #0000CD); }
    .input-clay { width: 100%; padding: 12px 16px; border-radius: 14px; border: 2.5px solid #D0DAFF; background: #F8FAFF; font-size: 0.9rem; font-weight: 600; color: #00003D; outline: none; transition: all 0.2s; }
    .input-clay:focus { border-color: #1A237E; background: white; box-shadow: 0 0 0 4px rgba(0,0,128,0.12); }
    .label-clay { display: block; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: #0000CD; }
    .btn-clay { display: inline-block; border-radius: 14px; font-weight: 800; transition: all 0.15s; position: relative; top: 0; cursor: pointer; }
    .btn-clay:active { top: 3px; }
    .btn-primary { background: linear-gradient(135deg, #1A237E, #0000CD); color: white; box-shadow: 0 5px 0 #00005A; }
    .btn-white { background: white; color: #0000CD; box-shadow: 0 5px 0 #B3C0E8; border: 2px solid #D0DAFF; }
    .btn-clay:hover { transform: translateY(-1px); }
</style>

<script>
function updateStarDisplay(id, val, permanent) {
    const container = document.getElementById('stars-' + id);
    if (!container) return;
    container.querySelectorAll('.star-btn').forEach((btn, idx) => {
        btn.style.color = idx < val ? '#FED800' : '#e2e8f0';
        btn.style.textShadow = idx < val ? '0 2px 8px rgba(254,216,0,0.5)' : 'none';
    });
    if (permanent) container.dataset.value = val;
}
function setRating(id, val) {
    document.getElementById('rating-input-' + id).value = val;
    updateStarDisplay(id, val, true);
}
function hoverStar(id, val) { updateStarDisplay(id, val, false); }
function resetStar(id) {
    const container = document.getElementById('stars-' + id);
    if (container) updateStarDisplay(id, parseInt(container.dataset.value) || 0, false);
}
</script>

@endsection
