@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between gap-4">
    <div>
        <h1 class="text-2xl font-black text-slate-800">Antrean Saya 🎫</h1>
        <p class="text-slate-500 font-medium mt-1">Pantau nomor antrean secara real-time.</p>
    </div>
    <a href="/dashboard" class="btn-clay btn-white" style="padding:10px 20px;font-size:0.85rem;">← Dashboard</a>
</div>

@if (!$antrian)
    <div class="clay p-12 text-center">
        <div class="text-6xl mb-4">🎟️</div>
        <h3 class="text-xl font-black text-slate-800 mb-2">Belum Ada Antrean Hari Ini</h3>
        <p class="text-slate-500 mb-6">Daftar pemeriksaan terlebih dahulu untuk mendapatkan nomor antrean.</p>
        <a href="/pendaftaran" class="btn-clay btn-primary" style="padding:12px 28px;">Daftar Sekarang →</a>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

        <!-- Kartu nomor antrean milik pasien -->
        <div id="antrean-card" class="clay-blue p-8 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 rounded-full" style="background:rgba(255,255,255,0.1);transform:translate(30%,-30%);"></div>
            <p class="text-indigo-200 text-xs font-black uppercase tracking-widest mb-4">Nomor Antrean Anda</p>
            <div id="antrean-poli" class="inline-block bg-white/20 text-white text-sm font-black uppercase tracking-widest px-5 py-2 mb-5" style="border-radius:12px;">
                {{ $antrian->poli }}
            </div>
            <div id="antrean-nomor" class="text-7xl font-black text-white mb-5 leading-none">
                {{ $antrian->nomor_antrian }}
            </div>
            <div id="antrean-status-text" class="inline-block text-sm font-black text-white bg-white/20 px-5 py-2 uppercase tracking-wide" style="border-radius:12px;">
                {{ $antrian->status == 'dipanggil' ? '📢 Sedang Dipanggil' : ($antrian->status == 'selesai' ? '✅ Selesai Dilayani' : '⏳ Menunggu Panggilan') }}
            </div>
        </div>

        <!-- Kartu panggilan terkini -->
        <div class="clay p-8 text-center flex flex-col justify-between gap-5">
            <div>
                <p class="text-slate-400 text-xs font-black uppercase tracking-widest mb-3">Panggilan Terkini</p>
                <div id="sedang-dipanggil-nomor" class="text-6xl font-black text-indigo-600 mb-2">
                    {{ $sedangDipanggil ?? '—' }}
                </div>
                <p class="text-slate-400 text-sm font-bold">sedang dilayani</p>
            </div>
            <div class="p-5" style="background:#EEF2FF;border-radius:18px;border:2px solid #E0E7FF;">
                <p class="text-indigo-400 text-xs font-black uppercase tracking-widest mb-1">⏱ Estimasi Menunggu</p>
                <p id="estimasi-text" class="text-2xl font-black text-indigo-700">
                    {{ ($estimasiMenit !== null && $estimasiMenit > 0) ? $estimasiMenit . ' menit lagi' : 'Sebentar lagi ✨' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Popup dipanggil -->
    <div id="popup-dipanggil" class="hidden fixed inset-0 z-[999] flex items-center justify-center p-4" style="background:rgba(79,70,229,0.85);backdrop-filter:blur(8px);">
        <div class="clay p-8 text-center max-w-sm w-full" style="border-radius:32px;box-shadow:0 16px 0 #C7D2FE;">
            <div class="text-6xl mb-4 animate-bounce">🔔</div>
            <p class="text-slate-500 font-black uppercase tracking-widest text-xs mb-2">Nomor Anda Dipanggil!</p>
            <div id="popup-nomor" class="text-7xl font-black text-indigo-600 leading-none mb-2"></div>
            <div id="popup-poli" class="text-base font-bold text-slate-700 uppercase mb-6"></div>
            <button onclick="document.getElementById('popup-dipanggil').classList.add('hidden')"
                class="btn-clay btn-primary w-full" style="padding:14px;">
                Saya Mengerti ✓
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
            let suara = voices.find(v => v.lang === 'id-ID' && v.name.toLowerCase().includes('google'))
                     || voices.find(v => v.lang === 'id-ID');
            if (suara) utterance.voice = suara;
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
                            : 'Sebentar lagi ✨';
                    }
                    if (data.status !== statusTerakhir) {
                        document.getElementById('antrean-nomor').innerText = data.nomor_antrian;
                        document.getElementById('antrean-poli').innerText = data.poli;
                        const labelText = { menunggu: '⏳ Menunggu Panggilan', dipanggil: '📢 Sedang Dipanggil', selesai: '✅ Selesai Dilayani' };
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
                .catch(err => console.warn('Gagal cek status:', err));
        }

        setInterval(updateStatus, 4000);
    </script>
@endif
@endsection
