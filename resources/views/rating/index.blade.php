@extends('layouts.app')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-800">⭐ Cari & Rating Klinik</h2>
        <p class="text-slate-500 mt-1 font-medium">Temukan klinik terbaik berdasarkan penilaian pasien.</p>
    </div>
    <form method="GET" action="{{ route('rating.index') }}" class="flex gap-3 items-center">
        <select name="poli" class="input-clay" style="width:auto;min-width:160px;" onchange="this.form.submit()">
            <option value="">Semua Poli</option>
            @foreach($semuaPoli as $namaPoli)
                <option value="{{ $namaPoli }}" {{ request('poli') == $namaPoli ? 'selected' : '' }}>{{ $namaPoli }}</option>
            @endforeach
        </select>
        @if(request('poli'))
            <a href="{{ route('rating.index') }}" class="btn-clay btn-white" style="padding:10px 18px;font-size:0.8rem;">✕ Reset</a>
        @endif
    </form>
</div>

@if (session('success'))
    <div class="clay mb-6 p-4 flex items-center gap-3" style="border-color:#A7F3D0;box-shadow:0 6px 0 #A7F3D0;">
        <span class="text-2xl">✅</span>
        <span class="font-bold text-emerald-700">{{ session('success') }}</span>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($kliniks as $klinik)
    <div class="clay p-6 hover:-translate-y-1 transition-transform duration-200">
        <div class="flex justify-between items-start mb-4">
            <h3 class="text-lg font-black text-slate-800 leading-tight pr-4">{{ $klinik->nama }}</h3>
            <div class="flex items-center gap-1 shrink-0" style="background:#FFFBEB;padding:6px 12px;border-radius:12px;border:2px solid #FDE68A;">
                <span class="text-amber-400">★</span>
                <span class="font-black text-amber-600 text-sm">
                    {{ $klinik->surveis_avg_rating ? number_format($klinik->surveis_avg_rating, 1) : '—' }}
                </span>
                <span class="text-amber-400 text-xs font-bold">({{ $klinik->surveis_count }})</span>
            </div>
        </div>

        <div class="flex flex-wrap gap-2 mb-5">
            @foreach($klinik->polis as $poli)
                <span class="text-xs font-bold px-3 py-1.5 rounded-xl" style="background:#EEF2FF;color:#4F46E5;border:1.5px solid #E0E7FF;">
                    {{ $poli->nama }}
                    @if($poli->surveis_avg_rating)
                        <span class="text-amber-500">★ {{ number_format($poli->surveis_avg_rating, 1) }}</span>
                    @endif
                </span>
            @endforeach
        </div>

        <a href="{{ route('rating.show', $klinik->id) }}" class="btn-clay btn-primary w-full text-center block" style="padding:10px;">
            Lihat Detail & Nilai →
        </a>
    </div>
    @empty
    <div class="col-span-3 clay py-16 text-center">
        <div class="text-5xl mb-3">🏥</div>
        <p class="text-slate-400 font-bold">Belum ada data klinik.</p>
    </div>
    @endforelse
</div>
@endsection
