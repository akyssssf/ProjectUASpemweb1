<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 p-8">
    <div class="max-w-md mx-auto">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-slate-500 hover:text-slate-800 mb-6 transition">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Dashboard
        </a>

        <div class="bg-white p-8 rounded-2xl shadow-sm border">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">Tambah Staf Baru</h2>
            
            <form action="{{ route('staff.register') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                    <input type="text" name="name" class="w-full border p-2 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" class="w-full border p-2 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700">Role</label>
                    <select name="role" class="w-full border p-2 rounded-lg">
                        <option value="admin">Admin</option>
                        <option value="dokter">Dokter</option>
                        <option value="nakes">Nakes</option>
                        <option value="loket">Loket</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" name="password" class="w-full border p-2 rounded-lg" required>
                </div>
                <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg font-semibold hover:bg-emerald-700 transition">
                    Simpan Staf
                </button>
            </form>
        </div>
    </div>
</body>
</html>