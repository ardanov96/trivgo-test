<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trivgo - Temukan Destinasi Impianmu</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased text-gray-900">

    <nav class="absolute top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl font-black text-white tracking-tighter">
                        TRIV<span class="text-blue-400">GO</span>
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="text-sm font-semibold text-white bg-white/20 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/30 hover:bg-white/30 transition">
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="text-sm font-semibold text-white hover:text-blue-200 transition">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="text-sm font-semibold text-blue-900 bg-white px-5 py-2.5 rounded-full hover:bg-blue-50 transition shadow-lg">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="relative bg-blue-900 h-[500px] flex items-center justify-center text-center text-white">
        <div class="absolute inset-0 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1920&q=80" 
                class="w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-transparent to-slate-50"></div>
        </div>
        
        <div class="relative z-10 px-4">
            <h1 class="text-5xl md:text-7xl font-extrabold mb-6 tracking-tight">
                Jelajahi Dunia <br> <span class="text-blue-400">Bersama Kami</span>
            </h1>
            <p class="text-lg md:text-xl text-blue-50 max-w-2xl mx-auto leading-relaxed">
                Dapatkan penawaran paket tour terbaik dengan harga terjangkau dan pelayanan bintang lima.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 pb-20">
        <livewire:tour-package-list />
    </div>

    <footer class="bg-white border-t border-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="mb-4">
                <a href="/" class="text-xl font-bold text-gray-900">TRIVGO</a>
            </div>
            <p class="text-gray-500 text-sm italic">"Your Trusted Travel Partner Since 2024"</p>
            <div class="mt-8 pt-8 border-t border-gray-50">
                <p class="text-gray-400 text-xs">© 2026 Trivgo Travel. Dibuat dengan Laravel 11 & Livewire.</p>
            </div>
        </div>
    </footer>

</body>
</html>