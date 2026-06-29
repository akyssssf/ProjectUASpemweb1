@extends('layouts.app')

@section('content')
<div class="mb-8 flex items-start justify-between gap-4">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-900">Antrean Saya</h1>
        <p class="text-gray-500 mt-1">Pantau nomor antrean dan status panggilan Anda secara real-time.</p>
    </div>
    <a href="/dashboard" class="shrink-0 inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-600 font-bold px-4 py-2.5 rounded-xl hover:bg-gray-50 transition-colors text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Dashboard
    </a>
</div>

@if (!$antrian)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-10 text-center">
        <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Ada Antrean Hari Ini</h3>
        <a href="/pendaftaran" class="inline-block bg-blue-600 text-white font-bold px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors">Daftar Sekarang</a>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

        <!-- Kartu nomor antrean milik pasien - tema emerald -->
        <div id="antrean-card" class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-[2rem] shadow-lg p-8 text-center transition-all duration-500">
            <p class="text-xs font-bold text-emerald-100 uppercase tracking-widest mb-4">Nomor Antrean Anda</p>

            <div id="antrean-poli" class="inline-block px-6 py-1.5 bg-white/20 text-white rounded-xl text-sm font-extrabold uppercase tracking-widest mb-5">
                {{ $antrian->poli }}
            </div>

            <div id="antrean-nomor" class="text-6xl font-black text-white leading-none tracking-tighter mb-5">
                {{ $antrian->nomor_antrian }}
            </div>

            <div id="antrean-status-text" class="inline-block text-sm font-bold text-white bg-white/20 px-4 py-1.5 rounded-full uppercase tracking-wide">
                {{ $antrian->status == 'dipanggil' ? 'Sedang Dipanggil' : ($antrian->status == 'selesai' ? 'Selesai Dilayani' : 'Menunggu Panggilan') }}
            </div>
        </div>

        <!-- Kartu panggilan terkini - tema emerald gelap -->
        <div class="bg-gradient-to-br from-emerald-700 to-emerald-800 rounded-[2rem] shadow-lg p-8 text-center text-white flex flex-col justify-center">
            <p class="text-xs font-bold text-emerald-200 uppercase tracking-widest mb-3">Panggilan Terkini</p>

            <div id="sedang-dipanggil-nomor" class="text-5xl font-black text-white mb-5">
                {{ $sedangDipanggil ?? '—' }}
            </div>

            <div id="estimasi-wrapper" class="bg-white/15 rounded-2xl p-5 border border-white/10">
                <p class="text-[10px] font-bold text-emerald-200 uppercase tracking-widest mb-1.5">Estimasi Menunggu</p>
                <p id="estimasi-text" class="text-xl font-black text-white">
                    {{ ($estimasiMenit !== null && $estimasiMenit > 0) ? $estimasiMenit . ' menit lagi' : 'Sebentar lagi' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Popup besar saat dipanggil -->
    <div id="popup-dipanggil" class="hidden fixed inset-0 z-[999] bg-emerald-700/95 backdrop-blur-sm flex flex-col items-center justify-center text-center px-6">
        <div class="bg-white p-8 rounded-3xl shadow-2xl flex flex-col items-center max-w-sm w-full">
            <div class="text-6xl mb-4 animate-bounce">🔔</div>
            <p class="text-gray-500 font-bold uppercase tracking-widest text-xs mb-1">Nomor Anda Dipanggil!</p>
            <div id="popup-nomor" class="text-7xl font-black text-emerald-600 mb-2"></div>
            <div id="popup-poli" class="text-base font-bold text-gray-700 uppercase mb-6"></div>
            <button onclick="document.getElementById('popup-dipanggil').classList.add('hidden')"
                class="w-full bg-emerald-600 text-white font-bold px-8 py-3.5 rounded-2xl hover:bg-emerald-700 transition-all">
                Saya Mengerti
            </button>
        </div>
    </div>

    <script>
        let statusTerakhir = @json($antrian->status);

        function panggilSuara(nomor, poli) {
            window.speechSynthesis.cancel();
            const teks = `Nomor antrean ${nomor}, poli ${poli}, silakan menuju ke ruangan`;
            const utterance = new SpeechSynthesisUtterance(teks);

            const voices = window.speechSynthesis.getVoices();
            // Cari suara perempuan Indonesia secara prioritas:
            // 1. Google Bahasa Indonesia (biasanya female by default di Chrome/Edge)
            // 2. Microsoft Indonesia - khususnya yang namanya mengandung "Female" atau nama perempuan umum
            // 3. Fallback: voice id-ID apa saja
            let suaraIndo = voices.find(v => v.lang === 'id-ID' && v.name.toLowerCase().includes('google'));
            if (!suaraIndo) {
                suaraIndo = voices.find(v => v.lang === 'id-ID' && (v.name.toLowerCase().includes('female') || v.name.toLowerCase().includes('gadis') || v.name.toLowerCase().includes('damayanti')));
            }
            if (!suaraIndo) {
                suaraIndo = voices.find(v => v.lang === 'id-ID');
            }
            if (suaraIndo) utterance.voice = suaraIndo;

            utterance.lang = 'id-ID';
            utterance.rate = 0.9;
            utterance.pitch = 1.1;
            window.speechSynthesis.speak(utterance);
        }

        function updateStatus() {
            fetch('/antrean/status')
                .then(res => res.json())
                .then(data => {
                    if (!data.ada_antrian) return;

                    document.getElementById('sedang-dipanggil-nomor').innerText = data.sedang_dipanggil ?? '—';

                    const estimasiEl = document.getElementById('estimasi-text');
                    if (estimasiEl) {
                        estimasiEl.innerText = (data.estimasi_menit && data.estimasi_menit > 0)
                            ? data.estimasi_menit + ' menit lagi'
                            : 'Sebentar lagi';
                    }

                    if (data.status !== statusTerakhir) {
                        document.getElementById('antrean-nomor').innerText = data.nomor_antrian;
                        document.getElementById('antrean-poli').innerText = data.poli;

                        const labelText = {
                            menunggu: 'Menunggu Panggilan',
                            dipanggil: 'Sedang Dipanggil',
                            selesai: 'Selesai Dilayani'
                        };
                        document.getElementById('antrean-status-text').innerText = labelText[data.status] ?? data.status;

                        if (data.status === 'dipanggil') {
                            document.getElementById('popup-nomor').innerText = data.nomor_antrian;
                            document.getElementById('popup-poli').innerText = data.poli;
                            document.getElementById('popup-dipanggil').classList.remove('hidden');
                            panggilSuara(data.nomor_antrian, data.poli);
                        }

                        statusTerakhir = data.status;
                    }
                })
                .catch(err => console.warn('Gagal cek status antrean:', err));
        }

        setInterval(updateStatus, 4000);
    </script>
@endif
@endsection