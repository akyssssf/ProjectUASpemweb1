@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Riwayat Pendaftaran</h2>
            <p class="text-gray-500 mt-1">Daftar kunjungan medis Anda di klinik kami.</p>
        </div>
        
        <a href="{{ url('/dashboard') }}" class="group inline-flex items-center justify-center bg-white border border-gray-200 hover:border-indigo-300 hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 font-semibold py-3 px-6 rounded-2xl transition-all shadow-sm">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Dashboard
        </a>
    </div>
    
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4 text-sm font-semibold text-gray-600">Tanggal</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Jenis Layanan</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Klinik / Poli</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Dokter</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($riwayat as $data)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}</td>
                    
                    <td class="p-4 text-sm">
                        <span class="px-3 py-1 rounded-lg font-bold text-xs uppercase tracking-wider 
                            {{ $data->jenis_pendaftaran == 'BPJS' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ $data->jenis_pendaftaran }}
                        </span>
                        @if($data->jenis_pendaftaran == 'BPJS' && $data->no_bpjs)
                            <div class="text-[10px] text-gray-400 mt-1">No: {{ $data->no_bpjs }}</div>
                        @endif
                    </td>

                    <td class="p-4 text-sm">
                        <div class="font-semibold text-gray-800">{{ $data->klinik }}</div>
                        <div class="text-xs text-gray-500">{{ $data->poli }}</div>
                    </td>
                    
                    <td class="p-4 text-sm text-gray-700">{{ $data->dokter }}</td>
                    
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                            {{ $data->status == 'menunggu' ? 'bg-yellow-100 text-yellow-700' : ($data->status == 'selesai' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($data->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-10 text-center text-gray-500">
                        Belum ada riwayat pendaftaran.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection