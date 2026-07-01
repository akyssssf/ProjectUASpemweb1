<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #EEF2FF; }

        /* === CLAYMORPHISM CORE === */
        .clay {
            background: white;
            border-radius: 24px;
            box-shadow: 0 8px 0 0 #C7D2FE, 0 12px 32px rgba(99,102,241,0.10);
            border: 2px solid #E0E7FF;
        }
        .clay-blue {
            background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
            border-radius: 24px;
            box-shadow: 0 8px 0 0 #3730A3, 0 12px 32px rgba(99,102,241,0.30);
            border: 2px solid #818CF8;
        }
        .clay-soft {
            background: white;
            border-radius: 20px;
            box-shadow: 0 6px 0 0 #DDD6FE, 0 10px 24px rgba(139,92,246,0.08);
            border: 2px solid #EDE9FE;
        }
        .clay-green {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            border-radius: 24px;
            box-shadow: 0 8px 0 0 #047857, 0 12px 32px rgba(16,185,129,0.25);
            border: 2px solid #34D399;
        }
        .clay-amber {
            background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
            border-radius: 24px;
            box-shadow: 0 8px 0 0 #B45309, 0 12px 32px rgba(245,158,11,0.25);
            border: 2px solid #FCD34D;
        }
        .clay-red {
            background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
            border-radius: 24px;
            box-shadow: 0 8px 0 0 #B91C1C, 0 12px 32px rgba(239,68,68,0.25);
            border: 2px solid #FCA5A5;
        }
        .btn-clay {
            display: inline-block;
            padding: 12px 28px;
            border-radius: 16px;
            font-weight: 800;
            font-size: 0.9rem;
            transition: all 0.15s ease;
            cursor: pointer;
            border: none;
            position: relative;
            top: 0;
        }
        .btn-clay:active { top: 4px; }
        .btn-primary {
            background: linear-gradient(135deg, #6366F1, #4F46E5);
            color: white;
            box-shadow: 0 6px 0 0 #3730A3, 0 8px 20px rgba(99,102,241,0.30);
        }
        .btn-primary:hover { background: linear-gradient(135deg, #818CF8, #6366F1); box-shadow: 0 8px 0 0 #3730A3; transform: translateY(-1px); }
        .btn-white {
            background: white;
            color: #4F46E5;
            box-shadow: 0 6px 0 0 #C7D2FE, 0 8px 20px rgba(99,102,241,0.12);
            border: 2px solid #E0E7FF;
        }
        .btn-white:hover { background: #EEF2FF; box-shadow: 0 8px 0 0 #C7D2FE; transform: translateY(-1px); }
        .btn-green {
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            box-shadow: 0 6px 0 0 #047857, 0 8px 20px rgba(16,185,129,0.25);
        }
        .btn-green:hover { box-shadow: 0 8px 0 0 #047857; transform: translateY(-1px); }
        .btn-danger {
            background: linear-gradient(135deg, #EF4444, #DC2626);
            color: white;
            box-shadow: 0 6px 0 0 #B91C1C;
        }
        .btn-danger:hover { box-shadow: 0 8px 0 0 #B91C1C; transform: translateY(-1px); }

        .input-clay {
            width: 100%;
            padding: 14px 18px;
            border-radius: 16px;
            border: 2.5px solid #E0E7FF;
            background: #F8FAFF;
            font-size: 0.95rem;
            font-weight: 600;
            color: #1E1B4B;
            outline: none;
            transition: all 0.2s;
            box-shadow: inset 0 3px 0 rgba(99,102,241,0.06);
        }
        .input-clay:focus {
            border-color: #6366F1;
            background: white;
            box-shadow: 0 0 0 4px rgba(99,102,241,0.12), inset 0 3px 0 rgba(99,102,241,0.06);
        }
        .label-clay {
            display: block;
            font-size: 0.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #4F46E5;
            margin-bottom: 8px;
        }
        .badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 99px;
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        .badge-blue { background: #EEF2FF; color: #4F46E5; border: 1.5px solid #C7D2FE; }
        .badge-green { background: #ECFDF5; color: #059669; border: 1.5px solid #A7F3D0; }
        .badge-amber { background: #FFFBEB; color: #D97706; border: 1.5px solid #FDE68A; }
        .badge-red { background: #FEF2F2; color: #DC2626; border: 1.5px solid #FECACA; }

        /* Decorative blobs */
        .blob { position: absolute; border-radius: 50%; filter: blur(60px); opacity: 0.15; pointer-events: none; }
    </style>
</head>
<body class="min-h-screen">

    <!-- Decorative background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="blob w-96 h-96 bg-indigo-400 -top-20 -left-20"></div>
        <div class="blob w-80 h-80 bg-blue-300 top-1/3 -right-20"></div>
        <div class="blob w-64 h-64 bg-violet-400 bottom-20 left-1/4"></div>
    </div>

    <!-- Navbar -->
    <nav class="relative z-50 sticky top-0">
        <div class="mx-4 mt-4">
            <div class="clay max-w-7xl mx-auto px-6 py-4 flex justify-between items-center" style="border-radius:20px;">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-9 h-9 clay-blue flex items-center justify-center" style="border-radius:12px;box-shadow:0 4px 0 0 #3730A3;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <span class="font-black text-lg text-indigo-700">Klinik Sehat</span>
                </a>

                <div class="flex items-center gap-3">
                    <a href="{{ route('rating.index') }}" class="hidden sm:block text-sm font-bold text-indigo-500 hover:text-indigo-700 px-4 py-2 rounded-xl hover:bg-indigo-50 transition-all">
                        ⭐ Cari RS / Rating
                    </a>
                    @auth('pasien')
                        <span class="hidden sm:block text-sm font-bold text-slate-500">Halo, {{ Auth::guard('pasien')->user()->name }} 👋</span>
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button type="submit" class="btn-clay btn-danger" style="padding:10px 20px;font-size:0.8rem;">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-clay btn-white" style="padding:10px 20px;font-size:0.85rem;">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="relative z-10 max-w-7xl mx-auto px-4 py-8">
        @if (session('success'))
            <div class="clay mb-6 p-4 flex items-center gap-3" style="border-color:#A7F3D0;box-shadow:0 6px 0 0 #A7F3D0;">
                <span class="text-2xl">✅</span>
                <span class="font-bold text-emerald-700">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="clay mb-6 p-4 flex items-center gap-3" style="border-color:#FECACA;box-shadow:0 6px 0 0 #FECACA;">
                <span class="text-2xl">❌</span>
                <span class="font-bold text-red-700">{{ session('error') }}</span>
            </div>
        @endif
        @if ($errors->any())
            <div class="clay mb-6 p-4" style="border-color:#FECACA;box-shadow:0 6px 0 0 #FECACA;">
                <div class="flex items-center gap-2 mb-2"><span class="text-xl">⚠️</span><span class="font-black text-red-700">Ada kesalahan:</span></div>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-600 font-semibold text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>

</body>
</html>
