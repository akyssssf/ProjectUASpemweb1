@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-8">
    <div class="w-full max-w-md">

        <div class="text-center mb-8">
            <div class="clay-blue w-16 h-16 flex items-center justify-center mx-auto mb-4" style="border-radius:20px;box-shadow:0 6px 0 #3730A3;">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
            <h1 class="text-3xl font-black text-slate-800">Buat Akun Baru</h1>
            <p class="text-slate-500 mt-1 font-medium">Daftar dan mulai layanan klinik digital 🏥</p>
        </div>

        <div class="clay p-8">
            <form method="POST" action="/register" class="space-y-4">
                @csrf
                <div>
                    <label class="label-clay">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="input-clay" placeholder="Nama sesuai KTP" required>
                </div>
                <div>
                    <label class="label-clay">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="input-clay" placeholder="email@kamu.com" required>
                </div>
                <div>
                    <label class="label-clay">NIK (16 digit)</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16" class="input-clay" placeholder="3301xxxxxxxxxxxxxxxx" required>
                </div>
                <div>
                    <label class="label-clay">Nomor HP / WhatsApp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="input-clay" placeholder="08xxxxxxxxxx" required>
                </div>
                <div>
                    <label class="label-clay">Alamat</label>
                    <textarea name="alamat" rows="2" class="input-clay" style="resize:none;" placeholder="Jl. Contoh No.1, Kota..." required>{{ old('alamat') }}</textarea>
                </div>
                <div>
                    <label class="label-clay">Password</label>
                    <input type="password" name="password" class="input-clay" placeholder="Min. 8 karakter" required>
                </div>
                <div>
                    <label class="label-clay">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="input-clay" placeholder="Ulangi password" required>
                </div>

                <button type="submit" class="btn-clay btn-primary w-full text-center text-base mt-2" style="padding:14px;">
                    Daftar Sekarang →
                </button>
            </form>

            <div class="mt-6 pt-6 border-t-2 border-indigo-50 text-center">
                <p class="text-slate-500 text-sm font-medium">
                    Sudah punya akun?
                    <a href="/login" class="font-black text-indigo-600 hover:text-indigo-700 ml-1">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
