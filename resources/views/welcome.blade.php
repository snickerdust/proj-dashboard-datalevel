<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Load Tailwind CSS -->
    @vite('resources/css/app.css')
    <style>
        /* Animasi typing */
        .typing {
            border-right: 2px solid;
            white-space: nowrap;
            overflow: hidden;
            display: inline-block;
            animation: typing 5s steps(40, end) infinite, blink .75s step-end infinite;
        }

        @keyframes typing {
            0% { width: 0 }
            50% { width: 100% }
            100% { width: 0 }
        }

        @keyframes blink {
            50% { border-color: transparent }
        }
    </style>
</head>
<body class="bg-gray-900 text-white">

    <div class="flex items-center justify-between h-screen px-8">
        <!-- Bagian kiri: logo chart naik dan teks dengan animasi typing -->
        <div class="flex items-center space-x-4">
            <!-- Logo chart naik (gunakan SVG) -->
            <svg class="w-16 h-16 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l6-6 4 4 8-8" />
            </svg>
            <h1 class="text-4xl font-bold text-green-500 typing">Rata - rata valuta Currency (USD, GBP, AUD, HKD) 2016</h1>
        </div>

        <!-- Tombol Login dan Register di bagian kanan -->
        <div class="flex flex-col items-center space-y-6">
            <a href="{{ route('login') }}" class="flex justify-center items-center py-5 text-xl bg-green-500 text-white font-bold rounded-lg hover:bg-green-600 transition-all w-full">Login</a>
            <a href="{{ route('register') }}" class="px-10 py-5 text-xl bg-gray-700 text-white font-bold rounded-lg hover:bg-gray-600 transition-all w-full">Register</a>
        </div>
    </div>

</body>
</html>
