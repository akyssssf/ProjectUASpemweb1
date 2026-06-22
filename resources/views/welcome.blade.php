<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Klinik Sehat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col">

    <nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="text-blue-600 font-bold text-xl tracking-tight">Klinik Sehat</div>
                <div class="space-x-4">
                    <a href="/login" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Masuk</a>
                    <a href="/register" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 tracking-tight">
                Layanan Kesehatan <span class="text-blue-600">Terbaik & Cepat</span>
            </h1>
            <p class="text-lg text-gray-500 mb-10 max-w-2xl mx-auto">
                Daftar periksa, pantau antrean secara real-time, dan berikan penilaian layanan dengan mudah melalui sistem digital Klinik Sehat.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/register" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
                    Daftar Sebagai Pasien
                </a>
                <a href="#fitur" class="bg-white text-gray-700 px-8 py-3 rounded-lg font-semibold text-lg hover:bg-gray-50 transition-all border border-gray-200 shadow-sm">
                    Pelajari Fitur
                </a>
            </div>
        </div>
    </main>

    <section id="fitur" class="bg-white py-16 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-6">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pendaftaran Online</h3>
                    <p class="text-gray-500">Tidak perlu repot datang pagi, daftar dari mana saja.</p>
                </div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pantau Antrean</h3>
                    <p class="text-gray-500">Lihat nomor antrean yang sedang dipanggil secara real-time.</p>
                </div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Berikan Ulasan</h3>
                    <p class="text-gray-500">Bantu kami meningkatkan pelayanan dengan ulasan Anda.</p>
                </div>
            </div>
        </div>
    </section>

</body>
</html>