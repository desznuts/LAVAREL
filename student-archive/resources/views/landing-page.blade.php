<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Project Archive</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 40px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
        .fade-in-up {
            animation: fadeInUp 0.8s ease forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-50 via-white to-blue-50 text-gray-900 font-sans">
    <header class="bg-white shadow-md py-4">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
       <h1 class="text-4xl font-extrabold tracking-tight text-teal-600 drop-shadow-md">
  Student Project Archive
</h1>


            <nav class="space-x-6 text-blue-600 font-medium">
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-800 transition-colors duration-300">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-blue-800 transition-colors duration-300">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-blue-800 transition-colors duration-300">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="flex items-center justify-center min-h-screen px-6">
        <div class="text-center fade-in-up max-w-3xl">
            <h2 class="text-5xl font-extrabold mb-6 leading-tight tracking-tight text-gray-900">Explore &amp; Share Student Projects</h2>
            <p class="text-xl text-gray-700 mb-8 leading-relaxed">A digital archive for academic works, capstone projects, and innovations.</p>
            <a href="{}" class="inline-block bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-8 py-4 rounded-lg shadow-lg text-lg font-semibold transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">Browse Projects</a>
        </div>
    </main>

    <footer class="text-center py-6 text-gray-500 text-sm tracking-wider border-t border-gray-200">
        &copy; {{ date('Y') }} Student Project Archive. All rights reserved.
    </footer>
</body>
</html>
