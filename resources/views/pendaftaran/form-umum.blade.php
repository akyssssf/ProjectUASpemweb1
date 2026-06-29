@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-2xl mx-auto">
        
        <div class="mb-6">
            <a href="{{ url('/pendaftaran') }}" class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-6 rounded-xl transition-all shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Layanan
            </a>
        </div>

        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">Form Pendaftaran Umum</h2>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
            <form action="/pendaftaran/simpan-umum" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="klinik" id="klinik_hidden">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" value="{{ Auth::guard('pasien')->user()->name }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">NIK</label>
                        <input type="text" value="{{ Auth::guard('pasien')->user()->nik }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed" readonly>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP</label>
                    <input type="text" value="{{ Auth::guard('pasien')->user()->no_hp }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed" readonly>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Klinik</label>
                        <select id="klinik" onchange="updatePoli()" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500" required>
                            <option value="">Pilih Klinik</option>
                            @foreach(array_keys($dataKlinik) as $k)
                                <option value="{{ $k }}">{{ $k }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Poli</label>
                        <select name="poli" id="poli" onchange="updateDokter()" disabled class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-100 cursor-not-allowed" required>
                            <option value="">Pilih Klinik Dulu</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Dokter</label>
                        <select name="dokter" id="dokter" disabled class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-100 cursor-not-allowed" required>
                            <option value="">Pilih Poli Dulu</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                        <input type="date" name="tanggal" class="w-full px-4 py-3 border border-gray-300 rounded-xl" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Keluhan</label>
                        <input type="text" name="keluhan" class="w-full px-4 py-3 border border-gray-300 rounded-xl" placeholder="Tuliskan keluhan...">
                    </div>
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 rounded-xl shadow-lg transition-all transform active:scale-95">
                    Konfirmasi Pendaftaran
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const dataKlinik = @json($dataKlinik);
    function updatePoli() {
        const k = document.getElementById('klinik').value;
        document.getElementById('klinik_hidden').value = k;
        const p = document.getElementById('poli');
        const d = document.getElementById('dokter');
        p.innerHTML = '<option value="">Pilih Poli</option>';
        d.innerHTML = '<option value="">Pilih Poli Dulu</option>';
        if(k) { p.disabled = false; p.classList.remove('bg-gray-100', 'cursor-not-allowed');
            Object.keys(dataKlinik[k]).forEach(poli => p.innerHTML += `<option value="${poli}">${poli}</option>`);
        } else { p.disabled = true; p.classList.add('bg-gray-100', 'cursor-not-allowed'); }
        d.disabled = true; d.classList.add('bg-gray-100', 'cursor-not-allowed');
    }
    function updateDokter() {
        const k = document.getElementById('klinik').value;
        const p = document.getElementById('poli').value;
        const d = document.getElementById('dokter');
        d.innerHTML = '<option value="">Pilih Dokter</option>';
        if(p) { d.disabled = false; d.classList.remove('bg-gray-100', 'cursor-not-allowed');
            dataKlinik[k][p].forEach(doc => d.innerHTML += `<option value="${doc}">${doc}</option>`);
        } else { d.disabled = true; d.classList.add('bg-gray-100', 'cursor-not-allowed'); }
    }
</script>
@endsection