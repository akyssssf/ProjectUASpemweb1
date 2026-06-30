@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">

    <a href="{{ route('rating.index') }}" class="text-sm text-slate-400 hover:text-slate-600 font-bold">&larr; Kembali ke daftar</a>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-6 shadow-sm rounded">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 my-6 shadow-sm rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex justify-between items-start mt-4 mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-800">{{ $klinik->nama }}</h2>
            <p class="text-slate-500 mt-1 font-medium">{{ $klinik->surveis_count }} ulasan dari pasien</p>
        </div>
        <div class="flex items-center gap-1 bg-amber-50 px-4 py-2 rounded-full">
            <span class="text-amber-500 text-lg">&#9733;</span>
            <span class="font-black text-amber-600 text-xl">
                {{ $klinik->surveis_avg_rating ? number_format($klinik->surveis_avg_rating, 1) : '-' }}
            </span>
        </div>
    </div>

    <div class="bg-white shadow-xl shadow-slate-200/50 rounded-[2rem] border border-slate-100 p-6 mb-8">
        <h3 class="font-bold text-slate-700 mb-4">Rating per Poli</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            @foreach($klinik->polis as $poli)
                <div class="bg-slate-50 rounded-xl p-4">
                    <div class="text-sm font-bold text-slate-700">{{ $poli->nama }}</div>
                    <div class="text-amber-500 font-black text-sm mt-1">
                        &#9733; {{ $poli->surveis_avg_rating ? number_format($poli->surveis_avg_rating, 1) : 'Belum ada rating' }}
                        @if($poli->surveis_avg_rating)
                            <span class="text-slate-400 font-medium">({{ $poli->surveis_count }})</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white shadow-xl shadow-slate-200/50 rounded-[2rem] border border-slate-100 p-6 mb-8">
        <h3 class="font-bold text-slate-700 mb-4">Beri Penilaian Umum</h3>
        <p class="text-xs text-slate-400 mb-4">Penilaian ini untuk kesan umum terhadap rumah sakit/klinik ini, tidak perlu pernah berkunjung.</p>
        <form method="POST" action="{{ route('survei.umum') }}">
            @csrf
            <input type="hidden" name="klinik_id" value="{{ $klinik->id }}">

            <div class="flex gap-2 mb-4">
                @for($i = 1; $i <= 5; $i++)
                    <label class="cursor-pointer">
                        <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" required>
                        <span class="text-3xl text-slate-300 peer-checked:text-amber-400">&#9733;</span>
                    </label>
                @endfor
            </div>

            <textarea name="komentar" rows="3" placeholder="Tulis komentar (opsional)" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm mb-4"></textarea>

            <button type="submit" class="bg-indigo-600 text-white font-bold px-6 py-3 rounded-xl hover:bg-indigo-700 transition">
                Kirim Penilaian
            </button>
        </form>
    </div>

    <div class="bg-white shadow-xl shadow-slate-200/50 rounded-[2rem] border border-slate-100 p-6">
        <h3 class="font-bold text-slate-700 mb-4">Ulasan Terbaru</h3>
        <div class="divide-y divide-slate-50">
            @forelse($ulasanTerbaru as $ulasan)
                <div class="py-4">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-amber-500 font-bold text-sm">&#9733; {{ $ulasan->rating }}</span>
                        @if($ulasan->poli)
                            <span class="text-xs font-bold px-2 py-1 bg-slate-100 text-slate-500 rounded">{{ $ulasan->poli->nama }}</span>
                        @endif
                    </div>
                    <p class="text-sm text-slate-600">{{ $ulasan->komentar }}</p>
                </div>
            @empty
                <p class="text-sm text-slate-400 py-4">Belum ada ulasan dengan komentar.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
