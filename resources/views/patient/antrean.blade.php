@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Antrean Saya</h1>
    <p class="text-gray-500 mt-1">Pantau nomor antrean dan status panggilan Anda secara real-time.</p>
</div>

@if (!$antrian)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-10 text-center">
        <div class="w-16 h-16 bg-gray-50 text-gray-400 rounded-2xl flex items-center justify-center mx-auto mb-5">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Antrean Hari Ini</h3>
        <p class="text-sm text-gray-500 mb-6">Anda belum mendaftar pemeriksaan hari ini. Silakan daftar terlebih dahulu.</p>
        <a href="/pendaftaran" class="inline-block bg-blue-600 text-white font-medium px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors">
            Daftar Sekarang
        </a>
    </div>
@else
    <div id="antrean-card" class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-10 text-center transition-all duration-500">
        <div id="antrean-poli" class="inline-block px-5 py-2 bg-emerald-50 text-emerald-600 rounded-xl text-sm font-bold uppercase tracking-widest mb-6">
            {{ $antrian->poli }}
        </div>

        <div id="antrean-nomor" class="text-7xl md:text-8xl font-black text-gray-900 tracking-tighter mb-6 transition-all duration-500">
            {{ $antrian->nomor_antrian }}
        </div>

        <div id="antrean-status" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full font-bold text-sm uppercase tracking-wide
            @if($antrian->status == 'dipanggil') bg-orange-100 text-orange-600 animate-pulse
            @elseif($antrian->status == 'selesai') bg-slate-100 text-slate-500
            @else bg-blue-50 text-blue-600 @endif">
            <span class="w-2 h-2 rounded-full
                @if($antrian->status == 'dipanggil') bg-orange-500
                @elseif($antrian->status == 'selesai') bg-slate-400
                @else bg-blue-500 @endif"></span>
            @if($antrian->status == 'dipanggil')
                Sedang Dipanggil — Silakan Menuju Ruangan
            @elseif($antrian->status == 'selesai')
                Selesai Dilayani
            @else
                Menunggu Panggilan
            @endif
        </div>

        <p class="text-xs text-gray-400 mt-8">Halaman ini otomatis perbarui status setiap beberapa detik.</p>
    </div>

    <!-- Tombol aktifkan suara (wajib diklik agar browser mengizinkan TTS) -->
    <div id="overlay-suara" class="fixed inset-0 bg-black/80 z-50 flex flex-col items-center justify-center gap-4 px-6">
        <div class="text-center">
            <div class="text-4xl mb-3">🔊</div>
            <h2 class="text-white text-lg font-bold mb-1">Aktifkan Notifikasi Suara</h2>
            <p class="text-slate-400 text-sm">Klik untuk mengaktifkan suara saat nomor Anda dipanggil</p>
        </div>
        <button onclick="aktifkanSuara()" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-8 py-3 rounded-xl transition-all">
            ▶ Aktifkan Suara
        </button>
    </div>

    <script>
        let statusTerakhir = @json($antrian->status);
        let suaraAktif = false;

        function aktifkanSuara() {
            const warmup = new SpeechSynthesisUtterance('');
            window.speechSynthesis.speak(warmup);
            suaraAktif = true;
            document.getElementById('overlay-suara').style.display = 'none';
        }

        function panggilSuara(nomor, poli) {
            if (!suaraAktif) return;
            window.speechSynthesis.cancel();
            const teks = `Nomor antrean ${nomor}, poli ${poli}, silakan menuju ke ruangan`;
            const utterance = new SpeechSynthesisUtterance(teks);
            utterance.lang = 'id-ID';
            utterance.rate = 0.85;
            window.speechSynthesis.speak(utterance);
        }

        function updateStatus() {
            fetch('/antrean/status')
                .then(res => res.json())
                .then(data => {
                    if (!data.ada_antrian) return;

                    if (data.status !== statusTerakhir) {
                        // Update tampilan nomor & poli
                        document.getElementById('antrean-nomor').innerText = data.nomor_antrian;
                        document.getElementById('antrean-poli').innerText = data.poli;

                        // Update badge status
                        const statusEl = document.getElementById('antrean-status');
                        const dotColors = { menunggu: 'bg-blue-500', dipanggil: 'bg-orange-500', selesai: 'bg-slate-400' };
                        const bgColors = { menunggu: 'bg-blue-50 text-blue-600', dipanggil: 'bg-orange-100 text-orange-600 animate-pulse', selesai: 'bg-slate-100 text-slate-500' };
                        const labelText = { menunggu: 'Menunggu Panggilan', dipanggil: 'Sedang Dipanggil — Silakan Menuju Ruangan', selesai: 'Selesai Dilayani' };

                        statusEl.className = 'inline-flex items-center gap-2 px-5 py-2.5 rounded-full font-bold text-sm uppercase tracking-wide ' + bgColors[data.status];
                        statusEl.innerHTML = `<span class="w-2 h-2 rounded-full ${dotColors[data.status]}"></span> ${labelText[data.status]}`;

                        if (data.status === 'dipanggil') {
                            panggilSuara(data.nomor_antrian, data.poli);
                        }

                        statusTerakhir = data.status;
                    }
                })
                .catch(err => console.warn('Koneksi terputus...'));
        }

        setInterval(() => { if (suaraAktif) updateStatus(); }, 4000);
    </script>
@endif
@endsection