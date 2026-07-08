@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-8">
    <div class="w-full max-w-md">

        <div class="text-center mb-8">
            <div class="clay-blue w-16 h-16 flex items-center justify-center mx-auto mb-4" style="border-radius:20px;box-shadow:0 6px 0 #00005A;">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <h1 class="text-3xl font-black text-slate-800">Masuk Akun Pasien</h1>
            <p class="text-slate-500 mt-1 font-medium">Selamat datang kembali! 👋</p>
        </div>



        <div class="clay p-8">
            @if ($errors->any())
                <div class="mb-4 p-3 rounded-xl text-red-700 font-bold text-sm flex items-center gap-2" style="background:#FEF2F2;border:2px solid #FECACA;">
                    <span>⚠️</span> {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-5">
                @csrf
                <div>
                    <label class="label-clay">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="input-clay" placeholder="email@kamu.com" required>
                </div>
                <div>
                    <label class="label-clay">NIK (16 digit)</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16" class="input-clay" placeholder="3577xxxxxxxxxxxxxxxx" required>
                </div>
                <div>
                    <label class="label-clay">Password</label>
                    <input type="password" name="password" class="input-clay" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-clay btn-primary w-full text-center text-base mt-2" style="padding:14px;">
                    Masuk Sekarang →
                </button>
            </form>

            <div class="mt-6 pt-6 border-t-2 border-blue-50 text-center">
                <p class="text-slate-500 text-sm font-medium">
                    Belum punya akun?
                    <a href="/register" class="font-black hover:opacity-70 ml-1" style="color:#1A237E;">Daftar di sini</a>
                </p>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('petugas.login') }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">
                Akses Petugas / Dokter / Admin →
            </a>
        </div>
    </div>
</div>
@endsection
