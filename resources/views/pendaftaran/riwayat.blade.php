@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-800">Riwayat Pendaftaran</h2>
            <p class="text-slate-500 mt-1 font-medium">Pantau status kunjungan medis Anda.</p>
        </div>
        
        <a href="{{ url('/dashboard') }}" class="group inline-flex items-center justify-center bg-white border border-slate-200 hover:border-indigo-300 hover:bg-indigo-50 text-slate-600 hover:text-indigo-600 font-bold py-3 px-6 rounded-2xl transition-all shadow-sm">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Dashboard
        </a>
    </div>
    
    <div class="bg-white shadow-2xl shadow-slate-200/50 rounded-[2rem] overflow-hidden border border-slate-100">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                    <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Layanan</th>
                    <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Klinik / Poli</th>
                    <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Dokter</th>
                    <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                    <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Penilaian</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($riwayat as $data)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="p-6 text-sm font-bold text-slate-700">
                        {{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}
                    </td>
                    
                    <td class="p-6 text-sm">
                        <span class="px-3 py-1 rounded-lg font-black text-[10px] uppercase tracking-wider 
                            {{ $data->jenis_pendaftaran == 'BPJS' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600' }}">
                            {{ $data->jenis_pendaftaran }}
                        </span>
                        @if($data->jenis_pendaftaran == 'BPJS' && $data->no_bpjs)
                            <div class="text-[10px] text-slate-400 mt-1 font-bold">NO: {{ $data->no_bpjs }}</div>
                        @endif
                    </td>

                    <td class="p-6 text-sm">
                        <div class="font-bold text-slate-800">{{ $data->klinik }}</div>
                        <div class="text-xs text-slate-500 font-medium">{{ $data->poli }}</div>
                    </td>
                    
                    <td class="p-6 text-sm font-bold text-slate-600">{{ $data->dokter }}</td>
                    
                    <td class="p-6">
                        @if($data->antrian)
                            <span class="px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest
                                {{ $data->antrian->status == 'menunggu' ? 'bg-amber-100 text-amber-700' : '' }}
                                {{ $data->antrian->status == 'dipanggil' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $data->antrian->status == 'selesai' ? 'bg-emerald-100 text-emerald-700' : '' }}">
                                {{ ucfirst($data->antrian->status) }}
                            </span>
                        @else
                            <span class="text-slate-400 text-xs italic font-medium">Menunggu Antrean</span>
                        @endif
                    </td>

                    <td class="p-6">
                        @if($data->antrian && $data->antrian->status == 'selesai')
                            @if($data->survei)
                                <span class="text-amber-500 font-bold text-xs">&#9733; {{ $data->survei->rating }}/5 (terkirim)</span>
                            @else
                                <button type="button" onclick="document.getElementById('modal-survei-{{ $data->id }}').classList.remove('hidden')"
                                    class="text-xs font-bold px-3 py-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100">
                                    Beri Penilaian
                                </button>

                                <div id="modal-survei-{{ $data->id }}" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 p-4">
                                    <div class="bg-white rounded-2xl p-6 max-w-md w-full">
                                        <h4 class="font-bold text-slate-800 mb-1">Penilaian Kunjungan</h4>
                                        <p class="text-xs text-slate-400 mb-4">{{ $data->klinik }} &mdash; {{ $data->poli }}</p>

                                        <form method="POST" action="{{ route('survei.spesifik') }}">
                                            @csrf
                                            <input type="hidden" name="pendaftaran_id" value="{{ $data->id }}">

                                            <div class="flex gap-2 mb-4">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <label class="cursor-pointer">
                                                        <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" required>
                                                        <span class="text-3xl text-slate-300 peer-checked:text-amber-400">&#9733;</span>
                                                    </label>
                                                @endfor
                                            </div>

                                            <textarea name="komentar" rows="3" placeholder="Komentar (opsional)" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm mb-4"></textarea>

                                            <div class="flex gap-2 justify-end">
                                                <button type="button" onclick="document.getElementById('modal-survei-{{ $data->id }}').classList.add('hidden')"
                                                    class="px-4 py-2 text-sm font-bold text-slate-500">Batal</button>
                                                <button type="submit" class="px-4 py-2 text-sm font-bold bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">Kirim</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @else
                            <span class="text-slate-300 text-xs italic">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-16 text-center text-slate-400 font-bold">
                        <i class="fas fa-folder-open text-4xl mb-4 block opacity-50"></i>
                        Belum ada riwayat pendaftaran.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection