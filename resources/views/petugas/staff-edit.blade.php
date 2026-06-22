<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 p-10">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-6">Edit Staf</h2>
        <form action="{{ route('staff.update', $staff->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="name" value="{{ $staff->name }}" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" value="{{ $staff->email }}" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label>Role</label>
                <select name="role" class="w-full border p-2 rounded">
                    @foreach(['admin', 'dokter', 'loket', 'klinik', 'nakes'] as $role)
                        <option value="{{ $role }}" {{ $staff->role == $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>
            <button class="bg-blue-600 text-white px-6 py-2 rounded">Update Data</button>
        </form>
    </div>
</body>
</html>