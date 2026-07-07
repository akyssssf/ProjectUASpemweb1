@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-800">Riwayat Kunjungan 📋</h2>
        <p class="text-slate-500 font-medium mt-1">Pantau status kunjungan medis Anda.</p>
    </div>
    <a href="/dashboard" class="btn-clay btn-white" style="padding:10px 20px;font-size:0.85rem;">← Dashboard</a>
</div>

<div class="clay overflow-hidden" style="border-radius:24px;padding:0;">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr style="background:#E8ECFF;border-bottom:2px solid #D0DAFF;">
                    <th class="px-6 py-4 text-[10px] font-black text-blue-700 uppercase tracking-widest">Tanggal</th>
                    <th class="px-6 py-4 text-[10px] font-black text-blue-700 uppercase tracking-widest">Layanan</th>
                    <th class="px-6 py-4 text-[10px] font-black text-blue-700 uppercase tracking-widest">Klinik / Poli</th>
                    <th class="px-6 py-4 text-[10px] font-black text-blue-700 uppercase tracking-widest">Dokter</th>
                    <th class="px-6 py-4 text-[10px] font-black text-blue-700 uppercase tracking-widest">Status</th>
                    <th class="px-6 py-4 text-[10px] font-black text-blue-700 uppercase tracking-widest">Penilaian</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $data)
                <tr style="border-bottom:2px solid #E8ECFF;" class="hover:bg-blue-50/30 transition-colors">
                    <td class="px-6 py-5 text-sm font-bold text-slate-700">
                        {{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}
                    </td>
                    <td class="px-6 py-5">
                        <span class="badge {{ $data->jenis_pendaftaran == 'BPJS' ? 'badge-blue' : 'badge-green' }}">
                            {{ $data->jenis_pendaftaran }}
                        </span>
                        @if($data->jenis_pendaftaran == 'BPJS' && $data->no_bpjs)
                            <div class="text-[10px] text-slate-400 mt-1 font-bold">{{ $data->no_bpjs }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-5">
                        <div class="font-black text-slate-800 text-sm">{{ $data->klinik }}</div>
                        <div class="text-xs text-slate-400 font-bold mt-0.5">{{ $data->poli }}</div>
                    </td>
                    <td class="px-6 py-5 text-sm font-bold text-slate-600">{{ $data->dokter }}</td>
                    <td class="px-6 py-5">
                        @if($data->antrian)
                            <span class="badge
                                {{ $data->antrian->status == 'menunggu' ? 'badge-amber' : '' }}
                                {{ $data->antrian->status == 'dipanggil' ? 'badge-blue' : '' }}
                                {{ $data->antrian->status == 'selesai' ? 'badge-green' : '' }}">
                                {{ $data->antrian->status == 'menunggu' ? '⏳ Menunggu' : '' }}
                                {{ $data->antrian->status == 'dipanggil' ? '📢 Dipanggil' : '' }}
                                {{ $data->antrian->status == 'selesai' ? '✅ Selesai' : '' }}
                            </span>
                        @else
                            <span class="badge badge-amber">⏳ Menunggu</span>
                        @endif
                    </td>
                    <td class="px-6 py-5">
                        @if($data->antrian && $data->antrian->status == 'selesai')
                            @if($data->survei)
                                <span class="text-amber-500 font-black text-sm">★ {{ $data->survei->rating }}/5</span>
                                <div class="text-[10px] text-slate-400 font-bold">terkirim</div>
                            @else
                                <button type="button"
                                    onclick="document.getElementById('modal-survei-{{ $data->id }}').classList.remove('hidden')"
                                    class="btn-clay btn-primary" style="padding:8px 16px;font-size:0.75rem;">
                                    ⭐ Nilai
                                </button>

                                <!-- Modal survei -->
                                <div id="modal-survei-{{ $data->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
                                    <div class="clay p-8 max-w-md w-full" style="border-radius:28px;box-shadow:0 16px 0 #B3C0E8;">
                                        <h4 class="font-black text-slate-800 text-lg mb-1">⭐ Beri Penilaian</h4>
                                        <p class="text-sm text-slate-400 font-bold mb-5">{{ $data->klinik }} — {{ $data->poli }}</p>

                                        <form method="POST" action="{{ route('survei.spesifik') }}">
                                            @csrf
                                            <input type="hidden" name="pendaftaran_id" value="{{ $data->id }}">

                                            <p class="label-clay mb-3">Rating (klik bintang)</p>
                                            
                                            <!-- Star Rating Component -->
                                            <div class="star-rating flex gap-2 mb-5" id="stars-survei-{{ $data->id }}" data-value="0">
                                                <button type="button" data-val="1" onclick="setRating('survei-{{ $data->id }}',1)" onmouseover="hoverStar('survei-{{ $data->id }}',1)" onmouseout="resetStar('survei-{{ $data->id }}')" class="star-btn text-4xl select-none cursor-pointer bg-transparent border-none p-0 transition-transform hover:scale-110" style="color:#e2e8f0;">★</button>
                                                <button type="button" data-val="2" onclick="setRating('survei-{{ $data->id }}',2)" onmouseover="hoverStar('survei-{{ $data->id }}',2)" onmouseout="resetStar('survei-{{ $data->id }}')" class="star-btn text-4xl select-none cursor-pointer bg-transparent border-none p-0 transition-transform hover:scale-110" style="color:#e2e8f0;">★</button>
                                                <button type="button" data-val="3" onclick="setRating('survei-{{ $data->id }}',3)" onmouseover="hoverStar('survei-{{ $data->id }}',3)" onmouseout="resetStar('survei-{{ $data->id }}')" class="star-btn text-4xl select-none cursor-pointer bg-transparent border-none p-0 transition-transform hover:scale-110" style="color:#e2e8f0;">★</button>
                                                <button type="button" data-val="4" onclick="setRating('survei-{{ $data->id }}',4)" onmouseover="hoverStar('survei-{{ $data->id }}',4)" onmouseout="resetStar('survei-{{ $data->id }}')" class="star-btn text-4xl select-none cursor-pointer bg-transparent border-none p-0 transition-transform hover:scale-110" style="color:#e2e8f0;">★</button>
                                                <button type="button" data-val="5" onclick="setRating('survei-{{ $data->id }}',5)" onmouseover="hoverStar('survei-{{ $data->id }}',5)" onmouseout="resetStar('survei-{{ $data->id }}')" class="star-btn text-4xl select-none cursor-pointer bg-transparent border-none p-0 transition-transform hover:scale-110" style="color:#e2e8f0;">★</button>
                                            </div>
                                            <input type="hidden" name="rating" id="rating-input-survei-{{ $data->id }}" required>
                                            

                                            <label class="label-clay mb-2">Komentar (opsional)</label>
                                            <textarea name="komentar" rows="3" placeholder="Ceritakan pengalaman kunjungan Anda..." class="input-clay mb-5"></textarea>

                                            <div class="flex gap-3 justify-end">
                                                <button type="button"
                                                    onclick="document.getElementById('modal-survei-{{ $data->id }}').classList.add('hidden')"
                                                    class="btn-clay btn-white" style="padding:10px 20px;">Batal</button>
                                                <button type="submit" class="btn-clay btn-primary" style="padding:10px 24px;">Kirim →</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @else
                            <span class="text-slate-300 text-xs font-bold">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-16 text-center">
                        <div class="text-5xl mb-3">📭</div>
                        <p class="text-slate-400 font-bold">Belum ada riwayat pendaftaran.</p>
                        <a href="/pendaftaran" class="btn-clay btn-primary inline-block mt-4" style="padding:10px 24px;font-size:0.85rem;">Daftar Sekarang →</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

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
