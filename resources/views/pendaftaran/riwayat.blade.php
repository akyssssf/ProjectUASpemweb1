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
                <tr style="background:#EEF2FF;border-bottom:2px solid #E0E7FF;">
                    <th class="px-6 py-4 text-[10px] font-black text-indigo-400 uppercase tracking-widest">Tanggal</th>
                    <th class="px-6 py-4 text-[10px] font-black text-indigo-400 uppercase tracking-widest">Layanan</th>
                    <th class="px-6 py-4 text-[10px] font-black text-indigo-400 uppercase tracking-widest">Klinik / Poli</th>
                    <th class="px-6 py-4 text-[10px] font-black text-indigo-400 uppercase tracking-widest">Dokter</th>
                    <th class="px-6 py-4 text-[10px] font-black text-indigo-400 uppercase tracking-widest">Status</th>
                    <th class="px-6 py-4 text-[10px] font-black text-indigo-400 uppercase tracking-widest">Penilaian</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $data)
                <tr style="border-bottom:2px solid #EEF2FF;" class="hover:bg-indigo-50/30 transition-colors">
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
                                <div id="modal-survei-{{ $data->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4" style="background:rgba(79,70,229,0.7);backdrop-filter:blur(6px);">
                                    <div class="clay p-8 max-w-md w-full" style="border-radius:28px;box-shadow:0 16px 0 #C7D2FE;">
                                        <h4 class="font-black text-slate-800 text-lg mb-1">⭐ Beri Penilaian</h4>
                                        <p class="text-sm text-slate-400 font-bold mb-5">{{ $data->klinik }} — {{ $data->poli }}</p>

                                        <form method="POST" action="{{ route('survei.spesifik') }}">
                                            @csrf
                                            <input type="hidden" name="pendaftaran_id" value="{{ $data->id }}">

                                            <p class="label-clay mb-3">Rating (klik bintang)</p>
                                            <div class="flex gap-2 mb-5">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <label class="cursor-pointer">
                                                        <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" required>
                                                        <span class="text-4xl text-slate-200 peer-checked:text-amber-400 hover:text-amber-300 transition-colors select-none">★</span>
                                                    </label>
                                                @endfor
                                            </div>

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
@endsection
