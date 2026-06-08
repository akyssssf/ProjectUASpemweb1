<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Klinik</title>
    <!-- Gunakan direktif Vite di bawah ini jika Tailwind sudah di-install via NPM -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alternatif CDN hanya untuk prototyping cepat (hapus jika pakai Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <!-- Navbar Sederhana -->
    <nav class="bg-blue-600 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="text-white font-bold text-xl">Klinik Sehat</div>
                <div class="text-white text-sm">
                    <!-- Nanti bisa diisi nama user yang login -->
                    Halo, Pasien
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

</body>
</html>