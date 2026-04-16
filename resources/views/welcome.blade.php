<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel-TodoList</title>

    <!-- Laravel 12 Typography -->
    <link rel="preconnect" href="https://bunny.net">
    <link href="https://bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        
        /* The requested entrance animation */
        @keyframes popIn {
            0% { opacity: 0; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1); }
        }
        .animate-card { animation: popIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen flex flex-col items-center justify-center p-6 selection:bg-[#FF2D20] selection:text-white">

    <div class="w-full max-w-2xl">
        <!-- Top Navigation -->
        @if (Route::has('login'))
            <nav class="flex justify-end gap-6 mb-4 px-2">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium hover:underline text-gray-700 dark:text-gray-300">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm font-medium px-4 py-1 border border-black dark:border-white rounded-md hover:bg-gray-100 dark:hover:bg-white/10 transition">Register</a>
                    @endif
                @endauth
            </nav>
        @endif

        <!-- Main Card: Exactly like your sketch -->
        <main class="container animate-card border-2 border-black dark:border-white rounded-[2rem] p-12 md:p-20 flex flex-col md:flex-row items-center justify-center gap-10 bg-white dark:bg-[#161615]">
            
            <!-- Diamond Logo -->
            <div class="relative w-24 h-24 border-2 border-black dark:border-white rotate-45 flex items-center justify-center shrink-0">
                <!-- Inner small square for a bit of "v12" flair -->
                <div class="w-4 h-4 bg-[#FF2D20]"></div>
            </div>

            <!-- Text Content -->
            <div class="text-center md:text-left">
                <h1 class="text-4xl md:text-6xl font-semibold tracking-tight text-black dark:text-white">
                    Laravel-TodoList
                </h1>
                <p class="mt-2 text-xl md:text-2xl text-gray-600 dark:text-gray-400 font-light">
                    Organize Stuff
                </p>
            </div>
        </main>

        <footer class="mt-10 text-center text-xs text-gray-400 uppercase tracking-widest">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }}
        </footer>
    </div>

</body>
</html>
