@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">

    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-slate-800">Cari Rumah Sakit / Klinik</h2>
        <p class="text-slate-500 mt-1 font-medium">Urut berdasarkan rating kepuasan pasien tertinggi.</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('rating.index') }}" class="mb-8 flex gap-3 items-center">
        <select name="poli" class="border border-slate-200 rounded-xl px-4 py-2 text-sm font-medium text-slate-600" onchange="this.form.submit()">
            <option value="">Semua Poli</option>
            @foreach($semuaPoli as $namaPoli)
                <option value="{{ $namaPoli }}" {{ request('poli') == $namaPoli ? 'selected' : '' }}>{{ $namaPoli }}</option>
            @endforeach
        </select>
        @if(request('poli'))
            <a href="{{ route('rating.index') }}" class="text-sm text-slate-400 hover:text-slate-600 font-medium">Reset filter</a>
        @endif
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($kliniks as $klinik)
        <div class="bg-white shadow-xl shadow-slate-200/50 rounded-[2rem] border border-slate-100 p-6">
            <div class="flex justify-between items-start mb-3">
                <h3 class="text-xl font-bold text-slate-800">{{ $klinik->nama }}</h3>
                <div class="flex items-center gap-1 bg-amber-50 px-3 py-1 rounded-full">
                    <span class="text-amber-500">&#9733;</span>
                    <span class="font-black text-amber-600 text-sm">
                        {{ $klinik->surveis_avg_rating ? number_format($klinik->surveis_avg_rating, 1) : '-' }}
                    </span>
                    <span class="text-amber-400 text-xs font-medium">({{ $klinik->surveis_count }})</span>
                </div>
            </div>

            <div class="flex flex-wrap gap-2 mb-4">
                @foreach($klinik->polis as $poli)
                    <span class="text-xs font-bold px-3 py-1 bg-slate-100 text-slate-600 rounded-lg">
                        {{ $poli->nama }}
                        @if($poli->surveis_avg_rating)
                            <span class="text-amber-500">&#9733; {{ number_format($poli->surveis_avg_rating, 1) }}</span>
                        @endif
                    </span>
                @endforeach
            </div>

            <a href="{{ route('rating.show', $klinik->id) }}" class="inline-block text-sm font-bold text-indigo-600 hover:text-indigo-700">
                Lihat detail & beri penilaian &rarr;
            </a>
        </div>
        @empty
        <div class="col-span-2 text-center p-16 text-slate-400 font-bold">
            Belum ada data klinik.
        </div>
        @endforelse
    </div>
</div>
@endsection
