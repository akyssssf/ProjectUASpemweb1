<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas - Klinik Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-3xl shadow-xl p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-slate-800 mb-1">Login Petugas</h1>
        <p class="text-slate-400 text-sm mb-6">Khusus untuk petugas klinik</p>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 text-sm rounded-xl p-4 mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/petugas/login">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                <input type="email" name="email" required
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" required
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500">
            </div>

            <button type="submit"
                class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 rounded-xl transition-all">
                Masuk
            </button>
        </form>
    </div>

</body>
</html>