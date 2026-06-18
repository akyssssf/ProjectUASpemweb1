@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    
    <!-- Tombol Kembali dengan Cover -->
    <div class="mb-8">
        <a href="{{ url('/pendaftaran') }}" class="inline-flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-xl transition-all shadow-sm border border-gray-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Pilihan Pendaftaran
        </a>
    </div>

    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">Pendaftaran BPJS</h2>
        <p class="text-gray-500 mt-2">Lengkapi data untuk mengajukan pendaftaran BPJS</p>
    </div>
    
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
        <form action="/pendaftaran/simpan-bpjs" method="POST" class="space-y-6">
            @csrf
            
            <!-- Data Identitas -->
            <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100">
                <h3 class="text-lg font-bold text-blue-900 mb-4 border-b border-blue-200 pb-2">Identitas Pasien</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-blue-600 uppercase">Nama Lengkap</label>
                        <input type="text" value="{{ $pasien->name }}" readonly class="w-full mt-1 p-3 bg-white border border-blue-200 rounded-xl text-gray-700 cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-blue-600 uppercase">NIK</label>
                        <input type="text" value="{{ $pasien->nik }}" readonly class="w-full mt-1 p-3 bg-white border border-blue-200 rounded-xl text-gray-700 cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-blue-600 uppercase">Nomor HP</label>
                        <input type="text" value="{{ $pasien->no_hp }}" readonly class="w-full mt-1 p-3 bg-white border border-blue-200 rounded-xl text-gray-700 cursor-not-allowed">
                    </div>
                </div>
            </div>

            <!-- Data Medis BPJS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Kartu BPJS</label>
                    <input type="text" name="no_bpjs" maxlength="13" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500" placeholder="0001234567890" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Faskes Asal</label>
                    <input type="text" name="faskes_asal" class="w-full px-4 py-3 border border-gray-300 rounded-xl" placeholder="Contoh: Puskesmas" required>
                </div>
            </div>

            <!-- Dropdown Dinamis -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Klinik</label>
                    <select name="klinik" id="klinik" class="w-full px-4 py-3 border border-gray-300 rounded-xl" required>
                        <option value="">Pilih Klinik</option>
                        @foreach(array_keys($dataKlinik) as $klinik)
                            <option value="{{ $klinik }}">{{ $klinik }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Poli</label>
                    <select name="poli" id="poli" class="w-full px-4 py-3 border border-gray-300 rounded-xl" required disabled>
                        <option value="">Pilih Poli</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Dokter</label>
                    <select name="dokter" id="dokter" class="w-full px-4 py-3 border border-gray-300 rounded-xl" required disabled>
                        <option value="">Pilih Dokter</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Rujukan</label>
                <select name="jenis_rujukan" class="w-full px-4 py-3 border border-gray-300 rounded-xl" required>
                    <option value="mandiri">Mandiri</option>
                    <option value="puskesmas">Puskesmas</option>
                    <option value="rs_lain">RS Lain</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Kunjungan</label>
                <input type="date" name="tanggal" class="w-full px-4 py-3 border border-gray-300 rounded-xl" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Keluhan</label>
                <textarea name="keluhan" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-xl" placeholder="Jelaskan keluhan Anda"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transition-transform active:scale-95">
                Kirim Pendaftaran BPJS
            </button>
        </form>
    </div>
</div>

<script>
    const dataKlinik = @json($dataKlinik);
    const klinikSelect = document.getElementById('klinik');
    const poliSelect = document.getElementById('poli');
    const dokterSelect = document.getElementById('dokter');

    klinikSelect.addEventListener('change', function() {
        poliSelect.innerHTML = '<option value="">Pilih Poli</option>';
        dokterSelect.innerHTML = '<option value="">Pilih Dokter</option>';
        if (this.value) {
            poliSelect.disabled = false;
            Object.keys(dataKlinik[this.value]).forEach(poli => {
                poliSelect.innerHTML += `<option value="${poli}">${poli}</option>`;
            });
        } else {
            poliSelect.disabled = true;
            dokterSelect.disabled = true;
        }
    });

    poliSelect.addEventListener('change', function() {
        dokterSelect.innerHTML = '<option value="">Pilih Dokter</option>';
        if (this.value) {
            dokterSelect.disabled = false;
            dataKlinik[klinikSelect.value][this.value].forEach(dokter => {
                dokterSelect.innerHTML += `<option value="${dokter}">${dokter}</option>`;
            });
        } else {
            dokterSelect.disabled = true;
        }
    });
</script>
@endsection