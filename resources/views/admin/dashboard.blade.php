<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 p-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-slate-800">Dashboard Admin</h1>
            
            <div class="flex gap-4">
                <a href="{{ route('staff.register') }}" class="bg-emerald-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-emerald-700 transition">
                    + Tambah Staf Baru
                </a>
                <form action="{{ route('petugas.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-red-700 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            @foreach($stats as $stat)
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <p class="text-slate-500 text-sm capitalize">{{ $stat->role }}</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ $stat->total }}</h3>
                </div>
            @endforeach
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="p-6 border-b border-slate-100 font-bold text-slate-700">Daftar Semua Staf</div>
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-600 text-sm">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($allStaff as $staff)
                    <tr>
                        <td class="px-6 py-4 font-medium">{{ $staff->name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $staff->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold uppercase">
                                {{ $staff->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4 flex justify-center gap-2">
                            <a href="{{ route('staff.edit', $staff->id) }}" class="text-amber-600 hover:text-amber-700 px-3 py-1 bg-amber-50 rounded">Edit</a>
                            <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('Hapus staf ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:text-red-700 px-3 py-1 bg-red-50 rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 font-bold text-slate-700">Daftar Pasien Terdaftar</div>
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-600 text-sm">
                    <tr>
                        <th class="px-6 py-4">Nama Pasien</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($allPasien as $pasien)
                    <tr>
                        <td class="px-6 py-4 font-medium">{{ $pasien->name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $pasien->email }}</td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" onsubmit="return confirm('Hapus pasien ini? Seluruh riwayat & rekam medisnya juga akan terhapus.')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:text-red-700 px-3 py-1 bg-red-50 rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>