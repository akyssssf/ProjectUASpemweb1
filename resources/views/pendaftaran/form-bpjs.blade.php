@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6 flex items-center gap-4">
        <a href="/pendaftaran" class="btn-clay btn-white" style="padding:10px 20px;font-size:0.85rem;">← Kembali</a>
        <div>
            <h2 class="text-2xl font-black text-slate-800">Pendaftaran BPJS 📋</h2>
            <p class="text-slate-500 text-sm font-medium">Lengkapi data untuk pendaftaran BPJS Kesehatan.</p>
        </div>
    </div>

    <div class="clay p-8">
        <form action="/pendaftaran/simpan-bpjs" method="POST" class="space-y-5">
            @csrf

            <!-- Info Pasien -->
            <div class="p-4 mb-2" style="background:#EEF2FF;border-radius:16px;border:2px solid #E0E7FF;">
                <p class="text-xs font-black text-indigo-400 uppercase tracking-widest mb-3">Data Pasien</p>
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <p class="text-xs font-bold text-slate-400 mb-1">Nama</p>
                        <p class="font-black text-slate-700 text-sm">{{ $pasien->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 mb-1">NIK</p>
                        <p class="font-black text-slate-700 text-sm">{{ $pasien->nik }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 mb-1">No HP</p>
                        <p class="font-black text-slate-700 text-sm">{{ $pasien->no_hp }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label-clay">Nomor Kartu BPJS</label>
                    <input type="text" name="no_bpjs" maxlength="13" class="input-clay" placeholder="0001234567890" required>
                </div>
                <div>
                    <label class="label-clay">Faskes Asal</label>
                    <input type="text" name="faskes_asal" class="input-clay" placeholder="Contoh: Puskesmas Kartasura" required>
                </div>
            </div>

            <div>
                <label class="label-clay">Jenis Rujukan</label>
                <select name="jenis_rujukan" class="input-clay" required>
                    <option value="mandiri">Mandiri</option>
                    <option value="puskesmas">Puskesmas</option>
                    <option value="rs_lain">RS Lain</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="label-clay">Klinik</label>
                    <select name="klinik" id="klinik" class="input-clay" required>
                        <option value="">Pilih Klinik</option>
                        @foreach(array_keys($dataKlinik) as $klinik)
                            <option value="{{ $klinik }}">{{ $klinik }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="label-clay">Poli</label>
                    <select name="poli" id="poli" class="input-clay" disabled style="opacity:0.6;" required>
                        <option value="">Pilih Klinik Dulu</option>
                    </select>
                </div>
                <div>
                    <label class="label-clay">Dokter</label>
                    <select name="dokter" id="dokter" class="input-clay" disabled style="opacity:0.6;" required>
                        <option value="">Pilih Poli Dulu</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label-clay">Tanggal Kunjungan</label>
                    <input type="date" name="tanggal" class="input-clay" min="{{ date('Y-m-d') }}" required>
                </div>
                <div>
                    <label class="label-clay">Keluhan</label>
                    <input type="text" name="keluhan" class="input-clay" placeholder="Tuliskan keluhan Anda...">
                </div>
            </div>

            <button type="submit" class="btn-clay btn-primary w-full text-center text-base" style="padding:14px;">
                Kirim Pendaftaran BPJS →
            </button>
        </form>
    </div>
</div>

<script>
    const dataKlinik = @json($dataKlinik);
    document.getElementById('klinik').addEventListener('change', function() {
        const p = document.getElementById('poli'), d = document.getElementById('dokter');
        p.innerHTML = '<option value="">Pilih Poli</option>';
        d.innerHTML = '<option value="">Pilih Poli Dulu</option>';
        if (this.value) {
            p.disabled = false; p.style.opacity = '1';
            Object.keys(dataKlinik[this.value]).forEach(poli => p.innerHTML += `<option value="${poli}">${poli}</option>`);
        } else { p.disabled = true; p.style.opacity = '0.6'; }
        d.disabled = true; d.style.opacity = '0.6';
    });
    document.getElementById('poli').addEventListener('change', function() {
        const k = document.getElementById('klinik').value;
        const d = document.getElementById('dokter');
        d.innerHTML = '<option value="">Pilih Dokter</option>';
        if (this.value) {
            d.disabled = false; d.style.opacity = '1';
            dataKlinik[k][this.value].forEach(doc => d.innerHTML += `<option value="${doc}">${doc}</option>`);
        } else { d.disabled = true; d.style.opacity = '0.6'; }
    });
</script>
@endsection
